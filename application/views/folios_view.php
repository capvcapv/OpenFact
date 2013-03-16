<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="<?php echo base_url()?>css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/jquery-1.8.3.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?php echo base_url()?>js/AjaxUpload.2.0.min.js"></script>
    <script src="<?php echo base_url()?>js/formatinf.js"></script>
    <script src="<?php echo base_url()?>js/grid.js"></script>
    <script src="<?php echo base_url()?>js/version.js"></script>
    <script src="<?php echo base_url()?>js/detector.js"></script>
    <script src="<?php echo base_url()?>js/errorlevel.js"></script>
    <script src="<?php echo base_url()?>js/bitmat.js"></script>
    <script src="<?php echo base_url()?>js/datablock.js"></script>
    <script src="<?php echo base_url()?>js/bmparser.js"></script>
    <script src="<?php echo base_url()?>js/datamask.js"></script>
    <script src="<?php echo base_url()?>js/rsdecoder.js"></script>
    <script src="<?php echo base_url()?>js/gf256poly.js"></script>
    <script src="<?php echo base_url()?>js/gf256.js"></script>
    <script src="<?php echo base_url()?>js/decoder.js"></script>
    <script src="<?php echo base_url()?>js/QRCode.js"></script>
    <script src="<?php echo base_url()?>js/findpat.js"></script>
    <script src="<?php echo base_url()?>js/alignpat.js"></script>
    <script src="<?php echo base_url()?>js/databr.js"></script>
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
        #infoFolios{ margin-right: 30px; margin-left: 30px}
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
    	$('#btnSalir').button({icons:{primary: "ui-icon-closethick"}}).click(function(){
         location.href='<?php echo base_url()?>'
       });
    
      $('#btnGuardar').hide().button().on('click',function(){

        $('#ajaxload').show();
        $.post('<?php echo base_url()?>index.php/folios/guarda',{serie:folio.serie,folioInicial:folio.folioInicial,folioFinal:folio.folioFinal,aprobacion:folio.aprobacion,inicioVigencia:folio.inicioVigencia,finVigencia:folio.finVigencia,cbb:folio.cbb},function() {
                    alert('Folios dado de alta exitosamente');
                     //location.href='<?php echo base_url()?>'
                  });
      });

      new AjaxUpload('#cbb',{
            action:'<?php echo base_url()?>index.php/folios/subirCBB',
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
                $('#cbb').attr('src','<?php echo base_url()?>/cbb/'+response);
                qrcode.decode('<?php echo base_url()?>cbb/'+response);
                folio.cbb=response;
                $('#btnGuardar').show();
              }  
          });

          qrcode.callback = resultadoCBB;      
      
      function resultadoCBB(data) {
          $('#resultadoFolios').empty();
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

        validaRFC(info[1]);
        validaNoAprobacion(info[2]);
        return cadena;
      }

      function validaRFC(pRFC){
        $.getJSON('<?php echo base_url()?>index.php/empresas/busca',function(data){
          if(data[0].rfc!=pRFC){
            alert('Estos folios pertenecen al contribuyente '+pRFC);
            recargaPagina();
          }         
        });
      }

      function validaNoAprobacion(pAprobacion){
        $.getJSON('<?php echo base_url()?>index.php/folios/foliosDisponibles',function(data){
          $.each(data,function(key,val){
            if(val['aprobacion']==pAprobacion){
              alert('Folios ya cargados');
              recargaPagina();
            }
          });
        });
      }

      function recargaPagina(){
        location.href='<?php echo base_url()?>index.php/folios';
      }

      $.get('<?php echo base_url()?>index.php/folios/infoFolios',function(data){
        $('#infoFolios').empty().html('Usted cuenta con '+data+' folios disponibles si gusta dar de alta mas folios solo presione la imagen de abajo');
      });

    });
      
      function inspeccionar(obj)
        {
          var msg = '';

          for (var property in obj)
          {
            if (typeof obj[property] == 'function')
            {
              var inicio = obj[property].toString().indexOf('function');
              var fin = obj[property].toString().indexOf(')')+1;
              var propertyValue=obj[property].toString().substring(inicio,fin);
              msg +=(typeof obj[property])+' '+property+' : '+propertyValue+' ;\n';
            }
            else if (typeof obj[property] == 'unknown')
            {
              msg += 'unknown '+property+' : unknown ;\n';
            }
            else
            {
              msg +=(typeof obj[property])+' '+property+' : '+obj[property]+' ;\n';
            }
          }
          return msg;
        }

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
    <div id="infoFolios"></div>
    <img src="<?=base_url()?>imagenes/Sube.png" id='cbb'>
    <br>
    <img src="<?=base_url()?>imagenes/ajax-loader.gif" id='ajaxload'>
    <div id="resultadoFolios"></div>
    <button id="btnGuardar">Guardar</button>
  </center

</body>
</html>