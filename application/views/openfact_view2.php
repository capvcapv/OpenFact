<!DOCTYPE HTML>
<html lang="es"> 
<head>
	<meta charset="utf-8">

	
	<link href="<?=base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<link href="<?=base_url()?>css/estilos.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?=base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?=base_url()?>js/AjaxUpload.2.0.min.js"></script>
    <script src="<?=base_url()?>js/formatinf.js"></script>
    <script src="<?=base_url()?>js/grid.js"></script>
    <script src="<?=base_url()?>js/version.js"></script>
    <script src="<?=base_url()?>js/detector.js"></script>
    <script src="<?=base_url()?>js/errorlevel.js"></script>
    <script src="<?=base_url()?>js/bitmat.js"></script>
    <script src="<?=base_url()?>js/datablock.js"></script>
    <script src="<?=base_url()?>js/bmparser.js"></script>
    <script src="<?=base_url()?>js/datamask.js"></script>
    <script src="<?=base_url()?>js/rsdecoder.js"></script>
    <script src="<?=base_url()?>js/gf256poly.js"></script>
    <script src="<?=base_url()?>js/gf256.js"></script>
    <script src="<?=base_url()?>js/decoder.js"></script>
    <script src="<?=base_url()?>js/QRCode.js"></script>
    <script src="<?=base_url()?>js/findpat.js"></script>
    <script src="<?=base_url()?>js/alignpat.js"></script>
    <script src="<?=base_url()?>js/databr.js"></script>
    <script src="<?=base_url()?>js/app.js"></script>

</head>
<body>

	<div id='contenedor'>
		
		<div id='panelIzquierdo' class="ui-corner-all">
			<div id='cabezera'><img id='cbb' src="<?=base_url()?>imagenes/logo2.png"></div>
			<ul id="menu">
				<li>
				<a href="#">Catalogos</a>
					<ul>
						<li><a id='clientes' href="#">Clientes</a></li>
						<li><a id='conceptos' href="#">Conceptos</a></li>
					</ul>
				</li>
				<li><a id='facturas' href="#">Facturas</a></li>
                <li><a id='generales' href="#">Generales</a></li>    
			</ul>
            <br>
            <br>
            <div id='barraFolios'>Folios</div>
		</div>
		
		<div id='panelDerecho' class="ui-corner-all">
			<div id='cuerpo'>
				<!--<object type="text/html" id='frame' data="" width="100%" height="100%"> </object>-->
			</div>
			<div id='pie' class="ui-widget-header ui-corner-all">Carlos Alberto Palacios Vargas<br>Licencia Pública General de GNU</div>
		</div>
		

	</div>

	 <div id="dialog" title="Mensaje">
      <p>Datos actualizados</p>
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

    <div id="formularioFolios" class='formulario' title="Alta de Folios">
        <img id='qrcode' src=""><br>
        <div id='resultadoFolios'></div>
    </div> 

</body>
</html>