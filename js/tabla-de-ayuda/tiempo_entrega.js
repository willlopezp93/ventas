$(document).ready(function(){
	control_de_menu($('#menu_tiempo_entrega'));


  $('#nuevo_tiempo').on('click',function(e){

    $('#nueva_tiempo_entrega').modal('show');
    $('#idtiempo_entrega').val("");
    $('#tiempo_entrega').val("");

	});

	$('#form_tiempo_entrega').submit(function(e){
		e.preventDefault();

		$.post(baseurl+'Tablaayuda/save_tiempo',$(this).serialize(),function(data){
			if(data.substring(0,2)=='No'){
				alertify.error(data);
			}else{
				alertify.success(data);
				setTimeout(function(){window.location.href=baseurl+"Inicio/tiempo_entrega"},200);
			}

		});
	});

	$('.editar-tiempo_entrega').on('click',function(e){

		$('#idtiempo_entrega').val($(this).attr('data-id'));
		$('#tiempo_entrega').val($(this).attr('data-nombre'));
		$('#nueva_tiempo_entrega').modal('show');

	});

});
$(document).on('click','.eliminar',function(e){
var fila=$(this).parent().parent();
var id=$(this).attr('data-id') ;
alertify.confirm('Eliminar Tiempo de Entrega', '¿Desea eliminar Tiempo de Entrega?',
                   function(){
                     $.ajax({
                     url:baseurl+"Tablaayuda/eliminar_tiempo",
                     type:"post",
                     data:"id="+id,
                     success: function(info){
                            fila.hide();
                           alertify.success(info);
                         },
                     error: function (xhr, ajaxOptions, thrownError) {
                          alertify.error('Ocurrio un error');
                       }
                   });
                          },
                  function(){//cancela
                    alertify.error('Error');
                  });


});
