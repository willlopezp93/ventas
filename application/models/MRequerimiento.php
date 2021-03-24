
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRequerimiento extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_nota_req($idcabecera){
    $this->db->select('req_correlativo');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$idcabecera);
    $query=$this->db->get();
    return str_pad($query->first_row()->req_correlativo, 7, "0", STR_PAD_LEFT);
  }

  public function stockmin($contrato){
    $this->db->select('t0.articuloid,t1.descripcion,t0.stskmin,sum(t1.stock) as stock,t0.stskmin-sum(t1.stock) as diferencia');
    $this->db->from('gest_stock t0');
    $this->db->join('stkart t1','t1.contratoid=t0.idcontrato and t1.articuloid=t0.articuloid');
    $this->db->where('t0.idcontrato',$contrato);
    $this->db->group_by('t0.articuloid,t1.descripcion,t0.stskmin');
    $query=$this->db->get();

    $temporal=$query->result();

return $temporal;
  }


  public function getcabecerareq($id){
    $this->db->select('c.*,s.fullname,x.nombre');
    $this->db->from('reqmat_cab c');
    $this->db->join('solicitantes s','c.solicitante=s.codigo and s.contratoid=c.contratoid');
    $this->db->join('contrato x','x.contratoid=c.contratoid');
    $this->db->where('c.docentry', $id);
    $query=$this->db->get();
    return $query->row();
  }

  public function getdetallereq($id){
  # $this->db->select('*');
  $this->db->distinct();
  $this->db->select('t0.*,t1.descripcion');
  $this->db->from('reqmat_det t0');
  $this->db->join('maquinas t1','t0.maquina=t1.idmaquina and t0.idcontrato=t1.idcontrato','left');

  $this->db->where('t0.req_cab',$id);
  $this->db->order_by('t0.item_num','ASC');
  $query=$this->db->get();
  return $query->result();

  }

  public function get_detalle_req($idcabecera){
      $this->db->select('t0.*,t1.descripcion,(t0.cant_aprob-cant_atendida) "cant_pendiente",t2.estado_req');
      $this->db->from('reqmat_det t0');
      $this->db->join('maquinas t1','t0.maquina=t1.idmaquina and t0.idcontrato=t1.idcontrato','left');
      $this->db->join('reqmat_cab t2','t0.req_cab=t2.docentry');
      $this->db->where('t0.req_cab',$idcabecera);

      $query=$this->db->get();
      return $query->result();
  }
  public function get_detalle_sol($idcabecera){
      $this->db->select('*');
      $this->db->from('solcod_det');
      $this->db->where('sol_cab',$idcabecera);

      $query=$this->db->get();
      return $query->result();
  }
  public function eliminar($item_num,$req_cab){
 if(!empty($item_num)){
        $respuesta['item_num']=$item_num;
        $this->db->set('canceled','y');
        $this->db->where('item_num',$item_num);
        $this->db->where('req_cab',$req_cab);
        $this->db->update('reqmat_det');
    }

    $respuesta['afectados']=$this->db->affected_rows();
      return $respuesta;

  }

public function update_req($detalle,$req_cab){
  if ($this->session->userdata('rol_id')!=17) {
    foreach ($detalle as $key) {
      $newdata=array();
      if ($key->cant_req!=0 and $key->cant_req!='') {
        $this->db->set('cant_aprob',$key->cant_req);
          $this->db->set('cant_req',$key->cant_req);
        $this->db->where('item_num',$key->item_num);
        $this->db->where('req_cab',$req_cab);
        $this->db->update('reqmat_det');
        //$info['det']=$this->db->last_query();

      }

    }return 1;
  }
}


