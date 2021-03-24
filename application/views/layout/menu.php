o<?php $cdn='http://192.168.1.7/cdn/admin-lte/'; ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
   <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU DE NAVEGACION</li>

        <!--   <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

        <li><a href="<?php //echo base_url() ?>Inicio/prueba" id='menu_dashboard'><i class="fa fa-circle-o"></i>Prueba</a></li>
        <li><a href="<?php //echo base_url() ?>Inicio/gantt"><i class="fa fa-circle-o"></i>Gantt</a> </li>
          </ul>
        </li>

-->
        <?php if($this->session->acceso_menu_9==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-warehouse"></i>
            <span>&nbsp;Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_33==1){ ?><li><a href="<?php echo base_url() ?>Inicio/dashboard_mes" id='menu_dashboard_mes'><i class="fa fa-circle-o"></i>Dashboard por Mes</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_34==1){ ?><li><a href="<?php echo base_url() ?>Inicio/dashboard_trimestre" id='menu_dashboard_trimestre'><i class="fa fa-circle-o"></i>Dashboard por Trimestre</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_36==1){ ?><li><a href="<?php echo base_url() ?>Inicio/dashboard_semanal" id='menu_dashboard_semanal'><i class="fa fa-circle-o"></i>Dashboard Semanal</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_39==1){ ?><li><a href="<?php echo base_url() ?>Inicio/cotizaciones_pedidos" id='menu_cotizaciones_pedidos'><i class="fa fa-circle-o"></i>Cotizaciones VS Pedidos - Mes</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_40==1){ ?><li><a href="<?php echo base_url() ?>Inicio/cotizaciones_pedidos_semanal" id='menu_cotizaciones_pedidos_semanal'><i class="fa fa-circle-o"></i>Cotizaciones VS Pedidos - Semana</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_54==1){ ?><li><a href="<?php echo base_url() ?>Inicio/cumplimiento_pedidos" id='menu_cumplimiento_pedidos'><i class="fa fa-circle-o"></i>Cumplimiento de Pedidos</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_55==1){ ?><li><a href="<?php echo base_url() ?>Inicio/reprogramacion_pedidos" id='menu_reprogramacion_pedidos'><i class="fa fa-circle-o"></i>Reprogramación de Pedidos</a></li><?php } ?>

          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->acceso_menu_2==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-cog"></i> <span>Tabla de ayuda</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_3==1){ ?><li><a href="<?php echo base_url() ?>Inicio/maestro_articulo" id='menu_maestro_articulo'><i class="fa fa-circle-o"></i>Maestro articulos</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_14==1){ ?><li><a href="<?php echo base_url() ?>Inicio/centrocosto" id='menu_centro_costo'><i class="fa fa-circle-o"></i>Centro de Costo</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_4==1){ ?><li><a href="<?php echo base_url() ?>Inicio/forma_pago" id='menu_forma_pago'><i class="fa fa-circle-o"></i>Formas de Pago</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_13==1){ ?><li><a href="<?php echo base_url() ?>Inicio/tiempo_entrega" id='menu_tiempo_entrega'><i class="fa fa-circle-o"></i>Tiempo de Entrega</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_16==1){ ?><li><a href="<?php echo base_url() ?>Inicio/precio_articulo" id='menu_precio'><i class="fa fa-circle-o"></i>Precio de Articulos</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_26==1){ ?><li><a href="<?php echo base_url() ?>Inicio/costo_articulo" id='menu_costo'><i class="fa fa-circle-o"></i>Costo de Articulos</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_28==1){ ?><li><a href="<?php echo base_url() ?>Inicio/descuento_articulo" id='menu_descuento'><i class="fa fa-circle-o"></i>Descuento Máximo</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_5==1){ ?><li><a href="<?php echo base_url() ?>Inicio/vendedor" id='menu_vendedor'><i class="fa fa-circle-o"></i>Vendedores</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_6==1){ ?><li><a href="<?php echo base_url() ?>Inicio/clientes" id='menu_cliente'><i class="fa fa-circle-o"></i>Clientes</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_32==1){ ?><li><a href="<?php echo base_url() ?>Inicio/meta_venta" id='menu_meta_venta'><i class="fa fa-circle-o"></i>Meta de Venta</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_37==1){ ?><li><a href="<?php echo base_url() ?>Inicio/contrato_suministro" id='menu_contrato_suministro'><i class="fa fa-circle-o"></i>Contrato de Suministro</a></li><?php } ?>
        </ul>
        </li>
        <?php } ?>

        <?php if($this->session->acceso_menu_6==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-warehouse"></i>
            <span>&nbsp;Almacen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_15==1){ ?><li><a href="<?php echo base_url() ?>Inicio/stock" id='stock'><i class="fa fa-circle-o"></i>Stock de Artículo</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_126==1){ ?><li><a href="<?php echo base_url() ?>Inicio/programacion_entrega" id='menu_programacion_entrega'><i class="fa fa-circle-o"></i>Programación de Entrega</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_127==1){ ?><li><a href="<?php echo base_url() ?>Inicio/envio_guias" id='menu_envio_guia'><i class="fa fa-circle-o"></i>Envío de Guías</a></li><?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if($this->session->acceso_menu_3==1 and $this->session->rol_id!=11){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-columns"></i>
            <span>&nbsp;Cotización</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_9==1){ ?><li><a href="<?php echo base_url() ?>Inicio/cotizacion" id='menu_cotizacion'><i class="fa fa-circle-o"></i>Cotizaciones</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_11==1){ ?><li><a href="<?php echo base_url() ?>Inicio/cierre_cotizacion" id='menu_cierre'><i class="fa fa-circle-o"></i>Cierre de Cotizaciones</a></li><?php } ?>

          </ul>
        </li>
                <?php } ?>
                        <?php if($this->session->acceso_menu_3==1 ){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-columns"></i>
            <span>&nbsp;Pedidos de Venta</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_10==1){ ?><li><a href="<?php echo base_url() ?>Inicio/orden_venta" id='menu_orden_venta'><i class="fa fa-circle-o"></i>Generar Pedido de Venta</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_31==1){ ?><li><a href="<?php echo base_url() ?>Inicio/seguimiento" id='menu_seguimiento'><i class="fa fa-circle-o"></i>Seguimiento de Pendientes</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_18==1){ ?><li><a href="<?php echo base_url() ?>Inicio/consultar_pedido" id='menu_reprogramacion'><i class="fa fa-circle-o"></i>Reprogramación de Pedidos</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_56==1){ ?><li><a href="<?php echo base_url() ?>Inicio/eliminacion_pedido" id='menu_eliminacion_pedido'><i class="fa fa-circle-o"></i>Anulación de Pedidos</a></li><?php } ?>

          </ul>
        </li>
