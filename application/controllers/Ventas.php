<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    $this->load->model(array('Mcorrelativo','Mguiasalida','Mtransaccion','Mtablaayuda'));
        $this->load->library('Excel');
  }

  function index()
  {

  }

  public function generar_cotizacion(){
    $this->load->model(array('Mtransaccion','Mtablaayuda'));


    $igvpor=$this->input->post('igvpor');
    $subtotal=$this->input->post('subtotal');
    $tipocambio=$this->input->post('tipocambio');
    $fechadoc=$this->input->post('fecha_doc');
    $cabecera['CCNUMDOC']=$this->Mtablaayuda->correlativo('cot');
    $cabecera['CCFECDOC']=date('Y-m-d H:i:s',strtotime($this->input->post('fecha_doc')));
    $cabecera['CCFECSYS']=date('Y-m-d h:i:s');
    $cabecera['CCVENDE']=$this->input->post('vendedor');
    $cabecera['CCFORPAG']=$this->input->post('forma_pago');
    $cabecera['CCPUNVEN']=$this->input->post('pto_venta');
    $cabecera['CCCODCLI']=$this->input->post('cliente');
    $cabecera['CCDIRECC']=$this->input->post('direccion');
    $cabecera['CCPORDESCL']=$this->input->post('dsct_cliente_valor');
    $cabecera['CCPORDESES']=0*100;
    $cabecera['CCIMPORTE']=$this->input->post('total_doc');
    $cabecera['CCTIPCAM']=$this->input->post('tipocambio');
    $cabecera['CCCODMON']=$this->input->post('moneda');
    $cabecera['CCUSER']=$this->session->userdata('user_id');
    $cabecera['CCREF']=$this->input->post('doc_ref');
    $cabecera['CCDESVAL']=$this->input->post('dsct_cliente_valor')+$this->input->post('dsct_esp_valor');
    $cabecera['CCIGV']=$this->input->post('igv');
    $cabecera['CCTIPCOTIZA']=$this->input->post('tipocot');
    $cabecera['CCLUGENT']=$this->input->post('tipocot');
    $cabecera['COD_CONTACTO']=$this->input->post('contacto');
    $cabecera['CCALMESP']=$this->input->post('especificar_almacen');
    $cabecera['CCESTADO']=1;
    $cabecera['CLOSED']='F';
    $detalle=json_decode($this->input->post('tbldetalle'));

    $resultado=$this->Mtransaccion->detalle($detalle,$cabecera,$igvpor,$subtotal,$fechadoc,$tipocambio);

    echo $resultado;

  }

  public function actualizar_cotizacion(){
    $this->load->model(array('Mtransaccion','Mtablaayuda'));


    $igvpor=$this->input->post('igvpor');
    $subtotal=$this->input->post('subtotal');
    $tipocambio=$this->input->post('tipocambio');
    $fechadoc=$this->input->post('fecha_doc');
    $cabecera['CCNUMDOC']=$this->input->post('numdoc');
  //  $cabecera['CCFECDOC']=date('Y-m-d H:i:s',strtotime($this->input->post('fecha_doc')));
    //$cabecera['CCFECSYS']=date('Y-m-d h:i:s');

    $cabecera['CCFORPAG']=$this->input->post('forma_pago');
    $cabecera['CCPUNVEN']=$this->input->post('pto_venta');
    $cabecera['CCCODCLI']=$this->input->post('cliente');
    $cabecera['CCDIRECC']=$this->input->post('direccion');
    $cabecera['CCPORDESCL']=$this->input->post('dsct_cliente_valor');
    $cabecera['CCPORDESES']=0*100;
    $cabecera['CCIMPORTE']=$this->input->post('total_doc');
    $cabecera['CCTIPCAM']=$this->input->post('tipocambio');
    $cabecera['CCCODMON']=$this->input->post('moneda');
  //  $cabecera['CCUSER']=$this->session->userdata('user_id');
    $cabecera['CCREF']=$this->input->post('doc_ref');
    $cabecera['CCDESVAL']=$this->input->post('dsct_cliente_valor')+$this->input->post('dsct_esp_valor');
    $cabecera['CCIGV']=$this->input->post('igv');
    $cabecera['CCTIPCOTIZA']=$this->input->post('tipocot');
    $cabecera['CCLUGENT']=$this->input->post('tipocot');
    $cabecera['COD_CONTACTO']=$this->input->post('contacto');
    $cabecera['CCALMESP']=$this->input->post('especificar_almacen');
    $cabecera['CCESTADO']=1;
    $cabecera['CLOSED']='F';
    $detalle=json_decode($this->input->post('tbldetalle'));

    $resultado=$this->Mtransaccion->actualizar_cot($detalle,$cabecera,$igvpor,$subtotal,$fechadoc,$tipocambio);

    echo $resultado;

  }

