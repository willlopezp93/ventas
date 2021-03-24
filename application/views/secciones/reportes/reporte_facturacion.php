<div class="table-responsive">
  <table class="table" id="relacion_reporte">
    <thead>
      <tr>
        <th>TIPO</th>
        <th>NUMERO</th>
        <th>FECHA</th>
        <th>RUC</th>
        <th>RAZÓN.SOCIAL</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>UNID</th>
        <th>FAMILIA</th>
        <th>CANT</th>
        <th>COSTO</th>
        <th>PRE.UNI</th>
        <th>DSCT(%)</th>
        <th>SUBTOT</th>
        <th>VAL.VENTA</th>
        <th>VENDEDOR</th>
        <th>CLIENTE</th>
        <th>PEDIDO</th>
        <th>ORD.COMP</th>
        <th>REQUERI.</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($info as $key): ?>
        <tr>
          <td><?php echo $key->CFTD ?></td>
          <td><?php echo $key->CFNUMSER.'-'.$key->CFNUMDOC ?></td>
          <td><?php echo date('Y-m-d',strtotime($key->CFFECDOC)) ?></td>
          <td><?php echo $key->CFCODCLI ?></td>
          <td><?php echo $key->CFNOMBRE ?></td>
          <td><?php echo $key->DFCODIGO ?></td>
          <td><?php echo $key->DFDESCRI ?></td>
          <td><?php echo $key->DFUNIDAD ?></td>
          <td><?php echo $key->AFAMILIA ?></td>
          <td><?php echo number_format($key->DFCANTID,2,'.','') ?></td>
          <td><?php echo number_format($key->STKPREPROUS,2,'.','') ?></td>
          <td><?php echo number_format($key->DFPREC_ORI,2,'.','') ?></td>
          <td><?php echo number_format($key->DFPORDES,2,'.','') ?></td>
          <td><?php echo number_format($key->DFPREC_ORI*(100-$key->DFPORDES)/100,2,'.','')  ?></td>
          <td><?php echo number_format($key->DFCANTID*$key->DFPREC_ORI*(100-$key->DFPORDES)/100,2,'.','')  ?></td>
          <td><?php echo $key->Des_Ven ?></td>
          <td><?php echo $key->TIPO_CLIENTE ?></td>
          <?php foreach ($pedido as $key2): ?>
            <?php if ( $key->CFTD== $key2->CFTD and $key->CFNUMSER==$key2->CFNUMSER and $key->CFNUMDOC==$key2->CFNUMDOC): ?>
              <td><?php echo $key2->CFNROPED ?>  </td>
              <td><?php echo $key2->CFORDCOM ?>  </td>
            <?php endif; ?>
          <?php endforeach; ?>
          <td>
	<?php foreach ($pedido as $key2): ?>
	<?php if ( $key->CFTD== $key2->CFTD and $key->CFNUMSER==$key2->CFNUMSER and $key->CFNUMDOC==$key2->CFNUMDOC): ?>
          <?php foreach ($cotizacion as $key3): ?>
            <?php if ($key2->CFNROPED == $key3->cfnumped){
		echo $key3->CCREF; 
		} ?>       
          <?php endforeach; ?>
            <?php endif; ?>
          <?php endforeach; ?>
	</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>
