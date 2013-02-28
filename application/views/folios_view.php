<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="<?=base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?=base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
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

      var folio=new Folios();

      $('#ajaxload').hide();
    	$('#btnSalir').button().click(function(){
         location.href='http://localhost/OpenFact/'
       });
    
      $('#btnGuardar').hide().button().on('click',function(){

        $('#ajaxload').show();
        $.post('http://localhost/OpenFact/index.php/folios/guarda',{serie:folio.serie,folioInicial:folio.folioInicial,folioFinal:folio.folioFinal,aprobacion:folio.aprobacion,inicioVigencia:folio.inicioVigencia,finVigencia:folio.finVigencia,cbb:folio.cbb},function() {
                    alert('Folios dado de alta exitosamente');
                     location.href='http://localhost/OpenFact/'
                  });
      });

      new AjaxUpload('#cbb',{
            action:'http://localhost/OpenFact/index.php/folios/subirCBB',
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
                $('#cbb').attr('src','http://localhost/OpenFact/cbb/'+response);
                qrcode.decode('http://localhost/OpenFact/cbb/'+response);
                folio.cbb=response;
                $('#btnGuardar').show();
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

    </script>
	<title>OpenFact</title>
</head>
<body>

	<div id='cabezera'>
      <div id="toolbar" class="ui-widget-header ui-corner-all">
        <button id="btnSalir">Salir</button>
      </div>
  </div>
  <br>
  <center>
    <div id="cuerpo"></div>
    <img src="<?=base_url()?>imagenes/Sube.png" id='cbb'>
    <br>
    <img src="<?=base_url()?>imagenes/ajax-loader.gif" id='ajaxload'>
    <div id="resultadoFolios"></div>
    <button id="btnGuardar">Guardar</button>
  </center

</body>
</html>