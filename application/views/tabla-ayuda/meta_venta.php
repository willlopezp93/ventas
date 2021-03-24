<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Meta de Ventas</h4>
				</div>

		        <div class="box-body">
							<div class="row">
								<div class="col-md-3">
									<select class="form-control" id="año">
                    <?php $añoinicial=2019;
                      $añoactual=date('Y');
                      $n=$añoactual-$añoinicial+1;
                     ?>
                      <option value="">.:. Seleccione año</option>
                       <option value="<?php echo $añoinicial ?>"><?php echo $añoinicial ?></option>
                     <?php for ($i=1; $i <= $n; $i++) {?>
                       <option value="<?php echo $añoinicial+$i?>"><?php echo $añoinicial+$i ?></option>
                    <?php }?>
									</select>
                  <input type="hidden" id="año_actual" name="" value="<?php echo $añoactual ?>">
								</div>

							</div>

		        	<div class="table-responsive" id="tbl_meta">

		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>
