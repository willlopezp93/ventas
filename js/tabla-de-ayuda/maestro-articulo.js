$(document).ready(function(){
	control_de_menu($('#menu_maestro_articulo'));

});
/*
$(document).on('click','#listar',function(e){
	var familia=$('#familia').val();
	$.post(baseurl+'Articulo/get',{familia:familia},function(data){
    $('#tbl_maestro_articulos').html(data);
    $('table').DataTable();
  });
});
*/
$(document).on('click','#buscar',function(e){
    var tipo=$('#tipo').val();
    var cadena=$('#cadena').val();
    $.post(baseurl+"Articulo/get",{tipo:tipo,cadena:cadena},function(data){
      $('#tbl_maestro_articulos').html(data);
    });
});


$(document).on('click','.editar',function(e){
	var codigo=$(this).attr('data-id');
	var fila=$(this).parent().parent();
	var descripcion=fila.find('td').eq(8).html();
	$('.modal-title').html('<strong>Artículo: '+codigo+' - '+descripcion+'</strong>');
	$('#num_parte').val(fila.find('td').eq(3).html());
	$('#cod_rockdrill').val(fila.find('td').eq(2).html());
	$('#cod_cliente1').val(fila.find('td').eq(4).html());
	$('#cod_cliente2').val(fila.find('td').eq(5).html());
	$('#cod_cliente3').val(fila.find('td').eq(6).html());
	$('#cod_cliente4').val(fila.find('td').eq(7).html());
	$('#descripcion').val(fila.find('td').eq(8).html());
	$('#unidad_med').val(fila.find('td').eq(10).html());
	$('#editar_articulo').modal('show');
	$('#articuloid').val(codigo);
});

$(document).on('click','#grabar',function(e){
	$.ajax({
		url:baseurl+"Articulo/save",
		type:"post",
		data:$('#form_editar').serialize(),
		beforeSend:function(){
			$('#msg').html('<div><h3>Registrando...</h3></div>');
			$('#grabar').prop('disabled',true);
		},
		success: function(data){
			  $('#msg').html('<div class="callout callout-success"><h4>Registro correcto!</h4></div>');
			location.reload();
		},
		error: function (xhr, ajaxOptions, thrownError) {
				$('#msg').html('<div class="callout callout-danger"><h4>'+thrownError+'!</h4><p>Verifique que exista el código.</p> </div>');

			}
	});
});

function prueba(){
	$.ajax({
		url:baseurl+"Articulo/get",
		type:"post",
		success:function(data){
			alert(data)
		}

	});
}
/*
function cargarficha(codigo){
	$('.modal-title').html('Ficha técnica: <strong>'+codigo+'</strong>');
	$.ajax({
		url:baseurl+"Articulo/fichatecnica",
		type:"post",
		data:{
			codigo:codigo
		},
		success:function(data){
			$('#txtFicha').val(data);
		}
	});
	$('#fichatecnica').modal('show');
}
*/
