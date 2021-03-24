<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Direccion</th>
    </tr>
  </thead>
  <tbody>
    <?php $item=1; foreach ($direcciones as $key): ?>
      <tr>
        <td><?php echo $item ?></td>
        <td><?php echo $key->CDIRCLI ?></td>
      </tr>
    <?php $item=+1; endforeach; ?>
  </tbody>
</table>
