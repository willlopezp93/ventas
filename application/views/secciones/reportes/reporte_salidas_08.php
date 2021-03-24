<div class="table-responsive">
  <table class="table" id="relacion_reporte">
    <thead>
      <tr>
        <th>DOCUMENTO</th>
        <th>FECHA</th>
        <th>ITEM</th>
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>UNID</th>
        <th>CANTIDAD</th>
        <th>COSTO</th>
        <th>TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($info as $key): ?>
        <tr>
          <td><?php echo $key->DENUMDOC ?></td>
          <td><?php echo date('Y-m-d',strtotime($key->CAFECDOC)) ?></td>
          <td><?php echo $key->DEITEM ?></td>
          <td><?php echo $key->DECODIGO ?></td>
          <td><?php echo $key->DEDESCRI ?></td>
          <td><?php echo $key->DEUNIDAD ?></td>
          <td><?php echo number_format($key->DECANTID,2,'.','') ?></td>
          <td><?php echo number_format($key->DEIMPUS,2,'.','') ?></td>
          <td><?php echo number_format($key->DEIMPUS*$key->DECANTID,2,'.','') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