public function analisis_precios(){
  $this->load->model(array('Mtransaccion','Mtablaayuda'));
    $detalle=json_decode($this->input->post('tbldetalle'));
    $data['analisis']= $this->Mtransaccion->analisis_precios($detalle);
    $this->load->view('proceso/analisis_precio',$data);
}

public function consultar_analisis($cotizacion){
  $this->load->model(array('Mtransaccion','Mtablaayuda'));
    $data['analisis']= $this->Mtransaccion->consultar_analisis_precios($cotizacion);
    $this->load->view('proceso/analisis_precio',$data);
}

public function duplicar_cotizacion($documento,$tipo){

  $this->load->model(array('Mtransaccion','Mtablaayuda'));

  $usuario=$this->session->userdata('user_id');

  if ($usuario=="") {
    redirect('Login');
  } else {
    $this->db->query('DELETE FROM carga_excel WHERE usuario='.$usuario.'');
    $data['cabecera']=$this->Mtransaccion->get_cabecera($documento);
    $clientecot=$this->Mtransaccion->get_clientecot($documento);
    $data['detalle']=$this->Mtransaccion->get_detalle_dup($documento);
    $data['cliente']=$this->Mtablaayuda->clientes();
    $data['plazo']=$this->Mtablaayuda->tiempo_entrega();
    $data['forma_pago']=$this->Mtablaayuda->get_forma_pago();
    $data['punto_venta']=$this->Mtablaayuda->punto_venta();
    $data['contacto']=$this->Mtablaayuda->contacto($clientecot);
    $data['direcciones']=$this->Mtablaayuda->direcciones($clientecot);
    $this->load->model('Mtablaayuda');
    if ($tipo=='duplicar') {
      $data['correlativo']=$this->Mtablaayuda->correlativo('cot');

    }elseif ($tipo='atender') {
      $data['correlativo']=$documento;
    }
    $data['transaccion']=$tipo;
    $data['clientecot']=$clientecot;

    $this->load->view('layout/header');
    $this->load->view('layout/menu');
    $this->load->view('secciones/proceso/cotizacion_dup',$data);
    $this->load->view('layout/footer');
  }

}

