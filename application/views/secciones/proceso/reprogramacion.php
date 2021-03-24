
<div  id="tbl_pedido">
  <div class="callout callout-warning">
      <h4>Indicaciones!</h4>
      <p>Sólo se permitirá 3 reprogramaciones por item.</p>
  </div>
  <input type="hidden" id="fecha" value="<?php echo date('d-m-Y',strtotime($fecha))?>">
  <div class="box-body">


        <div class="table-responsive" >
          <table class="table table-bordered table-condensed table-hover" id="tbl_detalle">
          <thead>
              <tr>
                <th style="font-size:8pt;text-align:center">N°</th>
                <th style="font-size:8pt;text-align:center">Codigo</th>
                <th style="font-size:8pt;text-align:center">Descripcion</th>
                <th style="font-size:8pt;text-align:center">Cant.</th>
                <th style="font-size:8pt;text-align:center">UM</th>
                <th style="font-size:8pt;text-align:center">Plazo</th>
                <th style="font-size:8pt;text-align:center;display:none">Fec.Entrega</th>
                <th style="font-size:8pt;text-align:center">Reprogr.</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="info_detalle">
              <?php foreach ($detalle as $key): ?>

                <?php if ($key['condicion']=='1'): ?>
                  <tr>
                    <td class="DFSECUEN" style="font-size:8pt;text-align:center;width:35px"><?php echo $key['DFSECUEN'] ?></td>
                     <td class="DFCODIGO" style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                      <td class="DFDESCRI" style="font-size:7.5pt"><?php echo $key['DFDESCRI'] ?></td>
                      <td class="DFCANTID" style="font-size:7.5pt;text-align:center;width:30px"><?php echo number_format($key['DFCANTID']) ?></td>
                      <td class="DFUNIDAD" style="font-size:7.5pt;text-align:center;width:30px"><?php echo $key['DFUNIDAD'] ?></td>
                      <?php if ($key['DFREPROGRAM']==0): ?>
                        <td class="DFPLAZO" style="width:115px;">
                          <input type="number" class="form-control editable" style="font-size:8pt;padding: 3px 5px;"  name="editable" value="<?php echo $key['DFPLAZO'] ?>">
                          <select style="font-size:8pt;width:60px;;padding: 3px 5px;display:none" class="form-control dias">
                          <option value=1  <?php if ($key['DFTIPTIME']==1): ?>
                            <?php echo "selected" ?>
                          <?php endif; ?>>DH</option>
                          <option value=7  <?php if ($key['DFTIPTIME']==7): ?>
                            <?php echo "selected" ?>
                          <?php endif; ?>>Sem</option>
                        </td>
                        <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                        <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                        <td class="DFREPROGRAM" style='background-color:#B0B0B0;font-size:10pt;width:50px; text-align:center; font-weight:bold'><?php echo $key['DFREPROGRAM'] ?></td>

                      <?php elseif ($key['DFREPROGRAM']==1): ?>
                        <td class="DFPLAZO" style="width:115px;">
                          <input type="number" class="form-control editable" style="font-size:8pt;padding: 3px 5px;"  name="editable" value="<?php echo $key['dias_reprogramados1'] ?>">
                          <select style="font-size:8pt;width:60px;;padding: 3px 5px;display:none" class="form-control dias">
                          <option value=1  <?php if ($key['DFTIPTIME']==1): ?>
                            <?php echo "selected" ?>
                          <?php endif; ?>>DH</option>
                          <option value=7  <?php if ($key['DFTIPTIME']==7): ?>
                            <?php echo "selected" ?>
                          <?php endif; ?>>Sem</option>
                        </td>
                        <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada1'])) ?></td>
                        <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                        <td class="DFREPROGRAM" style='background-color:#AED6A1;font-size:10pt;width:50px; text-align:center;  font-weight:bold'><?php echo $key['DFREPROGRAM'] ?></td>
                      <?php elseif ($key['DFREPROGRAM']==2): ?>
                        <td class="DFPLAZO" style="width:115px;">
                          <input type="number" class="form-control editable" style="font-size:8pt;padding: 3px 5px;"  name="editable" value="<?php echo $key['dias_reprogramados2'] ?>">
                          <select style="font-size:8pt;width:60px;;padding: 3px 5px;display:none" class="form-control dias">
                          <option value=1  <?php if ($key['DFTIPTIME']==1): ?>
                            <?php echo "selected" ?>
                          <?php endif; ?>>DH</option>
                          <option value=7  <?php if ($key['DFTIPTIME']==7): ?>
                            <?php echo "selected" ?>
                          <?php endif; ?>>Sem</option>
                        </td>
                        <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada2'])) ?></td>
                        <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                        <td class="DFREPROGRAM" style='background-color:#FFFA92;font-size:10pt;width:50px; text-align:center;  font-weight:bold'><?php echo $key['DFREPROGRAM'] ?></td>
                      <?php elseif ($key['DFREPROGRAM']==3): ?>
                        <td class="DFPLAZO" style="width:80px"><?php echo "No se puede reprogramar" ?></td>
                        <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada3'])) ?></td>
                        <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                        <td class="DFREPROGRAM" style='background-color:#FFFA92;font-size:10pt;width:50px; text-align:center;  font-weight:bold'><?php echo $key['DFREPROGRAM'] ?></td>

                      <?php endif; ?>

                  </tr>
                <?php endif; ?>

              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
<br>


    <div id="msg">

    </div>

</div>
</div>
