$(document).ready(function(){
	control_de_menu($('#menu_envio_guia'));
	$.ajax({
		url:baseurl+"Ventas/get_guias",
		type:"post",
		dataType:"json",
		success:function(data){
			$.each(data,function(i,item){
					$('select[name=guias]').append('<option data-pedido="'+item.CANROPED+'" value="'+item.CANUMDOC+'">'+item.CANUMDOC+'</option>');
			});
			$('.select2').select2();
		}
	})
});
$(document).on('change','#guias',function(){
  var guia = $(this).val();
	$('#pedido').val($('#guias option:selected').attr('data-pedido'))
if (guia!='') {
  $.ajax({
    url:baseurl+"Ventas/get_guia_detalle",
    data:{guia:guia},
    type:"post",
    success:function(data){
      $('#div_detalle').html(data);
    }
  })
} else {
  $('#div_detalle').html('');

}
})

$(document).on('click','#notificar',function(){
	var formData = new FormData($("#form_file")[0]);
	$.ajax({
		url:baseurl+"Support/adjuntar_guia/",
		data:formData,
		contentType:false,
		processData:false,
		type:"post",
		success:function(data2){
			swal({
			 title: "Guia de Venta",
			 type:"success",
			 text: "¡¡Genial!! Se realizó el envio de la guía "+data2+"!!!",
			 timer: 2000,
			 showConfirmButton: false
			 });
			 //setTimeout("window.location.replace('"+baseurl+"Inicio/orden_venta')",2000);
		}
	});
})
