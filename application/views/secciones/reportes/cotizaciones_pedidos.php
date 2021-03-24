<div class="row">
  <div class="col-md-12">
    <h3><center>Cotización VS Pedido</center></h3>
  </div>
</div><br>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>COTIZADO</th>
            <th>COTIZADO CON PEDIDO</th>
            <th>EFECTIVIDAD DE COTIZACIONES</th>
            <th>OBJETIVO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo number_format($cotizaciones_pedidos['cotizacion']) ?></td>
            <td><?php echo number_format($cotizaciones_pedidos['pedido']) ?></td>
            <?php if ($cotizaciones_pedidos['cotizacion']==0): ?>
              <td>0%</td>
              <?php else: ?>
                <td><?php echo number_format($cotizaciones_pedidos['pedido']*100/$cotizaciones_pedidos['cotizacion']) ?>%</td>
            <?php endif; ?>

            <td>55%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <center><h3><b>CLIENTES RELACIONADOS</b></h3></center>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>COTIZADO</th>
            <th>COTIZADO CON PEDIDO</th>
            <th>EFECTIVIDAD DE COTIZACIONES</th>
            <th>OBJETIVO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$ <?php echo number_format($cotizaciones_pedidos_relacionadas['cotizacion']) ?></td>
            <td>$ <?php echo number_format($cotizaciones_pedidos_relacionadas['pedido']) ?></td>
            <?php if ($cotizaciones_pedidos_relacionadas['cotizacion']==0): ?>
              <td>0%</td>
            <?php else: ?>
              <td><?php echo number_format($cotizaciones_pedidos_relacionadas['pedido']*100/$cotizaciones_pedidos_relacionadas['cotizacion']) ?>%</td>

            <?php endif; ?>
            <td>55%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containerrelacionadas" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <center><h3><b>CLIENTES MERCADO</b></h3></center>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <h3>GUSTAVO GAVILÁN</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>COTIZADO</th>
            <th>COTIZADO CON PEDIDO</th>
            <th>EFECTIVIDAD DE COTIZACIONES</th>
            <th>OBJETIVO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$ <?php echo number_format($cotizaciones_pedidos_mercado_gavilan['cotizacion']) ?></td>
            <td>$ <?php echo number_format($cotizaciones_pedidos_mercado_gavilan['pedido']) ?></td>
            <?php if ($cotizaciones_pedidos_mercado_gavilan['cotizacion']==0): ?>
              <td>0%</td>
            <?php else: ?>
              <td><?php echo number_format($cotizaciones_pedidos_mercado_gavilan['pedido']*100/$cotizaciones_pedidos_mercado_gavilan['cotizacion']) ?>%</td>

            <?php endif; ?>
            <td>55%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containergavilan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <h3>FERNANDO NUÑEZ</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>COTIZADO</th>
            <th>COTIZADO CON PEDIDO</th>
            <th>EFECTIVIDAD DE COTIZACIONES</th>
            <th>OBJETIVO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$ <?php echo number_format($cotizaciones_pedidos_mercado_nunez['cotizacion']) ?></td>
            <td>$ <?php echo number_format($cotizaciones_pedidos_mercado_nunez['pedido']) ?></td>
            <?php if ($cotizaciones_pedidos_mercado_nunez['cotizacion']==0): ?>
              <td>0%</td>
            <?php else: ?>
              <td><?php echo number_format($cotizaciones_pedidos_mercado_nunez['pedido']*100/$cotizaciones_pedidos_mercado_nunez['cotizacion']) ?>%</td>

            <?php endif; ?>
            <td>55%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containernunez" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <h3>VENTAS CODRISE</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>COTIZADO</th>
            <th>COTIZADO CON PEDIDO</th>
            <th>EFECTIVIDAD DE COTIZACIONES</th>
            <th>OBJETIVO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$ <?php echo number_format($cotizaciones_pedidos_mercado_cds['cotizacion']) ?></td>
            <td>$ <?php echo number_format($cotizaciones_pedidos_mercado_cds['pedido']) ?></td>
            <?php if ($cotizaciones_pedidos_mercado_cds['cotizacion']==0): ?>
              <td>0%</td>
            <?php else: ?>
              <td><?php echo number_format($cotizaciones_pedidos_mercado_cds['pedido']*100/$cotizaciones_pedidos_mercado_cds['cotizacion']) ?>%</td>

            <?php endif; ?>
            <td>55%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containercds" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div>
