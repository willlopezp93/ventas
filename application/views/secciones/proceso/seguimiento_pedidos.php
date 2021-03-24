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
                                  <th>ESTADO</th>
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
                                    <td><?php echo $key->CFCOTIZA ?></td>
                                  <td><?php echo number_format($key->CFIMPORTE,2) ?></td>
                                  <td><?php echo $key->CFCODMON ?></td>

                                  <td>
                                      <button type="button" class="btn btn-info ver_detalle" name="button" data-id="<?php echo $key->CFNUMPED?>"><i class="glyphicon glyphicon-list-alt"></i></button>

                                  </td>
                                    </tr>

                                <?php $item++; endforeach; ?>
                              </tbody>
                            </table>

                          </div>


                  </div>
  </div>
