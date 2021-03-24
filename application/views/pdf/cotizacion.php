
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>COTIZACIÓN # <?php echo str_pad($cabecera['CCNUMDOC'], 7, "0", STR_PAD_LEFT) ?> </title>
<style media="screen">

.numcod{
  padding: 3px;
border-collapse: collapse; width: 48%;
font-size: 9;
}
td.numcod{
border:1px solid #000;
}


.cabecera{
border-collapse: collapse;
width: 100%;
font-size: 8;
border: 1px solid #000;
}
table.cabecera td{

border-right: 1px solid #000;
padding: 3px;
}


.divdetalle{

position: fixed;
top: 150px;
}
.divdetalleimport{
position: fixed;
top: 110px;

}
.detalle{
border-collapse: collapse; width: 100%;
font-size: 8;

border: 1px solid #000;

}
table.detalle thead, thead th{
border: 1px solid #000;
vertical-align: top;

}

table.detalle td{
margin: 3px;
padding: 3px;
border-right: 1px solid #000;
vertical-align: top;

}

.detalle_imp{
border-collapse: collapse; width: 100%;
font-size: 8;

border: 1px solid #000;

}
table.detalle_imp thead, thead th{
border: 1px solid #000;
vertical-align: top;
height: 20px;
}

table.detalle_imp td{
margin: 3px;
padding: 3px;
border: 1px solid #000;
vertical-align: top;
height: 40px;

}


.detalle_impf2{
border-collapse: collapse; width: 100%;
font-size: 8;

border: 1px solid #000;

}
table.detalle_impf2 thead, thead th{
border: 1px solid #000;
vertical-align: top;
height: 20px;
}

table.detalle_impf2 td{
margin: 3px;
padding: 3px;
border: 1px solid #000;
vertical-align: top;
height: 20px;

}

.detalle_cl{
border-collapse: collapse; width: 100%;
font-size: 8;

border: 1px solid #000;

}
table.detalle_cl thead, thead th{
border: 1px solid #000;
vertical-align: top;
height: 20px;
}

table.detalle_cl td{
margin: 3px;
padding: 3px;
border-right: 1px solid #000;
vertical-align: top;
height: 27px;

}


.totales{
border-collapse: collapse; width: 100%;
font-size: 8;
border: 1px solid #000;


}
table.totales td{
margin: 3px;
padding: 3px;
border-right: 1px solid #000;
}



.footer{
border-collapse: collapse; width: 100%;

font-size: 8;

}
table.footer td{

}

.info{
text-align: center;
font-size: 8;
position: fixed;
bottom: 100;

}


table.footer td{
width: 25%;

}
.imagen{

width: 50px;
height: 50px;
}
.linea{

width: 90%;
height: 1px;
margin-left: 5px;

background-color: #000;
}
.area{
font-size: 9;
margin: 3px;
}


#header,
#footer {
width: 100%;
text-align: center;

}
#header {
top: 0px;
}
#footer {
bottom: 120px;
}
.pagenum:before {
content: counter(page);
}




.formulario{
border: 1px solid #337ab7;
border-radius: 10px;

}
.titulo{
text-align: center;
border-bottom: 1px solid #337ab7;

}
.botones{
padding-top: 10px;
margin-bottom: 10px;
border-top: 1px solid #337ab7;

}
.margininicio {

margin: 4px;

}


.borderdivs{
border-color: #337ab7;
border-radius: 10px;
}
p{
margin:9px;
text-align: justify;
}

</style>
</head>

<body>
<div id="header">
<!--<div style="text-align: right;"><span class="pagenum"></span></div>-->
<table>
<tr>
<td class="img"><img src="<?php echo base_url() ?>/assets/img/codrise_long.png" width="200px" alt=""></td>
</tr>
<tr>
<td style="font-size:8pt">COMERCIAL DRILLING SERVICES S.A.C</td>
</tr>
<tr>
<td style="font-size:8pt">0516663643</td>
</tr>
<tr>
<td style="font-size:8pt">Av. Alameda Sur 216 Urb. Villa Marina Chorrillos, CP 15066 LIMA – PERÚ</td>
</tr>
<tr>
<td width="50 pt" style="font-size:8pt">EMAIL: ventas@codrise.com &nbsp;&nbsp; WEB: www.codrise.com</td>

</tr>

</table>

</div>


<div >
<table class="numcod" >
<tr class="numcod" >
<td class="numcod" width="300" height='20' style="margin-left:20px"> &nbsp;&nbsp;N° COTIZACIÓN:</td>
<td class="numcod" ><center><?php echo str_pad($cabecera['CCNUMDOC'], 7, "0", STR_PAD_LEFT) ?></center></td>
</tr>
</table>


</div>
<br>
<div>

