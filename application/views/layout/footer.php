</div>
  <!-- /.content-wrapper -->
<div class="row">
  <div class="col-md-5">

  </div>
<div class="col-md-4">
  <label for="" style="color:white;"> COPYRIGHT © 2019 ÁREA DE TIC - ROVHECO DATA - COMERCIAL DRILLING SERVICES S.A.C -TODOS LOS DERECHOS RESERVADOS</label>
</div>
<div class="col-md-3">
  </div>
</div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<?php $cdn=base_url().'assets/cdn/'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $cdn; ?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $cdn; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<!-- Sparkline -->
<script src="<?php echo $cdn; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $cdn; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $cdn; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $cdn; ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $cdn; ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $cdn; ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo $cdn; ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->

<script src="<?php echo $cdn; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $cdn; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $cdn; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $cdn; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $cdn; ?>dist/js/demo.js"></script>
<script src="<?php echo $cdn; ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script src="<?php echo $cdn; ?>bower_components/alertify/alertify.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/file-input/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="<?php echo base_url()?>/assets/plugins/file-input/theme.js"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<script src="<?php echo base_url()?>/assets/plugins/file-input/es.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- choose a theme file -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/cdn/bower_components/tablesorter/css/theme.default.css">
<!-- load jQuery and tablesorter scripts -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/cdn/bower_components/tablesorter/js/jquery.tablesorter.js"></script>

<!-- tablesorter widgets (optional) -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/cdn/bower_components/tablesorter/js/jquery.tablesorter.widgets.js"></script>
  <script  src = "<?php echo base_url()?>assets/cdn/plugins/jsgantt-improved-master/jsgantt-improved-master/docs/jsgantt.js"  type = "text/javascript" ></script>
<script>
	var baseurl="<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url() ?>js/contratos.js"></script>

<?php if($this->uri->segment(2)=='maestro_articulo'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/maestro-articulo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='serie-documento'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/serie-documentos.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='correlativos'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/correlativo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='forma_pago'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/forma_pago.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='tiempo_entrega'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/tiempo_entrega.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='vendedor'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/vendedor.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='centrocosto'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/centros_de_costo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='clientes'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/clientes.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='precio_articulo'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/precio.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='costo_articulo'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/costo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='descuento_articulo'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/descuento.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='Usuarios'){ ?>
	<script src="<?php echo base_url() ?>js/usuario.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='stock'){ ?>
	<script src="<?php echo base_url() ?>js/stock.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='Perfiles'){ ?>
	<script src="<?php echo base_url() ?>js/perfil.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='dashboard_mes'){ ?>
	<script src="<?php echo base_url() ?>js/dashboard/dashboard1.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='dashboard_trimestre'){ ?>
	<script src="<?php echo base_url() ?>js/dashboard/dashboard_trimestre.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='dashboard_semanal'){ ?>
	<script src="<?php echo base_url() ?>js/dashboard/dashboard_semanal.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='meta_venta'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/meta_venta.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='contrato_suministro'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/contrato_suministro.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='orden_venta'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/orden_venta.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='orden_venta_test'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/orden_venta_test.js"></script>
<?php } ?>

<!-- consultas -->
<?php if($this->uri->segment(2)=='consultar_cotizaciones'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/cotizacion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='consultar_cierre'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/consultar_cierre.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='articulo_sin_cc'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/articulo_sin_cc.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='articulo_con_cc'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/articulo_con_cc.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='auditoria_documento'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/auditoria_documentos.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='auditoria_precio'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/auditoria_precio.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='auditoria_descuento'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/auditoria_descuento.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='auditoria_costo'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/auditoria_costo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='detallado_cotizaciones'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/detallado_cotizaciones.js"></script>
<?php } ?>
<!-- fin procesos -->

<?php if($this->uri->segment(2)=='cotizacion'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/cotizacion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='seguimiento'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/seguimiento.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='cierre_cotizacion'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/cierre_cotizacion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='eliminacion_pedido'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/eliminacion_pedido.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='duplicar_cotizacion'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/cotizacion_dup.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='consultar_pedido'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/reprogramacion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='envio_guias'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/envio_guias.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='programacion_entrega'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/programacion_entrega.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='reporte_pedido_pendiente'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/pedido_pendiente.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='reporte_pedido_atendido'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/pedido_atendido.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='cotizaciones_pedidos'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/cotizaciones_pedidos.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='reporte_salidas_08'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/reporte_salidas_08.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='reporte_facturacion'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/reporte_facturacion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='reporte_pedido_por_atender'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/atencion_pedidos.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='cotizaciones_pedidos_semanal'){ ?>
	<script src="<?php echo base_url() ?>js/dashboard/cotizaciones_pedidos_semanal.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='cumplimiento_pedidos'){ ?>
	<script src="<?php echo base_url() ?>js/dashboard/cumplimiento_pedidos.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='reprogramacion_pedidos'){ ?>
	<script src="<?php echo base_url() ?>js/dashboard/reprogramacion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='analisis_precio'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/consultas_analisis_precio.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='dashboard'){ ?>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="<?php echo base_url() ?>js/dashboard/dashboard1.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='prueba'){ ?>
	<script src="<?php echo base_url() ?>js/prueba.js"></script>
<?php } ?>

</body>
</html>
