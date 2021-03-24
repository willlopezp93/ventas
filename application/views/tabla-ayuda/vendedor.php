<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Relacion de Vendedores - STARSOFT</h4>
				</div>

		        <div class="box-body">

							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_vendedor">
		        			<thead>
                    <tr>
                      <th>Codigo</th>
                      <th>DNI</th>
                      <th>Nombre</th>
                    </tr>

		        			</thead>
		        			<tbody>
                      <?php $item=1; foreach ($vendedor as $key): ?>

													<tr>
														<td><?php echo $item ?></td>
														<td><?php echo $key->Num_Doc ?></td>
														<td><?php echo $key->Des_Ven ?></td>
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
