$(document).ready(function(){

  control_de_menu($('#menu_reporte_salidas_08'));

});

$(document).on('click','#consultar',function(){
  var fecha_inicio=$('#fecha_inicio').val();
  var fecha_fin=$('#fecha_fin').val();

  $.ajax({
    url:baseurl+"Ventas/reporte_salidas_08",
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
            title: '>Reportes Salidas del Almacen 08'

        }

    ]

});
    }
  })

})
