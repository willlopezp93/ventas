<div class="row">
  <div class="col-md-12">
    <H3><CENTER>VENTAS SEMANALES</CENTER></H3>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>SEMANA</th>
            <th>MONTO FACTURADO</th>
            <th>ACUMULATIVO</th>
            <th>ALCANCE</th>
          </tr>
        </thead>
        <tbody>
          <?php $categoria='';
                $montosemana='';
                $montoacumulado='';?>
          <?php $MONTO=0; foreach ($facturadoxsemana as $key): ?>
            <?php foreach ($facturacion_suministro as $key2): ?>
              <?php if ('S'.$key['semana']==$key2->semana ): ?>
                <tr>
                                <?php $MONTO=$MONTO+$key['monto']+$key2->monto_facturado  ?>
                  <th><?php echo 'S'.$key['semana'] ?></th>
                  <td><?php echo number_format($key['monto']+$key2->monto_facturado )?></td>
                  <td><?php echo  number_format($MONTO) ?></td>
                  <td><?php echo number_format($MONTO*100/($meta_anualxsemana->meta_relacionada+$meta_anualxsemana->meta_tercero)) ?>%</td>
                </tr>
                <?php
                $categoria=$categoria.'"S'.$key['semana'].'",';
                $montosemana=$montosemana.str_replace(',','',number_format($key['monto']+$key2->monto_facturado )).',';
                $montoacumulado=$montoacumulado.str_replace(',','',number_format($MONTO-$key['monto']-$key2->monto_facturado)).',';
                ?>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
          <tr>
            <tr>
              <th colspan="3"><center>META</center></th>
              <td><?php echo number_format($meta_anualxsemana->meta_relacionada+$meta_anualxsemana->meta_tercero) ?></td>
            </tr>
          </tr>
        </tbody>
      </table>
      <br>
      <?php if ($tipo=='manual'): ?>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th colspan="2">CONTRATO DE SUMINISTRO</th>
            </tr>
            <tr>
              <th>SEMANA</th>
              <th>FACTURADO</th>
              <th>CONSUMO DE SUMINISTRO</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($facturacion_suministro as $key): ?>
              <?php foreach ($facturadoxsemana as $key2): ?>
                <?php if ('S'.$key2['semana']==$key->semana ): ?>
                  <tr>
                    <th><?php echo $key->semana ?></th>
                    <td><?php echo number_format($key2['monto'] )?></td>
                    <td><?php echo number_format($key->monto_facturado) ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-md-6">

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <H3><CENTER>VENTAS SEMANALES - CLIENTE RELACIONADOS</CENTER></H3>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>SEMANA</th>
            <th>MONTO FACTURADO</th>
            <th>ACUMULATIVO</th>
            <th>ALCANCE</th>
          </tr>
        </thead>
        <tbody>
          <?php $categoria1='';
                $montosemana1='';
                $montoacumulado1='';?>
          <?php $MONTO1=0; foreach ($meta_clienterelacionadoxsemana as $key): ?>
            <?php foreach ($facturacion_suministro as $key2): ?>
              <?php if('S'.$key['semana']==$key2->semana): ?>
                <tr>
                      <?php $MONTO1=$MONTO1+$key['monto']+$key2->monto_facturado  ?>
                  <th><?php echo 'S'.$key['semana'] ?></th>
                  <td><?php echo number_format($key['monto']+$key2->monto_facturado  )?></td>
                  <td><?php echo  number_format($MONTO1) ?></td>
                  <td><?php echo number_format($MONTO1*100/($meta_anualxsemana->meta_relacionada)) ?>%</td>
                </tr>
                <?php
                $categoria1=$categoria1.'"S'.$key['semana'].'",';
                $montosemana1=$montosemana1.str_replace(',','',number_format($key['monto']+$key2->monto_facturado  )).',';
                $montoacumulado1=$montoacumulado1.str_replace(',','',number_format($MONTO1-$key['monto']-$key2->monto_facturado )).',';
                ?>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
          <tr>
            <tr>
              <th colspan="3"><center>META</center></th>
              <td><?php echo number_format($meta_anualxsemana->meta_relacionada) ?></td>
            </tr>
          </tr>
        </tbody>
      </table>
      <br>
      <?php if ($tipo=='manual'): ?>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th colspan="2">CONTRATO DE SUMINISTRO</th>
            </tr>
            <tr>
              <th>SEMANA</th>
              <th>MONTO FACTURADO</th>
              <th>CONSUMO DE SUMINISTRO</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($facturacion_suministro as $key): ?>
              <?php foreach ($meta_clienterelacionadoxsemana as $key2): ?>
                <?php if ('S'.$key2['semana']==$key->semana ): ?>
                  <tr>
                    <th><?php echo $key->semana ?></th>
                    <td><?php echo number_format($key2['monto'] )?></td>
                    <td><?php echo number_format($key->monto_facturado) ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-md-6">

    <div id="meta_clienterelacionadoxsemana" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  </div>