public function get_detalle($cotizacion){
    $this->load->model(array('Mtransaccion','Mtablaayuda'));
  $data['estado']=$this->Mtablaayuda->get_estado_producto();
  $data['detalle']=$this->Mtransaccion->get_detalle($cotizacion);
  $this->load->view('secciones/proceso/cerrar_cot',$data);
}
public function get_detalle_cierre($cotizacion){
    $this->load->model(array('Mtransaccion','Mtablaayuda'));
  $data['estado']=$this->Mtablaayuda->get_estado_producto();
  $data['detalle']=$this->Mtransaccion->get_detalle($cotizacion);
  $this->load->view('secciones/consultas/grid_cierre',$data);
}
public function atender_cotizacion(){
  $cotizacion=$this->input->post('id');
    $this->load->model(array('Mtransaccion','Mtablaayuda'));
    $clientecot=$this->Mtransaccion->get_clientecot($cotizacion);
    $data['cliente']=$this->Mtablaayuda->clientes();
    $data['plazo']=$this->Mtablaayuda->tiempo_entrega();
    $data['forma_pago']=$this->Mtablaayuda->get_forma_pago();
    $data['contacto']=$this->Mtablaayuda->contacto($clientecot);
    $data['direcciones']=$this->Mtablaayuda->direcciones($clientecot);
 $data['correlativo_ped']=$this->Mtransaccion->get_correlativo_pedido2();
  $data['cabecera']=$this->Mtransaccion->get_cabecera($cotizacion);
  $data['detalle']=$this->Mtransaccion->get_detalle($cotizacion);
  $data['detalle_stock']=$this->Mtransaccion->get_detalle_stock($cotizacion);
  $this->load->view('secciones/proceso/atender_cotizacion',$data);
}
public function atender_cotizacion_test(){
  $cotizacion=$this->input->post('id');
    $this->load->model(array('Mtransaccion','Mtablaayuda'));
    $clientecot=$this->Mtransaccion->get_clientecot($cotizacion);
    $data['cliente']=$this->Mtablaayuda->clientes();
    $data['plazo']=$this->Mtablaayuda->tiempo_entrega();
    $data['forma_pago']=$this->Mtablaayuda->get_forma_pago();
    $data['contacto']=$this->Mtablaayuda->contacto($clientecot);
    $data['direcciones']=$this->Mtablaayuda->direcciones($clientecot);
 $data['correlativo_ped']=$this->Mtransaccion->get_correlativo_pedido2();
  $data['cabecera']=$this->Mtransaccion->get_cabecera($cotizacion);
  $data['detalle']=$this->Mtransaccion->get_detalle($cotizacion);
  $data['detalle_stock']=$this->Mtransaccion->get_detalle_stock($cotizacion);
  $this->load->view('secciones/proceso/atender_cotizacion_test',$data);
}
public function generar_orden(){
    $cotizacion=$this->input->post('cotizacion');
    $this->db->select('*');
    $this->db->from('COTCAB');
    $this->db->where('CCNUMDOC',$cotizacion);
    $query=$this->db->get();
    $data=$query->row();
    if($query->num_rows()>0){
      $cabecera['CFNUMPED']=str_pad($this->Mtransaccion->get_correlativo_pedido2(), 7, "0", STR_PAD_LEFT);
      $cabecera['CFFECDOC']=date('d-m-Y');//pendiente
      $cabecera['CFFECVEN']=date('d-m-Y');
      $cabecera['CFVENDE']=$data->CCVENDE;
      $cabecera['CFPUNVEN']=$data->CCPUNVEN;
      $cabecera['CFCODCLI']=$data->CCCODCLI;
      $cabecera['CFNOMBRE']=$data->CCNOMBRE;
      $starsoft=$this->load->database('starsoft',TRUE);
      $direccion=$starsoft->query("select CDIRCLI from DIRE_CLIENTE where cod_direccion=".$data->CCDIRECC);

      $cabecera['CFDIRECC']=$direccion->row('CDIRCLI');
      $cabecera['CFRUC']=$data->CCRUC;
    	$cabecera['CFIMPORTE']=number_format($this->input->post('total_doc'),6, '.', '');
    	$cabecera['CFPORDESCL']=0;
    	$cabecera['CFPORDESES']=0;
    	$cabecera['CFFORVEN']=$data->CCFORPAG;
    	$cabecera['CFTIPCAM']=number_format($this->input->post('tipocambio'),6, '.', '');
    	$cabecera['CFCODMON']=$data->CCCODMON;
    	$cabecera['CFRFTD']='CT';
    	$cabecera['CFRFNUMSER']='';
    	$cabecera['CFRFNUMDOC']=str_pad($cotizacion, 7, "0", STR_PAD_LEFT);
    	$cabecera['CFFECCRE']=date('d-m-Y');
    	$cabecera['CFESTADO']='V';
    	$cabecera['CFUSER']=$this->session->userdata('user_id');
    	$cabecera['CFGLOSA']='';
    	$cabecera['CFNUMGUI']='';
    	$cabecera['CFNUMFAC']='';
    	$cabecera['CFORDCOM']=$this->input->post('oc');//pendiente
    	$cabecera['CFGLOSA1']='';
    	$cabecera['CFIGV']=number_format($this->input->post('igv'),6, '.', '');
    	$cabecera['CFDESCTO']=0;
    	$cabecera['CFDESIMP']=0;
    	$cabecera['CFTIPFAC']='';
    	$cabecera['CFDESVAL']=number_format($this->input->post('dsct_cliente_valor'),6, '.', '');
    	$cabecera['CFCOTIZA']='EMITIDO';
    	$cabecera['COD_AUDITORIA']='';
    	$cabecera['COD_DIRECCION']=0;
    	$cabecera['CFLINEA']='';
    	$cabecera['CFORDENFAB']='';//pendiente
    	$cabecera['CFDIRECCA']='';
    	$cabecera['CFESTADO_PED']='';
    	$cabecera['CFEXISTECOTIZA']=0;
    	$cabecera['RESPUESTA']='';
    	$cabecera['TIPO']='CT';

      if ($data->CCCODMON=='ME') {
        $TPDOLAR=1;
        $TPSOL=$data->CCTIPCAM;
      }else {
        $TPDOLAR=1/$data->CCTIPCAM;
        $TPSOL=1;
      }

      $detalle=json_decode($this->input->post('tbldetalle'));
      $igvpor=$this->input->post('igvpor');
      $punto_venta=$data->CCPUNVEN;

    $info=$this->Mtransaccion->generar_orden($detalle,$cabecera,$igvpor,$TPDOLAR,$TPSOL,$cotizacion,$this->input->post('CFGLOSA'),$punto_venta);


    if (!$info) {
      echo "Intentar de nuevo";
    }else {
       echo $info;
    }
  }else {
    echo "ALERT";
  }



}
public function excel_analisis(){

      $this->excel->setActiveSheetIndex(0);
      $this->excel->getActiveSheet()->setTitle('despacho');

      $detalle=json_decode($this->input->post('tbldetalle'));
      //cabeceras
    $this->excel->getActiveSheet()->setCellValue('A2','Código');
      $this->excel->getActiveSheet()->setCellValue('B2','Descripcion');
      $this->excel->getActiveSheet()->setCellValue('C2','Costo 1');
      $this->excel->getActiveSheet()->setCellValue('D2','Costo 2');
      $this->excel->getActiveSheet()->setCellValue('E2','Costo 3');
      $this->excel->getActiveSheet()->setCellValue('F2','Costo Ref.');
      $this->excel->getActiveSheet()->setCellValue('G2','P.Lista');
      $this->excel->getActiveSheet()->setCellValue('H2','Dcto.');
      $this->excel->getActiveSheet()->setCellValue('I2','P.Neto');
      $this->excel->getActiveSheet()->setCellValue('J2','% Margen');
      $this->excel->getActiveSheet()->setCellValue('K2','% Margen Ref');
      //cuerpo
      $fila=3;
      foreach ($detalle as $key) {
        $this->excel->getActiveSheet()->setCellValue('A'.$fila,$key->excel_CDCODIGO);
        $this->excel->getActiveSheet()->setCellValue('B'.$fila,$key->excel_descripcion);
        $this->excel->getActiveSheet()->setCellValue('C'.$fila,$key->excel_precio1);
        $this->excel->getActiveSheet()->setCellValue('D'.$fila,$key->excel_precio2);
        $this->excel->getActiveSheet()->setCellValue('E'.$fila,$key->excel_precio3);
        $this->excel->getActiveSheet()->setCellValue('F'.$fila,$key->excel_COSTO_REF);
        $this->excel->getActiveSheet()->setCellValue('G'.$fila,$key->excel_CDPREC_ORI);
        $this->excel->getActiveSheet()->setCellValue('H'.$fila,$key->excel_CDPORDES);
        $this->excel->getActiveSheet()->setCellValue('I'.$fila,$key->excel_CDPRENET);
        $this->excel->getActiveSheet()->setCellValue('J'.$fila,str_replace(" ","",$key->excel_CDMARGEN));
        $this->excel->getActiveSheet()->setCellValue('K'.$fila,str_replace(" ","",$key->excel_MARGEN_REF));
        $fila++;
      }
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('G')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('H')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('I')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('J')->setAutoSize(true);
      $this->excel->setActiveSheetIndex(0)->getColumnDimension('K')->setAutoSize(true);
    //Limpiar el búfer de salida y deshabilitar el almacenamiento en el mismo
    ob_end_clean();
    $filename='Analisis de Precio.xls';
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
public function cerrar_cot(){
  $cotizacion=$this->input->post('cotizacion');
  $detalle=json_decode($this->input->post('tbldetalle'));
  $error=0;
  foreach ($detalle as $key) {
     if ($key->ESTADO=='') {
      $error++;
     }
  }
  if ($error==0) {
  echo  $this->Mtransaccion->cerrar_cot($cotizacion,$detalle);
}else {
  echo 0;
}

}
public function get_correlativo_pedido(){
  echo $this->Mtransaccion->get_correlativo_pedido2();
}
public function get_programacion_det(){
            $starsoft=$this->load->database('starsoft',TRUE);
    $pedido=$this->input->post('id');
    $starsoft->select('CFFECDOC');
    $starsoft->from('PEDCAB');
    $starsoft->where('CFNUMPED',$pedido);
    $data['fecha']=$starsoft->get()->row('CFFECDOC');
    $data['detalle']=$this->Mtransaccion->get_pedido_det($pedido);
    $this->load->view('secciones/proceso/reprogramacion',$data);
    //print_r($data);
}
public function get_pedido_det(){
    $pedido=$this->input->post('id');
    $this->db->select('CFFECDOC');
    $this->db->from('PEDCAB');
    $this->db->where('CFNUMPED',$pedido);
    $data['fecha']=$this->db->get()->row('CFFECDOC');
    $data['detalle']=$this->Mtransaccion->get_pedido_det($pedido);
    $this->load->view('secciones/consultas/pedido',$data);
}
public function reprogramar(){
      $pedido=$this->input->post('pedido');
      $detalle=json_decode($this->input->post('tbldetalle'));
      echo $this->Mtransaccion->reprogramar($pedido,$detalle);
}
public function actualizar_cantidad(){
    $item=$this->input->post('item');
    $cantidad=$this->input->post('cantidad');
    $usuario=$this->session->userdata('user_id');
      $this->db->set('cantidad',$cantidad);
      $this->db->where('usuario',$usuario);
      $this->db->where('item',$item);
      $this->db->update('carga_excel');

      echo 1;
}
public function actualizar_descuento(){
    $item=$this->input->post('item');
    $descuento=$this->input->post('descuento');
    $usuario=$this->session->userdata('user_id');
      $this->db->set('descuento',$descuento);
      $this->db->where('usuario',$usuario);
      $this->db->where('item',$item);
      $this->db->update('carga_excel');

      echo 1;
}
public function actualizar_precio(){
    $item=$this->input->post('item');
    $precio=$this->input->post('precio');
    $usuario=$this->session->userdata('user_id');
      $this->db->set('precio',$precio);
      $this->db->where('usuario',$usuario);
      $this->db->where('item',$item);
      $this->db->update('carga_excel');

      echo 1;
}
public function actualizar_tiempo(){
    $item=$this->input->post('item');
    $tiempo=$this->input->post('tiempo');
    $usuario=$this->session->userdata('user_id');
      $this->db->set('tiempo',$tiempo);
      $this->db->where('usuario',$usuario);
      $this->db->where('item',$item);
      $this->db->update('carga_excel');

      echo 1;
}
public function actualizar_descripcion(){
    $item=$this->input->post('item');
    $descripcion=$this->input->post('desc');
    $usuario=$this->session->userdata('user_id');
      $this->db->set('descripcion',$descripcion);
      $this->db->where('usuario',$usuario);
      $this->db->where('item',$item);
      $this->db->update('carga_excel');

      echo 1;
}
public function actualizar_dias(){
    $item=$this->input->post('item');
    $dias=$this->input->post('dias');
    $usuario=$this->session->userdata('user_id');
      $this->db->set('dias',$dias);
      $this->db->where('usuario',$usuario);
      $this->db->where('item',$item);
      $this->db->update('carga_excel');
      echo 1;
}
public function centrocosto_cotizacion(){
  $cotizacion=$this->input->post('cotizacion');
  $item=$this->input->post('item');
  $cc=str_replace(' ', '', $this->input->post('cc'));

  $this->db->set('DFCENCOS',$cc);
  $this->db->where('CDNUMDOC',$cotizacion);
  $this->db->where('CDSECUEN',$item);
  $this->db->update('COTDET');

if (!$this->db->affected_rows()) {
  echo '';
}else {
  echo $cc;
}

}

public function Asignarcc(){
  echo $this->Mtransaccion->asignarcc();

}
public function pedido_pendiente(){
  $vendedor=$this->input->post('vendedor');
  $data['pedido']=$this->Mtransaccion->pedido_pendiente($vendedor);
  $this->load->view('secciones/reportes/pedido_pendiente',$data);
}
public function pedido_atendido(){
  $fechainicio=date('d-m-Y',strtotime($this->input->post('fecha_inicio')));
  $fechafin=date('d-m-Y',strtotime($this->input->post('fecha_fin')));
  $data['pedido']=$this->Mtransaccion->pedido_atendido($fechainicio,$fechafin);
  $this->load->view('secciones/reportes/pedido_atendido2',$data);
  //$this->load->view('secciones/reportes/pedido_atendido',$data);
}
public function listar_pedidos(){
  $fechainicio=date('d-m-Y',strtotime($this->input->post('fecha_inicio')));
  $fechafin=date('d-m-Y',strtotime($this->input->post('fecha_fin')));
  $data['pedidos']=$this->Mtransaccion->get_pedido_total($fechainicio,$fechafin);
  $this->load->view('secciones/proceso/seguimiento_pedidos',$data);
}
  public function consultar_detalle_pendiente($pedido){
    $data['pedido']=$pedido;
    $data['detalle']=$this->Mtransaccion->get_pedido_det($pedido);
    $this->load->view('secciones/proceso/seguimiento',$data);
  }
  public function detallado_cotizaciones(){
    $fechainicio=$this->input->post('fecha_inicio');
    $fechafin=$this->input->post('fecha_fin');
    $data['detalle']=$this->Mtransaccion->detallado_cotizaciones($fechainicio,$fechafin);
		$this->load->model('Mtablaayuda');
		$data['vendedor']=$this->Mtablaayuda->vendedor();
    $this->load->view('secciones/consultas/detallado_cotizaciones',$data);
  }
  public function consultar_areas_seguimiento($pedido,$item){
    $query=$this->db->query("select*from seguimiento_area where DFNUMPED='".$pedido."' and DFSECUEN='".$item."'");
    if ($query->num_rows()>0) {
      $data['condicion']=1;
    } else {
      $data['condicion']=0;
    }

    $data['key']=$query->row();
    $this->load->view('secciones/proceso/areas',$data);
  }

  public function seguimiento(){
    $data['DFNUMPED']=$this->input->post('pedido');
    $data['DFSECUEN']=$this->input->post('DFSECUEN');
    $data['DFCODIGO']=$this->input->post('DFCODIGO');
    $detalle=json_decode($this->input->post('tbldetalle'));
    $item=1;
    foreach ($detalle as $key) {
      $data["area".$item]=$key->areatd;
      $data["fecha_inicio".$item]=$key->fecha_inicio;
      $data["fecha_final".$item]=$key->fecha_fin;
      $data["fecha_termino".$item]=$key->fecha_termino;
      $item++;
    }
    $query=$this->db->query("select*from seguimiento_area where DFNUMPED='".$data['DFNUMPED']."' and DFSECUEN='".$data['DFSECUEN']."' and DFCODIGO='".$data['DFCODIGO']."'");
    if ($query->num_rows()>0) {
      $this->db->where('DFNUMPED',$data['DFNUMPED']);
      $this->db->where('DFSECUEN',$data['DFSECUEN']);
      $this->db->where('DFCODIGO',$data['DFCODIGO']);
      $this->db->delete('seguimiento_area');

      $this->db->insert('seguimiento_area',$data);
    } else {
      $this->db->insert('seguimiento_area',$data);
    }


    echo $this->db->affected_rows();
  }
  public function meta_venta(){
    $año=$this->input->post('año');
    $detalle=json_decode($this->input->post('tbldetalle'));

    $query=$this->db->query("select*from meta_venta where año=".$año);
    $item=1;
    if ($query->num_rows()>0) {
      foreach ($detalle as $key) {
        $this->db->set('meta_relacionada',$key->relacionado);
        $this->db->set('meta_tercero',$key->tercero);
        $this->db->set('dias_extraordinarios',$key->diasextra);
        $this->db->where('mes',$item);
        $this->db->where('año',$año);
        $this->db->update('meta_venta');
        $item++;
      }
    } else {
      foreach ($detalle as $key) {
        $data['año']=$año;
        $data['mes']=$item;
        $data['meta_relacionada']=$key->relacionado;
        $data['meta_tercero']=$key->tercero;
        $this->db->insert('meta_venta',$data);
        $item++;
      }
    }
    echo $this->db->affected_rows();
  }

  public function consultar_meta($año){
  $query=$this->db->query("SELECT * FROM meta_venta where año=".$año);
  if ($query->num_rows()>0) {
    $data['condicion']=1;
  } else {
    $data['condicion']=0;
  }

  $data['metas']=$query->result();
  $this->load->view('secciones/tabla-ayuda/meta_venta',$data);
}
  public function consultar_suministro($mes){
    $query=$this->db->query("SELECT * FROM contrato_suministro where mes='".$mes."'");
    if ($query->num_rows()>0) {
      $data['condicion']=1;
    } else {
      $data['condicion']=0;
    }

    $data['suministro']=$query->result();
    $this->load->view('secciones/tabla-ayuda/contrato_suministro',$data);
  }
  public function contrato_suministro(){
    $mes=$this->input->post('mes');
    $detalle=json_decode($this->input->post('tbldetalle'));

    $query=$this->db->query("SELECT * FROM contrato_suministro where mes='".$mes."'");
    $item=1;
    if ($query->num_rows()>0) {
      foreach ($detalle as $key) {
        $this->db->set('monto_facturado',$key->monto);
        $this->db->where('semana',$key->semana);
        $this->db->where('mes',$mes);
        $this->db->update('contrato_suministro');
        $item++;
      }
    } else {
      foreach ($detalle as $key) {
        $data['mes']=$mes;
        $data['semana']=$key->semana;
        $data['monto_facturado']=$key->monto;
        $this->db->insert('contrato_suministro',$data);
      }
    }
    echo $this->db->affected_rows();
  }
  public function consultar_analisis_precios_rango(){
  $fechainicio=$this->input->post('fecha_inicio');
  $fechafin=$this->input->post('fecha_fin');

  $data['analisis']=$this->Mtransaccion->consultar_analisis_precios_rango($fechainicio,$fechafin);
  $this->load->view('secciones/consultas/consultas_analisis_precio',$data);
  }

  public function anular_pedido(){
    $pedido=$this->input->post('pedido');
    $cotizacion=$this->input->post('cotizacion');

    $starsoft=$this->load->database('starsoft',TRUE);
    $existecoti=$this->db->query("select*from COTCAB where CCNUMDOC LIKE '".$cotizacion."'");
    $traerpedido=$this->db->query("select*from PEDDET where DFNUMPED LIKE '".$pedido."'");

    foreach ($traerpedido->result() as $key) {
      $this->db->set('CDCANTPEN','CDCANTPEN+'.$key->DFCANTID);
      $this->db->where('CDSECUEN',$key->DFITEMCOT);
      $this->db->where('CDNUMDOC',$cotizacion);
      $this->db->update('COTDET');

      $pendiente=$this->db->query('SELECT CDCANTPEN from COTDET WHERE CDSECUEN="'.$key->DFITEMCOT.'" AND CDNUMDOC="'.$cotizacion.'"');
      if ($pendiente->row('CDCANTPEN')==0) {
        $this->db->set('CDESTADO',0);
        $this->db->where('CDSECUEN',$key->DFITEMCOT);
        $this->db->where('CDNUMDOC',$cotizacion);
        $this->db->update('COTDET');
      }
    }
    $starsoft->where('DFNUMPED',$pedido);
    $starsoft->delete('PEDDET');

    $this->db->where('DFNUMPED',$pedido);
    $this->db->delete('PEDDET');


      $this->db->set('CDESTADO',1);
      $this->db->set('CLOSED',F);
      $this->db->where('CDNUMDOC',$cotizacion);
      $this->db->update('COTCAB');

  }

  public function prueba(){
    var_dump($this->Mtransaccion->pruebafecha());
  }
  public function reporte_salidas_08(){
    $fechafin=$this->input->post('fecha_fin');
    $fechainicio=$this->input->post('fecha_inicio');
    $data['info'] = $this->Mtransaccion->reporte_salidas_08($fechainicio,$fechafin);
    $this->load->view('secciones/reportes/reporte_salidas_08',$data);
  }
  public function reporte_facturacion(){
    $fechafin=$this->input->post('fecha_fin');
    $fechainicio=$this->input->post('fecha_inicio');
    $data['info'] = $this->Mtransaccion->reporte_facturacion($fechainicio,$fechafin);
    $data['pedido'] = $this->Mtransaccion->reporte_facturacion_pedidos_referencia($fechainicio,$fechafin);
    $data['cotizacion'] = $this->Mtransaccion->reporte_facturacion_cotizacion_referencia($fechainicio,$fechafin);

    $this->load->view('secciones/reportes/reporte_facturacion',$data);
  }

  public function get_pedidos_pendientes(){
    $starsoft = $this->load->database('starsoft',TRUE);
    $data = $starsoft->query("SELECT CFNUMPED FROM [010BDCOMUN]..PEDCAB WHERE CFCOTIZA IN ('EMITIDO','PARCIAL')")->result();

    echo json_encode($data);
  }

  public function get_guias(){
    $starsoft = $this->load->database('starsoft',TRUE);
    $fecha_inicio=date("d-m-Y",strtotime(date('Y-m').'-01'.' - 7 days'));
    $data = $starsoft->query("SELECT CANUMDOC,CANROPED FROM [010BDCOMUN]..MOVALMCAB
      WHERE CATIPMOV='S' AND CACODMOV = 'GV'
      AND CAFECDOC >='".$fecha_inicio."' and CARUC NOT IN('20469962246','20535689394','20600670949') AND
      CANUMDOC NOT IN(SELECT GUIA FROM [010BDAPLICACION]..GUIAS_ENVIADAS)")->result();

    echo json_encode($data);
  }

  public function get_pedidos_detalle(){
    $fecha = $this->input->post('fecha');
    $data['detalle'] = $this->db->query("SELECT DFNUMPED,DFSECUEN,DFFECENT FROM PEDDET WHERE DFNUMPED IN (SELECT CFNUMPED FROM PEDCAB WHERE CFFECDOC like '".date('d-m-Y',strtotime($fecha))."') AND DFCODIGO NOT IN ('FLEINT','SEG','TEXTO') order by DFSECUEN asc")->result();

    $starsoft = $this->load->database('starsoft',TRUE);
    $data['detalle_ss'] = $starsoft->query("SELECT * FROM [010BDCOMUN]..PEDDET WHERE DFNUMPED IN (SELECT CFNUMPED FROM [010BDCOMUN]..PEDCAB WHERE CFFECDOC = '".date('d-m-Y',strtotime($fecha))."' AND CFCOTIZA IN('EMITIDO','PARCIAL')) AND DFCODIGO NOT IN ('FLEINT','SEG','TEXTO') AND DFSALDO > 0 order by DFSECUEN asc")->result();

    $this->load->view('secciones/proceso/programacion_entrega',$data);
  }

  public function get_guia_detalle(){
    $guia = $this->input->post('guia');
    $starsoft = $this->load->database('starsoft',TRUE);
    $data['detalle_ss'] = $starsoft->query("SELECT DEALMA,DECODIGO,DECANTID,DEDESCRI,DECENCOS,DEITEM FROM [010BDCOMUN]..MOVALMDET WHERE DENUMDOC LIKE '".$guia."' order by DEITEM asc")->result();
    $this->load->view('secciones/proceso/envio_guias',$data);
  }

  public function get_pedidosporatender(){
  $starsoft = $this->load->database('starsoft',TRUE);
  $fecha_fin=$this->input->post('fecha_fin');
  $fecha_inicio=$this->input->post('fecha_inicio');
  $data['detalle'] = $starsoft->query("SELECT * FROM
    (select DFNUMPED,DFSECUEN,DFCODIGO,DFDESCRI,DFFECENT_ALM,DFFECENT,DFTURNO,STR_TO_DATE(CFFECDOC,'%d-%m-%Y') AS FECHA from PEDDET d
    inner join PEDCAB c on cfnumped=dfnumped) AS T
    where T.FECHA between '".$fecha_inicio."' and '".$fecha_fin."'")->result();
  $data['detalle_ss'] = $starsoft->query("select DFNUMPED,DFSECUEN,CFFECDOC,DFCODIGO,DFDESCRI,DFCANTID,DFIMPUS,DFSALDO from PEDDET d
  inner join PEDCAB c on cfnumped=dfnumped
  where cfcotiza in ('EMITIDO','PARCIAL') AND DFSALDO > 0 and CFFECDOC between '".$fecha_inicio."' and '".$fecha_fin."'")->result();
      $this->load->view('secciones/reportes/atencion_pedidos',$data);
  }
}
