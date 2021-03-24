$(document).ready(function(){
  control_de_menu($('#menu_reporte_pedido_pendiente'));
});

$(document).on('click','#consultar',function(){
  var vendedor=$('#vendedor').val();

  $.ajax({
    url:baseurl+"Ventas/pedido_pendiente",
    data:"vendedor="+vendedor,
    type:"post",
    beforeSend:function(){
      $('#tabla_info').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif">  <h3>Cargando...</h3></center><br> ');
    },
    success:function(data){
      $('#tabla_info').html(data);
      $('#relacion_reporte').DataTable({
    dom: 'Bfrtip',
    pageLength: 50,
    buttons: [

        {
            extend: 'excel',
            title: 'Pedidos Pendientes'

        }

    ],
    footerCallback: function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        total = api
            .column( 7 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        pageTotal = api
            .column( 7, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        $( api.column( 6 ).footer() ).html(
            total.toFixed(2)
        );
    }
});
    }
  })

})