</div>
<br>
  <?php foreach ($empresarelacionadoxsemana as $key2): ?>
    <?php if ($key2->CFCODCLI=='20469962246'): ?>
      <br>
      <div class="row">
        <div class="col-md-12">
          <label>VENTAS SEMANALES - <?php echo $key2->CFNOMBRE ?></label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>SEMANA</th>
                  <th>MONTO FACTURADO</th>
                  <th>ACUMULATIVO</th>
                  <th>ALCANCE</th>
                </tr>
              </thead>
              <tbody>

                <?php $MONTO5=0; foreach ($meta_empresarelacionadoxsemana as $key): ?>
                  <?php foreach ($facturacion_suministro as $key3): ?>
                      <?php if ($key['CFCODCLI']==$key2->CFCODCLI): ?>
                        <?php if ('S'.$key['semana']==$key3->semana ): ?>
                        <tr>
                                        <?php $MONTO5=$MONTO5+$key['monto']+$key3->monto_facturado ?>
                          <th><?php echo 'S'.$key['semana'] ?></th>
                          <td><?php echo number_format($key['monto']+$key3->monto_facturado )?></td>
                          <td><?php echo  number_format($MONTO5) ?></td>
                          <td><?php echo number_format($MONTO5*100/($meta_anualxsemana->meta_relacionada)) ?>%</td>
                        </tr>
                      <?php endif; ?>

                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endforeach; ?>
                <tr>
                  <tr>
                    <th colspan="3"><center>META</center></th>
                    <td><?php echo number_format($meta_anualxsemana->meta_relacionada*0.8) ?></td>
                  </tr>
                </tr>
              </tbody>
            </table>
            <br>
            <?php if ($tipo=='manual'): ?>
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th colspan="2">CONTRATO DE SUMINISTRO</th>
                  </tr>
                  <tr>
                    <th>SEMANA</th>
                    <th>MONTO FACTURADO</th>
                    <th>CONSUMO DE SUMINISTRO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($facturacion_suministro as $key): ?>
                    <?php foreach ($meta_empresarelacionadoxsemana as $key3): ?>
                      <?php if ($key3['CFCODCLI']=='20469962246'): ?>
                        <?php if ('S'.$key3['semana']==$key->semana ): ?>
                          <tr>
                            <th><?php echo $key->semana ?></th>
                            <td><?php echo number_format($key3['monto'] )?></td>
                            <td><?php echo number_format($key->monto_facturado) ?></td>
                          </tr>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-md-6">

          <div id="empresa<?php echo $key2->CFCODCLI ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        </div>
      </div>


      <?php else: ?>
        <br>
        <div class="row">
          <div class="col-md-12">
            <label>VENTAS SEMANALES - <?php echo $key2->CFNOMBRE ?></label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>SEMANA</th>
                    <th>MONTO FACTURADO</th>
                    <th>ACUMULATIVO</th>
                    <th>ALCANCE</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $MONTO5=0; foreach ($meta_empresarelacionadoxsemana as $key): ?>
                    <?php if ($key['CFCODCLI']==$key2->CFCODCLI): ?>
                      <tr>
                                      <?php $MONTO5=$MONTO5+$key['monto'] ?>
                        <th><?php echo 'S'.$key['semana'] ?></th>
                        <td><?php echo number_format($key['monto'] )?></td>
                        <td><?php echo  number_format($MONTO5) ?></td>
                        <td><?php echo number_format($MONTO5*100/($meta_anualxsemana->meta_relacionada)) ?>%</td>
                      </tr>
                    <?php endif; ?>

                  <?php endforeach; ?>
                  <tr>
                    <tr>
                      <th colspan="3"><center>META</center></th>
                      <?php
                      if ($key2->CFCODCLI=='20600670949') {
                        $porcentaje=0.005;
                      }elseif ($key2->CFCODCLI=='20535689394') {
                        $porcentaje=0.025;
                      } elseif ($key2->CFCODCLI='OD151012DG7') {
                        $porcentaje=0.17;
                      }
                       ?>
                         <td><?php echo number_format($meta_anualxsemana->meta_relacionada*$porcentaje) ?></td>
                    </tr>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">

            <div id="empresa<?php echo $key2->CFCODCLI ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

          </div>
        </div>
    <?php endif; ?>
  <?php endforeach; ?>
  <div class="row">
    <div class="col-md-12">
      <label>VENTAS SEMANALES - CLIENTE TERCEROS </label>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>SEMANA</th>
              <th>MONTO FACTURADO</th>
              <th>ACUMULATIVO</th>
              <th>ALCANCE</th>
            </tr>
          </thead>
          <tbody>
            <?php $categoria2='';
                  $montosemana2='';
                  $montoacumulado2='';?>
            <?php $MONTO2=0; foreach ($meta_clienteterceroxsemana as $key): ?>

                <tr>
                                <?php $MONTO2=$MONTO2+$key['monto'] ?>
                  <th><?php echo 'S'.$key['semana'] ?></th>
                  <td><?php echo number_format($key['monto'] )?></td>
                  <td><?php echo  number_format($MONTO2) ?></td>
                  <td><?php echo number_format($MONTO2*100/($meta_anualxsemana->meta_tercero)) ?>%</td>
                </tr>
                <?php
                $categoria2=$categoria2.'"S'.$key['semana'].'",';
                $montosemana2=$montosemana2.str_replace(',','',number_format($key['monto'] )).',';
                $montoacumulado2=$montoacumulado2.str_replace(',','',number_format($MONTO2-$key['monto'])).',';
                ?>
            <?php endforeach; ?>
            <tr>
              <tr>
                <th colspan="3"><center>META</center></th>
                <td><?php echo number_format($meta_anualxsemana->meta_tercero) ?></td>
              </tr>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6">

      <div id="meta_clienteterceroxsemana" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
  </div>
  <?php foreach ($vendedorxsemana as $key2): ?>
    <?php if ($key2->COD_VEN !='07' ): ?>
      <div class="row">
        <div class="col-md-12">
          <label>VENTAS SEMANALES - CLIENTE TERCEROS <?php echo $key2->VENDEDOR ?></label>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>SEMANA</th>
                  <th>MONTO FACTURADO</th>
                  <th>ACUMULATIVO</th>
                  <th>ALCANCE</th>
                </tr>
              </thead>
              <tbody>
                <?php $MONTO6=0; foreach ($meta_tercerovendedorxsemana as $key): ?>
                  <?php if ($key['COD_VEN']==$key2->COD_VEN): ?>
                    <tr>
                                    <?php $MONTO6=$MONTO6+$key['monto'] ?>
                      <th><?php echo 'S'.$key['semana'] ?></th>
                      <td><?php echo number_format($key['monto'] )?></td>
                      <td><?php echo  number_format($MONTO6) ?></td>
                      <td><?php echo number_format($MONTO6*100/($meta_anualxsemana->meta_tercero/2)) ?>%</td>
                    </tr>

                  <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                  <tr>
                    <th colspan="3"><center>META</center></th>
                    <td><?php echo number_format($meta_anualxsemana->meta_tercero/2) ?></td>
                  </tr>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6">

          <div id="vendedorxsemana<?php echo $key2->COD_VEN ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        </div>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
