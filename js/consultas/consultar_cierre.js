$(document).ready(function(){
  control_de_menu($('#consultar_cierre'));
  $('#tbl_cotizaciones').DataTable({
        dom:'Bfrtp',
        buttons: [
            {
                text: '<i class="glyphicon glyphicon-th-list"></i>',
                className:'btn-lg bg-blue-active color-palette verdetallereq disabled',
                action: function ( e, dt, node, config ) {



                  var id=$('#cotizacion').val();
                    $('#analisis').modal('show');
                  $.post(baseurl+"Ventas/get_detalle_cierre/"+id,function(data){
                    $('.modal-title').html('<strong>Cotización: '+pad(id,7)+'</strong>');
                    $('#tbl_detalle').html(data);
                    $('#cotizacioncerrar').val(id);
                  });
                }
            }
        ],
     pageLength: 15,
		"pagin":true,
        order: [[ 1, "desc" ]],

    });
})
$(document).on('click', '#tbl_cotizaciones tbody tr', function () {
    //  var data = tbl_usuarios.row( this ).data();
      var id=$(this).find('td').eq(0).html();

      $('tr').removeClass('info');
      $(this).addClass('info');
      $('#cotizacion').val(id);

      $('.verdetallereq').removeClass( "disabled" );

  } );
  function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }
