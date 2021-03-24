$(document).ready(function(){

  control_de_menu($('#menu_analisis_precio'));


});
$(document).on('click','#consultar',function(){
  var fecha_inicio=$('#fecha_inicio').val();
  var fecha_fin=$('#fecha_fin').val();

  $.ajax({
    url:baseurl+"Ventas/consultar_analisis_precios_rango",
    type:"post",
    data:"fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin,
    beforeSend:function(){
      $('#listar_detallado').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"> <h3>Cargando...</h3></center><br> ');
    },
    success:function(data){
      $('#listar_detallado').html(data);
      $('#relacion_reporte').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excel',
            title: 'Cotizaciones - Detallado'
        }
    ]
});
    }
  })
})
