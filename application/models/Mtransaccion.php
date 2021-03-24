<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransaccion extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }
  private function dia_entrega($fechaInicial,$MaxDias){
    $Segundos=0;
    if ($MaxDias==0) {
      $fechafinal=date("Y-m-d",strtotime($fechaInicial));
    }else {
      for ($i=0; $i<$MaxDias; $i++)
 {
     $Segundos = $Segundos + 86400;
     $caduca = date("D",strtotime($fechaInicial)+$Segundos);
         $diames = date('d-m',strtotime($fechaInicial)+$Segundos);
         if ($caduca == "Sat")
         {
             $i--;
         }
         else if ($caduca == "Sun")
         {
             $i--;
         }
         else if ($diames == "01-01")
         {
             $i--;
         }
         else if ($diames == "01-05")
         {
             $i--;
         }
         else if ($diames == "29-06")
         {
             $i--;
         }
         else if ($diames == "28-07")
         {
             $i--;
         }
         else if ($diames == "29-07")
         {
             $i--;
         }
         else if ($diames == "30-08")
         {
             $i--;
         }
         else if ($diames == "08-10")
         {
             $i--;
         }
         else if ($diames == "01-11")
         {
             $i--;
         }
         else if ($diames == "08-12")
         {
             $i--;
         }
         else if ($diames == "25-12")
         {
             $i--;
         }
         else
         {
             $FechaFinal = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
         }
     }
    }
        return $FechaFinal;
  }
