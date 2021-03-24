<br><br>
<div class="row">
  <div class="col-md-12">
<button type="button" name="button" id="guardar_meta" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right">Guardar</button>
  </div>
</div>
 <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tbl_data">
    <thead>
      <tr>
        <th>Año</th>
        <th>Mes</th>
        <th>Meta Venta Relacionados</th>
        <th>Meta Venta Terceros</th>
        <th>Dias Extraordinario</th>
      </tr>
    </thead>
    <?php if ($condicion==1): ?>
      <tbody>
        <?php  foreach ($metas as $key): ?>
          <tr>
            <td class="año"><?php echo $key->año ?></td>
            <td class="mes"><?php echo $key->año.'-'.str_pad($key->mes, 2, "0", STR_PAD_LEFT); ?></td>
            <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value="<?php echo $key->meta_relacionada ?>"> </td>
            <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value="<?php echo $key->meta_tercero?>"> </td>
            <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value="<?php echo $key->dias_extraordinarios?>"> </td>
          </tr>
        <?php  endforeach; ?>
      </tbody>
    <?php else: ?>
      <tr>
        <td class="año"></td>
        <td class="mes">Enero</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Febrero</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Marzo</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Abril</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Mayo</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Junio</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Julio</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Agosto</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Septiembre</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Octubre</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
        <td class="año"></td>
        <td class="mes">Noviembre</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
      <tr>
        <td class="año"></td>
        <td class="mes">Diciembre</td>
        <td class="relacionado"><input type="text" name="meta_relacionada" class="form-control meta_relacionada" value=""> </td>
        <td class="tercero"><input type="text" name="meta_tercero" class="form-control meta_tercero" value=""> </td>
        <td class="diasextra"><input type="text" name="dias_extraodinarios" class="form-control dias_extraodinarios" value=""> </td>
      </tr>
    <?php endif; ?>
  </table>
</div>
