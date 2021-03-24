<style media="screen">
  table{
    font-family: 'Century Gothic','Futura','san-serif';
  }
  th{
    vertical-align: middle;
  }
</style>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
       <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Comportamiento Trimestral Ventas</th>
              <th>Meta</th>
              <th>Facturado Real</th>
              <th>Alcance Real</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Primer Trimestre</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_relacionado1']+$metasvsfacturado['meta_tercero1']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado1']+$metasvsfacturado['facturado_tercero1']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado1']+$metasvsfacturado['facturado_tercero1'])*100/($metasvsfacturado['meta_relacionado1']+$metasvsfacturado['meta_tercero1'])) ?>%</td>
            </tr>
            <tr>
              <th>Segundo Trimestre</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_relacionado2']+$metasvsfacturado['meta_tercero2']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado2']+$metasvsfacturado['facturado_tercero2']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado2']+$metasvsfacturado['facturado_tercero2'])*100/($metasvsfacturado['meta_relacionado2']+$metasvsfacturado['meta_tercero2'])) ?>%</td>
            </tr>
            <tr>
              <th>Tercer Trimestre</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_relacionado3']+$metasvsfacturado['meta_tercero3']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado3']+$metasvsfacturado['facturado_tercero3']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado3']+$metasvsfacturado['facturado_tercero3'])*100/($metasvsfacturado['meta_relacionado3']+$metasvsfacturado['meta_tercero3']))?>%</td>
            </tr>
            <tr>
              <th>Cuarto Trimestre</th>
              <td>$ <?php echo number_format($metasvsfacturado['meta_relacionado4']+$metasvsfacturado['meta_tercero4']) ?></td>
              <td>$ <?php echo number_format($metasvsfacturado['facturado_relacionado4']+$metasvsfacturado['facturado_tercero4']) ?></td>
              <td> <?php echo number_format(($metasvsfacturado['facturado_relacionado4']+$metasvsfacturado['facturado_tercero4'])*100/($metasvsfacturado['meta_relacionado4']+$metasvsfacturado['meta_tercero4']))?>%</td>
            </tr>
          </tbody>
         </table>
       </div>
  </div>
  <div class="col-md-6">
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-8">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <th></th>
          <th>Meta Anual</th>
          <th>Meta Real Acumulada</th>
          <th>Venta Meses Transcurridos</th>
          <th>Venta Real de Meses Transcurridos</th>
          <th>Alcances de Meses Transcurridos</th>
          <th>Alcance Real Meta Anual</th>
        </thead>
        <tbody>
          <tr>
            <th>Venta Total</th>
            <td>$ <?php echo number_format($consolidadoanual['meta_relacionado']+$consolidadoanual['meta_tercero']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['acumulada_relacionada']+$consolidadoanual['acumulada_tercero']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['meta_relacionadotrans']+$consolidadoanual['meta_tercerotrans']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['transcurrido_relacionada']+$consolidadoanual['transcurrido_tercero']) ?></td>
            <td><?php echo number_format(($consolidadoanual['transcurrido_relacionada']+$consolidadoanual['transcurrido_tercero'])*100/($consolidadoanual['meta_relacionadotrans']+$consolidadoanual['meta_tercerotrans'])) ?>%</td>
            <td><?php echo number_format(($consolidadoanual['acumulada_relacionada']+$consolidadoanual['acumulada_tercero'])*100/($consolidadoanual['meta_relacionado']+$consolidadoanual['meta_tercero'])) ?>%</td>
          </tr>
          <tr>
            <th>Venta Relacionadas</th>
            <td>$ <?php echo number_format($consolidadoanual['meta_relacionado']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['acumulada_relacionada']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['meta_relacionadotrans']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['transcurrido_relacionada']) ?></td>
            <td><?php echo number_format($consolidadoanual['transcurrido_relacionada']*100/$consolidadoanual['meta_relacionadotrans']) ?>%</td>
            <td><?php echo number_format($consolidadoanual['acumulada_relacionada']*100/$consolidadoanual['meta_relacionado']) ?>%</td>
          </tr>
          <tr>
            <th>Venta Mercados</th>
            <td>$ <?php echo number_format($consolidadoanual['meta_tercero']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['acumulada_tercero']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['meta_tercerotrans']) ?></td>
            <td>$ <?php echo number_format($consolidadoanual['transcurrido_tercero']) ?></td>
            <td><?php echo number_format($consolidadoanual['transcurrido_tercero']*100/$consolidadoanual['meta_tercerotrans']) ?>%</td>
            <td><?php echo number_format($consolidadoanual['acumulada_tercero']*100/$consolidadoanual['meta_tercero']) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<br><br>
