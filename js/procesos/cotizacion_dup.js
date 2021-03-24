$(document).ready(function(){
  control_de_menu($('#menu_cotizacion'));


  $('.select2').select2({

  });
  let pto_venta=$('#pto_venta').val();
$.ajax({
  url:baseurl+"Tablaayuda/ptoventa_almacen",
  data:{'pto_venta':pto_venta},
  type:"post",
  success:function(data){
    $('#almacen').val(data);
  }
});

  let tipo=$('#tipocot').val();
  if (tipo=='NAC') {
    $('#igvpor').val(0.18);
    suma_total() ;
  }else {
    $('#igvpor').val(0);
    suma_total() ;
  }

    let fecha=$('#fecha_doc').val();
  $.ajax({
    url:baseurl+"Tablaayuda/tipodecambio",
    data:{'fecha':fecha},
    type:"post",
    success:function(data){
    $('#tipocambio').val(data);
    }
  })

suma_total() ;
});
var Clicked = false;
window.onbeforeunload = confirmExit;

function confirmExit(){
  if (!Clicked) {
      return "¿Quieres salir de esta página?";
  }

}
$(document).on('change','#pto_venta',function(e){
    let pto_venta=$(this).val();
  $.ajax({
    url:baseurl+"Tablaayuda/ptoventa_almacen",
    data:{'pto_venta':pto_venta},
    type:"post",
    success:function(data){
      $('#almacen').val(data);
    }
  });
})

$(document).on('change','#cliente',function(e){
  let contacto=$(this).val();
  /*$.ajax({
    url:baseurl+"Tablaayuda/descuento",
    data:{'contacto':contacto},
    type:"post",
    success:function(data){
      $('#descuento').val(data/100);
      $('.newdescuento').val(data/100);

    }
  });*/
  if (contacto=="") {
    $('#btn_generar_cot').attr('disabled',true);
    $('#agregar_codigo').attr('disabled',true);
    $('#agregar_codigo_excel').attr('disabled',false);
  }else {
    $('#btn_generar_cot').attr('disabled',false);
    $('#agregar_codigo').attr('disabled',false);
    $('#agregar_codigo_excel').attr('disabled',false);
  }
  let x=$("#info_detalle tr");
      /*$.each(x,function(i,item){
        let cantidad=x.find(".newcant").val()
        var dscto=x.find(".newdescuento").val()
        let precio=x.find(".newprecio").val()
        x.find(".preciobrutounit").val(precio*(1-dscto));
           x.find(".descuentovalornew").val(cantidad*(precio*(dscto)));
        x.find(".subtotalnew").val(cantidad*(precio*(1-dscto)));
            suma_total();
      });*/
});

$(document).on('change','#cliente',function(e){
  let contacto=$(this).val();
  $.ajax({
    url:baseurl+"Tablaayuda/vendedor_cliente",
    data:{'contacto':contacto},
    type:"post",
    dataType:"json",
    success:function(data){
    $('#vendedor').val(data);
    }
  })
});
$(document).on('change','#cliente',function(e){
  let contacto=$(this).val();
  $.ajax({
    url:baseurl+"Tablaayuda/contactos",
    data:{'contacto':contacto},
    type:"post",
    dataType:"json",
    success:function(data){
      $('#form_cotizacion select[name=contacto]').find('option').remove();
      $.each(data,function(i,item){
          //$('#form_cotizacion select[name=contacto]').find('option:not(:first)').remove();
          $('#form_cotizacion select[name=contacto]').append('<option value="'+item.COD_CONTACTO+'">'+item.CONTACTO+'</option>');
      });

    }
  })
  $('.select2').select2({

  });
});
$(document).on('change','#fecha_doc',function(e){
  let fecha=$('#fecha_doc').val();
  $.ajax({
    url:baseurl+"Tablaayuda/tipodecambio",
    data:{'fecha':fecha},
    type:"post",
    success:function(data){
          $('#tipocambio').val(data);
    }
  });

});

