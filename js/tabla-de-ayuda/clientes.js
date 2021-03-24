$(document).ready(function(){
	control_de_menu($('#menu_cliente'));
	$('#tbl_cliente').DataTable();

});


$(document).on('click','.clientes',function(e){
    var cliente=$(this).attr('data-id');
    $.post(baseurl+"Tablaayuda/contacto/"+cliente,function(data){
      $('#tbl_contactos').html(data);
      $('table').tablesorter();
    });
});

$(document).on('click','.destinos',function(e){
    var cliente=$(this).attr('data-id');
    $.post(baseurl+"Tablaayuda/direcciones/"+cliente,function(data){
      $('#tbl_destinos').html(data);
      $('table').tablesorter();
    });
});
