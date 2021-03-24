<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema Integrado de gestion</title>

  <style media="screen">
  #piedepagina{
  /*  width:100%;*/
    border: 0px;
    bottom: 0 !important;
    bottom: 13 px;
/*position: absolute;*/
  }

      table {
      border-collapse: collapse;
      width: 100%;

    }

    .reqdet {
      border: 1px solid black;
      padding: 2px;
    }



    .cabecera{
      font-size: 9pt;
      border: 1px solid black;
      padding: 1px;
    }
    .detalle{
      font-size: 8pt;
      border: 1px solid black;

    }


/*    .firmas{
      width:100%;
text-align: center;
border-collapse: collapse;
border: 1px solid #000;
padding-top: 0px;
padding-left: 0px;

    }*/
    .imagenes{
      width:100%;
text-align: right;


padding-top: 0px;
padding-left: 0px;
    }
    .imagenes td{
      border: 0;
    }
  </style>

</head>
<body>


    <table class="tabla">
      <tr>
        <td class="reqdet" rowspan="3"><center><img src="<?php echo base_url() ?>assets/img/logo-grande.png" alt="" width='80px'></center></td>
        <td class="reqdet"><center><b>Sistema integrado de gestion</b></center></td>
        <td class="reqdet"><b>Código: RD.111.F.06</b></td>
      </tr>
      <tr>

        <td class="reqdet" rowspan="2"><center><b>REQUERIMIENTO DE MATERIALES - CTR</b></center></td>
        <td class="reqdet"><b>Version: 03</b></td>
      </tr>
      <tr>
        <td class="reqdet"><b>Fecha: 14-02-18</b></td>
      </tr>
    </table>

  <br>
  <div >
    <table class="cabecera">
      <tr>
        <td class="reqdet"  style="border: hidden;"><b></b></td>
        <td class="reqdet"  style="border: hidden;"><b></b></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>N°</b></td>
        <td class="reqdet"><?php echo str_pad($cabecera->req_correlativo, 7, "0", STR_PAD_LEFT) ?></td>
      </tr>
      <tr>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>CONTRATO (CTR)</b></td>
        <td class="reqdet"><?php echo $cabecera->nombre ?></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>FECHA</b></td>
        <td class="reqdet"><?php echo date('d-m-Y',strtotime($cabecera->fecha_doc)); ?></td>
      </tr>
      <tr>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>SOLICITADO POR </b></td>
        <td class="reqdet"> <?php echo $cabecera->fullname ?> </td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><b>CARGO</b></td>
        <td class="reqdet"><?php echo $cabecera->cargo ?></td>
      </tr>
    </table>
  </div>
    <br>
  <div >
    <table class="detalle">
      <tr>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>ITEM</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>CODIGO</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>DESCRIPCION</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>UNIDAD DE MEDIDA</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>CANTIDAD</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>PRIORIDAD</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>DESTINO</b></center></td>
        <td class="reqdet" style="background:#05216B;color:#FFFFFF;font-family: Georgia "><center><b>OBSERVACIONES</b></center></td>

      </tr>
        <?php foreach ($detalles as $key): ?>
            <tr <?php if ($key->canceled=='y'): ?>
              style="display:none;"
            <?php endif; ?>>
              <td class="reqdet"><?php echo $key->item_num ?></td>
              <td class="reqdet"><?php echo $key->itemcodigo ?></td>
              <td class="reqdet"><?php echo $key->itemdesc ?></td>
              <td class="reqdet"><?php echo $key->itemunidad ?></td>
              <td class="reqdet"><?php echo $key->cant_req ?></td>
              <td class="reqdet"><?php echo $key->prioridad ?></td>
              <td class="reqdet"><?php echo $key->descripcion ?></td>
              <td class="reqdet"><?php echo $key->observaciones ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table style="border:0;">
      <?php  for ($i=0;$i<=8;$i++){?>
      <tr>
        <td  style="border:0; font-size: 9pt;" ></td>
      </tr>
    <?php } ?>
    </table>

  <table style="border: hidden;">
    <tr class="imagenes">
    <td style="text-align:center; font-size: 9pt;">
      <?php if ($firmas->firma_logctr!=''): ?>
          <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_logctr ?>.jpg" alt="" width='90px' height="50px"><br>
          <label style="text-decoration: overline; ">ASISTENTE LOG/ADM DE CTR </label><br><?php echo $firmas->nombre_logctr ?></center>
      <?php endif; ?>

      </td>
    <td style="text-align:center; font-size: 9pt;">
      <?php if ($firmas->firma_ssoma!=''): ?>
        <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_ssoma ?>.jpg" alt="" width='90px' height="50px"> <br>
        <label style="text-decoration: overline; ">SEGURIDAD CTR</label> <br><?php echo $firmas->nombre_ssoma ?></center>

      <?php endif; ?>

      </td>
    <td style="text-align:center; font-size: 9pt;">
      <?php if ($firmas->firma_mantto!=''): ?>
        <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_mantto ?>.jpg" alt="" width='90px' height="50px"> <br>
        <label style="text-decoration: overline; ">MANTENIMIENTO CTR</label> <br><?php echo $firmas->nombre_mantto ?></center>

      <?php endif; ?>

    </td>
    </tr>
