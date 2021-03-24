
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>COTIZACIÓN # <?php echo str_pad($cabecera['CCNUMDOC'], 7, "0", STR_PAD_LEFT) ?> </title>

</head>
<style media="screen">
html {
margin: 0;
}
table{
  width: 100%;
}
body {
font-family: "Times New Roman", serif;
margin: 15mm 5mm 5mm 5mm;
}

.encabezado  {
  border-collapse: collapse;
  font-family:sans-serif;
  vertical-align: middle;
      margin-bottom: 5px
}
.footer {
  border-collapse: collapse;
  border: 1px solid black;
}
table.cabecera {
  border-collapse: collapse;
  font-family:sans-serif;

}
.cabecera{
  border:1PX solid 0;

}
.detalle_cl{

border-collapse: collapse;
  font-family:sans-serif;
}
table.detalle_cl thead, thead {

vertical-align: middle;

}


</style>
<body>

<table class="encabezado">
      <thead>
        <tr>
          <td rowspan="3" style="width: 258px;vertical-align: middle;"><img src="<?php echo base_url() ?>assets/img/codrise_logonew.png" alt="" width="240px"></td>
          <td rowspan="3" style="width: 258px;text-align:center;vertical-align: middle;font-size:10px;text-align:center;  font-family:Verdana,sans-serif;">
            <center>
                COMERCIAL DRILLING SERVICES SAC <br>
                20516663643 <br>
                AV. ALAMEDA SUR 216 URB. VILLA MARINA CHORRILLOS - LIMA <br>
                EMAIL: ventas@codrise.com&nbsp;&nbsp;&nbsp;&nbsp;WEB: www.codrise.com <br>
                TELÉFONO:518-7100 <br>
            </center>
          </td>
                    <td  style="width:31px;color:white;height:8pt;font-size:6pt"> hola</td>
          <td style="width: 31px;color:white;height:8pt;font-size:6pt"> hola</td>
          <td style="width:144px; color:white;height:8pt;font-size:6pt"> hola</td>

        </tr>

        <tr>
                      <td style="border: 1px solid white">&nbsp;</td>
            <td style="">&nbsp;</td>
            <td style="border: 1px solid black;height: 35px;background-color:#1C5076;color:white;font-size:10pt;text-align:center"><b>N° COTIZACIÓN</b> </td>

        </tr>
        <tr>
                      <td style="">&nbsp;</td>
            <td style="">&nbsp;</td>
            <td style="border: 1px solid black;height: 35px;font-size:10pt;text-align:center"><b><?php echo $cabecera['CCNUMDOC'] ?></b></td>

        </tr>

      </thead>
    </table>

<table class="cabecera">
<thead>
  <tr>
  <th style="font-size: 9pt;width:147px;height: 13pt;  border-right: 1px solid black;‬border-left: 1px solid black;‬border-top:1px solid black"><div>&nbsp;CLIENTE<br></div></th>
  <td  style="font-size: 8pt;width:300px;height: 13pt;  border-right: 1px solid black;border-left: 1px solid black;border-top:1px solid black"><div><?php echo ($cabecera['CCNOMBRE']); ?><br></div></td>
  <th style="font-size: 9pt;width:147px;height: 13pt;  border-right: 1px solid black;border-left: 1px solid black;border-top:1px solid black"><div>&nbsp;FECHA<br></div></th>
  <td style="font-size: 8pt;width:150px;height: 13pt‬;  border-right: 1px solid black;border-left: 1px solid black;border-top:1px solid black"><div><?php echo date('d-m-Y',strtotime($cabecera['CCFECDOC'])); ?><br></div></td>
  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;DIRECCION <br></div></th>
  <td style="font-size: 5.5pt;width:102;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CDIRFISC']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;" ><div>&nbsp;ASESOR COMERCIAL<br></div></th>
  <td style="font-size: 8pt;width:101;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CCVENDE'] ?><br></div></td>
  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;RUC<br></div></th>
  <td style="font-size: 8pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CCRUC']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;TELEFONO<br></div></th>
  <td style="font-size: 8pt;width:101;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['TELEFONO'] ?><br></div></td>
  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;CONTACTO <br></div></th>
  <td style="font-size: 8pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['COD_CONTACTO']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;REQUERIMIENTO<br></div></th>
  <td style="font-size: 8pt;width:101;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CCREF']; ?><br></div></td>

  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black‬"><div>&nbsp;EMAIL	<br></div></th>
  <td style="font-size: 8pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black"><div><?php echo $cabecera['EMAIL']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black"><div>&nbsp;COTIZADO POR</div></th>
  <td style="font-size: 8pt;width:101;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black"><div><?php echo $cabecera['CCUSER']; ?><br></div></td>

  </tr>
