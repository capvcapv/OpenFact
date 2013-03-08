<!DOCTYPE HTML>
<html>
  <head>
    <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <style type="text/css" title="currentStyle">
      @import "<?php echo base_url()?>media/css/demo_table_jui.css";
      #toolbar {
        padding: 2px 2px;
        font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
        font-size: 62.5%;
        margin-left:30px;
        margin-right:30px;
      }
      #contTabla{
        font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
        font-size: 80%;
        margin:10px 30px;
      }
      #formulario{font-size: 62.5%;}
      #formularioActualiza{font-size: 62.5%;}
      fieldset { padding:0; border:0; margin-top:25px; }
      .validateTips { border: 1px solid transparent; padding: 0.3em; }
      .ui-dialog .ui-state-error { padding: .3em; }
    </style>
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

    <div id="formulario" title="Crear unidad de medida">
    <p class="validateTips">Capture el nombre de la nueva unidad</p>
 
    <form>
    <fieldset>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div>    

    <div id="formularioActualiza" title="Actuliza unidad de medida">
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