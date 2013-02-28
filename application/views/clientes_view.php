<!DOCTYPE HTML>
<html>
  <head>
    <link href="<?=base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?=base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?=base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <style type="text/css" title="currentStyle">
      @import "<?=base_url()?>media/css/demo_table_jui.css";
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
      #formulario label input { display:block; }
      #formulario input.text { margin-bottom:12px; width:95%; padding: .4em; }
      #formularioActualiza label input { display:block; }
      #formularioActualiza input.text { margin-bottom:12px; width:95%; padding: .4em; }
      #formulario{font-size: 62.5%;}
      #formularioActualiza{font-size: 62.5%;}
      fieldset { padding:0; border:0; margin-top:25px; }
      .validateTips { border: 1px solid transparent; padding: 0.3em; }
      .ui-dialog .ui-state-error { padding: .3em; }
    </style>
    <script type="text/javascript" language="javascript" src="<?=base_url()?>media/js/jquery.dataTables.js"></script>


    <script type="text/javascript">

    $(document).ready(function(){

        $('#formulario').dialog({
          autoOpen:false,
          height: 500,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post('<?=base_url()?>index.php/clientes/guarda',{razonSocial:$('#razonSocial').val(),rfc:$('#rfc').val(),calle:$('#calle').val(),numInt:$('#numInt').val(),numExt:$('#numExt').val(),colonia:$('#colonia').val(),cp:$('#cp').val(),municipio:$('#municipio').val(),estado:$('#estado').val(),pais:$('#pais').val(),correoElectronico:$('#correoElectronico').val(),telefono:$('#telefono').val(),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
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
              $.post('<?=base_url()?>index.php/clientes/actualiza',{id:$('#codigoActualiza').html(),razonSocial:$('#razonSocialActualiza').val(),rfc:$('#rfcActualiza').val(),calle:$('#calleActualiza').val(),numInt:$('#numIntActualiza').val(),numExt:$('#numExtActualiza').val(),colonia:$('#coloniaActualiza').val(),cp:$('#cpActualiza').val(),municipio:$('#municipioActualiza').val(),estado:$('#estadoActualiza').val(),pais:$('#paisActualiza').val(),correoElectronico:$('#correoElectronicoActualiza').val(),telefono:$('#telefonoActualiza').val(),porcentajeIVA:$('#porcentajeIVAActualiza').val(),porcentajeIEPS:$('#porcentajeIEPSActualiza').val(),porcentajeRetISR:$('#porcentajeRetISRActualiza').val(),porcentajeRetIVA:$('#porcentajeRetIVAActualiza').val()},function() {
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
          $.getJSON('<?=base_url()?>index.php/clientes/cliente/'+data[0],function(data){
            
            $.each(data, function(key, val){ 
              $('#codigoActualiza').empty();
              $('#codigoActualiza').append(val['id']);
              $('#razonSocialActualiza').val(val['razonSocial']);
              $('#rfcActualiza').val(val['rfc']);
              $('#calleActualiza').val(val['calle']);
              $('#numIntActualiza').val(val['numInt']);
              $('#numExtActualiza').val(val['numExt']);
              $('#coloniaActualiza').val(val['colonia']);
              $('#cpActualiza').val(val['cp']);
              $('#municipioActualiza').val(val['municipio']);
              $('#estadoActualiza').val(val['estado']);
              $('#paisActualiza').val(val['pais']);
              $('#correoElectronicoActualiza').val(val['correoElectronico']);
              $('#telefonoActualiza').val(val['telefono']);
              $('#porcentajeIVAActualiza').val(val['porcentajeIVA']);
              $('#porcentajeIEPSActualiza').val(val['porcentajeIEPS']);
              $('#porcentajeRetIVAActualiza').val(val['porcentajeRetIVA']);
              $('#porcentajeRetISRActualiza').val(val['porcentajeRetISR']);
             });
          });
          $('#formularioActualiza').dialog('open');
        });

        poblarTabla();

        function poblarTabla(){
          $.getJSON('<?=base_url()?>index.php/clientes/todos', function(data) {
            $('#tabla').dataTable().fnClearTable();
            $.each(data, function(key, val) {
              $('#tabla').dataTable().fnAddData([val['id'],val['razonSocial'],val['rfc']]);
             }); 
          });
        }

        function limpiaFormulario(){
          $('#codigo').empty();
          $('input:text').val('');
          
        }
    }); 

    

    </script>
    <title>Clientes</title>
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
            <th width='70%'>Razon Social</th>
            <th width='20%'>RFC</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th width='10%'>Codigo</th>
            <th width='70%'>Razon Social</th>
            <th width='20%'>RFC</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div id="formulario" title="Alta cliente">
    <p class="validateTips">Capture los datos del cliente</p>
 
    <form>
    <fieldset>
        <label for="razonSocial">Razon Social</label>
        <input type="text" name="razonSocial" id="razonSocial" class="text ui-widget-content ui-corner-all" />
        <label for="rfc">RFC</label>
        <input type="text" name="rfc" id="rfc" class="text ui-widget-content ui-corner-all" />
        <label for="calle">Calle</label>
        <input type="text" name="calle" id="calle" class="text ui-widget-content ui-corner-all" />
        <label for="numInt">Num Int</label>
        <input type="text" name="numInt" id="numInt" class="text ui-widget-content ui-corner-all" />
        <label for="numExt">Num Ext</label>
        <input type="text" name="numExt" id="numExt" class="text ui-widget-content ui-corner-all" />
        <label for="colonia">Colonia</label>
        <input type="text" name="colonia" id="colonia" class="text ui-widget-content ui-corner-all" />
        <label for="cp">CP</label>
        <input type="text" name="cp" id="cp" class="text ui-widget-content ui-corner-all" />
        <label for="municipio">Municipio</label>
        <input type="text" name="municipio" id="municipio" class="text ui-widget-content ui-corner-all" />
        <label for="estado">Estado</label>
        <input type="text" name="estado" id="estado" class="text ui-widget-content ui-corner-all" />
        <label for="pais">Pais</label>
        <input type="text" name="pais" id="pais" class="text ui-widget-content ui-corner-all" />
        <label for="correoElectronico">Correo Electronico</label>
        <input type="text" name="correoElectronico" id="correoElectronico" class="text ui-widget-content ui-corner-all" />
        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" id="telefono" class="text ui-widget-content ui-corner-all" />
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

    <div id="formularioActualiza" title="Actuliza unidad de medida">
    <p class="validateTips">Capture el nombre nuevo unidad</p>
    <div id="codigoActualiza"></div>
    <form>
    <fieldset>
        <label for="razonSocialActualiza">Razon Social</label>
        <input type="text" name="razonSocialActualiza" id="razonSocialActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="rfcActualiza">RFC</label>
        <input type="text" name="rfcActualiza" id="rfcActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="calleActualiza">Calle</label>
        <input type="text" name="calleActualiza" id="calleActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="numIntActualiza">Num Int</label>
        <input type="text" name="numIntActualiza" id="numIntActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="numExtActualiza">Num Ext</label>
        <input type="text" name="numExtActualiza" id="numExtActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="coloniaActualiza">Colonia</label>
        <input type="text" name="coloniaActualiza" id="coloniaActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="cpActualiza">CP</label>
        <input type="text" name="cpActualiza" id="cpActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="municipioActualiza">Municipio</label>
        <input type="text" name="municipioActualiza" id="municipioActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="estadoActualiza">Estado</label>
        <input type="text" name="estadoActualiza" id="estadoActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="paisActualiza">Pais</label>
        <input type="text" name="paisActualiza" id="paisActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="correoElectronicoActualiza">Correo Electronico</label>
        <input type="text" name="correoElectronicoActualiza" id="correoElectronicoActualiza" class="text ui-widget-content ui-corner-all" />
        <label for="telefonoActualiza">Telefono</label>
        <input type="text" name="telefonoActualiza" id="telefonoActualiza" class="text ui-widget-content ui-corner-all" />
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