$(document).on('change','#cliente',function(e){
  let cliente=$(this).val();
  $.ajax({
    url:baseurl+"Tablaayuda/direccion",
    data:{'cliente':cliente},
    type:"post",
    dataType:"json",
    success:function(data){
      $.each(data,function(i,item){
            $('#form_cotizacion select[name=direccion] option').remove();
          $('#form_cotizacion select[name=direccion]').append('<option value="'+item.cod_direccion+'">'+item.CDIRCLI+'</option>');
      });
    }
  })
});
$(document).on('change','#cliente',function(e){
  let cliente=$(this).val();
  $.ajax({
    url:baseurl+"Tablaayuda/get_forma_pago",
    data:{'cliente':cliente},
    type:"post",
    dataType:"json",
    success:function(data){
                  $('#form_cotizacion select[name=forma_pago]').find('option').remove();
      $.each(data,function(i,item){
            $('#form_cotizacion select[name=forma_pago]').append('<option value="'+item.COD_FP+'">'+item.DES_FP+'</option>');
      });
    }
  })
});
$(document).on('click','#buscar',function(e){
    var tipo=$('#tipo').val();
    var cadena=$('#cadena').val();
    var almacen=$('#almacen').val();
    $.post(baseurl+"Articulo/buscar/"+tipo+"/"+cadena+"/"+almacen,function(data){
      $('#tbl_lista').html(data);
    });
});

$(document).on('change','.newcant',function(e){
  var cantidad=$(this).val();
  if (cantidad<0) {
    $(this).val(0);
  }
});
$(document).on('click','.elegir',function(e){
  var fila=$(this).parent().parent();
  var codigo=fila.find('td').eq(0).html();
  var descripcion=fila.find('td').eq(1).html();
  var unidad=fila.find('td').eq(2).html();
  var stock=fila.find('td').eq(3).html();
  var precioori=fila.find('td').eq(4).html();
  var tipocambio=$('#tipocambio').val();
  if ($('#moneda').val()=='MN') {
  var precio=precioori*tipocambio;
  }else if ($('#moneda').val()=='ME') {
  var precio=precioori*1;
  }
  if ($('#descuento').val()!="") {
    var descuento=$('#descuento').val()*100;
  }else {
  var descuento=0;
  }

  $.ajax({
    url:baseurl+"Cargaexcel/agregar_fila",
    type:"post",
    data:'codigo='+codigo+'&descripcion='+descripcion+'&unidad='+unidad+'&stock='+stock+'&precio='+precio+'&descuento='+descuento,
    success: function(info){
      $('#tbl_detalle').html(info);
    },
    error: function (xhr, ajaxOptions, thrownError){
         alertify.error('Ocurrio un error');}
  });
suma_total() ;
});

$(document).on('click', '#btn_generar_cot', function(){
  alertify.confirm('Generar Cotizacion','Desea generar la cotizacion',function(){
  Clicked = true;
  var json="";
var json_total="";
       $("#tbl_detalle tbody tr").each(function () {
         json ="";
         $(this).find("td").each(function () {
               $this=$(this);
               if($this.attr("class")!='eliminar'){
                 if($this.attr("class")=="CDCODIGO" || $this.attr("class")=="CDUNIDAD"){
                   json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
               }else if($this.attr("class")=="CDDESCRI" || $this.attr("class")=="CDCANTID" || $this.attr("class")=="CDPREC_ORI" || $this.attr("class")=="CDPORDES" || $this.attr("class")=="subtotal" || $this.attr("class")=="CDTEXTO") {
                 json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
               }else if ($this.attr("class")=="PLAZO") {
                 json=json+',"'+$this.attr("class")+'":"'+$this.find(".editable").val()+'"';
                 json=json+',"CCTIPTIME":"'+$this.find(".dias").val()+'"';
               }
               }
         });
         obj=JSON.parse('{'+json.substr(1)+'}');
         json_total=json_total+','+JSON.stringify(obj);
     });
     var array_json=JSON.parse('['+json_total.substr(1)+']');
     $.ajax({
       url:baseurl+"Ventas/generar_cotizacion",
       type:"post",
       data:$('#form_cotizacion').serialize()+"&tbldetalle="+JSON.stringify(array_json),
       //dataType:json,
       beforeSend:function(){
         $('#btn_generar_cot').attr('disabled',true);
       },
       success: function(info){
         $('#btn_generar_cot').attr('disabled',true);
         if(info>=0){
           swal({
    title: "Cotizacion de Venta",
      type:"success",
        text: "¡¡Genial!! Se registro la cotizacion N° "+pad(info,7)+" !!!",
          timer: 5000,
            showConfirmButton: false
            });
            setTimeout("window.location.replace('"+baseurl+"Inicio/consultar_cotizaciones')",5000);
              var Clicked = false;
         }else {
             var Clicked = false;
           $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p></p> </div>');
           console.log(info);
         }
       },
       error: function (xhr, ajaxOptions, thrownError) {
            alertify.error('Ocurrio un error');
         }
     });
   },
   function(){
     alertify.error('Cancelado');
   }
 );
});

