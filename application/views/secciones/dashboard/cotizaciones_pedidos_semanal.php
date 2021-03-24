<?php if ($tipo=='relacionado'): ?>

  <div class="row">
    <div class="col-md-6">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>SEMANA</th>
              <th>COTIZADO</th>
              <th>PEDIDO</th>
              <th>EFECTIVIDAD</th>
              <th>EFECTIVIDAD ACUMULADO</th>
              <th>OBJETIVO</th>

            </tr>
          </thead>
          <tbody>
            <?php $categoria='';
                  $montosemana='';
                  $montoacumulado='';
                  $efectividadcoti='';
                  $efectividadacumulada='';
                  $objetivo='';
                  $montocotizacion='';
                  $montopedido='';?>
            <?php $cotizaciones=0;
            $pedidos=0;
            foreach ($cotizaciones_pedidos_semanal as $key): ?>
                  <tr>
                    <?php $cotizaciones=$cotizaciones+$key['cotizacion'] ;
                    $pedidos=$pedidos+$key['pedido']; ?>
                    <th><?php echo 'S'.$key['semana'] ?></th>
                    <td><?php echo number_format($key['cotizacion'])?></td>
                    <td><?php echo number_format($key['pedido'])?></td>
                    <?php if ($key['cotizacion']==0): ?>
                      <td>0%</td>
                      <td>0%</td>
                      <?php else: ?>
                    <td><?php echo number_format($key['pedido']*100/$key['cotizacion'])?>%</td>
                    <td><?php echo  number_format($pedidos*100/$cotizaciones) ?>%</td>
                    <?php endif; ?>


                    <td><?php echo $objetivopor ?>%</td>
                  </tr>
                  <?php
                  $categoria=$categoria.'"S'.$key['semana'].'",';
                  $montocotizacion=$montocotizacion.str_replace(',','',number_format($key['cotizacion'])).',';
                  $montopedido=$montopedido.str_replace(',','',number_format($key['pedido'])).',';

                  if ($key['cotizacion']==0) {
                    $efectividadcoti=$efectividadcoti.'0,';
                    $efectividadacumulada=$efectividadacumulada.'0,';
                  } else {
                    $efectividadcoti=$efectividadcoti.str_replace(',','',number_format($key['pedido']*100/$key['cotizacion'])).',';
                    $efectividadacumulada=$efectividadacumulada.str_replace(',','',number_format($pedidos*100/$cotizaciones)).',';
                  }

                  $objetivo=$objetivo.$objetivopor.','
                  ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-md-6">

    <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  </div>
  <div class="col-md-6">

    <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  </div>
  </div>
