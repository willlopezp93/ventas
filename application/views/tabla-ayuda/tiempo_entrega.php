<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Tiempo de Entrega</h4>
				</div>

		        <div class="box-body">
              <div class="row">
                <div class="col-md-2">
                  <button type="button" class="btn btn-primary" id="nuevo_tiempo" name="button">Nuevo Tiempo de Entrega</button>
                </div>
              </div>
							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_tiempo_entregas">
		        			<thead>
                    <tr>
                      <th>#</th>
                      <th>Tiempo de Entrega</th>
                      <th>Acciones</th>
                    </tr>

		        			</thead>
		        			<tbody>
                      <?php $item=1; foreach ($tiempo as $key): ?>
                        <tr>
                          <td><?php echo $item ?></td>
                          <td><?php echo $key->texto ?></td>
                        	<?php if ($key->texto!='Editable' and $key->texto!='Inmediato' ): ?>
														<td><button type="button" class="btn btn-primary btn-xs editar-tiempo_entrega" data-id="<?php echo $key->idtiempo ?>" data-nombre="<?php echo $key->plazo ?>"><i class="glyphicon glyphicon-pencil"></i></button>
														<button type="button" class="btn btn-danger btn-xs eliminar" data-id="<?php echo $key->idtiempo ?>"><i class="glyphicon glyphicon-trash"></i></button></td>
                        	<?php endif; ?>
                        </tr>
                      <?php $item++; endforeach; ?>
		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="nueva_tiempo_entrega"  role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="" id="form_tiempo_entrega" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Nueva Tiempo de Entrega</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Tiempo de Entrega:</label>
          <input type="text" class="form-control" id="tiempo_entrega" placeholder="" name="tiempo_entrega" required>
        </div>
        <input type="hidden" name="idtiempo_entrega" value="" id="idtiempo_entrega">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
