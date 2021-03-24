
<br><br>
<div class="row">
  <div class="col-md-12">
<button type="button" name="button" id="guardar_meta" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right">Guardar</button>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-bordered table-hover" id="tbl_data">
    <thead>
      <tr>
        <th>Semana</th>
        <th>Monto Facturado</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($condicion==1): ?>
        <?php foreach ($suministro as $key): ?>
          <tr>
            <td class="semana"><?php echo $key->semana ?></td>
            <td class="monto"><input type="number" name="monto_facturado" class="form-control monto_facturado" value="<?php echo $key->monto_facturado ?>"> </td>
          </tr>
        <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td class="semana">S1</td>
            <td class="monto"><input type="number" name="monto_facturado" class="form-control monto_facturado" value="0"> </td>
          </tr>
          <tr>
            <td class="semana">S2</td>
            <td class="monto"><input type="number" name="monto_facturado" class="form-control monto_facturado" value="0"> </td>
          </tr>
          <tr>
            <td class="semana">S3</td>
            <td class="monto"><input type="number" name="monto_facturado" class="form-control monto_facturado" value="0"> </td>
          </tr>
          <tr>
            <td class="semana">S4</td>
            <td class="monto"><input type="number" name="monto_facturado" class="form-control monto_facturado" value="0"> </td>
          </tr>
          <tr>
            <td class="semana">S5</td>
            <td class="monto"><input type="number" name="monto_facturado" class="form-control monto_facturado" value="0"> </td>
          </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