<?php elseif ($tipo=='terceros'): ?>
  <div class="row">
    <div class="col-md-12">
      <h3>MERCADO - FERNANDO NUÑEZ</h3>
    </div>
  </div>
    <div class="row">
      <div class="col-md-6">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>SEMANA</th>
                <th>COTIZADO</th>
                <th>PEDIDO</th>
                <th>EFECTIVIDAD</th>
                <th>EFECTIVIDAD ACUMULADO</th>
                <th>OBJETIVO</th>

              </tr>
            </thead>
            <tbody>
              <?php $categorianunez='';
                    $montosemananunez='';
                    $montoacumuladonunez='';
                    $efectividadcotinunez='';
                    $efectividadacumuladanunez='';
                    $objetivonunez='';
                    $montocotizacionnunez='';
                    $montopedidonunez='';?>
              <?php $cotizacionesnunez=0;
              $pedidosnunez=0;
              foreach ($cotizaciones_pedidos_semanalnunez as $key): ?>
                    <tr>
                      <?php $cotizacionesnunez=$cotizacionesnunez+$key['cotizacion'] ;
                      $pedidosnunez=$pedidosnunez+$key['pedido']; ?>
                      <th><?php echo 'S'.$key['semana'] ?></th>
                      <td><?php echo number_format($key['cotizacion'])?></td>
                      <td><?php echo number_format($key['pedido'])?></td>
                      <?php if ($key['cotizacion']==0): ?>
                        <td>0%</td>
                        <td>0%</td>
                        <?php else: ?>
                      <td><?php echo number_format($key['pedido']*100/$key['cotizacion'])?>%</td>
                      <td><?php echo  number_format($pedidosnunez*100/$cotizacionesnunez) ?>%</td>
                      <?php endif; ?>


                      <td><?php echo $objetivopor ?>%</td>
                    </tr>
                    <?php
                    $categorianunez=$categorianunez.'"S'.$key['semana'].'",';
                    $montocotizacionnunez=$montocotizacionnunez.str_replace(',','',number_format($key['cotizacion'])).',';
                    $montopedidonunez=$montopedidonunez.str_replace(',','',number_format($key['pedido'])).',';

                    if ($key['cotizacion']==0) {
                      $efectividadcotinunez=$efectividadcotinunez.'0,';
                      $efectividadacumuladanunez=$efectividadacumuladanunez.'0,';
                    } else {
                      $efectividadcotinunez=$efectividadcotinunez.str_replace(',','',number_format($key['pedido']*100/$key['cotizacion'])).',';
                      $efectividadacumuladanunez=$efectividadacumuladanunez.str_replace(',','',number_format($pedidosnunez*100/$cotizacionesnunez)).',';
                    }

                    $objetivonunez=$objetivonunez.$objetivopor.','
                    ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-6">

      <div id="container1nunez" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
    <div class="col-md-6">

      <div id="container2nunez" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
  </div><br>
    <div class="row">
      <div class="col-md-12">
        <h3>MERCADO - GUSTAVO GAVILÁN</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>SEMANA</th>
                <th>COTIZADO</th>
                <th>PEDIDO</th>
                <th>EFECTIVIDAD</th>
                <th>EFECTIVIDAD ACUMULADO</th>
                <th>OBJETIVO</th>

              </tr>
            </thead>
            <tbody>
              <?php $categoriagavilan='';
                    $montosemanagavilan='';
                    $montoacumuladogavilan='';
                    $efectividadcotigavilan='';
                    $efectividadacumuladagavilan='';
                    $objetivogavilan='';
                    $montocotizaciongavilan='';
                    $montopedidogavilan='';?>
              <?php $cotizacionesgavilan=0;
              $pedidosgavilan=0;
              foreach ($cotizaciones_pedidos_semanalgavilan as $key): ?>
                    <tr>
                      <?php $cotizacionesgavilan=$cotizacionesgavilan+$key['cotizacion'] ;
                      $pedidosgavilan=$pedidosgavilan+$key['pedido']; ?>
                      <th><?php echo 'S'.$key['semana'] ?></th>
                      <td><?php echo number_format($key['cotizacion'])?></td>
                      <td><?php echo number_format($key['pedido'])?></td>
                      <?php if ($key['cotizacion']==0): ?>
                        <td>0%</td>
                        <td>0%</td>
                        <?php else: ?>
                      <td><?php echo number_format($key['pedido']*100/$key['cotizacion'])?>%</td>
                      <td><?php echo  number_format($pedidosgavilan*100/$cotizacionesgavilan) ?>%</td>
                      <?php endif; ?>


                      <td><?php echo $objetivopor ?>%</td>
                    </tr>
                    <?php
                    $categoriagavilan=$categoriagavilan.'"S'.$key['semana'].'",';
                    $montocotizaciongavilan=$montocotizaciongavilan.str_replace(',','',number_format($key['cotizacion'])).',';
                    $montopedidogavilan=$montopedidogavilan.str_replace(',','',number_format($key['pedido'])).',';

                    if ($key['cotizacion']==0) {
                      $efectividadcotigavilan=$efectividadcotigavilan.'0,';
                      $efectividadacumuladagavilan=$efectividadacumuladagavilan.'0,';
                    } else {
                      $efectividadcotigavilan=$efectividadcotigavilan.str_replace(',','',number_format($key['pedido']*100/$key['cotizacion'])).',';
                      $efectividadacumuladagavilan=$efectividadacumuladagavilan.str_replace(',','',number_format($pedidosgavilan*100/$cotizacionesgavilan)).',';
                    }

                    $objetivogavilan=$objetivogavilan.$objetivopor.','
                    ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-6">

      <div id="container1gavilan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
    <div class="col-md-6">

      <div id="container2gavilan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
    </div><br>
      <div class="row">
        <div class="col-md-12">
          <h3>MERCADO - CODRISE VENTAS</h3>
        </div>
      </div>

    <div class="row">
      <div class="col-md-6">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>SEMANA</th>
                <th>COTIZADO</th>
                <th>PEDIDO</th>
                <th>EFECTIVIDAD</th>
                <th>EFECTIVIDAD ACUMULADO</th>
                <th>OBJETIVO</th>

              </tr>
            </thead>
            <tbody>
              <?php $categoriacds='';
                    $montosemanacds='';
                    $montoacumuladocds='';
                    $efectividadcoticds='';
                    $efectividadacumuladacds='';
                    $objetivocds='';
                    $montocotizacioncds='';
                    $montopedidocds='';?>
              <?php $cotizacionescds=0;
              $pedidoscds=0;
              foreach ($cotizaciones_pedidos_semanalcds as $key): ?>
                    <tr>
                      <?php $cotizacionescds=$cotizacionescds+$key['cotizacion'] ;
                      $pedidoscds=$pedidoscds+$key['pedido']; ?>
                      <th><?php echo 'S'.$key['semana'] ?></th>
                      <td><?php echo number_format($key['cotizacion'])?></td>
                      <td><?php echo number_format($key['pedido'])?></td>
                      <?php if ($key['cotizacion']==0): ?>
                        <td>0%</td>
                        <td>0%</td>
                        <?php else: ?>
                      <td><?php echo number_format($key['pedido']*100/$key['cotizacion'])?>%</td>
                      <td><?php echo  number_format($pedidoscds*100/$cotizacionescds) ?>%</td>
                      <?php endif; ?>


                      <td><?php echo $objetivopor ?>%</td>
                    </tr>
                    <?php
                    $categoriacds=$categoriacds.'"S'.$key['semana'].'",';
                    $montocotizacioncds=$montocotizacioncds.str_replace(',','',number_format($key['cotizacion'])).',';
                    $montopedidocds=$montopedidocds.str_replace(',','',number_format($key['pedido'])).',';

                    if ($key['cotizacion']==0) {
                      $efectividadcoticds=$efectividadcoticds.'0,';
                      $efectividadacumuladacds=$efectividadacumuladacds.'0,';
                    } else {
                      $efectividadcoticds=$efectividadcoticds.str_replace(',','',number_format($key['pedido']*100/$key['cotizacion'])).',';
                      $efectividadacumuladacds=$efectividadacumuladacds.str_replace(',','',number_format($pedidoscds*100/$cotizacionescds)).',';
                    }

                    $objetivocds=$objetivocds.$objetivopor.','
                    ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-6">

      <div id="container1cds" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
    <div class="col-md-6">

      <div id="container2cds" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
