<?php
	/**
	 *
	 */
	class Marticulo extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		public function getall($tipo,$cadena){
			$starsoft=$this->load->database('starsoft',TRUE);
			if ($tipo=='acodigo') {
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO  like '%".$cadena."%' ");
			}elseif ($tipo=='descripcion') {
				$newcadena=str_replace("%20","%",$cadena);
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and adescri like '%".$newcadena."%' ");
			}elseif ($tipo=='cod_rockdrill') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_rockdrill like '%".$cadena."%' ")->row('articuloid');
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like'%".$result."%' ");
			}	elseif ($tipo=='num_parte') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE num_parte like '%".$cadena."%' ")->row('articuloid');
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente1') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente1 like '%".$cadena."%' ")->row('articuloid');
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente2') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente2 like '%".$cadena."%' ")->row('articuloid');
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente3') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente3 like '%".$cadena."%' ")->row('articuloid');
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente4') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente4 like '%".$cadena."%' ")->row('articuloid');
				$query=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',AFAMILIA FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}
			$temporal=$query->result();
			if($query->num_rows()>0){
			foreach ($temporal as $key) {
				$data['acodigo']=$key->articuloid;

				$this->db->select('num_parte');
        $this->db->from ('maeart');
        $this->db->where ('articuloid',$key->articuloid);
        $num_parte=$this->db->get();
				if ($num_parte->num_rows()<1) {
					$data['num_parte']='';
				}else {
					$data['num_parte']=$num_parte->row('num_parte');
				}


				$this->db->select('cod_rockdrill');
        $this->db->from ('maeart');
        $this->db->where ('articuloid',$key->articuloid);
        $cod_rockdrill=$this->db->get();
				if ($cod_rockdrill->num_rows()<1) {
					$data['cod_rockdrill']='';
				}else {
					$data['cod_rockdrill']=$cod_rockdrill->row('cod_rockdrill');
				}

				$this->db->select('cod_cliente1');
        $this->db->from ('maeart');
        $this->db->where ('articuloid',$key->articuloid);
        $cod_cliente1=$this->db->get();
				if ($cod_cliente1->num_rows()<1) {
					$data['cod_cliente1']='';
				}else {
					$data['cod_cliente1']=$cod_cliente1->row('cod_cliente1');
				}


				$this->db->select('cod_cliente2');
				$this->db->from ('maeart');
				$this->db->where ('articuloid',$key->articuloid);
				$cod_cliente2=$this->db->get();
				if ($cod_cliente2->num_rows()<1) {
					$data['cod_cliente2']='';
				}else {
				$data['cod_cliente2']=$cod_cliente2->row('cod_cliente2');
				}


				$this->db->select('cod_cliente3');
				$this->db->from ('maeart');
				$this->db->where ('articuloid',$key->articuloid);
				$cod_cliente3=$this->db->get();
				if ($cod_cliente3->num_rows()<1) {
					$data['cod_cliente3']='';
				}else {
					$data['cod_cliente3']=$cod_cliente3->row('cod_cliente3');
				}


				$this->db->select('cod_cliente4');
				$this->db->from ('maeart');
				$this->db->where ('articuloid',$key->articuloid);
				$cod_cliente4=$this->db->get();
				if ($cod_cliente4->num_rows()<1) {
					$data['cod_cliente4']='';
				}else{
					$data['cod_cliente4']=$cod_cliente4->row('cod_cliente4');
				}


				$data['ADESCRI']=$key->descripcion;
				$data['AFAMILIA']=$key->AFAMILIA;
				$data['AUNIDAD']=$key->unidad_med;


				$utf8carga[]=$data;
			}

			return $utf8carga;
		}else {
			return 0;
		}
		}

		public function familia(){
			$starsoft=$this->load->database('starsoft',TRUE);
			$query=$starsoft->query("select FAM_CODIGO,FAM_NOMBRE from familia where fam_codigo in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE')");
			return $query->result();
		}

		public function buscar($tipo,$cadena,$almacen){
			$starsoft=$this->load->database('starsoft',TRUE);
			if ($tipo=='acodigo') {
				if ($cadena=='texto') {
					$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',0  as 'STKPRIN' FROM MAEART WHERE aestado='V' and ACODIGO  like '%".$cadena."%' ");
				} else {
					$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO  like '%".$cadena."%' ");
				}

			}elseif ($tipo=='descripcion') {
				$newcadena=str_replace("%20","%",$cadena);
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and adescri like '%".$newcadena."%' ");
			}elseif ($tipo=='cod_rockdrill') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_rockdrill like '%".$cadena."%' ")->row('articuloid');
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like'%".$result."%' ");
			}	elseif ($tipo=='num_parte') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE num_parte like '%".$cadena."%' ")->row('articuloid');
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente1') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente1 like '%".$cadena."%' ")->row('articuloid');
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente2') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente2 like '%".$cadena."%' ")->row('articuloid');
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente3') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente3 like '%".$cadena."%' ")->row('articuloid');
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente4') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente4 like '%".$cadena."%' ")->row('articuloid');
				$data=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med',(select stskdis from stkart where stalma='".$almacen."' and stcodigo=ACODIGO) as 'STKPRIN' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','VENT','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}

			if($data->num_rows()>0){
				$temporal=$data->result();
				foreach ($temporal as $key) {
					$info['articuloid']=$key->articuloid;
					$info['descripcion']=$key->descripcion;
					$info['unidad_med']=$key->unidad_med;
					$info['STKPRIN']=$key->STKPRIN;
					$query=$this->db->query('select precio_usd from precio_articulo where articuloid="'.$key->articuloid.'"');
					if ($query->num_rows()>0) {
							$info['precio_usd']=$query->row('precio_usd');
					}else {
						$info['precio_usd']='0.00';
					}
						$utf8carga[]=$info;
				}
					return $utf8carga;
			}else {
				return 0;
			}

		}

		public function centrocosto($tipo,$cadena){
						$starsoft=$this->load->database('starsoft',TRUE);
			if ($tipo=='acodigo') {
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO  like '%".$cadena."%' ");
			}elseif ($tipo=='descripcion') {
				$newcadena=str_replace("%20","%",$cadena);
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and adescri like '%".$newcadena."%' ");
			}elseif ($tipo=='cod_rockdrill') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_rockdrill like '%".$cadena."%' ")->row('articuloid');
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like'%".$result."%' ");
			}	elseif ($tipo=='num_parte') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE num_parte like '%".$cadena."%' ")->row('articuloid');
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente1') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente1 like '%".$cadena."%' ")->row('articuloid');
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente2') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente2 like '%".$cadena."%' ")->row('articuloid');
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente3') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente3 like '%".$cadena."%' ")->row('articuloid');
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}elseif ($tipo=='cod_cliente4') {
				$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente4 like '%".$cadena."%' ")->row('articuloid');
				$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
			}

			if ($query2->num_rows()>0) {
				$temporal=$query2->result();
				foreach ($temporal as $key) {
					$data['articuloid']=$key->articuloid;
					$query=$this->db->query("SELECT centrocosto FROM centrodecosto where articuloid='".$key->articuloid."'");

					if ($query->num_rows()<1) {
						$data['centrocosto']='';
					}else {
						$data['centrocosto']=$query->row('centrocosto');
					}
					$data['descripcion']=$key->descripcion;
					$utf8carga[]=$data;
				}

				return $utf8carga;
			}else {
				return 0;
			}


		}
		public function precio($tipo,$cadena){
			$starsoft=$this->load->database('starsoft',TRUE);
if ($tipo=='acodigo') {
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO  like '%".$cadena."%' ");
}elseif ($tipo=='descripcion') {
	$newcadena=str_replace("%20","%",$cadena);
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and adescri like '%".$newcadena."%' ");
}elseif ($tipo=='cod_rockdrill') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_rockdrill like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like'%".$result."%' ");
}	elseif ($tipo=='num_parte') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE num_parte like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente1') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente1 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente2') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente2 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente3') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente3 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente4') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente4 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}
$temporal=$query2->result();

				if ($query2->num_rows()>0) {
						foreach ($temporal as $key) {
							$data['articuloid']=$key->articuloid;
							$query=$this->db->query("SELECT precio_usd FROM precio_articulo where articuloid='".$key->articuloid."'");

							if ($query->num_rows()<1) {
								$data['precio']='';
							}else {
								$data['precio']=number_format($query->row('precio_usd'),2);
							}
							$data['descripcion']=$key->descripcion;
							$utf8carga[]=$data;
						}
						return $utf8carga;
					}else {
						return 0;
					}
		}
		public function costo($tipo,$cadena){
			$starsoft=$this->load->database('starsoft',TRUE);
if ($tipo=='acodigo') {
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO  like '%".$cadena."%' ");
}elseif ($tipo=='descripcion') {
	$newcadena=str_replace("%20","%",$cadena);
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and adescri like '%".$newcadena."%' ");
}elseif ($tipo=='cod_rockdrill') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_rockdrill like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like'%".$result."%' ");
}	elseif ($tipo=='num_parte') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE num_parte like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente1') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente1 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente2') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente2 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente3') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente3 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente4') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente4 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}
$temporal=$query2->result();

				if ($query2->num_rows()>0) {
						foreach ($temporal as $key) {
							$data['articuloid']=$key->articuloid;
							$query=$this->db->query("SELECT costo FROM costo_articulo where articuloid='".$key->articuloid."'");

							if ($query->num_rows()<1) {
								$data['costo']='';
							}else {
								$data['costo']=number_format($query->row('costo'),2);
							}
							$data['descripcion']=$key->descripcion;
							$utf8carga[]=$data;
						}
						return $utf8carga;
					}else {
						return 0;
					}
		}
		public function descuento($tipo,$cadena){
			$starsoft=$this->load->database('starsoft',TRUE);
if ($tipo=='acodigo') {
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO  like '%".$cadena."%' ");
}elseif ($tipo=='descripcion') {
	$newcadena=str_replace("%20","%",$cadena);
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and adescri like '%".$newcadena."%' ");
}elseif ($tipo=='cod_rockdrill') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_rockdrill like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like'%".$result."%' ");
}	elseif ($tipo=='num_parte') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE num_parte like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente1') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente1 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente2') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente2 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente3') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente3 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}elseif ($tipo=='cod_cliente4') {
	$result=$this->db->query("SELECT articuloid FROM maeart WHERE cod_cliente4 like '%".$cadena."%' ")->row('articuloid');
	$query2=$starsoft->query("SELECT ACODIGO as 'articuloid',ADESCRI as 'descripcion',AUNIDAD as 'unidad_med' FROM MAEART WHERE aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT') and ACODIGO like '%".$result."%' ");
}
$temporal=$query2->result();

				if ($query2->num_rows()>0) {
						foreach ($temporal as $key) {
							$data['articuloid']=$key->articuloid;
							$query=$this->db->query("SELECT desc_maximo FROM precio_articulo where articuloid='".$key->articuloid."'");

							if ($query->num_rows()<1) {
								$data['descuento']='';
							}else {
								$data['descuento']=number_format($query->row('desc_maximo'),4);
							}
							$data['descripcion']=$key->descripcion;
							$utf8carga[]=$data;
						}
						return $utf8carga;
					}else {
						return 0;
					}
		}
		public function articuloFromStkart($codigo){
			$starsoft=$this->load->database('starsoft',TRUE);
			$query=$starsoft->query("select STSKDIS from stkart where STALMA='01' AND STCODIGO='".$codigo."'");
			if ($query->num_rows()==0) {
				return 0;
			} else {
				$temporal=$query->row('STSKDIS');
				return $temporal;
			}
		}

		public function articulo_sin_cc(){
/*
$filtro=$this->articulos_cc();
$room_id= "'";
 foreach($filtro as $row){
		$room_id = $room_id.$row->ACODIGO."','";
	}

 $item=trim($room_id, ",'");*/
$starsoft=$this->load->database('starsoft',TRUE);
$query=$starsoft->query("SELECT ADESCRI,AFAMILIA,AUNIDAD,ACODIGO FROM maeart m where m.aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE','ADT')");

	//$query=$this->db->query("select articuloid 'ACODIGO',descripcion 'ADESCRI',familia 'AFAMILIA' from centrodecosto where centrocosto  like ''");
return $query->result_array();
}

 function articulos_cc(){
	$query=$this->db->query("select articuloid 'ACODIGO',descripcion 'ADESCRI',familia 'AFAMILIA',centrocosto from centrodecosto where centrocosto not like ''");
	return $query->result_array();
}
	}
 ?>
