$(document).ready(function(){
  control_de_menu($('#menu_con_cc'));
  $('#tbl_cotizaciones').DataTable({
    dom:'Bfrtp',
        "order": [[ 0, "asc" ]]
    } );
});
