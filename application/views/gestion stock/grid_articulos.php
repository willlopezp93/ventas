

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Gestion de Stock de Artículos</h4>
				</div>

		        <div class="box-body">
		        	<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_stock">
		        			<thead>
		        				<tr>
		        					<th>Codigo</th>
		        					<th>Descripcion</th>
		        					<th>Stock Mínimo</th>
		        					<th>Stock Máximo</th>


		        				</tr>
		        			</thead>
		        			<tbody>
										<?php foreach ($stock as $key): ?>
											<tr>
												<td><?php echo $key['articuloid']; ?></td>
												<td><?php echo $key['descripcion']; ?></td>
												<td><?php echo $key['stskmin']; ?></td>
												<td><?php echo $key['stskmax']; ?></td>
											</tr>
										<?php endforeach; ?>
		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
	<!--modal editar-->
	<div class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" id="m_stock_edit">
	  <div class="modal-dialog modal-lg" role="document">
	  	<form method="post" id="stock_form">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title"><div id="modal_titulo"></div></h3>
	      </div>

	      <div class="modal-body">
	      		<div class="form-group">
					<div id="msg-error"></div>
				</div>

	      		<input type="hidden" name="txtIdusuario" id="txtIdUsuario">
				<input type="hidden" name="txtAccion" id="txtAccion">
				<div class="form-group">
					<label for="txtLugar">Código:</label>
						<select class="form-control select2 sel_codigo" style="width: 100%;" id="articuloid" name="articuloid">
					<option value="">Seleccionar un codigo</option>
							<?php foreach ($articulos as $key): ?>
								<option value="<?php echo $key->ACODIGO ?>"><?php echo $key->ACODIGO.' - '.$key->ADESCRI; ?></option>
							<?php endforeach; ?>
						</select>
				</div>
				<div class="form-group">
					<label for="txtLugar">Stock Mínimo:</label>
		            <input type="number" class="form-control" id="txtstskmin"  name="stskmin" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Stock Máximo:</label>
		            <input type="text" class="form-control" id="txtstskmax"  name="stskmax">
				</div>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" id="guardar_stock" >Guardar</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>
<!--fin modal editar-->

</section>
