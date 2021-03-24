$(document).ready(function(){
	control_de_menu($('#menu_meta_venta'));
    });

$(document).on('change','#año',function(){
  if ($(this).val()!=0) {
    var id=$(this).val();
          $.post(baseurl+"Ventas/consultar_meta/"+id,function(data){
            $('#tbl_meta').html(data);
          })

          if($('#año_actual').val()>id){
            $('.meta_tercero').attr('readonly'.true);
            $('.meta_relacionada').attr('readonly'.true);
          }
                    $('.año').html(id);
  }
})

$(document).on('click','#guardar_meta',function(){
  var json="";
  var json_total="";
                var item=1;
          $("#tbl_data tbody tr").each(function () {
            json ="";

            $(this).find("td").each(function () {
                  $this=$(this);
              if ($this.attr("class")=="relacionado" || $this.attr("class")=="tercero" || $this.attr("class")=="diasextra") {
                    json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
                }
            });
            obj=JSON.parse('{'+json.substr(1)+'}');
            json_total=json_total+','+JSON.stringify(obj);
            item++;
        });
  var array_json=JSON.parse('['+json_total.substr(1)+']');
  $.ajax({
    url:baseurl+"Ventas/meta_venta",
    type:"post",
    data:"año="+$('#año').val()+"&tbldetalle=" + JSON.stringify(array_json),
    dataType:'json',
    success: function(data){
       if(data==0){
        $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p></p> </div>');
        console.log(data);
      }else {
        swal({
         title: "Meta de Ventas",
           type:"success",
             text: "¡¡Genial!! Se guardaron los montos para las metas !!!",
               timer: 3000,
                 showConfirmButton: false
                 });
      location.reload();

      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alertify.error('Ocurrio un Error');
            }

  });


})
