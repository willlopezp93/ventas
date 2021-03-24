$(document).ready(function(){
	control_de_menu($('#menu_centro_costo'));

});/*
$(document).on('click','#listar',function(e){
	var familia=$('#familia').val();
	$.post(baseurl+'Articulo/listarcc',{familia:familia},function(data){
    $('#tbl_maestro_articulos').html(data);
    $('table').DataTable();
  });
});*/

$(document).on('click','#buscar',function(e){
    var tipo=$('#tipo').val();
    var cadena=$('#cadena').val();
    $.post(baseurl+"Articulo/listarcc",{tipo:tipo,cadena:cadena},function(data){
      $('#tbl_maestro_articulos').html(data);
    });
});

$(document).on('click','.editar',function(e){
	var codigo=$(this).attr('data-id');
	var fila=$(this).parent().parent();
	var descripcion=fila.find('td').eq(2).html();
	$('.modal-title').html('<strong>Artículo: '+codigo+' - '+descripcion+'</strong>');
	$('#centrocosto').val(fila.find('td').eq(3).html());
	$('#editar_articulo').modal('show');
	$('#articuloid').val(codigo);
});

$(document).on('click','#grabar',function(e){
	$.ajax({
		url:baseurl+"Articulo/savecc",
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