<script type="text/javascript">

Highcharts.chart('container', {
chart: {
  type: 'column'
},
title: {
  text: 'VENTAS SEMANALES'
},
xAxis: {
  categories: [<?php echo $categoria.'"META"' ?>]
},
yAxis: {
  min: 0,
  title: {
    text: 'MONTOS (USD)'
  },
  stackLabels: {
    enabled: true,
    style: {
      fontWeight: 'bold',
      color: ( // theme
        Highcharts.defaultOptions.title.style &&
        Highcharts.defaultOptions.title.style.color
      ) || 'gray'
    }
  }
},
legend: {
  align: 'right',
  x: -30,
  verticalAlign: 'top',
  y: 25,
  floating: true,
  backgroundColor:
    Highcharts.defaultOptions.legend.backgroundColor || 'white',
  borderColor: '#CCC',
  borderWidth: 1,
  shadow: false
},
tooltip: {
  headerFormat: '<b>{point.x}</b><br/>',
  pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal} USD'
},
plotOptions: {
  column: {
    stacking: 'normal',
    dataLabels: {
      enabled: true
    }
  }
},
series: [{
  name: 'Semana',
  data: [<?php echo $montosemana.'0' ?>]
}, {
  name: 'Acumulado',
  data: [<?php echo $montoacumulado.str_replace(',','',number_format($meta_anualxsemana->meta_relacionada+$meta_anualxsemana->meta_tercero)) ?>]
}]
});

