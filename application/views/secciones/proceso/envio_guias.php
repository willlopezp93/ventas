<br>
<div class="row">
  <div class="col-md-12">
    <input type="file" id="file" class="form-control" name="file" value="">
  </div>
</div><br>
<table class="table table-condensed table-bordered" id="tbl_detalle">
  <thead>
    <tr>
      <th>ALMACEN</th>
      <th>ITEM</th>
      <th>CODIGO</th>
      <th>DESCRIPCION</th>
      <th>CANTIDAD</th>
      <th>CC</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle_ss as $key): ?>
      <tr>
        <td class="DEALMA"><?php echo $key->DEALMA ?></td>
        <td class="DEITEM"><?php echo $key->DEITEM ?></td>
        <td class="DECODIGO"><?php echo $key->DECODIGO ?></td>
        <td class="DEDESCRI"><?php echo $key->DEDESCRI ?></td>
        <td class="DECANTID"><?php echo number_format($key->DECANTID) ?></td>
        <td class="DECENCOS"><?php echo ($key->DECENCOS )?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="row">
  <div class="col-md-12">
    <div class="btn-group">
      <button type="button" class="btn btn-info btn-lg" id="notificar" name="button">Notificar</button>
    </div>
  </div>
</div>
