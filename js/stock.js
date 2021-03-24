
$(document).ready(function(){
	control_de_menu($('#stock'));

});

$(document).on('change','#almacen',function(e){
	let almacen=$('#almacen').val();
	$.ajax({
	url:baseurl+"Tablaayuda/stock",
	type:"post",
	data:"almacen="+almacen,
	beforeSend: function(){
				$('#msg').show();
		$('#msg').html('<center><img src="'+baseurl+'/assets/img/carga.gif" height="2%" width="2%"><h6>Espere por favor...</h6> </center><br> ');

	},
	success: function(info){
		$('#msg').hide();
		$('#tbl_stock').html(info);
		$('table').DataTable({
			"order": [['0','desc']]
		});

			},
	error: function (xhr, ajaxOptions, thrownError) {
			 alertify.error('Ocurrio un error');
		}
});
});
