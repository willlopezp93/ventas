$(document).ready(function(){
	control_de_menu($('#menu_costo'));

});

$(document).on('click','#buscar',function(e){
    var tipo=$('#tipo').val();
    var cadena=$('#cadena').val();
    $.post(baseurl+"Articulo/costos",{tipo:tipo,cadena:cadena},function(data){
      $('#tbl_maestro_articulos').html(data);
    });
});


$(document).on('click','.editar',function(e){
	var codigo=$(this).attr('data-id');
	var fila=$(this).parent().parent();
	var descripcion=fila.find('td').eq(2).html();
	$('.modal-title').html('<strong>Artículo: '+codigo+' - '+descripcion+'</strong>');
	$('#costo').val(fila.find('td').eq(3).html());
	$('#editar_articulo').modal('show');
	$('#articuloid').val(codigo);
});

$(document).on('click','#grabar',function(e){
if ($('#motivo').val()=='') {
	alert("Se necesita que registre el motivo")
} else {
	$.ajax({
		url:baseurl+"Articulo/savecosto",
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
}
});
