$(document).ready(function(){
	control_de_menu($('#menu_auditoria_descuento'));
	$('#tbl_cotizaciones').DataTable({
        "order": [[ 0, "asc" ]]
    } );


});
