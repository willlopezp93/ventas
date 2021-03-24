
<div class="table-responsive">
  <div class="col-md-12">
    <button type="button" class="add btn btn-primary pull-right">Nueva Fila</button>
  </div>
    <br>
  <table class="table table-bordered table-condensed table-hover"  id="tbl_areas">
    <thead>
      <tr>
        <th>#</th>
        <th>AREA</th>
        <th>FEC.INICIAL</th>
        <th>FEC.FIN</th>
        <th>TERMINO</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($condicion==1): ?>
        <?php if ($key->area1!=''): ?>
        <tr>
          <td>1</td>
          <td class="areatd"><select class="form-control area_asignada" name="area">
            <option value="1" <?php if ($key->area1==1): ?>
              <?php echo "selected" ?>
            <?php endif; ?>>INGENIERÍA</option>
            <option value="2" <?php if ($key->area1==2): ?>
              <?php echo "selected" ?>
            <?php endif; ?>>PRODUCCION</option>
            <option value="3" <?php if ($key->area1==3): ?>
              <?php echo "selected" ?>
            <?php endif; ?>>COMPRAS</option>
            <option value="4" <?php if ($key->area1==4): ?>
              <?php echo "selected" ?>
            <?php endif; ?>>ALMACÉN</option>
          </select></td>
          <td class="fecha_inicio"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_inicio1 ?>"> </td>
          <td class="fecha_fin"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_final1 ?>"> </td>
          <td class="fecha_termino"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_termino1 ?>"> </td>
          	<td class="eliminar" style="width:60px"><button type="button" class="btn remove_button btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
        </tr>
        <?php endif; ?>
        <?php if ($key->area2!=''): ?>
          <tr>
            <td>2</td>
            <td class="areatd"><select class="form-control area_asignada" name="area">
              <option value="1" <?php if ($key->area2==1): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>INGENIERÍA</option>
              <option value="2" <?php if ($key->area2==2): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>PRODUCCION</option>
              <option value="3" <?php if ($key->area2==3): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>COMPRAS</option>
              <option value="4" <?php if ($key->area2==4): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>ALMACÉN</option>
            </select>  </td>
            <td class="fecha_inicio"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_inicio2 ?>"> </td>
            <td class="fecha_fin"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_final2 ?>"> </td>
            <td class="fecha_termino"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_termino2 ?>"> </td>
            	<td class="eliminar" style="width:60px"><button type="button" class="btn remove_button btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
          </tr>
        <?php endif; ?>
        <?php if ($key->area3!=''): ?>
          <tr>
            <td>3</td>
            <td class="areatd"><select class="form-control area_asignada" name="area">
              <option value="1" <?php if ($key->area3==1): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>INGENIERÍA</option>
              <option value="2" <?php if ($key->area3==2): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>PRODUCCION</option>
              <option value="3" <?php if ($key->area3==3): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>COMPRAS</option>
              <option value="4" <?php if ($key->area3==4): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>ALMACÉN</option>
            </select>  </td>
            <td class="fecha_inicio"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_inicio3 ?>"> </td>
            <td class="fecha_fin"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_final3 ?>"> </td>
            <td class="fecha_termino"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_termino3 ?>"> </td>
            	<td class="eliminar" style="width:60px"><button type="button" class="btn remove_button btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
          </tr>
        <?php endif; ?>
        <?php if ($key->area4!=''): ?>
          <tr>
            <td>4</td>
            <td class="areatd"><select class="form-control area_asignada" name="area">
              <option value="1" <?php if ($key->area4==1): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>INGENIERÍA</option>
              <option value="2" <?php if ($key->area4==2): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>PRODUCCION</option>
              <option value="3" <?php if ($key->area4==3): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>COMPRAS</option>
              <option value="4" <?php if ($key->area4==4): ?>
                <?php echo "selected" ?>
              <?php endif; ?>>ALMACÉN</option>
            </select>  </td>
            <td class="fecha_inicio"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_inicio4 ?>"> </td>
            <td class="fecha_fin"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_final4 ?>"> </td>
            <td class="fecha_termino"><input type="date" class="form-control" name="" value="<?php echo $key->fecha_termino4 ?>"> </td>
            	<td class="eliminar" style="width:60px"><button type="button" class="btn remove_button btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
          </tr>
        <?php endif; ?>
      <?php else: ?>
        <tr>
          <td>1</td>
          <td class="areatd"><select class="form-control area_asignada" name="area">
            <option value="1">INGENIERÍA</option>
            <option value="2">PRODUCCION</option>
            <option value="3" >COMPRAS</option>
            <option value="4" >ALMACÉN</option>
          </select></td>
          <td class="fecha_inicio"><input type="date" class="form-control" name="" value=""> </td>
          <td class="fecha_fin"><input type="date" class="form-control" name="" value=""> </td>
          <td class="fecha_termino"><input type="date" class="form-control" name="" value=""> </td>
          	<td class="eliminar" style="width:60px"><button type="button" class="btn remove_button btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
        </tr>
      <?php endif; ?>


    </tbody>
  </table>

</div>
