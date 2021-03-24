<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Forma de Pago</h4>
				</div>

		        <div class="box-body">

							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_tiempo_entregas">
		        			<thead>
                    <tr>
                      <th>#</th>
                      <th>Forma de Pago</th>
                    </tr>
		        			</thead>
		        			<tbody>
                      <?php $item=1; foreach ($pago as $key): ?>
                        <tr>
                          <td><?php echo $item ?></td>
                          <td><?php echo $key->DES_FP ?></td>
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
