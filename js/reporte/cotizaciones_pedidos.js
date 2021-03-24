$(document).ready(function(){
  control_de_menu($('#menu_cotizaciones_pedidos'));

});
$(document).on('click','.consultar_info',function(){
  $('#dashboard').html('<br><br> <center><img src="http://ventas.codrise.net/assets/img/pageloader.gif">  <h3>Cargando...</h3></center><br> ');
    var mes=$('#mes').val();
          $.post(baseurl+"Charts/cotizaciones_pedidos/"+mes,function(data){
            $('#dashboard').html(data);
          })

});
