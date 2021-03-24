<div class="table-responsive" id="tbl_compra">

  <!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/transferencia/detalle.php-->
  <table class="table table-bordered table-condensed table-hover">
    <thead>
      <tr>
        <th>item</th>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Cantidad Pendiente</th>
        <th>Cantidad Atendida</th>
       </tr>
    </thead>
    <tbody>
<?php foreach ($detalle as $key): ?>

        <?php if ($key->canceled=='n'): ?>
          <tr>

            <td class="item_numcompra" style="display:none;" ><?php echo $key->item_num ?></td>
            <td class="itemcodigocompra"><?php echo $key->itemcodigo ?></td>
            <td class="itemdesccompra"><?php echo $key->itemdesc  ?></td>
            <td class="cant_aprobcompra"><?php echo number_format($key->cant_pendiente,2) ?></td>
            <td class="atendercompra"><input type="number" class="form-control cantidadcompra" name="cantidad"  min="0" value="0"> </td>
            <td style="display:none;" class="cant_atendidacompra"></td>
            <td style="display:none;" class="itemunidadcompra"><?php echo $key->itemunidad ?></td>
            <td style="display:none;" class="prioridadcompra"><?php echo $key->prioridad ?></td>
            <td style="display:none;" class="maquinacompra"><?php echo $key->maquina ?></td>
            <td style="display:none;" class="observacionescompra"><?php echo $key->observaciones ?></td>
            <td style="display:none;" class="canceledcompra"><?php echo $key->canceled  ?></td>

          </tr>
        <?php endif; ?>

<?php endforeach; ?>


    </tbody>
  </table>

  <!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/transferencia/detalle.php-->
</div>
