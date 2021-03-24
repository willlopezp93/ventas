
$(document).ready(function(){
  control_de_menu($('#menu_sin_cc'));
  $('#tbl_cotizaciones').DataTable({
        "order": [[ 0, "asc" ]]
    } );



});
$(document).on('click','#actualizar',function (e){
  $.ajax({
    url:baseurl+"Ventas/Asignarcc",
    type:"post",
    beforeSend:function(){
      $('#msg').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"> <h4>Por favor espere a que el proceso termine, no actualize ni cambie de pagina</h4></center><br> ');
      $('#actualizar').attr('disabled',true);
    },
    success:function(data){
      if (data>0) {
        alertify.success("Se actualizaron los centro de costos");
        location.reload()
      }else {
        alertify.error("Hubo un error");
      }
    }
  })
});
