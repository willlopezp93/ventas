
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4>Eliminación de Pedidos</h4>
        </div>
      <div class="box-body">

        <div class="row">
          <div class="col-md-12">
            <div class="table table-responsive">
              <table class="table table-condensed table-hover">
                <thead>
                  <tr>
                    <th>PEDIDO</th>
                    <th>FECHA</th>
                    <th>CLIENTE</th>
                    <th>COTIZACIÓN</th>
                    <th>MONTO</th>
                    <th>MONEDA</th>
                    <th>ELIMINAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pedidos as $key): ?>
                    <tr>
                      <td><?php echo $key->CFNUMPED ?></td>
                      <td><?php echo date('Y-m-d',strtotime($key->CFFECDOC)) ?></td>
                      <td><?php echo $key->CFNOMBRE ?></td>
                      <td><?php echo $key->CFRFNUMDOC ?></td>
                      <td><?php echo $key->CFIMPORTE ?></td>
                      <td><?php echo $key->CFCODMON ?></td>
                      <td><button type="button" name="remove" data-id="<?php echo $key->CFNUMPED  ?>" data-idref="<?php echo $key->CFRFNUMDOC ?>" class="btn btn-xs btn-danger btn_remove"><i class="glyphicon glyphicon-trash"></i></button></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>
  </div>
</section>
