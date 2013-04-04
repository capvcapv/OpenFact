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
          height: 300,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post('<?php echo base_url()?>index.php/sucursales/guarda',{nombre:$('#nombre').val(),domicilio:$('#domicilio').val()}, function(data) {
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
          height: 400,
          width: 500,
          modal: true,
          buttons:{
            "Guardar":function(){
              $.post('<?php echo base_url()?>index.php/sucursales/actualiza/',{id:$('#codigo').html(),nombre:$('#nombreActualiza').val(),domicilio:$('#domicilioActualiza').val()},function(data) {
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
          $('#codigo').append(data[0]);
          $('#nombreActualiza').val(data[1]);
          $('#domicilioActualiza').val(data[2]);
          $('#formularioActualiza').dialog('open');
        });

        poblarTabla();

        function poblarTabla(){
          $.getJSON('<?php echo base_url()?>index.php/sucursales/todos', function(data) {
            $('#tabla').dataTable().fnClearTable();
            $.each(data, function(key, val) {
              $('#tabla').dataTable().fnAddData([val['id'],val['nombre'],val['domicilio']]);
             }); 
          });
        }

        function limpiaFormulario(){
          $('#codigo').empty();
          $('#nombre').val('');
          $('#nombreActualiza').val('');
          $('#domicilio').val('');
          $('#domicilioActualiza').val('');
        }
    }); 

    

    </script>
    <title>Sucursales</title>
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
            <th width='20%'>Nombre</th>
            <th width='70%'>Domicilio</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th width='10%'>Codigo</th>
            <th width='20%'>Nombre</th>
            <th width='70%'>Domicilio</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div id="formulario" class='formulario' title="Crear sucursal">
    <p class="validateTips">Capture el nuevo domicilio</p>
 
    <form>
    <fieldset>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" />
        <label for="domicilio">Domicilio</label>
        <input type="text" name="domicilio" id="domicilio" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div>    

    <div id="formularioActualiza" class='formulario' title="Actuliza unidad de medida">
    <p class="validateTips">Capture los datos de la sucursal</p>
    <div id="codigo"></div>
    <form>
    <fieldset>
        <label for="nombreActualiza">Nombre</label>
        <input type="text" name="nombreActualiza" id="nombreActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="domicilioActualiza">Domicilio</label>
        <input type="text" name="domicilioActualiza" id="domicilioActualiza" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div> 

  </body>
</html>