$(document).on('click', '#btn_editar_cot', function(){
  var fila=$('#info_detalle tbody').find('tr');

  $("#tbl_detalle tbody tr").each(function () {
      if ($(this).find('td').eq(0).html()!='TEXTO') {
    json =0;
      $(this).find("td").each(function () {
            $this=$(this);
            if(($this.find(".newprecio").val()=="0" || $this.find('.newprecio').val()=="0.00")){
              json++;
            }
      });
}
  });
if ($("#info_detalle tr").length==0 || $("#total_doc").val()==0) {
  alert('No se puede generar la cotizacion sin el detalle vacio');
}else {
if (json>0) {
  alert('No se puede generar la cotización por que existen artículos con precio en 0.00');
} else {
  alertify.confirm('Actualizar Cotizacion','Desea actualizar la cotizacion',function(){
    Clicked = true;
  var json="";
var json_total="";
       $("#tbl_detalle tbody tr").each(function () {
         json ="";
         $(this).find("td").each(function () {
               $this=$(this);
               if($this.attr("class")!='eliminar'){
                 if($this.attr("class")=="CDCODIGO" || $this.attr("class")=="CDUNIDAD"){
                   json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
               }else if($this.attr("class")=="CDDESCRI" || $this.attr("class")=="CDCANTID" || $this.attr("class")=="CDPREC_ORI" || $this.attr("class")=="CDPORDES" || $this.attr("class")=="subtotal" || $this.attr("class")=="CDTEXTO") {
                 json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
               }else if ($this.attr("class")=="PLAZO") {
                 json=json+',"'+$this.attr("class")+'":"'+$this.find(".editable").val()+'"';
                 json=json+',"CCTIPTIME":"'+$this.find(".dias").val()+'"';
               }
               }
         });
         obj=JSON.parse('{'+json.substr(1)+'}');
         json_total=json_total+','+JSON.stringify(obj);
     });
     var array_json=JSON.parse('['+json_total.substr(1)+']');
     $.ajax({
       url:baseurl+"Ventas/actualizar_cotizacion",
       type:"post",
       data:$('#form_cotizacion').serialize()+"&tbldetalle="+JSON.stringify(array_json),
       //dataType:json,
       beforeSend:function(){
         $('#btn_editar_cot').attr('disabled',true);
       },
       success: function(info){
         $('#btn_editar_cot').attr('disabled',true);
         if(info>=0){
           swal({
    title: "Cotizacion de Venta",
      type:"success",
        text: "¡¡Genial!! Se actualizo la cotizacion N° "+pad(info,7)+" !!!",
          timer: 5000,
            showConfirmButton: false
            });
                        setTimeout("window.location.replace('"+baseurl+"Inicio/consultar_cotizaciones')",5000);

         }else {
              $('#btn_generar_cot').attr('disabled',false);
           $('#msg').html('<div class="callout callout-danger"><h4>Error! Revise los datos ingresados y vuela a intentarlo</h4><p></p> </div>');
           console.log(info);
         }
       },
       error: function (xhr, ajaxOptions, thrownError) {
            alertify.error('Ocurrio un error');
         }
     });
   },
 function(){
   alertify.error('Cancelado');
 });
}
}
});

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

$(document).on('change','#moneda',function(e){
    var tipocambio=$('#tipocambio').val();
    //  let x=;
  $(this).find('option:first').remove();
      $("#tbl_detalle tbody tr").each(function(){
        var x=$(this);
    if ($('#moneda').val()=='MN') {
        var valor=x.find('.newprecio').val()*tipocambio;
         x.find('.newprecio').val(valor.toFixed(2));
    } else if($('#moneda').val()=='ME'){
      var valor=x.find('.newprecio').val()/tipocambio;
      x.find('.newprecio').val(valor.toFixed(2));
    }

        let cantidad=x.find(".newcant").val()
        var dscto=x.find(".newdescuento").val()
        let precio=x.find(".newprecio").val()
        x.find(".preciobrutounit").val((precio*(1-dscto)).toFixed(2));
           x.find(".descuentovalornew").val((cantidad*(precio*(dscto))).toFixed(2));
        x.find(".subtotalnew").val((cantidad*(precio*(1-dscto))).toFixed(2));
            suma_total();
      });


});