public function update_sol($detalle,$req_cab){
  if ($this->session->userdata('alm_id')==100) {
    foreach ($detalle as $key) {
      $newdata=array();
      if ($key->newobservaciones!='') {
        $this->db->set('observaciones',$key->newobservaciones);
        $this->db->where('item_num',$key->item_num);
        $this->db->where('sol_cab',$req_cab);
        $this->db->update('solcod_det');
        //$info['det']=$this->db->last_query();
      }
    }
    $this->db->set('estado',1);
    $this->db->set('fecha_atendida',date('Y-m-d'));
    $this->db->where('docentry',$req_cab);
    $this->db->update('solcod_cab');
    if($this->db->affected_rows()>0){
      return 0;
    }else{
      return 1;
    }
  }
}



  public function aprobar_req($detalle,$req_cab){
    $this->db->select('estado_req');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$req_cab);

    $query=$this->db->get();
    $estado=$query->row('estado_req');

    if ($estado!=0) {
      foreach ($detalle as $key) {
        $newdata=array();
        if ($key->cant_req!=0) {
          $this->db->set('cant_aprob',$key->cant_req);
          $this->db->where('item_num',$key->item_num);
          $this->db->where('req_cab',$req_cab);
          $this->db->update('reqmat_det');
          //$info['det']=$this->db->last_query();
        }
      }
    }
    $area=$this->session->userdata('area');
    $dni=$this->session->userdata('user_dni');
    $nombre=$this->session->userdata('user_nombre')." ".$this->session->userdata('user_apepat');
      if ($estado==0) {
        $this->db->set('estado_req',2);
        $this->db->where('docentry',$req_cab);
        $this->db->update('reqmat_cab');

        $this->db->set('firma_residente',$dni);
        $this->db->set('fecha_firma_residente',date('Y-m-d H:i:s'));
        $this->db->set('nombre_residente',$nombre);
        $this->db->where('req_cab',$req_cab);
        $this->db->update('reqmat_firmas');
      }
      if ($estado==2) {
        $this->db->set('estado_req',5);
        $this->db->where('docentry',$req_cab);
        $this->db->update('reqmat_cab');

        $this->db->set('firma_responsable',$dni);
        $this->db->set('fecha_firma_responsable',date('Y-m-d H:i:s'));
        $this->db->set('nombre_responsable',$nombre);
        $this->db->where('req_cab',$req_cab);
        $this->db->update('reqmat_firmas');
      }
      if ($estado==5) {
        if ($this->session->userdata('rol_id')==17) {
          $this->db->set('estado_req',3);
          $this->db->set('fecha_aprobacion',date('Y-m-d'));
          $this->db->where('docentry',$req_cab);
          $this->db->update('reqmat_cab');

          $this->db->set('firma_gerencia',$dni);
          $this->db->set('fecha_firma_gerencia',date('Y-m-d H:i:s'));
          $this->db->set('nombre_gerencia',$nombre);
          $this->db->where('req_cab',$req_cab);
          $this->db->update('reqmat_firmas');
        }
      }
      //$info['cab']=$this->db->last_query();

    return 1;
  }

public function insertar_linea($detalle,$itemcodigo){

  $carga=$detalle;

  $starsoft=$this->load->database('starsoft',TRUE);


  $desc=$starsoft->query("SELECT ADESCRI FROM MAEART WHERE ACODIGO='".$itemcodigo."'");
  $carga['itemdesc']=$desc->row('ADESCRI');

  $uni=$starsoft->query("SELECT AUNIDAD FROM MAEART WHERE ACODIGO='".$itemcodigo."'");
  $carga['itemunidad']=$uni->row('AUNIDAD');

  $this->db->insert('reqmat_det', $carga);
  if ($this->db->affected_rows()>0) {
    return 1;
  }
  else {
    return 0;
  }
}

public function anular_req($req_cab){
  $this->db->set('estado_req',4);
  $this->db->where('docentry',$req_cab);
  $this->db->update('reqmat_cab');
  $this->db->set('canceled','y');
  $this->db->where('req_cab',$req_cab);
  $this->db->update('reqmat_det');


}
  public function listar_req_lima($contrato,$estado){
    $this->db->select('c.*,s.fullname');
    $this->db->from('reqmat_cab c');
    $this->db->join('solicitantes s','c.solicitante=s.codigo and s.contratoid=c.contratoid');
    $this->db->where('c.contratoid', $contrato);
    $this->db->where('c.estado_req', $estado);
    $query=$this->db->get();
    return $query->result();
  }
  public function listar_req_gerencia($contrato,$estado){
    $this->db->select('c.*,s.fullname');
    $this->db->from('reqmat_cab c');
    $this->db->join('solicitantes s','c.solicitante=s.codigo and s.contratoid=c.contratoid');
    $this->db->where('c.contratoid', $contrato);
    $this->db->where('c.estado_req', $estado);

    $query=$this->db->get();
    return $query->result();
  }
  public function req_aprobar($area,$estado){
    $this->db->select('c.*,s.fullname');
    $this->db->from('reqmat_cab c');
    $this->db->join('solicitantes s','c.solicitante=s.codigo and s.contratoid=c.contratoid');
    $this->db->where('c.estado_req', $estado);
    $this->db->where('c.area',$area);
    $query=$this->db->get();
    return $query->result();
  }

  public function listar_req_log($contrato){
    $estado=array(6,3);
    $this->db->select('c.*,s.fullname');
    $this->db->from('reqmat_cab c');
    $this->db->join('solicitantes s','c.solicitante=s.codigo and s.contratoid=c.contratoid');
    $this->db->where('c.contratoid', $contrato);
    $this->db->where_in('c.estado_req',$estado);

    $query=$this->db->get();
    return $query->result();
  }