<div class="row">
  <div cl.ass="col-md-12">
    <center><h2>VENTA Y PROYECCION ANUAL</h2></center>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>AÑO</th>
            <th>VENTA Y PROYECCION ANUAL</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $años1='';
          $monto1='';
          foreach ($consolidadoporaños as $key): ?>
            <tr>
              <td><?php echo $key->index1 ?></td>
              <td>$ <?php echo number_format($key->monto_venta) ?></td>
            </tr>
          <?php
          $años1=$años1.str_replace(',','',number_format($key->index1)).',';
          $monto1=$monto1.str_replace(',','',number_format($key->monto_venta)).',';
         endforeach; ?>
          <tr>
            <td>META ANUAL</td>
            <td>$ <?php echo number_format($metaanual) ?></td>
          </tr>
          <tr>
            <td>VENTA PROYECTADA</td>
            <td>$ <?php echo number_format($ventaproyectadaanual) ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php $años1=$años1.'"VENTA ANUAL", "VENTA PROYECTADA"';
          $monto1=$monto1.str_replace(',','',number_format($metaanual)).','.str_replace(',','',number_format($ventaproyectadaanual))?>
  </div>
  <div class="col-md-6">
        <div id="ventaxaños" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-12">
    <center><h2>VENTAS A CLIENTES RELACIONADOS / VARIACION MENSUAL - ANUAL</h2></center>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>MES/AÑO</th>
            <?php for ($i=2013; $i <=$año ; $i++) {?>
            <th><?php echo $i ?></th>
          <?php  } ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ventaanualrelacionado as $key): ?>
            <tr>
              <td><?php echo $key['nombre'] ?></td>
              <?php for ($j=2013; $j <=$año; $j++) {?>
              <td>$ <?php echo number_format($key['mes'.$j] )?></td>
            <?php  } ?>
            </tr>
          <?php  endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  </div>
  <br><br>
  <div class="row">
    <div class="col-md-12">
      <?php $meses1=''; foreach ($meses_delaño as $key): ?>
          <?php $meses1=$meses1.'"'.$key->mes.'",'; ?>
      <?php endforeach;
      $data1='';
      for ($i=2013; $i <=$año ; $i++){
      $data1=$data1."{name: '".$i."', data: [";
        foreach ($meses_delaño as $key) {
          foreach ($ventaanualrelacionado as $key2) {
            if ($key2['num']==$key->index2) {
              $data1=$data1.str_replace(',','',number_format($key2['mes'.$i])).',';
            }
          }

        }

                $data1=$data1."]},";
    }
       ?>

      <div id="ventaanualrelacionado" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-md-12">
      <center><h2>VENTAS A CLIENTES MERCADO / VARIACION MENSUAL - ANUAL</h2></center>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>MES/AÑO</th>
              <?php for ($i=2013; $i <=$año ; $i++) {?>
              <th><?php echo $i ?></th>
            <?php  } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ventaanualtercero as $key): ?>
              <tr>
                <td><?php echo $key['nombre'] ?></td>
                <?php for ($j=2013; $j <=$año; $j++) {?>
                <td>$ <?php echo number_format($key['mes'.$j] )?></td>
              <?php  } ?>
              </tr>
            <?php  endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

</div>
<br><br>
<div class="row">
  <div class="col-md-12">
    <?php $meses2=''; foreach ($meses_delaño as $key): ?>
        <?php $meses2=$meses2.'"'.$key->mes.'",'; ?>
    <?php endforeach; ?>
    <?php
    $data2='';
    for ($i=2013; $i <=$año ; $i++){
    $data2=$data2."{name: '".$i."', data: [";
      foreach ($meses_delaño as $key) {
        foreach ($ventaanualtercero as $key2) {
          if ($key2['num']==$key->index2) {
            $data2=$data2.str_replace(',','',number_format($key2['mes'.$i])).',';
          }
        }

      }

$data2=$data2."]}, ";
  }
     ?>

  <div id="ventaanualtercero" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-12">
    <center><h2>COMPARATIVO DE CLIENTES RELACIONADOS Y MERCADO / VARIACION ANUAL</h2></center>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <th>Año</th>
          <th>Relacionada</th>
          <th>Contribución</th>
          <th>Tercero</th>
          <th>Contribución</th>
        </thead>
        <tbody>
          <?php foreach ($comparativo_anual as $key): ?>
            <tr>
              <th><?php echo $key['año']?></th>
              <td>$<?php echo number_format($key['relacionado']) ?></td>
              <td><?php echo number_format($key['relacionado']*100/($key['relacionado']+$key['tercero'])) ?>%</td>
              <td>$<?php echo number_format($key['tercero']) ?></td>
              <td><?php echo number_format($key['tercero']*100/($key['relacionado']+$key['tercero'])) ?>%</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<br><br>