$(document).on('change','.editable',function(e){
  if ($(this).val()<0) {
    $(this).val(0);
  }
  var fila=$(this).parent().parent();
  let dias=$(this).val();
    var item=fila.find('td').eq(12).html();
    $.ajax({
      url:baseurl+"Ventas/actualizar_dias",
      type:"post",
      data:'item='+item+'&dias='+dias,
      success: function(info){
        suma_total();
      },
      error: function (xhr, ajaxOptions, thrownError) {
           alertify.error('Ocurrio un error');
        }
    });
});
$(document).on('change','.dias',function(e){
  if ($(this).val()<0) {
    $(this).val(0);
  }
  var fila=$(this).parent().parent();
  let tiempo=$(this).val();
    var item=fila.find('td').eq(12).html();
    $.ajax({
      url:baseurl+"Ventas/actualizar_tiempo",
      type:"post",
      data:'item='+item+'&tiempo='+tiempo,
      success: function(info){
        suma_total();
      },
      error: function (xhr, ajaxOptions, thrownError) {
           alertify.error('Ocurrio un error');
        }
    });
});
$(document).on('change','.desc',function(e){
  var fila=$(this).parent().parent();
  let tiempo=$(this).val();
    var item=fila.find('td').eq(12).html();
    $.ajax({
      url:baseurl+"Ventas/actualizar_descripcion",
      type:"post",
      data:'item='+item+'&desc='+tiempo,
      success: function(info){
        suma_total();
      },
      error: function (xhr, ajaxOptions, thrownError) {
           alertify.error('Ocurrio un error');
        }
    });
});


