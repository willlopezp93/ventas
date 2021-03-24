<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msupport extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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
  public function generar_orden($detalle,$cabecera,$igvpor,$TPDOLAR,$TPSOL,$cotizacion,$texto_glosa,$punto_venta){

    $starsoft=$this->load->database('starsoft',TRUE);
    //iniciar transaccion
  $error='';
  $this->db->trans_begin();
  //obtener cabecera del despacho
  //insertar cabecera
    $ultimo=$this->get_ultimo_ped();
     $lastid=$this->get_correlativo_pedido();

  while ($ultimo==str_pad($lastid, 7, "0", STR_PAD_LEFT)){
    $ultimo=$this->get_ultimo_ped();

  }
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
                      if ($key->responsable=='') {
                        $condiciondet='total';
                      } else {
                        $condiciondet='parcial';
                      }

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
                                        'DFRESPONSABLE'=>$key->responsable,
                                        'DFCONDICION'=>$condiciondet,
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
                                      'DFRESPONSABLE'=>'',
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
  private function get_ultimo_ped(){
    $starsoft=$this->load->database('starsoft',TRUE);
     $query=$starsoft->query("select top 1 CFNUMPED from [010BDCOMUN]..pedcab");
       return  $query->row('CFNUMPED');
  }

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
