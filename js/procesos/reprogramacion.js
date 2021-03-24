$(document).ready(function(){
	control_de_menu($('#menu_reprogramacion'));
	$('#tbl_cotizaciones').DataTable({
        "order": [[ 1, "desc" ]]
    } );
});
$(document).on('click','.reprogramar_detalle',function(){
  var id=$(this).attr('data-id');
  $('#pedido').val(id);
	$('.modal-title').html('<h3>Pedido N° '+id+'</h3>');
	$.ajax({
		url:baseurl+"Ventas/get_programacion_det",
		type:"post",
		data:"id="+id,
		beforeSend:function(){
			$('#form_pedido').html('<h3>Cargando...</h3>');
		},
		success: function(data){
			$('#form_pedido').html(data);

		},
		error: function (xhr, ajaxOptions, thrownError) {

				 alertify.error('Ocurrio un error');
			}
	});

})
$(document).on('click','.ver_detalle',function(){
  var id=$(this).attr('data-id');
  $('#pedido_det').val(id);
	$('.modal-title').html('<h3>Pedido N° '+id+'</h3>');
	$.ajax({
		url:baseurl+"Ventas/get_pedido_det",
		type:"post",
		data:"id="+id,
		beforeSend:function(){
			$('#form_pedido').html('<h3>Cargando...</h3>');
		},
		success: function(data){
			$('#form_pedido_det').html(data);

		},
		error: function (xhr, ajaxOptions, thrownError) {

				 alertify.error('Ocurrio un error');
			}
	});

})
$(document).on('change','.editable',function(){
  var cantidad=$(this).val();
  var fecha=$('#fecha').val();
  var fila=$(this).parent().parent();
  var tiptiempo=fila.find('.dias').val();

  var numero=cantidad*tiptiempo
    if (numero<=0) {
      fila.find('td').eq(6).html(fecha);
    }else {
      $.ajax({
        url:baseurl+"Support/dia_entrega",
        type:"post",
        data:"fecha="+fecha+"&dias="+numero,
        success: function(data){
          fila.find('td').eq(6).html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
             alertify.error('Ocurrio un error');
          }
      });
  }

});
$(document).on('change','.editable',function(){
	  var fecha=$('#fecha').val();
	var cantidad=$(this).val();
	if (cantidad<0) {

		$(this).val(0);

	}
	});
$(document).on('change','.dias',function(){
  var cantidad=$(this).val();
  var fecha=$('#fecha').val();
  var fila=$(this).parent().parent();
  var tiptiempo=fila.find('.editable').val();

  var numero=cantidad*tiptiempo

  if (numero==0) {
    fila.find('td').eq(6).html(fecha);
  }else {
    $.ajax({
      url:baseurl+"Support/dia_entrega",
      type:"post",
      data:"fecha="+fecha+"&dias="+numero,
      success: function(data){
        fila.find('td').eq(6).html(data);
      },
      error: function (xhr, ajaxOptions, thrownError) {
           alertify.error('Ocurrio un error');
        }
    });
  }
});

$(document).on('click','#reprogramar',function(e){
  alertify.confirm('Mensaje de confirmación',
                  '¿Está seguro de generar la orden de venta?',
                  function(){
                    var json="";
                    var json_total="";
                            $("#tbl_detalle tbody tr").each(function () {
                              json ="";
                              $(this).find("td").each(function () {
                                    $this=$(this);
																			if($this.attr("class")=='DFSECUEN' || $this.attr("class")=='DFCODIGO' || $this.attr("class")=='DFDESCRI' || $this.attr("class")=='DFCANTID' || $this.attr("class")=='DFUNIDAD' || $this.attr("class")=="DFFECENT" || $this.attr("class")=="FECHAREF" || $this.attr("class")=="DFREPROGRAM"){
																				json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
																			}else if ($this.attr("class")=="DFPLAZO") {
																				json=json+',"'+$this.attr("class")+'":"'+$this.find(".editable").val()+'"';
																				json=json+',"DFTIPTIME":"'+$this.find(".dias").val()+'"';
																			}
                              });
                              obj=JSON.parse('{'+json.substr(1)+'}');
                              json_total=json_total+','+JSON.stringify(obj);
                          });
                    var array_json=JSON.parse('['+json_total.substr(1)+']');
                    $.ajax({
                      url:baseurl+"Ventas/reprogramar",
                      type:"post",
                      data:$('#form_detalle').serialize()+"&tbldetalle=" + JSON.stringify(array_json),
                        dataType:'json',
                      beforeSend:function(){

                      },
                      success: function(data){
            	           if(data==0){
                        	$('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p></p> </div>');
                        	console.log(data);
												}else {
                          swal({
                   title: "Reprogramacion de Pedido de Venta",
                     type:"success",
                       text: "¡¡Genial!! La reprogramación se realizó con éxito !!!",
                         timer: 3000,
                           showConfirmButton: false
                           });
                           setTimeout("window.location.replace('"+baseurl+"Inicio/consultar_pedido')",3000);

												}
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                        alertify.error('Ocurrio un Error');
															}

                    });
                  }
                  ,function(){alertify.error('Se canceló la generacion de pedido')
                    });
});
