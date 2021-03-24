<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtablaayuda extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

public function tiempo_entrega(){
$query=$this->db->query('SELECT idtiempo,plazo, case when plazo="editable" or plazo="inmediato" then plazo else concat(plazo," D.H.") end "texto" FROM tiempo_entrega order by idtiempo desc');
return  $query->result();
}

public function savetiempo($objeto){
  $this->db->insert('tiempo_entrega', $objeto);
  if($this->db->affected_rows()>0){
    return 1;
  }
  else{
    return 0;
  }
}
public function updatetiempo($objeto,$idtiempo){
  $this->db->where('idtiempo', $idtiempo);
  $this->db->update('tiempo_entrega', $objeto);
  if($this->db->affected_rows()>0){
    return 1;
  }
  else{
    return 0;
  }
}
public function eliminar_tiempo($id){
  $this->db->where('idtiempo', $id);
  $this->db->delete('tiempo_entrega');


  return "Tiempo de entrega eliminado";

}
public function get_forma_pago(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query('SELECT COD_FP,DES_FP from forma_pago');
  return $query->result();
}
public function forma_pago_cliente($cliente){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT COD_FP,DES_FP, case when COD_FP=(select ctipvta from maecli where ccodcli = '".$cliente."') then '1' else '0' end as 'Seleccionado' from forma_pago order by 'seleccionado' desc");
  return $query->result();
}
public function vendedor(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT cod_ven,Num_Doc,Des_Ven from vendedor where cod_ven not in('06','05','04','03','02','09','01')");
  return $query->result();
}
public function clientes(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("select ccodcli,cnomcli,cdircli,ctelefo from maecli where CESTADO='V'");
  return $query->result();
}
public function punto_venta(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT pv_cod,pv_des,pv_alma,(select TADESCRI from TABALM where TAALMA=PV_ALMA) 'almacen' FROM BDWENCO..PUNTO_VENTA WHERE PV_EMPRESA='010'");
  return $query->result();
}
public function ptoventa_almacen($pto_venta){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT pv_alma FROM BDWENCO..PUNTO_VENTA WHERE PV_EMPRESA='010' and pv_cod like '".$pto_venta."'");
  return $query->row('pv_alma');
}
public function almacenes(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query('select taalma,tadescri from TABALM');
  return $query->result();
  }
public function stock($almacen){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("select t0.stcodigo,t1.adescri,t0.stskdis,t0.stkprepro,t0.STKPREPROUS,t1.AUNIDAD from stkart t0 inner join MAEART t1 on t1.acodigo=t0.stcodigo where t1.aestado='V' and t1.AFAMILIA not in('VAR','ACT','TI','epp','ao') and t0.stalma='".$almacen."'");
  return $query->result();
  }

  public function contacto($cliente){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query(" SELECT * FROM CONTACTO_VENTA WHERE cod_cliente like '%".$cliente."%'");
  return $query->result();
  }

  public function direcciones($cliente){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("select cod_direccion,CDIRCLI from DIRE_CLIENTE where ccodcli='".$cliente."'");
  return $query->result();
  }
  public function descuento($cliente){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("select (npordes/100) as 'nrpodes' from maecli where ccodcli='".$cliente."'");
  return number_format($query->row('nrpodes'),2);
  }
  public function tipodecambio($fecha){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query(" select tipocamb_venta from [010bdcontabilidad]..TIPO_CAMBIO where TIPOCAMB_FECHA='".$fecha."'");
  return $query->row('tipocamb_venta');
  }
  public function correlativo($tipo){
    $this->db->select('correlativo');
    $this->db->from('correlativo');
    $this->db->where('serie_docid',$tipo);
    $query=$this->db->get();
    return $query->row('correlativo');
  }
  public function get_estado_producto(){
    $query=$this->db->get('estado_producto');
    return $query->result();
  }
  public function precio($codigo){
    $query=$this->db->query('select precio_usd from precio_articulo where articuloid="'.$codigo.'"');

    if ($query->num_rows()>0) {
        return $query->row('precio_usd');
    }else {
      return '0.00';
    }

  }
  public function vendedor_cliente($cliente){
    $starsoft=$this->load->database('starsoft',TRUE);
    $query=$starsoft->query("select cvende from MAECLI where ccodcli like '".$cliente."' ");
        return $query->row('cvende');
  }
}
