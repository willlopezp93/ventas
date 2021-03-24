
  <section class="content">

  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Reprogramacion de Pedidos</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">

                                          <div class="table-responsive">
                                            <br>
                                            <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                                              <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>DOCUMENTO</th>
                                                  <th>FECHA  DOC</th>
                                                  <th>FECHA ENTREGA</th>
                                                  <th>RAZON SOCIAL</th>
                                                  <th>IMPORTE TOTAL</th>
                                                  <th>MONEDA</th>
                                                  <th>ACCIONES</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php $item=1; foreach ($pedidos as $key): ?>
                                                    <tr>
                                                      <td><?php echo $item ?></td>
                                                      <td><?php echo $key->CFNUMPED?></td>
                                                      <td><?php echo date('Y-m-d',strtotime($key->CFFECDOC)) ?></td>
                                                      <td><?php echo date('Y-m-d',strtotime($key->CFFECVEN))  ?></td>
                                                    <td><?php echo $key->CFNOMBRE ?></td>
                                                  <td><?php echo number_format($key->CFIMPORTE,2) ?></td>
                                                  <td><?php echo $key->CFCODMON ?></td>

                                                  <td>
                                                      <button type="button" class="btn btn-info reprogramar_detalle" name="button" data-id="<?php echo $key->CFNUMPED?>" data-toggle="modal" data-target="#myModal"><i class="far fa-calendar-alt"></i></button>
                                                      <button type="button" class="btn btn-primary ver_detalle" name="button" data-id="<?php echo $key->CFNUMPED?>" data-toggle="modal" data-target="#detalle"><i class="fas fa-list-ul"></i></button>
                                                  </td>
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
  <div class="modal fade" id="detalle"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
  				<div class="modal-body">

              <input type="hidden" id="pedido_det" name='pedido' value=''>

              <div  id="form_pedido_det">

              </div>


  	      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<div class="modal-body">
          <form id="form_detalle" method="post">
            <input type="hidden" id="pedido" name='pedido' value=''>

            <div  id="form_pedido">

            </div>

          </form>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="reprogramar">Reprogramar</button>
      </div>
    </div>
  </div>
</div>
