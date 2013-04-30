<!DOCTYPE HTML>
<html>
  <head>
    <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <link href="<?php echo base_url()?>media/css/demo_table_jui.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/estilos.css" rel="stylesheet">
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>media/js/jquery.dataTables.js"></script>


    <script type="text/javascript">

    $(document).ready(function(){

        $('#formulario').dialog({
          autoOpen:false,
          height: 500,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post('<?php echo base_url()?>index.php/productos/guarda',{codigo:$('#codigo').val(),nombre:$('#nombre').val(),descripcion:$('#descripcion').val(),precio1:$('#precio1').val(),precio2:$('#precio2').val(),unidad:$('#unidad').val(),exento:chk($('#exento')),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
                  poblarTabla();
                });
              $(this).dialog('close');
            },
            "Cancelar":function(){
            $(this).dialog('close');
            }
          }
        });

        $('#formularioActualiza').dialog({
          autoOpen:false,
          height: 500,
          width: 500,
          modal: true,
          buttons:{
            "Guardar":function(){
              $.post('<?php echo base_url()?>index.php/productos/actualiza',{id:$('#idActualiza').html(),codigo:$('#codigoActualiza').val(),nombre:$('#nombreActualiza').val(),descripcion:$('#descripcionActualiza').val(),precio1:$('#precio1Actualiza').val(),precio2:$('#precio2Actualiza').val(),unidad:$('#unidadActualiza').val(),exento:chk($('#exentoActualiza')),porcentajeIVA:$('#porcentajeIVAActualiza').val(),porcentajeIEPS:$('#porcentajeIEPSActualiza').val(),porcentajeRetISR:$('#porcentajeRetISRActualiza').val(),porcentajeRetIVA:$('#porcentajeRetIVAActualiza').val()},function() {
                  poblarTabla();
                });
              $(this).dialog('close');
            },
            "Cancelar":function(){
            $(this).dialog('close');
            }
          }
        });

        $('#nuevo').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
          limpiaFormulario();
          $('#formulario').dialog('open');
        });

        $('#atras').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
          location.href='http://localhost/OpenFact/index.php/openfact'
        });    

        $('#tabla').dataTable({
          "bPaginate": false,
          "bJQueryUI": true 
        });
        
        $('#tabla').on('dblclick','tr',function(){
          var data=$('#tabla').dataTable().fnGetData(this);
          limpiaFormulario();
          $.getJSON('<?php echo base_url()?>index.php/productos/producto/'+data[0],function(data){
            
            $.each(data, function(key, val){ 
              $('#idActualiza').append(val['id']);
              $('#codigoActualiza').val(val['codigo']);
              $('#nombreActualiza').val(val['nombre']);
              $('#descripcionActualiza').val(val['descripcion']);
              $('#precio1Actualiza').val(val['precio1']);
              $('#precio2Actualiza').val(val['precio2']);
              $('#unidadActualiza').val(val['unidad']);
              if(val['exento']==1){
                $('#exentoActualiza').attr('checked',true);
              }
              $('#porcentajeIVAActualiza').val(val['porcentajeIVA']);
              $('#porcentajeIEPSActualiza').val(val['porcentajeIEPS']);
              $('#porcentajeRetIVAActualiza').val(val['porcentajeRetIVA']);
              $('#porcentajeRetISRActualiza').val(val['porcentajeRetISR']);
             });
          });
          $('#formularioActualiza').dialog('open');
        });

        poblarTabla();
        rellenaUnidades();
        
        function rellenaUnidades(){
          $.getJSON('<?php echo base_url()?>index.php/unidades/todos',function(data){
            $.each(data,function(key,val){
              $("#unidad").append("<option value="+val['id']+">"+val['nombre']+"</option>");
              $("#unidadActualiza").append("<option value="+val['id']+">"+val['nombre']+"</option>");
            });
          });
        }
        
        function poblarTabla(){
          $.getJSON('<?php echo base_url()?>index.php/productos/todos', function(data) {
            $('#tabla').dataTable().fnClearTable();
            $.each(data, function(key, val) {
              $('#tabla').dataTable().fnAddData([val['codigo'],val['nombre'],val['precio1']]);
             }); 
          });
        }

        function limpiaFormulario(){
          $('#idActualiza').empty();
          $('input:text').val('');
          $(':checkbox').attr('checked',false);
        }

        function chk(check){
          if(check.is(':checked')){
            return 1;
          }else{
            return 0;
          }
        }
    }); 

    

    </script>
    <title>Productos</title>
  </head>
  <body>
    
    <div id='cabezera'>
      <div id="toolbar" class="ui-widget-header ui-corner-all">
        <button id="nuevo">Nuevo</button>
        <button id="atras">Salir</button>
      </div>
    </div>

    <div id='contTabla'>
      <table id='tabla' width=100%>
        <thead>
          <tr>
            <th width='10%'>Codigo</th>
            <th width='70%'>Nombre</th>
            <th width='20%'>Precio 1</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th width='10%'>Codigo</th>
            <th width='70%'>Nombre</th>
            <th width='20%'>Precio 1</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div id="formulario" class='formulario' title="Alta producto">
    <p class="validateTips">Capture los datos del producto</p>
 
    <form>
    <fieldset>
        <label for="codigo">Codigo</label>
        <input type="text" name="codigo" id="codigo" class="text ui-widget-content ui-corner-all" />
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" />
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" />
        <label for="unidad">Unidad</label><br>
        <select id="unidad" name="unidad">
        </select><br><br>
        <label for="precio1">Precio 1</label>
        <input type="text" name="precio1" id="precio1" class="text ui-widget-content ui-corner-all" />
        <label for="precio2">Precio 2</label>
        <input type="text" name="precio2" id="precio2" class="text ui-widget-content ui-corner-all" />
        <input type="checkbox" id="exento" value="1">Exento <br> <br>
        <label for="porcentajeIVA">IVA</label>
        <input type="text" name="porcentajeIVA" id="porcentajeIVA" class="text ui-widget-content ui-corner-all" />
        <label for="porcentajeIEPS">IEPS</label>
        <input type="text" name="porcentajeIEPS" id="porcentajeIEPS" class="text ui-widget-content ui-corner-all" />
        <label for="porcentajeRetIVA">Ret IVA</label>
        <input type="text" name="porcentajeRetIVA" id="porcentajeRetIVA" class="text ui-widget-content ui-corner-all" />
        <label for="porcentajeRetISR">Ret ISR</label>
        <input type="text" name="porcentajeRetISR" id="porcentajeRetISR" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div>    

    <div id="formularioActualiza" class='formulario' title="Actuliza producto">
    <p class="validateTips">Datos del producto</p>
    <div id='idActualiza'></div>
    <form>
    <fieldset>
        <label for="codigoActualiza">Codigo</label>
        <input type="text" name="codigoActualiza" id="codigoActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="nombreActualiza">Nombre</label>
        <input type="text" name="nombreActualiza" id="nombreActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="descripcionActualiza">Descripcion</label>
        <input type="text" name="descripcionActualiza" id="descripcionActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="unidadActualiza">Unidad</label><br>
        <select id="unidadActualiza">
        </select><br>
        <label for="precio1Actualiza">Precio 1</label>
        <input type="text" name="precio1Actualiza" id="precio1Actualiza" class="text ui-widget-content ui-corner-all" />
        <label for="precio2Actualiza">Precio 2</label>
        <input type="text" name="precio2Actualiza" id="precio2Actualiza" class="text ui-widget-content ui-corner-all" />
        <input type="checkbox" id="exentoActualiza" value="1">Exento  <br>  <br>    
        <label for="porcentajeIVAActualiza">IVA</label>
        <input type="text" name="porcentajeIVAActualiza" id="porcentajeIVAActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="porcentajeIEPSActualiza">IEPS</label>
        <input type="text" name="porcentajeIEPSActualiza" id="porcentajeIEPSActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="porcentajeRetIVAActualiza">Ret IVA</label>
        <input type="text" name="porcentajeRetIVAActualiza" id="porcentajeRetIVAActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="porcentajeRetISRActualiza">Ret ISR</label>
        <input type="text" name="porcentajeRetISRActualiza" id="porcentajeRetISRActualiza" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div> 

  </body>
</html>