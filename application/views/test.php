
<!--
 <section class="content-header">
       <containter class="fluid">
				 <?php
				 	echo $this->session->userdata('user_nombre');
				  ?>
					<div class="row">
						<div class="col-md-2">
							<input type="date" class="form-control" id="hoy" name="" value="<?php echo date("Y-m-d") ?>">
						</div>
						<div class="col-md-1">
							<input type="number" class="form-control" id="plazo" name="" value="1">
						</div>
						<div class="col-md-2">
						<input type="text" class="form-control" id="entrega" name="" value="" readonly>
						</div>
					</div>
 			</containter>

 			<containter class="fluid">
				<?php
				$hoy = date("d-m");
echo $hoy;
				?>


 	</containter>-->



  <section class="content">
  <containter>
    <!--<div class="step-title waves-effect">Acciones Correctivas</div>-->
    <div class="box box-primary">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
	<button type="button" class="btn btn-warning pull-right" id="agregar_codigo_excel" data-toggle="modal" data-target="#cargardesdeexcel">Cargar excel</button>
          </div>
        </div>
        <br><br>
        <!-- <div class="row">
          <div class="col-md-6">
          <div class="table-responsive">

            <table id="table" class="table table-bordered table-condensed">
              <thead>
                  <tr>
                      <th>&nbsp;</th>
                      <th  scope="col">Actvidad</th>
                      <th  scope="col">Procceso</th>
                      <th scope="col">Fecha Inicio</th>
                      <th>Dias</th>
                      <th scope="col">Fecha Fin</th>
                      <th scope="col">&nbsp;</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class="item">1</td>
                      <td class="actividad"><input name="actividad" id="" class="form-control"></td>
                      <td class="proceso">
                        <select name="proceso" id="" class="form-control">
                        <option value="1">Inicio</option>
                        <option value="2">Ejecucion</option>
                        <option value="3">Pruebas</option>
                        <option value="4">Control y Seguimiento</option>
                        <option value="5">Cierre</option>
                        </select>
                      </td>
                      <td class="fechainicio"><input type="date" name="fechainicio" class="form-control fecha"></td>
                      <td class="dias"><input type="number" class="form-control cant" name="dias" id="" value=""></td>
                      <td class="fechafin"><input type="text" name="fechafin"  class="form-control fin" readonly></td>
                      <td class="remove"><button type="button" class="btn remove_button btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
                  </tr>
              </tbody>
          </table>

          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="add btn btn-primary">Nueva Fila</button>

            </div>
          </div>
          <div class="row">
           <div class="col-md-12">
             <center><input type="submit" id="guardar" class="btn btn-primary"  value="Guardar"></center>
             <input type="submit" class="btn btn-primary" id=gantt name="" value="Gantt">
           </div>
          </div>
        </div>

      </div>-->
      <div class="table-responsive">
        <div id="msg">

        </div>
        <table id="table" class="table table-bordered table-condensed">
          <thead>
            <th>ITEM</th>
            <th>CODIGO</th>
            <th>DESCRIPCION</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>UNIDAD</th>
            <th>X</th>
          </thead>
          <tbody>

          </tbody>
      </table>

      </div>

         <!--<div  style = " position : relative "  class = "gantt"  id = "GanttChartDIV" > </div>-->

      </div>
    </div>
  </containter>
  </section>
  <div class="modal fade" id="cargardesdeexcel"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Cargar excel <a href="<?php echo base_url();?>assets/files/Carga-Cotizacion.xlsx" class="btn btn-info btn-xs"><i class="far fa-file-excel"></i>Plantilla</a></h4>
        </div>
        <div class="modal-body">
  				<div class="modal-body">
  						<form  method="post" enctype="multipart/form-data" id=form_envio_excel>
  						<div class="form-group">
  						  <label for="">Excel</label>
  						  <input type="file" class="form-control" id="excel" name="excelfile" accept=".xls, .xlsx">
  						  <p class="help-block">Acomodar la información en la plantilla.</p>
  						</div>
  						</form>
  	      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btn_cargaexcel">Cargar códigos</button>
        </div>
      </div>
    </div>
  </div>