//obtener el stock de lima
  public function get_stock_lima($req_cab){

    $this->db->select('*, (cant_aprob-cant_atendida)  "cant_pendiente"');
    $this->db->from('reqmat_det');
    $this->db->where('req_cab',$req_cab);
    $this->db->where('canceled','n');
    $query=$this->db->get();
    $temporal=$query->result();

    if($query->num_rows()>0){
      foreach ($temporal as $key) {
        $data['item_num']=$key->item_num;
        $data['itemcodigo']=$key->itemcodigo;
        $data['cant_aprob']=$key->cant_aprob;
        $data['itemdesc']=$key->itemdesc;
        $data['itemunidad']=$key->itemunidad;
        $data['prioridad']=$key->prioridad;
        $data['maquina']=$key->maquina;
        $data['observaciones']=$key->observaciones;
        $data['canceled']=$key->canceled;
        $data['cant_pendiente']=$key->cant_pendiente;
        $starsoft=$this->load->database('starsoft',TRUE);

           $starsoft->select('STSKDIS');
           $starsoft->from('stkart');
           $starsoft->where('STCODIGO',$key->itemcodigo);
           $starsoft->group_by('STSKDIS');
           $query3=$starsoft->get();
           $data['STSKDIS']=$query3->row('STSKDIS');

  $utf8carga[]=$data;

  }     return $utf8carga;
}else{
  return 0;
}
}
//obtener el stock de r1
public function get_stock_r1($req_cab){

  $this->db->select('*, (cant_aprob-cant_atendida)  "cant_pendiente"');
  $this->db->from('reqmat_det');
  $this->db->where('req_cab',$req_cab);
  $this->db->where('canceled','n');
  $query=$this->db->get();
  $temporal=$query->result();

  if($query->num_rows()>0){
    foreach ($temporal as $key) {
      $data['item_num']=$key->item_num;
      $data['itemcodigo']=$key->itemcodigo;
      $data['cant_aprob']=$key->cant_aprob;
      $data['itemdesc']=$key->itemdesc;
      $data['itemunidad']=$key->itemunidad;
      $data['prioridad']=$key->prioridad;
      $data['maquina']=$key->maquina;
      $data['observaciones']=$key->observaciones;
      $data['canceled']=$key->canceled;
      $data['cant_pendiente']=$key->cant_pendiente;
         $this->db->select('stock');
         $this->db->from('stkart');
         $this->db->where('articuloid',$key->itemcodigo);
         $this->db->where('contratoid',14);
         $this->db->group_by('stock');
         $query3=$this->db->get();
         $data['STSKDIS']=$query3->row('stock');

$utf8carga[]=$data;

}     return $utf8carga;
}else{
return 0;
}
}

