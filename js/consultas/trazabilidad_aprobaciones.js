$(document).ready(function(){
  control_de_menu($('#menu_trazabilidad_aprobaciones'));


  $('table').DataTable({
    "order": [['0','desc']]
  });
  });

  $('#contrato').off('click')
  $('#contrato').on('click',function(e){

    listar_req($('#contrato').val());
      e.preventDefault();
  });


  function listar_req(idnota){
    $.post(baseurl+"Requerimiento/trazabilidad_aprobaciones",{idnota:idnota},function(data){

      $('#tbl_aprobpl').html(data);
      $('table').DataTable({

        "order": []
      });
    });
  }
