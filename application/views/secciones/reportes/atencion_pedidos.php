
<table class="table table-bordered table-hover" id="relacion_reporte">
  <thead>
    <tr>
      <th>#</th>
      <th>PEDIDO</th>
      <th>FEC.DOC</th>
      <th>ITEM</th>
      <th>CODIGO</th>
      <th>DESCRIP</th>
      <th>CANTID</th>
      <th>TOTAL</th>
      <th>FEC.ENTREGA</th>
      <th>INDICADOR</th>
    </tr>
  </thead>
  <tbody>
    <?php $item=1; foreach ($detalle_ss as $key): ?>
      <tr>
        <td><?php echo $item ?></td>
        <td><?php echo $key->DFNUMPED ?></td>
        <td><?php echo $key->CFFECDOC ?></td>
        <td><?php echo $key->DFSECUEN ?></td>
        <td><?php echo $key->DFCODIGO ?></td>
        <td><?php echo $key->DFDESCRI ?></td>
        <td><?php echo $key->DFCANTID ?></td>
        <td><?php echo $key->DFIMPUS ?></td>
        <?php foreach ($detalle as $key1) {
          if ($key->DFSECUEN==$key1->DFSECUEN AND $key->DFNUMPED==$key1->DFNUMPED) {
            if ($key1->DFFECENT_ALM == NULL) {
              $fec_entrega= date('Y-m-d',strtotime($key1->DFFECENT_ALM));
            } else {
              $fec_entrega= date('Y-m-d',strtotime($key1->DFFECENT));
            }
          }
        } ?>
        <td><?php echo $fec_entrega ?></td>
        <?php if ($fec_entrega<date('Y-m-d')): ?>
          <td><?php echo 'NORMAL'?></td>
          <?php else: ?>
            <?php if ($turno=='mañana'): ?>
                <?php if (date('H')>8 and date('H')<14): ?>
                  <?php echo 'MUY URGENTE' ?>
                <?php else: ?>
                  <?php echo 'URGENTE' ?>
                <?php endif; ?>
              <?php else: ?>
                <?php if (date('H')<=8 and date('H')>=14): ?>
                    <?php echo 'MUY URGENTE' ?>
                  <?php else: ?>
                    <?php echo 'URGENTE' ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
      </tr>
    <?php $item++; endforeach; ?>
  </tbody>
</table>