public function liberar_req($reqcab,$detalle){

  $this->db->select('estado_req');
  $this->db->from('reqmat_cab');
  $this->db->where('docentry',$reqcab);

  $query=$this->db->get();
  $estado=$query->row('estado_req');

  if ($estado==3) {
    foreach ($detalle as $key) {
      $newdata=array();
      if ($key->cant_req!=0) {
        $this->db->set('cant_aprob',$key->cant_req);
        $this->db->where('item_num',$key->item_num);
        $this->db->where('req_cab',$reqcab);
        $this->db->update('reqmat_det');
        //$info['det']=$this->db->last_query();
      }
    }
  }
  $area=$this->session->userdata('area');
  $dni=$this->session->userdata('user_dni');
  $nombre=$this->session->userdata('user_nombre')." ".$this->session->userdata('user_apepat');
  $this->db->set('estado_req',6);
  $this->db->where('docentry',$reqcab);
  $this->db->update('reqmat_cab');

  $this->db->set('firma_jefelog',$dni);
  $this->db->set('fecha_firma_jefelog',date('Y-m-d H:i:s'));
  $this->db->set('nombre_jefelog',$nombre);
  $this->db->where('req_cab',$reqcab);
  $this->db->update('reqmat_firmas');

  return $reqcab;
}


//despacho por Lima
public function despacho_lima($detalle,$req_cab){
  //iniciar transaccion
$error='';
$this->db->trans_begin();
//obtener cabecera del despacho
$cabecera=$this->getcabecerareq($req_cab);
$despachocab=array('contratoid'=>$cabecera->contratoid,
                    'req_cab'=>$req_cab,
                    'fecha_doc'=>date('Y-m-d'),
                    'responsable'=>$this->session->userdata('user_id'),
                    'centrocosto'=>$cabecera->centrocosto,
                    'almacen'=>'Lima-Starsoft',
                    'area'=>$cabecera->area
                  );
//insertar cabecera
$this->db->insert('despacho_cab', $despachocab);
//capturar id autoincrement
$lastid=$this->db->insert_id();
//array a retornar
$data=array();
$data['last_id']=$lastid;
//item correlativo
$item=1;
//capturar codigo en caso de error
$codigoconerror='';

if($cabecera->estado_req==1){
  $this->db->trans_rollback();
}

foreach ($detalle as $key) {
 if(!$this->validaratencioncodigo($key->item_numlima,$key->itemcodigolima,$req_cab,$key->cant_atendidalima)){
   $this->db->trans_rollback();
   $error='No se puede atender el codigo -> codigo:'.$key->itemcodigolima.'<br>';
 }else if($key->stocklima - $key->cant_atendidalima <0){
   $this->db->trans_rollback();
   $error='Cantidad atendida tiene que ser menor que el stock disponible'.($key->stocklima - $key->cant_atendidalima);
 }
 else if($key->cant_aproblima - $key->cant_atendidalima <0){
   $this->db->trans_rollback();
   $error='Cantidad atendida tiene que ser menor que la cantidad solicitada'.($key->cant_aproblima - $key->cant_atendidalima);
 }
 else{
   if ($key->cant_atendidalima!=0) {
     $this->db->set('cant_atendida','cant_atendida+'.$key->cant_atendidalima.'',false);
     $this->db->where('item_num',$key->item_numlima);
     $this->db->where('req_cab',$req_cab);
     $this->db->update('reqmat_det');
     //$info['det']=$this->db->last_query();
   }
   //insertar detalle del despacho
      if ($key->cant_atendidalima>0) {
   $despachodet = array('despacho_cab'=>$lastid,
                        'item'=>$item,
                        'itemcodigo'=>$key->itemcodigolima,




                    'itemunidad' => $key->itemunidadlima,
                        'itemcant' => $key->cant_atendidalima,


                      'itemprioridad' => $key->prioridadlima,


                      'itemmaquina' => $key->maquinalima,


                    'itemobserv' => $key->observacioneslima,

                      );
                      $this->db->select('itemdesc');
                      $this->db->from('reqmat_det');
                      $this->db->where('req_cab',$req_cab);
                      $this->db->where('itemcodigo',$key->itemcodigolima);
                      $descri=$this->db->get();
                      $itemdesc=$descri->row('itemdesc');

                        $despachodet['itemdesc']=$itemdesc;
                        $this->db->insert('despacho_det', $despachodet);
                  $item++;
 }
}
}

if ($error!='' or $this->db->trans_status() === FALSE)
{//hubo un error en la transaccion
  $this->db->trans_rollback();

    $data['msg']=$error;

    return $data;


}else{
  $this->db->trans_commit();
  //actualizar estado_req

$data['msg']='Despacho realizado con exito, dirigirse a Consultas/Despacho por 029';
if ($this->atencioncompleta($req_cab)==0) {
  $this->db->set('estado_req',1);
    $this->db->set('fecha_atendida',date('Y-m-d H:i:s'));
  $this->db->where('docentry',$req_cab);

  $this->db->update('reqmat_cab');

  $data['msg']='Se atendió completamente el requerimiento';

}
    return $data;
}



}




