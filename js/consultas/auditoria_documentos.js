$(document).ready(function(){
	control_de_menu($('#menu_auditoria_documento'));
	$('#tbl_cotizaciones').DataTable({
        "order": [[ 0, "asc" ]]
    } );


});
