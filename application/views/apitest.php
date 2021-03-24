<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $cdn=base_url().'assets/cdn/'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo $cdn; ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript">
    var baseurl = "<?php echo base_url() ?>"
    console.log(baseurl);
      $.ajax({
        url:"https://www.gestion-humana.rockdrillgroup.net/Vacaciones/importacion_vacaciones",
        type:"post",
        dataType:"json",
          cors: true ,
          contentType:'application/json',
          secure: true,
          headers: {
            'Access-Control-Allow-Origin': '*',
          },
        success:function(data){
          console.log(data);
        }
      })
    </script>
  </body>
</html>