//despacho por r1
public function despacho_r1($detalle,$req_cab){
  //iniciar transaccion
$error='';
$this->db->trans_begin();
//obtener cabecera del despacho
$cabecera=$this->getcabecerareq($req_cab);
$despachocab=array('contratoid'=>$cabecera->contratoid,
                    'req_cab'=>$req_cab,
                    'fecha_doc'=>date('Y-m-d'),
                    'responsable'=>$this->session->userdata('user_id'),
                    'centrocosto'=>$cabecera->centrocosto,
                    'almacen'=>'Lima-R1',
                    'area'=>$cabecera->area
                  );
//insertar cabecera
$this->db->insert('despacho_cab', $despachocab);
//capturar id autoincrement
$lastid=$this->db->insert_id();
//array a retornar
$data=array();
$data['last_id']=$lastid;
//item correlativo
$item=1;
//capturar codigo en caso de error
$codigoconerror='';

if($cabecera->estado_req==1){
  $this->db->trans_rollback();
}

foreach ($detalle as $key) {
 if(!$this->validaratencioncodigo($key->item_numr1,$key->itemcodigor1,$req_cab,$key->cant_atendidar1)){
   $this->db->trans_rollback();
   $error='No se puede atender el codigo -> codigo:'.$key->itemcodigor1.'<br>';
 }else if($key->stockr1 - $key->cant_atendidar1 <0){
   $this->db->trans_rollback();
   $error='Cantidad atendida tiene que ser menor que el stock disponible'.($key->stockr1 - $key->cant_atendidar1);
 }
 else if($key->cant_aprobr1 - $key->cant_atendidar1 <0){
   $this->db->trans_rollback();
   $error='Cantidad atendida tiene que ser menor que la cantidad solicitada'.($key->cant_aprobr1 - $key->cant_atendidar1);
 }
 else{
   if ($key->cant_atendidar1!=0) {
      $this->db->set('cant_atendida','cant_atendida+'.$key->cant_atendidar1.'',false);
     $this->db->where('item_num',$key->item_numr1);
     $this->db->where('req_cab',$req_cab);
     $this->db->update('reqmat_det');
     //$info['det']=$this->db->last_query();
   }
   //insertar detalle del despacho
   if ($key->cant_atendidar1>0) {
     $despachodet = array('despacho_cab'=>$lastid,
                          'item'=>$item,
                          'itemcodigo'=>$key->itemcodigor1,



                      'itemunidad' => $key->itemunidadr1,
                          'itemcant' => $key->cant_atendidar1,


                        'itemprioridad' => $key->prioridadr1,


                        'itemmaquina' => $key->maquinar1,


                      'itemobserv' => $key->observacionesr1,

                        );
                        $this->db->select('itemdesc');
                        $this->db->from('reqmat_det');
                        $this->db->where('req_cab',$req_cab);
                        $this->db->where('itemcodigo',$key->itemcodigor1);
                        $descri=$this->db->get();
                        $itemdesc=$descri->row('itemdesc');

                          $despachodet['itemdesc']=$itemdesc;
                          $this->db->insert('despacho_det', $despachodet);
                    $item++;
   }
 }
}

if ($error!='' or $this->db->trans_status() === FALSE)
{//hubo un error en la transaccion
  $this->db->trans_rollback();

    $data['msg']=$error;

    return $data;


}else{
  $this->db->trans_commit();
  //actualizar estado_req
$data['msg']='Despacho realizado con exito, dirigirse a Consultas/Despacho por 031';
if ($this->atencioncompleta($req_cab)==0) {
  $this->db->set('estado_req',1);
  $this->db->set('fecha_atendida',date('Y-m-d H:i:s'));
  $this->db->where('docentry',$req_cab);

  $this->db->update('reqmat_cab');


  $data['msg']='Se atendió completamente el requerimiento';

}
    return $data;
}



}




////////////////////////////////////



