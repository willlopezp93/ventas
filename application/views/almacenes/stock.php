<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Stock de Artículos</h4>
				</div>

		        <div class="box-body">
							<div class="row">
								<div class="col-md-3">
									<label for="">Almacén</label>
									<select class="form-control" id="almacen">
										<option value="0">.:Seleccione Almacen:.</option>
										<?php foreach ($almacen as $key): ?>
											<option value="<?php echo $key->taalma ?>"><?php echo $key->taalma.' - '.$key->tadescri ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div id="msg">

							</div>
							<br>
		        	<div class="table-responsive" id="tbl_stock">

		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>
