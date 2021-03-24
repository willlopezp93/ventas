
<div  id="tbl_pedido">
  <div class="callout callout-warning">
      <h4>Indicaciones!</h4>
      <p>Sólo se permitirá 3 reprogramaciones por item.</p>
  </div>
  <input type="hidden" id="fecha" value="<?php echo $fecha ?>">
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
                <th style="font-size:8pt;text-align:center;">Fec.Entrega</th>

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
                        <td class="DFPLAZO" style="font-size:7.5pt;text-align:center;width:30px"><?php echo $key['DFPLAZO'] ?></td>
                      <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                      <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>

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