//despacho por compra
public function despacho_compra($detalle,$req_cab){
  //iniciar transaccion
$error='';
$this->db->trans_begin();
//obtener cabecera del despacho
$cabecera=$this->getcabecerareq($req_cab);
$despachocab=array('contratoid'=>$cabecera->contratoid,
                    'req_cab'=>$req_cab,
                    'fecha_doc'=>date('Y-m-d'),
                    'responsable'=>$this->session->userdata('user_id'),
                    'centrocosto'=>$cabecera->centrocosto,
                    'almacen'=>'Requerimiento de Compra',
                    'area'=>$cabecera->area
                  );
//insertar cabecera
$this->db->insert('despacho_cab', $despachocab);
//capturar id autoincrement
$lastid=$this->db->insert_id();
//array a retornar
$data=array();
$data['last_id']=$lastid;
//item correlativo
$item=1;
//capturar codigo en caso de error
$codigoconerror='';

if($cabecera->estado_req==1){
  $this->db->trans_rollback();
}

foreach ($detalle as $key) {
 if(!$this->validaratencioncodigo($key->item_numcompra,$key->itemcodigocompra,$req_cab,$key->cant_atendidacompra)){
   $this->db->trans_rollback();
   $error='No se puede atender el codigo -> codigo:'.$key->itemcodigocompra.'<br>';
 }
 else if($key->cant_aprobcompra - $key->cant_atendidacompra <0){
   $this->db->trans_rollback();
   $error='Cantidad atendida tiene que ser menor que la cantidad solicitada'.($key->cant_aprobcompra - $key->cant_atendidacompra);
 }
 else{
   if ($key->cant_atendidacompra!=0) {
     $this->db->set('cant_atendida','cant_atendida+'.$key->cant_atendidacompra.'',false);
     $this->db->where('item_num',$key->item_numcompra);
     $this->db->where('req_cab',$req_cab);
     $this->db->update('reqmat_det');
     //$info['det']=$this->db->last_query();
   }
   //insertar detalle del despacho
      if ($key->cant_atendidacompra>0) {
   $despachodet = array('despacho_cab'=>$lastid,
                        'item'=>$item,
                        'itemcodigo'=>$key->itemcodigocompra,

                    'itemunidad' => $key->itemunidadcompra,
                        'itemcant' => $key->cant_atendidacompra,


                      'itemprioridad' => $key->prioridadcompra,


                      'itemmaquina' => $key->maquinacompra,


                    'itemobserv' => $key->observacionescompra,

                      );

                      $this->db->select('itemdesc');
                      $this->db->from('reqmat_det');
                      $this->db->where('req_cab',$req_cab);
                      $this->db->where('itemcodigo',$key->itemcodigocompra);
                      $descri=$this->db->get();
                      $itemdesc=$descri->row('itemdesc');

                        $despachodet['itemdesc']=$itemdesc;
                        $this->db->insert('despacho_det', $despachodet);
                  $item++;
 }
}
}

if ($error!='' or $this->db->trans_status() === FALSE)
{//hubo un error en la transaccion
  $this->db->trans_rollback();

    $data['msg']=$error;

    return $data;


}else{
  $this->db->trans_commit();
  //actualizar estado_req
$data['msg']='Despacho realizado con exito, dirigirse a Consultas/Despacho por Compra';
if ($this->atencioncompleta($req_cab)==0) {
  $this->db->set('estado_req',1);
  $this->db->where('docentry',$req_cab);
  $this->db->update('reqmat_cab');

  $this->db->set('fecha_atendida',date('Y-m-d H:i:s'));
  $this->db->where('docentry',$req_cab);
  $this->db->update('reqmat_cab');


  $data['msg']='Se atendió completamente el requerimiento';

}
    return $data;
}



}




///////////////////////////////
private function validaratencioncodigo($item,$codigo,$req_cab,$cant_atendida){
$this->db->select('cant_aprob');
$this->db->from('reqmat_det');
$this->db->where('item_num',$item);
$this->db->where('itemcodigo',$codigo);
$this->db->where('req_cab',$req_cab);

$query=$this->db->get();

if($query->num_rows()==1){
  if(($query->row()->cant_aprob - $cant_atendida)>=0)
 {
   return true;
 }
 else{
   return false;
 }
}
else{
  return false;
}

}



