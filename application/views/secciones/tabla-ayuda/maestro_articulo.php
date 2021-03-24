<div class="table-responsive" id="tbl_maestro_articulos">
    <table class="table table-bordered table-hover" >
    <thead>
      <tr>
        <th>#</th>
        <th>Codigo</th>
        <th>Codigo Rockdrill</th>
        <th>Numero de Parte</th>
        <th>Codigo Cliente 1</th>
        <th>Codigo Cliente 2</th>
        <th>Codigo Cliente 3</th>
        <th>Codigo Cliente 4</th>
        <th>Descripcion</th>
        <th>Familia</th>
        <th>Unidad</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php $item=1; foreach ($articulos as $key): ?>
        <tr>
          <td><?php echo $item ?></td>
          <td><?php echo $key['acodigo'] ?></td>
          <td><?php echo $key['cod_rockdrill'] ?></td>
          <td><?php echo $key['num_parte'] ?></td>
          <td><?php echo $key['cod_cliente1'] ?></td>
          <td><?php echo $key['cod_cliente2'] ?></td>
          <td><?php echo $key['cod_cliente3'] ?></td>
          <td><?php echo $key['cod_cliente4'] ?></td>
          <td><?php echo $key['ADESCRI'] ?></td>
          <td><?php echo $key['AFAMILIA'] ?></td>
          <td><?php echo $key['AUNIDAD'] ?></td>
          <td><button type="button" class="editar" class="btn btn-primary" data-id="<?php echo $key['acodigo'] ?>">Editar</button>	</td>
        </tr>
      <?php $item++; endforeach; ?>
    </tbody>
  </table>
</div>
