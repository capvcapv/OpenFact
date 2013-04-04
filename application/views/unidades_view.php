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
          height: 250,
          width: 300,
          modal: true,
          buttons:{
            "Crear":function(){
              $.get('<?php echo base_url()?>index.php/unidades/guarda/'+$('#nombre').val(), function(data) {
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
          height: 250,
          width: 300,
          modal: true,
          buttons:{
            "Guardar":function(){
              $.get('<?php echo base_url()?>index.php/unidades/actualiza/'+$('#codigo').html()+'/'+$('#nombreActualiza').val(), function(data) {
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
          $('#formularioActualiza').dialog('open');
        });

        poblarTabla();

        function poblarTabla(){
          $.getJSON('<?php echo base_url()?>index.php/unidades/todos', function(data) {
            $('#tabla').dataTable().fnClearTable();
            $.each(data, function(key, val) {
              $('#tabla').dataTable().fnAddData([val['id'],val['nombre']]);
             }); 
          });
        }

        function limpiaFormulario(){
          $('#codigo').empty();
          $('#nombre').val('');
          $('#nombreActualiza').val('');
        }
    }); 

    

    </script>
    <title>Unidades de Venta</title>
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
            <th width='90%'>Nombre</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th width='10%'>Codigo</th>
            <th width='90%'>Nombre</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div id="formulario" class='formulario' title="Crear unidad de medida">
    <p class="validateTips">Capture el nombre de la nueva unidad</p>
 
    <form>
    <fieldset>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div>    

    <div id="formularioActualiza" class='formulario' title="Actuliza unidad de medida">
    <p class="validateTips">Capture el nombre nuevo unidad</p>
    <div id="codigo"></div>
    <form>
    <fieldset>
        <label for="nombreActualiza">Nombre</label>
        <input type="text" name="nombre" id="nombreActualiza" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div> 

  </body>
</html>