Highcharts.chart('meta_clienterelacionadoxsemana', {
chart: {
  type: 'column'
},
title: {
  text: 'VENTAS SEMANALES - CLIENTES RELACIONADOS'
},
xAxis: {
  categories: [<?php echo $categoria1.'"META"' ?>]
},
yAxis: {
  min: 0,
  title: {
    text: 'MONTOS (USD)'
  },
  stackLabels: {
    enabled: true,
    style: {
      fontWeight: 'bold',
      color: ( // theme
        Highcharts.defaultOptions.title.style &&
        Highcharts.defaultOptions.title.style.color
      ) || 'gray'
    }
  }
},
legend: {
  align: 'right',
  x: -30,
  verticalAlign: 'top',
  y: 25,
  floating: true,
  backgroundColor:
    Highcharts.defaultOptions.legend.backgroundColor || 'white',
  borderColor: '#CCC',
  borderWidth: 1,
  shadow: false
},
tooltip: {
  headerFormat: '<b>{point.x}</b><br/>',
  pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal} USD'
},
plotOptions: {
  column: {
    stacking: 'normal',
    dataLabels: {
      enabled: true
    }
  }
},
series: [{
  name: 'Semana',
  data: [<?php echo $montosemana1.'0' ?>]
}, {
  name: 'Acumulado',
  data: [<?php echo $montoacumulado1.str_replace(',','',number_format($meta_anualxsemana->meta_relacionada)) ?>]
}]
});

Highcharts.chart('meta_clienteterceroxsemana', {
chart: {
  type: 'column'
},
title: {
  text: 'VENTAS SEMANALES - CLIENTES TERCEROS'
},
xAxis: {
  categories: [<?php echo $categoria2.'"META"' ?>]
},
yAxis: {
  min: 0,
  title: {
    text: 'MONTOS (USD)'
  },
  stackLabels: {
    enabled: true,
    style: {
      fontWeight: 'bold',
      color: ( // theme
        Highcharts.defaultOptions.title.style &&
Highcharts.defaultOptions.title.style.color
) || 'gray'
}
}
},
legend: {
align: 'right',
x: -30,
verticalAlign: 'top',
y: 25,
floating: true,
backgroundColor:
Highcharts.defaultOptions.legend.backgroundColor || 'white',
borderColor: '#CCC',
borderWidth: 1,
shadow: false
},
tooltip: {
headerFormat: '<b>{point.x}</b><br/>',
pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal} USD'
},
plotOptions: {
column: {
stacking: 'normal',
dataLabels: {
enabled: true
}
}
},
series: [{
name: 'Semana',
data: [<?php echo $montosemana2.'0' ?>]
}, {
name: 'Acumulado',
data: [<?php echo $montoacumulado2.str_replace(',','',number_format($meta_anualxsemana->meta_tercero)) ?>]
}]
});

