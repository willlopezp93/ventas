$(document).ready(function(){
	control_de_menu($('#menu_auditoria_precio'));
	$('#tbl_cotizaciones').DataTable({
        "order": [[ 0, "asc" ]]
    } );


});
