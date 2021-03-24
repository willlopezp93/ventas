<br><br>
<table class="table table-bordered table-condensed table-hover" id="relacion_reporte" style="font-size:9pt">
  <thead>
    <tr>
      <th>COT</th>
      <th>FECHA</th>
      <th>CLIENTE</th>
      <th>RUC</th>
      <th>CODIGO</th>
      <th>DESCRIPCIÓN</th>
      <th>CANT</th>
      <th>UNID</th>
      <th>FAM</th>
      <th>PU</th>
      <th>DSCTO</th>
      <th>P.NETO</th>
      <th>COSTO PROM</th>
      <th>ULT.COSTO</th>
      <th>PLAZO</th>
      <th>REQ.</th>
      <th>VENDEDOR</th>
      <th>COTIZADOR</th>
      <th>ESTADO</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle as $key): ?>
      <tr>
        <td><?php echo $key->CDNUMDOC ?></td>
        <td><?php echo date('d-m-y',strtotime($key->CCFECDOC)) ?></td>
        <td style="width:200pt"><?php echo $key->CCNOMBRE ?></td>
        <td><?php echo $key->CCCODCLI ?></td>
        <td style="width:80pt"><?php echo $key->CDCODIGO ?></td>
        <td style="width:400pt"><?php echo $key->CDDESCRI ?></td>
        <td><?php echo number_format($key->CDCANTID) ?></td>
        <td><?php echo $key->CDUNIDAD ?></td>
        <td><?php echo $key->CDFAMILIA ?></td>
        <?php if ($key->CCCODMON=='ME'): ?>
        <td><?php echo str_replace(',','',number_format($key->CDPREC_ORI,2)) ?></td>
        <?php else: ?>
        <td><?php echo str_replace(',','',number_format($key->CDPREC_ORI/$key->CCTIPCAM,2 ))?></td>
        <?php endif; ?>
        <td><?php echo str_replace(',','',number_format($key->CDPORDES/100,2)) ?></td>
        <?php if ($key->CCCODMON=='ME'): ?>
        <td><?php echo str_replace(',','',number_format(($key->CDPREC_ORI)*(100-$key->CDPORDES)/100,2))  ?></td>
        <?php else: ?>
        <td><?php echo str_replace(',','',number_format(($key->CDPREC_ORI/$key->CCTIPCAM)*(100-$key->CDPORDES)/100,2 )) ?></td>
        <?php endif; ?>
        <td><?php echo str_replace(',','',number_format($key->costo_ref,2))  ?></td>
        <td><?php echo  str_replace(',','',number_format($key->costo1,2)) ?></td>
        <?php if ($key->PLAZO==0): ?>
                <td><?php echo "INMEDIATO"?></td>
        <?php else: ?>
          <td><?php echo $key->PLAZO ?> DH</td>
        <?php endif; ?>
        <td><?php echo $key->CCREF ?></td>
        <td><?php foreach ($vendedor as $key1): ?>
          <?php if ($key->CCVENDE==$key1->cod_ven): ?>
            <?php echo $key1->Des_Ven ?>
          <?php endif; ?>
        <?php endforeach; ?></td>
        <td><?php echo $key->cotizador ?></td>
        <td><?php echo $key->CDESTADO ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