</thead>
    </table>


    <table class="detalle_cl"  style='margin-top: 5px'>
    <thead>
      <!--    <tr>
      <th style="font-size: 6pt;border:1px solid black"><center>N°</center></th>
      <th style="font-size: 6pt;border:1px solid black"><center>CÓDIGO</center></th>
      <th colspan="6" style="font-size: 8pt;border:1px solid black"><center>DESCRIPCIÓN</center></th>
      <th style="font-size: 6pt;border:1px solid black"><center>TIEMPO ESTIMADO</center></th>
      <th style="font-size: 6pt;border:1px solid black"><center>CANT.</center></th>
      <th style="font-size: 6pt;border:1px solid black"><center>U.M.</center></th>
      <th style="font-size: 6pt;border:1px solid black"><center>PU</center></th>
      <th style="font-size: 6pt;border:1px solid black"><center>%DTO.</center></th>
      <th style="font-size: 8pt;border:1px solid black"><center>P.U. NETO</center></th>
      <th style="font-size: 8pt;border:1px solid black"><center>SUB TOTAL</center></th>
      </tr>  -->

    <!--<tr>
    <th style="width: 7;font-size: 8pt;border:1px solid black"><center>N°</center></th>
    <th style="width: 75;font-size: 8pt;border:1px solid black"><center>CÓDIGO</center></th>
    <th colspan="6" style="width: 220;font-size: 8pt;border:1px solid black"><center>DESCRIPCIÓN</center></th>
    <th style="width: 35;font-size: 8pt;border:1px solid black"><center>TIEMPO ESTIMADO</center></th>
    <th style="width: 10;font-size: 8pt;border:1px solid black"><center>CANT.</center></th>
    <th style="width: 10;font-size: 8pt;border:1px solid black"><center>U.M.</center></th>
    <th style="width: 20;font-size: 8pt;border:1px solid black"><center>PU</center></th>
    <th style="width: 20;font-size: 8pt;border:1px solid black"><center>%DTO.</center></th>
    <th style="width: 20;font-size: 8pt;border:1px solid black"><center>P.U. NETO</center></th>
    <th style="width: 20;font-size: 8pt;border:1px solid black"><center>SUB TOTAL</center></th>
  </tr>-->
    <tr>
      <th style="width: 7;font-size: 8pt;border:1px solid black"><center>N°</center></th>
      <th style="width: 60;font-size: 8pt;border:1px solid black"><center>CÓDIGO</center></th>
      <th colspan="6" style="width: 180;font-size: 8pt;border:1px solid black"><center>DESCRIPCIÓN</center></th>
      <th style="width: 35;font-size: 8pt;border:1px solid black"><center>TIEMPO ESTIMADO</center></th>
      <th style="width: 10;font-size: 8pt;border:1px solid black"><center>CANT.</center></th>
      <th style="width: 10;font-size: 8pt;border:1px solid black"><center>U.M.</center></th>
      <th style="width: 20;font-size: 8pt;border:1px solid black"><center>PU</center></th>
      <th style="width: 30;font-size: 8pt;border:1px solid black"><center>%DTO.</center></th>
      <th style="width: 35;font-size: 8pt;border:1px solid black"><center>P.U. NETO</center></th>
      <th style="width: 35;font-size: 8pt;border:1px solid black"><center>SUB TOTAL</center></th>
    </tr>

    </thead>
    <tbody >

      <?php $contador=0; foreach ($detalle as $key): $contador++;?>
        <tr>
          <td style="text-align: center;height:15pt; font-size:6pt;border-right: 1px solid #000;border-left: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
                  <?php echo $key->CDSECUEN ?>
            <?php endif; ?>
          </td>
          <td style="text-align: left;height:15pt; font-size:6pt;border-right: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo $key->CDCODIGO ?>
            <?php endif; ?>
          </td>
          <td colspan="6" style="text-align: left;height:15pt; font-size:6pt;border-right: 1px solid #000"><?php echo strtoupper($key->CDDESCRI) ?></td>
          <td <?php if ($key->PLAZO==999): ?>
            style="text-align: center;height:15pt; font-size:5pt;border-right: 1px solid #000"
          <?php else: ?>
            style="text-align: center;height:15pt; font-size:6pt;border-right: 1px solid #000"
          <?php endif; ?>>
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php if ($key->PLAZO==0): ?>
              <?php echo "EN STOCK" ?>
            <?php elseif ($key->PLAZO==999): ?>
              <?php echo "POR CONFIRMAR" ?>
              <?php else: ?>
                <?php echo $key->PLAZO  ?>
                <?php if ($key->CCTIPTIME==1 ): ?>
                  <?php echo "D.H." ?>
                <?php endif; ?>
                <?php if ($key->CCTIPTIME==7 ): ?>
                  <?php echo "SEM" ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
          </td>
          <td style="text-align: center;height:15pt; font-size:6pt;border-right: 1px solid #000"><center>
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo number_format($key->CDCANTID) ?>
          <?php endif; ?></center>
          </td>
          <td style="text-align: center;height:15pt; font-size:6pt;border-right: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo $key->CDUNIDAD ?>
          <?php endif; ?>
          </td>
          <td style="text-align: right;height:15pt; font-size:6pt;border-right: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo number_format($key->CDPREC_ORI,2) ?>
          <?php endif; ?>
          </td>
          <td style="text-align: center;height:15pt; font-size:6pt;border-right: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo number_format($key->CDPORDES,2)."%" ?>
          <?php endif; ?>
          </td>
          <td style="text-align: right;height:15pt; font-size:6pt;border-right: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo number_format($key->CDPREC_ORI*(1-($key->CDPORDES/100)),2)?>
          <?php endif; ?>
          </td>
          <td style="text-align: right;height:15pt; font-size:6pt;border-right: 1px solid #000">
            <?php if ($key->CDCODIGO!='TEXTO'): ?>
            <?php echo number_format($key->CDPREC_ORI*(1-($key->CDPORDES/100))*$key->CDCANTID,2) ?>
          <?php endif; ?>
          </td>
        </tr>
        <?php if ($cabecera['num']!=28): ?>
          <?php if (($contador==28 or ($contador-28)%38==0) ): ?>
              <tr>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000;border-left: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td colspan="6" style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt; border-bottom: 1px solid black;border-right: 1px solid #000"></td>
              </tr>
              <?php  for ($i=1;$i<=7;$i++){?>
              <tr>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td colspan="6" style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
                <td style="text-align: right;height:15pt; font-size: 6pt;border:none;"></td>
              </tr>
              <?php } ?>
            <?php endif; ?>
        <?php endif; ?>
              <?php endforeach; ?>



    <?php if ($cabecera['num']<=28): ?>
      <?php  for ($i=1;$i<=28-$cabecera['num'];$i++){?>
      <tr>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000;border-left: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td colspan="6" style="text-align: right; height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
      </tr>
      <?php } ?>
      <?php else: ?>
        <?php  for ($i=1;$i<38-($cabecera['num']-29)%38;$i++){?>
        <tr>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000;border-left: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td colspan="6" style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
          <td style="text-align: right;height:15pt; font-size: 6pt;border-right: 1px solid #000"></td>
        </tr>
        <?php } ?>
    <?php endif; ?>

    <tr>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000;border-left: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td colspan="6" style="text-align: center;height:8pt; font-size: 6pt ;border-right: 1px solid #000"><b>D.H.: Días Habiles</b></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
      <td style="text-align: right;height:8pt; font-size: 6pt;border-right: 1px solid #000"></td>
    </tr>
    <tr class="fijo">
      <td height="11px"  colspan="5" style="border:1px solid black; font-size:5.5pt"><b>VALIDEZ DE LA COTIZACION:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;30 DÍAS HÁBILES </td>
      <td height="11px" colspan="4" style="border:1px solid black; font-size:5.5pt"><b>TIEMPO DE ENTREGA:</b>&nbsp;&nbsp;PREVIA OC Y DISPONIB.DE STOCK </td>
      <td height="22px" colspan="4" style="border:1px solid black; font-size:7pt">SUBTOTAL</td>
      <td height="22px" style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <?php $subtotal= ($cabecera['CCIMPORTE']-$cabecera['CCIGV'])+$cabecera['CCDESVAL']?>
      <td height="22px" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($subtotal,2,'.',','); ?></div></td>
    </tr>
    <tr class="fijo">
      <td height="11px" colspan="5" style="border:1px solid black; font-size:5.5pt"><b>CONDICIONES DE PAGO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cabecera['CCFORPAG'] ?> </td>
      <td height="11px" colspan="4" style="border:1px solid black; font-size:5.5pt"><b>MONEDA:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($cabecera['CCCODMON']=="ME"){echo "DOLARES AMERICANOS";}else{echo "NUEVO SOL";} ?></td>
      <td rowspan="2" colspan="4" style="border:1px solid black; font-size:7pt">DESCUENTO TOTAL</td>
      <td rowspan="2" style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <td rowspan="2" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($cabecera['CCDESVAL'],2,'.',','); ?></div></td>
    </tr>
    <tr class="fijo">
      <td height="11px" colspan="5" style="border:1px solid black; font-size:6pt"><b>LUGAR DE ENTREGA:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php if ($cabecera['CCTIPCOTIZA']=='EXT'): ?>
          <?php echo "RECOJO EN NUESTRO ALMACÉN" ?>
          <?php else: ?>
            <?php if ($cabecera['CCIMPORTE']>100): ?><?php echo "SU ALMACEN" ?><?php else: ?><?php echo "RECOJO EN NUESTRO ALMACÉN" ?><?php endif; ?>
        <?php endif; ?>
        </td>
      <td height="11px" colspan="4" style="border:1px solid black; font-size:6pt"><b>PESO TOTAL:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cabecera['PESO'] ?>kg</td>

    </tr>
    <tr class="fijo">
      <td height="20px" rowspan="3" colspan="5" style="border:1px solid black; font-size:6pt">

        <b>* STOCK Y PRECIO SUJETO A VARIACIÓN SIN PREVIO AVISO</b><br>
        <b>* LOS ENVIOS FUERA DE LIMA, VAN POR CUENTA Y RIESGO DEL CLIENTE</b><br>
        <b>* AL ENVIAR SU OC POR MONTOS MENORES A $100, SIRVASE A PASAR A RECOGER SU MERCADERIA EN NUESTRO ALMACÉN</b><br>
        <b>* HORARIO DE ATENCIÓN DE NUESTRO ALMACEN: DE LUNES A VIERNES DE 08:15 AM A 11:45 AM Y DE 01:00 PM A 04:15 PM</b><br>

       </td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:5.5pt"><center><b>NUESTRAS CUENTAS CORRIENTES EN DOLARES</b></center> </td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:7pt">VALOR DE VENTA</td>
      <td height="20px" style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <td height="20px" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($cabecera['CCIMPORTE']-$cabecera['CCIGV'],2,'.',','); ?></div></td>
    </tr>
    <tr class="fijo">
      <td height="20px" colspan="2" style="border:1px solid black; font-size:6pt">BCP</td>
      <td height="20px" colspan="2"  style="border:1px solid black; font-size:6pt">194-1620380-1-84</td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:7pt">IGV</td>
      <td height="20px"  style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <td height="20px" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($cabecera['CCIGV'],2,'.',','); ?></div></td>
    </tr>
    <tr class="fijo">
      <td height="20px" colspan="2" style="border:1px solid black; font-size:6pt">SCOTIABANK</td>
      <td height="20px" colspan="2"  style="border:1px solid black; font-size:6pt">000-3022614</td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:7pt">TOTAL</td>
      <td height="20px"  style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <td height="20px" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($cabecera['CCIMPORTE'],2,'.',','); ?></div></td>
    </tr>
    		</tbody>
    </table>

</body>
</html>
