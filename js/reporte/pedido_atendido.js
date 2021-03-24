$(document).ready(function(){

  control_de_menu($('#menu_reporte_pedido_atendido'));

});

$(document).on('click','#consultar',function(){
  var fecha_inicio=$('#fecha_inicio').val();
  var fecha_fin=$('#fecha_fin').val();

  $.ajax({
    url:baseurl+"Ventas/pedido_atendido",
    data:"fecha_fin="+fecha_fin+"&fecha_inicio="+fecha_inicio,
    type:"post",
    beforeSend:function(){
      $('#tabla_info').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif">  <h3>Cargando...</h3></center><br> ');
    },
    success:function(data){
      $('#tabla_info').html(data);
      $('#relacion_reporte').DataTable({
    dom: 'Bfrtip',
    bProcessing: true,
bAutoWidth: false,
    buttons: [

        {
            extend: 'excel',
            title: 'Pedidos Pendientes'

        }

    ],
    columnDefs: [{
        width: "10px",
        targets: 0
      },
      {
        width: "40px",
        targets: 1
      },
      {
        width: "100px",
        targets: 2
      },
      {
        width: "70px",
        targets: 3
      },
      {
        width: "70px",
        targets: 4
      },
      {
        width: "70px",
        targets: 5
      }
    ]

});
    }
  })

})
