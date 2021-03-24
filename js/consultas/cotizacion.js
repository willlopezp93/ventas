

$(document).ready(function(){
  control_de_menu($('#consultar_cot'));
  $('#tbl_cotizaciones').DataTable({
        dom:'Bfrtp',
        buttons: [
            {
                text: '<i class="glyphicon glyphicon-pencil"></i>',
                className: 'btn-lg bg-light-blue-active color-palette verdetallereq disabled',
                action: function ( e, dt, node, config ) {
                  e.preventDefault();
                  var id=$('#cotizacion').val();
                      window.location.href=baseurl+"Ventas/duplicar_cotizacion/"+id+"/atender";
                }
            },
            {
                text: '<i class="glyphicon glyphicon-usd"></i>',
                className:'btn-lg bg-green-active color-palette veranalisis disabled',
                action: function ( e, dt, node, config ) {
                  var id=$('#cotizacion').val();
                    $('#analisis').modal('show');
                  $.post(baseurl+"Ventas/consultar_analisis/"+id,function(data){
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
                  });

                }
            },
            {
                text: '<i class="glyphicon glyphicon-print"></i>',
                className:'btn-lg bg-orange-active color-palette reporte disabled',
                action: function ( e, dt, node, config ) {
                  var id=$('#cotizacion').val();
                  window.open(baseurl+"Reporte/cotizacion/"+id+"/","_blank");

                }
            },
            {
                text: 'EN',
                className:'btn-lg bg-orange-active color-palette reporte disabled',
                action: function ( e, dt, node, config ) {
                  var id=$('#cotizacion').val();
                  window.open(baseurl+"Reporte/cotizacion_en/"+id+"/","_blank");

                }
            }/*,
            {
                text: '<i class="glyphicon glyphicon-envelope"></i>',
                className:'btn-lg bg-yellow-active color-palette reporte_correo disabled',
                action: function ( e, dt, node, config ) {
                  var id=$('#cotizacion').val();
                  window.open(baseurl+"Reporte/correo_cotizacion/"+id+"/","_blank");

                }
            }*/
        ],
		"pagin":true,
        order: [[ 1, "desc" ]],

    } );

});
$(document).on('click', '#tbl_cotizaciones tbody tr', function () {
    //  var data = tbl_usuarios.row( this ).data();
      var id=$(this).find('td').eq(0).html();

      $('tr').removeClass('info');
      $(this).addClass('info');
      $('#cotizacion').val(id);

      $('.verdetallereq').removeClass( "disabled" );
      $('.veranalisis').removeClass( "disabled" );
      $('.reporte').removeClass( "disabled" );
      $('.reporte_correo').removeClass( "disabled" );
  } );
/*  $(document).on('click','#export_excel',function(){
    var json="";
  var json_total="";
         $("#tbl_analisisexcel tbody tr").each(function () {
           json ="";
           $(this).find("td").each(function () {
             $this=$(this);
             if($this.attr("class")=='excel_CDCODIGO' || $this.attr("class")=='excel_CDMARGEN' || $this.attr("class")=='excel_MARGEN_REF' || $this.attr("class")=='excel_COSTO_REF' ||  $this.attr("class")=='excel_descripcion' || $this.attr("class")=='excel_precio1' || $this.attr("class")=='excel_precio2' || $this.attr("class")=='excel_precio3' || $this.attr("class")=='excel_CDPREC_ORI' || $this.attr("class")=='excel_CDPORDES' || $this.attr("class")=='excel_CDPRENET' ){
                   json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
             }
           });
           obj=JSON.parse('{'+json.substr(1)+'}');
           json_total=json_total+','+JSON.stringify(obj);
       });
       var array_json=JSON.parse('['+json_total.substr(1)+']');

       window.open(baseurl+"Ventas/excel_analisis?tbldetalle="+JSON.stringify(array_json));

  });*/
