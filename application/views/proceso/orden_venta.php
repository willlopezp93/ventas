<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Generar Pedido</title>
</head>
<body>
  <section class="content">


  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Generar Orden de Venta</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">

                      <div class="col-md-12 table-responsive">
                        <br>
                        <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>DOCUMENTO</th>
                              <th>FECHA  DOC</th>
                              <th>FECHA VENCIM</th>

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
                              <?php if (($key['estado']==1 or $key['estado']==2) AND $key['CLOSED']!='V'): ?>
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
                                  echo "<span class='label bg-red disabled color-palette'>SIN PEDIDO</span>";
                                  break;
                                  case 2:
                                    echo "<span class='label bg-yellow-active color-palette'>CON PEDIDO PARCIAL</span>";
                                    break;
                                    case 3:
                                      echo "<span class='label bg-green-active color-palette'>CON PEDIDO COMPLETO</span>";
                                      break;

                                default:
                                  // code...
                                  break;
                              } ?></td>

                              <td>
                                  <button type="button" class="btn btn-info ver_detalle" name="button" data-id="<?php echo $key['correlativo'] ?>" data-toggle="modal" data-target="#myModal"><i class="fas fa-dolly"></i></button>
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

  </section>
</body>
</html>

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
            <input type="hidden" id="cotizacion" name='cotizacion' value=''>
            <input type="hidden" id="fecha_orden" name="fecha_orden" value="<?php echo date('Y-m-d') ?>">
              <input type="hidden" id="tipocambio" name="tipocambio" value="">
            <div  id="form_pedido">

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
