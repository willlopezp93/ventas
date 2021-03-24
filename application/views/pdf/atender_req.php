
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Despacho de Requerimiento de Materiales ; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/logo-grande.png">
<link rel="stylesheet">

<style>
th,td
{
	border: 1px solid black;
	padding: 2px;

}
table
{
	border-collapse: collapse;
	width: 100%;


}
.cabecera{
	font-size: 10pt;
}
.center
{
   text-align: center;
}

.caja-center
{
   text-align: center;
}
</style>


</head>
<body>
<div class="container-fluid">
	<div class="cabecera">
    <table class="tabla">
      <tr>
        <td rowspan="3" colspan="2"><center><img src="<?php echo base_url() ?>assets/img/logo-grande.png" alt="" width='80'></center></td>



        <td rowspan="3" ><center><b>DESPACHO - 029 | REQUERIMIENTO DE MATERIALES # <?php echo str_pad($cabecera->req_correlativo, 7, "0", STR_PAD_LEFT); ?></b></center></td>

</tr>

    </table>
  </div>


<div class="row">
<div class="col-md-12">
<table class="table table-bordered table-condensed">
<thead>

<tr >
<th  colspan="2">FECHA DE DESPACHO:</th>
<td colspan="2"><?php echo $cabecera->fecha_doc ?></td>
<th colspan="2">USUARIO:</th>
<td colspan="2"><?php echo $cabecera->usuario ?></td>
</tr>
<tr >
<th  colspan="2">CONTRATO:</th>
<td colspan="2"><?php echo $cabecera->nombre ?></td>
<th colspan="2">AREA:</th>
<td colspan="2"><?php echo $cabecera->nom_area ?></td>
</tr>


</thead>
<tbody>
<tr>

</tr>
</tbody>
</table>
</div>
</div>


<div class="row">
<div class="col-md-12">
<table class="table table-bordered table-condensed">
<thead>
<tr class="active">
  <td><center><b>ITEM</b></center></td>
  <td><center><b>CODIGO</b></center></td>
  <td><center><b>DESCRIPCION</b></center></td>
  <td><center><b>UNIDAD DE MEDIDA</b></center></td>
  <td><center><b>CANTIDAD</b></center></td>
  <td><center><b>PRIORIDAD</b></center></td>
  <td><center><b>DESTINO</b></center></td>
  <td><center><b>OBSERVACIONES</b></center></td>
</tr>
</thead>



<tbody>
<?php $item=1;
foreach ($detalle as $key): ?>
	<tr>
		<td><center><?php echo $item;?> </center></td>
		<td><center><?php echo $key->itemcodigo?></center></td>
		<td><center><?php echo $key->itemdesc?></center></td>
		<td><center><?php echo $key->itemunidad?></center></td>
		<td><center><?php echo $key->itemcant?></center></td>
		<td><center><?php echo $key->itemprioridad?></center></td>
		<td><center><?php echo $key->itemmaquina?></center></td>
		<td><center><?php echo $key->itemobserv?></center></td>

	</tr>

<?php $item++;

endforeach; ?>
</tbody>
</table>
</div>
</div>

<p><b>Nota: </b> Dirigirse al Sistema Starsoft Gold Edition y generar la Nota de Salida con la información de la presente plantilla</p>

</div>
</body>
</html>