<?php } ?>

        <?php if($this->session->acceso_menu_4==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-zoom-in"></i>
            <span>&nbsp;Consultas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_12==1){ ?><li><a href="<?php echo base_url() ?>Inicio/consultar_cotizaciones" id='consultar_cot'><i class="fa fa-circle-o"></i>Cotizaciones</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_38==1){ ?><li><a href="<?php echo base_url() ?>Inicio/detallado_cotizaciones" id='menu_detallado_cotizaciones'><i class="fa fa-circle-o"></i>Cotizaciones - Detallado</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_51==1){ ?><li><a href="<?php echo base_url() ?>Inicio/analisis_precio" id='menu_analisis_precio'><i class="fa fa-circle-o"></i>Analisis de Precio</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_17==1){ ?><li><a href="<?php echo base_url() ?>Inicio/articulo_con_cc" id='menu_con_cc'><i class="fa fa-circle-o"></i>Articulos con CC</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_17==1){ ?><li><a href="<?php echo base_url() ?>Inicio/articulo_sin_cc" id='menu_sin_cc'><i class="fa fa-circle-o"></i>Articulos sin CC</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_21==1){ ?><li><a href="<?php echo base_url() ?>Inicio/consultar_cierre" id='menu_consultar_cierre'><i class="fa fa-circle-o"></i>Cierre de Cotizaciones</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_19==1){ ?><li><a href="<?php echo base_url() ?>Inicio/auditoria_precio" id='menu_auditoria_precio'><i class="fa fa-circle-o"></i>Auditoria de Precios</a></li><?php } ?>
                      <?php if($this->session->acceso_submenu_29==1){ ?><li><a href="<?php echo base_url() ?>Inicio/auditoria_costo" id='menu_auditoria_costo'><i class="fa fa-circle-o"></i>Auditoria de Costo</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_30==1){ ?><li><a href="<?php echo base_url() ?>Inicio/auditoria_descuento" id='menu_auditoria_descuento'><i class="fa fa-circle-o"></i>Auditoria de Descuento</a></li><?php } ?>

          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->acceso_menu_8==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-zoom-in"></i>
            <span>&nbsp;Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_27==1){ ?><li><a href="<?php echo base_url() ?>Inicio/reporte_pedido_pendiente" id='menu_reporte_pedido_pendiente'><i class="fa fa-circle-o"></i>Pedidos Pendientes</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_35==1){ ?><li><a href="<?php echo base_url() ?>Inicio/reporte_pedido_atendido" id='menu_reporte_pedido_atendido'><i class="fa fa-circle-o"></i>Pedidos Atendidos</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_115==1){ ?><li><a href="<?php echo base_url() ?>Inicio/reporte_facturacion" id='menu_reporte_facturacion'><i class="fa fa-circle-o"></i>Reporte de Facturación</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_116==1){ ?><li><a href="<?php echo base_url() ?>Inicio/reporte_salidas_08" id='menu_reporte_salidas_08'><i class="fa fa-circle-o"></i>Salidas Almacén 08</a></li><?php } ?>
              <?php if($this->session->acceso_submenu_128==1){ ?><li><a href="<?php echo base_url() ?>Inicio/reporte_pedido_por_atender" id='menu_pedido_por_atender'><i class="fa fa-circle-o"></i>Pedidos por Atender</a></li><?php } ?>

          </ul>
        </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
   <div class="content-wrapper" id="home-contenido">