$(document).on('change','.newcant',function(e){
  if ($(this).val()<1) {
    $(this).val(1);
  }
  var fila=$(this).parent().parent();
  var precio=fila.find(".newprecio").val();
    var dscto=fila.find(".newdescuento").val();
  let cantidad=fila.find(this).val();
    let stock=fila.find(".stocktext").val();
  if ($(this).val()<=stock) {
    fila.find(".editable").val(0);
  }
    fila.find(".preciobrutounit").val((precio*(1-dscto)).toFixed(2));
     fila.find(".descuentovalornew").val((cantidad*(precio*(dscto))).toFixed(2));
  fila.find(".subtotalnew").val((precio*(1-dscto)*cantidad).toFixed(2));
  suma_total();
  var item=fila.find('td').eq(12).html();
    var codigo=fila.find('td').eq(0).html();
  $.ajax({
    url:baseurl+"Ventas/actualizar_cantidad",
    type:"post",
    data:'item='+item+'&cantidad='+cantidad,
    success: function(info){
      suma_total();
      $.ajax({
        url:baseurl+"Articulo/buscar_stock",
        type:"post",
        data:"codigo="+codigo,
        success: function(data){
          console.log(data);
          if (fila.find(".newcant").val()<=data) {
            fila.find(".editable").val(0);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
             alertify.error('Ocurrio un error');
          }
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
         alertify.error('Ocurrio un error');
      }
  });
});


$(document).on('change','.newdescuento',function(e){
  if ($(this).val()<0) {
    $(this).val(0);
  }
  var fila=$(this).parent().parent();
  let cantidad=fila.find(".newcant").val()
  var dscto=fila.find(".newdescuento").val()
  let precio=fila.find(".newprecio").val()
    var item=fila.find('td').eq(0).html();
  fila.find(".preciobrutounit").val((precio*(1-dscto)).toFixed(2));
     fila.find(".descuentovalornew").val((cantidad*(precio*(dscto))).toFixed(2));
  fila.find(".subtotalnew").val((cantidad*(precio*(1-dscto))).toFixed(2));
suma_total();
$.ajax({
  url:baseurl+"Ventas/actualizar_descuento",
  type:"post",
  data:'item='+item+'&descuento='+dscto,
  success: function(info){
    suma_total();
  },
  error: function (xhr, ajaxOptions, thrownError) {
       alertify.error('Ocurrio un error');
    }
});
});
$(document).on('change','.newprecio',function(e){
  if ($(this).val()<0) {
    $(this).val(0);
  }
  var fila=$(this).parent().parent();
  let cantidad=fila.find(".newcant").val();
  var dscto=fila.find(".newdescuento").val();
  let precio=fila.find(".newprecio").val();
      var item=fila.find('td').eq(14).html();
  fila.find(".preciobrutounit").val((precio*(1-dscto)).toFixed(2));
     fila.find(".descuentovalornew").val((cantidad*(precio*(dscto))).toFixed(2));
  fila.find(".subtotalnew").val((cantidad*(precio*(1-dscto))).toFixed(2));
suma_total();
$.ajax({
  url:baseurl+"Ventas/actualizar_precio",
  type:"post",
  data:'item='+item+'&precio='+precio,
  success: function(info){
    suma_total();
  },
  error: function (xhr, ajaxOptions, thrownError) {
       alertify.error('Ocurrio un error');
    }
});
});

$(document).on('click','#btn_confirmar_req',function(e){
  alert($('.tiempo').val());
});


$(document).on('click', '.btn_remove', function() {
  var item = $(this).attr("data-id");
  var fila=$(this).parent().parent();
  var codigo=fila.find('td').eq(0).html();

  $.ajax({
    url:baseurl+"Cargaexcel/eliminarfila",
    type:"post",
    data:'item='+item+'&codigo='+codigo,
    beforeSend:function(){
      $(this).attr('disabled',true);
    },
    success: function(info){
      $(this).attr('disabled',false);
    $('#tbl_detalle').html(info);
    suma_total();
    },
    error: function (xhr, ajaxOptions, thrownError){
    alertify.error('Ocurrio un error');
    }
  });

  });


  $(document).on('change', '#descuento', function() {
    /*var descuento=$(this).val();
    var subtotal=$('#subtotal').val();

    $('#dsct_cliente_valor').val(subtotal*descuento);*/
    suma_total();
    });

    $(document).on('change', '#descuento_esp', function() {
    /*  var descuento=$(this).val();
      var subtotal=$('#subtotal').val();

      $('#dsct_esp_valor').val(subtotal*descuento);*/
      suma_total();
      });
      $(document).on('change', '#tipocot', function() {
        var tipo=$('#tipocot').val();
        if (tipo=='NAC') {
          $('#igvpor').val(0.18);
        }else {
          $('#igvpor').val(0);
        }
        suma_total();
        });
        function suma_total(){
            var sum=0;
            var desc=0;
            $('.subtotalnew').each(function() {
                sum += Number($(this).val());
            });
            $('.descuentovalornew').each(function() {
                desc += Number($(this).val());
            });
            var bruto=(sum+desc);
            $('#subtotal').val(bruto.toFixed(2));
          //  $('#descuento').val(desc);
            var subtotal=  $('#subtotal').val();
          /* var descuento_esp= 0; $('#descuento_esp').val();
            var dsct_esp_valor=  0;*/
            //var descuento=$('#descuento').val();
            var dsct_cliente_valor=  $('#dsct_cliente_valor').val(desc.toFixed(2));
            var descuento_total=(dsct_cliente_valor);

            var valor_venta=  $('#valor_venta').val();
            var a= $('#subtotal').val()  -  $('#dsct_cliente_valor').val();
            var c=$('#valor_venta').val(a.toFixed(2));
            var porigv=$('#igvpor').val();
            var igv=$('#igv').val((a*porigv).toFixed(2));
            $('#total_doc').val((a+a*porigv).toFixed(2));
        }
$(document).on('click','#duplicar_cotizacion',function(e){
  e.preventDefault();
  Clicked = true;
  var id=$('#numdoc').val();
    alertify.confirm('Duplicar Cotizacion', '¿Desea generar una nueva cotizacion en base a la cotizacion N°'+pad(id,7)+'?',

    function (){
      window.location.href=baseurl+"Ventas/duplicar_cotizacion/"+id+"/duplicar";
    } ,
    function(){alertify.error('Cancelado');
  });
});

$(document).on('click','#btn_cargaexcel',function(e){
  var formData = new FormData(document.getElementById("form_envio_excel"));
  if ($('#descuento').val()!="") {
      var descuento=$('#descuento').val();
  }else {
    var descuento=0;
  }
  $.ajax({
      url:baseurl+"Cargaexcel/cargartemporal",
      type:"post",
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $('#tbl_detalle').html('<div><h3>Cargando excel....</h3></div>');
      },
      success:function(data){
          $('#tbl_detalle').html(data);
          suma_total();
        }

          });

  });

  $(document).on('click','#generar_pedido',function(){
        var id=$('#numdoc').val();
    $('#cotizacion').val(id);
  	$('.modal-title').html('<strong>Cotización: '+pad(id,7)+'</strong>');
    $.post(baseurl+'Ventas/atender_cotizacion/'+id,function(data){
  $('#tbl_pedido').html(data);

    });
  })
  function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }
  $(document).on('change','.cant_aten',function(e){

  let valor=$(this).val();
  var fila=$(this).parent().parent();
  let cantpend=fila.find('td').eq(4).html();
  if(cantpend<$(this).val()){
    alert("La cantidad atendida supera la cantidad pendiente");
    $(this).val(cantpend);
  }
  });


  $(document).on('click','#crear_pedido',function(e){
    alertify.confirm('Mensaje de confirmación',
                    '¿Está seguro de generar la orden de venta?',
                    function(){
                      var json="";
                      var json_total="";
                              $("#tbl_detalle tbody tr").each(function () {
                                json ="";
                                $(this).find("td").each(function () {
                                      $this=$(this);
                                      if($this.attr("class")=='CDCODIGO' || $this.attr("class")=='CDSECUEN' || $this.attr("class")=='CDSECUEN'){
                                        json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
                                      }else if($this.attr("class")=="ATENDER"){
                                        json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
                                      }
                                });
                                obj=JSON.parse('{'+json.substr(1)+'}');
                                json_total=json_total+','+JSON.stringify(obj);
                            });
                      var array_json=JSON.parse('['+json_total.substr(1)+']');
                      $.ajax({
                        url:baseurl+"Ventas/generar_orden",
                        type:"post",
                        data:"cotizacion="+$('#cotizacion').val()+"&tbldetalle=" + JSON.stringify(array_json),
                          dataType:'json',
                        beforeSend:function(){
                          $('#crar_pedido').prop('disabled',true);
                        },
                        success: function(data){
                          $('.modal.in').modal('hide');
                          alertify.success(data);
                             $('#crar_pedido').prop('disabled',false);
                          //  window.open(baseurl+"Requerimiento/despacho_compra_doc?despacho="+data.last_id+"");
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
  $(document).on('click','.addFila', function() {
    var item = $(this).attr("data-id");
    var fila=$(this).parent().parent();
    var codigo=fila.find('td').eq(0).html();
    var descripcion=fila.find('.desc').val();
    var unidad=fila.find('td').eq(2).html();
    var cantidad=fila.find('.newcant').val();
    var dias=fila.find('.editable').val();
    var tiempo=fila.find('.dias').val();
    var precio=fila.find('.newprecio').val();
    var descuento=fila.find('.newdescuento').val();
    var stock=fila.find('.stocktext').val();
    $.ajax({
      url:baseurl+"Cargaexcel/duplicarfila",
      type:"post",
      data:'item='+item+'&codigo='+codigo+'&stock='+stock+'&descripcion='+descripcion+'&precio='+precio+'&descuento='+descuento+'&unidad='+unidad+'&cantidad='+cantidad+'&dias='+dias+'&tiempo='+tiempo,
      beforeSend:function(){
        $(this).prop('disabled',true);
      },
      success: function(info){
        $(this).prop('disabled',false);
      $('#tbl_detalle').html(info);
            suma_total();
      },
      error: function (xhr, ajaxOptions, thrownError){
      alertify.error('Ocurrio un error');
      }
    });

  });
  $(document).on('click','#analisis_btn',function(e){
    if ($("#info_detalle tr").length==0) {
      alert("Debe ingresar artículos al detalle para realizar el analisis de precios");
    }else {
      $('#analisis').modal('show');
      var json="";
    var json_total="";
           $("#tbl_detalle tbody tr").each(function () {
             json ="";
             $(this).find("td").each(function () {
               $this=$(this);
               if($this.attr("class")!='eliminar'){
                 if($this.attr("class")=="CDCODIGO" ){
                   json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
               }else if ($this.attr("class")=="CDPREC_ORI" || $this.attr("class")=="CDPORDES") {
                    json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
               }
               }
             });
             obj=JSON.parse('{'+json.substr(1)+'}');
             json_total=json_total+','+JSON.stringify(obj);
         });

         var array_json=JSON.parse('['+json_total.substr(1)+']');
         $.ajax({
           url:baseurl+"Ventas/analisis_precios",
           type:"post",
           data:"tbldetalle="+JSON.stringify(array_json),
           beforeSend:function(){
             $('#tbl_analisis').html('<center><img src="'+baseurl+'/assets/img/carga.gif" height="2%" width="2%"><h6>Espere por favor...</h6> </center><br> ');
           },
           success: function(data){
             $('#tbl_analisis').html(data);
             $('#tbl_analisisexcel').DataTable(
               {
             dom: 'Bfrtip',
             buttons: [
                 {
                     extend: 'excel',
                     title: 'Análisis de Precios'
                 }
             ]
         }
             )
             }
         });
    }
  });
