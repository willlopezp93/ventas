<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Contactos</th>
      <th>Telefono</th>
      <th>Area</th>
      <th>Cargo</th>
    </tr>
  </thead>
  <tbody>
    <?php $item=1; foreach ($contacto as $key): ?>
      <tr>
        <td><?php echo $item ?></td>
        <td><?php echo $key->contacto ?></td>
        <td><?php echo $key->telefono ?></td>
        <td><?php echo $key->correo ?></td>
        <td><?php echo $key->area ?></td>
        <td><?php echo $key->cargo ?></td>
      </tr>
    <?php $item=+1; endforeach; ?>
  </tbody>
</table>
