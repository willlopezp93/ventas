<style media="screen">
  table{
    font-family: 'Century Gothic','Futura','san-serif';
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
       <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th></th>
              <th>Meta</th>
              <th>Facturado</th>
              <th>Proyectado</th>
              <th>Alcance Real</th>
              <th>Alcance Proyectado</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Venta Total</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_relacionado']+$metasvsfacturado['meta_tercero']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero'])*$metasvsfacturado['diashabiles']/$metasvsfacturado['diasacumulados']) ?></td>
              <td><?php echo number_format(($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero'])*100/($metasvsfacturado['meta_relacionado']+$metasvsfacturado['meta_tercero'])) ?>%</td>
              <td><?php echo number_format((($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero'])*$metasvsfacturado['diashabiles']/$metasvsfacturado['diasacumulados'])*100/($metasvsfacturado['meta_relacionado']+$metasvsfacturado['meta_tercero'])) ?>%</td>
            </tr>
            <tr>
              <th>Venta Relacionadas</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_relacionado']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado'])*$metasvsfacturado['diashabiles']/$metasvsfacturado['diasacumulados']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado'])*100/($metasvsfacturado['meta_relacionado'])) ?>%</td>
              <td><?php echo number_format((($metasvsfacturado['facturado_relacionado'])*$metasvsfacturado['diashabiles']/$metasvsfacturado['diasacumulados'])*100/($metasvsfacturado['meta_relacionado'])) ?>%</td>
            </tr>
            <tr>
              <th>Venta Mercado</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_tercero']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_tercero']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_tercero'])*$metasvsfacturado['diashabiles']/$metasvsfacturado['diasacumulados']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_tercero'])*100/($metasvsfacturado['meta_tercero']))?>%</td>
              <td><?php echo number_format((($metasvsfacturado['facturado_tercero'])*$metasvsfacturado['diashabiles']/$metasvsfacturado['diasacumulados'])*100/($metasvsfacturado['meta_tercero'])) ?>%</td>
            </tr>
          </tbody>
         </table>
       </div>
  </div>