public function centrocosto($articulo){
  $this->db->select('centrocosto');
  $this->db->from('centrodecosto');
  $this->db->where('articuloid',$articulo);
  return $this->db->get()->row('centrocosto');
}
public function detalle($detalle,$cabecera,$igvpor,$subtotal,$fechadoc,$tipocambio){
    $FechaFinal=$this->dia_entrega($fechadoc,30);
    $cabecera['CCFECVEN']=date('Y-m-d H:i:s',strtotime($FechaFinal));

    $starsoft=$this->load->database('starsoft',TRUE);
    $CCVENDE=$starsoft->query("select CVENDE from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
    $cabecera['CCVENDE']=$CCVENDE->row('CVENDE');
    $CDIRFISC=$starsoft->query("select cdircli from maecli where CCODCLI like '%".$cabecera['CCCODCLI']."'");
    $cabecera['CDIRFISC']=$CDIRFISC->row('cdircli');
    $CCRUC=$starsoft->query("select CNUMRUC from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
    $cabecera['CCRUC']=$CCRUC->row('CNUMRUC');
    $CCNOMBRE=$starsoft->query("select cnomcli from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
    $cabecera['CCNOMBRE']=$CCNOMBRE->row('cnomcli');

  $error='';
  $this->db->trans_begin();
  $this->db->insert('COTCAB', $cabecera);
  $lastid=$this->db->insert_id();

  $info=array();
  $item=1;
  foreach ($detalle as $key) {
  if ($key->PLAZO=="0") {
    $entrega=date('Y-m-d H:i:s',strtotime($fechadoc));
  }
  else {
    $fechaentrega=$this->dia_entrega($fechadoc,$key->PLAZO*$key->CCTIPTIME);
    $entrega=date('Y-m-d H:i:s',strtotime($fechaentrega));
  }
  $familia=$starsoft->query("SELECT AFAMILIA FROM MAEART WHERE ACODIGO='".$key->CDCODIGO."' ");
  $centrocosto=$this->centrocosto($key->CDCODIGO);
  $rowdetalle=array('CDNUMDOC'=>$lastid,
                    'CDSECUEN'=>$item,
                    'CDCODIGO'=>$key->CDCODIGO,
                    'CDDESCRI'=>str_replace("  ", " ", $key->CDDESCRI),
                    'CDCANTID'=>$key->CDCANTID,
                    'CDCANTPEN'=>$key->CDCANTID,
                    'CDPREC_ORI'=>$key->CDPREC_ORI,
                    'CDFECDOC'=>date('Y-m-d H:i:s',strtotime($fechadoc)),
                    'CDFECENT'=>$entrega,
                    'CDPORDES'=>($key->CDPORDES)*100,
                    'CDFAMILIA'=>$familia->row('AFAMILIA'),
                    'CDDESCLI'=>0,
                    'CDDESESP'=>0,
                    'CDIGVPOR'=>$igvpor*100,
                    'CDIMPUS'=>($key->subtotal)*(1+($igvpor)),
                    'CDIMPMN'=>($key->subtotal)*(1+($igvpor))*($tipocambio),
                    'CDALMA'=>01,
                    'CDESTADO'=>0,
                    'PLAZO'=>$key->PLAZO,
                    'CCTIPTIME'=>$key->CCTIPTIME,
                    'CDUNIDAD'=>$key->CDUNIDAD,
                    'DFCENCOS'=>$centrocosto,
                    //'CDTEXTO'=>$key->CDTEXTO
                  );
  $precio1=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','1') 'COST_ULT'");
  if ($precio1->row('COST_ULT')==NULL or $precio1->row('COST_ULT')=='') {
    $costo1=0;
  }else {
    $costo1=$precio1->row('COST_ULT');
  }
  $precio2=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','2') 'COST_ULT'");
  if ($precio2->row('COST_ULT')==NULL or $precio2->row('COST_ULT')=='') {
    $costo2=0;
  }else {
    $costo2=$precio2->row('COST_ULT');
  }
  $precio3=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','3') 'COST_ULT'");
  if ($precio3->row('COST_ULT')==NULL or $precio3->row('COST_ULT')=='') {
    $costo3=0;
  }else {
    $costo3=$precio3->row('COST_ULT');
  }
  $costo=$this->db->query("select costo from costo_articulo where articuloid='".$key->CDCODIGO."'");
  if ($costo->num_rows()>0) {
    $COSTO_REF=$costo->row('costo');
  }else {
    $COSTO_REF=0;
  }

  $fecha1=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','1') 'FEC_ULT'")->row('FEC_ULT');
  $fecha2=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','2') 'FEC_ULT'")->row('FEC_ULT');
  $fecha3=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','3') 'FEC_ULT'")->row('FEC_ULT');

  $analisis=array('cotizacion'=>$lastid,
                  'codigo'=>$key->CDCODIGO,
                  'descripcion'=>$key->CDDESCRI,
                  'costo1'=>$costo1,
                  'costo2'=>$costo2,
                  'costo3'=>$costo3,
                  'fecha_costo1'=>$fecha1,
                  'fecha_costo2'=>$fecha2,
                  'fecha_costo3'=>$fecha3,
                  'costo_ref'=>$COSTO_REF,
                  'precio_lista'=>$key->CDPREC_ORI,
                  'descuento'=>($key->CDPORDES)*100,
                  'precio_neto'=>$key->CDPREC_ORI*(1-$key->CDPORDES)
                );
                  $this->db->insert('COTDET', $rowdetalle);
                  $this->db->insert('analisis_precio', $analisis);
                  $item++;
}
if ($error!='' or $this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          $info['estado']=0;
          $info['msg']=$error;
          $info['query']=$this->db->last_query();
          return $info;
      }
      else{

          $this->db->set('correlativo','correlativo+1',FALSE);
          $this->db->where('contratoid',1);
          $this->db->where('serie_docid','cot');
          $this->db->update('correlativo');
         $this->db->trans_commit();
         $usuario=$this->session->userdata('user_id');

         $auditoria['documento']=$lastid;
         $auditoria['tipo_doc']='CT';
         $auditoria['accion']='Creación de Cotización';
         $auditoria['usuario']=$usuario;
         $auditoria['fecha_hora']=date('Y-m-d H:i:s');
         $this->db->insert('auditoria_documento', $auditoria);
         	$this->db->query('DELETE FROM carga_excel WHERE usuario='.$usuario.'');
          return $lastid;
      }
}

public function actualizar_cot($detalle,$cabecera,$igvpor,$subtotal,$fechadoc,$tipocambio){
    //$FechaFinal=$this->dia_entrega($fechadoc,30);
  //  $cabecera['CCFECVEN']=date('Y-m-d H:i:s',strtotime($FechaFinal));

    $starsoft=$this->load->database('starsoft',TRUE);
    $CDIRFISC=$starsoft->query("select cdircli from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
    $cabecera['CDIRFISC']=$CDIRFISC->row('cdircli');

    $cnomcli=$starsoft->query("select cnomcli from MAECLI where ccodcli='".$cabecera['CCCODCLI']."'");
    $cabecera['CCNOMBRE']=$cnomcli->row('cnomcli');

    $CCRUC=$starsoft->query("select cnumruc from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
    $cabecera['CCRUC']=$CCRUC->row('cnumruc');
  $error='';
  $this->db->trans_begin();

  $this->db->where('CCNUMDOC',$cabecera['CCNUMDOC']);
  $this->db->update('COTCAB', $cabecera);


  $lastid=$cabecera['CCNUMDOC'];
/*
  $this->db->set('correlativo','correlativo+1',FALSE);
  $this->db->where('contratoid',1);
  $this->db->where('serie_docid','cot');
  $this->db->update('correlativo');*/

  $info=array();
  $item=1;
  $estado_cab=$this->db->query('SELECT CCESTADO FROM COTCAB WHERE CCNUMDOC="'.$cabecera['CCNUMDOC'].'"')->row('CCESTADO');

  if ($estado_cab==1) {
    $this->db->where('CDNUMDOC',$lastid);
    $this->db->delete('COTDET');

      $this->db->where('cotizacion',$lastid);
      $this->db->delete('analisis_precio');
    foreach ($detalle as $key) {
    if ($key->PLAZO=="0") {
      $entrega=date('Y-m-d H:i:s',strtotime($fechadoc));
    }
    else {
      $fechaentrega=$this->dia_entrega($fechadoc,$key->PLAZO*$key->CCTIPTIME);
      $entrega=date('Y-m-d H:i:s',strtotime($fechaentrega));
    }
    $familia=$starsoft->query("SELECT AFAMILIA FROM MAEART WHERE ACODIGO='".$key->CDCODIGO."' ");
    $centrocosto=$this->centrocosto($key->CDCODIGO);
    $rowdetalle=array('CDNUMDOC'=>$lastid,
                      'CDSECUEN'=>$item,
                      'CDCODIGO'=>$key->CDCODIGO,
                      'CDDESCRI'=>str_replace("  ", " ", $key->CDDESCRI),
                      'CDCANTID'=>$key->CDCANTID,
                      'CDCANTPEN'=>$key->CDCANTID,
                      'CDFAMILIA'=>$familia->row('AFAMILIA'),
                      'CDPREC_ORI'=>$key->CDPREC_ORI,
                      'CDFECDOC'=>date('Y-m-d H:i:s',strtotime($fechadoc)),
                      'CDFECENT'=>$entrega,
                      'CDPORDES'=>($key->CDPORDES)*100,
                      'CDDESCLI'=>0,
                      'CDDESESP'=>0,
                      'CDIGVPOR'=>$igvpor*100,
                      'CDIMPUS'=>($key->subtotal)*(1+($igvpor)),
                      'CDIMPMN'=>($key->subtotal)*(1+($igvpor))*($tipocambio),
                      'CDALMA'=>01,
                      'CDESTADO'=>0,
                      'PLAZO'=>$key->PLAZO,
                      'CCTIPTIME'=>$key->CCTIPTIME,
                      'CDUNIDAD'=>$key->CDUNIDAD,
                      'DFCENCOS'=>$centrocosto,
                      //'CDTEXTO'=>$key->CDTEXTO
                    );
                    $precio1=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','1') 'COST_ULT'");
                    if ($precio1->row('COST_ULT')==NULL or $precio1->row('COST_ULT')=='') {
                      $costo1=0;
                    }else {
                      $costo1=$precio1->row('COST_ULT');
                    }
                    $precio2=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','2') 'COST_ULT'");
                    if ($precio2->row('COST_ULT')==NULL or $precio2->row('COST_ULT')=='') {
                      $costo2=0;
                    }else {
                      $costo2=$precio2->row('COST_ULT');
                    }
                    $precio3=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','3') 'COST_ULT'");
                    if ($precio3->row('COST_ULT')==NULL or $precio3->row('COST_ULT')=='') {
                      $costo3=0;
                    }else {
                      $costo3=$precio3->row('COST_ULT');
                    }
                    $costo=$this->db->query("select costo from costo_articulo where articuloid='".$key->CDCODIGO."'");
                    if ($costo->num_rows()>0) {
                      $COSTO_REF=$costo->row('costo');
                    }else {
                      $COSTO_REF=0;
                    }
                    $fecha1=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','1') 'FEC_ULT'")->row('FEC_ULT');
                    $fecha2=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','2') 'FEC_ULT'")->row('FEC_ULT');
                    $fecha3=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','3') 'FEC_ULT'")->row('FEC_ULT');
                    $analisis=array('cotizacion'=>$lastid,
                                    'codigo'=>$key->CDCODIGO,
                                    'descripcion'=>$key->CDDESCRI,
                                    'costo1'=>$costo1,
                                    'costo2'=>$costo2,
                                    'costo3'=>$costo3,
                                    'fecha_costo1'=>$fecha1,
                                    'fecha_costo2'=>$fecha2,
                                    'fecha_costo3'=>$fecha3,
                                    'costo_ref'=>$COSTO_REF,
                                    'precio_lista'=>$key->CDPREC_ORI,
                                    'descuento'=>($key->CDPORDES)*100,
                                    'precio_neto'=>$key->CDPREC_ORI*(1-$key->CDPORDES)
                                  );
                    $this->db->insert('COTDET', $rowdetalle);
                    $this->db->insert('analisis_precio', $analisis);
                    $item++;
  }
  }
         $usuario=$this->session->userdata('user_id');
if ($error!='' or $this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          $info['estado']=0;
          $info['msg']=$error;
          $info['query']=$this->db->last_query();
          return $info;
      }
      else{
        $auditoria['documento']=$lastid;
        $auditoria['tipo_doc']='CT';
        $auditoria['accion']='Actualización de Cotización';
        $auditoria['usuario']=$usuario;
        $auditoria['fecha_hora']=date('Y-m-d H:i:s');
        $this->db->insert('auditoria_documento', $auditoria);
         $this->db->trans_commit();
         $usuario=$this->session->userdata('user_id');
         						$this->db->query('DELETE FROM carga_excel WHERE usuario='.$usuario.'');
          return $lastid;
      }
}
///////////
public function get_cabecera($documento){
  $this->db->select('*');
  $this->db->from('COTCAB');
  $this->db->where('CCNUMDOC',$documento);
  return  $this->db->get()->row();
}
public function get_cabecera_pdf($documento){
  $this->db->select('*');
  $this->db->from('COTCAB');
  $this->db->where('CCNUMDOC',$documento);
  $data=$this->db->get()->row();
$starsoft=$this->load->database('starsoft',TRUE);
  $cabecera['CCNUMDOC']=$data->CCNUMDOC;
  $cabecera['CCFECDOC']=$data->CCFECDOC;
  $cabecera['CCFECSYS']=$data->CCFECSYS;
  $vendedor=$starsoft->query("selecT Des_Ven from VENDEDOR where COD_VEN like '".$data->CCVENDE."'");
  $cabecera['CCVENDE']=$vendedor->row('Des_Ven');
  $PAGO=$starsoft->query("selecT DES_FP from FORMA_PAGO where COD_FP like '".$data->CCFORPAG."'");
  $cabecera['CCFORPAG']=$PAGO->row('DES_FP');
  $cabecera['CCPUNVEN']=$data->CCPUNVEN;
  $cabecera['CCCODCLI']=$data->CCCODCLI;
  $cabecera['CCDIRECC']=$data->CCDIRECC;
  $cabecera['CCPORDESCL']=$data->CCPORDESCL;
  $cabecera['CCPORDESES']=$data->CCPORDESES;
  $cabecera['CCIMPORTE']=$data->CCIMPORTE;
  $cabecera['CCTIPCAM']=$data->CCTIPCAM;
  $cabecera['CCCODMON']=$data->CCCODMON;
  $user=$this->db->query('SELECT concat(nombre," ",apepat) as "CCUSER" from usuario where usuarioid="'.$data->CCUSER.'"');
  $cabecera['CCUSER']=$user->row("CCUSER");
  $cabecera['CCREF']=$data->CCREF;
  $cabecera['CCDESVAL']=$data->CCDESVAL;
  $cabecera['CCIGV']=$data->CCIGV;
  $cabecera['CCTIPCOTIZA']=$data->CCTIPCOTIZA;
  $cabecera['CCLUGENT']=$data->CCLUGENT;
  $contacto=$starsoft->query("select CONTACTO from CONTACTO_VENTA where cod_cliente like '".$data->CCCODCLI."' and COD_CONTACTO like '".$data->COD_CONTACTO."'");
  $cabecera['COD_CONTACTO']=$contacto->row('CONTACTO');
  $email=$starsoft->query("select CORREO from CONTACTO_VENTA where cod_cliente like '".$data->CCCODCLI."' and COD_CONTACTO like '".$data->COD_CONTACTO."'");
  $cabecera['EMAIL']=$email->row('CORREO');
  $cabecera['CCESTADO']=$data->CCESTADO;
  $cabecera['CLOSED']=$data->CLOSED;
  $cabecera['CCFECVEN']=$data->CCFECVEN;
  $cabecera['CDIRFISC']=$data->CDIRFISC;
  $cabecera['CCNOMBRE']=$data->CCNOMBRE;
  $cabecera['CCRUC']=$data->CCRUC;
  $telefono=$starsoft->query("selecT ctelefo from MAECLI where ccodcli like '".$data->CCCODCLI."'");
  $cabecera['TELEFONO']=$telefono->row('ctelefo');
  $filtro=$this->db->query('select CDCODIGO from COTDET where CDNUMDOC="'.$documento.'"');
  $room_id= 0;
      $num=0;
   foreach($filtro->result() as $row){
     $peso=$starsoft->query("SELECT APESO 'peso' FROM maeart m where m.aestado='V' and ACODIGO LIKE '".$row->CDCODIGO."'");
     $room_id=$room_id+$peso->row('peso');
         $num++;
  	}
    $cabecera['PESO']=$room_id;
    $cabecera['num']=$num;


  return $cabecera;
}
public function get_clientecot($documento){
  $this->db->select('CCCODCLI');
  $this->db->from('COTCAB');
  $this->db->where('CCNUMDOC',$documento);
  return  $this->db->get()->row('CCCODCLI');
}
public function get_detalle($documento){
  $this->db->select('*,RTRIM(CDDESCRI) AS "descripcion_corregida"');
  $this->db->from('COTDET');
  $this->db->where('CDNUMDOC',$documento);
  $this->db->order_by('CDSECUEN','ASC');
  return  $this->db->get()->result();
}
public function get_detalle_stock($documento){
  $this->db->select('CDSECUEN,CDCODIGO,RTRIM(CDDESCRI) AS "CDDESCRI"');
  $this->db->from('COTDET');
  $this->db->where('CDNUMDOC',$documento);
  $this->db->where('CDCANTPEN>',0);
  $this->db->order_by('CDSECUEN','ASC');

  $starsoft = $this->load->database('starsoft',TRUE);
  $info=array();
  foreach ($this->db->get()->result() as $key) {
    $stock=$starsoft->query("SELECT STSKDIS FROM STKART WHERE STCODIGO='".$key->CDCODIGO."' and STALMA='01'")->row('STSKDIS');
    $data['stock']=$stock;
    $data['CDSECUEN']=$key->CDSECUEN;
    $data['codigo']=$key->CDCODIGO;
    $data['descripcion']=$key->CDDESCRI;

    $info[]=$data;
  }

  return $info;
}
public function get_detalle_dup($documento){
  $this->db->select('*');
  $this->db->from('COTDET');
  $this->db->where('CDNUMDOC',$documento);
  $query=$this->db->get();
  $temporal=$query->result();
  $item=1;
  foreach ($temporal as $key) {
                    $data['item']=$key->CDSECUEN;
                    $data['codigo']=$key->CDCODIGO;
                    $data['unidad']=$key->CDUNIDAD;
                    $data['cantidad']=$key->CDCANTID;
                    $data['precio']=$key->CDPREC_ORI;
                    $data['descripcion']=$key->CDDESCRI;
                    $data['usuario']=$this->session->userdata('user_id');
                    $data['descuento']=($key->CDPORDES)/100;
                    $data['tiempo']=$key->CCTIPTIME;
                    $data['dias']=$key->PLAZO;
                    $data['stock']=0;

    $this->db->insert('carga_excel', $data);
    $item++;
  }
  return  $temporal;
}
public function get_cotizaciones(){
  $temporal=$this->db->query('SELECT * FROM COTCAB WHERE (YEAR(CCFECDOC)>2020 OR (CCESTADO IN (1,2) and CLOSED="F") )')->result();
  /*$this->db->select('*');
  $this->db->from('COTCAB');
  /*if ($this->session->userdata('rol_id')!=1) {
      $this->db->where('CCUSER',$this->session->userdata('user_id'));
  }*/
  /*$temporal=$this->db->get()->result();*/
$utf8carga=array();
$starsoft=$this->load->database('starsoft',TRUE);
  foreach ($temporal as $key) {
    $data['correlativo']=$key->CCNUMDOC;
    $data['fechadoc']=date('d-m-Y',strtotime($key->CCFECDOC));
    $data['fechaven']=date('d-m-Y',strtotime($key->CCFECVEN));

  /*  $ruc=$starsoft->query("select cnumruc from MAECLI where ccodcli='".$key->CCCODCLI."'");
    $data['ruc']=$ruc->row('cnumruc');*/

    $data['cliente']=$key->CCNOMBRE;

    $data['importe']=number_format($key->CCIMPORTE,2);

    $pago=$this->db->query("SELECT DES_FP from FORMA_PAGO WHERE COD_FP='".$key->CCFORPAG."'");
    $data['pago']=$pago->row('DES_FP');
    $data['tipo']=$key->CCTIPCOTIZA;
    $data['CCREF']=$key->CCREF;
    $data['estado']=$key->CCESTADO;
    $usuario=$this->db->query("select concat(nombre,', ',apepat,' ',apemat) as 'usuario' from usuario where usuarioid='".$key->CCUSER."'");
    $data['usuario']=$usuario->row('usuario');
    $data['idusuario']=$key->CCUSER;
    $data['CLOSED']=$key->CLOSED;
          $utf8carga[]=$data;
  }
    return $utf8carga;
}

public function detalle_excel($detalle){
  $utf8carga=array();
  foreach ($detalle as $key) {

$data['codigo']=$key->codigo;
$data['unidad']=$key->unidad;
$data['cantidad']=$key->cantidad;
$data['precio']=$key->precio;
$data['descripcion']=$key->descripcion;
$data['descuento']=$key->descuento;
$data['tiempo']=$key->tiempo;
    $utf8carga[]=$data;
  }
      return $utf8carga;
}

public function analisis_precios($detalle){
$starsoft=$this->load->database('starsoft',TRUE);
$item=1;
  foreach ($detalle as $key) {
$data['CDSECUEN']=$item;
$data['CDCODIGO']=$key->CDCODIGO;
$descripcion=$starsoft->query("select adescri from maeart where acodigo='".$key->CDCODIGO."'");
$data['descripcion']=$descripcion->row('adescri');

$precio1=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','1') 'COST_ULT'");
$data['precio1']=$precio1->row('COST_ULT');
$fecha1=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','1') 'FEC_ULT'");
$data['fecha1']=$fecha1->row('FEC_ULT');

$precio2=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','2') 'COST_ULT'");
$data['precio2']=$precio2->row('COST_ULT');
$fecha2=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','2') 'FEC_ULT'");
$data['fecha2']=$fecha2->row('FEC_ULT');

$precio3=$starsoft->query("select dbo.fn_NI_pre2('".$key->CDCODIGO."','3') 'COST_ULT'");
$data['precio3']=$precio3->row('COST_ULT');
$fecha3=$starsoft->query("select dbo.fn_NI_fec2('".$key->CDCODIGO."','3') 'FEC_ULT'");
$data['fecha3']=$fecha3->row('FEC_ULT');

$costo=$this->db->query("select costo from costo_articulo where articuloid='".$key->CDCODIGO."'");
if ($costo->num_rows()>0) {
  $data['COSTO_REF']=$costo->row('costo');
}else {
  $data['COSTO_REF']=0;
}

$data['CDPREC_ORI']=str_replace(',','',$key->CDPREC_ORI);
$data['CDPORDES']=$key->CDPORDES;
$data['CCFECDOC']=date('Y-m-d');
$condicion=$starsoft->query("select case when acodigo like '%1-%' or acodigo like '%2-%' or acodigo like '%5-%' then 1 when acodigo like '%3-%' or acodigo like '%4-%' then 2 end 'condicion' from maeart where acodigo='".$key->CDCODIGO."'");
$data['condicion']=$condicion->row('condicion');
$desc_max=$this->db->query("select desc_maximo from precio_articulo where articuloid='".$key->CDCODIGO."'");
if ($desc_max->num_rows()>0) {
  $data['desc_max']=$desc_max->row('desc_maximo');
}else {
  $data['desc_max']=0;
}

    $utf8carga[]=$data;
    $item++;
  }

        return $utf8carga;
}
public function consultar_analisis_precios($cotizacion){
$query=$this->db->query('SELECT * FROM analisis_precio WHERE cotizacion="'.$cotizacion.'" ');
$detalle=$query->result();
$item=1;
  foreach ($detalle as $key) {
$data['CDSECUEN']=$item;
$data['CDCODIGO']=$key->codigo;
$data['descripcion']=$key->descripcion;
$data['precio1']=$key->costo1;
$data['precio2']=$key->costo2;
$data['precio3']=$key->costo3;
$data['fecha1']=$key->fecha_costo1;
$data['fecha2']=$key->fecha_costo2;
$data['fecha3']=$key->fecha_costo3;
$data['CDPREC_ORI']=$key->precio_lista;
$data['CDPORDES']=$key->descuento/100;
$data['CCFECDOC']=$this->db->query('select CCFECDOC from COTCAB where CCNUMDOC="'.$cotizacion.'"')->row('CCFECDOC');
$costo=$this->db->query("select costo from costo_articulo where articuloid='".$key->codigo."'");
if ($costo->num_rows()>0) {
  $data['COSTO_REF']=$costo->row('costo');
}else {
  $data['COSTO_REF']=0;
}
$condicion=$this->db->query("select case when codigo like '%1-%' or codigo like '%2-%' or codigo like '%5-%' then 1 when codigo like '%3-%' or codigo like '%4-%' then 2 end 'condicion' from analisis_precio where codigo='".$key->codigo."'");
$data['condicion']=$condicion->row('condicion');
$desc_max=$this->db->query("select desc_maximo from precio_articulo where articuloid='".$key->codigo."'");
if ($desc_max->num_rows()>0) {
  $data['desc_max']=$desc_max->row('desc_maximo');
}else {
  $data['desc_max']=0;
}
    $utf8carga[]=$data;
    $item++;
  }
    return $utf8carga;
}
public function consultar_analisis_precios_rango($fechainicio,$fechafin){
  $query=$this->db->query('SELECT *,(select ccfecdoc from COTCAB where ccnumdoc=cotizacion) as "fecha" FROM analisis_precio WHERE cotizacion in (select ccnumdoc from COTCAB where ccfecdoc BETWEEN "'.$fechainicio.'" and "'.$fechafin.'" )');
  $detalle=$query->result();
    foreach ($detalle as $key) {
      $data['cotizacion']=$key->cotizacion;
  $data['CDCODIGO']=$key->codigo;
  $data['descripcion']=$key->descripcion;
  $data['precio1']=$key->costo1;
  $data['precio2']=$key->costo2;
  $data['precio3']=$key->costo3;
  $data['fecha1']=$key->fecha_costo1;
  $data['fecha2']=$key->fecha_costo2;
  $data['fecha3']=$key->fecha_costo3;
  $data['fecha']=$key->fecha;
  $data['CDPREC_ORI']=$key->precio_lista;
  $data['CDPORDES']=$key->descuento/100;
  $costo=$this->db->query("select costo from costo_articulo where articuloid='".$key->codigo."'");
  if ($costo->num_rows()>0) {
    $data['COSTO_REF']=$costo->row('costo');
  }else {
    $data['COSTO_REF']=0;
  }
  $condicion=$this->db->query("select case when codigo like '%1-%' or codigo like '%2-%' or codigo like '%5-%' then 1 when codigo like '%3-%' or codigo like '%4-%' then 2 end 'condicion' from analisis_precio where codigo='".$key->codigo."'");
  $data['condicion']=$condicion->row('condicion');
  $desc_max=$this->db->query("select desc_maximo from precio_articulo where articuloid='".$key->codigo."'");
  if ($desc_max->num_rows()>0) {
    $data['desc_max']=$desc_max->row('desc_maximo');
  }else {
    $data['desc_max']=0;
  }
      $utf8carga[]=$data;
    }
      return $utf8carga;
}
public function generar_orden($detalle,$cabecera,$igvpor,$TPDOLAR,$TPSOL,$cotizacion,$texto_glosa,$punto_venta){

  $starsoft=$this->load->database('starsoft',TRUE);
  //iniciar transaccion
$error='';
$this->db->trans_begin();
//obtener cabecera del despacho
//insertar cabecera
  $ultimo=$this->get_ultimo_ped();
   $lastid=$this->get_correlativo_pedido();
/*
while ($ultimo==str_pad($lastid, 7, "0", STR_PAD_LEFT)){
  $ultimo=$this->get_ultimo_ped();

}*/
   $lastid=$this->get_correlativo_pedido();
   if (date('d-m',strtotime($cabecera['CFFECDOC']))=="31-12" or date('d-m',strtotime($cabecera['CFFECDOC']))=="30-04" or date('d-m',strtotime($cabecera['CFFECDOC']))=="28-06" or date('d-m',strtotime($cabecera['CFFECDOC']))=="27-07" or date('d-m',strtotime($cabecera['CFFECDOC']))=="29-08" or date('d-m',strtotime($cabecera['CFFECDOC']))=="07-10" or date('d-m',strtotime($cabecera['CFFECDOC']))=="31-10" or date('d-m',strtotime($cabecera['CFFECDOC']))=="07-12" or date('d-m',strtotime($cabecera['CFFECDOC']))=="24-12" or date('N',strtotime($cabecera['CFFECDOC']))==5) {
     if (date('H')>=15) {
       $cabecera['CFFECDOC']=date('d-m-Y',strtotime($this->dia_entrega($cabecera['CFFECDOC'],1)));
       $cabecera['CFFECVEN']=date('d-m-Y',strtotime($this->dia_entrega($cabecera['CFFECDOC'],1)));
     }
   }
  $cabecera['CFNUMPED']=str_pad($lastid, 7, "0", STR_PAD_LEFT);
$starsoft->insert('010BDCOMUN..PEDCAB', $cabecera);
$starsoft->query("UPDATE [010BDCOMUN]..NUM_DOCUMENTOS SET ctnnumero = (select ctnnumero+1 from [010BDCOMUN]..NUM_DOCUMENTOS where ctncodigo='pd') WHERE ctncodigo='pd'");

//array a retornar
$data=array();
//item correlativo
$item=1;
//capturar codigo en caso de error
$queryptoventa=$starsoft->query("SELECT pv_alma FROM BDWENCO..PUNTO_VENTA WHERE PV_EMPRESA='010' and pv_cod like '".$punto_venta."'");
$ptoventa=$queryptoventa->row('pv_alma');
$codigoconerror='';
foreach ($detalle as $key) {
  if ($key->estado=='1' or $key->estado=='2') {
    if ($key->PLAZO=="0") {
      $entrega=date('Y-m-d H:i:s',strtotime($cabecera['CFFECDOC']));
    }
    else {
      $fechaentrega=$this->dia_entrega($cabecera['CFFECDOC'],$key->PLAZO*$key->DFTIPTIME);
      $entrega=date('Y-m-d H:i:s',strtotime($fechaentrega));
    }
    //$centrocosto=$this->centrocosto($key->CDCODIGO);
    $stock=$starsoft->query("select stskdis from [010BDCOMUN]..STKART where STALMA='01' and stcodigo='".$key->CDCODIGO."'");
    if ($key->CDCODIGO=='TEXTO') {
      $DFTEXTO=$key->CDDESCRI;
      $DFDESCRI='';
    }else {
      $DFTEXTO='';
      $DFDESCRI=$key->CDDESCRI;
    }
    $DFDESCRI1=str_replace ("''",".pulgada.",$DFDESCRI);
    $DFDESCRI2=str_replace ('.pulgada.','"',$DFDESCRI1);
    $rowdetallesql=array('DFNUMPED'=>str_pad($lastid, 7, "0", STR_PAD_LEFT),
                      'DFSECUEN'=>str_pad($item, 3, "0", STR_PAD_LEFT),
                      'DFCODIGO'=>$key->CDCODIGO,
                      'DFDESCRI'=>$DFDESCRI2,
                      'DFCANTID'=>$key->CDCANTPEN,
                      'DFPREC_VEN'=>$key->precioneto*(1+$igvpor),//$key->precioneto-$key->descuentovalor+$key->igvvalor,
                      'DFPREC_ORI'=>$key->CDPREC_ORI,//*(1-$key->CDPORDES),//$key->precioneto,
                      'DFDESCTO'=>$key->descuentovalor,//$key->CDPORDES*100,
                      'DFIGV'=>$key->precioneto*$igvpor*$key->CDCANTPEN,
                      'DFDESCLI'=>0,
                      'DFDESESP'=>0,
                      'DFIGVPOR'=>$igvpor*100,
                      'DFPORDES'=>($key->CDPORDES)*100,//0,
                      'DFIMPUS'=>$key->precioneto*(1+$igvpor)*$key->CDCANTPEN*$TPDOLAR,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPDOLAR,
                      'DFIMPMN'=>$key->precioneto*(1+$igvpor)*$key->CDCANTPEN*$TPSOL,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPSOL,
                      'DFUNIDAD'=>$key->CDUNIDAD,
                      'DFSERIE'=>'',
                      'DFALMA'=>$ptoventa,
                      'DFTEXTO'=>$DFTEXTO,
                      'DFCANREF'=>0,
                      'DFLOTE'=>'',
                      'DFSALDO'=>$key->CDCANTPEN,
                      'DFARTIGV'=>0,
                      'DFCODLIS'=>'',
                      'DFPRECOM'=>0,
                      'DFCOMPROMETIDO'=>0,
                      'DFCOMPRA'=>0,
                      'DFORIGEN'=>0,
                      'REFERENCIA_GLOSA'=>$entrega,
                      'DFCENCOS'=>$key->centrocosto
                    );
                    $starsoft->insert('010BDCOMUN..PEDDET', $rowdetallesql);

                    $rowdetallemysql=array('DFNUMPED'=>str_pad($cabecera['CFNUMPED'], 7, "0", STR_PAD_LEFT),
                                      'DFSECUEN'=>str_pad($item, 3, "0", STR_PAD_LEFT),
                                      'DFCODIGO'=>$key->CDCODIGO,
                                      'DFDESCRI'=>$DFDESCRI,
                                      'DFCANTID'=>$key->CDCANTPEN,
                                      'DFPREC_VEN'=>$key->precioneto*(1+$igvpor),//$key->precioneto-$key->descuentovalor+$key->igvvalor,
                                      'DFPREC_ORI'=>$key->CDPREC_ORI,//*(1-$key->CDPORDES),//$key->precioneto,
                                      'DFDESCTO'=>$key->descuentovalor,//$key->CDPORDES*100,
                                      'DFIGV'=>$key->precioneto*$igvpor*$key->CDCANTPEN,
                                      'DFDESCLI'=>0,
                                      'DFDESESP'=>0,
                                      'DFIGVPOR'=>$igvpor*100,
                                      'DFPORDES'=>($key->CDPORDES)*100,//0,
                                      'DFIMPUS'=>$key->precioneto*(1+$igvpor)*$key->CDCANTPEN*$TPDOLAR,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPDOLAR,
                                      'DFIMPMN'=>$key->precioneto*(1+$igvpor)*$key->CDCANTPEN*$TPSOL,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPSOL,
                                      'DFUNIDAD'=>$key->CDUNIDAD,
                                      'DFSERIE'=>'',
                                      'DFALMA'=>'01',
                                      'DFTEXTO'=>$DFTEXTO,
                                      'DFCANREF'=>0,
                                      'DFLOTE'=>'',
                                      'DFSALDO'=>$key->CDCANTPEN,
                                      'DFARTIGV'=>0,
                                      'DFCODLIS'=>'',
                                      'DFPRECOM'=>0,
                                      'DFCOMPROMETIDO'=>0,
                                      'DFCOMPRA'=>0,
                                      'DFORIGEN'=>0,
                                      'REFERENCIA_GLOSA'=>$entrega,
                                      'DFCENCOS'=>$key->centrocosto,
                                      'DFPLAZO'=>$key->PLAZO,
                                      'DFTIPTIME'=>$key->DFTIPTIME,
                                      'DFFECENT'=>$entrega,
                                      'DFITEMCOT'=>$key->CDSECUEN,
                                      'DFCANTIDDIS'=>$stock->row('stskdis')
                                    );
                                    $this->db->insert('PEDDET', $rowdetallemysql);
                    $item++;

     if ($key->CDCANTPEN!=0) {
       $this->db->set('CDCANTPEN','CDCANTPEN-'.$key->CDCANTPEN.'',false);
       $this->db->where('CDSECUEN',$key->CDSECUEN);
       $this->db->where('CDNUMDOC',$cotizacion);
       $this->db->update('COTDET');
     }


     $pendiente=$this->db->query('SELECT CDCANTPEN from COTDET WHERE CDSECUEN="'.$key->CDSECUEN.'" AND CDNUMDOC="'.$cotizacion.'"');
     if ($pendiente->row('CDCANTPEN')==0) {
       $this->db->set('	CDESTADO',1);
       $this->db->where('CDSECUEN',$key->CDSECUEN);
       $this->db->where('CDNUMDOC',$cotizacion);
       $this->db->update('COTDET');
     }
  }
}

if (trim($texto_glosa)!='') {
  $rowdetallesql=array('DFNUMPED'=>str_pad($lastid, 7, "0", STR_PAD_LEFT),
                    'DFSECUEN'=>str_pad($item, 3, "0", STR_PAD_LEFT),
                    'DFCODIGO'=>'TEXTO',
                    'DFDESCRI'=>'',
                    'DFCANTID'=>1,
                    'DFPREC_VEN'=>0,//$key->precioneto-$key->descuentovalor+$key->igvvalor,
                    'DFPREC_ORI'=>0,//$key->precioneto,
                    'DFDESCTO'=>0,//$key->descuentovalor,
                    'DFIGV'=>0,
                    'DFDESCLI'=>0,
                    'DFDESESP'=>0,
                    'DFIGVPOR'=>$igvpor*100,
                    'DFPORDES'=>0,//($key->CDPORDES)*100,
                    'DFIMPUS'=>0,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPDOLAR,
                    'DFIMPMN'=>0,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPSOL,
                    'DFUNIDAD'=>'UND',
                    'DFSERIE'=>'',
                    'DFALMA'=>'01',
                    'DFTEXTO'=>$texto_glosa,
                    'DFCANREF'=>0,
                    'DFLOTE'=>'',
                    'DFSALDO'=>1,
                    'DFARTIGV'=>0,
                    'DFCODLIS'=>'',
                    'DFPRECOM'=>0,
                    'DFCOMPROMETIDO'=>0,
                    'DFCOMPRA'=>0,
                    'DFORIGEN'=>0,
                    'REFERENCIA_GLOSA'=>'',
                    'DFCENCOS'=>'020103'
                  );
                  $starsoft->insert('010bdcomun..PEDDET', $rowdetallesql);

                  $rowdetallemysql=array('DFNUMPED'=>str_pad($cabecera['CFNUMPED'], 7, "0", STR_PAD_LEFT),
                                    'DFSECUEN'=>str_pad($item, 3, "0", STR_PAD_LEFT),
                                    'DFCODIGO'=>'TEXTO',
                                    'DFDESCRI'=>'',
                                    'DFCANTID'=>1,
                                    'DFPREC_VEN'=>0,//$key->precioneto-$key->descuentovalor+$key->igvvalor,
                                    'DFPREC_ORI'=>0,//$key->precioneto,
                                    'DFDESCTO'=>0,//$key->descuentovalor,
                                    'DFIGV'=>0,
                                    'DFDESCLI'=>0,
                                    'DFDESESP'=>0,
                                    'DFIGVPOR'=>$igvpor*100,
                                    'DFPORDES'=>0,//($key->CDPORDES)*100,
                                    'DFIMPUS'=>0,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPDOLAR,
                                    'DFIMPMN'=>0,//($key->precioneto-$key->descuentovalor+$key->igvvalor)*$key->CDCANTPEN*$TPSOL,
                                    'DFUNIDAD'=>'UND',
                                    'DFSERIE'=>'',
                                    'DFALMA'=>'01',
                                    'DFTEXTO'=>$texto_glosa,
                                    'DFCANREF'=>0,
                                    'DFLOTE'=>'',
                                    'DFSALDO'=>1,
                                    'DFARTIGV'=>0,
                                    'DFCODLIS'=>'',
                                    'DFPRECOM'=>0,
                                    'DFCOMPROMETIDO'=>0,
                                    'DFCOMPRA'=>0,
                                    'DFORIGEN'=>0,
                                    'REFERENCIA_GLOSA'=>'',
                                    'DFCENCOS'=>'020103',
                                    'DFPLAZO'=>0,
                                    'DFTIPTIME'=>0,
                                    'DFFECENT'=>'',
                                    'DFITEMCOT'=>'',
                                    'DFCANTIDDIS'=>0
                                  );
                                  $this->db->insert('PEDDET', $rowdetallemysql);
}

$this->db->set('CCESTADO',2);
$this->db->where('CCNUMDOC',$cotizacion);
$this->db->update('COTCAB');

if ($error!='' or $this->db->trans_status() === FALSE)
{//hubo un error en la transaccion
  $this->db->trans_rollback();

    $data['msg']=$error;

    return $data;


}else{
  $this->db->insert('PEDCAB', $cabecera);
  $this->db->trans_commit();
         $usuario=$this->session->userdata('user_id');
  $auditoria['documento']=$cotizacion;
  $auditoria['tipo_doc']='CT';
  $auditoria['accion']='Generación de Pedido';
  $auditoria['usuario']=$usuario;
  $auditoria['fecha_hora']=date('Y-m-d H:i:s');
  $this->db->insert('auditoria_documento', $auditoria);
  $pendientes=$this->atencioncompleta($cotizacion);
if ($pendientes==0) {
  $this->db->set('CCESTADO',3);
  $this->db->set('CLOSED','V');
  $this->db->where('CCNUMDOC',$cotizacion);
  $this->db->update('COTCAB');
  $data['msg']='Se atendió completamente la cotizacion';

}else {
  $data['msg']='Se atendió la cotización, quedan saldos pendientes';
}
    return $lastid;
}
}

//////////////////////////////////////////
private function atencioncompleta($cotizacion){
  $this->db->select('sum(CDCANTPEN)');
  $this->db->from('COTDET');
  $this->db->where('CDNUMDOC',$cotizacion);
  $query=$this->db->get();

  return  $query->row('sum(CDCANTPEN)');
}
private function get_correlativo_pedido(){
    $starsoft=$this->load->database('starsoft',TRUE);
	   $query=$starsoft->query("select ctnnumero from [010BDCOMUN]..NUM_DOCUMENTOS where ctncodigo='pd'");
       return  $query->row('ctnnumero')+1;
}
public function get_correlativo_pedido2(){
    $starsoft=$this->load->database('starsoft',TRUE);
	   $query=$starsoft->query("select ctnnumero from [010BDCOMUN]..NUM_DOCUMENTOS where ctncodigo='pd'");
       return  $query->row('ctnnumero')+1;
}
public function cerrar_cot($cotizacion,$detalle){
 foreach ($detalle as $key) {
   $this->db->set('	CDESTADO',$key->ESTADO);
   $this->db->where('CDSECUEN',$key->CDSECUEN);
   $this->db->where('CDCODIGO',$key->CDCODIGO);
   $this->db->where('CDNUMDOC',$cotizacion);
   $this->db->update('COTDET');
 }
 if($this->db->affected_rows()>0){
   $this->db->set('CLOSED','V');
$this->db->where('CCNUMDOC',$cotizacion);
$this->db->update('COTCAB');

ECHO 1;
 }
 else {
   ECHO 2;
 }
}
private function get_ultimo_ped(){
  $starsoft=$this->load->database('starsoft',TRUE);
   $query=$starsoft->query("select top 1 CFNUMPED from [010BDCOMUN]..pedcab");
     return  $query->row('CFNUMPED');
}

public function get_pedido(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("select*from [010BDCOMUN]..pedcab WHERE cfcotiza in ('EMITIDO','PARCIAL')");
  return $query->result();
}
public function get_pedido_total($fechainicio,$fechafinal){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("select*from [010BDCOMUN]..pedcab WHERE CFFECDOC between '".$fechainicio."' and '".$fechafinal."'");
  return $query->result();
}
public function get_pedido_det($pedido){
          $starsoft=$this->load->database('starsoft',TRUE);
    $query=$starsoft->query("SELECT *, (select CFFECDOC from [010BDCOMUN]..PEDCAB where CFNUMPED='".$pedido."') as 'CFFECDOC' FROM  [010BDCOMUN]..PEDDET WHERE DFNUMPED LIKE '".$pedido."' and DFCODIGO not like 'texto'");
    $detalle=$query->result();

    foreach ($detalle as $key) {
      $data['DFSECUEN']=$key->DFSECUEN ;
      $data['DFCODIGO']=$key->DFCODIGO ;
      $data['DFDESCRI']=$key->DFDESCRI ;
      $data['DFCANTID']=$key->DFCANTID ;
      $data['DFUNIDAD']=$key->DFUNIDAD ;

      if ($key->DFSALDO>0) {
        $data['condicion']=1;
      } else {
        $data['condicion']=0;
      }

     $query2=$this->db->query("SELECT * FROM PEDDET WHERE DFSECUEN LIKE '".$key->DFSECUEN."' and DFSALDO>0 AND DFNUMPED LIKE '".$pedido."' ");

        if ($query2->num_rows()>0) {
          $data['DFFECENT']=$query2->row('DFFECENT');
          $data['DFPLAZO']=$query2->row('DFPLAZO');
        $data['DFCANTIDDIS']=$query2->row('DFCANTIDDIS');
        $data['DFTIPTIME']=$query2->row('DFTIPTIME');
        $data['dias_reprogramados1']=$query2->row('dias_reprogramados1');
        $data['fecha_reprogramada1']=$query2->row('fecha_reprogramada1');
        $data['dias_reprogramados2']=$query2->row('dias_reprogramados2');
        $data['fecha_reprogramada2']=$query2->row('fecha_reprogramada2');
        $data['dias_reprogramados3']=$query2->row('dias_reprogramados3');
        $data['fecha_reprogramada3']=$query2->row('fecha_reprogramada3');
        $data['DFREPROGRAM']=$query2->row('DFREPROGRAM') ;
        }else {
                $data['DFFECENT']=$key->CFFECDOC;
          $data['DFPLAZO']=0;
          $data['DFCANTIDDIS']='';
          $data['DFTIPTIME']=1;
          $data['dias_reprogramados1']='';
          $data['fecha_reprogramada1']='';
          $data['dias_reprogramados2']='';
          $data['fecha_reprogramada2']='';
          $data['dias_reprogramados3']='';
          $data['fecha_reprogramada3']='';
          $data['DFREPROGRAM']=0;
        }

      $utf8carga[]=$data;
    }
      return $utf8carga;
}

public function reprogramar($pedido,$detalle){
  $this->db->trans_begin();
  $starsoft=$this->load->database('starsoft',TRUE);

  $CONSULTA=$this->db->query('SELECT * FROM PEDCAB WHERE CFNUMPED="'.$pedido.'"');

  if ($CONSULTA->num_rows()==0) {
    $header=$starsoft->query("SELECT * FROM [010BDCOMUN]..PEDCAB WHERE CFNUMPED='".$pedido."'");
    $detail=$starsoft->query("SELECT * FROM [010BDCOMUN]..PEDDET WHERE DFNUMPED='".$pedido."'");

    $cabecera['CFNUMPED']=$header->row('CFNUMPED');
    $cabecera['CFFECDOC']=$header->row('CFFECDOC');
    $cabecera['CFFECVEN']=$header->row('CFFECVEN');
    $cabecera['CFVENDE']=$header->row('CFVENDE');
    $cabecera['CFPUNVEN']=$header->row('CFPUNVEN');
    $cabecera['CFCODCLI']=$header->row('CFCODCLI');
    $cabecera['CFNOMBRE']=$header->row('CFNOMBRE');
    $cabecera['CFRUC']=$header->row('CFRUC');
  	$cabecera['CFIMPORTE']=$header->row('CFIMPORTE');
  	$cabecera['CFPORDESCL']=$header->row('CFPORDESCL');
  	$cabecera['CFPORDESES']=$header->row('CFPORDESES');
  	$cabecera['CFFORVEN']=$header->row('CFFORVEN');
  	$cabecera['CFTIPCAM']=$header->row('CFTIPCAM');
  	$cabecera['CFCODMON']=$header->row('CFCODMON');
  	$cabecera['CFRFTD']=$header->row('CFRFTD');
  	$cabecera['CFRFNUMSER']=$header->row('CFRFNUMSER');
  	$cabecera['CFRFNUMDOC']=$header->row('CFRFNUMDOC');
  	$cabecera['CFFECCRE']=$header->row('CFFECCRE');
  	$cabecera['CFESTADO']=$header->row('CFESTADO');
  	$cabecera['CFUSER']=$header->row('CFUSER');
  	$cabecera['CFGLOSA']=$header->row('CFGLOSA');
  	$cabecera['CFNUMGUI']=$header->row('CFNUMGUI');
  	$cabecera['CFNUMFAC']=$header->row('CFNUMFAC');
  	$cabecera['CFORDCOM']=$header->row('CFORDCOM');
  	$cabecera['CFGLOSA1']=$header->row('CFGLOSA1');
  	$cabecera['CFIGV']=$header->row('CFIGV');
  	$cabecera['CFDESCTO']=$header->row('CFDESCTO');
  	$cabecera['CFDESIMP']=$header->row('CFDESIMP');
  	$cabecera['CFTIPFAC']=$header->row('CFTIPFAC');
  	$cabecera['CFDESVAL']=$header->row('CFDESVAL');
  	$cabecera['CFCOTIZA']=$header->row('CFCOTIZA');
  	$cabecera['COD_AUDITORIA']=$header->row('COD_AUDITORIA');
  	$cabecera['COD_DIRECCION']=$header->row('COD_DIRECCION');
  	$cabecera['CFLINEA']=$header->row('CFLINEA');
  	$cabecera['CFORDENFAB']=$header->row('CFORDENFAB');
  	$cabecera['CFDIRECCA']=$header->row('CFDIRECCA');
  	$cabecera['CFESTADO_PED']=$header->row('CFESTADO_PED');
  	$cabecera['CFEXISTECOTIZA']=$header->row('CFEXISTECOTIZA');
  	$cabecera['RESPUESTA']=$header->row('RESPUESTA');
  	$cabecera['TIPO']=$header->row('TIPO');

    $this->db->insert('PEDCAB',$cabecera);

    foreach ($detail->result() as $key1) {
        $stock=$starsoft->query("select stskdis from [010BDCOMUN]..STKART where STALMA='01' and stcodigo='".$key1->DFCODIGO."'");
      $rowdetallemysql=array(
                        'DFNUMPED'=>$header->row('CFNUMPED'),
                        'DFSECUEN'=>$key1->DFSECUEN,
                        'DFCODIGO'=>$key1->DFCODIGO,
                        'DFDESCRI'=>$key1->DFDESCRI,
                        'DFCANTID'=>$key1->DFCANTID,
                        'DFPREC_VEN'=>$key1->DFPREC_VEN,
                        'DFPREC_ORI'=>$key1->DFPREC_ORI,
                        'DFDESCTO'=>$key1->DFDESCTO,
                        'DFIGV'=>$key1->DFIGV,
                        'DFDESCLI'=>$key1->DFDESCLI,
                        'DFDESESP'=>$key1->DFDESESP,
                        'DFIGVPOR'=>$key1->DFIGVPOR,
                        'DFPORDES'=>$key1->DFPORDES,
                        'DFIMPUS'=>$key1->DFIMPUS,
                        'DFIMPMN'=>$key1->DFIMPMN,
                        'DFUNIDAD'=>$key1->DFUNIDAD,
                        'DFSERIE'=>$key1->DFSERIE,
                        'DFALMA'=>$key1->DFALMA,
                        'DFTEXTO'=>$key1->DFTEXTO,
                        'DFCANREF'=>$key1->DFCANREF,
                        'DFLOTE'=>$key1->DFLOTE,
                        'DFSALDO'=>$key1->DFSALDO,
                        'DFARTIGV'=>$key1->DFARTIGV,
                        'DFCODLIS'=>$key1->DFCODLIS,
                        'DFPRECOM'=>$key1->DFPRECOM,
                        'DFCOMPROMETIDO'=>$key1->DFCOMPROMETIDO,
                        'DFCOMPRA'=>$key1->DFCOMPRA,
                        'DFORIGEN'=>$key1->DFORIGEN,
                        'REFERENCIA_GLOSA'=>$key1->REFERENCIA_GLOSA,
                        'DFCENCOS'=>$key1->DFCENCOS,


                          /* 'DFTIPTIME'=>$key->CDCANTPEN,
                        'DFFECENT'=>$key->CDCANTPEN,
                        'DFITEMCOT'=>$key->CDCANTPEN,*/
                        'DFCANTIDDIS'=>$stock->row('stskdis')
                      );
                      $this->db->insert('PEDDET', $rowdetallemysql);
    }
    foreach ($detalle as $key){
      $this->db->set('fecha_reprogramada1',date('Y-m-d H:i:s',strtotime($key->DFFECENT)));
      $this->db->set('dias_reprogramados1',$key->DFPLAZO);
      $this->db->set('DFREPROGRAM',1);
      $this->db->set('DFFECENT',date('Y-m-d H:i:s',strtotime($header->row('CFFECDOC'))));
      $this->db->where('DFSECUEN',$key->DFSECUEN);
      $this->db->where('DFCODIGO',$key->DFCODIGO);
      $this->db->where('DFCANTID',$key->DFCANTID);
      $this->db->where('DFNUMPED',$pedido);
      $this->db->update('PEDDET');
    }

  }else {

    foreach ($detalle as $key) {
      if ($key->DFFECENT!=$key->FECHAREF) {
        if ($key->DFREPROGRAM==0) {
          $this->db->set('fecha_reprogramada1',date('Y-m-d H:i:s',strtotime($key->DFFECENT)));
          $this->db->set('dias_reprogramados1',$key->DFPLAZO);
        }elseif ($key->DFREPROGRAM==1) {
          $this->db->set('fecha_reprogramada2',date('Y-m-d H:i:s',strtotime($key->DFFECENT)));
          $this->db->set('dias_reprogramados2',$key->DFPLAZO);
        }elseif ($key->DFREPROGRAM==2) {
          $this->db->set('fecha_reprogramada3',date('Y-m-d H:i:s',strtotime($key->DFFECENT)));
          $this->db->set('dias_reprogramados3',$key->DFPLAZO);
        }
        $this->db->set('DFTIPTIME',$key->DFTIPTIME);
        $this->db->set('DFREPROGRAM','DFREPROGRAM+1',FALSE);
        $this->db->where('DFSECUEN',$key->DFSECUEN);
        $this->db->where('DFCODIGO',$key->DFCODIGO);
        $this->db->where('DFCANTID',$key->DFCANTID);
        $this->db->where('DFNUMPED',$pedido);
        $this->db->update('PEDDET');

/*
        $starsoft->set('REFERENCIA_GLOSA',date('Y-m-d H:i:s',strtotime($key->DFFECENT)));
        $starsoft->where('DFSECUEN',$key->DFSECUEN);
        $starsoft->where('DFCODIGO',$key->DFCODIGO);
        $starsoft->where('DFDESCRI',$key->DFDESCRI);
        $starsoft->where('DFCANTID',$key->DFCANTID);
        $this->db->where('DFCANTID',$key->DFCANTID);
        $this->db->where('DFNUMPED',$pedido);
        $starsoft->update('010BDCOMUN..PEDDET');*/
      }
    }
  }

  if ($this->db->trans_status() === FALSE)
  {
    $this->db->trans_rollback();
    return 0;
  }else {
      $this->db->trans_commit();
      return  1;
  }
}

public function auditoria_documento(){
  return $this->db->query('SELECT concat(t1.nombre," ",t1.apepat," ",t1.apemat) as "cotizador",t0.* FROM auditoria_documento t0 inner join usuario t1 on t1.usuarioid=t0.usuario WHERE tipo_doc!="PL" order by fecha_hora desc')->result();
}
public function auditoria_precio(){
  return $this->db->query('SELECT concat(t1.nombre," ",t1.apepat," ",t1.apemat) as "cotizador",t0.* FROM auditoria_documento t0 inner join usuario t1 on t1.usuarioid=t0.usuario WHERE tipo_doc="PL" order by fecha_hora desc' )->result();
}
public function auditoria_costo(){
  return $this->db->query('SELECT concat(t1.nombre," ",t1.apepat," ",t1.apemat) as "cotizador",t0.* FROM auditoria_documento t0 inner join usuario t1 on t1.usuarioid=t0.usuario WHERE tipo_doc="CA" order by fecha_hora desc' )->result();
}
public function auditoria_descuento(){
  return $this->db->query('SELECT concat(t1.nombre," ",t1.apepat," ",t1.apemat) as "cotizador",t0.* FROM auditoria_documento t0 inner join usuario t1 on t1.usuarioid=t0.usuario WHERE tipo_doc="DP" order by fecha_hora desc' )->result();
}
public function asignarcc(){
  $filtro=$this->articulos_cc();
  $room_id= "'";
   foreach($filtro as $row){
  		$room_id = $room_id.$row->articuloid."','";
  	}

   $item=trim($room_id, ",'");
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT ADESCRI,AFAMILIA,AUNIDAD,ACODIGO FROM maeart m where m.aestado='V' and AFAMILIA in('REE','REP','ACC','SERV','ADP','HEG','PDD','TUB','IN','MP','HSE') and ACODIGO in('".$item."')");

  $temporal=$query->result();

  foreach ($temporal as $key) {
    $data['articuloid']=$key->ACODIGO;
    $data['descripcion']=$key->ADESCRI;
    $data['familia']=$key->AFAMILIA;
    if (substr($key->ACODIGO,0,2)=='00'  or substr($key->ACODIGO,0,2)=='01'  or substr($key->ACODIGO,0,2)=='05' or substr($key->ACODIGO,0,2)=='09' or substr($key->ACODIGO,0,2)=='23') {
      $centrocosto='020101';
    }elseif (substr($key->ACODIGO,0,4)=='1600' or  substr($key->ACODIGO,0,4)=='1400' or substr($key->ACODIGO,0,4)=='1401' or substr($key->ACODIGO,0,4)=='1402' or substr($key->ACODIGO,0,4)=='1403' or substr($key->ACODIGO,0,4)=='1404' or substr($key->ACODIGO,0,4)=='1405' or substr($key->ACODIGO,0,4)=='1406') {
      $centrocosto='020101';
    }
    elseif ($key->AFAMILIA=='SERV') {
      $centrocosto='020103';
    }
    elseif (substr($key->ACODIGO,0,2)=='25') {
      $centrocosto='020201';
    }
    elseif (substr($key->ACODIGO,0,4)=='1407' or  substr($key->ACODIGO,0,4)=='1408' or substr($key->ACODIGO,0,4)=='1409' or substr($key->ACODIGO,0,4)=='1410' or substr($key->ACODIGO,0,4)=='1412' or substr($key->ACODIGO,0,4)=='1414' or substr($key->ACODIGO,0,4)=='1417' or substr($key->ACODIGO,0,4)=='1422' or substr($key->ACODIGO,0,4)=='1419') {
      $centrocosto='020202';
    }
    elseif (substr($key->ACODIGO,0,2)=='20') {
      $centrocosto='090200';
    }
    elseif (substr($key->ACODIGO,0,2)=='24') {
      $centrocosto='090300';
    }else {
      $centrocosto='';
    }
    $data['centrocosto']=$centrocosto;
    $query2=$this->db->query("SELECT * FROM centrodecosto where articuloid='".$key->ACODIGO."'");
    if ($query2->num_rows()>0) {
      $this->db->set('centrocosto',$centrocosto);
      $this->db->where('articuloid',$key->ACODIGO);
      $this->db->update('centrodecosto');
    }else {
          $this->db->insert('centrodecosto',$data);
    }

  }

      return 1;


  }

  private function articulos_cc(){
  	$query=$this->db->query("select articuloid from centrodecosto where centrocosto like '' ");
  	return $query->result();
  }
  public function pedido_pendiente($vendedor){
    $starsoft=$this->load->database('starsoft',TRUE);

      $query=$starsoft->query("select dfnumped,DFSECUEN,CFFECDOC,cfrfnumdoc,CFORDCOM,CFNOMBRE,DFCODIGO,dfdescri,
  dfcantid,DFSALDO,'val_unit'=(dfimpus/DFCANTID)/1.18,'total'=(dfimpus/DFCANTID)*dfsaldo/1.18,CFRFNUMDOC,t1.CFORDCOM from PEDDET t0
  inner join PEDCAB t1 on cfnumped=dfnumped where cfcotiza in ('EMITIDO','PARCIAL') AND DFCODIGO NOT LIKE 'TEXTO'
  and cfcodcli in (select ccodcli from MAECLI where CVENDE like '".$vendedor."') and DFSALDO!=0  order by dfnumped,dfsecuen");

foreach ($query->result() as $key) {
  $tipo=$this->db->query('select CCTIPCOTIZA from COTCAB where CCNUMDOC='.$key->CFRFNUMDOC)->row('CCTIPCOTIZA');
  $data['CFNUMPED']=$key->dfnumped;
  $data['CFNOMBRE']=$key->CFNOMBRE;
  $data['DFCODIGO']=$key->DFCODIGO;
  $data['dfdescri']=$key->dfdescri;
  $data['DFSALDO']=$key->DFSALDO;
  $data['CFORDCOM']=$key->CFORDCOM;
  if ($tipo=='NAC') {
    $data['val_unit']=$key->val_unit;
    $data['total']=$key->total;
  } else {
    $data['val_unit']=$key->val_unit*1.18;
    $data['total']=$key->total*1.18;
  }




  $query2=$this->db->query('SELECT * FROM PEDDET WHERE DFNUMPED LIKE "'.$key->dfnumped.'" AND DFSECUEN="'.$key->DFSECUEN.'"');
  if ($query2->num_rows()<1) {
    $data['DFFECENT']=$key->CFFECDOC;
  }else {
    if ($query2->row('DFREPROGRAM')==0) {
      $data['DFFECENT']=date('Y-m-d',strtotime($query2->row('DFFECENT')));
    }elseif ($query2->row('DFREPROGRAM')==1) {
      $data['DFFECENT']=date('Y-m-d',strtotime($query2->row('fecha_reprogramada1')));
    }elseif ($query2->row('DFREPROGRAM')==2) {
      $data['DFFECENT']=date('Y-m-d',strtotime($query2->row('fecha_reprogramada2')));
    }elseif ($query2->row('DFREPROGRAM')==3) {
      $data['DFFECENT']=date('Y-m-d',strtotime($query2->row('fecha_reprogramada3')));
    }
  }


  $year=date('Y',strtotime($data['DFFECENT']));
  $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];

  if (date('Y-m-d')>($data['DFFECENT'])) {
    $data['indicador']=-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($data['DFFECENT'])),date('Y-m-d'),$diasferiados));
  }else {
    $data['indicador']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($data['DFFECENT'])),$diasferiados));
  }

  $utf8carga[]=$data;
  }
  return $utf8carga;
  }
  public function pedido_emitido(){
        $starsoft=$this->load->database('starsoft',TRUE);

        return $starsoft->query("select*from pedcab where cfcotiza like 'emitido'")->result();
  }
