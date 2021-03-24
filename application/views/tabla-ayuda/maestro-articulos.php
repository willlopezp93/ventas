

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Maestro de articulos activos STARSOFT</h4>
				</div>

		        <div class="box-body">
							<div class="row">
								<div class="col-md-3">
									<select class="form-control" id="tipo">
										<option value="acodigo">Codigo</option>
										<option value="descripcion">Descripcion</option>
										<option value="cod_rockdrill">Codigo Rockdrill</option>
										<option value="num_parte">Numero de Parte</option>
										<option value="cod_cliente1">Codigo Cliente 1</option>
										<option value="cod_cliente2">Codigo Cliente 2</option>
										<option value="cod_cliente3">Codigo Cliente 3</option>
										<option value="cod_cliente4">Codigo Cliente 4</option>
									</select>
								</div>

							</div>
							<br>
							<div class="row">
								<div class="col-md-10">
									<input type="text" class="form-control"  id="cadena" value="">
								</div>
								<div class="col-md-1">
									<button type="button" class="btn btn-info" id="buscar" name="button"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
										<br>			<br>
		        	<div class="table-responsive" id="tbl_maestro_articulos">

		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>


<div class="modal fade" role="dialog" id="editar_articulo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
				<form id="form_editar"  method="post">
					<div class="form-group">
						<br>
						<input type="hidden" name="articuloid" id="articuloid" value="">
						<input type="hidden" name="unidad_med" id="unidad_med" value="">
							<div class="row">
								<div class="col-md-3">
									<label>Numero Parte</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="num_parte" id="num_parte" value="">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label>Codigo Rockdrill</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cod_rockdrill" id="cod_rockdrill" value="">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label>Codigo Cliente 1</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cod_cliente1" id="cod_cliente1" value="">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label>Codigo Cliente 2</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cod_cliente2" id="cod_cliente2" value="">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label>Codigo Cliente 3</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cod_cliente3" id="cod_cliente3" value="">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label>Codigo Cliente 4</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cod_cliente4" id="cod_cliente4" value="">
								</div>
							</div>
							<br>
							<br>
							<div id="msg">

							</div>
					</div>
				</form>
      </div>
      <div class="modal-footer">
				<button type="button" id="grabar" class="btn btn-primary">Grabar</button>
        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
