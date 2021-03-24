

$('#ingresar').click(function(e){
	//var contrato=$('#contratos option:selected').text().replace(' ','-');
	$.ajax({
		type:"post",
		url:base_url+"Login/validacion",
		data:$('#form-login').serialize(),
		success:function(data){
			if(data=='1'){
				window.location=(base_url)+"Inicio";
			}
			else{
				$('#msg').html(data);
			}

		}
	});
});