<?php if ($tipo=="relacionado"): ?>
Highcharts.chart('container1', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'COTIZACIÓN VS PEDIDO - SEMANAL'
  },
  xAxis: {
      categories: [<?php echo $categoria ?>],
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
  series: [{
      name: 'COTIZACIONES',
      data: [<?php echo $montocotizacion ?>]

  }, {
      name: 'PEDIDOS',
      data: [<?php echo $montopedido ?>]

  }]
});

Highcharts.chart('container2', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - SEMANAL'
    },
    xAxis: {
        categories: [<?php echo $categoria ?>]
    },
    yAxis: {
        title: {
            text: 'Efectividad %'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Efectividad Cotizaciones',
        data: [<?php echo $efectividadcoti ?>]
    }, {
        name: 'Efectividad Acumulada',
        data: [<?php echo $efectividadacumulada ?>]
    },{
        name: 'Objetivo',
        data: [<?php echo $objetivo ?>]
    }]
});
<?php elseif($tipo=="terceros"): ?>
Highcharts.chart('container1nunez', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'COTIZACIÓN VS PEDIDO - SEMANAL'
  },
  xAxis: {
      categories: [<?php echo $categorianunez ?>],
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
  series: [{
      name: 'COTIZACIONES',
      data: [<?php echo $montocotizacionnunez ?>]

  }, {
      name: 'PEDIDOS',
      data: [<?php echo $montopedidonunez ?>]

  }]
});

Highcharts.chart('container2nunez', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - SEMANAL (MERCADO - FERNANDO NUNEZ)'
    },
    xAxis: {
        categories: [<?php echo $categorianunez ?>]
    },
    yAxis: {
        title: {
            text: 'Efectividad %'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Efectividad Cotizaciones',
        data: [<?php echo $efectividadcotinunez ?>]
    }, {
        name: 'Efectividad Acumulada',
        data: [<?php echo $efectividadacumuladanunez ?>]
    },{
        name: 'Objetivo',
        data: [<?php echo $objetivonunez ?>]
    }]
});
Highcharts.chart('container1gavilan', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'COTIZACIÓN VS PEDIDO - SEMANAL (MERCADO - GUSTAVO GAVILÁN)'
  },
  xAxis: {
      categories: [<?php echo $categoriagavilan ?>],
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
  series: [{
      name: 'COTIZACIONES',
      data: [<?php echo $montocotizaciongavilan ?>]

  }, {
      name: 'PEDIDOS',
      data: [<?php echo $montopedidogavilan ?>]

  }]
});

Highcharts.chart('container2gavilan', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - SEMANAL (MERCADO - GUSTAVO GAVILÁN)'
    },
    xAxis: {
        categories: [<?php echo $categoriagavilan ?>]
    },
    yAxis: {
        title: {
            text: 'Efectividad %'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Efectividad Cotizaciones',
        data: [<?php echo $efectividadcotigavilan ?>]
    }, {
        name: 'Efectividad Acumulada',
        data: [<?php echo $efectividadacumuladagavilan ?>]
    },{
        name: 'Objetivo',
        data: [<?php echo $objetivogavilan ?>]
    }]
});
Highcharts.chart('container1cds', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'COTIZACIÓN VS PEDIDO - SEMANAL (MERCADO - CODRISE VENTAS)'
  },
  xAxis: {
      categories: [<?php echo $categoriacds ?>],
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
  series: [{
      name: 'COTIZACIONES',
      data: [<?php echo $montocotizacioncds ?>]

  }, {
      name: 'PEDIDOS',
      data: [<?php echo $montopedidocds ?>]

  }]
});

Highcharts.chart('container2cds', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'COTIZACIÓN VS PEDIDO - SEMANAL (MERCADO - CODRISE VENTAS)'
    },
    xAxis: {
        categories: [<?php echo $categoriacds ?>]
    },
    yAxis: {
        title: {
            text: 'Efectividad %'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Efectividad Cotizaciones',
        data: [<?php echo $efectividadcoticds ?>]
    }, {
        name: 'Efectividad Acumulada',
        data: [<?php echo $efectividadacumuladacds ?>]
    },{
        name: 'Objetivo',
        data: [<?php echo $objetivocds ?>]
    }]
});
<?php endif; ?>

</script>
