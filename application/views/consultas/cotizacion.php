
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Cotizaciones</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <input type="hidden" id="cotizacion" value="">
                  </div>
                </div>
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                        <br>
                        <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                          <thead>
                            <tr>
                              <td style="display:none"></td>
                              <th>#</th>
                              <th>DOCUMENTO</th>
                              <th>FECHA DE DOCUMENTO</th>
                              <th>FECHA DE VENCIMIENTO</th>
                              <th>RAZON SOCIAL</th>
                              <th>IMPORTE TOTAL($)</th>
                              <th>FORM.PAGO</th>
                              <th>SITUACION</th>
                              <th>ESTADO</th>
                              <th>USUARIO</th>
                              <th>REQUERIMIENTO</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php $item=1; foreach ($cotizaciones as $key): ?>
                                <tr>
                                  <td style="display:none"><?php echo $key['correlativo'] ?></td>
                                  <td><?php echo $item ?></td>
                                  <td><?php echo str_pad($key['correlativo'], 7, "0", STR_PAD_LEFT); ?></td>
                                  <td><?php echo $key['fechadoc'] ?></td>
                                <td><?php echo $key['fechaven'] ?></td>


                              <td><?php echo $key['cliente']  ?></td>
                              <td><?php echo $key['importe']  ?></td>
                              <td><?php echo $key['pago'] ?></td>
                              <td><?php
                              switch ($key['estado']) {
                                case 1:
                                  echo "<span class='label bg-red disabled color-palette'>SIN PEDIDO</span>";
                                  break;
                                  case 3:
                                    echo "<span class='label bg-green-active color-palette'>CON PEDIDO COMPLETO</span>";
                                    break;
                                    case 2:
                                      echo "<span class='label bg-yellow-active color-palette'>CON PEDIDO PARCIAL</span>";
                                      break;
                                        case 4:
                                          echo "<span class='label bg-black-active color-palette'>CERRADO</span>";
                                          break;

                                default:
                                  // code...
                                  break;
                              } ?></td>
                              <td><?php
                              switch ($key['CLOSED']) {
                                case 'V':
                                  echo "<span class='label bg-black disabled color-palette'>CERRADO</span>";
                                  break;
                                  case 'F':
                                    echo "<span class='label bg-blue-active color-palette'>ABIERTO</span>";
                                    break;

                                default:
                                  // code...
                                  break;
                              } ?></td>
                              <td><?php echo  $key['usuario'] ?></td>
                              <td><?php echo trim(str_replace(',',' , ',$key['CCREF'])) ?></td>

                                </tr>
                            <?php $item++;endforeach; ?>
                          </tbody>
                        </table>

                      </div>

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
  </section>
