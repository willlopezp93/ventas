<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aprobacion CTR</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Aprobación de Requerimiento de Materiales</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">

                  </div>
                </div>
                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_stock">
                        <table class="table table-bordered table-condensed table-hover">
                          <thead>
                            <tr>
                              <th>Requerimiento</th>
                              <th>Solicitante</th>
                              <th>Area</th>
                              <th>Fecha Emision</th>
                              <th>Area Responsable</th>
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
                                                case 4:
                                                  echo "Administracion";
                                                  break;
                                          default:
                                            // code...
                                            break;
                                        }
                                      ?></td>
                                      <td><?php echo date('d-m-Y',strtotime($key->fecha_doc)); ?></td>

                                      <td>
                                        <?php
                                          switch ($key->area) {
                                            case 1:
                                               echo "Operaciones" ;

                                              break;
                                              case 2:
                                              echo "Seguridad";

                                              break;
                                                case 3:
                                              echo "Mantenimiento";

                                                break;
                                                  case 4:

                                                echo "Administracion";

                                                  break;

                                            default:
                                              // code...
                                              break;
                                          }
                                        ?>
                                      </td>
                                      <td><?php
                                        switch ($this->session->userdata('area')) {
                                          case 1:
                                            if ($key->firma_operaciones=='') {
                                              echo "<span class='label bg-yellow-active color-palette'>Falta Aprobar</span>";
                                            } else {
                                              echo "<span class='label bg-green-active color-palette'>Aprobado por Operaciones</span>" ;
                                            }
                                            break;
                                            case 2:
                                            if ($key->firma_ssoma=='') {
                                              echo "<span class='label bg-yellow-active color-palette'>Falta Aprobar</span>";
                                            } else {
                                              echo "<span class='label bg-green-active color-palette'>Aprobado por Seguridad</span>";
                                            }
                                            break;
                                              case 3:
                                              if ($key->firma_mantto=='') {
                                                echo "<span class='label bg-yellow-active color-palette'>Falta Aprobar</span>";
                                              } else {
                                                echo "<span class='label bg-green-active color-palette'>Aprobado por Mantenimiento</span>";
                                              }
                                              break;
                                                case 4:
                                                if ($key->firma_adm=='') {
                                                  echo "<span class='label bg-yellow-active color-palette'>Falta Aprobar</span>";
                                                } else {
                                                  echo "<span class='label bg-green-active color-palette'>Aprobado por Administracion</span>";
                                                }
                                                break;

                                          default:
                                            // code...
                                            break;
                                        }
                                      ?></td>
                                      <td><?php
                                        switch ($this->session->userdata('area')) {
                                          case 1:
                                            if ($key->firma_operaciones=='') {?>
                                              <a href="#" data-id="<?php echo $key->docentry ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                        <?php    } else {
                                              echo "<span class='label bg-green-active color-palette'><i class='glyphicon glyphicon-ok'></i></span>" ;
                                            }
                                            break;
                                            case 2:
                                            if ($key->firma_ssoma=='') {?>
                                              <a href="#" data-id="<?php echo $key->docentry ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                        <?php    } else {
                                              echo "<span class='label bg-green-active color-palette'><i class='glyphicon glyphicon-ok'></i></span>";
                                            }
                                            break;
                                              case 3:
                                              if ($key->firma_mantto=='') {?>
                                                <a href="#" data-id="<?php echo $key->docentry ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                            <?php  } else {
                                                echo "<span class='label bg-green-active color-palette'><i class='glyphicon glyphicon-ok'></i></span>";
                                              }
                                              break;
                                                case 4:
                                                if ($key->firma_adm=='') {?>
                                                  <a href="#" data-id="<?php echo $key->docentry ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                          <?php      } else {
                                                  echo "<span class='label bg-green-active color-palette'><i class='glyphicon glyphicon-ok'></i></span>";
                                                }
                                                break;

                                          default:
                                            // code...
                                            break;
                                        }
                                      ?></td>


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