<table class="cabecera">
<tr>
<td width="70" ><div>&nbsp;&nbsp;CLIENTE<br></div></td>
<td width="250" ><div><?php echo utf8_encode($cabecera['CCNOMBRE']); ?><br></div></td>
<td width="70" ><div>&nbsp;&nbsp;FECHA EMISION<br></div></td>
<td ><div><?php echo date('Y/m/d',strtotime($cabecera['CCFECDOC'])); ?><br></div></td>
</tr>
<tr>
<td ><div>&nbsp;&nbsp;DIRECCION <br></div></td>
<td ><div><?php echo $cabecera['CDIRFISC']; ?><br></div></td>
<td ><div>&nbsp;&nbsp;TELEFONO<br></div></td>
<td ><div><?php echo $cabecera['TELEFONO'] ?><br></div></td>
</tr>
<tr>
<td ><div>&nbsp;&nbsp;RUC<br></div></td>
<td ><div><?php echo $cabecera['CCRUC']; ?><br></div></td>
<td ><div>&nbsp;&nbsp;FAX<br></div></td>
<td ><div><br></div></td>
</tr>
<tr>
<td ><div>&nbsp;&nbsp;CONTACTO <br></div></td>
<td ><div><?php echo $cabecera['COD_CONTACTO']; ?><br></div></td>
<td ><div>&nbsp;&nbsp;VENDEDOR<br></div></td>
<td ><div><?php echo $cabecera['CCVENDE']; ?><br></div></td>

</tr>
<tr>
<td ><div>&nbsp;&nbsp;EMAIL	<br></div></td>
<td ><div><?php echo $cabecera['EMAIL']; ?><br></div></td>
<td ><div>&nbsp;&nbsp;DOC.REF</div></td>
<td ><div><?php echo $cabecera['CCREF']; ?><br></div></td>

</tr>
</table>


</div>
</div>
<div class="" style="margin-top: 10px">
</div>

<table class="detalle_cl"  style='margin-top: 5px'>
<thead>
<tr>
<th style="width: 15"><center>N°</center></th>
<th style="width: 60"><center>Código</center></th>
<th style="width: 178"><center>Descripción</center></th>
<th style="width: 40"><center>Tiempo Estimado</center></th>
<th style="width: 15"><center>Cant.</center></th>
<th style="width: 15"><center>U.M.</center></th>
<th style="width: 30"><center>PU</center></th>
<th style="width: 30"><center>DTO(%)</center></th>
<th style="width: 30"><center>P.U. NETO</center></th>
<th style="width: 30"><center>SUB TOTAL</center></th>
</tr>

</thead>
<tbody >

  <?php foreach ($detalle as $key): ?>
    <tr>
      <td style="text-align: left;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
              <?php echo $key->CDSECUEN ?>
        <?php endif; ?>
      </td>
      <td style="text-align: left;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo $key->CDCODIGO ?>
        <?php endif; ?>
      </td>
      <td style="text-align: left;height:7pt; font-size: 7pt"><?php echo strtoupper($key->CDDESCRI) ?></td>
      <td style="text-align: center;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php if ($key->PLAZO==0): ?>
          <?php echo "Inmediato" ?>
          <?php else: ?>
            <?php echo $key->PLAZO  ?>
            <?php if ($key->CCTIPTIME==1 ): ?>
              <?php echo "DH" ?>
            <?php endif; ?>
            <?php if ($key->CCTIPTIME==7 ): ?>
              <?php echo "SEM" ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
      </td>
      <td style="text-align: right;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo number_format($key->CDCANTID,2) ?>
        <?php endif; ?>
      </td>
      <td style="text-align: center;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo $key->CDUNIDAD ?>
      <?php endif; ?>
      </td>
      <td style="text-align: right;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo number_format($key->CDPREC_ORI,2) ?>
      <?php endif; ?>
      </td>
      <td style="text-align: right;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo number_format($key->CDPORDES,2) ?>
      <?php endif; ?>
      </td>
      <td style="text-align: right;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo number_format($key->CDPREC_ORI*(1-($key->CDPORDES/100)),2)?>
      <?php endif; ?>
      </td>
      <td style="text-align: right;height:7pt; font-size: 7pt">
        <?php if ($key->CDCODIGO!='TEXTO'): ?>
        <?php echo number_format($key->CDPREC_ORI*(1-($key->CDPORDES/100))*$key->CDCANTID,2) ?>
      <?php endif; ?>
      </td>
    </tr>

  <?php endforeach; ?>

<?php if ($cabecera['num']<32): ?>
  <?php  for ($i=1;$i<=28-$cabecera['num'];$i++){?>
  <tr>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    <td style="text-align: right;height:7pt; font-size: 7pt"></td>
  </tr>
  <?php } ?>
  <?php else: ?>
    <?php  for ($i=1;$i<=32-fmod($cabecera['num'],52);$i++){?>
    <tr>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
      <td style="text-align: right;height:7pt; font-size: 7pt"></td>
    </tr>
    <?php } ?>
<?php endif; ?>
		</tbody>
</table>
<table style="border:0;">

</table>

