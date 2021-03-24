
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Cotizaciones Cerradas</h4>
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

                                <th style="display:none"></th>
                              <th>DOCUMENTO</th>
                              <th>FECHA DE DOCUMENTO</th>
                              <th>FECHA DE VENCIMIENTO</th>
                              <th>CODIGO CLIENTE</th>
                              <th>RAZON SOCIAL</th>
                              <th>IMPORTE TOTAL($)</th>
                              <th>FORM.PAGO</th>
                              <th>TIPO</th>
                              <th>SITUACION</th>
                              <th>USUARIO</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php $item=1; foreach ($cotizaciones as $key): ?>
                              <?php if ($key['CLOSED']=='V'): ?>
                                <tr>
                                  <td style="display:none"><?php echo $key['correlativo'] ?></td>
                                          <td><?php echo str_pad($key['correlativo'], 7, "0", STR_PAD_LEFT); ?></td>
                                  <td><?php echo $key['fechadoc'] ?></td>
                                <td><?php echo $key['fechaven'] ?></td>
                            <td><?php echo  $key['codigo']?></td>

                              <td><?php echo $key['cliente']  ?></td>
                              <td><?php echo $key['importe']  ?></td>
                              <td><?php echo $key['pago'] ?></td>
                            <td><?php echo  $key['tipo'] ?></td>
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
                              <td><?php echo  $key['usuario'] ?></td>

                                </tr>
                              <?php endif; ?>
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
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<div class="modal-body">
          <form id="form_analisis" method="post">
            <input type="hidden" id="cotizacioncerrar" value="">
            <div class="table-responsive" id="tbl_detalle">

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
