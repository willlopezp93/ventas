
$(document).ready(function(){
  control_de_menu($('#menu_dashboard_trimestre'));

});
$(document).on('click','.consultar_info',function(){
  if ($('#año').val()!=0 || $('#trimestre').val()!=0) {
    $('#dashboard').html('<br><br> <center><img src="http://ventas.codrise.net/assets/img/pageloader.gif">  <h3>Cargando...</h3></center><br> ');
    var id=$('#año').val();
    var mes=$('#trimestre option:selected').text();
    var num_mes=$('#trimestre').val();
    $('#trimestre_seleccionado').val(mes);
          $.post(baseurl+"Charts/consulta_trimestre/"+id+"/"+num_mes,function(data){
            $('#dashboard').html(data);

          })
  }
});
