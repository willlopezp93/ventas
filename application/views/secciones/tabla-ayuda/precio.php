<div class="table-responsive" id="tbl_maestro_articulos">
    <table class="table table-bordered table-hover" >
    <thead>
      <tr>
        <th>#</th>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Precios</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php $item=1; foreach ($precio as $key): ?>
        <tr>
          <td><?php echo $item ?></td>
          <td><?php echo $key['articuloid'] ?></td>
          <td><?php echo $key['descripcion'] ?></td>
          <td><?php echo $key['precio'] ?></td>
          <td><button type="button" class="editar" class="btn btn-primary" data-id="<?php echo $key['articuloid'] ?>">Editar</button>	</td>
        </tr>
      <?php $item++; endforeach; ?>
    </tbody>
  </table>
</div>
