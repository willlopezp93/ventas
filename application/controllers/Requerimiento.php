<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requerimiento extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('pdf','excel'));
    $this->load->model(array('Mdocumento','Mcontrato','MRequerimiento','Mcorreo','Marticulo','Mmaquinas'));
  }

  function index()
  {

  }
  public function listarDetalle(){
    $seriedoc=$this->input->post('seriedoc');
    $this->load->model(array('Mcargaexcel'));
    if($this->Mcargaexcel->consumo_listar_temporal($seriedoc)==0){
      $carga['detalle']=0;
    }
    $carga['detalle']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/transferencia/detalle.php',$carga);
  }
  public function listarSolicitud(){
    $seriedoc=$this->input->post('seriedoc');
    $this->load->model(array('Mcargaexcel'));
    if($this->Mcargaexcel->consumo_listar_temporal($seriedoc)==0){
      $carga['detalle']=0;
    }
    $carga['detalle']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/requerimiento/creacion_codigo.php',$carga);
  }

public function insertar_linea(){

$itemcodigo=$this->input->post('itemcodigo');

$req_cab=$this->input->post('req_cab');

$this->db->select('contratoid');
$this->db->from('reqmat_cab');
$this->db->where('docentry',$req_cab);
$contrato=$this->db->get();
$idcontrato=$contrato->row('contratoid');



$this->db->limit(1);
$this->db->select('item_num');
$this->db->from('reqmat_det');
$this->db->where('req_cab',$req_cab);
$this->db->order_by('item_num','desc');
$desc=$this->db->get();
$item_num=$desc->row('item_num');

$detalle=array('req_cab'=>$this->input->post('req_cab'),
                'item_num'=>$item_num+1,
                'itemcodigo'=>$this->input->post('itemcodigo'),
                'cant_req'=>$this->input->post('cant_req'),
                'cant_aprob'=>$this->input->post('cant_req'),
                'cant_atendida'=>0,
                'prioridad'=>$this->input->post('prioridad'),
                'maquina'=>$this->input->post('maquina'),
                'idcontrato'=>$idcontrato,
                'canceled'=>'n',
                'observaciones'=>$this->input->post('observaciones')
              );
                $lineasinserted=$this->MRequerimiento->insertar_linea($detalle,$itemcodigo);
if($lineasinserted<1){
  echo 0;
}
else{
  echo $req_cab;
}

}

public function stockmin(){
  $contrato= $this->session->userdata('alm_id');
  $data['stock']=$this->MRequerimiento->stockmin($contrato);
  $this->load->view('secciones/requerimiento/detalle_stock',$data);
}


  public function get_detalle_req($idcabecera){
    $this->db->select('estado_req');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$idcabecera);
    $query=$this->db->get();
    $data['estado']=$query->row('estado_req');

    $this->db->select('area');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$idcabecera);
    $query=$this->db->get();
    $data['area']=$query->row('area');

    $data['idcabecera']=$idcabecera;
    $data['detalle']=  $this->MRequerimiento->get_detalle_req($idcabecera);
    $data['req']=$this->MRequerimiento->get_nota_req($idcabecera);
    $area=$this->session->userdata('area');
    if ($this->session->userdata('rol_id')==18) {
      $this->load->view('secciones/requerimiento/detalle_req_area',$data);
    }if ($this->session->userdata('rol_id')==16) {
      $data['cabecera']=$idcabecera;

      $this->db->select('contratoid');
      $this->db->from('reqmat_cab');
      $this->db->where('docentry',$idcabecera);
      $query=$this->db->get();
      $idcontrato=$query->row('contratoid');

      $data['maquinas']=$this->Mmaquinas->getmaquinastoR1($idcontrato);
      $data['articulos']=$this->Marticulo->getMaeart();
      $this->load->view('secciones/requerimiento/detalle_req_lima',$data);
    }
    elseif ($this->session->userdata('rol_id')==17) {
      $data['cabecera']=$idcabecera;
      $this->db->select('contratoid');
      $this->db->from('reqmat_cab');
      $this->db->where('docentry',$idcabecera);
      $query=$this->db->get();
      $idcontrato=$query->row('contratoid');

      $data['maquinas']=$this->Mmaquinas->getmaquinastoR1($idcontrato);
      $data['articulos']=$this->Marticulo->getMaeart();
      $this->load->view('secciones/requerimiento/detalle_req_lima',$data);
    }elseif($this->session->userdata('rol_id')==1 or $this->session->userdata('rol_id')==12 ) {
      $data['firmas']=$this->Mdocumento->get_firmas_ctr($this->session->userdata('alm_id'),0,$idcabecera);
      $this->load->view('secciones/requerimiento/detalle_req_ctr',$data);
    }

  }
