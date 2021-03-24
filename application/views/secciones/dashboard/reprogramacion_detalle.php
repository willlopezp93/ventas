

<div class="table table-responsive">
  <table class="table table-condense table-hover" id="table_detail">
    <thead>
      <tr>
        <th style="font-size:8pt">PEDIDO</th>
        <th style="font-size:8pt">RUC</th>
        <th style="font-size:8pt">R.SOCIAL</th>
        <th style="font-size:8pt">CÓDIGO</th>
        <th style="font-size:8pt">DESCRIPCIÓN</th>
        <th style="font-size:8pt">CANT</th>
        <th style="font-size:8pt">PRECIO</th>
        <th style="font-size:8pt">P.TOTAL</th>
        <th style="font-size:8pt">REPROGRAM</th>
        <th style="font-size:8pt">F.ENTREGA</th>
        <th style="font-size:8pt">F.ULTIMA</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($reprogramacion as $key): ?>
        <?php switch ($condicion) {
    case "tiempo":?>
      <?php if ($key['DFREPROGRAM']==0 ): ?>
        <tr>
          <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
          <td style="font-size:8pt"><?php echo $key['CFCODCLI'] ?></td>
          <td style="font-size:8pt"><?php echo $key['CFNOMBRE'] ?></td>
          <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
          <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
          <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
          <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
          <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
          <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
          <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
          <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
        </tr>
      <?php endif; ?>
      <?php  break;
    case "retraso":?>
    <?php if ($key['DFREPROGRAM']!=0): ?>
      <tr>
        <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
        <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
        <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
        <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
        <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
        <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
        <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
      </tr>
    <?php endif; ?>
      <?php break;
    case "tiempord":?>
        <?php if ($key['CFRUC']=='20469962246'): ?>
          <?php if ($key['DFREPROGRAM']==0): ?>
            <tr>
              <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
              <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
              <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
              <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
              <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
              <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
              <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
              <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
              <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
            </tr>
          <?php endif; ?>
        <?php endif; ?>
      <?php break;
      case "retrasord":?>
          <?php if ($key['CFRUC']=='20469962246'): ?>
            <?php if ($key['DFREPROGRAM']!=0): ?>
              <tr>
                <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                <td style="font-size:8pt"> <?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
              </tr>
            <?php endif; ?>
          <?php endif; ?>
          <?php break;
          case "tiempoov":?>
              <?php if ($key['CFRUC']=='20535689394'): ?>
                <?php if ($key['DFREPROGRAM']==0): ?>
                  <tr>
                    <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                    <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                    <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                    <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                    <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                    <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                    <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                    <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                    <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                  </tr>
                <?php endif; ?>
              <?php endif; ?>
              <?php break;
              case "retrasoov":?>
                  <?php if ($key['CFRUC']=='20535689394'): ?>
                    <?php if ($key['DFREPROGRAM']!=0): ?>
                      <tr>
                        <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                        <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                        <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                        <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                        <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                        <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                        <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php break;
                  case "tiempocd":?>
                      <?php if ($key['CFRUC']=='OD151012DG7'): ?>
                        <?php if ($key['DFREPROGRAM']==0): ?>
                          <tr>
                            <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                            <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                            <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                            <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                            <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                            <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                            <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                            <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                            <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                          </tr>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php break;
                      case "retrasocd":?>
                          <?php if ($key['CFRUC']=='OD151012DG7'): ?>
                            <?php if ($key['DFREPROGRAM']!=0): ?>
                              <tr>
                                <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                              </tr>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php break;
                          case "tiempogg":?>
                              <?php if ($key['CFVENDE'] =='08'): ?>
                                <?php if ($key['DFREPROGRAM']==0): ?>
                                  <tr>
                                    <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                    <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                    <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                    <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                    <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                    <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                    <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                    <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                    <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                                  </tr>
                                <?php endif; ?>
                              <?php endif; ?>
                              <?php break;
                              case "retrasogg":?>
                                  <?php if ($key['CFVENDE'] =='10'): ?>
                                    <?php if ($key['DFREPROGRAM']!=0): ?>
                                      <tr>
                                        <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                        <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                        <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                        <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                        <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                        <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                        <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                                      </tr>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                  <?php break;
                                  case "tiempofn":?>
                                      <?php if ($key['CFVENDE'] =='10'): ?>
                                        <?php if ($key['DFREPROGRAM']==0): ?>
                                          <tr>
                                            <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                            <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                            <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                            <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                            <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                            <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                            <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                            <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                            <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                                          </tr>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                      <?php break;
                                      case "retrasofn":?>
                                          <?php if ($key['CFVENDE'] =='10'): ?>
                                            <?php if ($key['DFREPROGRAM']!=0): ?>
                                              <tr>
                                                <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                                <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                                <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                                <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                                <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                                <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                                <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                                <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                                <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                                              </tr>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                          <?php break;
                                          case "tiempocdv":?>
                                              <?php if ($key['CFVENDE'] =='07'): ?>
                                                <?php if ($key['DFREPROGRAM']==0): ?>
                                                  <tr>
                                                    <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                                    <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                                    <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                                    <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                                    <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                                    <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                                    <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                                    <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                                    <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                                                  </tr>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                              <?php break;
                                              case "retrasocdv":?>
                                                  <?php if ($key['CFVENDE'] =='07'): ?>
                                                    <?php if ($key['DFREPROGRAM']!=0): ?>
                                                      <tr>
                                                        <td style="font-size:8pt"><?php echo $key['dfnumped'] ?></td>
                                                        <td style="font-size:8pt"><?php echo $key['DFCODIGO'] ?></td>
                                                        <td style="font-size:8pt"><?php echo $key['dfdescri'] ?></td>
                                                        <td style="font-size:8pt"><?php echo number_format($key['dfcantid']) ?></td>
                                                        <td style="font-size:8pt"><?php echo number_format($key['val_unit'],2) ?></td>
                                                        <td style="font-size:8pt"><?php echo number_format($key['total'],2) ?></td>
                                                        <td style="font-size:8pt"><?php echo $key['DFREPROGRAM'] ?></td>
                                                        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECENT'])) ?></td>
                                                        <td style="font-size:8pt"><?php echo date('d-m-Y',strtotime($key['DFFECREP'])) ?></td>
                                                      </tr>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
        <?php break;?>
<?php } ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
