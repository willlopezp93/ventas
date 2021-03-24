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
  					<h4>Articulos con Centro de Costo</h4>
  				</div>

  		        <div class="box-body">

                <div class="row">
                      <div class="col-md-12 table-responsive">
                        <br>
                        <table class="table table-bordered table-condensed table-hover"  id="tbl_cotizaciones">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>ARTICULO</th>
                              <th>DESCRIPCION</th>
                              <th>FAMILIA</th>
                              <th>CC</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $item=1; foreach ($articulos as $key): ?>
                                <tr>
                                  <td><?php echo $item ?></td>
                                  <td><?php echo $key['ACODIGO']; ?></td>
                                  <td><?php echo $key['ADESCRI'] ?></td>
                                <td><?php echo $key['AFAMILIA'] ?></td>
                                <td><?php echo $key['centrocosto']; ?></td>
                                </tr>
                            <?php $item++;endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
  			</div>
  		</div>

  </section>
</body>
</html>
