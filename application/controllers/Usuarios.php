<?php
	/**
	 *
	 */
	class Usuarios extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Musuario');
			$this->load->model('Mcontrato');
			$this->load->model('Mperfil');
		}

		public function index(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('usuarios/grid_usuarios');
			$this->load->view('layout/footer');
		}

		public function get(){
			$usuarios=$this->Musuario->get($this->session->userdata('rol_id'),$this->session->userdata('alm_id'));

			echo json_encode($usuarios);
		}
		public function save(){
		$tipoaccion=$this->input->post('txtAccion');

		$datos['usuarioid']=$this->input->post('txtIdusuario');
		$datos['nombre']=$this->input->post('txtNombres');
		$datos['apepat']=$this->input->post('txtApepat');
		$datos['apemat']=$this->input->post('txtApemat');
		$datos['documento']=$this->input->post('txtDni');
		$datos['correo']=$this->input->post('txtCorreo');
		$datos['estado']=1;
		$datos['usuario']=$this->input->post('txtDni');
		$datos['cargo']=$this->input->post('txtCargo');
		$datos['clave']=$this->input->post('txtDni');
		$datos['fecha_creacion']=date('Y-m-d H:i:s');
		$datos['area']=$this->input->post('txtArea');
		$datos['rolid']=$this->input->post('cbotipo');


		if($this->Musuario->validar($datos['documento'],$datos['usuarioid'])<1){

			if($tipoaccion=='nuevo'){

					$config = [
				"upload_path" => "./assets/img/firmas/",
				'allowed_types' => "png|jpg"
			];
			$this->load->library("upload",$config);

		if ($this->upload->do_upload('txtFirma')) {
			$data = array("upload_data" => $this->upload->data());
			$datos['firma_usuario']=$data['upload_data']['file_name'];
			$msg='se subio correctamente la firma';
		}else{
				$datos['firma_usuario']='';
				$msg=$this->upload->display_errors();
			}




				//insertar a la tabla usuario
				$usuarioid_inserted=$this->Musuario->insertarUsuario($datos);
				if($usuarioid_inserted != 0){
					//si se inserta, insertamos sus accesos
					if($this->session->rol_id==1){
						$contratos=$this->Mcontrato->get(1);

						foreach ($contratos as $key) {
							$resultado=$this->Musuario->insertarAccesos($usuarioid_inserted,$key->contratoid,$this->input->post('cbo_tipo_'.$key->contratoid));

						}
						ECHO 'Nuevo usuario registrado '.$msg;
					}
					if($this->session->rol_id!=1){
						$this->Musuario->insertarAccesos($usuarioid_inserted,$this->session->alm_id,$this->input->post('cbotipo'));
					}
				}
				else{
					echo 'No se grabo correctamente';
				}


			}
			if($tipoaccion=='editar'){

				if($this->session->rol_id==1){

					$nuevos_datos = array('nombre' => $datos['nombre'],
											'apepat' => $datos['apepat'],
											'apemat' => $datos['apemat'],
											'documento'=>$datos['documento'],
											'correo' => $datos['correo'],
											'estado' => 1,
											'cargo'  => $datos['cargo']
										);

										$config = [
									"upload_path" => "./assets/img/firmas",
									'allowed_types' => "png|jpg"
								];
								$this->load->library("upload",$config);

							if ($this->upload->do_upload('txtFirma')) {
								$data = array("upload_data" => $this->upload->data());
								$datos['firma_usuario']=$data['upload_data']['file_name'];
								$msg='se subio correctamente la firma';
							}else{
									$datos['firma_usuario']='';
									$msg=$this->upload->display_errors();
								}

					$this->Musuario->updateUsuario($nuevos_datos,$datos['usuarioid']);
					$contratos=$this->Mcontrato->get(1);

					foreach ($contratos as $key) {
						$resultado=$this->Musuario->updateaccesos($datos['usuarioid'],$this->input->post('cbo_tipo_'.$key->contratoid),$key->contratoid);
					}
				}
				echo $resultado;
			}
		}
		else{
			if ($tipoaccion='nuevo') {
				$this->db->select('usuarioid');
				$this->db->from('usuario');
				$this->db->where('documento',$datos['documento']);
				$query=$this->db->get();
				$usuarioid=$query->row('usuarioid');
				$contratos=$this->Mcontrato->get(1);

				foreach ($contratos as $key) {
					$resultado=$this->Musuario->insertarAccesos($usuarioid,$key->contratoid,$this->input->post('cbo_tipo_'.$key->contratoid));
			}
				}
			echo 'Ya existe un usuario registrado con ese DNI';
		}
	}


		public function accesos(){
			$usuarioid=$this->input->post('usuarioid');
			$data['accesos']=$this->Musuario->getaccesos($usuarioid);
			$data['perfiles']=$this->Mperfil->getperfiles();
			$this->load->view('usuarios/grid_accesos',$data);
		}
	}
 ?>
