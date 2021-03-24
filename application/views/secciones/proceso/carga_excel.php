<div class="table-responsive" >

  <!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/requerimiento/detalle.php-->
  <table class="table table-bordered table-condensed table-hover" id="tbl_detalle">
  <thead>
      <tr>

        <th style="font-size:8.5pt" >Codigo</th>
        <th style="font-size:8.5pt" >Descripcion</th>
        <th style="font-size:8.5pt" >Und</th>
        <th style="font-size:8.5pt" >Cant</th>
        <th style="font-size:8.5pt" >Plazo</th>
        <th style="font-size:8.5pt" >P.Lista</th>
        <th style="font-size:8.5pt" >Dscto.</th>
        <th style="font-size:8.5pt" >P.Neto</th>
        <th style="font-size:8.5pt" >Sub Total</th>
        <th style="display:none;">Observaciones</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="info_detalle">
      <?php foreach ($filas as $key): ?>
        <tr id="<?php echo $key->item ?>">
           <td class="CDCODIGO" style="width:145px;font-size:8.5pt"><?php echo $key->codigo ?></td>
            <td class="CDDESCRI"><input type="text" class="form-control desc" name="" style="font-size:8.5pt;padding: 3px 5px;"  value="<?php echo str_replace('  ','',$key->descripcion) ?>"></td>
            <td class="CDUNIDAD" style="width:40px;font-size:8.5pt"><?php echo $key->unidad ?></td>
            <td class="CDCANTID" style="width:60px;font-size:8.5pt"><input type="number" class="form-control newcant" style="font-size:8.5pt;padding: 3px 5px;"  name="" value="<?php echo str_replace(',','',number_format($key->cantidad)) ?>"></td>
            <td class="PLAZO" style="width:60px;font-size:8.5pt"><input type="number" value="<?php echo $key->dias ?>" class="form-control editable" style="font-size:8.5pt;;padding: 3px 5px;" name="editable">
              <select class="form-control dias" style="font-size:8.5pt;width:60px;padding: 3px 5px;display: none;">
              <option value=1 <?php if ($key->tiempo==1): ?>
              <?php echo "selected" ?>
            <?php endif; ?>>DH</option>
            <option value=7 <?php if ($key->tiempo==7): ?>
            <?php echo "selected" ?>
          <?php endif; ?>>Sem</option></td>
            <td class="CDPREC_ORI" style="width:75px; font-size:8.5pt"><input class="form-control newprecio" type="number" style="font-size:8.5pt;padding: 3px 5px;"  value="<?php echo $key->precio ?>"></td>
            <td class="CDPORDES" style="width:70px; font-size:8.5pt"><input type="number" class="form-control newdescuento" style="font-size:8.5pt;width:65px;padding: 3px 5px;"  value="<?php echo ($key->descuento) ?>"></td>
            <td class="precioneto" style="width:75px; font-size:8.5pt"> <input type="text" class="form-control preciobrutounit" style="font-size:8.5pt;padding: 3px 5px;"   value="<?php echo $key->precio*(1-$key->descuento)?>"> </td>
            <td class="subtotal" style="width:75px; font-size:8.5pt"><input type="text" class="form-control subtotalnew" style="font-size:8.5pt;padding: 3px 5px;"  value="<?php echo ($key->cantidad *$key->precio*(1-$key->descuento)) ?>" readonly></td>
            <td class="CDTEXTO"  style="display:none;"><input class="form-control observaciones" style="font-size:8.5pt;padding: 3px 5px;"  placeholder="Informacion adicional"></td>
            <td class="eliminar" style="width:40px; font-size:8.5pt"><button type="button" name="remove" data-id="<?php echo $key->item  ?>"class="btn btn-xs btn-danger btn_remove"><i class="glyphicon glyphicon-trash"></i></button></td>
            <td class="clonar" style="width:40px;font-size:8.5pt"><button type="button" data-id="<?php echo $key->item ?>" class="btn btn-xs btn-primary addFila"><i class="glyphicon glyphicon-duplicate"></i></button></td>
            <td class="descuentovalor" style="display:none"><input type="text" class="descuentovalornew" value="<?php echo $key->precio*$key->cantidad*($key->descuento)?>"></td>
            <td class="stock" style="display:none;"><input type="text" class="stocktext" value="<?php echo $key->stock ?>" ></td>
            <td style="display:none;"><?php echo $key->item ?></td>
            <td style="display:none;"><?php echo number_format($key->precio,2) ?></td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- trabajar la tabla en otra seccion, guiarse de archivo views/secciones/requerimiento/detalle.php-->
</div>
</div>
</div>
