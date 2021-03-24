
$(document).ready(function(){
  control_de_menu($('#menu_dashboard_semanal'));

});
$(document).on('click','.consultar_info',function(){
  $('#dashboard').html('<br><br> <center><img src="http://ventas.codrise.net/assets/img/pageloader.gif">  <h3>Cargando...</h3></center><br> ');
    var finicio=$('#finicio').val();
    var ffin=$('#ffin').val();
    var suministro=$('#suministro option:selected').val();
          $.post(baseurl+"Charts/consulta_semanal/"+finicio+"/"+ffin+"/"+suministro,function(data){
            $('#dashboard').html(data);

          })

});
