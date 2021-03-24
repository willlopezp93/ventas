$(document).ready(function(){
  control_de_menu($('#menu_consulta_despacho'));

  $('table').DataTable({
    "order": [['0','desc']]
  });
  });

  function listar_detalle(idnota){
    $.post(baseurl+"Requerimiento/get_detalle_despacho/"+idnota,function(data){
      $('#tbl_stock').html(data);
    });
  }

  $(document).on('click','.verdetalle',function(e){

    e.preventDefault();
      var id=$(this).attr('data-id') ;


   listar_detalle(id);

  });