//atender detalle de requerimiento
  public function get_detalle_atender($idcabecera){
    $this->db->select('estado_req');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$idcabecera);
    $query=$this->db->get();
    $data['estado']= $query->row('estado_req');

    $data['idcabecera']=$idcabecera;

    $this->db->select('contratoid');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$idcabecera);
    $query=$this->db->get();
    $idcontrato=$query->row('contratoid');

    $data['maquinas']=$this->Mmaquinas->getmaquinastoR1($idcontrato);
    $data['articulos']=$this->Marticulo->getMaeart();
    $data['detalle']=  $this->MRequerimiento->get_detalle_req($idcabecera);
    $data['req']=$this->MRequerimiento->get_nota_req($idcabecera);
    $data['stocklima']=$this->MRequerimiento->get_stock_lima($idcabecera);
    $data['stockr1']=$this->MRequerimiento->get_stock_r1($idcabecera);
    $this->load->view('secciones/requerimiento/atender-requerimiento',$data);
  }
//anular item en la aprobacion_ctr.

public function eliminar_reqitem(){
  $item_num=$this->input->post('item_num');
  $req_cab=$this->input->post('req_cab');
  $respuesta=$this->MRequerimiento->eliminar($item_num,$req_cab);
    echo json_encode($respuesta);
}

public function firmar_req(){
  $req_cab=$this->input->post('req_cab');
  $area=$this->session->userdata('area');
  $dni=$this->session->userdata('user_dni');
  $nombre=$this->session->userdata('user_nombre')." ".$this->session->userdata('user_apepat');
  if($area==1){
    $this->db->set('firma_operaciones',$dni);
    $this->db->set('fecha_firma_operaciones',date('Y-m-d H:i:s'));
    $this->db->set('nombre_operaciones',$nombre);
  }if($area==2){
    $this->db->set('firma_ssoma',$dni);
    $this->db->set('fecha_firma_ssoma',date('Y-m-d H:i:s'));
    $this->db->set('nombre_ssoma',$nombre);
  }if($area==3){
    $this->db->set('firma_mantto',$dni);
    $this->db->set('fecha_firma_mantto',date('Y-m-d H:i:s'));
    $this->db->set('nombre_mantto',$nombre);
  }if($area==4){
    $this->db->set('firma_adm',$dni);
    $this->db->set('fecha_firma_adm',date('Y-m-d H:i:s'));
    $this->db->set('nombre_adm',$nombre);
  }
  $this->db->where('req_cab',$req_cab);
  $this->db->update('reqmat_firmas');
  if($this->db->affected_rows()>0){
    echo 'El requerimiento ha sido aprobado por usted';
  }
  else{
    return 'Error al aprobar';
  }
}
//APROBAR REQUERIMIENTO
public function aprobar_req(){
    $req_cab=$this->input->post('req_cab');
    $this->db->select('area,estado_req');
    $this->db->from('reqmat_cab');
    $this->db->where('docentry',$req_cab);
    $query=$this->db->get();
    $area=$query->row('area');
    $estado=$query->row('estado_req');

    if ($estado==0) {
      $this->db->select('correo_para');
      $this->db->from('area');
      $this->db->where('idarea',$area);
      $query=$this->db->get();
      $destinatario=$query->row('correo_para');

      $this->db->select('correo_cc');
      $this->db->from('area');
      $this->db->where('idarea',$area);
      $query=$this->db->get();
      $cc=$query->row('correo_cc');
    }if ($estado==2){

      $destinatario='jose.adrian@codrise.com';
      $cc='william.lopez@codrise.com';
    }elseif ($estado==5) {
      if ($this->session->userdata('rol_id')==17) {
        $destinatario='marco.garcia@codrise.com';
        $cc='josue.nunez@codrise.com';
      }else {
        $destinatario='jose.adrian@codrise.com';
        $cc='william.lopez@codrise.com';
      }
    }

    $detalle=json_decode($this->input->post('tbldetalle'));
    $info=$this->MRequerimiento->aprobar_req($detalle,$req_cab);
    if($info!=1){
      echo 'Hubo un error al aprobar';
    }else {
      $correo['destino']=$destinatario;
      $correo['remitente']=$cc;
      $correo['asunto']='Nuevos Requerimientos de Materiales Pendientes';

      $this->db->select('estado_req');
      $this->db->from('reqmat_cab');
      $this->db->where('docentry',$req_cab);
      $query2=$this->db->get();
      $estadonew=$query2->row('estado_req');




      if ($estadonew==2) {

        $datos['pendientes']=$this->MRequerimiento->req_aprobar($area,$estadonew);
        $correo['cuerpo']=$this->load->view('correos/requerimientonuevo', $datos,TRUE);
        $this->Mcorreo->enviar_correo($correo);
        echo 'Requerimiento aprobado exitosamente, será revisado por los responsables en Lima';
      }
      if ($estadonew==5) {

        $datos['pendientes']=$this->MRequerimiento->req_aprobar($area,$estadonew);
        $correo['cuerpo']=$this->load->view('correos/requerimientonuevo', $datos,TRUE);
        $this->Mcorreo->enviar_correo($correo);
        echo 'Requerimiento aprobado exitosamente, será revisado por el gerente de operaciones';
      }
      if ($estadonew==3) {

        $datos['pendientes']=$this->MRequerimiento->req_aprobar($area,$estadonew);
        $correo['cuerpo']=$this->load->view('correos/requerimientonuevo', $datos,TRUE);
        $this->Mcorreo->enviar_correo($correo);
        echo 'Requerimiento aprobado exitosamente, será atendido por el área de logística';
      }
    /*  else{
        echo 'No hay requerimiento por aprobar';
      }*/
    }

}

