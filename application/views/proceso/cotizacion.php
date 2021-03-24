<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Cotizacion: N° <?php echo str_pad($correlativo, 7, "0", STR_PAD_LEFT)  ?></h4>
				</div>


		        <div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-info"></i> Tener en cuenta!</h4>
									<p style="font-size:9pt">Es importante indicar la dirección de entrega para evitar el error al generar el pedido. Si en caso el campo esté vacío en el actual formulario, por favor revisar en la tabla Clientes en el programa <b>STARSOFT GE</b> que las direcciones del cliente se encuentren registradas</p>
								</div>
								</div>
							</div>
              <form class="" method="post" id="form_cotizacion">
              <div class="row">
								<div class="col-md-2" id="">
									<div class="form-group">
										<label for="">Tipo de Cotizacion</label>
										<select  class="form-control " name="tipocot" id="tipocot">
											<option value="NAC">Nacional</option>
											<option value="EXT">Extranjero</option>
										</select>
									</div>
								</div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Fecha emision</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="fecha_doc" name="fecha_doc" value="<?php echo date('Y-m-d') ?>" >
                      </div>

                    </div>
                  </div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="">Tipo de Cambio</label>
										<input type="text" readonly  class="form-control" name="tipocambio" id="tipocambio">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="">Moneda</label>
											<select class="form-control" id="moneda" name="moneda">
												<option value="ME">ME</option>
												<option value="MN">MN</option>

											</select>
										</div>
									</div>
		        	</div>
							<div class="row">
										        		<div class="col-md-3" id="">
																	<div class="form-group">
																		<label for="">Cliente</label>
																	<select  class="form-control select2" name="cliente" id="cliente">
																		<option value="">Seleccionar cliente</option>
																	</select>

																	</div>
										        		</div>
																<div class="col-md-3" id="">
																	<div class="form-group">
																		<label for="">Persona Contacto</label>

																	<select  class="form-control select2" name="contacto" id="contacto">
																		<option value="">Seleccionar contacto</option>
																	</select>

																	</div>
										        		</div>
								<div class="col-md-4" id="">
									<div class="form-group">
										<label for="">Dirección de Entrega</label>
									<select  class="form-control" name="direccion" id="direccion">
											<option value="">Seleccionar direccion</option>
									</select>
									<input type="hidden" class="form-control" id="vendedor" name="vendedor">
									</div>
								</div>

		        	</div>
              <div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Doc.referencia</label>
											<input type="text" class="form-control" id="doc_ref" name="doc_ref"  >


									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Forma de Pago</label>
									<select  class="form-control" name="forma_pago" id="forma_pago">

									</select>
									<input type="hidden" class="form-control" name="descuento" id="descuento" >
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">Pto. Venta</label>
									<select  class="form-control select2" name="pto_venta" id="pto_venta">

									</select>

									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">Especificar Almacen</label>
									<select  class="form-control" name="especificar_almacen" id="especificar_almacen">
										<option value="SU ALMACEN">SU ALMACÉN</option>
										<option value="NUESTRO ALMACEN">NUESTRO ALMACÉN</option>
									</select>
									</div>
								</div>
              </div>
							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary pull-right" id="analisis_btn" >Analisis</button>
									<button type="button" class="btn btn-warning pull-right" id="agregar_codigo_excel" data-toggle="modal" data-target="#cargardesdeexcel">Cargar excel</button>
									 <button type="button" name="button" id="agregar_codigo" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right">Agregar articulo</button>
									 						<input type="hidden" id="precioori">
								</div>
							</div>

							<div class="row">
	              <div class="col-md-12">



	                <br><br>
	                <div class="table-responsive" id="tbl_detalle">

										<!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/requerimiento/detalle.php-->
										<table class="table  tablesorter" >
										<thead>
										    <tr>

										      <th>Codigo</th>
										      <th>Descripcion</th>
										      <th>Unidad</th>
													<th>Cantidad</th>
										      <th>Plazo</th>
													<th>P.Lista</th>
													<th>Dscto.</th>
													<th>P.Neto</th>
													<th>Sub Total</th>

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
								<div class="col-md-9">

								</div>
								<div class="col-md-1">
									<label>Subtotal</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" id="subtotal" name="subtotal" readonly value="">
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-7">

								</div>
								<div class="col-md-2">
									<div class="col-md-3">

									</div>
									<div class="col-md-2">
										<label>%</label>
									</div>
									<div class="col-md-7">
										<input type="text" class="form-control" name="descuento_esp" id="descuento_esp" value="0">
									</div>
								</div>
								<div class="col-md-1">
									<label>Dscto.Esp</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" style="color:red" id="dsct_esp_valor" name="dsct_esp_valor" readonly value="">
								</div>
							</div>-->
							<div class="row">
								<div class="col-md-7">

								</div>
								<div class="col-md-2">
									<div class="col-md-3">

									</div>
									<div class="col-md-2">

									</div>
									<div class="col-md-7">
										<!--<input type="text" class="form-control" name="descuento" id="descuento" value="0.25">-->
									</div>
								</div>
								<div class="col-md-1">
									<label>Dscto.Cliente</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control"  id="dsct_cliente_valor" name="dsct_cliente_valor" readonly value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">

								</div>
								<div class="col-md-1">
									<label>Valor Venta</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" id="valor_venta" name="valor_venta" readonly value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
								</div>
								<div class="col-md-1">
									<label>IGV</label>
								</div>
								<div class="col-md-2">
									<input type="hidden" name="igvpor" id="igvpor" value="0.18">
									<input type="text" class="form-control"  id="igv" name="igv" readonly value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
								</div>
								<div class="col-md-1">
									<label>TOTAL</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" id="total_doc" name="total_doc" readonly value="">
								</div>
							</div>
							<br><br>
							<div class="row">
								<div class="col-md-12">
								 	<button type="button" name="button" class="btn btn-success btn-flat btn-block" id="btn_generar_cot">Generar Cotización</button>
								</div>
							</div>
							<br>
							<div id="msg">

							</div>
					   </form>
 				 </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo articulo</h4>
      </div>

      <div class="modal-body">

					<div class="row">
						<div class="col-md-6">
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
							<input type="hidden" name="almacen" id="almacen" value="01">
						</div>
						<div class="col-md-1">
							<button type="button" class="btn btn-info" id="buscar" name="button"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
					<div class="table-responsive" id="tbl_lista">

					</div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
    </div>
  </div>
</div>

<div class="modal fade" id="cargardesdeexcel"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargar excel <a href="<?php echo base_url();?>assets/files/Carga-Cotizacion.xlsx" class="btn btn-info btn-xs"><i class="far fa-file-excel"></i>Plantilla</a></h4>
      </div>
      <div class="modal-body">
				<div class="modal-body">
						<form  method="post" enctype="multipart/form-data" id=form_envio_excel>
						<div class="form-group">
						  <label for="">Excel</label>
						  <input type="file" class="form-control" id="excel" name="excelfile" accept=".xls, .xlsx">
						  <p class="help-block">Acomodar la información en la plantilla.</p>
						</div>
						</form>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_cargaexcel">Cargar códigos</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="analisis"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Analisis de Precios</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<div class="modal-body">
          <form id="form_analisis" method="post">
            <div class="table-responsive" id="tbl_analisis">

            </div>

          </form>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalpedido"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<div class="modal-body">
          <form id="form_detalle" method="post">
            <input type="hidden" id="cotizacion" name='cotizacion' value=''>
            <div class="table-responsive" id="tbl_pedido">

            </div>

          </form>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="crear_pedido">Crear Pedido</button>
      </div>
    </div>
  </div>
</div>
