<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreportesig extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getvales($contrato){
    $this->db->distinct();
    $this->db->select('doc_referencia');
    $this->db->from('movalmdet');
    $this->db->where('contratoid', $contrato);
    $this->db->like('doc_referencia', 'VS N°');
    $query=$this->db->get();
    return $query->result();
  }

  public function getdetalles($vale,$contrato){
    $this->db->select('t0.codigo "ARTICULO",t0.serie,t0.descripcion,t0.familia,t0.unidad,t0.cantidad,t0.maquina,t1.codigo,t0.seriedocid');
    $this->db->from('movalmdet t0');
    $this->db->join('solicitantes t1','t1.codigo=t0.solicitante and t0.contratoid=t1.contratoid','left');
    $this->db->where('t0.doc_referencia', $vale);
    $this->db->where('t0.contratoid', $contrato);
    $query=$this->db->get();
    $detalles = array();
    return $query->result();

  }

  public function insertar_reporte($cabecera,$detalle){
    $this->db->insert('reportesig_cab', $cabecera);
    if($this->db->affected_rows()>0){

      $idcabecera=$this->db->insert_id();
      $fila = array();
      foreach ($detalle as $key) {

        $fila['item']=$key->item;
        $fila['codigo']=$key->codigo;
        $fila['descripcion']=$this->getdescripcion($key->codigo);
        $fila['unidad']=$key->unidad;
        $seriearticulo=($key->serie=='')?'NULL':$key->serie;
        $fila['seriearticulo']=$seriearticulo;
        $fila['cantidad']=$key->cantidad;
        $fila['maquina']=$key->maquina;
        $fila['guia']=$key->seriedocid;
        $fila['idreportesigcab']=$idcabecera;
        $fila['contratoid']=$this->session->userdata('alm_id');

        #  $this->db->select('codigo');
        #  $this->db->from('solicitantes');
        #  $this->db->where('fullname',$key->solicitante);
        #  $solicitante=$this->db->get();

        #$fila['solicitante']=$solicitante->row('codigo') ;
        $fila['solicitante']=$key->solicitante;
        $this->db->insert('reportesig_det', $fila);
        $this->db->last_query().'<br>';
      }
      return "Se registro correctamente";
    }else{
      return 'Hubo un error al registrar el reporte';
    }
  }

  public function getdescripcion($codigo){
    $this->db->select('descripcion');
    $this->db->from('stkart');
    $this->db->where('articuloid', $codigo);
    $this->db->limit(1);
    $query=$this->db->get();
    return $query->row()->descripcion;

  }

  public function getcabecerasig($id){
    $this->db->select('*');
    $this->db->from('reportesig_cab');
    $this->db->where('idreportesig',$id);
    $query=$this->db->get();

    return $query->row();
  }

  public function getdetallesig($id){
  # $this->db->select('*');
    $this->db->select('t0.item,t0.codigo,t0.descripcion,t0.unidad,t0.seriearticulo,t0.cantidad,t0.maquina,t0.guia,t0.idreportesigcab,t0.contratoid,ifnull(t1.fullname,"-") as nombre');
    $this->db->from('reportesig_det t0');
    $this->db->join('solicitantes t1','t1.codigo=t0.solicitante and t0.contratoid=t1.contratoid','left');
    $this->db->where('t0.idreportesigcab',$id);
    $query=$this->db->get();
    return $query->result();

  }
  public function getreportessig(){
    $this->db->select('*');
    $this->db->from('reportesig_cab');
    $this->db->where('contratoid',$this->session->userdata('alm_id'));
    $query=$this->db->get();
    return $query->result();
  }
  public function deletereporte($id){

    $this->db->trans_begin();

    $this->db->where('idreportesig', $id);
    $this->db->delete('reportesig_cab');

    $this->db->where('idreportesigcab', $id);
    $this->db->delete('reportesig_det');
    $this->db->last_query();
if ($this->db->trans_status() === FALSE)
{
        $this->db->trans_rollback();
        return '0';
}

else
{
        $this->db->trans_commit();
        return '1';
}




  }

}