public function update_req(){
$req_cab=$this->input->post('req_cab');
$detalle=json_decode($this->input->post('tbldetalle'));
$info=$this->MRequerimiento->update_req($detalle,$req_cab);

if($info!=1){
  echo 'error';
}else {
  echo "Grabado correctamente";
}
}

public function update_sol(){
$req_cab=$this->input->post('req_cab');
$detalle=json_decode($this->input->post('tbldetalle'));
$info=$this->MRequerimiento->update_sol($detalle,$req_cab);

if($info!=1){
  echo 'error';
}else {
  echo "Grabado correctamente";
}
}

public function anular_req(){
  $req_cab=$this->input->post('req_cab');
  $info=$this->MRequerimiento->anular_req($req_cab);
   print_r($info);
}

  public function get_req(){
    $idcontrato=$this->input->post('idnota');
    $data['requerimientos']=$this->Mdocumento->get_reqs($idcontrato);
    $this->load->view('secciones/consultas/grid_req',$data);;
  }

  public function get_sol(){
    $idcontrato=$this->input->post('idnota');
    $data['solicitudes']=$this->MRequerimiento->gets_sol_cod($idcontrato);
    $this->load->view('secciones/consultas/grid_sol',$data);;
  }

  public function get_req_lima(){
    $contrato=$this->input->post('idnota');
    $estado= 2;


    $data['requerimientos']=$this->MRequerimiento->listar_req_lima($contrato,$estado);

    $this->load->view('secciones/requerimiento/aprobar_requerimiento',$data);
  }

  public function get_req_gerencia(){

    $contrato=$this->input->post('idnota');
    $estado=5;
    $data['requerimientos']=$this->MRequerimiento->listar_req_gerencia($contrato,$estado);

    $this->load->view('secciones/requerimiento/aprobar_requerimiento',$data);
  }

  public function get_atender_req(){

    $contrato=$this->input->post('idnota');

    $data['requerimientos']=$this->MRequerimiento->listar_req_log($contrato);
    $this->load->view('secciones/requerimiento/atencion_req',$data);
  }
