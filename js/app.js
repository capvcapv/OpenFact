var url_base="http://localhost/OpenFact/index.php/";


		$(document).ready(function(){

			var folio=new Folios();

			$('#clientes').on('click',function(event){
				location.href='http://localhost/OpenFact/index.php/clientes'
			});
			$('#conceptos').on('click',function(event){
				location.href='http://localhost/OpenFact/index.php/productos'
			});
			$('#facturas').on('click',function(event){
				location.href='http://localhost/OpenFact/index.php/facturas'
			});
			$('#folios').on('click',function(event){
				$('#formularioFolios').dialog('open');
			});
			$('#generales').on('click',function(event){
				$('#formulario').dialog('open');
			});

			$.getJSON(url_base+'empresas/busca', function(data) {
           
            $.each(data, function(key, val) {
              $('#nombre').val(val['nombre']);
              $('#rfc').val(val['rfc']);
              $('#calle').val(val['calle']);
              $('#numInt').val(val['numInt']);
              $('#numExt').val(val['numExt']);
              $('#colonia').val(val['colonia']);
              $('#cp').val(val['cp']);
              $('#municipio').val(val['municipio']);
              $('#estado').val(val['estado']);
              $('#pais').val(val['pais']);
              $('#regimenFiscal').val(val['regimenfiscal']);
              $('#porcentajeIVA').val(val['porcentajeIVA']);
              $('#porcentajeIEPS').val(val['porcentajeIEPS']);
              $('#porcentajeRetIVA').val(val['porcentajeRetIVA']);
              $('#porcentajeRetISR').val(val['porcentajeRetISR']);
             }); 

	          });

	        $('#dialog').dialog({
	          autoOpen:false
	        });

	        $('#formulario').dialog({
	          autoOpen:false,
	          height: 500,
	          width: 500,
	          modal: true,
	          buttons:{
	            "Guardar":function(){
	            	$.post(url_base+'empresas/actualiza',{nombre:$('#nombre').val(),rfc:$('#rfc').val(),calle:$('#calle').val(),numInt:$('#numInt').val(),numExt:$('#numExt').val(),colonia:$('#colonia').val(),cp:$('#cp').val(),municipio:$('#municipio').val(),estado:$('#estado').val(),pais:$('#pais').val(),regimenFiscal:$('#regimenFiscal').val(),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
	                  $('#dialog').dialog('open');
	                });
	            },
	            "Cancelar":function(){
	            $(this).dialog('close');
	            }
	          }
	        });

	        $('#formularioFolios').dialog({
	          autoOpen:false,
	          height: 500,
	          width: 500,
	          modal: true,
	          buttons:{
	            "Guardar":function(){
	               $.post(url_base+'folios/guarda',{serie:folio.serie,folioInicial:folio.folioInicial,folioFinal:folio.folioFinal,aprobacion:folio.aprobacion,inicioVigencia:folio.inicioVigencia,finVigencia:folio.finVigencia,cbb:folio.cbb},function() {
	                  folio.limpiar();
	                  $('#resultadoFolios').empty();
	                  $('#dialog').dialog('open');
	                });
	            },
	            "Cancelar":function(){
	              $(this).dialog('close');
	            }
	          }
	        });

	        $('#inicioVigencia').datepicker();
	        $('#finVigencia').datepicker();

	        $('#menu').menu();

	        $('#barraFolios').progressbar({
	        	value:50,
	        	max:200
	        });

	        new AjaxUpload('#barraFolios',{
	        	action:url_base+'folios/subirCBB',
	        	onSubmit:function(file , ext){
                    	if (! (ext && /^(jpg|png)$/.test(ext))){
	                        // extensiones permitidas
	                        alert('Sólo se permiten Imagenes .jpg o .png');
	                        // cancela upload
	                        return false;
	                    } else {
	            			
	                    }
	             },
      			 onComplete: function(file, response){
      			 	$('#formularioFolios img').attr('src','cbb/'+response);
      			 	qrcode.decode('cbb/'+response);
      			 	folio.cbb=response;
	                $('#formularioFolios').dialog('open');
	             }	
	        });

	        qrcode.callback = resultadoCBB;			 
			
			function resultadoCBB(data) {
			    $('#resultadoFolios').html(procesaDatos(data));
			}

			function procesaDatos(datos){
				var info=datos.split('|');
				var cadena="";

				var fecha=info[7].split('/');

				folio.rfc=info[1];
				folio.aprobacion=info[2];
				folio.folioInicial=info[3];
				folio.folioFinal=info[4];
				folio.serie=info[5];
				folio.inicioVigencia=(fecha[2]-2)+'-'+fecha[1]+'-'+fecha[0];
				folio.finVigencia=fecha[2]+'-'+fecha[1]+'-'+fecha[0];

				cadena=cadena+'RFC:'+info[1]+'<br>';
				cadena=cadena+'N° Aprobación:'+info[2]+'<br>';
				cadena=cadena+'Serie:'+info[5]+'<br>';
				cadena=cadena+'Folio inicial:'+info[3]+'<br>';
				cadena=cadena+'Folio final:'+info[4]+'<br>';
				cadena=cadena+'Inicio vigencia:'+folio.inicioVigencia+'<br>';
				cadena=cadena+'Fin vigencia:'+folio.finVigencia+'<br>';

				return cadena;
			}
		});	



var Folios=function(){

	this.self=this;
	this.rfc='';
	this.aprobacion='';
	this.folioInicial='';
	this.folioFinal='';
	this.serie='';
	this.inicioVigencia='';
	this.finVigencia='';
	this.cbb='';

	this.limpiar=function(){
		self.rfc='';
		self.aprobacion='';
		self.folioInicial='';
		self.folioFinal='';
		this.serie='';
		self.inicioVigencia='';
		self.finVigencia='';
		this.cbb='';
	}

}