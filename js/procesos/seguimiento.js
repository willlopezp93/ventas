$(document).ready(function(){
	control_de_menu($('#menu_seguimiento'));
    });

		$(document).on('click','#consultar',function(){
		  var fecha_inicio=$('#fecha_inicio').val();
		  var fecha_fin=$('#fecha_fin').val();

		  $.ajax({
		    url:baseurl+"Ventas/listar_pedidos",
		    data:"fecha_fin="+fecha_fin+"&fecha_inicio="+fecha_inicio,
		    type:"post",
		    success:function(data){
		      $('#listar_pedidos').html(data);
		      $('#tbl_cotizaciones').DataTable({
				        "order": [[ 1, "desc" ]]
				    });
		    }
		  })
		})

      $(document).on('click','.add',function () {
        if ($('#tbl_areas tbody tr').length <4) {
          addTableRow($("#tbl_areas"));
          return false;
        }
    });
    $("button.addstyle").click(function () {
        $('.acpreven').selectize({
              maxItems: 3
              });
        $("button.addstyle").disabled();
      });


      $(document).on('click','.remove_button',function(){
          if ( $('#tbl_areas tbody tr').length == 1) return;
          $(this).parents("tr").fadeOut('slow', function () {
              $(this).remove();
              rowCount = 0;
              $("#tbl_areas tr td:first-child").text(function () {
                  return ++rowCount;
              });
          });
      });
$(document).on('click','.ver_detalle',function(){
  var id=$(this).attr('data-id');
        $.post(baseurl+"Ventas/consultar_detalle_pendiente/"+id,function(data){
          $('#div_pedido').html(data);
        })
})
$(document).on('click','.retroceder',function(){
    window.location.href = baseurl+'Inicio/seguimiento';
})

$(document).on('click','.ver_areas',function(){
  $('#modal-areas').modal('show');
  var fila=$(this).parent().parent()
  var item=fila.find('td').eq(0).html();
  var codigo=fila.find('td').eq(1).html();
  var descripcion=fila.find('td').eq(2).html();
  var pedido=$('#pedido').val();
  $('#modal_titulo').text('ITEM '+item+'- '+codigo+':'+descripcion);
    $('#pedido_det').val(pedido);
    $('#DFSECUEN').val(item);
    $('#DFCODIGO').val(codigo);
    $.post(baseurl+"Ventas/consultar_areas_seguimiento/"+pedido+"/"+item,function(data){
      $('#form_pedido_det').html(data);
    })
})


  function addTableRow(table) {

      var $tr = $(table).find("tbody tr:last").clone();
      $tr.find("input").attr("name", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
      }).attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
      });

       $tr.find("select").attr("name", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
      }).attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
            });
      $(table).find("tbody tr:last").after($tr);
      $tr.hide().fadeIn('slow');
      rowCount = 0;
      $("#tbl_areas tr td:first-child").text(function () {
          return ++rowCount;
      });
      $(".remove_button").on("click", function () {
          if ( $('#tbl_areas tbody tr').length == 1) return;
          $(this).parents("tr").fadeOut('slow', function () {
              $(this).remove();
              rowCount = 0;
              $("#tbl_areas tr td:first-child").text(function () {
                  return ++rowCount;
              });
          });
      });

  };
  $(document).on('click','#guardar_seguimiento',function(){
    var json="";
    var json_total="";
                  var item=1;
            $("#tbl_areas tbody tr").each(function () {
              json ="";

              $(this).find("td").each(function () {
                    $this=$(this);
                if($this.attr("class")!='eliminar'){
                if ($this.attr("class")=="fecha_inicio" || $this.attr("class")=="fecha_fin" || $this.attr("class")=="fecha_termino") {
                      json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
                  }else if($this.attr("class")=="areatd"){
                    json=json+',"'+$this.attr("class")+'":"'+$this.find(".area_asignada").val()+'"';
                  }
                      }
              });
              obj=JSON.parse('{'+json.substr(1)+'}');
              json_total=json_total+','+JSON.stringify(obj);
              item++;
          });
    var array_json=JSON.parse('['+json_total.substr(1)+']');
    $.ajax({
      url:baseurl+"Ventas/seguimiento",
      type:"post",
      data:"pedido="+$('#pedido_det').val()+"&DFCODIGO="+$('#DFCODIGO').val()+"&DFSECUEN="+$('#DFSECUEN').val()+"&tbldetalle=" + JSON.stringify(array_json),
      dataType:'json',
      success: function(data){
         if(data==0){
          $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p></p> </div>');
          console.log(data);
        }else {
          swal({
   title: "Asignación de Responsables",
     type:"success",
       text: "¡¡Genial!! Se asignaron las áreas responsables para el item !!!",
         timer: 3000,
           showConfirmButton: false
           });
        //   setTimeout("window.location.replace('"+baseurl+"Inicio/seguimiento')",3000);

        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alertify.error('Ocurrio un Error');
              }

    });


  })
