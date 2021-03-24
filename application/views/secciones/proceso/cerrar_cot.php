
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
  <?php if ($key->CDCANTPEN!=0): ?>
    <tr>
      <td class="CDSECUEN"><?php echo $key->CDSECUEN ?></td>
      <td class="CDCODIGO" style="display:none"><?php echo $key->CDCODIGO ?></td>
      <td class="CDDESCRI"><?php echo $key->CDDESCRI ?></td>
      <td class="CDCANTPEN"><?php echo number_format($key->CDCANTPEN,2) ?></td>
      <td class="MONTO"><?php echo number_format(($key->CDCANTPEN*$key->CDPORDES*$key->CDPREC_ORI)/100,2) ?></td>
      <td class="ESTADO"> <select class="form-control estado" name="">
        <option value="">Elegir Estado</option>
        <?php foreach ($estado as $row): ?>
          <option value="<?php echo $row->id_estado ?>"><?php echo $row->descripcion ?></option>
        <?php endforeach; ?>
      </select> </td>
    </tr>
  <?php endif; ?>
<?php endforeach; ?>


  </tbody>
</table>
</div>
