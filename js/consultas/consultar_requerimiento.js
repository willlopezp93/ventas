$(document).ready(function(){
  control_de_menu($('#menu_req_materiales'));


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
    $.post(baseurl+"Requerimiento/get_req",{idnota:idnota},function(data){

      $('#tbl_req').html(data);
      $('table').DataTable({

        "order": []
      });
    });
  }

function listar_detalle(idnota){
  $.post(baseurl+"Documento/get_detalle_req/"+idnota+"/consulta",function(data){
    console.log(data);
    $('#tbl_req').html(data);
    $('.select2').select2({

    });
  });
}



$(document).on('click','.verdetallereq',function(e){

  e.preventDefault();
  var id=$(this).attr('data-id') ;

 listar_detalle(id);

});





$(document).on('click','#btn_retroceder',function(e){
  window.location.replace(baseurl+"Contrato/consultar_requerimiento");

});
/*
$(document).on('change','.sel_codigo',function(e){
let valor=$(this).val()
$.post(baseurl+'Articulo/getArticulo',{articuloid:valor},function(data){
  var descripcion=data;
    $('#itemdesc').val(descripcion);

});
});
*/

$(document).on('change','.valor',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(5).html(valor);

});
$(document).on('click','#btn_update_req',function(e){
e.preventDefault();
    alertify.confirm('Guardar Requerimiento de Materiales', 'El documento pasará a ser revisado por el área responsable.¿Desea aprobarlo?',
                    function(){
                        //capturar datos de la Tabla
                        var json="";
                        var json_total="";
                                $("#tbl_detalle tbody tr").each(function () {
                                  json ="";
                                  $(this).find("td").each(function () {
                                        $this=$(this);
                                        if($this.attr("class")!='eliminar_item' && $this.attr("class")!='cant_aprob' && $this.attr("class")!='itemdesc'){
                                          json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                        }


                                  });
                                  obj=JSON.parse('{'+json.substr(1)+'}');
                                  json_total=json_total+','+JSON.stringify(obj);

                              });

                        var array_json=JSON.parse('['+json_total.substr(1)+']');

                        //fin

                       $.ajax({
                         url:baseurl+"Requerimiento/update_req",
                         type:"post",
                         data:"req_cab="+$('#req_cab').val()+"&tbldetalle=" + JSON.stringify(array_json),
                         beforeSend:function(){
                           $('#btn_update_req').prop('disabled',true);
                         },
                         success: function(data){
                              alertify.success(data);

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


$(document).on('click', '#btn_agregar_codigo', function() {
  $.ajax({
    url:baseurl+"Requerimiento/insertar_linea",
    type:"post",
    data:$('#form_carga_manual').serialize(),
    beforeSend:function(){
      $('#btn_agregar_codigo').prop('disabled',true);
    },
    success: function(info){
      $('.modal.in').modal('hide');
         alertify.success('Item insertado');
         $.post(baseurl+"Documento/get_detalle_req/"+info+"/consulta",function(data){
           $('#tbl_req').html(data);

           });

    },
    error: function (xhr, ajaxOptions, thrownError) {

         alertify.error('Ocurrio un error');

      }
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
