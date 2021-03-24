
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Pedidos Pendientes</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Vendedor</label>
                      <select class="form-control" name="vendedor" id="vendedor">
                        <?php foreach ($vendedor as $key): ?>
                          <option value="<?php echo $key->cod_ven ?>"><?php echo $key->Des_Ven ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <br>
                    <button type="button" class="btn btn-success" id="consultar" name="button">Consultar</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 ">
                    <div id="tabla_info" class="table-responsive">

                    </div>
                  </div>

                </div>
  			      </div>
  		    </div>
  	   </div>


  </section>
