
  <table class="table table-bordered table-condensed table-hover display dataTable_width_auto" id="relacion_reporte">
    <thead>
      <tr>
        <th>Pedido</th>
        <th>Fec.Pedido</th>
        <th>Cotización</th>
        <th>OC</th>
        <th>Cliente</th>
        <th>Código</th>
        <th>Familia</th>
        <th>Descripción</th>
        <th>Stock</th>
        <th>Cant.Atendida</th>
        <th>Fec.Facturación</th>
        <th>Disponib.</th>
        <th>Situación</th>
        <th>Valor Venta Unit</th>
        <th>Total</th>
        <th>Fec.Entrega Estimada</th>
        <th>Dias Entrega Estimada 1</th>
        <th>Fecha Reprogramada 1</th>
        <th>Dias Entrega Estimada 2</th>
        <th>Fecha Reprogramada 2</th>
        <th>Dias Entrega Estimada 3</th>
        <th>Fecha Reprogramada 3</th>
        <th>Area Responsable 1</th>
        <th>Fecha Inicial 1</th>
        <th>Fecha Estimada 1</th>
        <th>Fecha Termino 1</th>
        <th>Indicador 1</th>
        <th>Tiempo Transcurrido 1</th>
        <th>Estado 1</th>
        <th>Area Responsable 2</th>
        <th>Fecha Inicial 2</th>
        <th>Fecha Estimada 2</th>
        <th>Fecha Termino 2</th>
        <th>Indicador 2</th>
        <th>Tiempo Transcurrido 2</th>
        <th>Estado 2</th>
        <th>Area Responsable 3</th>
        <th>Fecha Inicial 3</th>
        <th>Fecha Estimada 3</th>
        <th>Fecha Termino 3</th>
        <th>Indicador 3</th>
        <th>Tiempo Transcurrido 3</th>
        <th>Estado 3</th>
        <th>Area Responsable 4</th>
        <th>Fecha Inicial 4</th>
        <th>Fecha Estimada 4</th>
        <th>Fecha Termino 4</th>
        <th>Indicador 4</th>
        <th>Tiempo Transcurrido 4</th>
        <th>Estado 4</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pedido as $key): ?>
        <tr>
          <td><?php echo $key['CFNUMPED'] ?></td>
          <td style="width:80px"><?php echo date('d-m-Y',strtotime($key['CFFECDOC'])) ?></td>
          <td><?php echo $key['cfrfnumdoc'] ?></td>
          <td><?php echo $key['CFORDCOM'] ?></td>
          <td><?php echo $key['CFNOMBRE'] ?></td>
          <td><?php echo $key['DFCODIGO'] ?></td>
          <td><?php echo $key['familia'] ?></td>
          <td><?php echo $key['dfdescri'] ?></td>
          <?php if ($key['DFCANTIDDIS']==''): ?>
            <td>0</td>
          <?php else: ?>
            <td><?php echo number_format($key['DFCANTIDDIS']) ?></td>
          <?php endif; ?>

          <td><?php echo number_format($key['POR_ATENDER']) ?></td>

          <td><?php echo date('d-m-Y',strtotime($key['FEC_FACT'])) ?></td>
          <?php if ($key['DFSALDO']>=$key['stock_ahora']): ?>
            <td>En Proceso</td>
          <?php else: ?>
            <td>En Stock</td>
          <?php endif; ?>
          <td><?php echo $key['situacion'] ?></td>
          <td><?php echo number_format($key['val_unit'],2) ?></td>
          <td><?php echo number_format($key['total'],2) ?></td>
          <?php if ($key['DFFECENT']==''): ?>
            <td></td>
          <?php else: ?>
          <td><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
          <?php endif; ?>
          <td><?php echo $key['dias_reprogramados1'] ?></td>
          <?php if ($key['fecha_reprogramada1']==''): ?>
            <td></td>
          <?php else: ?>
          <td><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada1'])) ?></td>
          <?php endif; ?>
          <td><?php echo $key['dias_reprogramados2'] ?></td>
          <?php if ($key['fecha_reprogramada2']==''): ?>
          <td></td>
          <?php else: ?>
          <td><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada2'])) ?></td>
          <?php endif; ?>
          <td><?php echo $key['dias_reprogramados3'] ?></td>
          <?php if ($key['fecha_reprogramada3']==''): ?>
            <td></td>
          <?php else: ?>
          <td><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada3'])) ?></td>
          <?php endif; ?>
          <td><?php echo $key['area1'] ?></td>
          <?php if ($key['fecha_inicio1']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_inicio1'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_final1']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_final1'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_termino1']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_termino1'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>

          <?php if ($key['area1']!=''): ?>
            <?php if ($key['indicador1']<0): ?>
            <td style="background-color:red"><?php echo $key['indicador1'] ?></td>
          <?php elseif ($key['indicador1']==1 or $key['indicador1']==2 ): ?>
            <td style="background-color:orange"><?php echo $key['indicador1'] ?></td>
          <?php elseif ($key['indicador1']>=3 and $key['indicador1']<=5 ): ?>
            <td style="background-color:yellow"><?php echo $key['indicador1'] ?></td>
          <?php elseif ($key['indicador1']>=6): ?>
            <td style="background-color:green"><?php echo $key['indicador1'] ?></td>
          <?php else: ?>
            <td></td>
            <?php endif; ?>

            <?php if ($key['tiempo1']<0): ?>
            <td style="background-color:red"><?php echo $key['tiempo1'] ?></td>
          <?php elseif ($key['tiempo1']==1 or $key['tiempo1']==2 ): ?>
            <td style="background-color:orange"><?php echo $key['tiempo1'] ?></td>
          <?php elseif ($key['tiempo1']>=3 and $key['tiempo1']<=5 ): ?>
            <td style="background-color:yellow"><?php echo $key['tiempo1'] ?></td>
          <?php elseif ($key['tiempo1']>=6): ?>
            <td style="background-color:green"><?php echo $key['tiempo1'] ?></td>
          <?php else: ?>
            <td></td>
            <?php endif; ?>

            <?php if ($key['fecha_final1']>$key['fecha_termino1']): ?>
              <td style="background-color:blue">A TIEMPO</td>
            <?php elseif($key['fecha_termino1']==''): ?>
              <td></td>
            <?php elseif($key['fecha_final1']<$key['fecha_termino1']): ?>
                <td style="background-color:red">RETRASADO</td>
              <?php else: ?>
                <td></td>
            <?php endif; ?>
          <?php else: ?>
            <td></td>
            <td></td>
            <td></td>
          <?php endif; ?>


          <td><?php echo $key['area2'] ?></td>
          <?php if ($key['fecha_inicio2']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_inicio2'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_final2']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_final2'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_termino2']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_termino2'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>

          <?php if ($key['area2']!=''): ?>
            <?php if ($key['indicador2']<0): ?>
            <td style="background-color:red"><?php echo $key['indicador2'] ?></td>
          <?php elseif ($key['indicador2']==1 or $key['indicador2']==2 ): ?>
            <td style="background-color:orange"><?php echo $key['indicador2'] ?></td>
          <?php elseif ($key['indicador2']>=3 and $key['indicador2']<=5 ): ?>
            <td style="background-color:yellow"><?php echo $key['indicador2'] ?></td>
          <?php elseif ($key['indicador2']>=6): ?>
            <td style="background-color:green"><?php echo $key['indicador2'] ?></td>
          <?php else: ?>
            <td></td>
            <?php endif; ?>

            <?php if ($key['tiempo2']<0): ?>
            <td style="background-color:red"><?php echo $key['tiempo2'] ?></td>
          <?php elseif ($key['tiempo2']==1 or $key['tiempo2']==2 ): ?>
            <td style="background-color:orange"><?php echo $key['tiempo2'] ?></td>
          <?php elseif ($key['tiempo2']>=3 and $key['tiempo2']<=5 ): ?>
            <td style="background-color:yellow"><?php echo $key['tiempo2'] ?></td>
          <?php elseif ($key['tiempo2']>=6): ?>
            <td style="background-color:green"><?php echo $key['tiempo2'] ?></td>
            <?php else: ?>
              <td></td>
            <?php endif; ?>

            <?php if ($key['fecha_final2']>$key['fecha_termino2']): ?>
              <td style="background-color:blue">A TIEMPO</td>
            <?php elseif($key['fecha_termino2']==''): ?>
              <td></td>
              <?php else: ?>
                <td style="background-color:red">RETRASADO</td>
            <?php endif; ?>
          <?php else: ?>
            <td></td>
            <td></td>
            <td></td>
          <?php endif; ?>

          <td><?php echo $key['area3'] ?></td>
          <?php if ($key['fecha_inicio3']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_inicio3'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_final3']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_final3'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_termino3']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_termino3'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>

          <?php if ($key['area3']!=''): ?>
            <?php if ($key['indicador3']<0): ?>
            <td style="background-color:red"><?php echo $key['indicador3'] ?></td>
          <?php elseif ($key['indicador3']==1 or $key['indicador3']==2 ): ?>
            <td style="background-color:orange"><?php echo $key['indicador3'] ?></td>
          <?php elseif ($key['indicador3']>=3 and $key['indicador3']<=5 ): ?>
            <td style="background-color:yellow"><?php echo $key['indicador3'] ?></td>
          <?php elseif ($key['indicador3']>=6): ?>
            <td style="background-color:green"><?php echo $key['indicador3'] ?></td>
          <?php else: ?>
            <td></td>
            <?php endif; ?>

            <?php if ($key['tiempo3']<0): ?>
            <td style="background-color:red"><?php echo $key['tiempo3'] ?></td>
          <?php elseif ($key['tiempo3']==1 or $key['tiempo3']==2 ): ?>
            <td style="background-color:orange"><?php echo $key['tiempo3'] ?></td>
          <?php elseif ($key['tiempo3']>=3 and $key['tiempo3']<=5 ): ?>
            <td style="background-color:yellow"><?php echo $key['tiempo3'] ?></td>
          <?php elseif ($key['tiempo3']>=6): ?>
            <td style="background-color:green"><?php echo $key['tiempo3'] ?></td>

            <?php if ($key['fecha_final3']>$key['fecha_termino3']): ?>
              <td style="background-color:blue">A TIEMPO</td>
            <?php elseif($key['fecha_termino3']==''): ?>
              <td></td>
              <?php else: ?>
                <td style="background-color:red">RETRASADO</td>
            <?php endif; ?>
          <?php else: ?>
            <td></td>
            <?php endif; ?>
          <?php else: ?>
            <td></td>
            <td></td>
            <td></td>
          <?php endif; ?>



          <td><?php echo $key['area4'] ?></td>
          <?php if ($key['fecha_inicio4']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_inicio4'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_final4']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_final4'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
          <?php if ($key['fecha_termino4']!='31-12-1969'): ?>
          <td><?php echo $key['fecha_termino4'] ?></td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>

            <?php if ($key['area4']!=''): ?>
              <?php if ($key['indicador4']<0): ?>
              <td style="background-color:red"><?php echo $key['indicador4'] ?></td>
            <?php elseif ($key['indicador4']==1 or $key['indicador4']==2 ): ?>
              <td style="background-color:orange"><?php echo $key['indicador4'] ?></td>
            <?php elseif ($key['indicador4']>=3 and $key['indicador4']<=5 ): ?>
              <td style="background-color:yellow"><?php echo $key['indicador4'] ?></td>
            <?php elseif ($key['indicador4']>=6): ?>
              <td style="background-color:green"><?php echo $key['indicador4'] ?></td>
            <?php else: ?>
              <td></td>
              <?php endif; ?>

              <?php if ($key['tiempo4']<0): ?>
              <td style="background-color:red"><?php echo $key['tiempo4'] ?></td>
            <?php elseif ($key['tiempo4']==1 or $key['tiempo4']==2 ): ?>
              <td style="background-color:orange"><?php echo $key['tiempo4'] ?></td>
            <?php elseif ($key['tiempo4']>=3 or $key['tiempo4']<=5 ): ?>
              <td style="background-color:yellow"><?php echo $key['tiempo4'] ?></td>
            <?php elseif ($key['tiempo4']>=6): ?>
              <td style="background-color:green"><?php echo $key['tiempo4'] ?></td>
            <?php else: ?>
              <td></td>
              <?php endif; ?>

              <?php if ($key['fecha_final4']>$key['fecha_termino4']): ?>
                <td style="background-color:blue">A TIEMPO</td>
              <?php elseif($key['fecha_termino4']==''): ?>
                <td></td>
                <?php else: ?>
                  <td style="background-color:red">RETRASADO</td>
              <?php endif; ?>

            <?php else: ?>
              <td></td>
              <td></td>
              <td></td>
            <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
