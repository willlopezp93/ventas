
function listar_detalle(idnota){
  $.post(baseurl+"Requerimiento/get_detalle_req/"+idnota,function(data){
    $('#tbl_stock').html(data);
  });
}
$(document).ready(function(){
  control_de_menu($('#menu_aprob_ctr'));
  $('table').DataTable({
    "order": [['0','desc']]
})
});
$(document).on('click','.verdetalle',function(e){

  e.preventDefault();
    var id=$(this).attr('data-id') ;


 listar_detalle(id);

});

$(document).on('click','#btn_retroceder',function(e){
  window.location.replace(baseurl+"Contrato/aprobacion_area");

});
$(document).on('change','.valor',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(5).html(valor);

});

$(document).on('click','#btn_aprobar_area',function(e){
e.preventDefault();
    alertify.confirm('Aprobar Requerimiento de Materiales', 'El documento pasará a ser revisado por el Jefe de Contrato.¿Desea aprobarlo?',
                    function(){
                        //capturar datos de la Tabla
      /*              var json="";
                        var json_total="";
                                $("#tbl_detalle tbody tr").each(function () {
                                  json ="";
                                  $(this).find("td").each(function () {
                                        $this=$(this);
                                        if($this.attr("class")!='eliminar_item' && $this.attr("class")!='cant_aprob'){
                                          json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                        }


                                  });
                                  obj=JSON.parse('{'+json.substr(1)+'}');
                                  json_total=json_total+','+JSON.stringify(obj);

                              });

                        var array_json=JSON.parse('['+json_total.substr(1)+']');
*/
                        //fin

                       $.ajax({
                         url:baseurl+"Requerimiento/firmar-req",
                         type:"post",
                         data:"req_cab="+$('#req_cab').val()/*+"&tbldetalle=" + JSON.stringify(array_json)*/,
                         beforeSend:function(){
                           $('#btn_aprobar_req').prop('disabled',true);
                         },
                         success: function(data){
                              alertify.success(data);
                              $('#btn_aprobar_area').hide();
                              $('#btn_anular').hide();
                              $('.eliminar_item').hide();
                             console.log(data);
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


$(document).on('click','#btn_anular',function(e){
  e.preventDefault();
      alertify.confirm('Anular Requerimiento de Materiales', 'El documento será rechazado, esta acción es irreversible .¿Desea anularlo?',
                      function(){
                         $.ajax({
                           url:baseurl+"Requerimiento/anular-req",
                           type:"post",
                           data:"req_cab="+$('#req_cab').val(),
                           beforeSend:function(){
                             $('#btn_aprobar_req').prop('disabled',true);
                           },
                           success: function(data){
                                alertify.success(data);
                                $('#btn_aprobar_req').hide();
                                $('#btn_anular').hide();
                                $('.eliminar_item').hide();
                               console.log(data);
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

/*

$(document).on('click','#btn_eliminar',function(e){
  var fila=$(this).parent().parent();
  var item_num=fila.find('td').eq(0).html();
  var req_cab= $('#req_cab').val();
  console.log(req_cab);
    alertify.confirm('Eliminar Item', 'El item será eliminado, esta acción es irreversible .¿Desea eliminarlo?',
                      function(){//confirma
                          $.ajax({
                            url:baseurl+'Requerimiento/eliminar-reqitem',
                            data: "item_num="+item_num + "&req_cab="+req_cab,
                            type:"post",
                            dataType:"json",
                            success:function(data){

                                if(data.afectados>0){
                                  fila.addClass("danger");
                                  fila.find('td').eq(4).find('input').attr('readonly',true);
                                  alertify.success('Item eliminado');
                                }else{
                                  fila.addClass("danger");
                                  alertify.success('El item ya se encuentra anulado');
                                }
                            }

                          })

                    },
                    function(){//cancela
                      alertify.error('se nego a anular');
                    });

});
*/
