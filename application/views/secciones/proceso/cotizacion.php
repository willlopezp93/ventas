<div class="table-responsive" >
  <table class="table table-bordered table-condensed table-hover" id="tbl_lista">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Unidad</th>
        <th>Stock</th>
        <th>Precio</th>
        <th>Elegir</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($lista as $key): ?>
        <tr>
          <td><?php echo $key['articuloid'] ?></td>
          <td><?php echo $key['descripcion'] ?></td>
          <td><?php echo $key['unidad_med'] ?></td>
          <td><?php if ($key['STKPRIN']=='NULL' or $key['STKPRIN']=='') {
            echo 0;
          } else {
            echo number_format($key['STKPRIN']);
          } ?></td>
          <td><?php echo $key['precio_usd'] ?></td>
          <td><button type="button" class="btn btn-success elegir" data-id="<?php echo $key['articuloid'] ?>" name="button"><i class="glyphicon glyphicon-ok "></i></button> </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
