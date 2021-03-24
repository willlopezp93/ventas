<section class="content-header">
      <h1>
        Dashboard

      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <select class="form-control" id="año">
              <?php $añoinicial=2019;
                $añoactual=date('Y');
                $n=$añoactual-$añoinicial+1;
               ?>
                <option value="">.:. Seleccione Año</option>
                 <option value="<?php echo $añoinicial ?>"><?php echo $añoinicial ?></option>
               <?php for ($i=1; $i <= $n; $i++) {?>
                 <option value="<?php echo $añoinicial+$i?>"><?php echo $añoinicial+$i ?></option>
              <?php }?>
            </select>
            <input type="hidden" id="año_actual" name="" value="<?php echo $añoactual ?>">
          </div>
          <div class="col-md-3">
            <select class="form-control" id="trimestre" name="trimestre">
              <option value="0">.:.Seleccione Mes</option>
              <option value="T1">T1</option>
              <option value="T2">T2</option>
              <option value="T3">T3</option>
              <option value="T4">T4</option>
            </select>
            <input type="hidden" id="trimestre_seleccionado" name="" value="">
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-info consultar_info" id="" name="button">Información</button>
          </div>
        </div>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <br><br><br>
        <div id="dashboard">
        </div>
      </div>
  </div>
</section>
