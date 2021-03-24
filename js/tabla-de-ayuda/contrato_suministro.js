$(document).ready(function(){
	control_de_menu($('#menu_contrato_suministro'));
    });

$(document).on('change','#mes',function(){
  if ($(this).val()!=0) {
    var id=$(this).val();
          $.post(baseurl+"Ventas/consultar_suministro/"+id,function(data){
            $('#tbl_meta').html(data);
          })

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
                  if ($this.attr("class")=="semana") {
                        json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
                    }
              if ($this.attr("class")=="monto") {
                    json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
                }
            });
            obj=JSON.parse('{'+json.substr(1)+'}');
            json_total=json_total+','+JSON.stringify(obj);
            item++;
        });
  var array_json=JSON.parse('['+json_total.substr(1)+']');
  $.ajax({
    url:baseurl+"Ventas/contrato_suministro",
    type:"post",
    data:"mes="+$('#mes').val()+"&tbldetalle=" + JSON.stringify(array_json),
    dataType:'json',
    success: function(data){
       if(data==0){
        $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p></p> </div>');
        console.log(data);
      }else {
        swal({
         title: "Facturación de Suministro",
           type:"success",
             text: "¡¡Genial!! Se guardaron los montos facturados semanales !!!",
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
