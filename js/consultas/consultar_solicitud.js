$(document).ready(function(){
  control_de_menu($('#menu_solicitud_codigo'));
  $('table').DataTable({
    "order": [['0','desc']]
  });
  });

  $('#contrato').off('click')
  $('#contrato').on('click',function(e){

    listar_sol($('#contrato').val());
      e.preventDefault();
  });

  function listar_sol(idnota){
    $.post(baseurl+"Requerimiento/get_sol",{idnota:idnota},function(data){

      $('#tbl_req').html(data);
      $('table').DataTable({

        "order": []
      });
    });
  }

function listar_detalle(idnota){
  $.post(baseurl+"Documento/get_detalle_sol/"+idnota,function(data){
    $('#tbl_req').html(data);
  });
}

$(document).on('click','.verdetallereq',function(e){

  e.preventDefault();
  var id=$(this).attr('data-id');

 listar_detalle(id);

});
$(document).on('click','#btn_retroceder',function(e){
  window.location.replace(baseurl+"Contrato/consultar_solicitud_codigo");

});



$(document).on('change','.valor',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(11).html(valor);

});



$(document).on('click','#btn_notificar',function(e){
e.preventDefault();
    alertify.confirm('Solicitus de Creacion de Codigo', '¿Desea notificar al contrato la creacion de los codigos?',
                    function(){
                        //capturar datos de la Tabla
                        var json="";
                        var json_total="";
                                $("#tbl_detalle tbody tr").each(function () {
                                  json ="";
                                  $(this).find("td").each(function () {
                                        $this=$(this);
                                        if($this.attr("class")!='inputobservaciones'){
                                          json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                        }


                                  });
                                  obj=JSON.parse('{'+json.substr(1)+'}');
                                  json_total=json_total+','+JSON.stringify(obj);

                              });

                        var array_json=JSON.parse('['+json_total.substr(1)+']');

                        //fin

                       $.ajax({
                         url:baseurl+"Requerimiento/update_sol",
                         type:"post",
                         data:"req_cab="+$('#req_cab').val()+"&tbldetalle=" + JSON.stringify(array_json),
                         beforeSend:function(){
                           $('#btn_update_req').attr('disabled',true);
                         },
                         success: function(data){
                              alertify.success(data);
                              $.post(baseurl+"Documento/get_detalle_sol/"+$('#req_cab').val(),function(data){
                                $('#tbl_req').html(data);
                              });
                             location.reload();
                         },
                         error: function (xhr, ajaxOptions, thrownError) {

                              alertify.error('Ocurrio un error');

                           }
                       });

                      },
                    function(){
                      alertify.error('Error');
                     });


});
