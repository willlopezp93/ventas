

<div class="table table-responsive">
  <table class="table table-condense table-hover" id="table_detail">
    <thead>
      <tr>
        <th>PEDIDO</th>
        <th>RUC</th>
        <th>CLIENTE</th>
        <th>CÓDIGO</th>
        <th>DESCRIPCIÓN</th>
        <th>CANT</th>
        <th>PRECIO</th>
        <th>P.TOTAL</th>
        <th>FEC.FACT</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cumplimiento_pedidos as $key): ?>
        <?php switch ($condicion) {
    case "tiempo":?>
      <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
        <tr>
          <td><?php echo $key->dfnumped ?></td>
          <td><?php echo $key->CFCODCLI ?></td>
          <td><?php echo $key->CFNOMBRE ?></td>
          <td><?php echo $key->DFCODIGO ?></td>
          <td><?php echo $key->dfdescri ?></td>
          <td><?php echo number_format($key->dfcantid) ?></td>
          <td><?php echo number_format($key->val_unit,2) ?></td>
          <td><?php echo number_format($key->total,2) ?></td>
          <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
        </tr>
      <?php endif; ?>
      <?php  break;
    case "retraso":?>
    <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
      <tr>
        <td><?php echo $key->dfnumped ?></td>
        <td><?php echo $key->CFCODCLI ?></td>
        <td><?php echo $key->CFNOMBRE ?></td>
        <td><?php echo $key->DFCODIGO ?></td>
        <td><?php echo $key->dfdescri ?></td>
        <td><?php echo number_format($key->dfcantid) ?></td>
        <td><?php echo number_format($key->val_unit,2) ?></td>
        <td><?php echo number_format($key->total,2) ?></td>
        <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
      </tr>
    <?php endif; ?>
      <?php break;
    case "tiempord":?>
        <?php if ($key->CFCODCLI=='20469962246'): ?>
          <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
            <tr>
              <td><?php echo $key->dfnumped ?></td>
              <td><?php echo $key->CFCODCLI ?></td>
              <td><?php echo $key->CFNOMBRE ?></td>
              <td><?php echo $key->DFCODIGO ?></td>
              <td><?php echo $key->dfdescri ?></td>
              <td><?php echo number_format($key->dfcantid) ?></td>
              <td><?php echo number_format($key->val_unit,2) ?></td>
              <td><?php echo number_format($key->total,2) ?></td>
              <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
            </tr>
          <?php endif; ?>
        <?php endif; ?>
      <?php break;
      case "retrasord":?>
          <?php if ($key->CFCODCLI=='20469962246'): ?>
            <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
              <tr>
                <td><?php echo $key->dfnumped ?></td>
                <td><?php echo $key->CFCODCLI ?></td>
                <td><?php echo $key->CFNOMBRE ?></td>
                <td><?php echo $key->DFCODIGO ?></td>
                <td><?php echo $key->dfdescri ?></td>
                <td><?php echo number_format($key->dfcantid) ?></td>
                <td><?php echo number_format($key->val_unit,2) ?></td>
                <td><?php echo number_format($key->total,2) ?></td>
                <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
              </tr>
            <?php endif; ?>
          <?php endif; ?>
          <?php break;
          case "tiempoov":?>
              <?php if ($key->CFCODCLI=='20535689394'): ?>
                <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                  <tr>
                    <td><?php echo $key->dfnumped ?></td>
                    <td><?php echo $key->CFCODCLI ?></td>
                    <td><?php echo $key->CFNOMBRE ?></td>
                    <td><?php echo $key->DFCODIGO ?></td>
                    <td><?php echo $key->dfdescri ?></td>
                    <td><?php echo number_format($key->dfcantid) ?></td>
                    <td><?php echo number_format($key->val_unit,2) ?></td>
                    <td><?php echo number_format($key->total,2) ?></td>
                    <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                  </tr>
                <?php endif; ?>
              <?php endif; ?>
              <?php break;
              case "retrasoov":?>
                  <?php if ($key->CFCODCLI=='20535689394'): ?>
                    <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                      <tr>
                        <td><?php echo $key->dfnumped ?></td>
                        <td><?php echo $key->CFCODCLI ?></td>
                        <td><?php echo $key->CFNOMBRE ?></td>
                        <td><?php echo $key->DFCODIGO ?></td>
                        <td><?php echo $key->dfdescri ?></td>
                        <td><?php echo number_format($key->dfcantid) ?></td>
                        <td><?php echo number_format($key->val_unit,2) ?></td>
                        <td><?php echo number_format($key->total,2) ?></td>
                        <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php break;
                  case "tiempocd":?>
                      <?php if ($key->CFCODCLI=='OD151012DG7'): ?>
                        <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                          <tr>
                            <td><?php echo $key->dfnumped ?></td>
                            <td><?php echo $key->CFCODCLI ?></td>
                            <td><?php echo $key->CFNOMBRE ?></td>
                            <td><?php echo $key->DFCODIGO ?></td>
                            <td><?php echo $key->dfdescri ?></td>
                            <td><?php echo number_format($key->dfcantid) ?></td>
                            <td><?php echo number_format($key->val_unit,2) ?></td>
                            <td><?php echo number_format($key->total,2) ?></td>
                            <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                          </tr>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php break;
                      case "retrasocd":?>
                          <?php if ($key->CFCODCLI=='OD151012DG7'): ?>
                            <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                              <tr>
                                <td><?php echo $key->dfnumped ?></td>
                                <td><?php echo $key->CFCODCLI ?></td>
                                <td><?php echo $key->CFNOMBRE ?></td>
                                <td><?php echo $key->DFCODIGO ?></td>
                                <td><?php echo $key->dfdescri ?></td>
                                <td><?php echo number_format($key->dfcantid) ?></td>
                                <td><?php echo number_format($key->val_unit,2) ?></td>
                                <td><?php echo number_format($key->total,2) ?></td>
                                <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                              </tr>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php break;
                          case "tiempogg":?>
                              <?php if ($key->CFVENDE =='08' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                                <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                                  <tr>
                                    <td><?php echo $key->dfnumped ?></td>
                                    <td><?php echo $key->CFCODCLI ?></td>
                                    <td><?php echo $key->CFNOMBRE ?></td>
                                    <td><?php echo $key->DFCODIGO ?></td>
                                    <td><?php echo $key->dfdescri ?></td>
                                    <td><?php echo number_format($key->dfcantid) ?></td>
                                    <td><?php echo number_format($key->val_unit,2) ?></td>
                                    <td><?php echo number_format($key->total,2) ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                                  </tr>
                                <?php endif; ?>
                              <?php endif; ?>
                              <?php break;
                              case "retrasogg":?>
                                  <?php if ($key->CFVENDE =='08' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                                    <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                                      <tr>
                                        <td><?php echo $key->dfnumped ?></td>
                                        <td><?php echo $key->CFCODCLI ?></td>
                                        <td><?php echo $key->CFNOMBRE ?></td>
                                        <td><?php echo $key->DFCODIGO ?></td>
                                        <td><?php echo $key->dfdescri ?></td>
                                        <td><?php echo number_format($key->dfcantid) ?></td>
                                        <td><?php echo number_format($key->val_unit,2) ?></td>
                                        <td><?php echo number_format($key->total,2) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                                      </tr>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                  <?php break;
                                  case "tiempofn":?>
                                      <?php if ($key->CFVENDE =='10' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                                        <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                                          <tr>
                                            <td><?php echo $key->dfnumped ?></td>
                                            <td><?php echo $key->CFCODCLI ?></td>
                                            <td><?php echo $key->CFNOMBRE ?></td>
                                            <td><?php echo $key->DFCODIGO ?></td>
                                            <td><?php echo $key->dfdescri ?></td>
                                            <td><?php echo number_format($key->dfcantid) ?></td>
                                            <td><?php echo number_format($key->val_unit,2) ?></td>
                                            <td><?php echo number_format($key->total,2) ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                                          </tr>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                      <?php break;
                                      case "retrasofn":?>
                                          <?php if ($key->CFVENDE =='10' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                                            <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                                              <tr>
                                                <td><?php echo $key->dfnumped ?></td>
                                                <td><?php echo $key->CFCODCLI ?></td>
                                                <td><?php echo $key->CFNOMBRE ?></td>
                                                <td><?php echo $key->DFCODIGO ?></td>
                                                <td><?php echo $key->dfdescri ?></td>
                                                <td><?php echo number_format($key->dfcantid) ?></td>
                                                <td><?php echo number_format($key->val_unit,2) ?></td>
                                                <td><?php echo number_format($key->total,2) ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                                              </tr>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                          <?php break;
                                          case "tiempocdv":?>
                                              <?php if ($key->CFVENDE =='07' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                                                <?php if (date('Y-m-d',strtotime($key->fec_ent))>=date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                                                  <tr>
                                                    <td><?php echo $key->dfnumped ?></td>
                                                    <td><?php echo $key->CFCODCLI ?></td>
                                                    <td><?php echo $key->CFNOMBRE ?></td>
                                                    <td><?php echo $key->DFCODIGO ?></td>
                                                    <td><?php echo $key->dfdescri ?></td>
                                                    <td><?php echo number_format($key->dfcantid) ?></td>
                                                    <td><?php echo number_format($key->val_unit,2) ?></td>
                                                    <td><?php echo number_format($key->total,2) ?></td>
                                                    <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                                                  </tr>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                              <?php break;
                                              case "retrasocdv":?>
                                                  <?php if ($key->CFVENDE =='07' and ($key->CFCODCLI!='20535689394' or $key->CFCODCLI!='20469962246' or $key->CFCODCLI!='1008206G1' or $key->CFCODCLI!='20600670949' or $key->CFCODCLI!='OD151012DG7')): ?>
                                                    <?php if (date('Y-m-d',strtotime($key->fec_ent))<date('Y-m-d',strtotime($key->fec_fact)) ): ?>
                                                      <tr>
                                                        <td><?php echo $key->dfnumped ?></td>
                                                        <td><?php echo $key->CFCODCLI ?></td>
                                                        <td><?php echo $key->CFNOMBRE ?></td>
                                                        <td><?php echo $key->DFCODIGO ?></td>
                                                        <td><?php echo $key->dfdescri ?></td>
                                                        <td><?php echo number_format($key->dfcantid) ?></td>
                                                        <td><?php echo number_format($key->val_unit,2) ?></td>
                                                        <td><?php echo number_format($key->total,2) ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($key->fec_fact)) ?></td>
                                                      </tr>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
        <?php break;?>
<?php } ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
