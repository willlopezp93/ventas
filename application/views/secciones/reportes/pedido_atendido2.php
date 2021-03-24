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
      <th>Cant.Atendida</th>
      <th>Fec.Facturación</th>
      <th>Situación</th>
      <th>Valor Venta Unit</th>
      <th>Total</th>

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


        <td><?php echo number_format($key['POR_ATENDER']) ?></td>

        <td><?php echo date('d-m-Y',strtotime($key['FEC_FACT'])) ?></td>

        <td><?php echo $key['situacion'] ?></td>
        <td><?php echo number_format($key['val_unit'],2) ?></td>
        <td><?php echo number_format($key['total'],2) ?></td>


      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
