
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>QUOTATION # <?php echo str_pad($cabecera['CCNUMDOC'], 7, "0", STR_PAD_LEFT) ?> </title>

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
                NUMBER PHONE :518-7100 <br>
            </center>
          </td>
                    <td  style="width:31px;color:white;height:8pt;font-size:6pt"> hola</td>
          <td style="width: 31px;color:white;height:8pt;font-size:6pt"> hola</td>
          <td style="width:144px; color:white;height:8pt;font-size:6pt"> hola</td>

        </tr>

        <tr>
                      <td style="border: 1px solid white">&nbsp;</td>
            <td style="">&nbsp;</td>
            <td style="border: 1px solid black;height: 35px;background-color:#1C5076;color:white;font-size:10pt;text-align:center"><b>N° QUOTATION</b> </td>

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
  <th style="font-size: 9pt;width:147px;height: 13pt;  border-right: 1px solid black;‬border-left: 1px solid black;‬border-top:1px solid black"><div>&nbsp;CLIENT<br></div></th>
  <td  style="font-size: 8pt;width:300px;height: 13pt;  border-right: 1px solid black;border-left: 1px solid black;border-top:1px solid black"><div><?php echo ($cabecera['CCNOMBRE']); ?><br></div></td>
  <th style="font-size: 9pt;width:147px;height: 13pt;  border-right: 1px solid black;border-left: 1px solid black;border-top:1px solid black"><div>&nbsp;DATE<br></div></th>
  <td style="font-size: 8pt;width:150px;height: 13pt‬;  border-right: 1px solid black;border-left: 1px solid black;border-top:1px solid black"><div><?php echo date('d-m-Y',strtotime($cabecera['CCFECDOC'])); ?><br></div></td>
  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;ADDRESS <br></div></th>
  <td style="font-size: 5.5pt;width:102;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CDIRFISC']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;" ><div>&nbsp;COMMERCIAL ADVISOR<br></div></th>
  <td style="font-size: 8pt;width:101;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CCVENDE'] ?><br></div></td>
  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;TAX<br></div></th>
  <td style="font-size: 8pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CCRUC']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;<br></div></th>
  <td style="font-size: 8pt;width:101;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><br></div></td>
  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;CONTACT <br></div></th>
  <td style="font-size: 8pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['COD_CONTACTO']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div>&nbsp;REQUEST<br></div></th>
  <td style="font-size: 8pt;width:101;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;"><div><?php echo $cabecera['CCREF']; ?><br></div></td>

  </tr>
  <tr>
  <th style="font-size: 9pt;width:102;height: 13pt;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black‬"><div>&nbsp;EMAIL	<br></div></th>
  <td style="font-size: 8pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black"><div><?php echo $cabecera['EMAIL']; ?><br></div></td>
  <th style="font-size: 9pt;width:102;height: 13pt‬;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black"><div>&nbsp;QUOTED BY</div></th>
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
      <th style="width: 60;font-size: 8pt;border:1px solid black"><center>CODE</center></th>
      <th colspan="6" style="width: 180;font-size: 8pt;border:1px solid black"><center>DESCRIPTION</center></th>
      <th style="width: 35;font-size: 8pt;border:1px solid black"><center>ESTIMATED TIME</center></th>
      <th style="width: 10;font-size: 8pt;border:1px solid black"><center>QTY.</center></th>
      <th style="width: 10;font-size: 8pt;border:1px solid black"><center>U.M.</center></th>
      <th style="width: 20;font-size: 8pt;border:1px solid black"><center>UP</center></th>
      <th style="width: 30;font-size: 8pt;border:1px solid black"><center>%DTO.</center></th>
      <th style="width: 35;font-size: 8pt;border:1px solid black"><center>UP NET</center></th>
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
              <?php echo "STOCK" ?>
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
      <td height="20px"  colspan="5" style="border:1px solid black; font-size:5.5pt"><b>VALIDITY OF THE QUOTE:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;30 BUSINESS DAYS  </td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:5.5pt"><b>DELIVERY TIME:</b>&nbsp;&nbsp; PRIOR PO AND AVAILABLE IN STOCK </td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:7pt">SUBTOTAL</td>
      <td height="20px" style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <?php $subtotal= ($cabecera['CCIMPORTE']-$cabecera['CCIGV'])+$cabecera['CCDESVAL']?>
      <td height="20px" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($subtotal,2,'.',','); ?></div></td>
    </tr>
    <tr class="fijo">
      <td height="20px" colspan="5" style="border:1px solid black; font-size:5.5pt"><b>PAYMENT CONDITIONS:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "CASH AGAINST DELIVERY" ?> </td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:5.5pt"><b>CURRENCY:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "US DOLLARS"; ?></td>
      <td colspan="4" style="border:1px solid black; font-size:7pt">DISCOUNT</td>
      <td style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <td style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($cabecera['CCDESVAL'],2,'.',','); ?></div></td>
    </tr>
    <tr class="fijo">
      <td height="20px" colspan="5" style="border:1px solid black; font-size:6pt"><b>PLACE OF DELIVERY:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php if ($cabecera['CCTIPCOTIZA']=='EXT'): ?>
          <?php echo "PICK UP IN OUR WAREHOUSE " ?>
          <?php else: ?>
            <?php if ($cabecera['CCIMPORTE']>100): ?><?php echo "OUR WAREHOUSE" ?><?php else: ?><?php echo "PICK UP IN OUR WAREHOUSE" ?><?php endif; ?>
        <?php endif; ?>
        </td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:6pt"><b>TOTAL WEIGHTL:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cabecera['PESO'] ?>kg</td>
      <td height="20px" colspan="4" style="border:1px solid black; font-size:7pt">SALE VALUE</td>
      <td height="20px" style="border:1px solid black; font-size:7pt"><?php if($cabecera['CCCODMON']=="ME"){echo "USD";}else{echo "SOL";} ?></td>
      <td height="20px" style="border:1px solid black; font-size:7pt;text-align: right"><?php echo number_format($cabecera['CCIMPORTE']-$cabecera['CCIGV'],2,'.',','); ?></div></td>
    </tr>
    <tr>
      <td colspan="15" height="20px" style="border:1px solid black; font-size:7pt"><b>OUR CURRENT ACCOUNTS IN DOLLARS <br>
CODE SWIFT/BIC BCP: BCPLPEPL <br>
CODE SWIFT/BIC SCOTIABANK: BSUDPEPL</b> </td>
    </tr>
    		</tbody>
    </table>

</body>
</html>
