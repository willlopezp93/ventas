<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Solicitud de Creacion de Código: <?php echo str_pad($correlativo, 7, "0", STR_PAD_LEFT) ?></h4>
				</div>

		        <div class="box-body">
              <form class="" method="post" id="form_cargainicial">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
										<input type="hidden" name="req_correlativo" value=<?php echo $correlativo ?> id="req_correlativo">
                    <label for="">Solicitante</label>
          					<select class="form-control select2" name="solicitante" id="solicitante" style="width: 100%;">
          						<option value="">.:Selección opcional</option>
          						<?php foreach ($solicitantes as $key): ?>
          								<option value="<?php echo $key->codigo ?>"><?php echo $key->fullname ?></option>
          						<?php endforeach; ?>
          					</select>
                  </div>
                </div>
                <div class="col-md-4" id="select-tipo">
                  <div class="form-group">
                    <label for="">Area</label>
                    <select class="form-control select2" name="area" id="area" style="width: 100%;">
                      <option value="">.:Selección opcional</option>
                      <?php foreach ($areas as $key): ?>
                          <option value="<?php echo $key->idcentrocosto ?>"><?php echo $key->descripcion ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

		        		</div>
								<div class="col-md-4">
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


                <div class="col-md-2">
                  <label for="">&nbsp;</label><br>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Agregar articulo</button>
                </div>
              </div>

						<br><br>
							<div class="row">
							  <div class="col-md-12">
									<div class="table-responsive" id="tbl_detalle">

										<!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/transferencia/detalle.php-->
										<table class="table table-bordered table-condensed table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>NOMBRE</th>
													<th>DESCRIPCION</th>
													<th>UNIDAD MEDIDA</th>
													<th>FICHA TECNICA</th>
													<th>CODIGO FABRICANTE</th>
													<th>EQUIPO</th>
													<th>SISTEMA</th>
													<th>SUB-SISTEMA</th>
													<th>PROVEEDOR</th>
													<th></th>
												</tr>
											</thead>
											<tbody id='info_detalle'>


											</tbody>
										</table>

										<!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/transferencia/detalle.php-->
									</div>





							  </div>
							</div>
							<div class="row" >
								<div class="col-md-12">
							  <button type="submit" name="button" id="btn_crearcodigo" class="btn btn-success btn-flat btn-block" >Generar Solicitud</button>
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
          <label for="">Nombre</label>
					<input type="text" class="form-control" name="sol_nombre" id="sol_nombre" required>

        </div>
        <div class="form-group">
          <label for="">Descripcion</label>
					<input type="text" class="form-control" name="sol_descripcion" id="sol_descripcion" required>

        </div>
        <div class="form-group">
          <label for="">Unidad de Medida</label>
          <input type="text" class="form-control" name="sol_unidad" id="sol_unidad" required>

        </div>
        <div class="form-group">
          <label for="">Ficha Tecnica(**)</label>
					<input type="text" class="form-control" name="sol_fichatecnica" id="sol_fichatecnica" placeholder="Solo aplica para repuestos pertenecientes a algun equipo de exploración o producción" >
        </div>
        <div class="form-group">
          <label for="">Proveedor</label>
					<input type="text" class="form-control" name="sol_proveedor" id="sol_proveedor">
        </div>
        <div class="form-group">
          <label for="">Codigo Fabricante(*)</label>
          <input type="text" class="form-control" name="sol_codigo_fab" id="sol_codigo_fab" placeholder="Solo aplica para repuestos pertenecientes a algun equipo">
        </div>
        <div class="form-group">
          <label for="">Equipo</label>
          <input type="text" class="form-control" name="sol_equipo" id="sol_equipo" placeholder="Solo aplica para repuestos pertenecientes a algun equipo">
        </div>
        <div class="form-group">
          <label for="">Sistema</label>
          <input type="text" class="form-control" name="sol_sistema" id="sol_sistema" placeholder="Solo aplica para repuestos pertenecientes a algun equipo de exploración o producción">
        </div>
        <div class="form-group">
          <label for="">Sub-Sistema</label>
          <input type="text" class="form-control" name="sol_subsistema" id="sol_subsistema" placeholder="Solo aplica para repuestos pertenecientes a algun equipo de exploración o producción">
        </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="btn_agregar_codigo">Agregar</button>
      </div>
    </div>
  </div>
</div>
