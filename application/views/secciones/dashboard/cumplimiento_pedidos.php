<div class="row">
  <div class="col-md-12">
    <center><h3>CUMPLIMIENTO DE PEDIDOS - TOTAL</h3></center>
  </div>
  <br><br>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempo=0; $retraso=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                  $tiempo++;
                } else {
                  $retraso++;
                }
                 ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempo ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="tiempo" ><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retraso ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retraso"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-12">
    <center><h3>CUMPLIMIENTO DE PEDIDOS - RELACIONADAS</h3></center>
  </div>
  <br><br>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempord=0; $retrasord=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if ($key->CFCODCLI=='20469962246') {
                  if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                   $tiempord++;
                 } else {
                   $retrasord++;
                 }
                }
                 ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempord ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button"  data-id="tiempord"><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retrasord ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retrasord"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containerrd" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempoov=0; $retrasoov=0; $overprime=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if ($key->CFCODCLI=='20535689394') {
                  if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                   $tiempoov++;
                 } else {
                   $retrasoov++;
                 }
                }
                 ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempoov ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="tiempoov"><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retrasoov ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retrasoov"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containerov" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempocd=0; $retrasocd=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if ($key->CFCODCLI=='OD151012DG7') {
                  if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                   $tiempocd++;
                 } else {
                   $retrasocd++;
                 }
                }
                 ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempocd ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="tiempocd"><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retrasocd ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retrasocd"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containercd" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-12">
    <center><h3>CUMPLIMIENTO DE PEDIDOS - MERCADO</h3></center>
  </div>
  <br><br>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempogg=0; $retrasogg=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if ($key->CFVENDE =='08'  and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                  <?php if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                    $tiempogg++;
                  } else {
                    $retrasogg++;
                  }
                   ?>
                <?php endif; ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempogg ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="tiempogg"><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retrasogg ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retrasogg"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containergg" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div><br><br>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempofn=0; $retrasofn=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if ($key->CFVENDE=='10' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                  <?php if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                    $tiempofn++;
                  } else {
                    $retrasofn++;
                  }
                   ?>
                <?php endif; ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempofn ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="tiempofn"><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retrasofn ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retrasofn"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containerfn" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div><br><br>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>RESULTADO</th>
            <th>NRO.PEDIDOS</th>
            <th>VER</th>
          </tr>
        </thead>
        <tbody>
          <?php $tiempocdv=0; $retrasocdv=0;
                foreach ($cumplimiento_pedidos as $key): ?>

                <?php if ($key->CFVENDE=='07' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                  <?php if (  date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact))  ) {
                    $tiempocdv++;
                  } else {
                    $retrasocdv++;
                  }
                   ?>
                <?php endif; ?>

          <?php endforeach; ?>
          <tr>
            <td>A TIEMPO</td>
            <td><?php echo $tiempocdv ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="tiempocdv"><i class="fa fa-eye"></i></a> </td>
          </tr>
          <tr>
            <td>CON RETRASO</td>
            <td><?php echo $retrasocdv ?></td>
            <td><a type="button" class="btn btn-primary modalbutton" name="button" data-id="retrasocdv"><i class="fa fa-eye"></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div id="containercdv" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div>
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">DETALLE DE PEDIDOS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<div class="modal-body">
            <div  id="form_pedido">

            </div>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
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
  text: 'CUMPLIMIENTO DE PEDIDOS - TOTAL'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempo+$retraso==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempo*100/($tiempo+$retraso) ?>,
    <?php endif; ?>
    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempo+$retraso==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $retraso*100/($tiempo+$retraso) ?>,
    <?php endif; ?>
  }]
}]
});

Highcharts.chart('containerrd', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'CUMPLIMIENTO DE PEDIDOS - ROCK DRILL'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempord+$retrasord==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempord*100/($tiempord+$retrasord) ?>,
    <?php endif; ?>

    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempord+$retrasord==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $retrasord*100/($tiempord+$retrasord) ?>,
    <?php endif; ?>

  }]
}]
});

Highcharts.chart('containerov', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'CUMPLIMIENTO DE PEDIDOS - OVERPRIME'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempoov+$retrasoov==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempoov*100/($tiempoov+$retrasoov) ?>,
    <?php endif; ?>
    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempoov+$retrasoov==0): ?>
      y:0,
    <?php else: ?>
      y: <?php echo $retrasoov*100/($tiempoov+$retrasoov) ?>,
    <?php endif; ?>

  }]
}]
});

Highcharts.chart('containercd', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'CUMPLIMIENTO DE PEDIDOS - CODRISE MÉXICO'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempocd+$retrasocd==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempocd*100/($tiempocd+$retrasocd) ?>,
    <?php endif; ?>

    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempocd+$retrasocd==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $retrasocd*100/($tiempocd+$retrasocd) ?>,

    <?php endif; ?>
  }]
}]
});

Highcharts.chart('containergg', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'CUMPLIMIENTO DE PEDIDOS - GUSTAVO GAVILÁN'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempogg+$retrasogg==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempogg*100/($tiempogg+$retrasogg) ?>,
    <?php endif; ?>

    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempogg+$retrasogg==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $retrasogg*100/($tiempogg+$retrasogg) ?>,

    <?php endif; ?>
  }]
}]
});

Highcharts.chart('containerfn', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'CUMPLIMIENTO DE PEDIDOS - FERNANDO NUÑEZ'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempofn+$retrasofn==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempofn*100/($tiempofn+$retrasofn) ?>,
    <?php endif; ?>

    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempofn+$retrasofn==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $retrasofn*100/($tiempofn+$retrasofn) ?>,

    <?php endif; ?>
  }]
}]
});

Highcharts.chart('containercdv', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'CUMPLIMIENTO DE PEDIDOS - CODRISE VENTAS'
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
  name: 'DISTRIBUCIÓN',
  colorByPoint: true,
  data: [{
    name: 'A TIEMPO',
    <?php if ($tiempocdv+$retrasocdv==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $tiempocdv*100/($tiempocdv+$retrasocdv) ?>,
    <?php endif; ?>

    sliced: true,
    selected: true
  }, {
    name: 'CON RETRASO',
    <?php if ($tiempocdv+$retrasocdv==0): ?>
      y:0,
    <?php else: ?>
    y: <?php echo $retrasocdv*100/($tiempocdv+$retrasocdv) ?>,

    <?php endif; ?>
  }]
}]
});
</script>
