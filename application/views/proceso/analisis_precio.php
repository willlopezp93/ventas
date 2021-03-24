
<div class="table-responsive" id="tbl_analisis">
  <!--<button type="button" name="button" id="export_excel" class="btn btn-success pull-right"><i class="far fa-file-excel"></i> Excel</button>-->
  <br>
  <table class="table table-bordered table-condensed table-hover" id="tbl_analisisexcel">
    <thead>
      <tr>
        <th>#</th>
        <th>Código</th>
        <th>Descripcion</th>
        <th>Costo 1 (*)</th>
        <th>Fecha 1</th>
        <th>Costo 2</th>
        <th>Fecha 2</th>
        <th>Costo 3</th>
        <th>Fecha 3</th>
        <th>P.Lista</th>
        <th>Dcto.</th>
        <th>P.Neto</th>
        <th>% Margen</th>
        <th>Costo Ref.</th>
        <th>% Margen Ref.</th>
        <th>% Dscto.Max</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($analisis as $key): ?>
        <tr>
          <td><?php echo $key['CDSECUEN'] ?></td>
          <td class="excel_CDCODIGO"><?php echo $key['CDCODIGO'] ?></td>
          <td class="excel_descripcion"><?php echo str_replace('"',' in',$key['descripcion']) ?></td>
          <td class="excel_precio1" width="80px"><?php echo number_format($key['precio1'],2) ?></td>
          <?php if ($key['fecha1']==''): ?>
          <td class="excel_fecha1" width="80px" style='font-style:italic;color:#757575;'><?php echo 'Sin dato' ?></td>
          <?php else: ?>
          <td class="excel_fecha1" width="80px"><?php echo date('m-d-Y',strtotime($key['fecha1'])) ?></td>
          <?php endif; ?>
          <td class="excel_precio2" width="80px"><?php echo number_format($key['precio2'],2) ?></td>
          <?php if ($key['fecha2']==''): ?>
          <td class="excel_fecha2" width="80px" style='font-style:italic;color:#757575;'><?php echo 'Sin dato' ?></td>
          <?php else: ?>
          <td class="excel_fecha2" width="80px"><?php echo date('m-d-Y',strtotime($key['fecha2'])) ?></td>
          <?php endif; ?>
          <td class="excel_precio3" width="80px"><?php echo number_format($key['precio3'],2) ?></td>
          <?php if ($key['fecha3']==''): ?>
          <td class="excel_fecha3" width="80px" style='font-style:italic;color:#757575;'><?php echo 'Sin dato' ?></td>
          <?php else: ?>
          <td class="excel_fecha3" width="80px"><?php echo date('m-d-Y',strtotime($key['fecha3'])) ?></td>
          <?php endif; ?>

          <td class="excel_CDPREC_ORI"><?php echo number_format($key['CDPREC_ORI'],2) ?></td>
          <td class="excel_CDPORDES"><?php echo number_format($key['CDPORDES'],2) ?></td>
          <td class="excel_CDPRENET"><?php echo number_format($key['CDPREC_ORI']*(1-$key['CDPORDES']),2) ?></td>
          <!--inicio if1-->  <?php if ($key['precio1']=='' or $key['precio1']==0): ?>
          <!--inicio if2-->     <?php if ($key['precio2']=='' or $key['precio2']==0): ?>
          <!--inicio if3-->       <?php if ($key['precio3']=='' or $key['precio3']==0): ?>
                <td class="excel_CDMARGEN"><?php echo "%100" ?></td>
                  <?php else: ?>
                <td class="excel_CDMARGEN"
                <?php if (($key['condicion']==1 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=40) or ($key['condicion']==2 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=20)): ?>
                <?php echo 'style="background-color: #94D874;"' ?>
              <?php elseif (($key['condicion']==1 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=0 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<40) or ($key['condicion']==2 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=0 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<20)): ?>
                <?php echo 'style="background-color: #D8D074;"' ?>
              <?php elseif ((((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<0)): ?>
                <?php echo 'style="background-color: #D87D74;"' ?>
              <?php elseif ($key['condicion']!=1 or $key['condicion']!=2 ): ?>
              <?php echo 'style="background-color: #94D874;"' ?>
                <?php endif; ?>><?php echo number_format((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio3']))*100/($key['CDPREC_ORI']*(1-$key['CDPORDES'])),2)?>%</td>
              <?php endif; ?><!--fin if3-->
                <?php else: ?>
                <td class="excel_CDMARGEN"
                <?php if (($key['condicion']==1 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=40) or ($key['condicion']==2 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=20)): ?>
                <?php echo 'style="background-color: #94D874;"' ?>
              <?php elseif (($key['condicion']==1 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=0 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<40) or ($key['condicion']==2 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=0 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<20)): ?>
                <?php echo 'style="background-color: #D8D074;"' ?>
              <?php elseif ((((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<0)): ?>
                <?php echo 'style="background-color: #D87D74;"' ?>
              <?php elseif ($key['condicion']!=1 or $key['condicion']!=2 ): ?>
              <?php echo 'style="background-color: #94D874;"' ?>
                <?php endif; ?>><?php echo number_format((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio2']))*100/($key['CDPREC_ORI']*(1-$key['CDPORDES'])),2) ?>%</td>
              <?php endif; ?><!--fin if2-->
              <?php else: ?>
                <td class="excel_CDMARGEN"
                <?php if (($key['condicion']==1 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=40) or ($key['condicion']==2 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=20)): ?>
                <?php echo 'style="background-color: #94D874;"' ?>
              <?php elseif (($key['condicion']==1 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=0 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<40) or ($key['condicion']==2 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))>=0 and ((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<20)): ?>
                <?php echo 'style="background-color: #D8D074;"' ?>
              <?php elseif ((((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])))<0)): ?>
                <?php echo 'style="background-color: #D87D74;"' ?>
              <?php elseif ($key['condicion']!=1 or $key['condicion']!=2 ): ?>
              <?php echo 'style="background-color: #94D874;"' ?>
              <?php endif; ?>><?php echo number_format((($key['CDPREC_ORI']*(1-$key['CDPORDES']))-($key['precio1']))*100 /($key['CDPREC_ORI']*(1-$key['CDPORDES'])),2)?>%</td>
            <?php endif; ?>  <!--fin if1-->
                      <td class="excel_COSTO_REF" width="80px"><?php echo number_format($key['COSTO_REF'],2) ?></td>
              <?php if ($key['CDPREC_ORI']==0): ?>
                <td>100.00%</td>
              <?php else: ?>
                <td class="excel_MARGEN_REF"><?php echo number_format((($key['CDPREC_ORI']*(1-($key['desc_max']/100)))-($key['COSTO_REF']))*100 /($key['CDPREC_ORI']*(1-$key['desc_max']/100)),2) ?>%</td>
              <?php endif; ?>
              <td><b><?php echo $key['desc_max'] ?></b></td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<p style='font-style:italic;color:#757575;'>(*)Costo más actual</p>
</div>
