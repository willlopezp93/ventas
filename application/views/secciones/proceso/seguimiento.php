<button type="button" class="btn btn-info retroceder" name="button">Atras</button>
<br><br>
<div class="row">
    <div class="col-md-6">
      <h2>Nro. Pedido : <?php echo $pedido ?></h2>
    </div>
</div>
  <input type="hidden" id="pedido" value="<?php echo $pedido ?>">
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


            <tr>
              <td class="DFSECUEN" style="font-size:8pt;text-align:center;width:35px"><?php echo $key['DFSECUEN'] ?></td>
               <td class="DFCODIGO" style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                <td class="DFDESCRI" style="font-size:7.5pt"><?php echo $key['DFDESCRI'] ?></td>
                <td class="DFCANTID" style="font-size:7.5pt;text-align:center;width:30px"><?php echo number_format($key['DFCANTID']) ?></td>
                <td class="DFUNIDAD" style="font-size:7.5pt;text-align:center;width:30px"><?php echo $key['DFUNIDAD'] ?></td>
                <?php if ($key['DFREPROGRAM']==0): ?>
                  <td class="DFPLAZO" style="width:115px;font-size:7.5pt;text-align:center;">
                    <?php echo $key['DFPLAZO'] ?>
                  </td>
                  <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                  <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>


                <?php elseif ($key['DFREPROGRAM']==1): ?>
                  <td class="DFPLAZO" style="width:115px;font-size:7.5pt;text-align:center;">
                  <?php echo $key['dias_reprogramados1'] ?>
                  </td>
                  <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada1'])) ?></td>
                  <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>

                <?php elseif ($key['DFREPROGRAM']==2): ?>
                  <td class="DFPLAZO" style="width:115px;font-size:7.5pt;text-align:center;">
                    <?php echo $key['dias_reprogramados2'] ?>
                  </td>
                  <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada2'])) ?></td>
                  <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>

                <?php elseif ($key['DFREPROGRAM']==3): ?>
                  <td class="DFPLAZO" style="width:80px"><?php echo "No se puede reprogramar" ?></td>
                  <td class="DFFECENT" style="font-size:8pt; text-align:center;width:70px" ><?php echo date('d-m-Y',strtotime($key['fecha_reprogramada3'])) ?></td>
                  <td class="FECHAREF" style="display:none"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>


                <?php endif; ?>
                <td>  <button type="button" class="btn btn-info ver_areas" name="button" data-id="<?php echo $key['DFSECUEN'] ?>" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-tasks"></i></button></td>
            </tr>
    

        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="modal-areas"  role="dialog" aria-labelledby="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><div id="modal_titulo"></div></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
  				<div class="modal-body">

              <input type="hidden" id="pedido_det" name='pedido_det' value=''>
              <input type="hidden" id="DFSECUEN" name='DFSECUEN' value=''>
              <input type="hidden" id="DFCODIGO" name='DFCODIGO' value=''>


              <div  id="form_pedido_det">

              </div>


  	      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-default" id="guardar_seguimiento"  data-dismiss="modal">Asignar</button>
        </div>
      </div>
    </div>
  </div>
