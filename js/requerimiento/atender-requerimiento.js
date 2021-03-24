function listar_req(idnota){
  $.post(baseurl+"Requerimiento/get_atender_req",{idnota:idnota},function(data){

    $('#tbl_atenderreq').html(data);

  });
}



$(document).ready(function(){
  control_de_menu($('#menu_atender_requerimiento'));
  listar_req($('#contrato').val());
});
$('#contrato').off('click')
$('#contrato').on('click',function(e){

  listar_req($('#contrato').val());
    e.preventDefault();
});


//ver detalle de requerimiento para atender
function listar_detalle(idnota){
  $.post(baseurl+"Requerimiento/get_detalle_atender/"+idnota,function(data){
    $('#tbl_atenderreq').html(data);
      $('#contrato').hide();
      $('#labelcontrato').hide();
      $('.select2').select2({

      });
  });
}

$(document).on('click','#btn_retroceder',function(e){
  window.location.replace(baseurl+"Contrato/atender_requerimiento");
});

$(document).on('click','.verdetalle',function(e){
  e.preventDefault();
  var id=$(this).attr('data-id');
 listar_detalle(id);
});

$(document).on('change','.valor',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(4).html(valor);

});
$(document).on('click','.req_compra',function(e){
  e.preventDefault();
  var id=$(this).attr('data-id');
$('#form_req_compra input[name="req_cabcompra"]').val(id);
  $.ajax({
 url:baseurl+"Requerimiento/req_compra",
 type:"post",
 data:{"req_cab":id},
 success:function(data){
 $('#tbl_compra').html(data);

 }
 });
});
/////////////////////////////////////////////////


////////////////////////////
$(document).on('change','.cantidadlima',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(6).html(valor);

let cantpend=fila.find('td').eq(3).html();
if(cantpend<$(this).val()){
  alert("La cantidad atendida supera la cantidad solicitada");
}

});

$(document).on('change','.cantidadr1',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(6).html(valor);


let cantpend=fila.find('td').eq(3).html();
if(cantpend<$(this).val()){
  alert("La cantidad atendida supera la cantidad solicitada");
}
});

$(document).on('change','.cantidadcompra',function(e){

let valor=$(this).val();
var fila=$(this).parent().parent();
fila.find('td').eq(5).html(valor);

let cantpend=fila.find('td').eq(3).html();
if(cantpend<$(this).val()){
  alert("La cantidad a comprar supera la cantidad solicitada");
}

});
//////////////////////////////

$(document).on('click','#btn_liberar',function(e){
  alertify.confirm('Mensaje de confirmación',
                  '¿Está seguro de autorizar la atencion del Requerimiento de Materiales?',
                  function(){
                      var id=$('#btn_liberar').attr('data-id');
                      //capturar datos de la Tabla
                      var json="";
                      var json_total="";
                              $("#tbl_detalle tbody tr").each(function () {
                                json ="";
                                $(this).find("td").each(function () {
                                      $this=$(this);
                                      if($this.attr("class")!='eliminar_item' && $this.attr("class")!='cant_aprob'  && $this.attr("class")!='itemdesc'){
                                        json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                      }


                                });
                                obj=JSON.parse('{'+json.substr(1)+'}');
                                json_total=json_total+','+JSON.stringify(obj);

                            });

                      var array_json=JSON.parse('['+json_total.substr(1)+']');

                      //fin
                      $.ajax({
                        url:baseurl+"Requerimiento/liberar_req",
                        type:"post",
                        data:"req_cab="+id+"&tbldetalle=" + JSON.stringify(array_json),
                        beforeSend:function(){
                          $('#btn_liberar').attr('disabled',true);
                          $('#msg').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"></center><br> ');

                        },
                        success: function(info){
                        alertify.success('Requerimiento autorizado');
                            $('#msg').html('');
                             $('#btn_liberar').prop('disabled',false);
                             $.post(baseurl+"Requerimiento/get_detalle_atender/"+info,function(data){
                               $('#tbl_atenderreq').html(data);

                               });
                        // alertify.success('Despacho realizado con éxito, dirigirse a Consultas/Despacho por 029');

                             console.log(info);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $('.modal.in').modal('hide');
                             alertify.error('Ocurrio un error');

                          }
                      });
                      }  ,function(){alertify.error('Se canceló el despacho')

});


});

//mata los eventos anteriores
$(document).off('click','#btn_despacho_lima');

$(document).on('click','#btn_despacho_lima',function(e){
//  e.preventDefault();
  alertify.confirm('Mensaje de confirmación',
                  '¿Está seguro de realizar el despacho en el Almacén Lima - 029?',

                  function(){

                    var json="";
                    var json_total="";
                            $("#tbl_detallelima tbody tr").each(function () {
                              json ="";
                              $(this).find("td").each(function () {
                                    $this=$(this);
                                    if($this.attr("class")!='atenderlima'&& $this.attr("class")!='itemdesclima'){
                                      json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                    }


                              });
                              obj=JSON.parse('{'+json.substr(1)+'}');
                              json_total=json_total+','+JSON.stringify(obj);

                          });

                    var array_json=JSON.parse('['+json_total.substr(1)+']');
                    $.ajax({
                      url:baseurl+"Requerimiento/despacho_lima",
                      type:"post",
                      data:"req_cab="+$('#form_carga_lima input[name="reqcab').val()+"&tbldetalle=" + JSON.stringify(array_json),
                      dataType:'json',
                      beforeSend:function(){
                        $('#btn_despacho_lima').attr('disabled',true);
                        $('#btn_atender_lima').attr('disabled',true);
                        $('#btn_atender_r1').attr('disabled',true);
                      },
                      success: function(data){
                        $('.modal.in').modal('hide');
                           $('#msg').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"></center><br> ');
                        alertify.success(data.msg);
                           $('#btn_despacho_lima').attr('disabled',false);
                           $.post(baseurl+"Requerimiento/get_detalle_atender/"+$('#form_carga_lima input[name="reqcab').val(),function(data){
                             $('#tbl_atenderreq').html(data);
                               $('#contrato').hide();
                             });
                             window.open(data.pdf,'_blank');
                          // alertify.success('Despacho realizado con éxito, dirigirse a Consultas/Despacho por 029');

                           console.log(data);
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                          $('.modal.in').modal('hide');
                           alertify.error('Ocurrio un error');

                        }
                    });

}



                  ,function(){alertify.error('Se canceló el despacho')})
                    });



