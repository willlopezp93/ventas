
/*$(document).on('change','#hoy',function(e){
  var fecha=$('#hoy').val();
  var dias=$('#plazo').val();
  $.ajax({
    type:"post",
    data:"fecha="+fecha + "&dias="+dias,
    url:baseurl+"Support/dia_entrega",
    success:function(data){
          $('#entrega').val(data);
    }
  });
});
$(document).on('change','#plazo',function(e){
  var fecha=$('#hoy').val();
  var dias=$('#plazo').val();
  $.ajax({
    type:"post",
    data:"fecha="+fecha + "&dias="+dias,
    url:baseurl+"Support/dia_entrega",
    success:function(data){
          $('#entrega').val(data);
    }
  });
});
$(document).ready(function ($) {
  // trigger event when button is clicked
  $("button.add").click(function () {
      // add new row to table using addTableRow function
      addTableRow($("table"));

      // prevent button redirecting to new page
      return false;

  });

  $("button.addstyle").click(function () {
      $('.acpreven').selectize({
            maxItems: 3
            });
      $("button.addstyle").disabled();
    });

  // function to add a new row to a table by cloning the last row and
  // incrementing the name and id values by 1 to make them unique
  function addTableRow(table) {

      // clone the last row in the table
      var $tr = $(table).find("tbody tr:last").clone();


      // get the name attribute for the input and select fields
      $tr.find("input").attr("name", function () {
          // break the field name and it's number into two parts
          var parts = this.id.match(/(\D+)(\d+)$/);
          // create a unique name for the new field by incrementing
          // the number for the previous field by 1
          //return parts[1] + ++parts[2];

          // repeat for id attributes
      }).attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          //return parts[1] + ++parts[2];
      });

       $tr.find("select").attr("name", function () {
          // break the field name and it's number into two parts
          var parts = this.id.match(/(\D+)(\d+)$/);
          // create a unique name for the new field by incrementing
          // the number for the previous field by 1
          //return parts[1] + ++parts[2]+"[]";

          // repeat for id attributes
      }).attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          //return parts[1] + ++parts[2];
      });

      // append the new row to the table
      $(table).find("tbody tr:last").after($tr);
      $tr.hide().fadeIn('slow');

      // row count


      rowCount = 0;
      $("#table tr td:first-child").text(function () {
          return ++rowCount;
      });



      // remove rows
      $(".remove_button").on("click", function () {
          if ( $('#table tbody tr').length == 1) return;
          $(this).parents("tr").fadeOut('slow', function () {
              $(this).remove();
              rowCount = 0;
              $("#table tr td:first-child").text(function () {
                  return ++rowCount;
              });
          });
      });

  };
});
$(document).on('change','.cant',function(){
  var dias=$(this).val();
  var fila=$(this).parent().parent();
  var fecha=fila.find('.fecha').val();
  $.ajax({
    type:"post",
    data:"fecha="+fecha + "&dias="+dias,
    url:baseurl+"Support/dia_entrega",
    success:function(data){
          fila.find('.fin').val(data);
    }
});
});
$(document).on('change','.fecha',function(){
  var fecha=$(this).val();
  var fila=$(this).parent().parent();
  var dias=fila.find('.cant').val();
  $.ajax({
    type:"post",
    data:"fecha="+fecha + "&dias="+dias,
    url:baseurl+"Support/dia_entrega",
    success:function(data){
          fila.find('.fin').val(data);
    }
});
});
$(document).on('click','#guardar',function(){
  var json="";
var json_total="";
       $("#table tbody tr").each(function () {
         json ="";
         $(this).find("td").each(function () {
           $this=$(this);
           if($this.attr("class")!='remove'){
             if($this.attr("class")=="item"){
               json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
           }else if($this.attr("class")=="actividad" || $this.attr("class")=="fechainicio" || $this.attr("class")=="dias" || $this.attr("class")=="fechafin") {
             json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
           }else if ($this.attr("class")=="proceso") {
               json=json+',"'+$this.attr("class")+'":"'+$this.find("select").val()+'"';
           }
           }
         });
         obj=JSON.parse('{'+json.substr(1)+'}');
         json_total=json_total+','+JSON.stringify(obj);
     });
     var array_json=JSON.parse('['+json_total.substr(1)+']');

     $.ajax({
       url:baseurl+"Support/guardar_proyecto",
       type:"post",
       data:"proyecto="+$('#proyecto').val()+"&tbldetalle="+JSON.stringify(array_json),
       success: function(data){
         alertify.success(data);
       },
       error: function (xhr, ajaxOptions, thrownError) {
            alertify.error('Ocurrio un error');
         }
     });
});

$(document).on('click','#gantt',function(){
  $.ajax({
    url:baseurl+"Support/gantt/"+1,
    type:"post",
    dataType:"json",
    success:function(data){

               var g = new JSGantt.GanttChart(document.getElementById('GanttChartDIV'),'day');

               g.setOptions({
                 vCaptionType: 'Complete',  // Set to Show Caption : None,Caption,Resource,Duration,Complete,
                 vQuarterColWidth: 36,
                 vDateTaskDisplayFormat: 'day dd month yyyy', // Shown in tool tip box
                 vDayMajorDateDisplayFormat: 'mon yyyy - Week ww',// Set format to dates in the "Major" header of the "Day" view
                 vWeekMinorDateDisplayFormat: 'dd mon', // Set format to display dates in the "Minor" header of the "Week" view
                 vLang: 'es',
                 vShowTaskInfoLink: 1, // Show link in tool tip (0/1)
                 vShowEndWeekDate: 0,  // Show/Hide the date for the last day of the week in header for daily
                 vAdditionalHeaders: { // Add data columns to your table
                     category: {
                       title: 'Category'
                     },
                     sector: {
                       title: 'Sector'
                     }
                   },
                 vUseSingleCell: 10000, // Set the threshold cell per table row (Helps performance for large data.
                 vFormatArr: ['Day', 'Week', 'Month', 'Quarter'], // Even with setUseSingleCell using Hour format on such a large chart can cause issues in some browsers,

               });
             g.AddTaskItemObject({
               "pID": 1000,
               "pName": "Inicio",
               "pStart":  "2019-01-01",
               "pEnd": "2019-07-31",
          //     "pPlanStart": "2019-01-01" ,
          //     "pPlanEnd": "2019-07-31",
               "pClass": "ggroupblack",
               "pLink": "",
               "pMile": 0,
               "pRes": "Brian",
               "pComp": 0,
               "pGroup": 1,
               "pParent": 0,
               "pOpen": 1,
               "pDepend": "",
               "pCaption": "",
               "pCost": 1000,
               "pNotes": "Some Notes text",
               "category": "My Category",
               "sector": "Finance"
             });
             $.each( data, function( key, value ) {
              if (value.proceso==1) {
                 g.AddTaskItemObject({
                   "pID": value.id,
                   "pName": value.actividad,
                   "pStart": value.fecha_inicio,
                   "pEnd": value.fecha_fin,
        //           "pPlanStart": value.fecha_inicio,
          //         "pPlanEnd": value.fecha_fin+' 12:00',
                   "pClass": "gtaskblue",
                   "pLink": "",
                   "pMile": 0,
                   "pRes": "Brian",
                   "pComp": 0,
                   "pGroup": 0,
                   "pParent": 1000,
                   "pOpen": 1,
                   "pDepend": "",
                   "pCaption": "",
                   "pCost": 0,
                   "pNotes": "Some Notes text",
                   "category": "My Category",
                   "sector": "Finance"
                 });
               }     console.log(key+':'+value);
      });
      g.AddTaskItemObject({
        "pID": 2000,
        "pName": "Ejecucion",
        "pStart":  "2019-01-01",
        "pEnd": "2019-07-31",
      //  "pPlanStart": "2019-01-01" ,
      //  "pPlanEnd": "2019-07-31",
        "pClass": "ggroupblack",
        "pLink": "",
        "pMile": 0,
        "pRes": "Brian",
        "pComp": 0,
        "pGroup": 1,
        "pParent": 0,
        "pOpen": 1,
        "pDepend": "",
        "pCaption": "",
        "pCost": 1000,
        "pNotes": "Some Notes text",
        "category": "My Category",
        "sector": "Finance"
      });
      $.each( data, function( key, value ) {
       if (value.proceso==2) {
          g.AddTaskItemObject({
            "pID": value.id,
            "pName": value.actividad,
            "pStart": value.fecha_inicio,
            "pEnd": value.fecha_fin,
        //    "pPlanStart": value.fecha_inicio,
        //    "pPlanEnd": value.fecha_fin+' 12:00',
            "pClass": "gtaskred",
            "pLink": "",
            "pMile": 0,
            "pRes": "Brian",
            "pComp": 0,
            "pGroup": 0,
            "pParent": 2000,
            "pOpen": 1,
            "pDepend": "",
            "pCaption": "",
            "pCost": 0,
            "pNotes": "Some Notes text",
            "category": "My Category",
            "sector": "Finance"
          });
        }
});
g.AddTaskItemObject({
  "pID": 3000,
  "pName": "Pruebas",
  "pStart":  "2019-01-01",
  "pEnd": "2019-07-31",
//  "pPlanStart": "2019-01-01" ,
//  "pPlanEnd": "2019-07-31",
  "pClass": "ggroupblack",
  "pLink": "",
  "pMile": 0,
  "pRes": "Brian",
  "pComp": 0,
  "pGroup": 1,
  "pParent": 0,
  "pOpen": 1,
  "pDepend": "",
  "pCaption": "",
  "pCost": 0,
  "pNotes": "Some Notes text",
  "category": "My Category",
  "sector": "Finance"
});
$.each( data, function( key, value ) {
 if (value.proceso==3) {
    g.AddTaskItemObject({
      "pID": value.id,
      "pName": value.actividad,
      "pStart": value.fecha_inicio,
      "pEnd": value.fecha_fin,
    //  "pPlanStart": value.fecha_inicio,
    //  "pPlanEnd": value.fecha_fin+' 12:00',
      "pClass": "gtaskyellow",
      "pLink": "",
      "pMile": 0,
      "pRes": "Brian",
      "pComp": 0,
      "pGroup": 0,
      "pParent": 3000,
      "pOpen": 1,
      "pDepend":"",
      "pCaption": "",
      "pCost": 0,
      "pNotes": "Some Notes text",
      "category": "My Category",
      "sector": "Finance"
    });
  }
});
g.AddTaskItemObject({
  "pID": 4000,
  "pName": "Produccion",
  "pStart":  "2019-01-01",
  "pEnd": "2019-07-31",
//  "pPlanStart": "2019-01-01" ,
//  "pPlanEnd": "2019-07-31",
  "pClass": "ggroupblack",
  "pLink": "",
  "pMile": 0,
  "pRes": "Brian",
  "pComp": 0,
  "pGroup": 1,
  "pParent": 0,
  "pOpen": 1,
  "pDepend": "",
  "pCaption": "",
  "pCost": 0,
  "pNotes": "Some Notes text",
  "category": "My Category",
  "sector": "Finance"
});
$.each( data, function( key, value ) {
 if (value.proceso==4) {
    g.AddTaskItemObject({
      "pID": value.id,
      "pName": value.actividad,
      "pStart": value.fecha_inicio,
      "pEnd": value.fecha_fin,
      //"pPlanStart": value.fecha_inicio,
    //  "pPlanEnd": value.fecha_fin+' 12:00',
      "pClass": "gtaskgreen",
      "pLink": "",
      "pMile": 0,
      "pRes": "Brian",
      "pComp": 0,
      "pGroup": 0,
      "pParent": 4000,
      "pOpen": 1,
      "pDepend": "",
      "pCaption": "",
      "pCost": 0,
      "pNotes": "Some Notes text",
      "category": "My Category",
      "sector": "Finance"
    });
  }
});

g.AddTaskItemObject({
  "pID": 5000,
  "pName": "Cierre",
  "pStart":  "2019-01-01",
  "pEnd": "2019-07-31",
//  "pPlanStart": "2019-01-01" ,
//  "pPlanEnd": "2019-07-31",
  "pClass": "ggroupblack",
  "pLink": "",
  "pMile": 0,
  "pRes": "Brian",
  "pComp": 0,
  "pGroup": 1,
  "pParent": 0,
  "pOpen": 1,
  "pDepend": "",
  "pCaption": "",
  "pCost": 0,
  "pNotes": "Some Notes text",
  "category": "My Category",
  "sector": "Finance"
});
$.each( data, function( key, value ) {
 if (value.proceso==5) {
    g.AddTaskItemObject({
      "pID": value.id,
      "pName": value.actividad,
      "pStart": value.fecha_inicio,
      "pEnd": "2019-05-03",
  //    "pPlanStart": value.fecha_inicio,
    //  "pPlanEnd": "2019-04-15 12:00",
      "pClass": "gtaskbrown",
      "pLink": "",
      "pMile": 0,
      "pRes": "Brian",
      "pComp": 0,
      "pGroup": 0,
      "pParent": 5000,
      "pOpen": 1,
      "pDepend": "",
      "pCaption": "",
      "pCost": 0,
      "pNotes": "Some Notes text",
      "category": "My Category",
      "sector": "Finance"
    });
  }
});
      g.Draw();}
    });
  });*/


  /*  anychart.onDocumentReady(function () {
       // create data
       var data = [
         {
           id: "1",
           name: "Development",
           actualStart: "2018-01-15",
           actualEnd: "2018-03-10",
           children: [
             {
               id: "1_1",
               name: "Analysis",
               actualStart: "2018-01-15",
               actualEnd: "2018-01-25"
             },
             {
               id: "1_2",
               name: "Design",
               actualStart: "2018-01-20",
               actualEnd: "2018-02-04"
             },
             {
               id: "1_3",
               name: "Meeting",
               actualStart: "2018-02-05",
               actualEnd: "2018-02-05"
             },
             {
               id: "1_4",
               name: "Implementation",
               actualStart: "2018-02-05",
               actualEnd: "2018-02-24"
             },
             {
               id: "1_5",
               name: "Testing",
               actualStart: "2018-02-25",
               actualEnd: "2018-03-10"
             }
         ]}
       ];/*
 *///var info=[{"id":"1","name":"Inicio","actualStart":"2019-01-01","actualEnd":"2019-01-31","children":[{"id": "1", "name": "Actvidad1","actualStart": "2019-01-01","actualEnd": "2019-01-02"}]},{"id":"2","name":"Ejecucion","actualStart":"2019-01-01","actualEnd":"2019-01-31","children":[{"id": "2", "name": "Actvidad2","actualStart": "2019-01-03","actualEnd": "2019-01-07"},{"id": "3", "name": "Actvidad3","actualStart": "2019-01-08","actualEnd": "2019-01-14"}]},{"id":"3","name":"Pruebas","actualStart":"2019-01-01","actualEnd":"2019-01-31","children":[{"id": "2", "name": "Actvidad2","actualStart": "2019-01-03","actualEnd": "2019-01-07"},{"id": "3", "name": "Actvidad3","actualStart": "2019-01-08","actualEnd": "2019-01-14"}]},{"id":"4","name":"Produccion","actualStart":"2019-01-01","actualEnd":"2019-01-31","children":[{"id": "5", "name": "Actvidad5","actualStart": "2019-01-17","actualEnd": "2019-01-24"}]},{"id":"5","name":"Cierre","actualStart":"2019-01-01","actualEnd":"2019-01-31","children":[{"id": "6", "name": "Actvidad6","actualStart": "2019-01-25","actualEnd": "2019-01-29"},{"id": "7", "name": "Actvidad7","actualStart": "2019-01-30","actualEnd": "2019-01-31"}]}];
 //var info=JSON.parse('['+JSON.stringify(data)+']');
       // create a data tree
  //     var treeData = anychart.data.tree(info, "as-tree");
       // create a chart
  //     var chart = anychart.ganttProject();
       // set the data
      // chart.data(treeData);
       // set the container id
    //   chart.container("container");
       // initiate drawing the chart
      // chart.draw();
       // fit elements to the width of the timeline
       //chart.fitAll();



  // Load from a Json url
  //JSGantt.parseJSON('./fixes/data.json', g);

  // Or Adding  Manually

  $(document).ready(function(){
tablaprueba()
});


