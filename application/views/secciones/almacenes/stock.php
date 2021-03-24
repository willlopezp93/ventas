<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Codigo</th>
      <th>Descripcion</th>
      <th>Unidad</th>
      <th>Cantidad</th>

    </tr>
  </thead>
  <tbody>
    <?php $item=1; foreach ($stock as $key): ?>
       <tr>
         <td><?php echo $item ?></td>
         <td><?php echo $key->stcodigo ?></td>
         <td><?php echo $key->adescri ?></td>
         <td><?php echo $key->AUNIDAD ?></td>
         <td><?php echo number_format($key->stskdis) ?></td>

       </tr>
    <?php $item++; endforeach; ?>
  </tbody>
</table>
