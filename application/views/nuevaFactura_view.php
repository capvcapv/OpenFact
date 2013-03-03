<!DOCTYPE HTML>
<html lang='es'>
  <head>
    <meta charset="utf-8">
    <link href="<?=base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?=base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <style type="text/css" title="currentStyle">
    
    body { font-size: 62.5%; }
    label, input { display:block; }

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

     div#movimientos_fact { margin-left: 30px; margin-right: 30px;}
    div#movimientos_fact table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#movimientos_fact table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }

    </style>
    <script type="text/javascript">

      $(document).ready(function($) {
        
        $('#facturar').button({icons:{primary: "ui-icon-check"}});
        $('#atras').button({icons:{primary: "ui-icon-closethick"}});
        $('#agregarMovimiento').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){

          agregarMovimiento();
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

                    $('#domicilio').empty().append('Datos del cliente:<br>'+val['razonSocial']+'<br>'+val['rfc']+'<br>'+val['calle']+' N° '+val['numExt']+' '+val['numInt']+'<br>'+val['colonia']+' '+val['municipio']+' '+val['estado']);
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
        $('#movimientos').append("<tr><th width='10%'><input class='cantidad' type='number'/></th><th width='30%'><input class='movimiento' STYLE='WIDTH:100%' type='text'/></th><th class='unitario' width='10%'></th><th width='10%' ></th><th width='10%'></th><th width='10%'></th><th width='10%'></th><th class='total' width='10%'></th><th class='eliminar' width='10%'>Eliminar</th> </tr>");
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
                    hola
                    tUnitario.append(val['precio1']);
                  });
              })
            }
        });
      }

 
      function inspeccionar(obj)
        {
          var msg = '';

          for (var property in obj)
          {
            if (typeof obj[property] == 'function')
            {
              var inicio = obj[property].toString().indexOf('function');
              var fin = obj[property].toString().indexOf(')')+1;
              var propertyValue=obj[property].toString().substring(inicio,fin);
              msg +=(typeof obj[property])+' '+property+' : '+propertyValue+' ;\n';
            }
            else if (typeof obj[property] == 'unknown')
            {
              msg += 'unknown '+property+' : unknown ;\n';
            }
            else
            {
              msg +=(typeof obj[property])+' '+property+' : '+obj[property]+' ;\n';
            }
          }
          return msg;
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
      <label>Cliente:</label>
      <input id='buscaCliente'/>
    </div>
    <br>
    <div id='domicilio'>
      Datos de la empresa:
    </div>
    <br>
    <div id='movimientos_fact' class='ui-widget'>
      <button id="agregarMovimiento">Agregar</button>
      <br>
      <table id="users" class="ui-widget ui-widget-content">
        <thead>
          <tr class="ui-widget-header ">
            <th width='5%'>Cantidad</th>
            <th width='30%'>Producto</th>
            <th width='10%'>Precio Unitario</th>
            <th width='10%' >IVA</th>
            <th width='10%'>IEPS</th>
            <th width='10%'>Ret IVA</th>
            <th width='10%'>Ret ISR</th>
            <th width='10%'>Total</th>
            <th width='5%'></th>
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

  </body>
</html>
