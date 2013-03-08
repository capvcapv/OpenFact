<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
  <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
  <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
  <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
  <style type="text/css" title="currentStyle">
    @import "<?php echo base_url()?>media/css/demo_table_jui.css";
    #toolbar {
      padding: 2px 2px;
      font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
      font-size: 62.5%;
      margin-left:30px;
      margin-right:30px;
    }
    #contTabla{
      font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
      font-size: 80%;
      margin:10px 30px;
    }
    #formulario label input { display:block; }
    #formulario input.text { margin-bottom:12px; width:95%; padding: .4em; }
    #formularioActualiza label input { display:block; }
    #formularioActualiza input.text { margin-bottom:12px; width:95%; padding: .4em; }
    #formulario{font-size: 62.5%;}
    #formularioActualiza{font-size: 62.5%;}
    fieldset { padding:0; border:0; margin-top:25px; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
    .ui-dialog .ui-state-error { padding: .3em; }
  </style>
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>media/js/jquery.dataTables.js"></script>
    <script type="text/javascript">

        $(document).ready(function($) {
                
            $('#nuevo').button({icons:{primary: "ui-icon-plusthick"}}).click(function(){
              location.href='http://localhost/OpenFact/index.php/facturas/nuevaFactura';
            });    
          
            $('#atras').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
                location.href='http://localhost/OpenFact/index.php/openfact'
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