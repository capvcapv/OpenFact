
var codigoCliente='';
var codigoProducto='';
var precioUni=0;
var iva=0;
var subtotal=0;
var total=0;

function inicializaFactura(url){

   $.getJSON(url+'index.php/facturas/inicializaFactura',function(data){
     
     $('#serie').html(data.serie);
     $('#folio').html(data.folio);
     
   });

}
function abreFactura(url){


}

function inicializaEventos(url){
  
  $('#atras').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
    location.href=url+'index.php/openfact'
  });
      
  $('#terminar').button({icons:{primary: "ui-icon-check"}});
      
  $('#guardar').button({icons:{primary: "ui-icon-check"}});

  $('#agregarMovimiento').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
    agregarMovimiento(url);
  });

  $('#nuevoCliente').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
    limpiaFormulario();
    $('#formulario').dialog('open');
  });

  $('#nuevoSucursal').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
    limpiaFormulario();
    $('#formularioSucursal').dialog('open');
  });

  $('#movimientos').on('click','tr',function(event){
        
         if($(event.target).attr('class')=='eliminar'){
          $(this).remove(); 
         }

  });


  $('#nombreProducto').autocomplete({
    source:function(request,response){
      $.getJSON(url+'index.php/productos/todos/'+$('#nombreProducto').val(),function(data){
        response($.map(data,function(item){
          return{
            label:item.nombre,
            value:item.codigo,
         }
        }))
      });
    },
    minLength:2,
   select: function( event, ui ) {
      $.getJSON(url+'index.php/productos/producto/'+ui.item.value,function(data){
          
           $('#nombreProducto').val(ui.item.label);
    
           codigoProducto=ui.item.value;
           precioUni=data[0].precio1;
           subtotal=precioUni*parseFloat($('#cantidadProducto').val());

           var data=$.ajax({
            type:'get',
            url:url+'index.php/facturas/iva/'+codigoProducto+'/'+codigoCliente,
            dataType:'html',
            global:false,
            async:false,
            success:function(data){
              return data;
            }
           }).responseText;
           iva=subtotal*(parseFloat(data)/100);
           
           $('#detalleMov').html('Precio Unitario: '+precioUni+' Subtotal: '+subtotal+' IVA: '+iva+' Total:'+parseFloat(subtotal+iva));
      })
    }
  });

}

function inicializaFormularios(url){
  
  $('#formulario').dialog({
          autoOpen:false,
          height: 500,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post(url+'index.php/clientes/guarda',{razonSocial:$('#razonSocial').val(),rfc:$('#rfc').val(),calle:$('#calle').val(),numInt:$('#numInt').val(),numExt:$('#numExt').val(),colonia:$('#colonia').val(),cp:$('#cp').val(),municipio:$('#municipio').val(),estado:$('#estado').val(),pais:$('#pais').val(),correoElectronico:$('#correoElectronico').val(),telefono:$('#telefono').val(),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
                  poblarTabla();
                });
              $(this).dialog('close');
            },
            "Cancelar":function(){
            $(this).dialog('close');
            }
          }
  });

  $('#formularioSucursal').dialog({
          autoOpen:false,
          height: 300,
          width: 500,
          modal: true,
          buttons:{
            "Crear":function(){
              $.post(url+'index.php/sucursales/guarda',{nombre:$('#nombreSucursal').val(),domicilio:$('#domicilioSucursal').val()}, function(data) {
                  poblarTabla();
                });
              $(this).dialog('close');
            },
            "Cancelar":function(){
            $(this).dialog('close');
            }
          }
  });

}

function cargaDatos(url){

  $.getJSON(url+'index.php/facturas/datosGenerales/',function(data){
    
    $.map(data[0],function(item){
      $('#condicionesPago').append('<option value="'+item.id+'">'+item.nombre+'</option>');        
    });

    $.map(data[1],function(item){
      $('#metodoPago').append('<option value="'+item.id+'">'+item.nombre+'</option>');        
    });

  });

  
  $('#buscaCliente').autocomplete({
 
      source:function(request,response){
        $.getJSON(url+'index.php/clientes/todos/'+$('#buscaCliente').val(),function(data){

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
        $.getJSON(url+'index.php/clientes/cliente/'+$('#buscaCliente').val(),function(data){
            $.each(data,function(key,val){
              idCliente=$('#buscaCliente').val();
              $('#buscaCliente').val(val['razonSocial']);
              $('#domicilio').empty().append('Datos del cliente:<br>'+val['razonSocial']+'<br>'+val['rfc']+'<br>'+val['calle']+' N° '+val['numExt']+' '+val['numInt']+'<br>'+val['colonia']+' '+val['municipio']+' '+val['estado']);
              codigoCliente=val['id'];
            });
        });
      }
  });

  $('#lugarExpedicion').autocomplete({
        source:function(request,response){
          $.getJSON(url+'index.php/sucursales/todos/'+$('#lugarExpedicion').val(),function(data){
            response($.map(data,function(item){
              return{
                label:item.nombre,
                value:item.id,
              }
            }))
          });
        },
        select:function(event,ui){
          $.getJSON(url+'index.php/sucursales/sucursal/'+$('#lugarExpedicion').val(),function(data){
            $.each(data,function(key,val){
                $('#lugarExpedicion').val(val['domicilio']);        
            });
          });
        }
  });


}

function agregarMovimiento(url){
  
  $('#movimientos').append("<tr><th width='10%'><input disabled='disabled' class='codigo' type='text'/></th><th width='50%'><input class='movimiento' style='width:100%' type='text'/></th><th width='10%'><input class='cantidad' type='number' value='1'/></th><th class='unitario' width='10%'></th><th class='total' width='10%'></th><th class='eliminar' width='10%'>Eliminar</th> </tr>");
  var tProducto=$('#movimientos').find('tr:last .movimiento');
  var tCantidad=$('#movimientos').find('tr:last .cantidad');
  var tTotal=$('#movimientos').find('tr:last .total');
  var tUnitario=$('#movimientos').find('tr:last .unitario');
  var tCodigo=$('#movimientos').find('tr:last .codigo');
  
  tCantidad.on('keyup',function(){
    tTotal.html(tCantidad.val()*tUnitario.html());
    sumaMovimiento();
  });
        
}

function sumaMovimiento(iva,neto){

  var a=$('.total');
  var b=0;

  for (var i = a.length - 1; i >= 0; i--) {
    b=parseFloat(b)+parseFloat($(a[i]).html());
  }

  $('#subtotal').empty().html(b);

}

function limpiaFormulario(){
    
    $('#formulario input:text').val('');
    $('#formularioSucursal input:text').val('');
}