<?php foreach ($empresarelacionadoxsemana as $key2): ?>
  <?php if ($key2->CFCODCLI=='20469962246'): ?>

    Highcharts.chart('empresa<?php echo $key2->CFCODCLI ?>', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'VENTAS SEMANALES - EMPRESA <?php echo $key2->CFNOMBRE ?>'
    },
    xAxis: {
      <?php
      $categoria4='';
      $montosemana4='';
      $montoacumulado4='';
      ?>
      <?php $MONTO4=0; foreach ($meta_empresarelacionadoxsemana as $key): ?>
      <?php foreach ($facturacion_suministro as $key3): ?>
      <?php if ($key3->semana=='S'.$key['semana']): ?>
      <?php if ($key['CFCODCLI']==$key2->CFCODCLI): ?>
      <?php
        $MONTO4=$MONTO4+$key['monto']+$key3->monto_facturado;
        $categoria4=$categoria4.'"S'.$key['semana'].'",';
        $montosemana4=$montosemana4.str_replace(',','',number_format($key['monto']+$key3->monto_facturado )).',';
        $montoacumulado4=$montoacumulado4.str_replace(',','',number_format($MONTO4-$key['monto']-$key3->monto_facturado)).','; ?>
      <?php endif; ?>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php endforeach; ?>
      categories: [<?php echo $categoria4.'"META"' ?>]
    },
    yAxis: {
      min: 0,
      title: {
        text: 'MONTOS (USD)'
      },
      stackLabels: {
        enabled: true,
        style: {
          fontWeight: 'bold',
          color: ( // theme
            Highcharts.defaultOptions.title.style &&
    Highcharts.defaultOptions.title.style.color
    ) || 'gray'
    }
    }
    },
    legend: {
    align: 'right',
    x: -30,
    verticalAlign: 'top',
    y: 25,
    floating: true,
    backgroundColor:
    Highcharts.defaultOptions.legend.backgroundColor || 'white',
    borderColor: '#CCC',
    borderWidth: 1,
    shadow: false
    },
    tooltip: {
    headerFormat: '<b>{point.x}</b><br/>',
    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal} USD'
    },
    plotOptions: {
    column: {
    stacking: 'normal',
    dataLabels: {
    enabled: true
    }
    }
    },
    series: [{
    name: 'Semana',
    data: [<?php echo $montosemana4 ?>]
    }, {
    name: 'Acumulado',
    data: [<?php echo $montoacumulado4.str_replace(',','',number_format($meta_anualxsemana->meta_relacionada*0.8)) ?>]
    }]
    });
  <?php else: ?>

    Highcharts.chart('empresa<?php echo $key2->CFCODCLI ?>', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'VENTAS SEMANALES - EMPRESA <?php echo $key2->CFNOMBRE ?>'
    },
    xAxis: {
      <?php
      $categoria4='';
      $montosemana4='';
      $montoacumulado4='';
      ?>
      <?php $MONTO4=0; foreach ($meta_empresarelacionadoxsemana as $key): ?>
      <?php if ($key['CFCODCLI']==$key2->CFCODCLI): ?>
      <?php
        $MONTO4=$MONTO4+$key['monto'];
        $categoria4=$categoria4.'"S'.$key['semana'].'",';
        $montosemana4=$montosemana4.str_replace(',','',number_format($key['monto'] )).',';
        $montoacumulado4=$montoacumulado4.str_replace(',','',number_format($MONTO4-$key['monto'])).','; ?>
      <?php endif; ?>
      <?php endforeach; ?>
      categories: [<?php echo $categoria4.'"META"' ?>]
    },
    yAxis: {
      min: 0,
      title: {
        text: 'MONTOS (USD)'
      },
      stackLabels: {
        enabled: true,
        style: {
          fontWeight: 'bold',
          color: ( // theme
            Highcharts.defaultOptions.title.style &&
    Highcharts.defaultOptions.title.style.color
    ) || 'gray'
    }
    }
    },
    legend: {
    align: 'right',
    x: -30,
    verticalAlign: 'top',
    y: 25,
    floating: true,
    backgroundColor:
    Highcharts.defaultOptions.legend.backgroundColor || 'white',
    borderColor: '#CCC',
    borderWidth: 1,
    shadow: false
    },
    tooltip: {
    headerFormat: '<b>{point.x}</b><br/>',
    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal} USD'
    },
    plotOptions: {
    column: {
    stacking: 'normal',
    dataLabels: {
    enabled: true
    }
    }
    },
    series: [{
    name: 'Semana',
    data: [<?php echo $montosemana4 ?>]
    }, {
      <?php
      if ($key2->CFCODCLI=='20600670949') {
        $porcentaje=0.005;
      }elseif ($key2->CFCODCLI=='20535689394') {
        $porcentaje=0.025;
      } elseif ($key2->CFCODCLI='OD151012DG7') {
        $porcentaje=0.17;
      }
       ?>
    name: 'Acumulado',
    data: [<?php echo $montoacumulado4.str_replace(',','',number_format($meta_anualxsemana->meta_relacionada*$porcentaje)) ?>]
    }]
    });
  <?php endif; ?>
