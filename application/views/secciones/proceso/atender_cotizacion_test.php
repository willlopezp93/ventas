
<div  id="tbl_pedido">
  <div class="box-body">

      <div class="row">
        <div class="col-md-3">
          <label>ORDEN DE COMPRA</label>
          <input type="text" class="form-control" name="oc" id="oc" value="">
        </div>
        <div class="col-md-3">
          <label>F.ENTREGA</label>
          <input type="date" class="form-control" name="CFFECENT_ALM" id="CFFECENT_ALM" value="<?php echo date('Y-m-d') ?>">
        </div>
        <div class="col-md-3">
          <label>TURNO</label>
          <select class="form-control" name="CFTURNO" id="CFTURNO">
            <option value="1">MAÑANA</option>
            <option value="2">TARDE</option>
          </select>
        </div>
        <div class="col-md-3">
          <label>ENVIO CORREO</label>
          <select class="form-control" name="CORREOCOND" id="CORREOCOND">
            <option value="1">SI</option>
            <option value="2">NO</option>
          </select>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-6">
          <label>INFORMACIÓN ADICIONAL</label>
          <textarea name="CFGLOSA" class="form-control" id="CFGLOSA" rows="2" cols="80"></textarea>

        </div>
        <div class="col-md-6">
          <label>INFORMACIÓN ADICIONAL DE LA ENTREGA</label>
          <textarea name="INFOCOND" class="form-control" id="INFOCOND" rows="2" cols="80"></textarea>

        </div>
      </div><br>
      <div class="row">
        <div class="col-md-12">
          <div class="pull-right">
            <button type="button" class="btn btn-success" name="button" id="ver_stock">Ver Stock</button>
          </div>
        </div>
      </div>
        <div class="table-responsive" >
          <table class="table table-bordered table-condensed table-hover" id="tbl_detalle">
          <thead>
              <tr>
                <th style="font-size:8pt">N°</th>
                <th style="font-size:8pt">Codigo</th>
                <th style="font-size:8pt">Descripcion</th>
                <th style="font-size:8pt">UM</th>
                <th style="font-size:8pt">Cant.</th>
                <th style="font-size:8pt">Plazo</th>
                <th style="display:none">Fec.Entrega</th>
                <th >P.Lista</th>
                <th>Dscto.</th>
                <th style="font-size:8pt">P.Neto</th>
                <th style="font-size:8pt">Sub Total</th>
                <th style="font-size:8pt">CC</th>
                <th style="font-size:8pt">Responsable</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="info_detalle">
              <?php $item=1; foreach ($detalle as $key): ?>
                <?php if ($key->CDCANTPEN!=0 and $key->PLAZO!='999'): ?>
                  <tr id="codido<?php echo $key->CDCODIGO ?>" <?php if ($key->CDCODIGO!='TEXTO'): ?>
                    <?php if ($key->DFCENCOS==''): ?>
                      <?php echo "style='background-color:#F06060'" ?>
                    <?php endif; ?>
                  <?php endif; ?>>
                    <td class="CDSECUEN" style="font-size:8pt"><?php echo $key->CDSECUEN ?></td>
                     <td class="CDCODIGO" style="font-size:8pt;width:120px"><?php echo $key->CDCODIGO ?></td>
                      <td class="CDDESCRI" style="font-size:8pt"><?php echo str_replace("  ", " ", $key->descripcion_corregida) ?></td>
                      <td class="CDUNIDAD" style="width:30px;font-size:8pt"><?php echo $key->CDUNIDAD ?></td>
                      <td class="limite" style="display:none"><?php echo number_format($key->CDCANTPEN) ?></td>
                      <td class="CDCANTPEN" style="width:50px"><input type="number" class="form-control newcant" style="width:40px;padding: 3px 5px;font-size:8pt" name="" value="<?php echo ($key->CDCANTPEN) ?>" ></td>

                      <td class="PLAZO" style="width:50px">
                          <input type="number" class="form-control editable" style="font-size:8.5pt;width:40px;padding: 3px 5px;display: inline-block;" name="editable" value="<?php echo $key->PLAZO ?>">
                          <select  class="form-control dias" style="font-size:8.5pt;width:60px;padding: 3px 5px;display: none;" name="dias">
                            <option value=1  <?php if ($key->CCTIPTIME==1): ?>
                              <?php echo "selected" ?>
                            <?php endif; ?>>DH</option>
                            <option value=7  <?php if ($key->CCTIPTIME==7): ?>
                              <?php echo "selected" ?>
                            <?php endif; ?>>Sem</option>
                          </select>
                      </td>
                      <td class="CDFECENT" style="display:none"><?php echo date('Y-m-d',strtotime($key->CDFECENT)) ?></td>
                      <td class="CDPREC_ORI" style="width:60px"><input class="form-control newprecio" type="number" style="font-size:8pt;width:50px;padding: 3px 5px;" value="<?php echo $key->CDPREC_ORI ?>"></td>
                      <td class="CDPORDES" style="width:60px"><input type="number" class="form-control newdescuento" style="font-size:8pt;width:50px;padding: 3px 5px;" value="<?php echo ($key->CDPORDES)/100 ?>"></td>
                      <td class="precioneto" style="width:60px"><input type="text" class="form-control preciobrutounit" style="font-size:8pt;width:50px;padding: 3px 5px;" value="<?php echo $key->CDPREC_ORI*(100-$key->CDPORDES)/100?>" readonly>	</td>
                      <td class="subtotal" style="width:60px"><input type="text" class="form-control subtotalnew" style="font-size:8pt;width:50px;padding: 3px 5px;" value="<?php echo ($key->CDCANTPEN *$key->CDPREC_ORI*(100-$key->CDPORDES))/100 ?>" readonly></td>
                      <td class="centrocosto" style="width:70px" ><input type="text" class="form-control ccnew" style="font-size:8pt;width:65px;padding: 3px 5px;"  value="<?php echo $key->DFCENCOS?>"> </td>
                      <td class="responsable"> <select  class="form-control select_responsable" style="font-size:8.5pt;width:60px;padding: 3px 5px;" name="select_responsable">
                                                <option value="">ALMACÉN</option>
                                                <option value="compras">COMPRAS</option>
                                                <option value="planeamiento">PLANEAMIENTO</option>
                                                <option value="stock_07">STOCK 07</option>
                                                </select></td>
                      <td class="estado" style="display:none">1</td>
                      <td class="descuentovalor" style="display:none"> <input type="text" class="descuentovalornew" value="<?php echo $key->CDCANTPEN*$key->CDPREC_ORI*($key->CDPORDES)/100 ?>"></td>
                      <td class="igvvalor" style="display:none"><?php if ($cabecera->CCTIPCOTIZA=='NAC'): ?><?php echo (($key->CDPREC_ORI*(100-$key->CDPORDES))/100)*0.18 ?><?php else: ?><?php echo 0;?><?php endif; ?></td>
                      <td class="eliminar" style="width:60px"><button type="button"  class="btn btn-xs btn-success activar" style="display:none;font-size:8pt">Activar</button><button type="button" name="remove" style="font-size:8pt" class="btn btn-xs btn-danger desactivar">Desactivar</button></td>
                      <td class="descuentovalorq" style="display:none"> <input type="text" class="descuentovalorqnew" value="<?php echo $key->CDCANTPEN*$key->CDPREC_ORI*($key->CDPORDES)/100 ?>"></td>

                    </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
