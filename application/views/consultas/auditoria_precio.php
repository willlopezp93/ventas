<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Precio de Artículo</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Precio de Artículo</h4>
  				</div>
  		        <div class="box-body">
                <div class="row">
                      <div class="col-md-12 table-responsive">
                        <br>
                        <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>ARTÍCULO</th>
                              <th>MOTIVO</th>
                              <th>USUARIO</th>
                              <th>FECHA / HORA</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php $item=1; foreach ($auditoria as $key): ?>
                                <tr>
                                  <td><?php echo $item ?></td>
                                  <td><?php echo str_pad($key->documento, 7, "0", STR_PAD_LEFT); ?></td>
                                  <td><?php echo $key->accion ?></td>
                            <td><?php echo  $key->cotizador?></td>
                            <?php $mes = date("m", strtotime($key->fecha_hora)); ?>
                            <?php if ($mes>2 or $mes<10): ?>
                              <td><?php echo date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($key->fecha_hora)))  ?></td>
                            <?php else: ?>
                              <td><?php echo  date('Y-m-d H:i:s',$key->fecha_hora)?></td>
                            <?php endif; ?>
                                </tr>
                            <?php $item++;endforeach; ?>
                          </tbody>
                        </table>

                      </div>
                  </div>
  			</div>
  		</div>
  	</div>
  </section>
</body>
</html>