function tablaprueba(){
  $('#table').DataTable({
    		"pagin":true,
    		'ajax':{
    		      "url":baseurl+"Cargaexcel/listar",
    		      "type":"POST",
              "dataSrc": ""
    		},
    		'columns':[
    			{"data":"item"},
    			{"data":"codigo"},
    			{"data":"descripcion",
          "orderable": true,
				render:function(data,type,row){
				return  '<input type="text" class="form-control descripcion" value="'+row.descripcion+'">';
			}},
    			{"data":"cantidad"},
    			{"data":"precio"},
    			{"data":"unidad",
          render:function(data,type,row){
  				if (row.unidad=='PC') {
            return  '<span class="label bg-black-active color-palette">PIEZA</span>';
          } else {
            return  '<span class="label bg-black-active color-palette">UNIDAD</span>';
          }
  			}},
          {"data":"codigo"}


    		]

    	});
      $.ajax({
        url:baseurl+"Cargaexcel/listar",
        type:"post",
            dataType:"json",
        success: function(data){
          $.each(data,function(i,item){
              var fila='<tr><td class="'+item.item+'">'+item.item+
                      '</td><td class="'+item.codigo+'">'+item.codigo+
                      '</td><td class="'+item.descripcion+'">'+item.descripcion+
                      '</td><td class="'+item.cantidad+'">'+item.cantidad+
                      '</td><td class="'+item.precio+'">'+item.precio+
                      '</td><td class="'+item.unidad+'">'+item.unidad+
                      '</td><td class="'+item.codigo+'">'+item.codigo+
                      '</td></tr>';
              $('#table tbody').append(fila);
          });
        }
      });

}
$(document).on('click','#btn_cargaexcel',function(e){
  var formData = new FormData(document.getElementById("form_envio_excel"));
  if ($('#descuento').val()!="") {
      var descuento=$('#descuento').val();
  }else {
    var descuento=0;
  }
  $.ajax({
      url:baseurl+"Support/cargartemporal",
      type:"post",
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $('#msg').html('<div><h3>Cargando excel....</h3></div>');
      },
      success:function(data){
        $('#table').DataTable().destroy();
          tablaprueba();
        }
          });

  });
