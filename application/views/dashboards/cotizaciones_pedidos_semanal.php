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
          <div class="col-md-8">
            <br>
            <h3>Defina el rango de fechas para el mes activo </h3>
              <br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                <label>F.INICIO</label>
                <input type="date" name="finicio" class="form-control" id="finicio" value="">
              </div>

          </div>
          <div class="col-md-3">
              <div class="form-group">
                <label>F.FIN</label>
                <input type="date" name="ffin" class="form-control" id="ffin" value="">
              </div>

          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>TIPO</label>
              <select class="form-control" id="tipo" name="tipo">
                <option value="relacionado">RELACIONADOS</option>
                <option value="terceros">NO RELACIONADOS</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <br>
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