<div class="row">
  <div class="col-md-6">
    <div id="comparativo_anualporcentaje" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
  <div class="col-md-6">
    <?php
    $añocomparativo='';
    $relacionado='';
    $tercero='';
    $porrelacionado='';
    $portercero='';
    foreach ($comparativo_anual as $key) {
      $añocomparativo=$añocomparativo.$key['año'].',';
      $relacionado=$relacionado.str_replace(',','',number_format($key['relacionado'])).',';
      $tercero=$tercero.str_replace(',','',number_format($key['tercero'])).',';
      $porrelacionado=$porrelacionado.str_replace(',','',number_format($key['relacionado']*100/($key['relacionado']+$key['tercero']))).',';
      $portercero=$portercero.str_replace(',','',number_format($key['tercero']*100/($key['relacionado']+$key['tercero']))).',';
    }
     ?>

      <div id="comparativo_anual" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>

</div>
<script type="text/javascript">

       var options = {
     chart: {
       height: 350,
       type: 'line',
       stacked: false
     },
     dataLabels: {
       enabled: false
     },
     series: [{
       name: 'Meta (USD)',
       type: 'column',
       data: [<?php echo str_replace(',','',number_format(($metasvsfacturado['meta_relacionado1']+$metasvsfacturado['meta_tercero1']))).",".str_replace(',','',number_format(($metasvsfacturado['meta_relacionado2']+$metasvsfacturado['meta_tercero2']))).",".str_replace(',','',number_format(($metasvsfacturado['meta_relacionado3']+$metasvsfacturado['meta_tercero3']))).",".str_replace(',','',number_format(($metasvsfacturado['meta_relacionado4']+$metasvsfacturado['meta_tercero4']))) ?>]
     }, {
       name: 'Real (USD)',
       type: 'column',
       data: [<?php echo str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado1']+$metasvsfacturado['facturado_tercero1']))).",".str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado2']+$metasvsfacturado['facturado_tercero2']))).",".str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado3']+$metasvsfacturado['facturado_tercero3']))).",".str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado4']+$metasvsfacturado['facturado_tercero4']))) ?>]
     }, {
       name: 'Alcance Real (%)',
       type: 'line',
       data: [<?php echo str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado1']+$metasvsfacturado['facturado_tercero1'])*100/($metasvsfacturado['meta_relacionado1']+$metasvsfacturado['meta_tercero1']))).",".str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado2']+$metasvsfacturado['facturado_tercero2'])*100/($metasvsfacturado['meta_relacionado2']+$metasvsfacturado['meta_tercero2']))).",".str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado3']+$metasvsfacturado['facturado_tercero3'])*100/($metasvsfacturado['meta_relacionado3']+$metasvsfacturado['meta_tercero3']))).",".str_replace(',','',number_format(($metasvsfacturado['facturado_relacionado4']+$metasvsfacturado['facturado_tercero4'])*100/($metasvsfacturado['meta_relacionado4']+$metasvsfacturado['meta_tercero4']))) ?>]
     }],
     stroke: {
       width: [1, 1, 4]
     },
     title: {
       text: 'Comportamiento Trimestral de Ventas',
       align: 'left',
       offsetX: 110
     },
     xaxis: {
       categories: ['1° Trimestre', '2° Trimestre', '3° Trimestre', '4° Trimestre'],
     },
     yaxis: [
       {
         axisTicks: {
           show: true,
         },
         axisBorder: {
           show: true,
           color: '#008FFB'
         },
         labels: {
           style: {
             color: '#008FFB',
           }
         },
         title: {
           text: "Meta (USD)",
           style: {
             color: '#008FFB',
           }
         },
         tooltip: {
           enabled: true
         }
       },

       {
         seriesName: 'Income',
         opposite: true,
         axisTicks: {
           show: true,
         },
         axisBorder: {
           show: true,
           color: '#00E396'
         },
         labels: {
           style: {
             color: '#00E396',
           }
         },
         title: {
           text: "Facturacion Real (USD)",
           style: {
             color: '#00E396',
           }
         },
       },
       {
         seriesName: 'Revenue',
         opposite: true,
         axisTicks: {
           show: true,
         },
         axisBorder: {
           show: true,
           color: '#FEB019'
         },
         labels: {
           style: {
             color: '#FEB019',
           },
         },
         title: {
           text: "Alcance Real (%)",
           style: {
             color: '#FEB019',
           }
         }
       },
     ],
     tooltip: {
       fixed: {
         enabled: true,
         position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
         offsetY: 30,
         offsetX: 60
       },
     },
     legend: {
       horizontalAlign: 'left',
       offsetX: 40
     }
   }

   var chart = new ApexCharts(
     document.querySelector("#container"),
     options
   );


   chart.render();

