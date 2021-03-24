$(document).ready(function(){
	control_de_menu($('#menu_cierre'));
  $('#tbl_cotizaciones').DataTable();

});

$(document).on('click','.ver_detalle',function(){
  var id=$(this).attr('data-id');
$('.modal-title').html('<strong>Cotización: '+pad(id,7)+'</strong>');
  $.post(baseurl+'Ventas/get_detalle/'+id,function(data){
$('#tbl_detalle').html(data);
$('#cotizacioncerrar').val(id);
  });
})
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
$(document).on('click','#cerrar_cot',function(){
	var id=$('#cotizacioncerrar').val();
	alertify.confirm('Cierre de cotizacion','¿Desea cerrar la cotizacion #'+pad(id,7)+'?',function(){

			var json="";
		var json_total="";
					 $("#tbl_detalle tbody tr").each(function () {
						 json ="";
						 $(this).find("td").each(function () {
							 $this=$(this);
							 if($this.attr("class")=='CDSECUEN' || $this.attr("class")=='CDCODIGO' ){
										 json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
							 }
							 if ($this.attr("class")=='ESTADO') {
								 	json=json+',"'+$this.attr("class")+'":"'+$this.find('select').val()+'"';
							 }
						 });
						 obj=JSON.parse('{'+json.substr(1)+'}');
						 json_total=json_total+','+JSON.stringify(obj);
				 });
				 var array_json=JSON.parse('['+json_total.substr(1)+']');
				 $.ajax({
					 url:baseurl+"Ventas/cerrar_cot",
					 type:"post",
					 data:"cotizacion="+$('#cotizacioncerrar').val()+"&tbldetalle=" + JSON.stringify(array_json),
					 beforeSend:function(){
						 $('#mensaje').html("<div><h4>Cargando...</h4></div>");
						 $('#cerrar_cot').prop('disabled',true);
					 },
					 success: function(data){
						 if (data==1) {
							 $('#mensaje').html('<div class="callout callout-success"><h4>Cierre de Cotización correcto!</h4></div>');
							 location.reload();

						 }else if (data==2) {
							 $('#mensaje').html('<div class="callout callout-danger"><h4>Ocurrio un error!</h4></div>');
							 						 $('#cerrar_cot').prop('disabled',false);
						 }else if (data==0) {
							 $('#mensaje').html();
							 alert('Falta definir el motivo de No Atención en algunos articulos');
							 						 $('#cerrar_cot').prop('disabled',false);
						 }
					 },
					 error: function (xhr, ajaxOptions, thrownError) {
							 $('.modal.in').modal('hide');
								alertify.error('Ocurrio un error');
						 }
				 });
	},function(){
		alertify.error('Accion Cancelada');
	});
});
