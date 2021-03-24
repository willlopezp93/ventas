<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Cotizacion</h4>
				</div>

		        <div class="box-body">
              <form class="" method="post" id="form_cargainicial">

              <div class="row">

		        		<div class="col-md-3" id="">
									<div class="form-group">
										<label for="">Cargo</label>
									<input type="text" class="form-control" name="cargo" id="cargo" placeholder="Ingrese su cargo actual">
		        		<!--	<label for="">Centro de costo</label>
		        			<input type="text" name="centrocosto" value="
									 #echo substr($this->session->alm_cc,-4)?
									" class="form-control" readonly>-->
									</div>
		        		</div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Fecha emision</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="fecha_doc" name="fecha_doc" value="<?php echo date('Y-m-d') ?>" readonly>
                      </div>

                    </div>
                  </div>

		        	</div>

              <div class="row">
                <div class="col-md-12">

                </div>
              </div>
							<div class="row">
	              <div class="col-md-12">


										  <button type="button" name="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Agregar articulo</button>


	                <br><br>
	                <div class="table-responsive" >

										<!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/requerimiento/detalle.php-->
										<table class="table table-bordered table-condensed table-hover" id="tbl_detalle">
										<thead>
										    <tr>

										      <th>Codigo</th>

										      <th>Prioridad</th>
										      <th>Destino</th>
										      <th>Cantidad</th>
										      <th>Observaciones</th>

										      <th></th>
										    </tr>
											</thead>
											<tbody id="info_detalle">

											</tbody>
										</table>

										<!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/requerimiento/detalle.php-->
	                </div>
	              </div>
	            </div>
							<div class="row">
								<div class="col-md-12">
								 	<button type="submit" name="button" class="btn btn-success btn-flat btn-block" id="btn_confirmar_req">Generar Requerimiento</button>
								</div>
							</div>
					   </form>
 				 </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo articulo</h4>
      </div>

      <div class="modal-body">
        <form id="form_carga_manual" method="post">

        <div class="form-group">
          <label for="">Codigo</label>
					<input type="text" id="itemcodigo" name="itemcodigo" value="">
        </div>
        <div class="form-group">
          <label for="">Cantidad</label>
          <input type="number" class="form-control" name="cant_req" id="cant_req" placeholder="" required>

        </div>

				<div class="form-group">
					<label for="">Observaciones</label>
					<textarea name="observaciones" id="observaciones" rows="1"  class="form-control"></textarea>

				</div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<input type="submit" class="btn btn-primary" name="" id="btn_agregar_codigo" value="Agregar Articulo">

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="stockminimo"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Seleccione los artículos</h4>
      </div>

      <div class="modal-body">
        <form id="form_carga_stockminimo" method="post">
					<div class="row">
						<select class="" name="">
							<option value="acodigo">Codigo</option>
							<option value="cod_rockdrill">Codigo Rockdrill</option>
							<option value="num_parte">Numero de Parte</option>
							<option value="cod_cliente1">Codigo Cliente 1</option>
							<option value="cod_cliente2">Codigo Cliente 2</option>
							<option value="cod_cliente3">Codigo Cliente 3</option>
							<option value="cod_cliente4">Codigo Cliente 4</option>
						</select>
						<input type="text" name="" value="">
						<button type="button" id="buscar" name="button"></button>
					</div>
					<div class="table-responsive" id="tbl_stockmin">


						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>Stock Actual</th>
									<th>Cantidad</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tbody>


							</tbody>
						</table>


					</div>



        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_agregar_stk">Agregar</button>
      </div>
    </div>
  </div>
</div>