/*
  public function pedido_pendiente(){
    $starsoft=$this->load->database('starsoft',TRUE);
    $query=$starsoft->query("select dfnumped,DFSECUEN,CFFECDOC,cfrfnumdoc,CFORDCOM,CFNOMBRE,DFCODIGO,
(select afamilia from maeart where acodigo=dfcodigo) as 'familia',dfdescri,
dfcantid,'POR_ATENDER'=DFCANTID-DFSALDO,
'stock_ahora'=(select stskdis from stkart where stcodigo=dfcodigo and STALMA='01'),DFSALDO,
'situacion'=(case when dfsaldo=dfcantid then 'Emitido' when dfsaldo<dfcantid and dfsaldo>0 then 'Parcial' when dfsaldo=0  then 'Atendido' end),
'val_unit'=(dfimpus/DFCANTID)/1.18,'total'=(dfimpus/DFCANTID)*dfsaldo/1.18 from PEDDET t0
inner join PEDCAB t1 on cfnumped=dfnumped where cfcotiza in ('EMITIDO','PARCIAL') AND DFCODIGO NOT LIKE 'TEXTO' order by dfnumped,dfsecuen");


foreach ($query->result() as $key) {
    $data['CFNUMPED']=$key->dfnumped;
    //$data['CFFECDOC']=date('d-m-Y',strtotime($key->CFFECDOC));
    //$data['cfrfnumdoc']=$key->cfrfnumdoc;
    //$data['CFORDCOM']=$key->CFORDCOM;
    $data['CFNOMBRE']=$key->CFNOMBRE;
    $data['DFCODIGO']=$key->DFCODIGO;

    $query=$this->db->query('SELECT * FROM PEDDET WHERE DFNUMPED LIKE "'.$key->dfnumped.'" AND DFSECUEN="'.$key->DFSECUEN.'"');
    if ($query->num_rows()>0) {
    $data['DFCANTIDDIS']=$query->row('DFCANTIDDIS');
    $data['DFTIPTIME']=$query->row('DFTIPTIME');
    $data['DFFECENT']=$query->row('DFFECENT');
    $data['dias_reprogramados1']=$query->row('dias_reprogramados1');
    $data['fecha_reprogramada1']=$query->row('fecha_reprogramada1');
    $data['dias_reprogramados2']=$query->row('dias_reprogramados2');
    $data['fecha_reprogramada2']=$query->row('fecha_reprogramada2');
    $data['dias_reprogramados3']=$query->row('dias_reprogramados3');
    $data['fecha_reprogramada3']=$query->row('fecha_reprogramada3');
    }else {
      $data['DFCANTIDDIS']='';
      $data['DFTIPTIME']='';
      $data['DFFECENT']='';
      $data['dias_reprogramados1']='';
      $data['fecha_reprogramada1']='';
      $data['dias_reprogramados2']='';
      $data['fecha_reprogramada2']='';
      $data['dias_reprogramados3']='';
      $data['fecha_reprogramada3']='';
    }

  //  $data['familia']=$key->familia;
    $data['dfdescri']=$key->dfdescri;
    $data['dfcantid']=$key->dfcantid;
    $data['POR_ATENDER']=$key->POR_ATENDER;
    $data['stock_ahora']=$key->stock_ahora;
    $data['DFSALDO']=$key->DFSALDO;
    $data['situacion']=$key->situacion;
    $data['val_unit']=$key->val_unit;
    $data['total']=$key->total;

    $query2=$this->db->query("select*from seguimiento_area where DFNUMPED='".$key->dfnumped."' and DFSECUEN='".$key->DFSECUEN."' and DFCODIGO='".$key->DFCODIGO."'");

    if ($query2->num_rows()>0) {
      if ($query2->row('area1')==1) {
        $data['area1']='INGENIERÍA';
      }elseif ($query2->row('area1')==2) {
        $data['area1']='PRODUCCIÓN';
      }elseif ($query2->row('area1')==3) {
        $data['area1']='COMPRAS';
      }elseif ($query2->row('area1')==4) {
        $data['area1']='ALMACÉN';
      }elseif ($query2->row('area1')=='') {
        $data['area1']='';
      }
      $data['fecha_inicio1']=date('d-m-Y',strtotime($query2->row('fecha_inicio1')));
      $data['fecha_final1']=date('d-m-Y',strtotime($query2->row('fecha_final1')));
      $year=date('Y',strtotime($query2->row('fecha_termino1')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];
      if (date('Y-m-d')>($query2->row('fecha_final1'))) {
        $data['indicador1']=-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final1'))),date('Y-m-d'),$diasferiados));
      }else {
        $data['indicador1']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final1'))),$diasferiados));
      }
      if ($query2->row('fecha_termino1')=='0000-00-00') {
        $data['fecha_termino1']='-';
        $data['tiempo1']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio1'))), date('Y-m-d'),$diasferiados));
      } else {
        $data['fecha_termino1']=date('d-m-Y',strtotime($query2->row('fecha_termino1')));
        $data['tiempo1']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio1'))), date('Y-m-d',strtotime($query2->row('fecha_termino1'))),$diasferiados));
      }

      if ($query2->row('area2')==1) {
        $data['area2']='INGENIERÍA';
      }elseif ($query2->row('area2')==2) {
        $data['area2']='PRODUCCIÓN';
      }elseif ($query2->row('area2')==3) {
        $data['area2']='COMPRAS';
      }elseif ($query2->row('area2')==4) {
        $data['area2']='ALMACÉN';
      }elseif ($query2->row('area2')=='') {
        $data['area2']='';
      }
      $data['fecha_inicio2']=date('d-m-Y',strtotime($query2->row('fecha_inicio2')));
      $data['fecha_final2']=date('d-m-Y',strtotime($query2->row('fecha_final2')));
      $year=date('Y',strtotime($query2->row('fecha_termino2')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];
      if (date('Y-m-d')>$query2->row('fecha_final2')) {
        $data['indicador2']=-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final2'))),date('Y-m-d'),$diasferiados));
      }else {
        $data['indicador2']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final2'))),$diasferiados));
      }
      if ($query2->row('fecha_termino2')=='0000-00-00') {
        $data['fecha_termino2']='-';
        $data['tiempo2']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio2'))), date('Y-m-d'),$diasferiados));
      } else {
        $data['fecha_termino2']=date('d-m-Y',strtotime($query2->row('fecha_termino2')));
        $data['tiempo2']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio2'))), date('Y-m-d',strtotime($query2->row('fecha_termino2'))),$diasferiados));
      }


      if ($query2->row('area3')==1) {
        $data['area3']='INGENIERÍA';
      }elseif ($query2->row('area3')==2) {
        $data['area3']='PRODUCCIÓN';
      }elseif ($query2->row('area3')==3) {
        $data['area3']='COMPRAS';
      }elseif ($query2->row('area3')==4) {
        $data['area3']='ALMACÉN';
      }elseif ($query2->row('area3')=='') {
        $data['area3']='';
      }
      $data['fecha_inicio3']=date('d-m-Y',strtotime($query2->row('fecha_inicio3')));
      $data['fecha_final3']=date('d-m-Y',strtotime($query2->row('fecha_final3')));
      $year=date('Y',strtotime($query2->row('fecha_termino3')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];
      if (date('Y-m-d')>($query2->row('fecha_final3'))) {
        $data['indicador3']=-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final3'))),date('Y-m-d'),$diasferiados));
      }else {
        $data['indicador3']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final3'))),$diasferiados));
      }

      if ($query2->row('fecha_termino3')=='0000-00-00') {
        $data['fecha_termino3']='-';
        $data['tiempo3']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio3'))), date('Y-m-d'),$diasferiados));
      } else {
        $data['fecha_termino3']=date('d-m-Y',strtotime($query2->row('fecha_termino3')));
        $data['tiempo3']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio3'))), date('Y-m-d',strtotime($query2->row('fecha_termino3'))),$diasferiados));

      }


      if ($query2->row('area4')==1) {
        $data['area4']='INGENIERÍA';
      }elseif ($query2->row('area4')==2) {
        $data['area4']='PRODUCCIÓN';
      }elseif ($query2->row('area4')==3) {
        $data['area4']='COMPRAS';
      }elseif ($query2->row('area4')==4) {
        $data['area4']='ALMACÉN';
      }elseif ($query2->row('area4')=='') {
        $data['area4']='';
      }
      $data['fecha_inicio4']=date('d-m-Y',strtotime($query2->row('fecha_inicio4')));
      $data['fecha_final4']=date('d-m-Y',strtotime($query2->row('fecha_final4')));
      $year=date('Y',strtotime($query2->row('fecha_termino4')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];

      if (date('Y-m-d')>($query2->row('fecha_final4'))) {
        $data['indicador4']=-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final4'))),date('Y-m-d'),$diasferiados));
      }else {
        $data['indicador4']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final4'))),$diasferiados));
      }
      if ($query2->row('fecha_termino4')=='0000-00-00' or $query2->row('fecha_termino4')=='') {
        $data['fecha_termino4']='-';
        $data['tiempo4']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio4'))), date('Y-m-d'),$diasferiados));

      } else {
        $data['fecha_termino4']=date('d-m-Y',strtotime($query2->row('fecha_termino4')));
        $data['tiempo4']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio4'))), date('Y-m-d',strtotime($query2->row('fecha_termino4'))),$diasferiados));

      }

    }else {
      $data['area1']='';
      $data['fecha_inicio1']='';
      $data['fecha_final1']='';
      $data['fecha_termino1']='';
      $data['indicador1']='';
      $data['tiempo1']='';
      $data['area2']='';
      $data['fecha_inicio2']='';
      $data['fecha_final2']='';
      $data['fecha_termino2']='';
      $data['indicador2']='';
      $data['tiempo2']='';
      $data['area3']='';
      $data['fecha_inicio3']='';
      $data['fecha_final3']='';
      $data['fecha_termino3']='';
      $data['indicador3']='';
      $data['tiempo3']='';
      $data['area4']='';
      $data['fecha_inicio4']='';
      $data['fecha_final4']='';
      $data['fecha_termino4']='';
      $data['indicador4']='';
      $data['tiempo4']='';

    }


    $utf8carga[]=$data;
  }
    return $utf8carga;
  }*/
  public function pedido_atendido($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);

    $querydata=$starsoft->query("select dfnumped,DFSECUEN,CFFECDOC,DFSALDO,cfrfnumdoc,CFORDCOM,DFCANTID,CFNOMBRE,DFCODIGO,dfdescri,
    'POR_ATENDER'=(dfcantid-DFSALDO),'situacion'= cfcotiza,dfimpus from PEDDET t0 inner join PEDCAB t1 on cfnumped=dfnumped
    where cfcotiza in ('ATENDIDO','LIQUIDADO') AND DFCODIGO NOT LIKE 'TEXTO' and cffecdoc between '".$fechainicio."' and '".$fechafin."'");

foreach ($querydata->result() as $key) {
    $data['CFNUMPED']=$key->dfnumped;
    $data['CFFECDOC']=date('d-m-Y',strtotime($key->CFFECDOC));
    $data['cfrfnumdoc']=$key->cfrfnumdoc;
    $data['CFORDCOM']=$key->CFORDCOM;
    $data['CFNOMBRE']=$key->CFNOMBRE;
    $data['DFCODIGO']=$key->DFCODIGO;
    $fechafacturacion=$starsoft->query("select top 1 cffecdoc from FACDET  inner join faccab  on cftd=dftd and cfnumser=dfnumser and cfnumdoc=dfnumdoc where cfnroped like '".$key->dfnumped."' and dfcodigo like '".$key->DFCODIGO."'");
    $data['FEC_FACT']=$fechafacturacion->row('cffecdoc');

//,'val_unit'=(dfimpus/DFCANTID)/1.18,'total'=(dfimpus)/1.18
$queryfamilia=$starsoft->query("select top 1 afamilia from maeart where acodigo='".$key->DFCODIGO."'");
    $data['familia']=$queryfamilia->row('afamilia');
    $data['dfdescri']=$key->dfdescri;
    $data['POR_ATENDER']=$key->DFCANTID-$key->DFSALDO;
    $data['DFSALDO']=$key->DFSALDO;
    $data['situacion']=$key->situacion;
    $data['val_unit']=($key->dfimpus/$key->DFCANTID)/1.18;
    $data['total']=$key->dfimpus/1.18;




    $utf8carga[]=$data;
  }
    return $utf8carga;
  }
  public function pedido_atendido2($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);

    $querydata=$starsoft->query("select dfnumped,DFSECUEN,CFFECDOC,DFSALDO,cfrfnumdoc,CFORDCOM,DFCANTID,CFNOMBRE,DFCODIGO,dfdescri,
    'POR_ATENDER'=(dfcantid-DFSALDO),'situacion'= cfcotiza,dfimpus from PEDDET t0 inner join PEDCAB t1 on cfnumped=dfnumped
    where cfcotiza in ('ATENDIDO','LIQUIDADO') AND DFCODIGO NOT LIKE 'TEXTO' and cffecdoc between '".$fechainicio."' and '".$fechafin."'");

foreach ($querydata->result() as $key) {
    $data['CFNUMPED']=$key->dfnumped;
    $data['CFFECDOC']=date('d-m-Y',strtotime($key->CFFECDOC));
    $data['cfrfnumdoc']=$key->cfrfnumdoc;
    $data['CFORDCOM']=$key->CFORDCOM;
    $data['CFNOMBRE']=$key->CFNOMBRE;
    $data['DFCODIGO']=$key->DFCODIGO;
    $fechafacturacion=$starsoft->query("select top 1 cffecdoc from FACDET  inner join faccab  on cftd=dftd and cfnumser=dfnumser and cfnumdoc=dfnumdoc where cfnroped like '".$key->dfnumped."' and dfcodigo like '".$key->DFCODIGO."'");
    $data['FEC_FACT']=$fechafacturacion->row('cffecdoc');
    $query=$this->db->query('SELECT * FROM PEDDET WHERE DFNUMPED LIKE "'.$key->dfnumped.'" AND DFSECUEN="'.$key->DFSECUEN.'"');
    if ($query->num_rows()>0) {
    $data['DFCANTIDDIS']=$query->row('DFCANTIDDIS');
    $data['DFTIPTIME']=$query->row('DFTIPTIME');
    $data['DFFECENT']=$query->row('DFFECENT');
    $data['dias_reprogramados1']=$query->row('dias_reprogramados1');
    $data['fecha_reprogramada1']=$query->row('fecha_reprogramada1');
    $data['dias_reprogramados2']=$query->row('dias_reprogramados2');
    $data['fecha_reprogramada2']=$query->row('fecha_reprogramada2');
    $data['dias_reprogramados3']=$query->row('dias_reprogramados3');
    $data['fecha_reprogramada3']=$query->row('fecha_reprogramada3');
    }else {
      $data['DFCANTIDDIS']='';
      $data['DFTIPTIME']='';
      $data['DFFECENT']='';
      $data['dias_reprogramados1']='';
      $data['fecha_reprogramada1']='';
      $data['dias_reprogramados2']='';
      $data['fecha_reprogramada2']='';
      $data['dias_reprogramados3']='';
      $data['fecha_reprogramada3']='';
    }
//,'val_unit'=(dfimpus/DFCANTID)/1.18,'total'=(dfimpus)/1.18
$queryfamilia=$starsoft->query("select top 1 afamilia from maeart where acodigo='".$key->DFCODIGO."'");
    $data['familia']=$queryfamilia->row('afamilia');
    $data['dfdescri']=$key->dfdescri;
    $data['POR_ATENDER']=$key->DFCANTID-$key->DFSALDO;
    $data['DFSALDO']=$key->DFSALDO;
    $querystock=$starsoft->query("select top 1 stskdis from stkart where stcodigo='".$key->DFCODIGO."' and STALMA='01'");
    $data['stock_ahora']=$querystock->row('stskdis');
    $data['situacion']=$key->situacion;
    $data['val_unit']=($key->dfimpus/$key->DFCANTID)/1.18;
    $data['total']=$key->dfimpus/1.18;

    $query2=$this->db->query("select*from seguimiento_area where DFNUMPED='".$key->dfnumped."' and DFSECUEN='".$key->DFSECUEN."' and DFCODIGO='".$key->DFCODIGO."'");

    if ($query2->num_rows()>0) {
      if ($query2->row('area1')==1) {
        $data['area1']='INGENIERÍA';
      }elseif ($query2->row('area1')==2) {
        $data['area1']='PRODUCCIÓN';
      }elseif ($query2->row('area1')==3) {
        $data['area1']='COMPRAS';
      }elseif ($query2->row('area1')==4) {
        $data['area1']='ALMACÉN';
      }elseif ($query2->row('area1')=='') {
        $data['area1']='';
      }
      $data['fecha_inicio1']=date('d-m-Y',strtotime($query2->row('fecha_inicio1')));
      $data['fecha_final1']=date('d-m-Y',strtotime($query2->row('fecha_final1')));
      $year=date('Y',strtotime($query2->row('fecha_termino1')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];
      if (date('Y-m-d')>($query2->row('fecha_final1'))) {
        $data['indicador1']=(-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final1'))),date('Y-m-d'),$diasferiados)))-1;
      }else {
        $data['indicador1']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final1'))),$diasferiados))-1;
      }
      if ($query2->row('fecha_termino1')=='0000-00-00') {
        $data['fecha_termino1']='-';
        $data['tiempo1']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio1'))), date('Y-m-d'),$diasferiados))-1;
      } else {
        $data['fecha_termino1']=date('d-m-Y',strtotime($query2->row('fecha_termino1')));
        $data['tiempo1']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio1'))), date('Y-m-d',strtotime($query2->row('fecha_termino1'))),$diasferiados))-1;
      }

      if ($query2->row('area2')==1) {
        $data['area2']='INGENIERÍA';
      }elseif ($query2->row('area2')==2) {
        $data['area2']='PRODUCCIÓN';
      }elseif ($query2->row('area2')==3) {
        $data['area2']='COMPRAS';
      }elseif ($query2->row('area2')==4) {
        $data['area2']='ALMACÉN';
      }elseif ($query2->row('area2')=='') {
        $data['area2']='';
      }
      $data['fecha_inicio2']=date('d-m-Y',strtotime($query2->row('fecha_inicio2')));
      $data['fecha_final2']=date('d-m-Y',strtotime($query2->row('fecha_final2')));
      $year=date('Y',strtotime($query2->row('fecha_termino2')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];
      if (date('Y-m-d')>$query2->row('fecha_final2')) {
        $data['indicador2']=(-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final2'))),date('Y-m-d'),$diasferiados)))-1;
      }else {
        $data['indicador2']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final2'))),$diasferiados))-1;
      }
      if ($query2->row('fecha_termino2')=='0000-00-00') {
        $data['fecha_termino2']='-';
        $data['tiempo2']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio2'))), date('Y-m-d'),$diasferiados))-1;
      } else {
        $data['fecha_termino2']=date('d-m-Y',strtotime($query2->row('fecha_termino2')));
        $data['tiempo2']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio2'))), date('Y-m-d',strtotime($query2->row('fecha_termino2'))),$diasferiados))-1;
      }


      if ($query2->row('area3')==1) {
        $data['area3']='INGENIERÍA';
      }elseif ($query2->row('area3')==2) {
        $data['area3']='PRODUCCIÓN';
      }elseif ($query2->row('area3')==3) {
        $data['area3']='COMPRAS';
      }elseif ($query2->row('area3')==4) {
        $data['area3']='ALMACÉN';
      }elseif ($query2->row('area3')=='') {
        $data['area3']='';
      }
      $data['fecha_inicio3']=date('d-m-Y',strtotime($query2->row('fecha_inicio3')));
      $data['fecha_final3']=date('d-m-Y',strtotime($query2->row('fecha_final3')));
      $year=date('Y',strtotime($query2->row('fecha_termino3')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];
      if (date('Y-m-d')>($query2->row('fecha_final3'))) {
        $data['indicador3']=(-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final3'))),date('Y-m-d'),$diasferiados)))-1;
      }else {
        $data['indicador3']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final3'))),$diasferiados))-1;
      }

      if ($query2->row('fecha_termino3')=='0000-00-00') {
        $data['fecha_termino3']='-';
        $data['tiempo3']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio3'))), date('Y-m-d'),$diasferiados))-1;
      } else {
        $data['fecha_termino3']=date('d-m-Y',strtotime($query2->row('fecha_termino3')));
        $data['tiempo3']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio3'))), date('Y-m-d',strtotime($query2->row('fecha_termino3'))),$diasferiados))-1;

      }


      if ($query2->row('area4')==1) {
        $data['area4']='INGENIERÍA';
      }elseif ($query2->row('area4')==2) {
        $data['area4']='PRODUCCIÓN';
      }elseif ($query2->row('area4')==3) {
        $data['area4']='COMPRAS';
      }elseif ($query2->row('area4')==4) {
        $data['area4']='ALMACÉN';
      }elseif ($query2->row('area4')=='') {
        $data['area4']='';
      }
      $data['fecha_inicio4']=date('d-m-Y',strtotime($query2->row('fecha_inicio4')));
      $data['fecha_final4']=date('d-m-Y',strtotime($query2->row('fecha_final4')));
      $year=date('Y',strtotime($query2->row('fecha_termino4')));
      $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];

      if (date('Y-m-d')>($query2->row('fecha_final4'))) {
        $data['indicador4']=(-1*count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_final4'))),date('Y-m-d'),$diasferiados)))-1;
      }else {
        $data['indicador4']=count($this->getDiasHabiles(date('Y-m-d'),date('Y-m-d',strtotime($query2->row('fecha_final4'))),$diasferiados))-1;
      }
      if ($query2->row('fecha_termino4')=='0000-00-00' or $query2->row('fecha_termino4')=='') {
        $data['fecha_termino4']='-';
        $data['tiempo4']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio4'))), date('Y-m-d'),$diasferiados))-1;

      } else {
        $data['fecha_termino4']=date('d-m-Y',strtotime($query2->row('fecha_termino4')));
        $data['tiempo4']=count($this->getDiasHabiles(date('Y-m-d',strtotime($query2->row('fecha_inicio4'))), date('Y-m-d',strtotime($query2->row('fecha_termino4'))),$diasferiados))-1;

      }

    }else {
      $data['area1']='';
      $data['fecha_inicio1']='';
      $data['fecha_final1']='';
      $data['fecha_termino1']='';
      $data['indicador1']='';
      $data['tiempo1']='';
      $data['area2']='';
      $data['fecha_inicio2']='';
      $data['fecha_final2']='';
      $data['fecha_termino2']='';
      $data['indicador2']='';
      $data['tiempo2']='';
      $data['area3']='';
      $data['fecha_inicio3']='';
      $data['fecha_final3']='';
      $data['fecha_termino3']='';
      $data['indicador3']='';
      $data['tiempo3']='';
      $data['area4']='';
      $data['fecha_inicio4']='';
      $data['fecha_final4']='';
      $data['fecha_termino4']='';
      $data['indicador4']='';
      $data['tiempo4']='';

    }


    $utf8carga[]=$data;
  }
    return $utf8carga;
  }
  public function pruebafecha(){
    $year=date('Y');
    $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];

    return $this->getDiasHabiles( date('Y-m-d',strtotime('15-11-2019')),date('Y-m-d'),$diasferiados);
  }

  public function detallado_cotizaciones($fechainicio,$fechafin){
    $query=$this->db->query("SELECT distinct T1.CDNUMDOC,T0.CCFECDOC,T0.CCREF,T0.CCNOMBRE,T0.CCCODCLI,T1.CDCODIGO,T1.CDDESCRI,T1.CDCANTID, T1.CDUNIDAD, T1.CDPREC_ORI,T1.CDPORDES,
      'NETO'=(T1.CDPREC_ORI*((100-T1.CDPORDES)/100)),T2.costo_ref,T2.costo1,T1.CDFAMILIA,T1.PLAZO,T0.CCCODMON,T0.CCTIPCAM,T0.CCVENDE,
      (SELECT descripcion from estado_producto where id_estado=T1.CDESTADO) as 'CDESTADO',T1.CDSECUEN,(SELECT concat(nombre,' ',apepat,' ',apemat) FROM usuario WHERE usuarioid=T0.CCUSER) as cotizador FROM COTDET T1
      INNER JOIN COTCAB T0 ON T0.CCNUMDOC=T1.CDNUMDOC
      INNER JOIN analisis_precio T2 on T2.cotizacion=T1.CDNUMDOC AND T2.codigo=T1.CDCODIGO
      WHERE T1.CDCODIGO!='TEXTO' and T0.CCFECDOC between '".$fechainicio."' and '".$fechafin."'");

    return $query->result();
  }
  public function reporte_salidas_08($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);
    $info=$starsoft->query("select DENUMDOC,DEITEM,DECODIGO,DEDESCRI,DEUNIDAD,DECANTID,DEIMPUS,CAFECDOC from [010BDCOMUN]..movalmdet D
    inner join [010BDCOMUN]..movalmcab c on caalma=dealma and denumdoc=canumdoc and detd=catd
    where dealma like '08' and DETD like 'ni' and CACODMOV like 'TD' and CAFECDOC BETWEEN '".date('d-m-Y',strtotime($fechainicio))."'
    AND '".date('d-m-Y',strtotime($fechafin))."' ORDER BY DENUMDOC,DEITEM");
    return $info->result();
  }
  public function reporte_facturacion($fechainicio,$fechafin){

    $starsoft=$this->load->database('starsoft',TRUE);
    $info=$starsoft->query("SELECT distinct CFTD,CFNUMSER,CFNUMDOC,CFFECDOC,S.STKPREPROUS,DFSECUEN,V.Des_Ven,
    CFCODCLI,CFNOMBRE,DFCODIGO,DFDESCRI,DFUNIDAD,A.AFAMILIA,DFCANTID,DFPREC_ORI=(CASE WHEN CFCODMON='ME' THEN DFPREC_ORI ELSE DFPREC_ORI/CFTIPCAM END),
    DFPORDES,DFPREC_VEN=(CASE WHEN CFCODMON='ME' THEN DFPREC_VEN ELSE DFPREC_VEN*CFTIPCAM END) ,
    'TIPO_CLIENTE'=CASE WHEN CFRUC IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'NO RELACIONADA' END
    FROM [010BDCOMUN]..FACDET D
    INNER JOIN [010BDCOMUN]..FACCAB C ON D.DFNUMDOC=C.CFNUMDOC AND D.DFTD=C.CFTD AND CFNUMSER=DFNUMSER
    INNER JOIN [010BDCOMUN]..MAEART A ON A.ACODIGO=D.DFCODIGO
    LEFT JOIN [010BDCOMUN]..STKART S ON S.STCODIGO=D.DFCODIGO AND STALMA = CFALMA
    LEFT JOIN [010BDCOMUN]..vendedor V ON V.Cod_Ven=C.CFVENDE
    WHERE CFESTADO LIKE 'V' AND DFCODIGO NOT LIKE 'TEXTO' AND CFTIPFAC != 'FO'
    and CFFECDOC BETWEEN '".date('d-m-Y',strtotime($fechainicio))."' AND '".date('d-m-Y',strtotime($fechafin))."' ");
    return $info->result();
  }
  public function reporte_facturacion_pedidos_referencia($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);
    $info=$starsoft->query("SELECT distinct CFTD,CFNUMSER,CFNUMDOC,C.CFNROPED,C.CFORDCOM
    FROM [010BDCOMUN]..FACDET D
    INNER JOIN [010BDCOMUN]..FACCAB C ON D.DFNUMDOC=C.CFNUMDOC AND D.DFTD=C.CFTD AND CFNUMSER=DFNUMSER
    INNER JOIN [010BDCOMUN]..MAEART A ON A.ACODIGO=D.DFCODIGO
    LEFT JOIN [010BDCOMUN]..STKART S ON S.STCODIGO=D.DFCODIGO AND STALMA = CFALMA
    LEFT JOIN [010BDCOMUN]..vendedor V ON V.Cod_Ven=C.CFVENDE
    WHERE CFESTADO LIKE 'V' AND DFCODIGO NOT LIKE 'TEXTO' AND CFTIPFAC != 'FO'
    and CFFECDOC BETWEEN '".date('d-m-Y',strtotime($fechainicio))."' AND '".date('d-m-Y',strtotime($fechafin))."' ");
    return $info->result();
  }
  public function reporte_facturacion_cotizacion_referencia($fechainicio,$fechafin){
    $info = $this->db->query("select CCNUMDOC,CCREF,cfnumped from COTCAB inner join PEDCAB on CCNUMDOC=CFRFNUMDOC WHERE CCFECDOC BETWEEN '".date('Y-m-d',strtotime($fechainicio))."' AND '".date('Y-m-d',strtotime($fechafin))."'")->result();
	return $info;

 }
  private function getDiasHabiles($fechainicio, $fechafin,$diasferiados = array()) {
// Convirtiendo en timestamp las fechas
    $fechainicio = strtotime($fechainicio);
    $fechafin = strtotime($fechafin);

    // Incremento en 1 dia
    $diainc = 24*60*60;

    // Arreglo de dias habiles, inicianlizacion
    $diashabiles = array();

    // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
    for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
            // Si el dia indicado, no es sabado o domingo es habil
            if (!in_array(date('N', $midia), array(6,7))) { // DOC: http://www.php.net/manual/es/function.date.php
                    // Si no es un dia feriado entonces es habil
                    if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                            array_push($diashabiles, date('Y-m-d', $midia));
                    }
            }
    }

    return $diashabiles;
}
}
