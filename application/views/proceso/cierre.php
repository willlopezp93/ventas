<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cotizaciones</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Cotizaciones</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
              <!--    <div class="col-md-12">
                    <div class="form-group">
                      <div class="col-md-3"><label>Fecha:</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker fecha_guias flat" id="periodo" name="form_periodo"></div></div>

                    </div>
                  </div>
                </div>-->
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                        <br>
                        <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>DOCUMENTO</th>
                              <th>FECHA DE DOCUMENTO</th>
                              <th>FECHA DE VENCIMIENTO</th>
                              <th>RAZON SOCIAL</th>
                              <th>IMPORTE TOTAL($)</th>
                              <th>FORM.PAGO</th>
                              <th>TIPO</th>
                              <th>SITUACION</th>
                              <th>ACCIONES</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $item=1; foreach ($cotizaciones as $key): ?>
                              <?php if (($key['estado']==2 or $key['estado']==1) and $key['CLOSED']!='V'): ?>
                                <tr>
                                  <td><?php echo $item ?></td>
                                  <td><?php echo str_pad($key['correlativo'], 7, "0", STR_PAD_LEFT); ?></td>
                                  <td><?php echo $key['fechadoc'] ?></td>
                                <td><?php echo $key['fechaven'] ?></td>
                              <td><?php echo $key['cliente']  ?></td>
                              <td><?php echo $key['importe']  ?></td>
                              <td><?php echo $key['pago'] ?></td>
                            <td><?php echo  $key['tipo'] ?></td>
                            <td><?php
                            switch ($key['estado']) {
                              case 1:
                                echo "<span class='label bg-blue disabled color-palette'>SIN PEDIDO</span>";
                                break;
                                case 2:
                                  echo "<span class='label bg-black-active color-palette'>CON PEDIDO PARCIAL</span>";
                                  break;
                                  case 3:
                                    echo "<span class='label bg-yellow-active color-palette'>CON PEDIDO COMPLETO</span>";
                                    break;

                              default:
                                // code...
                                break;
                            } ?></td>
                              <td>
                                  <button type="button" class="btn btn-warning ver_detalle" name="button" data-id="<?php echo $key['correlativo'] ?>" data-toggle="modal" data-target="#myModal">Cierre</button>
                              </td>
                                </tr>
                              <?php $item++; endif; ?>
                            <?php endforeach; ?>
                          </tbody>
                        </table>

                      </div>

                  </div>

  		        </div>

  			</div>
  		</div>
  	</div>
  </section>
</body>
</html>

<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<div class="modal-body">
          <form id="form_cotizacion" method="post">
            <input type="hidden" id="cotizacioncerrar" value="">
            <div class="callout callout-warning">
                <h4>Indicaciones!</h4>

                <p>Sólo se llevará a cabo el cierre de la cotizacion,</p>
                <p>si selecciona <span style="color:blue"><b>el motivo</b></span>de la no atencion de los items listados</p>
          </div>
            <div class="table-responsive" id="tbl_detalle">

            </div>
            <div id="mensaje">

            </div>
          </form>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="cerrar_cot">Cerrar Cotizacion</button>
      </div>
    </div>
  </div>
</div>
