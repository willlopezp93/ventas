<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Requerimiento de Materiales</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Requerimiento de Materiales</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">

                    </div>
                  </div>
                </div>
                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_req">
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
                              <?php foreach ($requerimientos as $key): ?>
                                <tr>
                                  <td><?php echo str_pad($key->req_correlativo, 7, "0", STR_PAD_LEFT) ?></td>
                                  <td><?php echo $key->fullname ?></td>
                                  <td><?php
                                    switch ($key->area) {
                                      case 1:
                                        echo "Operaciones";
                                        break;
                                        case 2:
                                          echo "SSOMA";
                                          break;
                                          case 3:
                                            echo "Mantenimiento";
                                            break;
                                      default:
                                        // code...
                                        break;
                                    }
                                  ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($key->fecha_doc)); ?></td>

                                  <td><?php
                                    switch ($key->fecha_aprobacion) {
                                      case "0000-00-00":
                                        echo "";
                                        break;

                                      default:
                                        echo $key->fecha_aprobacion ;
                                        break;
                                    }
                                  ?></td>
                                  <td><?php
                                    switch ($key->estado_req) {
                                      case 1:
                                        echo "<span class='label bg-black disabled color-palette'>Atendido</span>";
                                        break;
                                        case 2:
                                          echo "<span class='label bg-green-active color-palette'>Aprobado en CTR</span>";
                                          break;
                                          case 0:
                                            echo "<span class='label bg-yellow-active color-palette'>Pendiente</span>";
                                            break;
                                            case 4:
                                              echo "<span class='label bg-red-active color-palette'>Rechazado</span>";
                                              break;
                                              case 5:
                                                echo "<span class='label bg-blue-active color-palette'>Aprobado en Lima</span>";
                                                break;
                                      default:
                                        // code...
                                        break;
                                    }
                                  ?></td>


                                    <td><a href="#" data-id="<?php echo $key->docentry ?>" class="btn btn-xs btn-primary verdetallereq"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                    <a href="<?php echo base_url() ?>Reporte/generar_req_materiales/<?php echo $key->docentry ?>" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-print"></i></a>

                                  </td>
                                </tr>
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