private function atencioncompleta($reqcab){
  $this->db->select('sum(cant_aprob)-sum(cant_atendida)');
  $this->db->from('reqmat_det');
  $this->db->where('req_cab',$reqcab);
  $this->db->where('canceled','n');
  $query=$this->db->get();

  return  $query->row('sum(cant_aprob)-sum(cant_atendida)');
}

public function despachos(){
  $this->db->select('t0.*,t3.nom_area,t1.nombre,concat(t2.nombre," ",t2.apepat) "usuario", t4.req_correlativo, t4.centrocosto');
  $this->db->from('despacho_cab t0');
  $this->db->join('contrato t1','t1.contratoid=t0.contratoid');
  $this->db->join('reqmat_cab t4','t4.docentry=t0.req_cab');
  $this->db->join('usuario t2','t0.responsable=t2.usuarioid');
  $this->db->join('area t3','t0.area=t3.idarea');
    return $this->db->get()->result();
}
public function getdespachocab($id)
{
  $this->db->select('t0.*,t3.nom_area,t1.nombre,concat(t2.nombre," ",t2.apepat) "usuario", t4.req_correlativo, t4.centrocosto');
  $this->db->from('despacho_cab t0');
  $this->db->join('contrato t1','t1.contratoid=t0.contratoid');
  $this->db->join('reqmat_cab t4','t4.docentry=t0.req_cab');
  $this->db->join('usuario t2','t0.responsable=t2.usuarioid');
  $this->db->join('area t3','t0.area=t3.idarea');

  $this->db->where('t0.docentry',$id);
  return $this->db->get()->row();
}


public function getdespachodet($id)
{
  $this->db->select('t0.*,t1.descripcion');
  $this->db->from('despacho_det t0');
  $this->db->where('t0.despacho_cab',$id);
  $this->db->where('t0.itemcant>',0);
  $this->db->join('maquinas t1','t0.itemmaquina=t1.idmaquina','left');

  return $this->db->get()->result();
}


public function getfirmas($id){

    $this->db->select('*');
    $this->db->from('reqmat_firmas');
    $this->db->where('req_cab',$id);
    $query=$this->db->get();
    $firmas=$query->row();

return  $firmas;
}

public function get_aprobaciones($idalmacen){
  $this->db->select('t0.*,t1.req_correlativo,t1.fecha_atendida');
  $this->db->from('reqmat_firmas t0');
  $this->db->join('reqmat_cab t1','t1.docentry=t0.req_cab');
  $this->db->where('t1.contratoid',$idalmacen);
  $query=$this->db->get();
  $firmas=$query->result();
  return $firmas;
}

public function stock_diamantados($reqcab)
{
  $this->db->select('t0.itemcodigo,t1.descripcion,t1.seriearticulo,t3.seriedocid,t3.correlativo,t3.fecha_creacion,t0.observaciones');
  $this->db->from('reqmat_det t0');
  $this->db->join('reqmat_cab t2','t0.req_cab=t2.docentry');
  $this->db->join('stkart t1','t0.itemcodigo=t1.articuloid and t0.idcontrato=t2.contratoid');
  $this->db->join('movalmdet t3','t0.itemcodigo=t3.codigo and t1.seriearticulo=t3.serie and t2.contratoid=t3.contratoid and t3.tipo="NI"');
  $this->db->where('t0.req_cab',$reqcab);
  $this->db->where('t1.familia','pdd');
  $this->db->where('t1.stock>',0);
  $this->db->group_by('t0.itemcodigo,t1.descripcion,t1.seriearticulo,t3.seriedocid,t3.correlativo,t3.fecha_creacion,t0.observaciones');
  $articulo=$this->db->get();
  $diamantados=$articulo->result();

  return $diamantados;

}

public function gets_sol_cod($idalmacen){
  $this->db->select('c.*,s.fullname,a.descripcion');
  $this->db->from('solcod_cab c');
  $this->db->join('solicitantes s','c.solicitante=s.codigo and s.contratoid=c.contratoid');
  $this->db->join('centrocostointerno a','c.area=a.idcentrocosto and a.contratoid=c.contratoid ');
  $this->db->where('c.contratoid', $idalmacen);

  $query=$this->db->get();
  return $query->result();

}

} ?>
