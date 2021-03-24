$(document).ready(function(){
	control_de_menu($('#menu_orden_venta'));
	$('#tbl_cotizaciones').DataTable({
        "order": [[ 1, "desc" ]]
    } );


});


$(document).on('change','.ccnew',function(){
	var cc=$(this).val();
	var string=cc.replace(/[-+()\s]/g, '');
	var cotizacion=$('#cotizacion').val();
	var fila=$(this).parent().parent();
	var item=fila.find('td').eq(0).html();
	$(this).val(string);

$.ajax({
	url:baseurl+"Ventas/centrocosto_cotizacion",
	type:"post",
	data:'cotizacion='+cotizacion+"&item="+item+"&cc="+cc,
	success:function(data){
			$(this).val('');
			if (data=='') {

				fila.css('background-color','#F06060')
			}else {

				fila.css('background-color','white')
			}
	}
});

});
function revisar(){
		contador =1
	$('#info_detalle tr').each(function() {
				if (contador>18) {
				var fila=$(this);
				fila.attr("class","danger")
				fila.find('.estado').html(0);
				fila.find('.activar').show();
				fila.find('.newcant').attr("readonly","readonly");
					fila.find('.editable').attr("readonly","readonly");
				fila.find('.desactivar').hide();
			}else {
				var fila=$(this);
				fila.find('.estado').html(1);
				fila.find('.desactivar').show();
					fila.removeAttr("class","danger")
					fila.find('.newcant').removeAttr("readonly");
					fila.find('.editable').removeAttr("readonly");
				fila.find('.activar').hide();

			}
			contador = contador + 1;
	});
	cont = 0;
	$('.estado').each(function() {
			cont += Number($(this).html());
	});
		console.log(cont)
	if (cont>18) {
		$('#crear_pedido').prop('disabled',true);
		$('#msg_header').html('<div class="callout callout-warning" id="msg_header"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
		$('#msg').html('<div class="callout callout-warning" id="msg_header"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
	}else {
		$('#crear_pedido').prop('disabled',false);
		$('#msg_header').html('');
		$('#msg').html('');
	}

	suma_total();
}

$(document).on('click','#ver_stock',function(){
	$('#tbl_pedido').hide();
	$('#div_adjunto').hide();
	$('#div_stock').show();
})

$(document).on('click','#ver_pedido',function(){
	$('#tbl_pedido').show();
	$('#div_adjunto').show();
	$('#div_stock').hide();
})

$(document).on('click','.ver_detalle',function(){
  var id=$(this).attr('data-id');
  $('#cotizacion').val(id);
	$('.modal-title').html('<strong>Cotización: '+pad(id,7)+'</strong>');

	$.ajax({
		url:baseurl+"Ventas/get_correlativo_pedido",
		type:"post",
		success:function(num){
		$('#num_pedido').text('Pedido: N° '+pad(num,7));
		}
	});
	$.ajax({
		url:baseurl+"Ventas/atender_cotizacion_test/",
		type:"post",
		data:"id="+id,
		beforeSend:function(){
			$('#form_pedido').html('<h3>Cargando...</h3>');
			$('#crear_pedido').prop('disabled',true);
			$('#div_adjunto').hide();//cambio_nuevo
		},
		success: function(data){
			$('#form_pedido').html(data);
			$('#div_adjunto').show(); //cambio_nuevo
			if ($("#info_detalle tr").length>18) {
				$('#crear_pedido').prop('disabled',true);
				$('#msg_header').html('<div class="callout callout-warning" id="msg_header"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
				$('#msg').html('<div class="callout callout-warning" id="msg_header"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
			}else {
				$('#crear_pedido').prop('disabled',false);
				$('#msg_header').html('');
				$('#msg').html('');
			}
			revisar();
					let fecha=$('#fecha_orden').val();
				$.ajax({
					url:baseurl+"Tablaayuda/tipodecambio",
					data:'fecha='+fecha,
					type:"post",
					success:function(data){
					$('#tipocambio').val(data);
					}
				});
		},
		error: function (xhr, ajaxOptions, thrownError) {
				$('.modal.in').modal('hide');
				 alertify.error('Ocurrio un error');
			}
	});

})
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
$(document).on('change','.newprecio',function(e){
	let precio=$(this).val();
	var fila=$(this).parent().parent();
	let cantpend=fila.find('td').eq(4).html();
	var valor=fila.find('.newcant').val();
		var dscto=fila.find(".newdescuento").val();
		fila.find(".preciobrutounit").val(((precio*(1-dscto))).toFixed(2));
		fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
	//alert(precio*cantidad);
	fila.find(".subtotalnew").val((precio*valor*(1-dscto)).toFixed(2));


	fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
//alert(precio*cantidad);
//fila.find(".subtotalnew").val((precio*valor).toFixed(2));
	suma_total();
});

$(document).on('change','.newdescuento',function(e){
	let dscto=$(this).val();
	var fila=$(this).parent().parent();
	let cantpend=fila.find('td').eq(4).html();
	var valor=fila.find('.newcant').val();
		var precio=fila.find(".newprecio").val();
		fila.find(".preciobrutounit").val(((precio*(1-dscto))).toFixed(2));
		fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
	//alert(precio*cantidad);
	fila.find(".subtotalnew").val((precio*valor*(1-dscto)).toFixed(2));


	fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
//alert(precio*cantidad);
//fila.find(".subtotalnew").val((precio*valor).toFixed(2));
	suma_total();
});
$(document).on('change','#INFOCOND',function(){
	let valor = $(this).val();
	$('#INFO').val(valor);
})
$(document).on('change','#CORREOCONDCOND',function(){
	let valor = $(this).val();
	$('#CORREOCOND').val(valor);
})
$(document).on('change','.newcant',function(e){
	let valor=$(this).val();
	var fila=$(this).parent().parent();
	let cantpend=fila.find('td').eq(4).html();
	var precio=fila.find(".newprecio").val();
		var dscto=fila.find(".newdescuento").val();
	if(cantpend<$(this).val()){
	  alert("La cantidad atendida supera la cantidad pendiente");
	  $(this).val(cantpend);
		fila.find(".preciobrutounit").val(((precio*(1-dscto))).toFixed(2));

		fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
	//alert(precio*cantidad);
	fila.find(".subtotalnew").val((precio*valor*(1-dscto)).toFixed(2));
	}
	if (valor<0) {
		$(this).val(0);
		fila.find(".preciobrutounit").val(((precio*(1-dscto))).toFixed(2));

		fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
	//alert(precio*cantidad);
	fila.find(".subtotalnew").val((precio*valor*(1-dscto)).toFixed(2));
	}
	fila.find(".preciobrutounit").val(((precio*(1-dscto))).toFixed(2));

	fila.find(".descuentovalornew").val((valor*(precio*(dscto))).toFixed(2));
//alert(precio*cantidad);
fila.find(".subtotalnew").val((precio*valor*(1-dscto)).toFixed(2));

	suma_total();
});

$(document).on('click','#crear_pedido',function(e){
	var	json=0;
	$("#tbl_detalle tbody tr").each(function () {
		      if ($(this).find('td').eq(1).html()!='TEXTO') {
		$(this).find("td").each(function () {
					$this=$(this);
					tr= $this.parent()
					if($this.find(".ccnew").val()=="" && tr.find('.estado').html()==1){
						json++;
					}
		});
	}
	});
	if (json<1) {
		alertify.confirm('Mensaje de confirmación',
	                  '¿Está seguro de generar la orden de venta?',
	                  function(){
	                    var json="";
	                    var json_total="";
	                            $("#tbl_detalle tbody tr").each(function () {
	                              json ="";
	                              $(this).find("td").each(function () {
	                                    $this=$(this);
																				if($this.attr("class")=='CDCODIGO' || $this.attr("class")=='estado' || $this.attr("class")=='CDUNIDAD' || $this.attr("class")=='CDDESCRI' || $this.attr("class")=='CDSECUEN' || $this.attr("class")=="igvvalor"){
																					json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
																				}else if($this.attr("class")=="CDCANTPEN" || $this.attr("class")=="centrocosto" || $this.attr("class")=='CDUNIDAD' || $this.attr("class")=='descuentovalor' || $this.attr("class")=='subtotal'|| $this.attr("class")=='precioneto' || $this.attr("class")=='CDPREC_ORI' || $this.attr("class")=='CDPORDES'){
																					json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
																				}else if ($this.attr("class")=="PLAZO") {
																					json=json+',"'+$this.attr("class")+'":"'+$this.find(".editable").val()+'"';
																					json=json+',"DFTIPTIME":"'+$this.find(".dias").val()+'"';
																				}else if ($this.attr("class")=="responsable") {
																					json=json+',"'+$this.attr("class")+'":"'+$this.find(".select_responsable").val()+'"';
																				}
	                              });
	                              obj=JSON.parse('{'+json.substr(1)+'}');
	                              json_total=json_total+','+JSON.stringify(obj);
	                          });
	                    var array_json=JSON.parse('['+json_total.substr(1)+']');
	                    $.ajax({
	                      url:baseurl+"Support/generar_orden",
	                      type:"post",
	                      data:$('#form_detalle').serialize()+"&tbldetalle=" + JSON.stringify(array_json),
	                        dataType:'json',
	                      beforeSend:function(){
	                        $('#crear_pedido').prop('disabled',true);
	                      },
	                      success: function(data){
	                        $('.modal.in').modal('hide');
	                    $('#crear_pedido').prop('disabled',false);
	                      //window.open(baseurl+"Requerimiento/despacho_compra_doc?despacho="+data.last_id+"");
													if (data=='ALERT') {
														alert('No se ha generado el pedido, no ubica la cotización');
													}
													if(data>0){

														if ($('#CORREOCOND option:selected').val()==1) {
															var formData = new FormData($("#form_adjunto")[0]);
													//formData.append("pedido",data);
															$.ajax({
																url:baseurl+"Support/adjuntar_archivo/"+data+"/"+$('#CFFECENT_ALM').val()+"/"+$('#CFTURNO').val(),
																data:formData,
																contentType:false,
																processData:false,
																type:"post",
																success:function(data2){
																	swal({
																	 title: "Pedido de Venta",
																	 type:"success",
																	 text: "¡¡Genial!! Se registro el Pedido N° "+pad(data2,7)+" y se envió el correo de notificación a las demas áreas !!!",
																	 timer: 3000,
																	 showConfirmButton: false
																	 });
																	 setTimeout("window.location.replace('"+baseurl+"Inicio/orden_venta')",3000);
																		var Clicked = false;
																}
															});
														} else {
															swal({
															 title: "Pedido de Venta",
															 type:"success",
															 text: "¡¡Genial!! Se registro el Pedido N° "+pad(data,7)+" !!!",
															 timer: 3000,
															 showConfirmButton: false
															 });
															 setTimeout("window.location.replace('"+baseurl+"Inicio/orden_venta')",3000);
																var Clicked = false;
														}

													}else {
															var Clicked = false;
														$('#msg').html('<div class="callout callout-danger"><h4>Error!'+data+'</h4><p></p> </div>');
														console.log(data);
													}
	                      },
	                      error: function (xhr, ajaxOptions, thrownError) {
													$.ajax({
														url:baseurl+"Ventas/get_correlativo_pedido",
														data:'fecha='+1,
														type:"post",
														success:function(data){
														$('#num_pedido').text(pad(data,7));
														}
													});
													$('#msg_header').html('<div class="callout callout-warning"><h4>Alerta!!!!</h4><p>El numero correlativo del pedido se encuentra en uso, por favor presione nuevamente el boton "Crear Pedido" </p> </div>');
													$('#msg').html('<div class="callout callout-warning"><h4>Alerta!!!!</h4><p>El numero correlativo del pedido se encuentra en uso, por favor presione nuevamente el boton "Crear Pedido" </p> </div>');
													console.log(data);
																}

	                    });
	                  }
	                  ,function(){alertify.error('Se canceló la generacion de pedido');
									});
}else {
			alert("Hay artículos que no tienen registrado el centro de costo");
}
  /**/
});
function suma_total(){
		var sum=0;
		var desc=0;
		$('.subtotalnew').each(function() {
			var fila=$(this).parent().parent();
			if(fila.find('.estado').html()==1){
				sum += Number($(this).val());
			}
		});
		$('.descuentovalornew').each(function() {
			var fila=$(this).parent().parent();
			if(fila.find('.estado').html()==1){
				desc += Number($(this).val());
			}
		});
		var bruto=(sum+desc);
		$('#subtotal').val(bruto.toFixed(2));
		var subtotal=  $('#subtotal').val();
		var dsct_cliente_valor=  $('#dsct_cliente_valor').val(desc.toFixed(2));
		var descuento_total=(dsct_cliente_valor);

		var valor_venta=  $('#valor_venta').val();
		var a= $('#subtotal').val()  -  $('#dsct_cliente_valor').val();
		var c=$('#valor_venta').val(a.toFixed(2));
		var porigv=$('#igvpor').val();
		var igv=$('#igv').val((a*porigv).toFixed(2));
		$('#total_doc').val((a+a*porigv).toFixed(2));
}
$(document).on('click', '.desactivar', function() {
	var fila=$(this).parent().parent();
	fila.attr("class","danger")
	fila.find('.estado').html(0);
	fila.find('.activar').show();
	fila.find('.newcant').attr("readonly","readonly");
		fila.find('.editable').attr("readonly","readonly");
	$(this).hide();
	var contador=0;
	$('.estado').each(function() {
			contador += Number($(this).html());
	});
		//	alert(contador);
	if (contador>18) {
		$('#crear_pedido').prop('disabled',true);
		$('#msg_header').html('<div class="callout callout-warning" id="msg_header"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
		$('#msg').html('<div class="callout callout-warning" id="msg_header"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
	}else {
		$('#crear_pedido').prop('disabled',false);
		$('#msg_header').html('');
		$('#msg').html('');
	}

	suma_total();
  });

	$(document).on('click', '.activar', function() {
		var fila=$(this).parent().parent();
		fila.find('.estado').html(1);
		fila.find('.desactivar').show();
			fila.removeAttr("class","danger")
			fila.find('.newcant').removeAttr("readonly");
			fila.find('.editable').removeAttr("readonly");
		$(this).hide();
		var contador=0;
		$('.estado').each(function() {
				contador += Number($(this).html());
		});
	//	alert(contador);
		if (contador>18) {
			$('#crear_pedido').prop('disabled',true);
			$('#msg_header').html('<div class="callout callout-warning"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
			$('#msg').html('<div class="callout callout-warning"><h4>Indicaciones!</h4><p>Sólo se permitirá generar el Pedido de Venta con un máximo de 18 items.</p></div>');
		}else {
			$('#crear_pedido').prop('disabled',false);
			$('#msg_header').html('');
			$('#msg').html('');
		}
		suma_total();
	  });