</table>
<br>
  <table style="border: hidden;">
    <tr class="imagenes">
    <td style="text-align:center; font-size: 9pt;">
      <?php if ($firmas->firma_operaciones!=''): ?>
        <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_operaciones ?>.jpg" alt="" width='90px' height="50px"> <br>
        <label style="text-decoration: overline; ">OPERACIONES CTR</label> <br><?php echo $firmas->nombre_operaciones ?></center>

      <?php endif; ?>
      </td>
    <td style="text-align:center; font-size: 9pt;">
      <?php if ($firmas->firma_residente!=''): ?>
        <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_residente ?>.jpg" alt="" width='90px' height="50px"> <br>
        <label style="text-decoration: overline; ">RESIDENTE/JEFE DE CTR </label><br><?php echo $firmas->nombre_residente ?></center>

      <?php endif; ?>

      </td>
    <td style="text-align:center; font-size: 9pt;">
      <?php if ($firmas->firma_adm!=''): ?>
        <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_adm ?>.jpg" alt="" width='90px' height="50px"> <br>
        <label style="text-decoration: overline; ">ADMINISTRACION CTR</label> <br><?php echo $firmas->nombre_adm  ?></center>

      <?php endif; ?>

    </td>
    </tr>
</table>
<br>
<table style="border: hidden;">
<tr class="imagenes">
<td style="text-align:center; font-size: 9pt;">
    <?php if ($firmas->firma_responsable!=''): ?>
      <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_responsable ?>.jpg" alt="" width='90px' height="50px"> <br>
      <label style="text-decoration: overline; "><?php echo $firmas->nombre_responsable ?> </label></center>

    <?php endif; ?>
  </td>
<td style="text-align:center; font-size: 9pt;">
    <?php if ($firmas->firma_gerencia!=''): ?>
      <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_gerencia?>.jpg" alt="" width='90px' height="50px"><br>
      <label style="text-decoration: overline; "><?php echo $firmas->nombre_gerencia ?> </label></center>

    <?php endif; ?>
  </td>
<td style="text-align:center; font-size: 9pt;">
  <?php if ($firmas->firma_jefelog!=''): ?>
    <center><img src="<?php echo base_url() ?>assets/img/firmas/<?php echo $firmas->firma_jefelog ?>.jpg" alt="" width='90px' height="50px"><br>
    <label style="text-decoration: overline; "> <?php echo $firmas->nombre_jefelog ?></label></center>

  <?php endif; ?>

</td>
</tr>



  </table>

  </div>
</body>
</html>
<script type="text/javascript">
  $(document).ready
</script>
