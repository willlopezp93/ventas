<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema Integrado de gestion</title>

  <style media="screen">
  #piedepagina{
    width:850px;
    border: 0px;
    bottom: 0 !important;
bottom: 15 px;
position: absolute;
  }

      table {
      border-collapse: collapse;
      width: 100%;
    }

    table, th, td {
      border: 1px solid black;
      padding: 2px;
    }



    .cabecera{
      font-size: 10pt;
    }
    .detalle{
      font-size: 9pt;

    }


    .firmas{
      width:100%;
text-align: left;
border-collapse: collapse;
border: 1px solid #000;
padding-top: 5px;
padding-left: 40px;
    }

  </style>

</head>
<body>

  <div class="cabecera">
    <table class="tabla">
      <tr>
        <td rowspan="3"><center><img src="<?php echo base_url() ?>assets/img/logo-grande.png" alt="" width='80px'></center></td>
        <td><center><b>Sistema integrado de gestion</b></center></td>
        <td><b>Código: RD.111.F.01</b></td>
      </tr>
      <tr>

        <td rowspan="2"><center><b>NOTA DE SALIDA DE MATERIALES</b></center></td>
        <td><b>Version: 00</b></td>
      </tr>
      <tr>
        <td><b>Fecha: 14-02-18</b></td>
      </tr>
    </table>
  </div>
  <br>
  <div >
    <table class="cabecera">
      <tr>
        <td><b>ALMACEN</b></td>
        <td><?php echo $cabecera->almacen ?></td>
        <td><b>#NOTA DE SALIDA</b></td>
        <td><?php echo $cabecera->n_salida ?></td>
      </tr>
      <tr>
        <td><b>FECHA DOC</b></td>
        <td><?php echo $cabecera->fecha_doc ?></td>
        <td><b>TRANSACCION</b></td>
        <td><?php echo $cabecera->transaccion ?></td>
      </tr>
      <tr>
        <td><b>CLIENTE</b></td>
        <td><?php echo $cabecera->cliente ?></td>
        <td><b>RUC</b></td>
        <td><?php echo $cabecera->ruc ?></td>
      </tr>
      <tr>
        <td><b>USUARIO</b></td>
        <td><?php echo $cabecera->usuario ?></td>
        <td><b>DNI</b></td>
        <td><?php echo $cabecera->dni ?></td>
      </tr>
      <tr>
        <td><b>COMENTARIO</b></td>
        <td><?php echo $cabecera->comentario ?></td>
        <td><b>#DOC. REF.</b></td>
        <td><?php echo $cabecera->doc_ref ?></td>
      </tr>
    </table>
  </div>
    <br>
  <div >
    <table class="detalle">
      <tr>
        <td><center><b>ITEM</b></center></td>
        <td><center><b>CODIGO</b></center></td>
        <td><center><b>DESCRIPCION</b></center></td>
        <td><center><b>UNIDAD</b></center></td>
        <td><center><b>SERIE</b></center></td>
        <td><center><b>CANTIDAD</b></center></td>
        <td><center><b>MAQUINA DESTINO</b></center></td>
        <td><center><b>SOLICITANTE</b></center></td>
        <td><center><b>N° DE GUIA</b></center></td>
      </tr>
      <?php foreach ($detalles as $key): ?>
        <tr>
          <td><?php echo $key->item ?></td>
          <td><?php echo $key->codigo ?></td>
          <td><?php echo utf8_decode($key->descripcion) ?></td>
          <td><?php echo $key->unidad ?></td>
          <td><?php echo ($key->seriearticulo=='NULL')?'':$key->seriearticulo ?></td>
          <td><?php echo $key->cantidad ?></td>
          <td><?php echo $key->maquina ?></td>
          <td><?php echo $key->nombre?></td>
          <td><?php echo $key->guia ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <div  id="piedepagina" >
  <table style="border: hidden;">
    <tr class="firmas"  >
<td style="border: hidden;font-size: 14px; text-decoration: overline; text-align:right">Asistenete Logístico ctr</td>
<td style="border: hidden;font-size: 14px; text-decoration: overline; text-align:right">Residente / administrador ctr</td>
<td style="border: hidden;font-size: 14px; text-decoration: overline; text-align:right">Jefe / coordinador de logistica </td>
</tr>
  </table>
    </div>
  </div>
</body>
</html>
