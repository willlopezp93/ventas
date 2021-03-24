<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-2">
							<a type="button" class="btn btn-primary" href="<?php echo base_url() ?>Inicio/consultar_cotizaciones">Atras</a>
						</div>
					</div>
					<br>
					<h4>Cotizacion: N° <?php echo str_pad($correlativo, 7, "0", STR_PAD_LEFT)  ?></h4>
				</div>


		        <div class="box-body">
              <form class="" method="post" id="form_cotizacion">

								<div class="row" id="button" <?php if ($transaccion=='duplicar'): ?>
									<?php echo 'style="display:none"' ?>
								<?php endif; ?>>
									<div class="col-md-6">

									</div>
									<div class="col-md-2">
										<input type="hidden" id="numdoc" name="numdoc" value="<?php echo $correlativo ?>">
									</div>
								<!--	<div class="col-md-2">

											<button type="button" class="btn btn-primary" id="generar_pedido" data-toggle="modal" data-target="#modalpedido">Generar Pedido</button>

									</div>-->
									<div class="col-md-2" >
										<button type="button" class="btn btn-primary"  id="duplicar_cotizacion">Duplicar Cotización</button>
									</div>
								</div>
              <div class="row">
								<div class="col-md-2" id="">
									<div class="form-group">
										<label for="">Tipo de Cotizacion</label>
										<select  class="form-control " name="tipocot" id="tipocot">
											<option value="NAC" <?php if ($cabecera->CCTIPCOTIZA=='NAC'): ?>
                        <?php echo "selected" ?>
                      <?php endif; ?>>Nacional</option>
											<option value="EXT" <?php if ($cabecera->CCTIPCOTIZA=='EXT'): ?>
                        <?php echo "selected" ?>
                      <?php endif; ?>>Extranjero</option>
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
												<option value="00">Seleccione</option>
												<option value="MN" <?php if ($cabecera->CCCODMON=='MN'): ?>
													<?php echo "selected" ?>
												<?php endif; ?>>MN</option>
												<option value="ME" <?php if ($cabecera->CCCODMON=='ME'): ?>
													<?php echo "selected" ?>
												<?php endif; ?>>ME</option>
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
                                    <?php foreach ($cliente as $key): ?>
                                      <option value="<?php echo $key->ccodcli ?>"<?php if ($key->ccodcli == $cabecera->CCCODCLI): ?>
                                        <?php echo "selected" ?>
                                      <?php endif; ?>><?php echo $key->cnomcli ?></option>
                                    <?php endforeach; ?>
																	</select>

																	</div>
										        		</div>
																<div class="col-md-3" id="">
																	<div class="form-group">
																		<label for="">Persona Contacto</label>
                                    <input type="hidden" name="contacto_dup" value="<?php echo $cabecera->COD_CONTACTO ?>">

																	<select  class="form-control select2" name="contacto" id="contacto">
                                    <?php foreach ($contacto as $key): ?>
                                      <option value="<?php echo $key->COD_CONTACTO ?>" <?php if ($key->COD_CONTACTO==$cabecera->COD_CONTACTO ): ?>
                                        <?php echo "selected" ?>
                                      <?php endif; ?>><?php echo $key->CONTACTO ?></option>
                                    <?php endforeach; ?>
																	</select>

																	</div>
										        		</div>
								<div class="col-md-4" id="">
									<div class="form-group">
										<label for="">Dirección de Entrega</label>
                    <input type="hidden" name="direccion_dup" value="<?php echo $cabecera->CCDIRECC ?>">
									<select  class="form-control" name="direccion" id="direccion">
                      <?php foreach ($direcciones as $key): ?>
                        <option value="<?php echo $key->cod_direccion ?>" <?php if ($key->cod_direccion == $cabecera->CCDIRECC ): ?>
                          <?php echo "selected" ?>
                        <?php endif; ?>><?php echo $key->CDIRCLI ?></option>
                      <?php endforeach; ?>
									</select>
									<input type="hidden" class="form-control" id="vendedor" name="vendedor" >
									</div>
								</div>

		        	</div>
              <div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Doc.referencia</label>
											<input type="text" class="form-control" id="doc_ref" name="doc_ref" value="<?php echo $cabecera->CCREF ?>"  >


									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Forma de Pago</label>
									<select  class="form-control" name="forma_pago" id="forma_pago">
                    <?php foreach ($forma_pago as $key): ?>
                      <option value="<?php echo $key->COD_FP ?>" <?php if ($key->COD_FP ==$cabecera->CCFORPAG): ?>
                        <?php echo "selected" ?>
                      <?php endif; ?>><?php echo $key->DES_FP ?></option>
                    <?php endforeach; ?>
									</select>
									<input type="hidden" class="form-control" name="descuento" id="descuento" >
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">Pto. Venta</label>
									<select  class="form-control select2" name="pto_venta" id="pto_venta">
										<?php foreach ($punto_venta as $key): ?>
											<option value="<?php echo $key->pv_cod ?>" <?php if ($key->pv_cod ==$cabecera->CCPUNVEN): ?>
												<?php echo "selected" ?>
											<?php endif; ?>><?php echo $key->pv_des ?></option>
										<?php endforeach; ?>
									</select>

									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="">Especificar Almacen</label>
									<select  class="form-control" name="especificar_almacen" id="especificar_almacen">
										<option value="SU ALMACEN" <?php if ($cabecera->CCALMESP=='SU ALMACEN'): ?>
											selected
										<?php endif; ?>>SU ALMACÉN</option>
										<option value="NUESTRO ALMACEN" <?php if ($cabecera->CCALMESP=='NUESTRO ALMACEN'): ?>
											selected
										<?php endif; ?>>NUESTRO ALMACÉN</option>
									</select>
									</div>
								</div>
              </div>
							<div class="row">
	              <div class="col-md-12">
								<?php if ($cabecera->CCESTADO==1): ?>
										<button type="button" class="btn btn-primary pull-right" id="analisis_btn" >Analisis</button>
										  <button type="button" name="button" id="agregar_codigo" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Agregar articulo</button>
											  <?php endif; ?>
	                <br><br>
	                <div class="table-responsive" >

										<!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/requerimiento/detalle.php-->
										<table class="table table-bordered table-condensed table-hover" id="tbl_detalle">
										<thead>
										    <tr>

										      <th style="font-size:8.5pt" >Codigo</th>
										      <th style="font-size:8.5pt" >Descripcion</th>
										      <th style="font-size:8.5pt" >Und</th>
													<th style="font-size:8.5pt" >Cant</th>
										      <th style="font-size:8.5pt" >Plazo</th>
													<th style="font-size:8.5pt" >P.Lista</th>
													<th style="font-size:8.5pt" >Dscto.</th>
													<th style="font-size:8.5pt" >P.Neto</th>
													<th style="font-size:8.5pt" >Sub Total</th>

										      <th></th>
										    </tr>
											</thead>
											<tbody id="info_detalle">
                        <?php foreach ($detalle as $key): ?>
                          <tr id="<?php echo $key->CDSECUEN ?>">
                             <td class="CDCODIGO"  style="width:145px;font-size:8.5pt"><?php echo $key->CDCODIGO ?></td>
                              <td class="CDDESCRI"><input type="text" class="form-control desc" style="font-size:8.5pt;padding: 3px 5px;"  name="" value="<?php echo $key->CDDESCRI ?>"></td>
                              <td class="CDUNIDAD" style="width:40px;font-size:8.5pt"><?php echo $key->CDUNIDAD ?></td>
                              <td class="CDCANTID" style="width:60px;font-size:8.5pt"><input type="number"  class="form-control newcant"  style="font-size:8.5pt;padding: 3px 5px;" name="" value="<?php echo str_replace(',','',number_format($key->CDCANTID)) ?>"></td>
															<td class="PLAZO" style="width:60px;font-size:8.5pt"><input type="number"  value="<?php echo $key->PLAZO ?>" class="form-control editable" style="font-size:8.5pt;padding: 3px 5px;"   name="editable"><select class="form-control dias" style="font-size:8.5pt;width:60px;padding: 3px 5px;display: none;" >
																<option value=1 <?php if ($key->CCTIPTIME==1): ?>
																<?php echo "selected" ?>
															<?php endif; ?>>DH</option>
															<option value=7 <?php if ($key->CCTIPTIME==7): ?>
															<?php echo "selected" ?>
														<?php endif; ?>>Sem</option></td>
                              <td class="CDPREC_ORI" style="width:75px;font-size:8.5pt"><input class="form-control newprecio"  style="font-size:8.5pt;padding: 3px 5px;"  type="text" value="<?php echo str_replace(',','',number_format($key->CDPREC_ORI,2)) ?>"></td>
                              <td class="CDPORDES" style="width:65px;font-size:8.5pt"><input type="number" class="form-control newdescuento"  style="font-size:8.5pt;width:65px;padding: 3px 5px;"  value="<?php echo ($key->CDPORDES)/100 ?>"></td>
                              <td class="precioneto" style="width:75px;font-size:8.5pt"><input type="text" class="form-control preciobrutounit" style="font-size:8.5pt;padding: 3px 5px;"  value="<?php echo $key->CDPREC_ORI*(100-$key->CDPORDES)/100 ?>">	</td>
                              <td class="subtotal" style="width:75px;font-size:8.5pt"><input type="text" class="form-control subtotalnew" style="font-size:8.5pt;padding: 3px 5px;"  value="<?php echo ($key->CDCANTID *$key->CDPREC_ORI*(100-$key->CDPORDES))/100 ?>" readonly></td>
														  <td class="eliminar" style="width:40px;font-size:8.5pt"><button type="button" name="remove" data-id="<?php echo $key->CDSECUEN  ?>" class="btn btn-xs btn-danger btn_remove"><i class="glyphicon glyphicon-trash"></i></button></td>
															<td class="clonar" style="width:40px;font-size:8.5pt"><button type="button" data-id="<?php echo $key->CDSECUEN  ?>" class="btn btn-xs btn-primary addFila"><i class="glyphicon glyphicon-duplicate"></i></button></td>
															<td class="descuentovalor" style="display:none"> <input type="text" class="descuentovalornew" value="<?php echo $key->CDPREC_ORI*$key->CDCANTID*($key->CDPORDES)/100 ?>"></td>
															<td style="display:none;"><?php echo $key->CDSECUEN   ?></td>
														</tr>
                        <?php endforeach; ?>
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
										<label></label>
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
									<input type="hidden" name="igvpor" id="igvpor" value="<?php if ($cabecera->CCTIPCOTIZA=='NAC'): ?>
                    <?php echo 0.18 ?>
                  <?php else: ?>
                    <?php echo 0 ?>
                  <?php endif; ?>">
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
							<?php if ($transaccion!='atender'): ?>
								<div class="row">
									<div class="col-md-12">
										<button type="button" name="button" class="btn btn-success btn-flat btn-block" id="btn_generar_cot">Generar Cotización</button>
									</div>
								</div>
									<?php else: ?>
											<div class="row">
												<div class="col-md-12">
													<button type="button" name="button" class="btn btn-success btn-flat btn-block" id="btn_editar_cot">Actualizar Cotización</button>
												</div>
											</div>


							<?php endif; ?>

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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
