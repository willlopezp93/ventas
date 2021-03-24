$(document).ready(function(){
	control_de_menu($('#menu_programacion_entrega'));
  $.ajax({
    url:baseurl+"Ventas/get_pedidos_pendientes",
    type:"post",
    dataType:"json",
    success:function(data){
      $.each(data,function(i,item){
          $('select[name=pedido]').append('<option value="'+item.CFNUMPED+'">'+item.CFNUMPED+'</option>');
      });
      $('.select2').select2();
    }
  })
});

function actualizar(json,tipo){
	$.ajax({
		url:baseurl+"Support/actualizar_programacion_entrega/"+tipo,
		type:"post",
		data:{detalle:json},
		success:function(data){
			swal({
				title: "Pedido de Venta",
				 type:"success",
					 text: "¡¡Genial!! Se ha actualizado la programación de entrega de los pedidos!!!",
						 timer: 3000,
							 showConfirmButton: false
			 });
			setTimeout("window.location.replace('"+window.location.pathname+"')",3500);
		}
	})
}

$(document).on('change','#fecha',function(){
  var fecha = $(this).val();
if (fecha!='') {
  $.ajax({
    url:baseurl+"Ventas/get_pedidos_detalle",
    data:{fecha:fecha},
    type:"post",
    success:function(data){
      $('#div_detalle').html(data);
    }
  })
} else {
  $('#div_detalle').html('');

}
})

$(document).on('change','.saldo',function(){
	var fila = $(this).parent().parent();
	var cant_limite = fila.find('.DFCANTID').html();
  var saldo = $(this).val();
	if (cant_limite<saldo) {
		fila.find('.saldo').val(cant_limite);
	} 
})

$(document).on('click','#actualizar',function(){
  var pedido = $('#pedido option:selected').val();
	if (pedido!='') {
		var json="";
		var json_total="";
				 $("#tbl_detalle tbody tr").each(function () {
					 json ="";
					 $(this).find("td").each(function () {
								 $this=$(this);
								 if($this.attr("class")=="DFSECUEN" || $this.attr("class")=="DFNUMPED" || $this.attr("class")=="DFCODIGO" || $this.attr("class")=="DFDESCRI"){
									 json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
								 }else if($this.attr("class")=="DFFECENT" || $this.attr("class")=="DFSALDO") {
									 json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
								 }else if($this.attr("class")=="DFTURNO") {
									 json=json+',"'+$this.attr("class")+'":"'+$this.find("select").val()+'"';
								 }
					 });
					 obj=JSON.parse('{'+json.substr(1)+'}');
					 json_total=json_total+','+JSON.stringify(obj);
			 });
			 var array_json=JSON.parse('['+json_total.substr(1)+']');

	actualizar(JSON.stringify(array_json),0);
	}
})
$(document).on('click','#actualizar_notificar',function(){
  var pedido = $('#pedido option:selected').val();
	if (pedido!='') {
		var json="";
		var json_total="";
				 $("#tbl_detalle tbody tr").each(function () {
					 json ="";
					 $(this).find("td").each(function () {
								 $this=$(this);
								 if($this.attr("class")=="DFSECUEN" || $this.attr("class")=="DFNUMPED" || $this.attr("class")=="DFCODIGO" || $this.attr("class")=="DFDESCRI"){
									 json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
								 }else if($this.attr("class")=="DFFECENT" || $this.attr("class")=="DFSALDO") {
									 json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
								 }else if($this.attr("class")=="DFTURNO") {
									 json=json+',"'+$this.attr("class")+'":"'+$this.find("select").val()+'"';
								 }
					 });
					 obj=JSON.parse('{'+json.substr(1)+'}');
					 json_total=json_total+','+JSON.stringify(obj);
			 });
			 var array_json=JSON.parse('['+json_total.substr(1)+']');

	actualizar(JSON.stringify(array_json),1);
	}
})
