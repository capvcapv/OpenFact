<!DOCTYPE HTML>
<html lang='es'>
  <head>
    <meta charset="utf-8">
    <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <style type="text/css" title="currentStyle">
    
    body { font-size: 62.5%; }
    
    #toolbar {
      padding: 2px 2px;
      font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
      margin-left:30px;
      margin-right:30px;
    }

    #domicilio{
      margin-left: 30px;
      margin-right: 30px;
      border: 1px;
    }

    #cliente { padding:0; border:0; margin-top:25px; margin-left: 30px; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
    .ui-dialog .ui-state-error { padding: .3em; }

    #buscaCliente{width: 30%}
    #lugarExpedicion{width: 70%}
     div#movimientos_fact { margin-left: 30px; margin-right: 30px;}
    div#movimientos_fact table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#movimientos_fact table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }


      .formulario label input { display:block; }
      .formulario input.text { margin-bottom:12px; width:95%; padding: .4em; }
      fieldset { padding:0; border:0; margin-top:25px; }
      .validateTips { border: 1px solid transparent; padding: 0.3em; }
      .ui-dialog .ui-state-error { padding: .3em; }

    </style>
    <script type="text/javascript">

      $(document).ready(function($) {
        
        var idCliente='';

        $('#atras').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
                location.href='http://localhost/OpenFact/index.php/openfact'
            });
      
        $('#facturar').button({icons:{primary: "ui-icon-check"}});
      

        $('#agregarMovimiento').button({icons:{primary: "ui-icon-plusthick"}, text:false}).click(function(){
          agregarMovimiento();
        });

        $('#formulario').dialog({
          autoOpen:false,
          height: 500,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post('<?php echo base_url()?>index.php/clientes/guarda',{razonSocial:$('#razonSocial').val(),rfc:$('#rfc').val(),calle:$('#calle').val(),numInt:$('#numInt').val(),numExt:$('#numExt').val(),colonia:$('#colonia').val(),cp:$('#cp').val(),municipio:$('#municipio').val(),estado:$('#estado').val(),pais:$('#pais').val(),correoElectronico:$('#correoElectronico').val(),telefono:$('#telefono').val(),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
                  poblarTabla();
                });
              $(this).dialog('close');
            },
            "Cancelar":function(){
            $(this).dialog('close');
            }
          }
        });

        $('#nuevoCliente').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
          limpiaFormulario();
          $('#formulario').dialog('open');
        });

        $('#formularioSucursal').dialog({
          autoOpen:false,
          height: 300,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post('<?php echo base_url()?>index.php/sucursales/guarda',{nombre:$('#nombreSucursal').val(),domicilio:$('#domicilioSucursal').val()}, function(data) {
                  poblarTabla();
                });
              $(this).dialog('close');
            },
            "Cancelar":function(){
            $(this).dialog('close');
            }
          }
        });

        $('#nuevoSucursal').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
          limpiaFormulario();
          $('#formularioSucursal').dialog('open');
        });

        $('#buscaCliente').autocomplete({
 
            source:function(request,response){
              $.getJSON('<?=base_url()?>index.php/clientes/todos/'+$('#buscaCliente').val(),function(data){

                response($.map(data,function(item){
                  return{
                    label:item.razonSocial,
                    value:item.id,
                  }
                }))

              });
            },
            minLength:2,
            select:function(event,ui){
              $.getJSON('<?=base_url()?>index.php/clientes/cliente/'+$('#buscaCliente').val(),function(data){
                  $.each(data,function(key,val){
                    idCliente=$('#buscaCliente').val();
                    $('#buscaCliente').val(val['razonSocial']);
                    $('#domicilio').empty().append('Datos del cliente:<br>'+val['razonSocial']+'<br>'+val['rfc']+'<br>'+val['calle']+' N° '+val['numExt']+' '+val['numInt']+'<br>'+val['colonia']+' '+val['municipio']+' '+val['estado']);
                  });
              });
            }
        });

      $('#lugarExpedicion').autocomplete({
        source:function(request,response){
          $.getJSON('<?=base_url()?>index.php/sucursales/todos/'+$('#lugarExpedicion').val(),function(data){
            response($.map(data,function(item){
              return{
                label:item.nombre,
                value:item.id,
              }
            }))
          });
        },
        select:function(event,ui){
          $.getJSON('<?=base_url()?>index.php/sucursales/sucursal/'+$('#lugarExpedicion').val(),function(data){
            $.each(data,function(key,val){
                $('#lugarExpedicion').val(val['domicilio']);        
            });
          });
        }
      });

      $('#movimientos').on('click','tr',function(event){
        
         if($(event.target).attr('class')=='eliminar'){
          $(this).remove(); 
         }

      });

      function agregarMovimiento(){
        $('#movimientos').append("<tr><th width='10%'><input class='cantidad' type='number'/></th><th width='30%'><input class='movimiento' STYLE='WIDTH:100%' type='text'/></th><th class='unitario' width='10%'></th><th class='total' width='10%'></th><th class='eliminar' width='10%'>Eliminar</th> </tr>");
        var tProducto=$('#movimientos').find('tr:last .movimiento');
        var tCantidad=$('#movimientos').find('tr:last .cantidad');
        var tTotal=$('#movimientos').find('tr:last .total');
        var tUnitario=$('#movimientos').find('tr:last .unitario');
        tProducto.autocomplete({
 
            source:function(request,response){
              $.getJSON('<?=base_url()?>index.php/productos/todos/'+$(tProducto).val(),function(data){

                response($.map(data,function(item){
                  return{
                    label:item.nombre,
                    value:item.codigo,
                  }
                }))

              });
            },
            minLength:2,
            close:function(event,ui){
              $.getJSON('<?=base_url()?>index.php/productos/producto/'+$(tProducto).val(),function(data){
                  $.each(data,function(key,val){
                    
                    tUnitario.append(val['precio1']);
                  });
              })
            }
        });
      }

      function limpiaFormulario(){
          
          $('#formulario input:text').val('');
          $('#formularioSucursal input:text').val('');
        }

      });

    </script>
   
    <title>Captura de factura</title>
  </head>
  <body>

    <div id='cabezera'>
      <div id="toolbar" class="ui-widget-header ui-corner-all">
        <button id="facturar">Facturar</button>
        <button id="atras">Salir</button>
      </div>
    </div>    
    
    <div class="ui-widget" id='cliente'>
      <label>Cliente:</label><br>
      <input id='buscaCliente'/><button id='nuevoCliente'>Nuevo</button>
      <br><br>
      <div id='domicilio'>
        Datos de la empresa:
      </div>
      <br>
      <label>Lugar de expedición:</label><br>
      <input id='lugarExpedicion'/><button id='nuevoSucursal'>Nuevo</button> <br>
      <label>Método de pago:</label><br>
      <input id='metodoPago'/><br>
      <label>Condiciones de pago:</label><br>
      <input id='condicionesPago' /> 
      <label>Num. de cuenta:</label>
      <input id='numCuenta'/><br><br>
   </div>

    <div id='movimientos_fact' class='ui-widget'>
      <button id="agregarMovimiento">Agregar</button>
      <br>
      <table id="users" class="ui-widget ui-widget-content">
        <thead>
          <tr class="ui-widget-header ">
            <th width='10%'>Cantidad</th>
            <th width='60%'>Producto</th>
            <th width='10%'>Precio Unitario</th>
            <th width='10%'>Total</th>
            <th width='10%'></th>
          </tr>
        </thead>
        <tbody id='movimientos'>
          <!--<tr>
            <th width='10%'><input type='text'/></th>
            <th width='30%'><input type='text'/></th>
            <th width='10%'></th>
            <th width='10%' ></th>
            <th width='10%'></th>
            <th width='10%'></th>
            <th width='10%'></th>
            <th width='10%'></th>
            <th width='10%'><a href='#'>Eliminar</a></th>
          </tr>-->
        </tbody>
      </table>
    </div>


    <div id="formulario" class='formulario' title="Alta cliente">
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

     <div id="formularioSucursal" class='formulario' title="Crear sucursal">
    <p class="validateTips">Capture el nuevo domicilio</p>
 
    <form>
    <fieldset>
        <label for="nombreSucursal ">Nombre</label>
        <input type="text" name="nombreSucursal" id="nombreSucursal" class="text ui-widget-content ui-corner-all" />
        <label for="domicilioSucursal">Domicilio</label>
        <input type="text" name="domicilioSucursal" id="domicilioSucursal" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
    </div>    

  </body>
</html>
