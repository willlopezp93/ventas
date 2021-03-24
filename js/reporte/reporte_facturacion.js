$(document).ready(function(){

  control_de_menu($('#menu_reporte_facturacion'));

});

$(document).on('click','#consultar',function(){
  var fecha_inicio=$('#fecha_inicio').val();
  var fecha_fin=$('#fecha_fin').val();

  $.ajax({
    url:baseurl+"Ventas/reporte_facturacion",
    data:"fecha_fin="+fecha_fin+"&fecha_inicio="+fecha_inicio,
    type:"post",
    beforeSend:function(){
      $('#tabla_info').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif">  <h3>Cargando...</h3></center><br> ');
    },
    success:function(data){
      $('#tabla_info').html(data);
      $('#relacion_reporte').DataTable({
        dom: 'Bfrtip',
        buttons: [

        {
            extend: 'excel',
            title: 'Reporte Detallado de Facturas'

        }

    ]

});
    }
  })

})
