
$(document).ready(function(){
  control_de_menu($('#menu_cumplimiento_pedidos'));

});
$(document).on('click','.consultar_info',function(){
  $('#dashboard').html('<br><br> <center><img src="http://ventas.codrise.net/assets/img/pageloader.gif">  <h3>Cargando...</h3></center><br> ');
    var mes=$('#mes').val();
          $.post(baseurl+"Charts/cumplimiento_pedidos/"+mes,function(data){
            $('#dashboard').html(data);

          })

});
$(document).on('click','.modalbutton',function(){
  $('#myModal').modal('show');
  $('#form_pedido').html('<br><br> <center><img src="http://ventas.codrise.net/assets/img/pageloader.gif">  <h3>Cargando...</h3></center><br> ');
  var mes=$('#mes').val();
  var condicion=$(this).attr('data-id');
        $.post(baseurl+"Charts/cumplimiento_pedidos_detalle/"+mes+"/"+condicion,function(data){
          $('#form_pedido').html(data);
          $('#table_detail').DataTable();
        })
})