<br>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th></th>
            <th>Venta Real</th>
            <th>Distribución</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>RELACIONADAS</th>
            <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado']) ?></td>
            <td><?php echo number_format($metasvsfacturado['facturado_relacionado']*100/($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero']))?>%</td>
          </tr>
          <tr>
            <th>MERCADO</th>
            <td>$ <?php echo number_format($metasvsfacturado['facturado_tercero']) ?></td>
            <td><?php echo number_format($metasvsfacturado['facturado_tercero']*100/($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero'])) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
      <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Mes</th>
            <th>Presupuesto</th>
            <th>Real</th>
            <th>%</th>
          </tr>
        </thead>
        <tbody>
          <?php  $totalmeta=0;    $total=0;
          $presupuesto='';
                $real=''; foreach ($consolidadoanual as $key1): ?>
            <tr>
              <th><?php echo $key1['mes'] ?></th>
              <td>$<?php echo number_format($key1['meta']) ?></td>
              <td>$<?php echo number_format($key1['real']) ?></td>
              <td><?php echo number_format($key1['real']*100/$key1['meta']) ?>%</td>
            </tr>
            <?php  $presupuesto=$presupuesto.str_replace(',','',number_format($key1['meta'])).',' ?>
            <?php  $real=$real.str_replace(',','',number_format($key1['real'])).',' ?>
            <?php $totalmeta=$totalmeta +$key1['meta']?>
          <?php $total=$total+$key1['real']; endforeach; ?>
          <tr>
            <td><b>TOTAL</b></td>
            <td>$<?php echo number_format($totalmeta) ?></td>
            <td>$S<?php echo number_format($total) ?></td>
            <td><?php echo number_format($total*100/$totalmeta) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="presupuestovsreal" style="min-width: 300px; height: 300px; margin: 0 auto">

    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label>PRESUPUESTO VS REAL - RELACIONADAS</label>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Mes</th>
            <th>Presupuesto</th>
            <th>Real</th>
            <th>%</th>
          </tr>
        </thead>
        <tbody>
          <?php  $totalmetarelacionada=0;    $totalrelacionada=0;
          $presupuestorelacionada='';
                $realrelacionada=''; foreach ($consolidadoanualrelacionada as $key2): ?>
            <tr>
              <th><?php echo $key2['mes'] ?></th>
              <td>$<?php echo number_format($key2['meta']) ?></td>
              <td>$<?php echo number_format($key2['real']) ?></td>
              <td><?php echo number_format($key2['real']*100/$key2['meta']) ?>%</td>
            </tr>
            <?php  $presupuestorelacionada=$presupuestorelacionada.$key2['meta'].',' ?>
            <?php  $realrelacionada=$realrelacionada.$key2['real'].',' ?>
            <?php $totalmetarelacionada=$totalmetarelacionada +$key2['meta']?>
          <?php $totalrelacionada=$totalrelacionada+$key2['real']; endforeach; ?>
          <tr>
            <td><b>TOTAL</b></td>
            <td>$<?php echo number_format($totalmetarelacionada) ?></td>
            <td>$S<?php echo number_format($totalrelacionada) ?></td>
            <td><?php echo number_format($totalrelacionada*100/$totalmetarelacionada) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
      <div id="consolidadoanualrelacionada" style="min-width: 310px; height: 400px; margin: 0 auto">
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-4">
    <label>PRESUPUESTO VS REAL -  MERCADO</label>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Mes</th>
            <th>Presupuesto</th>
            <th>Real</th>
            <th>%</th>
          </tr>
        </thead>
        <tbody>
          <?php  $totalmetatercero=0;    $totaltercero=0;
          $presupuestotercero='';
                $realtercero=''; foreach ($consolidadoanualtercero as $key2): ?>
            <tr>
              <th><?php echo $key2['mes'] ?></th>
              <td>$<?php echo number_format($key2['meta']) ?></td>
              <td>$<?php echo number_format($key2['real']) ?></td>
              <td><?php echo number_format($key2['real']*100/$key2['meta']) ?>%</td>
            </tr>
            <?php  $presupuestotercero=$presupuestotercero.$key2['meta'].',' ?>
            <?php  $realtercero=$realtercero.$key2['real'].',' ?>
            <?php $totalmetatercero=$totalmetatercero +$key2['meta']?>
          <?php $totaltercero=$totaltercero+$key2['real']; endforeach; ?>
          <tr>
            <td><b>TOTAL</b></td>
            <td>$<?php echo number_format($totalmetatercero) ?></td>
            <td>$<?php echo number_format($totaltercero) ?></td>
            <td><?php echo number_format($totaltercero*100/$totalmetatercero) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
      <div id="consolidadoanualtercero" style="min-width: 310px; height: 400px; margin: 0 auto">
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-4">
    <label>CLIENTES RELACIONADOS</label>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Mes</th>
            <th>Real</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $presupuesto1='';
                $empresas=''; foreach ($consolidadoxtipo as $key3): ?>
                <?php if ($key3['TIPO_CLIENTE']=='RELACIONADA'): ?>
                  <tr>
                    <th><?php echo $key3['CFNOMBRE'] ?></th>
                    <td>$<?php echo number_format($key3['real']) ?></td>
                  </tr>
                <?php
                $presupuesto1=$presupuesto1.$key3['real'].',';
                $empresas=$empresas.'"'.$key3['CFNOMBRE'].'",';

              endif; ?>
            <?php  endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
      <div id="consolidadorelacionada" style="min-width: 310px; height: 400px; margin: 0 auto">

  </div>
</div>
</div>

<div class="row">
  <div class="col-md-4">
    <label>CLIENTES NO RELACIONADOS / GAVILAN</label>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Mes</th>
            <th>Real</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $presupuesto2='';
                $empresas2=''; foreach ($consolidadoxtipo as $key3): ?>
                <?php if ($key3['TIPO_CLIENTE']=='TERCERO' AND $key3['vendedor']=='GUSTAVO GAVILAN'): ?>
                  <tr>
                    <th><?php echo $key3['CFNOMBRE'] ?></th>
                    <td>$<?php echo number_format($key3['real']) ?></td>
                  </tr>
                <?php
                $presupuesto2=$presupuesto2.$key3['real'].',';
                $empresas2=$empresas2.'"'.$key3['CFNOMBRE'].'",';

              endif; ?>
            <?php  endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
      <div id="consolidadogavilan" style="min-width: 310px; height: 400px; margin: 0 auto">

  </div>
</div>
</div>


<div class="row">
  <div class="col-md-4">
    <label>CLIENTES NO RELACIONADOS / SILVA</label>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Mes</th>
            <th>Real</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $presupuesto3='';
                $empresas3=''; foreach ($consolidadoxtipo as $key3): ?>
                <?php if ($key3['TIPO_CLIENTE']=='TERCERO' AND $key3['vendedor']=='FERNANDO NUÑEZ'): ?>
                  <tr>
                    <th><?php echo $key3['CFNOMBRE'] ?></th>
                    <td>$<?php echo number_format($key3['real']) ?></td>
                  </tr>
                <?php
                $presupuesto3=$presupuesto3.$key3['real'].',';
                $empresas3=$empresas3.'"'.$key3['CFNOMBRE'].'",';

              endif; ?>
            <?php  endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
      <div id="consolidadosilva" style="min-width: 310px; height: 400px; margin: 0 auto">

  </div>
</div>
</div>
<script type="text/javascript">

Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: $('#mes_seleccionado').val()+' '+ $('#año').val()
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: '%',
    colorByPoint: true,
    data: [{
      name: 'Relacionada',
      y: <?php echo number_format($metasvsfacturado['facturado_relacionado']*100/($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero'])) ?>,
      sliced: true,
      selected: true
    }, {
      name: 'Mercado',
      y: <?php echo number_format($metasvsfacturado['facturado_tercero']*100/($metasvsfacturado['facturado_relacionado']+$metasvsfacturado['facturado_tercero'])) ?>
    }]
  }]
});

/////////////////////////////////////////////

Highcharts.chart('presupuestovsreal', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'PRESUPUESTO VS REAL'
  },
  xAxis: {
    categories: [
      'Ene',
      'Feb',
      'Mar',
      'Abr',
      'May',
      'Jun',
      'Jul',
      'Ado',
      'Sep',
      'Oct',
      'Nov',
      'Dic'
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
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.yy:.1f} USD</b></td></tr>',
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
  series: [{
    name: 'Presupuesto',
    data: [<?php echo $presupuesto ?>]

  }, {
    name: 'Real',
    data: [<?php echo $real ?>]

  }]
});

/////////////////////////////////////////////

Highcharts.chart('consolidadoanualrelacionada', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'PRESUPUESTO VS REAL - RELACIONADA'
  },
  subtitle: {
    text: 'Source: WorldClimate.com'
  },
  xAxis: {
    categories: [
      'Ene',
      'Feb',
      'Mar',
      'Abr',
      'May',
      'Jun',
      'Jul',
      'Ado',
      'Sep',
      'Oct',
      'Nov',
      'Dic'
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
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
  series: [{
    name: 'Presupuesto',
    data: [<?php echo $presupuestorelacionada ?>]

  }, {
    name: 'Real',
    data: [<?php echo $realrelacionada ?>]

  }]
});

/////////////////////////////////////////////
Highcharts.chart('consolidadoanualtercero', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'PRESUPUESTO VS REAL - MERCADO'
  },

  xAxis: {
    categories: [
      'Ene',
      'Feb',
      'Mar',
      'Abr',
      'May',
      'Jun',
      'Jul',
      'Ado',
      'Sep',
      'Oct',
      'Nov',
      'Dic'
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
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
  series: [{
    name: 'Presupuesto',
    data: [<?php echo $presupuestotercero ?>]

  }, {
    name: 'Real',
    data: [<?php echo $realtercero ?>]

  }]
});

/////////////////////////////////////////////
Highcharts.chart('consolidadorelacionada', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'CLIENTES RELACIONADOS'
  },

  xAxis: {
    categories: [<?php echo $empresas ?>],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'USD',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ' millions'
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'EMPRESAS RELACIONADOS',
    data: [<?php echo $presupuesto1 ?>]
  }]
});

/////////////////////////////////////////////
Highcharts.chart('consolidadogavilan', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'CLIENTES NO RELACIONADOS / GAVILAN'
  },

  xAxis: {
    categories: [<?php echo $empresas2 ?>],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'USD',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ' USD'
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'GAVILAN',
    data: [<?php echo $presupuesto2 ?>]
  }]
});


/////////////////////////////////////////////
Highcharts.chart('consolidadosilva', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'CLIENTES NO RELACIONADOS / SILVA'
  },

  xAxis: {
    categories: [<?php echo $empresas3 ?>],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'USD',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ' USD'
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'SILVA',
    data: [<?php echo $presupuesto3 ?>]
  }]
});
</script>
