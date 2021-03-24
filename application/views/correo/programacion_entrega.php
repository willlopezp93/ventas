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

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
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
          font-size: 10pt;
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
    <p>Se informa las fechas de entrega de los productos de los siguientes pedidos</p>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <thead>
        <tr>
            <td colspan="5" bgcolor="#0069d9" align="center"valign="top"  align="left" style="padding: 5px 5px 5px 5px; color: white; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">
                <?php echo "PEDIDOS" ?>
            </td>
        </tr>
        <tr>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">CODIGO</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">DESC</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">CANT</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">FEC.ENTREGA</th>
          <th bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">TURNO</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detalle as $key): ?>
          <tr>
            <td bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">
              <b><?php echo $key->DFCODIGO ?></b>
            </td>
            <td bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">
              <b><?php echo $key->DFDESCRI ?></b>
            </td>
            <td bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">
              <b><?php echo number_format($key->DFCANTID) ?></b>
            </td>
            <td bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">
              <b><?php echo date('d/m/Y',strtotime($key->DFFECENT)) ?></b>
            </td>
            <td bgcolor="#ffffff" align="left" style="padding: 5px 5px 5px 5px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 10pt; font-weight: 200; line-height: 25px;">
              <b><?php switch ($key->DFTURNO) {
                case 'mañana':
                  echo "Mañana";
                  break;
                  case 'tarde':
                    echo "Tarde";
                    break;
                default:
                  // code...
                  break;
              } ?></b>
            </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <br><br>
</body>
</html>
