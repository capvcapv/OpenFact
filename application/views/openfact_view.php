<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <style type="text/css">

        #toolbar {
            padding: 2px 2px;
            font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
            font-size: 62.5%;
            margin-left:30px;
            margin-right:30px;
          }
        body {
            font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
        }
        .formulario label input { display:block; }
        .formulario input.text { margin-bottom:12px; width:95%; padding: .4em; }
        .formulario{font-size: 62.5%;}
        fieldset { padding:0; border:0; margin-top:0px; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
        .ui-dialog .ui-state-error { padding: .3em; }
    </style>
    <script type="text/javascript">

   $(document).ready(function(){

        $('#formulario').dialog({
              autoOpen:false,
              height: 500,
              width: 500,
              modal: true,
              buttons:{
                "Guardar":function(){
                    $.post('http://localhost/OpenFact/index.php/empresas/actualiza',{nombre:$('#nombre').val(),rfc:$('#rfc').val(),calle:$('#calle').val(),numInt:$('#numInt').val(),numExt:$('#numExt').val(),colonia:$('#colonia').val(),cp:$('#cp').val(),municipio:$('#municipio').val(),estado:$('#estado').val(),pais:$('#pais').val(),regimenFiscal:$('#regimenFiscal').val(),porcentajeIVA:$('#porcentajeIVA').val(),porcentajeIEPS:$('#porcentajeIEPS').val(),porcentajeRetISR:$('#porcentajeRetISR').val(),porcentajeRetIVA:$('#porcentajeRetIVA').val()},function() {
                      aler('Datos actualizados');
                    });
                },
                "Cancelar":function(){
                $(this).dialog('close');
                }
              }
        });

      	$('#btnClientes').button().click(function(){
          location.href='http://localhost/OpenFact/index.php/clientes'
        });
        $('#btnProductos').button().click(function(){
          location.href='http://localhost/OpenFact/index.php/productos'
        });
        $('#btnUnidades').button().click(function(){
          location.href='http://localhost/OpenFact/index.php/unidades'
        });
        $('#btnFacturas').button().click(function(){
          location.href='http://localhost/OpenFact/index.php/facturas'
        });
        $('#btnFolios').button().click(function(){
          location.href='http://localhost/OpenFact/index.php/folios'
        });
        $('#btnEmpresa').button().click(function(){
          $('#formulario').dialog('open');
        });
        $('#btnSucursales').button().click(function(){
          location.href='http://localhost/OpenFact/index.php/sucursales'
        });

        $.getJSON('http://localhost/OpenFact/index.php/empresas/busca', function(data) {
           
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