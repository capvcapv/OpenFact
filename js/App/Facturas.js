
var codigoCliente='';
var codigoProducto='';
var precioUni=0.0;
var iva=0.0;
var subtotal=0.0;
var total=0.0;


var Documento=function(){

  this.subtotal=0.0;
  this.iva=0.0;
  this.total=0.0;

}

var docto=new Documento();


function inicializaFactura(url){

   $.getJSON(url+'index.php/facturas/inicializaFactura',function(data){
     
     $('#serie').html(data.serie);
     $('#folio').html(data.folio);
     
   });

}
function abreFactura(url){


}

function inicializaEventos(url){

  $('#capturaMov').hide();

  $('#fecha').datepicker();

  $('#fecha').datepicker('option','dateFormat','yy-mm-dd');
  
  $('#atras').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
    location.href=url+'index.php/openfact'
  });
      
  $('#terminar').button({icons:{primary: "ui-icon-document"}});
      
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
          
          restaMovimiento(parseFloat($(this).find('.subtotal').html()),parseFloat($(this).find('.iva').html()),parseFloat($(this).find('.total').html()));
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
           total=subtotal+iva;

           $('#detalleMov').html('Precio Unitario: '+precioUni+' Subtotal: '+subtotal+' IVA: '+iva+' Total:'+total);
      })
    }
  });

  $('#cantidadProducto').on('keyup',function(){

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
           total=subtotal+iva;

           $('#detalleMov').empty();
           $('#detalleMov').html('Precio Unitario: '+precioUni+' Subtotal: '+subtotal+' IVA: '+iva+' Total:'+total);
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
        $.getJSON(url+'index.php/clientes/cliente/'+ui.item.value,function(data){
            $.each(data,function(key,val){
              idCliente=$('#buscaCliente').val();
              $('#buscaCliente').val(val['razonSocial']);
              $('#domicilio').empty().append('Datos del cliente:<br>'+val['razonSocial']+'<br>'+val['rfc']+'<br>'+val['calle']+' N° '+val['numExt']+' '+val['numInt']+'<br>'+val['colonia']+' '+val['municipio']+' '+val['estado']);
              codigoCliente=val['id'];
              $('#capturaMov').show("slow");
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
          $.getJSON(url+'index.php/sucursales/sucursal/'+ui.item.value,function(data){
            $.each(data,function(key,val){
                $('#lugarExpedicion').val(val['domicilio']);        
            });
          });
        }
  });


}

function agregarMovimiento(url){
  
  $('#movimientos').append("<tr><th width='10%' class='codigo'>"+codigoProducto+"</th><th width='30%' class='nombre'>"+$('#nombreProducto').val()+"</th><th width='10%' class='cantidad'>"+$('#cantidadProducto').val()+"</th><th width='10%' class='precioUnitario'>"+precioUni+"</th><th width='10%' class='subtotal'>"+subtotal+"</th><th width='10%' class='iva'>"+iva+"</th><th width='10%' class='total'>"+total+"</th><th width='10%' class='eliminar'>Eliminar</th></tr>");
  
  sumaMovimiento(subtotal,iva,total);
  limpiaMovimiento();
        
}

function sumaMovimiento(pSubtotal,pIva,pTotal){
  
  docto.subtotal=((docto.subtotal*100)+(pSubtotal*100))/100;
  docto.iva=((docto.iva*100)+(pIva*100))/100;
  docto.total=((docto.total*100)+(pTotal*100))/100;

  $('#subtotal').empty().html(docto.subtotal);
  $('#iva').empty().html(docto.iva);
  $('#total').empty().html(docto.total);

}

function restaMovimiento(pSubtotal,pIva,pTotal){

  docto.subtotal=((docto.subtotal*100)-(pSubtotal*100))/100;
  docto.iva=((docto.iva*100)-(pIva*100))/100;
  docto.total=((docto.total*100)-(pTotal*100))/100;

  $('#subtotal').empty().html(docto.subtotal);
  $('#iva').empty().html(docto.iva);
  $('#total').empty().html(docto.total);
}

function limpiaFormulario(){
    
    $('#formulario input:text').val('');
    $('#formularioSucursal input:text').val('');
}

function limpiaMovimiento(){
  subtotal=0.0;
  iva=0.0;
  total=0.0;
  codigoProducto='';
  $('#nombreProducto').val("");
  $('#cantidadProducto').val("1");
  $('#detalleMov').empty();
}