public function liberar_req(){
  $reqcab=$this->input->post('req_cab');
  $detalle=json_decode($this->input->post('tbldetalle'));
  $info=$this->MRequerimiento->liberar_req($reqcab,$detalle);
  print_R($info);
}

  public function despacho_lima(){
      $req_cab=$this->input->post('req_cab');
      $detalle=json_decode($this->input->post('tbldetalle'));
      $info=$this->MRequerimiento->despacho_lima($detalle,$req_cab);
      $info['pdf']=base_url()."Requerimiento/despacho_lima_doc/".$info['last_id'];

      $this->db->select('estado_req');
      $this->db->from('reqmat_cab');
      $this->db->where('docentry',$req_cab);
      $query=$this->db->get();
      $estado=$query->row('estado_req');
      if($estado==1)
      {
        $correo['destino']='william.lopez@codrise.com';
        $correo['remitente']='';
        $datos['detalle']=$this->MRequerimiento->get_detalle_req($req_cab);
        $datos['cabecera']=$this->MRequerimiento->get_nota_req($req_cab);
        $correo['asunto']='Requerimiento Atendido';

        $correo['cuerpo']=$this->load->view('correos/req_atendido', $datos,TRUE);
        $this->Mcorreo->enviar_correo($correo);
      }
       echo json_encode($info);

  }
  public function despacho_r1(){
      $req_cab=$this->input->post('req_cab');
      $detalle=json_decode($this->input->post('tbldetalle'));
      $info=$this->MRequerimiento->despacho_r1($detalle,$req_cab);
    //  $info['excel']=base_url()."Articulo/exportar";
      //$info['excel']=base_url()."Reporte/despacho_r1_doc?despacho=".$info['last_id']."";

            $this->db->select('estado_req');
            $this->db->from('reqmat_cab');
            $this->db->where('docentry',$req_cab);
            $query=$this->db->get();
            $estado=$query->row('estado_req');
            if($estado==1)
            {
              $correo['destino']='william.lopez@codrise.com';
              $correo['remitente']='';
              $datos['detalle']=$this->MRequerimiento->get_detalle_req($req_cab);
              $datos['cabecera']=$this->MRequerimiento->get_nota_req($req_cab);
              $correo['asunto']='Requerimiento Atendido';

              $correo['cuerpo']=$this->load->view('correos/req_atendido', $datos,TRUE);
              $this->Mcorreo->enviar_correo($correo);
            }
       echo json_encode($info);

  }
  public function despacho_compra(){
      $req_cab=$this->input->post('req_cab');
      $detalle=json_decode($this->input->post('tbldetalle'));
      $info=$this->MRequerimiento->despacho_compra($detalle,$req_cab);

            $this->db->select('estado_req');
            $this->db->from('reqmat_cab');
            $this->db->where('docentry',$req_cab);
            $query=$this->db->get();
            $estado=$query->row('estado_req');
            if($estado==1)
            {
              $correo['destino']='william.lopez@codrise.com';
              $correo['remitente']='';
              $datos['detalle']=$this->MRequerimiento->get_detalle_req($req_cab);
              $datos['cabecera']=$this->MRequerimiento->get_nota_req($req_cab);
              $correo['asunto']='Requerimiento Atendido';

              $correo['cuerpo']=$this->load->view('correos/req_atendido', $datos,TRUE);
              $this->Mcorreo->enviar_correo($correo);
            }
      //$info['excel']=base_url()."Requerimiento/despacho_compra_doc?despacho=".$info['last_id'];
       echo json_encode($info);

  }
  public function req_compra(){
    $idcabecera=$this->input->post('req_cab');
    $data['detalle']=  $this->MRequerimiento->get_detalle_req($idcabecera);
    $data['req']=$this->MRequerimiento->get_nota_req($idcabecera);
    $data['cabecera']= $idcabecera;
    $this->load->view('/requerimiento/grid_compra',$data);
  }


  public function despacho_lima_doc($req_cab){
    $data=array();
    $data['cabecera']=$this->MRequerimiento->getdespachocab($req_cab);

    $data['detalle']=$this->MRequerimiento->getdespachodet($req_cab);

    $paper_size = array(0,0,0,-1);
    $html_content=
    $this->load->view('pdf/atender_req',$data,true);

    $this->pdf->set_paper($paper_size);
   $this->pdf->set_paper('A4','landscape');
    ini_set("memory_limit","10000M");
   $this->pdf->loadHtml($html_content);
  $this->pdf->render();
   $this->pdf->stream("DESPACHO 029-".STR_PAD($req_cab, 7, "0", STR_PAD_LEFT)."-ALMACENLIMA.pdf", array("Attachment"=>0));
  }



  public function despacho_compra_doc(){

    //load our new PHPExcel library

    //activate worksheet number 1
    $req_cab=$this->input->get('despacho');
    //set cell A1 content with some text
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('despacho');
   //$this->excel->getActiveSheet()->setCellValue('A2', 'Maestro de articulos activos');
  //$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(11);
  //$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(false);
  //$this->excel->getActiveSheet()->mergeCells('A2:H2');
    $cabecera=$this->MRequerimiento->getdespachocab($req_cab);

    $detalle=$this->MRequerimiento->getdespachodet($req_cab);

    //cabeceras
    $this->excel->getActiveSheet()->setCellValue('A1','CodigoProducto');
    $this->excel->getActiveSheet()->setCellValue('B1','DescripcionProducto');
    $this->excel->getActiveSheet()->setCellValue('C1','CantidadProducto');
    $this->excel->getActiveSheet()->setCellValue('D1','CentroCosto');
    $this->excel->getActiveSheet()->setCellValue('E1','GlosaDetalle');
    $this->excel->getActiveSheet()->setCellValue('F1','NumeroMaquina');
    $this->excel->getActiveSheet()->setCellValue('G1','OrdenFabricacion');

    //cuerpo
    $fila=2;
    foreach ($detalle as $key) {
      $this->excel->getActiveSheet()->setCellValue('A'.$fila,$key->itemcodigo);
      $this->excel->getActiveSheet()->setCellValue('B'.$fila,'');
      $this->excel->getActiveSheet()->setCellValue('C'.$fila,$key->itemcant);
      $this->excel->getActiveSheet()->setCellValue('D'.$fila,'00'.$cabecera->centrocosto);
      $this->excel->getActiveSheet()->setCellValue('E'.$fila,$key->itemobserv);
      $this->excel->getActiveSheet()->setCellValue('F'.$fila,$key->descripcion);
      $this->excel->getActiveSheet()->setCellValue('G'.$fila,'');
      $fila++;
    }
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
  //Limpiar el búfer de salida y deshabilitar el almacenamiento en el mismo
  ob_end_clean();
  $filename='Requerimiento de Compra'.STR_PAD($req_cab, 7, "0", STR_PAD_LEFT).'.xls';
   //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
  }



  public function despacho_r1_doc(){

    //load our new PHPExcel library

    //activate worksheet number 1
    $req_cab=$this->input->get('despacho');
    //set cell A1 content with some text
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('despachor1');

    $cabecera=$this->MRequerimiento->getdespachocab($req_cab);

    $detalle=$this->MRequerimiento->getdespachodet($req_cab);

    //cabeceras
    $this->excel->getActiveSheet()->setCellValue('A1','CODIGO');
    $this->excel->getActiveSheet()->setCellValue('B1','SERIE');
    $this->excel->getActiveSheet()->setCellValue('C1','CANTIDAD');
    $this->excel->getActiveSheet()->setCellValue('D1','MAQUINA');
    $this->excel->getActiveSheet()->setCellValue('E1','DOCREF');

    //cuerpo
    $fila=2;
    foreach ($detalle as $key) {
      $this->excel->getActiveSheet()->setCellValue('A'.$fila,$key->itemcodigo);
      $this->excel->getActiveSheet()->setCellValue('B'.$fila,'');
      $this->excel->getActiveSheet()->setCellValue('C'.$fila,$key->itemcant);
      $this->excel->getActiveSheet()->setCellValue('D'.$fila,$key->descripcion);
      $this->excel->getActiveSheet()->setCellValue('E'.$fila,STR_PAD($cabecera->req_correlativo, 7, "0", STR_PAD_LEFT));

      $fila++;
    }
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
    $this->excel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
  //Limpiar el búfer de salida y deshabilitar el almacenamiento en el mismo
  ob_end_clean();
  $filename='DESPACHO 031-'.STR_PAD($req_cab, 7, "0", STR_PAD_LEFT).'-ALMACENR1.xls';
   //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
  }



  public function creacion_codigo(){
    #$data['cabecera']=$this->Mreportesig->getcabecerasig($id);

    #$data['detalles']=$this->Mreportesig->getdetallesig($id);
    $data=array();
    $paper_size = array(0,0,0,-1);
    $html_content=$this->load->view('pdf/creacion_codigo_sig',$data,TRUE);

    $this->pdf->set_paper($paper_size);
   $this->pdf->set_paper('A4','landscape');
    ini_set("memory_limit","10000M");
   $this->pdf->loadHtml($html_content);
  $this->pdf->render();
   $this->pdf->stream("RD.116.F.01 Creacion de Codigos Internos.pdf", array("Attachment"=>0));
  }


  public function trazabilidad_aprobaciones()
  {
    $idalmacen=$this->input->post('idnota');
    $data['aprobaciones']=$this->MRequerimiento->get_aprobaciones($idalmacen);
    $this->load->view('requerimiento/trazabilidad_aprobaciones',$data);

  }
}
