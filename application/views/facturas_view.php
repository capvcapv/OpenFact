<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
  <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
  <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
  <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
  <link href="<?php echo base_url()?>media/css/demo_table_jui.css" rel="stylesheet">
  <link href="<?php echo base_url()?>css/estilos.css" rel="stylesheet">
  <script type="text/javascript" language="javascript" src="<?php echo base_url()?>media/js/jquery.dataTables.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
                
            $('#nuevo').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
              location.href='<?php echo base_url()?>index.php/facturas/nuevaFactura';
            });    
          
            $('#atras').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
                location.href='<?php echo base_url()?>index.php/openfact'
            });    

            $('#tabla').dataTable({
              "bPaginate": false,
              "bJQueryUI": true 
            });

        });

    </script>
    <title>Facturas</title>
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
            <th width='10%'>Serie</th>
            <th width='10%'>Folio</th>
            <th width='70%'>RFC</th>
            <th width='10%'>Descargar</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th width='10%'>Serie</th>
            <th width='10%'>Folio</th>
            <th width='70%'>RFC</th>
            <th width='10%'>Descargar </th>   
          </tr>
        </tfoot>
      </table>
    </div>


</body>
</html>