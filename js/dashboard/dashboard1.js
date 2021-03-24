
$(document).ready(function(){
  control_de_menu($('#menu_dashboard_mes'));

});
$(document).on('click','.consultar_info',function(){
  if ($('#año').val()!=0 || $('#mes').val()!=0) {
    $('#dashboard').html('<br><br> <center><img src="http://ventas.codrise.net/assets/img/pageloader.gif">  <h3>Cargando...</h3></center><br> ');
    var id=$('#año').val();
    var mes=$('#mes option:selected').text();
    var num_mes=$('#mes').val();
    $('#mes_seleccionado').val(mes);
          $.post(baseurl+"Charts/consulta_mes/"+id+"/"+num_mes,function(data){
            $('#dashboard').html(data);

          })

  }
});
$(document).on('click','.pedido',function(){
          $.post(baseurl+"Support/carga_pedido",function(data){
    alertify.success('ya ta')
          })
});
