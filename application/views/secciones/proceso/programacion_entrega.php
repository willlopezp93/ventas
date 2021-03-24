<br>
<table class="table table-condensed table-bordered" id="tbl_detalle">
  <thead>
    <tr>
      <th>PEDIDO</th>
      <th>ITEM</th>
      <th>CODIGO</th>
      <th>DESCRIPCION</th>
      <th>CANT.</th>
      <th>SALDO</th>
      <th>ENTREGA ESTIMADA</th>
      <th>TURNO</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle_ss as $key): ?>
      <tr>
        <td class="DFNUMPED" style="font-size:8pt;"><?php echo $key->DFNUMPED ?></td>
        <td class="DFSECUEN" style="font-size:8pt;"><?php echo $key->DFSECUEN ?></td>
        <td class="DFCODIGO" style="font-size:8pt;"><?php echo $key->DFCODIGO ?></td>
        <td class="DFDESCRI" style="font-size:8pt;"><?php echo $key->DFDESCRI ?></td>
        <td class="DFCANTID" style="font-size:8pt;"><?php echo number_format($key->DFCANTID) ?></td>
        <td class="DFSALDO"><input type="number" class="form-control saldo" style="width:50px;padding-left: 6px;" name="" value="<?php echo number_format($key->DFSALDO )?>"> </td>
        <td class="DFFECENT"><input type="date" class="form-control fecha" style="width:130px;padding-left: 6px;" name="" value="<?php foreach ($detalle as $key1) {
          if ($key->DFSECUEN==$key1->DFSECUEN AND $key->DFNUMPED==$key1->DFNUMPED) {
            echo date('Y-m-d',strtotime($key1->DFFECENT));
          }
        } ?>"> </td>
        <td class="DFTURNO"><select class="form-control turno" style="padding-left: 6px;font-size:7pt;" name="">
          <option value="mañana">MAÑANA</option>
          <option value="tarde">TARDE</option>
        </select>   </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="row">
  <div class="col-md-12">
    <div class="btn-group">
      <button type="button" class="btn btn-primary btn-lg" id="actualizar" name="button">Actualizar</button>
      <button type="button" class="btn btn-info btn-lg" id="actualizar_notificar" name="button">Actualizar y Notificar</button>
    </div>
  </div>
</div>
