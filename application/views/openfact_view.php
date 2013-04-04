<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	  <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <link href="<?php echo base_url()?>css/estilos.css" rel="stylesheet">
    <script type="text/javascript">

   $(document).ready(function(){

        $('#formulario').dialog({
              autoOpen:false,
              height: 500,
              width: 500,
              modal: true,
              buttons:{
                "Guardar":function(){
                    $.post('<?php echo base_url()?>index.php/empresas/actualiza',{nombre:$('#nombre').val(),rfc:$('#rfc').val(),calle:$('#calle').val(),numInt:$('#numInt').val(),numExt:$('#numExt').val(),colonia:$('#colonia').val(),cp:$('#cp').val(),municipio:$('#municipio').val(),estado:$('#estado').val(),pais:$('#pais').val(),regimenFiscal:$('#regimenFiscal').val(),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
                      alert('Datos actualizados');
                    });
                },
                "Cancelar":function(){
                $(this).dialog('close');
                }
              }
        });

      	$('#btnClientes').button().click(function(){
          location.href='<?php echo base_url()?>index.php/clientes'
        });
        $('#btnProductos').button().click(function(){
          location.href='<?php echo base_url()?>index.php/productos'
        });
        $('#btnUnidades').button().click(function(){
          location.href='<?php echo base_url()?>index.php/unidades'
        });
        $('#btnFacturas').button().click(function(){
          location.href='<?php echo base_url()?>index.php/facturas'
        });
        $('#btnFolios').button().click(function(){
          location.href='<?php echo base_url()?>index.php/folios'
        });
        $('#btnEmpresa').button().click(function(){
          $('#formulario').dialog('open');
        });
        $('#btnSucursales').button().click(function(){
          location.href='<?php echo base_url()?>index.php/sucursales'
        });

        $.getJSON('<?php echo base_url()?>index.php/empresas/busca',function(data){
             
            $('#nombre').val(data[0].nombre);
            $('#rfc').val(data[0].rfc);
            $('#calle').val(data[0].calle);
            $('#numInt').val(data[0].numInt);
            $('#numExt').val(data[0].numExt);
            $('#colonia').val(data[0].colonia);
            $('#cp').val(data[0].cp);
            $('#municipio').val(data[0].municipio);
            $('#estado').val(data[0].estado);
            $('#pais').val(data[0].pais);
            $('#regimenFiscal').val(data[0].regimenFiscal);
            $('#porcentajeIVA').val(data[0].porcentajeIVA);
            $('#porcentajeIEPS').val(data[0].porcentajeIEPS);
            $('#porcentajeRetIVA').val(data[0].porcentajeRetIVA);
            $('#porcentajeRetISR').val(data[0].porcentajeRetISR);
        });
       
    });


    </script>
	<title>OpenFact</title>
</head>
<body>
	<div id='cabezera'>
      <div id="toolbar" class="ui-widget-header ui-corner-all">
        OpenFact &#174
        <button id="btnClientes">Clientes</button>
        <button id="btnProductos">Productos</button>
        <button id="btnUnidades">Unidades</button>
        <button id="btnFacturas">Facturas</button>
        <button id="btnFolios">Folios</button>
        <button id="btnSucursales">Sucursales</button>
        <button id="btnEmpresa">Mi empresa</button>
      </div>
    </div>
    <div class="cuerpo">
        <center>
            <img src="<?=base_url()?>imagenes/trucal.png">
            <br>
            <h1>OpenFact</h1>
            Licencia Pública General de GNU
            <br>
            
        </center>

    </div>
    <div id="formulario" title="Datos de la Empresa" class='formulario'>
    <form>
    <fieldset>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" />
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
        <label for="regimenFiscal">Regimen Fiscal</label>
        <input type="text" name="regimenFiscal" id="regimenFiscal" class="text ui-widget-content ui-corner-all" />
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
</body>
</html>