<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
        p{
          color: black;
          font-family: 'Lato', Helvetica, Arial, sans-serif;
          font-size: 12pt;
        }
        body{
          padding-left: 2pt;
          padding-right: 2pt;
        }
        table,th,td{
          border: 1px solid black;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <p>Reciba mis cordiales saludos.</p>
    <p>Agradeceré atender el presente pedido,</p>
    <p><b>Fecha de entrega : <?php echo date('d/m/Y',strtotime($fec_entrega)) ?></b> </p>
    <p><b>Turno : <?php echo $retval = ($turno==1) ? 'Mañana' : 'Tarde' ; ?></b> </p>
    <table border="0" cellpadding="0" cellspacing="0" >
      <thead>
        <tr>
            <td colspan="5" bgcolor="#0069d9" align="center" valign="top"  align="left" style="padding: 5px 5px 5px 5px; color: white; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;">
                <?php echo "PEDIDO #".$pedido ?>
            </td>
        </tr>
        <tr>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">CODIGO</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">DESC</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">CANT</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">RESPONSABLE</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">FEC.ENTREGA</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detalle as $key): ?>
          <tr <?php if ( $key->DFRESPONSABLE == 'compras') {
            echo "style='background-color:#EFFF6C'";
          }elseif ($key->DFRESPONSABLE =='planeamiento') {
            echo "style='background-color:#A9FF7B'";
          }elseif ($key->DFRESPONSABLE=='stock_07') {
            echo "style='background-color:#7BFFED'";
          }elseif ($key->DFRESPONSABLE=='') {
            echo "style='background-color:white'";
          }  ?>>
            <td  align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;">
              <b><?php echo $key->DFCODIGO ?></b>
            </td>
            <td  align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;">
              <b><?php echo $key->DFDESCRI ?></b>
            </td>
            <td align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">
              <b><?php echo number_format($key->DFCANTID) ?></b>
            </td>
            <td align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">
              <b><?php if ( $key->DFRESPONSABLE == 'compras') {
                echo "COMPRAS";
              }elseif ($key->DFRESPONSABLE =='planeamiento') {
                echo "PLANEAMIENTO";
              }elseif ($key->DFRESPONSABLE=='stock_07') {
                echo "STOCK 07";
              } elseif ($key->DFRESPONSABLE=='') {
                echo "ALMACEN";
              }  ?></b>
            </td>
            <td align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 9pt; font-weight: 200; line-height: 25px;text-align:center;">
              <b><?php echo date('d/m/Y',strtotime($key->DFFECENT)) ?></b>
            </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <p style="font-size:7pt"><b>Leyenda:</b> </p>
    <p style="font-size:7pt;background-color:white">ALMACEN</p>
    <p style="font-size:7pt;background-color:#EFFF6C">COMPRAS</p>
    <p style="font-size:7pt;background-color:#A9FF7B">PLANEAMIENTO</p>
    <p style="font-size:7pt;background-color:#7BFFED">STOCK 07</p>
    <br><br>
    <p>Lugar de entrega :
          <?php if ($cotizacion->CCTIPCOTIZA=='EXT'): ?>
              <?php echo "NUESTRO ALMACÉN" ?>
              <?php else: ?>
                <?php if ($cotizacion->CCIMPORTE>100): ?><?php echo "ALMACEN DEL CLIENTE" ?>
                <?php else: ?>
                  <?php echo "NUESTRO ALMACÉN" ?>
                <?php endif; ?>
            <?php endif; ?> </p>
    <p>Especificaciones de la direccion : <?php echo $INFO_DIR ?></p>
</body>
</html>
