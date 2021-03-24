<?php
	/**
	 *
	 */
	class Inicio extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Mcontrato');
			$this->load->model('Mperfil');
			$this->load->model('Mdocumento');
			$this->load->model('MRequerimiento');
		}

		public function index(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('layout/contenido');
			$this->load->view('layout/footer');
		}
    public function prueba(){
      $this->load->view('layout/header');
      $this->load->view('layout/menu');
      $this->load->view('test');
      $this->load->view('layout/footer');
    }
		public function dashboard_mes(){
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	$this->load->view('dashboards/dashbard1');
	$this->load->view('layout/footer');
}

public function dashboard_trimestre(){
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	$this->load->view('dashboards/dashboard_trimestre');
	$this->load->view('layout/footer');
}
public function meta_venta(){
	$this->load->model('Mtablaayuda');
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	//$data['clientes']=$this->Mtablaayuda->clientes();
	$this->load->view('tabla-ayuda/meta_venta');
	$this->load->view('layout/footer');
}
public function contrato_suministro(){
	$this->load->model('Mtablaayuda');
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	$this->load->view('tabla-ayuda/contrato_suministro');
	$this->load->view('layout/footer');
}
public function dashboard_semanal(){
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	$this->load->view('dashboards/dashboard_semanal');
	$this->load->view('layout/footer');
}
public function cumplimiento_pedidos(){
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	$this->load->view('dashboards/cumplimiento_pedidos');
	$this->load->view('layout/footer');
}
public function reprogramacion_pedidos(){
	$this->load->view('layout/header');
	$this->load->view('layout/menu');
	$this->load->view('dashboards/reprogramacion');
	$this->load->view('layout/footer');
}
		public function get(){
			$usuario=$this->input->post('usuario');
			$contratos=$this->Mcontrato->gettogin(1,$usuario);
			echo json_encode($contratos);
		}
		public function Usuarios(){
			/*if(!$this->session->acceso_submenu_1==1){
				redirect(base_url().'Contrato');
			}else{*/
				$data['perfiles_creados']=$this->Mperfil->getperfiles();
				$data['areas']=$this->Mperfil->getareas();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('usuarios/grid_usuarios',$data);
				$this->load->view('layout/footer');
	/*		}*/
		}
		public function maestro_articulo(){
			$this->load->model('Marticulo');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['familia']=$this->Marticulo->familia();
			$this->load->view('tabla-ayuda/maestro-articulos',$data);
			$this->load->view('layout/footer');
		}

		public function tiempo_entrega(){
			$this->load->model('Mtablaayuda');

			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['tiempo']=$this->Mtablaayuda->tiempo_entrega();
			$this->load->view('tabla-ayuda/tiempo_entrega',$data);
			$this->load->view('layout/footer');
		}

		public function forma_pago(){
			$this->load->model('Mtablaayuda');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['pago']=$this->Mtablaayuda->get_forma_pago();
			$this->load->view('tabla-ayuda/forma_pago',$data);
			$this->load->view('layout/footer');
		}

		public function vendedor(){
			$this->load->model('Mtablaayuda');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['vendedor']=$this->Mtablaayuda->vendedor();
			$this->load->view('tabla-ayuda/vendedor',$data);
			$this->load->view('layout/footer');
		}

		public function centrocosto(){
			$this->load->model('Marticulo');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
						$data['familia']=$this->Marticulo->familia();
			$this->load->view('tabla-ayuda/centroscostos',$data);
			$this->load->view('layout/footer');
		}
		public function precio_articulo(){
			$this->load->model('Marticulo');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
					//	$data['familia']=$this->Marticulo->familia();
			$this->load->view('tabla-ayuda/precio_articulo');
			$this->load->view('layout/footer');
		}
		public function costo_articulo(){
			$this->load->model('Marticulo');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
					//	$data['familia']=$this->Marticulo->familia();
			$this->load->view('tabla-ayuda/costo_articulo');
			$this->load->view('layout/footer');
		}
		public function descuento_articulo(){
			$this->load->model('Marticulo');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
						//$data['familia']=$this->Marticulo->familia();
			$this->load->view('tabla-ayuda/descuento');
			$this->load->view('layout/footer');
		}
		public function stock(){
			$this->load->model('Mtablaayuda');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['almacen']=$this->Mtablaayuda->almacenes();
			$this->load->view('almacenes/stock',$data);
			$this->load->view('layout/footer');
		}
		public function clientes(){
			$this->load->model('Mtablaayuda');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['clientes']=$this->Mtablaayuda->clientes();
			$this->load->view('tabla-ayuda/clientes',$data);
			$this->load->view('layout/footer');
		}
		public function correlativos(){
			if(!$this->session->acceso_submenu_6==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('tabla-ayuda/correlativos');
				$this->load->view('layout/footer');
			}
		}
		public function Perfiles(){
		/*	if(!$this->session->acceso_submenu_3==1){
				redirect(base_url().'Contrato');
			}else{
*/
				$this->load->model('Mperfil');
				$data['menus']=$this->Mperfil->getmenus();
				$data['submenus']=$this->Mperfil->getsubmenus();

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('perfiles/grid_perfiles',$data);
				$this->load->view('layout/footer');
		/*	}*/
		}



		public function carga_inicial(){
			if(!$this->session->acceso_submenu_15==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('proyecto/carga-inicial',$series);
				$this->load->view('layout/footer');
			}
		}


			public function cotizacion(){
					$usuario=$this->session->userdata('user_id');
					if ($usuario=="") {
						redirect('Login');
					}else {
						$this->db->query('DELETE FROM carga_excel WHERE usuario='.$usuario.'');
						$this->load->model('Mtablaayuda');
						$data['correlativo']=$this->Mtablaayuda->correlativo('cot');
						$this->load->view('layout/header');
						$this->load->view('layout/menu');
						$this->load->view('proceso/cotizacion',$data);
						$this->load->view('layout/footer');
					}


			}



		public function enproceso(){

				#public function requerimiento_materiales(){
					$this->load->view('layout/header');
					$this->load->view('layout/menu');
					$this->load->view('layout/enproceso');
					#$this->load->view('proyecto/requerimiento_materiales');
					$this->load->view('layout/footer');

		}

		public function cierre_cotizacion(){
						$this->load->model('Mtransaccion');
					$this->load->view('layout/header');
					$this->load->view('layout/menu');
					$data['cotizaciones']=$this->Mtransaccion->get_cotizaciones();
					$this->load->view('proceso/cierre',$data);
					$this->load->view('layout/footer');
		}
		public function orden_venta(){
						$this->load->model('Mtransaccion');
					$this->load->view('layout/header');
					$this->load->view('layout/menu');
					//$data['correlativo_ped']=$this->Mtransaccion->get_correlativo_pedido();
					$data['cotizaciones']=$this->Mtransaccion->get_cotizaciones();
					$this->load->view('proceso/orden_venta',$data);
					$this->load->view('layout/footer');
		}
		public function orden_venta_test(){
						$this->load->model('Mtransaccion');
					$this->load->view('layout/header');
					$this->load->view('layout/menu');
					//$data['correlativo_ped']=$this->Mtransaccion->get_correlativo_pedido();
					$data['cotizaciones']=$this->Mtransaccion->get_cotizaciones();
					$this->load->view('proceso/orden_venta_test',$data);
					$this->load->view('layout/footer');
		}
		public function consultar_pedido(){
						$this->load->model('Mtransaccion');
					$this->load->view('layout/header');
					$this->load->view('layout/menu');
					$data['pedidos']=$this->Mtransaccion->get_pedido();
					$this->load->view('proceso/reprogramacion',$data);
					$this->load->view('layout/footer');
		}
		public function seguimiento(){
						$this->load->model('Mtransaccion');
					$this->load->view('layout/header');
					$this->load->view('layout/menu');
					$data['pedidos']=$this->Mtransaccion->get_pedido();
					$this->load->view('proceso/seguimiento',$data);
					$this->load->view('layout/footer');
		}

		public function dashboard(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->model(array('Mchart'));
			$data['ingresostotales']=$this->Mchart->getingresos($this->session->userdata('alm_id'));
			$data['salidastotales']=$this->Mchart->getsalidas($this->session->userdata('alm_id'));
			$data['codigotop']=$this->Mchart->get_articulo_1($this->session->userdata('alm_id'));
			$data['valoralmacen']=$this->Mchart->valor_almacen($this->session->userdata('alm_id'));
			$data['topcodigos']=$this->Mchart->get_topcodigos(10,$this->session->userdata('alm_id'));
			$data['topcodigosvalor']=$this->Mchart->get_topcodigos_valor(10,$this->session->userdata('alm_id'));
			$data['nmaquinas']=$this->Mchart->nmaquinas($this->session->userdata('alm_id'));
			$this->load->view('dashboards/dashbard1',$data);
			$this->load->view('layout/footer');
		}

		public function consultar_cotizaciones(){

			$this->load->model('Mtransaccion');
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$data['cotizaciones']=$this->Mtransaccion->get_cotizaciones();
		$this->load->view('consultas/cotizacion',$data);
		$this->load->view('layout/footer');
		}

		public function detallado_cotizaciones(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('consultas/detallado_cotizaciones');
		$this->load->view('layout/footer');
		}
		public function analisis_precio(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('consultas/consultas_analisis_precio');
		$this->load->view('layout/footer');
		}
		public function articulo_sin_cc(){
			$this->load->model('Marticulo');
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$data['articulos']=$this->Marticulo->articulo_sin_cc();
		$data['articulos_cc']=$this->Marticulo->articulos_cc();
		$data['tipo']=1;
		$this->load->view('consultas/articulo_sin_cc',$data);
		$this->load->view('layout/footer');
		}
		public function articulo_con_cc(){
			$this->load->model('Marticulo');
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$data['articulos']=$this->Marticulo->articulos_cc();
		$data['tipo']=0;
		$this->load->view('consultas/articulo_con_cc',$data);
		$this->load->view('layout/footer');
		}

		public function auditoria_documento(){
		$this->load->model('Mtransaccion');
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$data['auditoria']=$this->Mtransaccion->auditoria_documento();
		$this->load->view('consultas/auditoria_documento',$data);
		$this->load->view('layout/footer');
		}

		public function auditoria_precio(){
			$this->load->model('Mtransaccion');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['auditoria']=$this->Mtransaccion->auditoria_precio();
			$this->load->view('consultas/auditoria_precio',$data);
			$this->load->view('layout/footer');
		}
		public function auditoria_costo(){
			$this->load->model('Mtransaccion');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['auditoria']=$this->Mtransaccion->auditoria_costo();
			$this->load->view('consultas/auditoria_costo',$data);
			$this->load->view('layout/footer');
		}
		public function auditoria_descuento(){
			$this->load->model('Mtransaccion');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['auditoria']=$this->Mtransaccion->auditoria_descuento();
			$this->load->view('consultas/auditoria_descuento',$data);
			$this->load->view('layout/footer');
		}
		public function consultar_cierre(){
			$this->load->model('Mtransaccion');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['cotizaciones']=$this->Mtransaccion->get_cotizaciones();
			$this->load->view('consultas/consultar_cierre',$data);
			$this->load->view('layout/footer');
		}
		public function reporte_pedido_pendiente(){
			$this->load->model('Mtablaayuda');
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$data['vendedor']=$this->Mtablaayuda->vendedor();
			$this->load->view('reportes/pedido_pendiente',$data);
			$this->load->view('layout/footer');
		}
		public function reporte_pedido_atendido(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('reportes/pedido_atendido');
			$this->load->view('layout/footer');
		}
		public function reporte_pedido_por_atender(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('reportes/atencion_pedidos');
			$this->load->view('layout/footer');
		}
		public function cotizaciones_pedidos(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('reportes/cotizaciones_pedidos');
			$this->load->view('layout/footer');
		}
		public function cotizaciones_pedidos_semanal(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('dashboards/cotizaciones_pedidos_semanal');
			$this->load->view('layout/footer');
		}
		public function eliminacion_pedido(){
			$this->load->model('Mtransaccion');
			$data['pedidos']=$this->Mtransaccion->pedido_emitido();
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('proceso/eliminacion_pedido',$data);
			$this->load->view('layout/footer');
		}
		public function reporte_facturacion(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('reportes/reporte_facturacion');
			$this->load->view('layout/footer');
		}
		public function reporte_salidas_08(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('reportes/reporte_salidas_08');
			$this->load->view('layout/footer');
		}
		public function programacion_entrega(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('proceso/programacion_entrega');
			$this->load->view('layout/footer');
		}
		public function envio_guias(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('proceso/envio_guias');
			$this->load->view('layout/footer');
		}
	}
 ?>
