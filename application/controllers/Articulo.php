<?php
	/**
	 *
	 */
	class Articulo extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Marticulo');
		}

		public function get(){
			$tipo=$this->input->post('tipo');
			$cadena=$this->input->post('cadena');
			if ($this->Marticulo->getall($tipo,$cadena)==0) {
				echo "<br><br><p style='font-style:italic;color:#757575;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No hay resultados en la busqueda<p>";
				}else {
					$data['articulos']=$this->Marticulo->getall($tipo,$cadena);
					$this->load->view('secciones/tabla-ayuda/maestro_articulo',$data);
			 }
		}

		public function listarcc(){
			$tipo=$this->input->post('tipo');
			$cadena=$this->input->post('cadena');

			if ($this->Marticulo->centrocosto($tipo,$cadena)==0) {
				echo "<br><br><p style='font-style:italic;color:#757575;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No hay resultados en la busqueda<p>";
			}else {
						$data['centrocosto']=$this->Marticulo->centrocosto($tipo,$cadena);
						$this->load->view('secciones/tabla-ayuda/centrocosto',$data);
			}
		}

		public function precios(){
			$tipo=$this->input->post('tipo');
			$cadena=$this->input->post('cadena');
			if ($this->Marticulo->precio($tipo,$cadena)==0) {
				echo "<br><br><p style='font-style:italic;color:#757575;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No hay resultados en la busqueda<p>";
			}else {
				$data['precio']=$this->Marticulo->precio($tipo,$cadena);
				$this->load->view('secciones/tabla-ayuda/precio',$data);
			}
		}
		public function costos(){
			$tipo=$this->input->post('tipo');
			$cadena=$this->input->post('cadena');
			if ($this->Marticulo->costo($tipo,$cadena)==0) {
				echo "<br><br><p style='font-style:italic;color:#757575;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No hay resultados en la busqueda<p>";
			}else {
				$data['costo']=$this->Marticulo->costo($tipo,$cadena);
				$this->load->view('secciones/tabla-ayuda/costo',$data);
			}
		}
		public function descuento(){
			$tipo=$this->input->post('tipo');
			$cadena=$this->input->post('cadena');
			if ($this->Marticulo->costo($tipo,$cadena)==0) {
				echo "<br><br><p style='font-style:italic;color:#757575;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No hay resultados en la busqueda<p>";
			}else {
				$data['descuento']=$this->Marticulo->descuento($tipo,$cadena);
				$this->load->view('secciones/tabla-ayuda/descuento',$data);
			}
		}
		public function getinfo(){
			$articulo=$this->input->post('codigo');
			$info['articulo']=$this->db->query("SELECT nm_parte,cod_rockdrill,cod_cliente1,cod_cliente2,cod_cliente3,cod_cliente4 FROM maeart WHERE articuloid='".$articulo."'");

			echo json_encode($info);
		}


	public function save(){
		$articuloid=$this->input->post('articuloid');
		$num_parte=$this->input->post('num_parte');
		$cod_rockdrill=$this->input->post('cod_rockdrill');
		$cod_cliente1=$this->input->post('cod_cliente1');
		$cod_cliente2=$this->input->post('cod_cliente2');
		$cod_cliente3=$this->input->post('cod_cliente3');
		$cod_cliente4=$this->input->post('cod_cliente4');
		$descripcion=$this->input->post('descripcion');
		$unidad_med=$this->input->post('unidad_med');
		$query=$this->db->query("SELECT * FROM maeart WHERE articuloid='".$articuloid."'");

		if ($query->num_rows()<1) {
			$datos=array('articuloid'=>$articuloid,
									 'num_parte'=>$num_parte,
									 'cod_rockdrill'=>$cod_rockdrill,
								 	 'cod_cliente1'=>$cod_cliente1,
							     'cod_cliente2'=>$cod_cliente2,
						       'cod_cliente3'=>$cod_cliente3,
								   'cod_cliente4'=>$cod_cliente4,
								 	 'unidad_med'=>$unidad_med,
								 	 'descripcion'=>$descripcion);

			$this->db->insert('maeart',$datos);

		}else {
			$datos=array('num_parte'=>$num_parte,
									 'cod_rockdrill'=>$cod_rockdrill,
									 'cod_cliente1'=>$cod_cliente1,
									 'cod_cliente2'=>$cod_cliente2,
									 'cod_cliente3'=>$cod_cliente3,
									 'cod_cliente4'=>$cod_cliente4,
								 	 'unidad_med'=>$unidad_med,
								 	 'descripcion'=>$descripcion);

			$this->db->where('articuloid', $articuloid);
			$this->db->update('maeart', $datos);
		}

		echo 1;

		}


		public function savecc(){
			$articuloid=$this->input->post('articuloid');
			$centrocosto=$this->input->post('centrocosto');
			$starsoft=$this->load->database('starsoft',TRUE);
			$queryfamilia=$starsoft->query("SELECT AFAMILIA FROM MAEART WHERE ACODIGO='".$articuloid."'");
			$familia=$queryfamilia->row('AFAMILIA');
			$query=$this->db->query("SELECT * FROM centrodecosto WHERE articuloid='".$articuloid."'");

			if ($query->num_rows()<1) {

				$datos=array('articuloid'=>$articuloid,
										 'centrocosto'=>$centrocosto,
									 		'familia'=>$familia);

				$this->db->insert('centrodecosto',$datos);

			}else {


				$datos=array('centrocosto'=>$centrocosto);
				$this->db->where('articuloid', $articuloid);
				$this->db->update('centrodecosto', $datos);
			}
			echo 1;
			}
			public function saveprecio(){
				$articuloid=$this->input->post('articuloid');
				$precio=$this->input->post('precio');
				$motivo=$this->input->post('motivo');
				$query=$this->db->query("SELECT precio_usd FROM precio_articulo WHERE articuloid='".$articuloid."'");
				$precioanterior=$query->row('precio_usd');
				if ($query->num_rows()<1) {
					$auditoria=array('documento'=>$articuloid,
														'tipo_doc'=>'PL',
														'accion'=>$motivo.'. Registro de precio',
														'usuario'=>$this->session->userdata('user_id'),
														'fecha_hora'=>date('Y-m-d H:i:s')
					);
						$this->db->insert('auditoria_documento', $auditoria);
					$datos=array('articuloid'=>$articuloid,
											 'precio_usd'=>$precio);

					$this->db->insert('precio_articulo',$datos);

				}else {
					$auditoria=array('documento'=>$articuloid,
														'tipo_doc'=>'PL',
														'accion'=>$motivo.'. Precio anterior '.$precioanterior,
														'usuario'=>$this->session->userdata('user_id'),
														'fecha_hora'=>date('Y-m-d H:i:s')
					);
					  $this->db->insert('auditoria_documento', $auditoria);

					$datos=array('precio_usd'=>$precio);
					$this->db->where('articuloid', $articuloid);
					$this->db->update('precio_articulo', $datos);
				}
				echo 1;
				}

				public function savedescuento(){
					$articuloid=$this->input->post('articuloid');
					$precio=$this->input->post('descuento');
					$motivo=$this->input->post('motivo');
					$query=$this->db->query("SELECT desc_maximo FROM precio_articulo WHERE articuloid='".$articuloid."'");
					$precioanterior=$query->row('desc_maximo');
					if ($query->num_rows()<1) {
						$auditoria=array('documento'=>$articuloid,
															'tipo_doc'=>'DP',
															'accion'=>$motivo.'. Registro de precio',
															'usuario'=>$this->session->userdata('user_id'),
															'fecha_hora'=>date('Y-m-d H:i:s')
						);
							$this->db->insert('auditoria_documento', $auditoria);
						$datos=array('articuloid'=>$articuloid,
												 'desc_maximo'=>$precio);

						$this->db->insert('precio_articulo',$datos);

					}else {
						$auditoria=array('documento'=>$articuloid,
															'tipo_doc'=>'DP',
															'accion'=>$motivo.'. Descuento anterior '.$precioanterior,
															'usuario'=>$this->session->userdata('user_id'),
															'fecha_hora'=>date('Y-m-d H:i:s')
						);
						  $this->db->insert('auditoria_documento', $auditoria);

						$datos=array('desc_maximo'=>$precio);
						$this->db->where('articuloid', $articuloid);
						$this->db->update('precio_articulo', $datos);
					}
					echo 1;
					}


				public function savecosto(){
					$articuloid=$this->input->post('articuloid');
					$costo=$this->input->post('costo');
					$motivo=$this->input->post('motivo');
					$query=$this->db->query("SELECT costo FROM costo_articulo WHERE articuloid='".$articuloid."'");
					$costoanterior=$query->row('costo');
					if ($query->num_rows()<1) {
						$auditoria=array('documento'=>$articuloid,
															'tipo_doc'=>'CA',
															'accion'=>$motivo.'. Registro de Costo',
															'usuario'=>$this->session->userdata('user_id'),
															'fecha_hora'=>date('Y-m-d H:i:s')
						);
							$this->db->insert('auditoria_documento', $auditoria);
						$datos=array('articuloid'=>$articuloid,
												 'costo'=>$costo);

						$this->db->insert('costo_articulo',$datos);

					}else {
						$auditoria=array('documento'=>$articuloid,
															'tipo_doc'=>'CA',
															'accion'=>$motivo.'. Precio anterior '.$costoanterior,
															'usuario'=>$this->session->userdata('user_id'),
															'fecha_hora'=>date('Y-m-d H:i:s')
						);
							$this->db->insert('auditoria_documento', $auditoria);

						$datos=array('costo'=>$costo);
						$this->db->where('articuloid', $articuloid);
						$this->db->update('costo_articulo', $datos);
					}
					echo 1;
					}

		public function buscar($tipo,$cadena,$almacen){

			if ($this->Marticulo->buscar($tipo,$cadena,$almacen)==0) {
				echo "<br><br><p style='font-style:italic;color:#757575;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No hay resultados en la busqueda<p>";
			}else {
				$data['lista']=$this->Marticulo->buscar($tipo,$cadena,$almacen);

				$this->load->view('secciones/proceso/cotizacion',$data);
			}




		}

		public function exportar(){
			//load our new PHPExcel library
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//set cell A1 content with some text
			$this->excel->setActiveSheetIndex(0);
	    $this->excel->getActiveSheet()->setTitle('Maestro de Articuloas');
	    $this->excel->getActiveSheet()->setCellValue('A2', 'Maestro de articulos activos');
	    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
	    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	    $this->excel->getActiveSheet()->mergeCells('A2:H2');
			$articulos=$this->Marticulo->getall();

			//cabeceras
			$this->excel->getActiveSheet()->setCellValue('A4','Código');
			$this->excel->getActiveSheet()->setCellValue('B4','Descripción');
			$this->excel->getActiveSheet()->setCellValue('C4','Unidad');
			$this->excel->getActiveSheet()->setCellValue('D4','Familia');
			//cuerpo
			$fila=5;
			foreach ($articulos as $key) {
				$this->excel->getActiveSheet()->setCellValue('A'.$fila,$key->ACODIGO);
				$this->excel->getActiveSheet()->setCellValue('B'.$fila,utf8_encode($key->ADESCRI));
	      $this->excel->getActiveSheet()->setCellValue('C'.$fila,$key->AUNIDAD);
				$this->excel->getActiveSheet()->setCellValue('D'.$fila,$key->AFAMILIA);
				$fila++;
			}
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
	    $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
	    $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
	    $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);




			$filename='Maestro de articulos '.date('d-m-Y').'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}

		public function test(){
			$articulos_activos=$this->Marticulo->prueba(0,20,'acc');
			$eliminarcaracteres= array("\r\n", "\n", "\r");

			$datos = array();
			foreach ($articulos_activos->result() as $row) {
				$array= array();
				$array['ROW']=$row->ROW;
				$array['ADESCRI']=str_replace($eliminarcaracteres,'',str_replace('"',"'",utf8_encode($row->ADESCRI)));
				$array['ACODIGO']=$row->ACODIGO;
				$array['STSSERIE']=$row->STSSERIE;
				$array['AUNIDAD']=$row->AUNIDAD;
				$array['AFAMILIA']=$row->AFAMILIA;
				$datos[]=$array;
			}

			echo json_encode($datos);
		}
		public function getArticulo(){
			$codigo=$this->input->post('articuloid');


			$info=($this->Marticulo->getArticulo($codigo));

			echo json_encode($info);
		}
		public function fichatecnica(){
			$codigo=$this->input->post('codigo');
			echo utf8_encode($this->Marticulo->getfichatecnica($codigo));

		}
		public function addItem(){
			$codigo=$this->input->post('codigo');
		echo utf8_encode($this->Marticulo->addItem($codigo));
		}

		public function getseriesdsponibles(){
			$codigo=$this->input->post('codigo');
			$almacen=$this->session->userdata('alm_id');
			$series=$this->Marticulo->getseriesdsponibles($codigo,$almacen);
			echo json_encode($series);
		}

		public function buscar_stock(){
			$codigo=$this->input->post('codigo');

			$articulo=$this->Marticulo->articuloFromStkart($codigo);
			echo $articulo;

		}

	}
 ?>