<br>
    <div class="row">
      <div class="col-md-9">

      </div>
      <div class="col-md-1">
        <label>Subtotal</label>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" id="subtotal" name="subtotal" readonly value="">
      </div>


      </div>
    <div class="row">
      <div class="col-md-7">

      </div>
      <div class="col-md-2">
        <div class="col-md-3">

        </div>
        <div class="col-md-2">
          <label></label>
        </div>
        <div class="col-md-7">

        </div>
      </div>
      <div class="col-md-1">
        <label>Dscto.Val</label>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" style="color:red" id="dsct_cliente_valor" name="dsct_cliente_valor" readonly value="">
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">

      </div>
      <div class="col-md-1">
        <label>Valor Venta</label>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" id="valor_venta" name="valor_venta" readonly value="">
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">

      </div>
      <div class="col-md-1">
        <label>IGV</label>
      </div>
      <div class="col-md-2">
        <input type="hidden" name="igvpor" id="igvpor" value="<?php if ($cabecera->CCTIPCOTIZA=='NAC'):  echo 0.18 ?>
        <?php else:  echo 0 ?>
        <?php endif; ?>">
        <input type="text" class="form-control"  id="igv" name="igv" readonly value="">
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">

      </div>
      <div class="col-md-1">
        <label>TOTAL</label>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" id="total_doc" name="total_doc" readonly value="">
      </div>
    </div>
    <br><br>


    <div id="msg">

    </div>

</div>
</div>

<div id="div_stock" style="display:none">
  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        <button type="button" class="btn btn-success" name="button" id="ver_pedido">Ver Pedido</button>
      </div>
    </div>
  </div>
  <table class="table table-bordered">
    <thead>
      <th>#</th>
      <th>Código</th>
      <th>Descrip</th>
      <th>Stock</th>
    </thead>
    <tbody>
      <?php $item=1; foreach ($detalle_stock as $key): ?>
        <tr <?php if ($key['stock']==0): ?>
          class="danger"
        <?php endif; ?>>
          <td><b><?php echo $key['CDSECUEN'] ?></b> </td>
          <td><?php echo $key['codigo'] ?></td>
          <td><?php echo $key['descripcion'] ?></td>
          <td><?php echo number_format($key['stock']) ?></td>
        </tr>
      <?php $item++; endforeach; ?>
    </tbody>
  </table>
</div>
