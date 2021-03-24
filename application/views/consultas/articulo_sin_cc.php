<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Articulos sin Centro de Costo</title>
</head>
<body>
  <section class="content">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Articulos sin Centro de Costo</h4>
  				</div>

  		        <div class="box-body">
                <?php if ($tipo==1): ?>
                  <div class="row">
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary" id="actualizar" name="">Actualizar Centro de Costo</button>
                    </div>
                    <div id="msg">

                    </div>
                  </div>
                <?php endif; ?>
                <?php if ($tipo==1): ?>
                  <div class="row">
                        <div class="col-md-12 table-responsive">
                          <br>
                          <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>ARTICULO</th>
                                <th>EJEMPLO</th>
                                <th>DESCRIPCION</th>
                                <th>FAMILIA</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $item=1; foreach ($articulos as $key): ?>
                                <?php if (array_search($key['ACODIGO'], array_column($articulos_cc, 'ACODIGO'))==FALSE): ?>
                                  <tr>
                                    <td><?php echo $item ?></td>
                                    <td><?php echo $key['ACODIGO']; ?></td>
                                    <td><?php echo substr($key['ACODIGO'],0,2) ?></td>
                                    <td><?php echo $key['ADESCRI'] ?></td>
                                  <td><?php echo $key['AFAMILIA'] ?></td>
                                  </tr>
                                <?php $item++; endif; ?>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                <?php else: ?>
                  <div class="row">
                        <div class="col-md-12 table-responsive">
                          <br>
                          <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>ARTICULO</th>
                                <th>EJEMPLO</th>
                                <th>DESCRIPCION</th>
                                <th>FAMILIA</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $item=1; foreach ($articulos_cc as $key): ?>
                                <tr>
                                  <td><?php echo $item ?></td>
                                  <td><?php echo $key['ACODIGO']; ?></td>
                                  <td><?php echo substr($key['ACODIGO'],0,2) ?></td>
                                  <td><?php echo $key['ADESCRI'] ?></td>
                                <td><?php echo $key['AFAMILIA'] ?></td>
                                </tr>
                              <?php $item++;endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                <?php endif; ?>
  			</div>
  		</div>

  </section>
</body>
</html>
