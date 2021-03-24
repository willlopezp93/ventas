<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema Integrado de gestion</title>

  <style media="screen">
  #piedepagina{
    width:100%;
    border: 0px;
    bottom: 0 !important;
bottom: 13 px;
/*position: absolute;*/
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
text-align: center;
border-collapse: collapse;
border: 1px solid #000;
padding-top: 0px;
padding-left: 0px;

    }
    .imagenes{
      width:100%;
text-align: right;
margin-top: 50px;

padding-top: 0px;
padding-left: 0px;
    }
    .imagenes td{
      border: 0;
    }
  </style>

</head>
<body>

  <div class="cabecera">
    <table class="tabla">
      <tr>
        <td rowspan="3"><center><img src="<?php echo base_url() ?>assets/img/logo-grande.png" alt="" width='80px'></center></td>
        <td><center><b>Sistema integrado de gestion</b></center></td>
        <td><b>Código: RD.111.F.06</b></td>
      </tr>
      <tr>

        <td rowspan="2"><center><b>REQUERIMIENTO DE MATERIALES - CTR</b></center></td>
        <td><b>Version: 03</b></td>
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
        <td  style="border: hidden;"><b></b></td>
        <td  style="border: hidden;"><b></b></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>N°</b></td>
        <td><?php echo str_pad($cabecera->req_correlativo, 7, "0", STR_PAD_LEFT) ?></td>
      </tr>
      <tr>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>CONTRATO (CTR)</b></td>
        <td><?php echo $cabecera->nombre ?></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>FECHA</b></td>
        <td><?php echo date('d-m-Y',strtotime($cabecera->fecha_doc)); ?></td>
      </tr>
      <tr>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>SOLICITADO POR </b></td>
        <td> <?php echo $cabecera->fullname ?> </td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>CARGO</b></td>
        <td><?php echo $cabecera->cargo ?></td>
      </tr>
    </table>
  </div>
    <br>
  <div >
    <table class="detalle">
      <tr>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>ITEM</b></center></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>CODIGO</b></center></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>PRODUCTO</b></center></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>SERIE</b></center></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>GUIA DE INGRESO</b></center></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>FECHA DE INGRESO</b></center></td>
        <td style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>OBSERVACIONES</b></center></td>

      </tr>
        <?php
        $item=1;
         foreach ($detalles as $key): ?>

            <tr>
              <td><?php echo $item++ ?></td>
              <td><?php echo $key->itemcodigo ?></td>
              <td><?php echo $key->descripcion ?></td>
              <td><?php echo $key->seriearticulo ?></td>
              <td><?php echo $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
              <td><?php echo date('d-m-Y',strtotime($key->fecha_creacion)) ?></td>
              <td><?php echo $key->observaciones ?></td>

            </tr>
        <?php endforeach; ?>



    </table>
    <table style="border:0;">
      <?php  for ($i=0;$i<=1;$i++){?>
      <tr>
        <td style="height:10px; border:0;" ></td>
      </tr>
    <?php } ?>
    </table>
    <div  id="piedepagina" >
  <table style="border: hidden;">
    <tr class="imagenes">
    <td style="text-align:center">
      <?php if ($firmas->firma_logctr!=''): ?>
          <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_logctr ?>.jpg" alt="" width='90px'>
      <?php endif; ?>

      </td>
    <td style="text-align:center">
      <?php if ($firmas->firma_ssoma!=''): ?>
          <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_ssoma ?>.jpg" alt="" width='90px'>
      <?php endif; ?>

      </td>
    <td style="text-align:center">
      <?php if ($firmas->firma_mantto!=''): ?>
          <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_mantto ?>.jpg" alt="" width='90px'>
      <?php endif; ?>

    </td>
    </tr>
    <tr class="firmas"  >
      <?php if ($firmas->firma_logctr!=''): ?>
        <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center">ASISTENTE LOG/ADM DE CTR <br><br><br><br><br> </td>
      <?php endif; ?>

      <?php if ($firmas->firma_ssoma!=''): ?>
        <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center">SEGURIDAD CTR <br><br><br><br></td>
      <?php endif; ?>
      <?php if ($firmas->firma_mantto!=''): ?>
        <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center">MANTENIMIENTO CTR <br><br><br><br></td>
      <?php endif; ?>


</tr>


    <tr class="imagenes">
    <td style="text-align:center">
      <?php if ($firmas->firma_operaciones!=''): ?>
          <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_operaciones ?>.jpg" alt="" width='90px'>
      <?php endif; ?>
      </td>
    <td style="text-align:center">
      <?php if ($firmas->firma_residente!=''): ?>
          <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_residente ?>.jpg" alt="" width='90px'>
      <?php endif; ?>

      </td>
    <td style="text-align:center">
      <?php if ($firmas->firma_adm!=''): ?>
          <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_adm ?>.jpg" alt="" width='90px'>
      <?php endif; ?>

    </td>
    </tr>
    <tr class="firmas"  >
      <?php if ($firmas->firma_operaciones!=''): ?>
        <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center">OPERACIONES CTR <br> <br><br><br></td>
      <?php endif; ?>
      <?php if ($firmas->firma_residente!=''): ?>
        <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center">RESIDENTE/JEFE DE CTR <br><br><br><br><br></td>
      <?php endif; ?>
      <?php if ($firmas->firma_adm!=''): ?>
        <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center">ADMINISTRACION CTR<br><br><br><br><br></td>
      <?php endif; ?>
    </tr>


<tr class="imagenes">
<td style="text-align:center">
    <?php if ($firmas->firma_responsable!=''): ?>
      <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_responsable ?>.jpg" alt="" width='90px'>
    <?php endif; ?>
  </td>
<td style="text-align:center">
    <?php if ($firmas->firma_gerencia!=''): ?>
      <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_gerencia?>.jpg" alt="" width='90px'>
    <?php endif; ?>
  </td>
<td style="text-align:center">
  <?php if ($firmas->firma_jefelog!=''): ?>
        <img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_jefelog ?>.jpg" alt="" width='90px'>
  <?php endif; ?>

</td>
</tr>
<tr class="firmas"  >
  <?php if ($firmas->firma_responsable!=''): ?>
  <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center"><?php echo $firmas->nombre_responsable ?> <br><br><br><br><br> </td>
  <?php endif; ?>
  <?php if ($firmas->firma_gerencia!=''): ?>
    <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center"><?php echo $firmas->nombre_gerencia ?><br><br><br><br><br></td>
  <?php endif; ?>
  <?php if ($firmas->firma_gerencia!=''): ?>
  <td style="border: hidden;font-size: 12px; text-decoration: overline; text-align:center"><?php echo $firmas->nombre_jefelog ?><br><br><br><br><br></td>
  <?php endif; ?>

</tr>



  </table>
    </div>
  </div>
</body>
</html>
<script type="text/javascript">
  $(document).ready
</script>