<div class="">

  			<table class="detalle" >
          <tbody>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;VALIDEZ</div></td>
              <td  style="width:250;height:10;font-size: 7pt"><div>&nbsp;&nbsp;30 DÍAS HÁBILES</div></td>
              <td style="font-size: 7pt" ><div>&nbsp;&nbsp;SUBTOTAL</div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php if($cabecera['CCCODMON']=="ME"){echo "US$";}else{echo "PEN S/";} ?></div></td>
              <?php $subtotal= ($cabecera['CCIMPORTE']-$cabecera['CCIGV'])+$cabecera['CCDESVAL']?>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php echo number_format($subtotal,2,'.',','); ?></div></td>

            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;CONDICIONES DE PAGO</div></td>
              <td  style="width:250;height:10;font-size: 7pt"><div>&nbsp;&nbsp;<?php echo $cabecera['CCFORPAG'] ?></div></td>
              <td style="font-size: 7pt" ><div>&nbsp;&nbsp;DESCUENTO TOTAL</div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php if($cabecera['CCCODMON']=="ME"){echo "US$";}else{echo "PEN S/";} ?></div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php echo number_format($cabecera['CCDESVAL'],2,'.',','); ?></div></td>
            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;LUGAR DE ENTREGA</div></td>
              <td style="width:250;height:10;font-size: 7pt"><div>
                <?php if ($cabecera['CCIMPORTE']>100 or $cabecera['CCTIPCOTIZA']!='EXT'): ?>
                  <?php echo "&nbsp;&nbsp;SU ALMACEN" ?>
                  <?php else: ?>
                    <?php echo "&nbsp;&nbsp;RECOJO EN NUESTRO ALMACEN" ?>
                <?php endif; ?>
              </div></td>
              <td style="font-size: 7pt" ><div>&nbsp;&nbsp;</div></td>
              <td style="width: 30;font-size: 7pt"><div></div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"></div></td>
            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;TIEMPO DE ENTEGA</div></td>
              <td style="width:250;height:10;font-size: 7pt"><div>&nbsp;&nbsp;PREVIA OC Y DISPONIB.DE STOCK</div></td>
              <td style="font-size: 7pt" ><div>&nbsp;&nbsp;</div></td>
              <td style="width: 30;font-size: 7pt" ><div></div></td>
              <td style="width: 30;font-size: 7pt" ><div style="text-align: right;"></div></td>
            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;MONEDA</div></td>
              <td style="width:250;height:10;font-size: 7pt"><div>
                <?php if ($cabecera['CCCODMON']=='ME'): ?>
                  <?php echo "&nbsp;&nbsp;DOLARES AMERICANOS" ?>
                <?php else: ?>
                  <?php echo "&nbsp;&nbsp;NUEVOS SOLES" ?>
                <?php endif; ?>
              </div></td>
              <td style="font-size: 7pt"><div>&nbsp;&nbsp;</div></td>
              <td style="width: 30;font-size: 7pt"><div></div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"></div></td>
            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;PESO TOTAL</div></td>
              <td style="width:250;height:10;font-size: 7pt"><div>&nbsp;&nbsp;<?php echo $cabecera['PESO'] ?>kg</div></td>
              <td style="font-size: 7pt" ><div>&nbsp;&nbsp;VALOR DE VENTA</div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php if($cabecera['CCCODMON']=="ME"){echo "US$";}else{echo "PEN S/";} ?></div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php echo number_format($cabecera['CCIMPORTE']-$cabecera['CCIGV'],2,'.',','); ?></div></td>
            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;</div></td>
              <td style="width:250; height:10;font-size: 7pt">

              </td>
              <td style="font-size: 7pt"><div>&nbsp;&nbsp;IGV</div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php if($cabecera['CCCODMON']=="ME"){echo "US$";}else{echo "PEN S/";} ?></div></td>
              <td style="width: 30;font-size: 7pt"><div style="text-align: right;"><?php echo number_format($cabecera['CCIGV'],2,'.',','); ?></div></td>
            </tr>
            <tr>
              <td style="width: 100;font-size: 7pt"><div>&nbsp;&nbsp;</div></td>
              <td style="width:250; height:10;font-size: 7pt">
              </td>
              <td style="font-size: 7pt"><div>&nbsp;&nbsp;TOTAL</div></td>
              <td style="width: 30;font-size: 7pt" ><div style="text-align: right;"><?php if($cabecera['CCCODMON']=="ME"){echo "US$";}else{echo "PEN S/";} ?></div></td>
              <td style="width: 30;font-size: 7pt" ><div style="text-align: right;"><?php echo number_format($cabecera['CCIMPORTE'],2,'.',','); ?></div></td>
            </tr>
          </tbody>
  		</table>

</div>
<!--
<div style="height:7;margin: 3px 0 3px 0;">
  <p style="text-align:left;font-size: 5.5pt;line-height: 50%;">-STOCK Y PRECIO SUJETO A VARIACIÓN SIN PREVIO AVISO.</p>
  <p style="text-align:left;font-size: 5.5pt;line-height: 50%;">-LOS ENVIOS FUERA DE LIMA VAN POR CUENTA Y RIESGO DEL CLIENTE</p>
  <p style="text-align:left;font-size: 5.5pt;line-height: 50%;">-AL ENVIAR SU OX POR MONTOS MAYORES A $100, SIRVASE PASAR A RECOGER SU</p>
  <p style="text-align:left;font-size: 5.5pt;line-height: 50%;">MERCADERIA EN NUESTRO ALMACÉN.</p>
</div>
-->

</body>
</html>