/////////////////////////////////////////////
$(document).off('click','#btn_despacho_ctr');
$(document).on('click','#btn_despacho_ctr',function(e){
  //e.preventDefault();
  alertify.confirm('Mensaje de confirmación',
                  '¿Está seguro de realizar el despacho en el Almacén R1 - 031?',

                  function(){

                    var json="";
                    var json_total="";
                            $("#tbl_detaller1 tbody tr").each(function () {
                              json ="";
                              $(this).find("td").each(function () {
                                    $this=$(this);
                                    if($this.attr("class")!='atenderr1' && $this.attr("class")!='itemdescr1'){
                                      json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                    }


                              });
                              obj=JSON.parse('{'+json.substr(1)+'}');
                              json_total=json_total+','+JSON.stringify(obj);

                          });

                    var array_json=JSON.parse('['+json_total.substr(1)+']');
                    $.ajax({
                      url:baseurl+"Requerimiento/despacho_r1",
                      type:"post",
                      data:"req_cab="+$('#form_carga_lima input[name="reqcab').val()+"&tbldetalle=" + JSON.stringify(array_json),
                        dataType:'json',
                      beforeSend:function(){
                        $('#btn_despacho_ctr').attr('disabled',true);
                      },
                      success: function(data){
                           $('#msg').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"></center><br> ');
                        $('.modal.in').modal('hide');
                           alertify.success(data.msg);
                           $('#btn_despacho_ctr').attr('disabled',false);
                           $.post(baseurl+"Requerimiento/get_detalle_atender/"+$('#form_carga_lima input[name="reqcab').val(),function(data){
                             $('#tbl_atenderreq').html(data);
                               $('#contrato').hide();
                                 });
                           //alertify.success('Despacho realizado con éxito, dirigirse a Consultas/Despacho por 031');
                           window.open(baseurl+"Requerimiento/despacho_r1_doc?despacho="+data.last_id+"");
                           console.log(data);
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                          $('.modal.in').modal('hide');
                           alertify.error('Ocurrio un error');

                        }
                    });

}



                  ,function(){alertify.error('Se canceló el despacho')
                    });
});









///////////////////////////////////////////



$(document).off('click','#btn_compra_ctr');
$(document).on('click','#btn_compra_ctr',function(e){
//  e.preventDefault();
  alertify.confirm('Mensaje de confirmación',
                  '¿Está seguro de generar el requerimiento de compra?',

                  function(){

                    var json="";
                    var json_total="";
                            $("#tbl_compra tbody tr").each(function () {
                              json ="";
                              $(this).find("td").each(function () {
                                    $this=$(this);
                                    if($this.attr("class")!='atendercompra' && $this.attr("class")!='itemdesccompra'){
                                      json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';

                                    }


                              });
                              obj=JSON.parse('{'+json.substr(1)+'}');
                              json_total=json_total+','+JSON.stringify(obj);

                          });

                    var array_json=JSON.parse('['+json_total.substr(1)+']');
                    $.ajax({
                      url:baseurl+"Requerimiento/despacho_compra",
                      type:"post",
                      data:"req_cab="+$('#form_req_compra input[name="req_cabcompra').val()+"&tbldetalle=" + JSON.stringify(array_json),
                        dataType:'json',
                      beforeSend:function(){
                        $('#btn_compra_ctr').prop('disabled',true);

                      },
                      success: function(data){
                        $('.modal.in').modal('hide');
                        alertify.success(data.msg);
                           $('#btn_compra_ctr').prop('disabled',false);

                          // alertify.success('Despacho realizado con éxito, dirigirse a Consultas/Despacho por 029');
                          window.open(baseurl+"Requerimiento/despacho_compra_doc?despacho="+data.last_id+"");

                           console.log(data.msg);
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                          $('.modal.in').modal('hide');
                           alertify.error('Ocurrio un error');

                        }
                    });

}



                  ,function(){alertify.error('Se canceló el despacho')
                    });
});


$(document).on('click','#btn_agregar_codigo', function() {
  $.ajax({
    url:baseurl+"Requerimiento/insertar_linea",
    type:"post",
    data:$('#form_carga_manual').serialize(),
    beforeSend:function(){
        $('.modal.in').modal('hide');
    },
    success: function(info){

         $('#msg').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"></center><br> ');
         alertify.success('Item insertado');
         $.post(baseurl+"Requerimiento/get_detalle_atender/"+info,function(data){
           $('#tbl_atenderreq').html(data);
             $('#contrato').hide();
             $('#labelcontrato').hide();
           $('.select2').select2({
           });
         });
    },
    error: function (xhr, ajaxOptions, thrownError) {

         alertify.error('Ocurrio un error');
      }
  });
});
