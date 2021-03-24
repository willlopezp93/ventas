<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Atender Requerimiento</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Atender Requerimiento de Materiales</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="" id="labelcontrato">Contrato</label>
                      <select class="form-control" id="contrato" style="width:25%">
                            <option value="">Elegir Contrato</option>
                        <?php

                        foreach ($contrato as $key ):  ?>

                            <option value="<?php echo $key->contratoid ?>" <?php if ($key->contratoid==14): echo 'style="display:none;"';?>

                            <?php endif;if ($key->contratoid==100) {
                              echo 'style="display:none;"';
                            } ?>><?php echo $key->nombre ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_atenderreq">
                        <table class="table table-bordered table-condensed table-hover">
                          <thead>
                            <tr>
                              <th>Requerimiento</th>
                              <th>Solicitante</th>
                              <th>Area</th>
                              <th>Fecha Emision</th>
                              <th>Fecha Aprobación</th>
                              <th>Estado</th>
                              <th>Acciones</th>

                            </tr>
                          </thead>
                          <tbody>


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

<div class="modal fade" id="req_compra"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Requerimiento de Compra</h4>
      </div>

      <div class="modal-body">
        <form id="form_req_compra" method="post">
          <input type="hidden" id="req_cabcompra" name='req_cabcompra' value=''>
          <div class="table-responsive" id="tbl_compra">



            <!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/transferencia/detalle.php-->
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="btn_compra_ctr">Generar Requerimiento de Compra</button>
      </div>
    </div>
  </div>
</div>

</html>