<?php endforeach; ?>

<?php foreach ($vendedorxsemana as $key2): ?>
  <?php if ($key2->COD_VEN!='07'): ?>

  Highcharts.chart('vendedorxsemana<?php echo $key2->COD_VEN ?>', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'VENTAS SEMANALES - VENDEDOR <?php echo $key2->VENDEDOR ?>'
  },
  xAxis: {
    <?php
    $categoria6='';
    $montosemana6='';
    $montoacumulado6='';
    ?>
    <?php $MONTO6=0; foreach ($meta_tercerovendedorxsemana as $key): ?>
    <?php if ($key['COD_VEN']==$key2->COD_VEN): ?>
    <?php
      $MONTO6=$MONTO6+$key['monto'];
      $categoria6=$categoria6.'"S'.$key['semana'].'",';
      $montosemana6=$montosemana6.str_replace(',','',number_format($key['monto'] )).',';
      $montoacumulado6=$montoacumulado6.str_replace(',','',number_format($MONTO6-($key['monto']))).','; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    categories: [<?php echo $categoria6.'"META"' ?>]
  },
  yAxis: {
    min: 0,
    title: {
      text: 'MONTOS (USD)'
    },
    stackLabels: {
      enabled: true,
      style: {
        fontWeight: 'bold',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
  Highcharts.defaultOptions.title.style.color
  ) || 'gray'
  }
  }
  },
  legend: {
  align: 'right',
  x: -30,
  verticalAlign: 'top',
  y: 25,
  floating: true,
  backgroundColor:
  Highcharts.defaultOptions.legend.backgroundColor || 'white',
  borderColor: '#CCC',
  borderWidth: 1,
  shadow: false
  },
  tooltip: {
  headerFormat: '<b>{point.x}</b><br/>',
  pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal} USD'
  },
  plotOptions: {
  column: {
  stacking: 'normal',
  dataLabels: {
  enabled: true
  }
  }
  },
  series: [{
  name: 'Semana',
  data: [<?php echo $montosemana6 ?>]
  }, {
  name: 'Acumulado',
  data: [<?php echo $montoacumulado6.str_replace(',','',number_format($meta_anualxsemana->meta_tercero/2)) ?>]
  }]
  });
  <?php endif; ?>
<?php endforeach; ?>
</script>
