<!DOCTYPE HTML>
<html lang='es'>
  <head>
    <meta charset="utf-8">
    <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/App/Facturas.js"></script>
    <link href="<?php echo base_url()?>css/estilos.css" rel="stylesheet">
    <script type="text/javascript">

      $(document).ready(function() {
        
        var url="<?php echo base_url()?>";
        
        inicializaFormularios(url);
        //agregarMovimiento(url);
        cargaDatos(url);
        inicializaEventos(url);   
        inicializaFactura(url);
           

      });

    </script>
   
    <title>Captura de factura</title>
  </head>
  <body>

    <div id='cabezera'>
      <div id="toolbar" class="ui-widget-header ui-corner-all">
        <button id="terminar">Terminar</button>
        <button id="guardar">Guardar</button>
        <button id="atras">Salir</button>
      </div>
    </div>    
    
    <div class="ui-widget" id='encabezadoFactura'>
      <h3>Datos Generales</h3>
      <label>Fecha:</label>
      <input type='text' id='fecha'/> <br>
      <label>Cliente:</label><br>
      <input type='text' id='buscaCliente'/><button id='nuevoCliente'>Nuevo Cliente</button>
      <br><br>
      <div id='domicilio'>
        Datos de la empresa:
      </div>
      <br>
      <label>Lugar de expedición:</label><br>
      <input type='text' id='lugarExpedicion'/><button id='nuevoSucursal'>Nueva Sucursal</button> <br>
      <label>Método de pago:</label><br>
      <select id='metodoPago'></select><br>
      <label>Condiciones de pago:</label><br>
      <select id='condicionesPago'></select> 
      <label>Num. de cuenta:</label>
      <input type='text' id='numCuenta'/><br><br>
   </div>

   <div id='folios'class='seccion'>
    <table>
      <tr><th>Serie</th><th id='serie'></th></tr>
      <tr><th>Folio</th><th id='folio'></th></tr>
    </table>
   </div>

    <div id='movimientos_fact' class='ui-widget'>

        <div id="capturaMov" class='seccion'>
          <h3>Movimientos</h3>
          <label>Nombre:</label>
          <input type='text' id='nombreProducto'/>
          <label>Cantidad:</label>
          <input type='text' id="cantidadProducto" value='1'>
          <label id='detalleMov'> </label><br><br>
          <button id="agregarMovimiento">Agregar Movimiento</button> <br>      
        </div>

        <table id="movimientos" class="ui-widget ui-widget-content">
        <thead>
          <tr class="ui-widget-header ">
            <th width='10'>Codigo</th>
            <th width='30%'>Producto</th>
            <th width='10%'>Cantidad</th>
            <th width='10%'>Precio Unitario</th>
            <th width='10%'>Subtotal</th>
            <th width='10%'>IVA</th>
            <th width='10%'>Total</th>
            <th width='10%'></th>
          </tr>
        </thead>
        <tbody id='movimientos'>
          <!--<tr>
            <th width='10%' class='codigo'></th>
            <th width='30%' class='nombre'></th>
            <th width='10%' class='cantidad'></th>
            <th width='10%' class='precioUnitario' ></th>
            <th width='10%' class='subtotal'></th>
            <th width='10%' class='iva'></th>
            <th width='10%' class='total'></th>
            <th width='10%' class='eliminar'>Eliminar</th>
          </tr>-->
        </tbody>
      </table> 
    </div>
    
    <div class='detalleFactura seccion'>
      <table id='impuestos'>
        <tr><th>Subtotal</th><th id='subtotal'>0.00</th></tr>
        <tr><th>IVA</th><th id='iva'>0.00</th></tr>
        <tr><th>Total</th><th id='total'>0.00</th></tr>
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
