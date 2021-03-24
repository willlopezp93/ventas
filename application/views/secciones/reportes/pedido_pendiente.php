<style media="screen">
  td,th{
    font-size: 10pt;
  }
</style>
  <table class="table table-bordered table-condensed table-hover" id="relacion_reporte" style="font-size: 8pt">
    <thead>
      <tr>
        <th>Pedido</th>
        <th>Ord.Com</th>
        <th>Cliente</th>
        <th>Código</th>
        <th>Descripción</th>
        <th>Por Atender</th>
        <th>P.Unit</th>
        <th>Total</th>
        <th style=";font-size:10pt;display:none" >-</th>
        <th>Fecha Entrega</th>
        <th>Dias de Entrega</th>
      </tr>
    </thead>
    <tbody>
      <?php $total=0; foreach ($pedido as $key): ?>
        <?php if ($key['DFSALDO']!=0): ?>
          <tr>
            <td style=";font-size:10pt"><?php echo $key['CFNUMPED'] ?></td>
            <td style=";font-size:10pt"><?php echo $key['CFORDCOM'] ?></td>
            <td style=";font-size:10pt"><?php echo $key['CFNOMBRE'] ?></td>
            <td style=";font-size:10pt"><?php echo $key['DFCODIGO'] ?></td>
            <td style=";font-size:10pt"><?php echo $key['dfdescri'] ?></td>
            <td style=";font-size:10pt"><?php echo number_format($key['DFSALDO']) ?></td>
            <td style=";font-size:10pt"><?php echo number_format($key['val_unit'],2) ?></td>
            <td style=";font-size:10pt"><?php echo number_format($key['total'],2)?></td>
            <td style=";font-size:10pt;display:none" ><?php echo str_replace(',','',number_format($key['total'],2))?></td>
            <td style=";font-size:10pt"><?php echo date('Y-m-d',strtotime($key['DFFECENT'])) ?></td>
              <?php if ($key['indicador']<0): ?>
              <td style="text-align: center;color: white;background-color:red;font-size:11pt"><b><?php echo $key['indicador'] ?></b></td>
            <?php elseif ($key['indicador']==1 or $key['indicador']==2 ): ?>
              <td style="text-align: center;color: white;background-color:orange;font-size:11pt"><b><?php echo $key['indicador'] ?></b></td>
            <?php elseif ($key['indicador']>=3 and $key['indicador']<=5 ): ?>
              <td style="text-align: center;color: black;background-color:yellow;font-size:11pt"><b><?php echo $key['indicador'] ?></b></td>
            <?php elseif ($key['indicador']>=6): ?>
              <td style="text-align: center;color: white;background-color:green;font-size:11pt"><b><?php echo $key['indicador'] ?></b></td>
            <?php else: ?>
              <td></td>
              <?php endif; ?>


          </tr>
        <?php $total=$total+$key['total']; endif; ?>
      <?php  endforeach; ?>
      <tfoot>
        <tr>
          <td colspan="6" style="text-align: center;font-size:15pt"><b>TOTAL(USD)</b></td>
          <td style=";font-size:10pt" id="total_order"><b></b></td>
          <td colspan="3"></td>
        </tr>
      </tfoot>
    </tbody>
  </table>