<script type="text/javascript">
Highcharts.chart('container1', {
  chart: {
      type: 'column'
  },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - MENSUAL'
    },
  xAxis: {
      categories: [
        'MES'
      ],
      crosshair: true
  },
  yAxis: {
      min: 0,
      title: {
          text: 'USD'
      }
  },
  tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} USD</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
  plotOptions: {
      column: {
          pointPadding: 0.2,
          borderWidth: 0
      }
  },
  series:  [{
      name: 'Cotización',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos['cotizacion']))  ?>]

  }, {
      name: 'Pedido',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos['pedido'])) ?>]

  }]
});
Highcharts.chart('containerrelacionadas', {
  chart: {
      type: 'column'
  },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - CLIENTES RELACIONADOS '
    },
  xAxis: {
      categories: [
        'MES'
      ],
      crosshair: true
  },
  yAxis: {
      min: 0,
      title: {
          text: 'USD'
      }
  },
  tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} USD</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
  plotOptions: {
      column: {
          pointPadding: 0.2,
          borderWidth: 0
      }
  },
  series:  [{
      name: 'Cotización',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_relacionadas['cotizacion']))  ?>]

  }, {
      name: 'Pedido',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_relacionadas['pedido'])) ?>]

  }]
});
Highcharts.chart('containergavilan', {
  chart: {
      type: 'column'
  },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - CLIENTE MERCADO (GAVILÁN)'
    },
  xAxis: {
      categories: [
        'MES'
      ],
      crosshair: true
  },
  yAxis: {
      min: 0,
      title: {
          text: 'USD'
      }
  },
  tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} USD</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
  plotOptions: {
      column: {
          pointPadding: 0.2,
          borderWidth: 0
      }
  },
  series:  [{
      name: 'Cotización',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_mercado_gavilan['cotizacion']))  ?>]

  }, {
      name: 'Pedido',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_mercado_gavilan['pedido'])) ?>]

  }]
});
Highcharts.chart('containernunez', {
  chart: {
      type: 'column'
  },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - CLIENTE MERCADO (NUÑEZ)'
    },
  xAxis: {
      categories: [
        'MES'
      ],
      crosshair: true
  },
  yAxis: {
      min: 0,
      title: {
          text: 'USD'
      }
  },
  tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} USD</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
  plotOptions: {
      column: {
          pointPadding: 0.2,
          borderWidth: 0
      }
  },
  series:  [{
      name: 'Cotización',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_mercado_nunez['cotizacion']))  ?>]

  }, {
      name: 'Pedido',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_mercado_nunez['pedido'])) ?>]

  }]
});
Highcharts.chart('containercds', {
  chart: {
      type: 'column'
  },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - CLIENTE MERCADO (VENTAS CODRISE)'
    },
  xAxis: {
      categories: [
        'MES'
      ],
      crosshair: true
  },
  yAxis: {
      min: 0,
      title: {
          text: 'USD'
      }
  },
  tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} USD</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
  plotOptions: {
      column: {
          pointPadding: 0.2,
          borderWidth: 0
      }
  },
  series:  [{
      name: 'Cotización',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_mercado_cds['cotizacion']))  ?>]

  }, {
      name: 'Pedido',
      data: [<?php echo str_replace(',','',number_format($cotizaciones_pedidos_mercado_cds['pedido'])) ?>]

  }]
});
</script>
