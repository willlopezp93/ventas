<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Relacion de Clientes - STARSOFT</h4>
				</div>

		        <div class="box-body">

							<div class="table-responsive" >
		        		<table class="table table-bordered table-hover" id="tbl_cliente">
		        			<thead>
                    <tr>
                      <th>#</th>
                      <th>Codigo</th>
                      <th>Razon Social</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Destinos</th>
                      <th>Contactos</th>
                    </tr>

		        			</thead>
		        			<tbody>
                      <?php $item=1; foreach ($clientes as $key): ?>
                        <tr>
                          <td><?php echo $item ?></td>
                          <td><?php echo $key->ccodcli ?></td>
                          <td><?php echo $key->cnomcli ?></td>
													<td><?php echo $key->cdircli ?></td>
                          <td><?php echo $key->ctelefo ?></td>
                          <td><button type="button"  class="btn btn-primary destinos" data-toggle="modal" data-target="#destinos" data-id="<?php echo  $key->ccodcli  ?>"><center><i class="fas fa-warehouse"></i></center></button></td>
                          <td><button type="button"  class="btn btn-success clientes" data-toggle="modal" data-target="#clientes" data-id="<?php echo  $key->ccodcli  ?>"><center><i class="fas fa-user"></i></center></button></td>
                        </tr>
                      <?php $item++; endforeach; ?>
		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="destinos"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Destinos</h4>
      </div>
      <div class="modal-body">
					<div class="table-responsive" id="tbl_destinos">
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Direccion</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
    </div>
  </div>
</div>

<div class="modal fade" id="clientes"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Clientes</h4>
      </div>
      <div class="modal-body">
					<div class="table-responsive" id="tbl_contactos">
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Contactos</th>
                  <th>Telefono</th>
                  <th>Area</th>
                  <th>Cargo</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
    </div>
  </div>
</div>