///////////////////////////
    /*   var options = {
            chart: {
              height: 350,
              type: 'line',
              stacked: false
            },
            dataLabels: {
              enabled: false
            },
            series: [{
              name: 'RELACIONADOS',
              type: 'column',
              data: [<?php //echo $relacionado ?>]
            }, {
              name: 'MERCADO',
              type: 'column',
              data: [<?php // echo $tercero ?>]
            }],
            stroke: {
              width: [1, 1, 4]
            },
            title: {
              text: 'COMPARATIVO DE CLIENTES RELACIONADOS / MERCADO',
              align: 'left',
              offsetX: 110
            },
            xaxis: {
              categories: [<?php // echo $añocomparativo ?>],
            },
            yaxis: [
              {
                axisTicks: {
                  show: true,
                },
                axisBorder: {
                  show: true,
                  color: '#008FFB'
                },
                labels: {
                  style: {
                    color: '#008FFB',
                  }
                },
                title: {
                  text: "Meta (USD)",
                  style: {
                    color: '#008FFB',
                  }
                },
                tooltip: {
                  enabled: true
                }
              },

              {
                seriesName: 'Real (USD)',
                opposite: true,
                axisTicks: {
                  show: true,
                },
                axisBorder: {
                  show: true,
                  color: '#00E396'
                },
                labels: {
                  style: {
                    color: '#00E396',
                  }
                },
                title: {
                  text: "Real (USD)",
                  style: {
                    color: '#00E396',
                  }
                },
              },
              {
                seriesName: 'Revenue',
                opposite: true,
                axisTicks: {
                  show: true,
                },
                axisBorder: {
                  show: true,
                  color: '#FEB019'
                },
                labels: {
                  style: {
                    color: '#FEB019',
                  },
                },
                title: {
                  text: "(%)",
                  style: {
                    color: '#FEB019',
                  }
                }
              },
            ],
            tooltip: {
              fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
              },
            },
            legend: {
              horizontalAlign: 'center',
              offsetX: 40
            }
          }

          var chart = new ApexCharts(
            document.querySelector("#comparativo_anual"),
            options
          );


          chart.render();*/
/////////////////////////////
Highcharts.chart('comparativo_anualporcentaje', {
  chart: {
    type: 'line'
  },

  subtitle: {
    text: 'Source: WorldClimate.com'
  },
  xAxis: {
    categories: [<?php echo $añocomparativo ?>]
  },
  yAxis: {
    title: {
      text: 'Contribución (%)'
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
    name: 'Contribución Relacionado',
    data: [<?php echo $porrelacionado ?>]
  }, {
    name: 'Contribución Mercado',
    data: [<?php echo $portercero ?>]
  }]


});


Highcharts.chart('ventaxaños', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'VENTA Y PROYECCION ANUAL'
  },
  xAxis: {
    categories: [<?php echo $años1 ?>]
  },
  credits: {
    enabled: false
  },
  series: [ {
    name: 'USD',
    data: [<?php echo $monto1 ?>]
  }]
});
Highcharts.chart('ventaanualrelacionado', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'VENTAS A CLIENTES RELACIONADOS / VARIACION MENSUAL - ANUAL'
  },
  xAxis: {
    categories: [<?php echo $meses1 ?>]
  },
  yAxis: {
        min: 0,
        title: {
            text: 'Ventas (USD)'
        }
    },
  credits: {
    enabled: false
  },
  series: [<?php echo $data1 ?>]
});
Highcharts.chart('ventaanualtercero', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'VENTAS A CLIENTES MERCADO / VARIACION MENSUAL - ANUAL'
  },
  xAxis: {
    categories: [<?php echo $meses2 ?>]
  },
  yAxis: {
        min: 0,
        title: {
            text: 'Ventas (USD)'
        }
    },
  credits: {
    enabled: false
  },
  series: [<?php echo $data2 ?>]
});
</script>
