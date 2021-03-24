$(document).ready(function(){
    control_de_menu($('#menu_eliminacion_pedido'));
    $('table').DataTable();
})

$(document).on('click','.btn_remove',function(){
  var pedido=$(this).attr('data-id');
  var cotizacion=$(this).attr('data-idref');
/*  $.ajax({
    url:baseurl+"Ventas/anular_pedido",
    data:"pedido="+pedido+"&cotizacion="+parseInt(cotizacion,10),
    type:"post",
    beforeSend:function(){
      $('.btn_remove').attr('disabled',true);
    },
    success:function(data){
      location.reload();
    }
  })*/
  alert("pedido="+pedido+"&cotizacion="+parseInt(cotizacion,10));
})
