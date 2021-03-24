
<div class="table-responsive" id="tbl_detalle">
  <table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>item</th>
      <th style="display:none">Codigo</th>
      <th>Descripcion</th>
      <th>Cantidad Pendiente</th>
      <th>Monto</th>
      <th>Estado</th>
     </tr>
  </thead>
  <tbody>
<?php foreach ($detalle as $key): ?>

    <tr>
      <td class="CDSECUEN"><?php echo $key->CDSECUEN ?></td>
      <td class="CDCODIGO" style="display:none"><?php echo $key->CDCODIGO ?></td>
      <td class="CDDESCRI"><?php echo $key->CDDESCRI ?></td>
      <td class="CDCANTPEN"><?php echo number_format($key->CDCANTPEN,2) ?></td>
      <td class="MONTO"><?php echo number_format(($key->CDCANTPEN*$key->CDPORDES*$key->CDPREC_ORI)/100,2) ?></td>
      <td class="ESTADO"> <?php foreach ($estado as $row): ?>
        <?php if ($row->id_estado==$key->CDESTADO): ?>
          <?php echo $row->descripcion ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </td>
    </tr>

<?php endforeach; ?>


  </tbody>
</table>
</div>
