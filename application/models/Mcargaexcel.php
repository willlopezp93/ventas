<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcargaexcel extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function insertar_temporal($data){
          $starsoft=$this->load->database('starsoft',TRUE);
          $query=$starsoft->query("SELECT * FROM MAEART WHERE ACODIGO='".$data['codigo']."'");
          if ($query->num_rows()>0) {
            $data2= array(  'item' =>$data['item'] ,
                            'codigo' =>$data['codigo'] ,
                            'unidad'  =>$data['unidad'],
                            'cantidad'=>$data['cantidad'],
                            'precio'=>$data['precio'],
                            'descripcion'=>$data['descripcion'],
                            'usuario'=>$this->session->userdata('user_id'),
                            'descuento'=>$data['descuento'],
                            'tiempo'=>$data['tiempo'],
                            'dias'=>$data['dias'],
                            'stock'=>$data['stock']
                           );
            $this->db->insert('carga_excel', $data2);
          }
  }

  public function listarcarga(){

    $query=$this->db->query("select*, 0 as 'stock' from carga_excel where usuario=".$this->session->userdata('user_id')." order by item asc");
    $temporal=$query->result();

      return $temporal;
  }


  public function eliminar($id){
    $starsoft=$this->load->database('starsoft',TRUE);
      $starsoft->where('id',$id);
      $starsoft->delete('004BDAPLICACION..CARGA_EXCEL2');

  }

  public function consumo_listar_temporal($seriedoc){
    $starsoft=$this->load->database('starsoft',TRUE);
    $starsoft->DISTINCT();
    $starsoft->select(" t.*,case when ADESCRI IS null then 'Codigo o serie no existe' else ADESCRI end ADESCRI");
    $starsoft->from('004BDAPLICACION..CARGA_EXCEL2 t');
    $starsoft->join('alm_virtual m',"t.codigo=m.acodigo and  (t.SERIE=m.stsserie or (t.serie='' and m.stsserie is null) OR (t.SERIE!=m.stsserie))",'left');
    $starsoft->where('t.IDUSUARIO',$this->session->userdata('user_id'));
    $starsoft->order_by('ID');
    $query=$starsoft->get();

    $temporal=$query->result();
    if($query->num_rows()>0){
      foreach ($temporal as $key) {
          $data['item']=$key->ID;
          $data['codigo']=$key->CODIGO;
          $data['serie']=$key->SERIE;
          $data['cantidad']=$key->CANTIDAD;
          $data['maquina']=$key->MAQUINA;
          $data['docref']=$key->DOC_REF;
          $data['descripcion']=utf8_encode($key->ADESCRI);
        #  $data['idsolicitante']=$key->idsolicitante;



        $this->db->select('fullname');
            $this->db->from ('solicitantes');
          if(is_null($key->idsolicitante)){$key->idsolicitante='NULL';}
            $this->db->where ('codigo',utf8_encode($key->idsolicitante));
          $this->db->where ('contratoid',$this->session->userdata('alm_id'));
           $solicitante=$this->db->get();
            $data['idsolicitante']=$solicitante->row('fullname');



          $this->db->select('descripcion');
             $this->db->from ('centrocostointerno');
             if(is_null($key->area)){$key->area='NULL';}
            $this->db->where ('CODIGO',utf8_encode($key->area));
            $this->db->where ('contratoid',$this->session->userdata('alm_id'));
            $area=$this->db->get();
            $data['area']=$area->row('descripcion');

        #  $data['area']=$key->area;
          //Adjuntar el stock actual a la vista de carga

          $this->db->select('stock');
          $this->db->from('stkart');
          $this->db->where('seriedocid',$seriedoc);
          $this->db->where('contratoid',$this->session->userdata('alm_id'));
          $this->db->where('articuloid', $key->CODIGO);
          //cambiar null por 'NULL'
          if(trim($key->SERIE,' ')=='' or is_null($key->SERIE)){$key->SERIE='NULL';}
          $this->db->where('seriearticulo',$key->SERIE);
          $query=$this->db->get();

          if ($query->num_rows()>0) {
              $data['stockactual']=$query->row()->stock;
          }
          if($query->num_rows()==0){
                $data['stockactual']='0';
          }


        $utf8carga[]=$data;


      }
      return $utf8carga;
    }else{
      return 0;
    }

  }
  public function consumo_listar_temporal2($seriedoc){

    $starsoft=$this->load->database('starsoft',TRUE);
    $starsoft->DISTINCT();
    $starsoft->select("t.*,case when ADESCRI IS null then 'Codigo o serie no existe' else ADESCRI end ADESCRI");
    $starsoft->from('004BDAPLICACION..CARGA_EXCEL2 t');
    $starsoft->join('alm_virtual m',"t.codigo=m.acodigo and  (t.SERIE=m.stsserie or (t.serie='' and m.stsserie is null) OR (t.SERIE!=m.stsserie))",'left');
    $starsoft->where('t.IDUSUARIO',$this->session->userdata('user_id'));
    $starsoft->order_by('ID');
    $query=$starsoft->get();

    $temporal=$query->result();
    if($query->num_rows()>0){
      foreach ($temporal as $key) {
          $data['item']=$key->ID;
          $data['codigo']=$key->CODIGO;
          $data['serie']=$key->SERIE;
          $data['cantidad']=$key->CANTIDAD;
          $data['maquina']=$key->MAQUINA;
          $data['docref']=$key->DOC_REF;
          $data['descripcion']=utf8_encode($key->ADESCRI);
        #  $data['idsolicitante']=$key->idsolicitante;



        $this->db->select('fullname');
            $this->db->from ('solicitantes');
          if(is_null($key->idsolicitante)){$key->idsolicitante='NULL';}
            $this->db->where ('codigo',utf8_encode($key->idsolicitante));
          $this->db->where ('contratoid',$this->session->userdata('alm_id'));
           $solicitante=$this->db->get();
            $data['idsolicitante']=$solicitante->row('fullname');



          $this->db->select('descripcion');
             $this->db->from ('centrocostointerno');
             if(is_null($key->area)){$key->area='NULL';}
            $this->db->where ('idcentrocosto',utf8_encode($key->area));
            $this->db->where ('contratoid',$this->session->userdata('alm_id'));
            $area=$this->db->get();
            $data['area']=$area->row('descripcion');

        #  $data['area']=$key->area;
          //Adjuntar el stock actual a la vista de carga

          $this->db->select('stock');
          $this->db->from('stkart');
          $this->db->where('seriedocid',$seriedoc);
          $this->db->where('contratoid',$this->session->userdata('alm_id'));
          $this->db->where('articuloid', $key->CODIGO);
          //cambiar null por 'NULL'
          if(trim($key->SERIE,' ')=='' or is_null($key->SERIE)){$key->SERIE='NULL';}
          $this->db->where('seriearticulo',$key->SERIE);
          $query=$this->db->get();

          if ($query->num_rows()>0) {
              $data['stockactual']=$query->row()->stock;
          }
          if($query->num_rows()==0){
                $data['stockactual']='0';
          }


        $utf8carga[]=$data;


      }
      return $utf8carga;
    }else{
      return 0;
    }

  }



}
