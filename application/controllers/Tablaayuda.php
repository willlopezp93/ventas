<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tablaayuda extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mtablaayuda');
  }

  function index()
  {

  }
  public function save_tiempo() {
  $plazo=$this->input->post('tiempo_entrega');
  $idtiempo=$this->input->post('idtiempo_entrega');

  $objeto = array('plazo' => $plazo
              );
if($idtiempo==''){
  if($this->Mtablaayuda->savetiempo($objeto)==1){
    echo 'Registrado exitosamente';
  }
  else{
    echo 'No se registro';
  }
}
else{
  if($this->Mtablaayuda->updatetiempo($objeto,$idtiempo)==1){
    echo 'Actualizado exitosamente';
  }
  else{
    echo 'No se actualizo ningun registro';
  }
}
  }
  public function eliminar_tiempo(){
  $id=$this->input->post('id');
  $eliminar=$this->Mtablaayuda->eliminar_tiempo($id);

  echo $eliminar;
}

  public function stock(){
    $almacen=$this->input->post('almacen');
    $data['stock']=$this->Mtablaayuda->stock($almacen);
    $this->load->view('secciones/almacenes/stock',$data);
  }

  public function contacto($cliente){
    $data['contacto']=$this->Mtablaayuda->contacto($cliente);
    $this->load->view('secciones/tabla-ayuda/contacto',$data);
  }

  public function direcciones($cliente){
    $data['direcciones']=$this->Mtablaayuda->direcciones($cliente);
    $this->load->view('secciones/tabla-ayuda/direcciones',$data);
  }

  public function clientes(){
    echo json_encode($this->Mtablaayuda->clientes());
  }
  public function contactos(){
    $contacto=$this->input->post('contacto');
    echo json_encode($this->Mtablaayuda->contacto($contacto));
  }
  public function direccion(){
    $contacto=$this->input->post('cliente');
    echo json_encode($this->Mtablaayuda->direcciones($contacto));
  }
  public function get_forma_pago(){
    $cliente=$this->input->post('cliente');
    echo json_encode($this->Mtablaayuda->forma_pago_cliente($cliente));
  }
  public function punto_venta(){
    echo json_encode($this->Mtablaayuda->punto_venta());
  }
  public function ptoventa_almacen(){
    $pto_venta=$this->input->post('pto_venta');
    echo ($this->Mtablaayuda->ptoventa_almacen($pto_venta));
  }
  public function descuento(){
      $contacto=$this->input->post('contacto');
    echo ($this->Mtablaayuda->descuento($contacto));
  }
  public function tipodecambio(){
    $fecha=$this->input->post('fecha');

    if ($fecha==1) {
      $date=date('d-m-Y');
    }else {
      $date=date('d-m-Y',strtotime($fecha));
    }
    echo ($this->Mtablaayuda->tipodecambio($date));
  }
  public function tiempo_entrega(){
    echo json_encode($this->Mtablaayuda->tiempo_entrega());
  }
  public function precio(){
        $codigo=$this->input->post('codigo');
    echo ($this->Mtablaayuda->precio($codigo));
  }
  public function vendedor_cliente(){
    $contacto=$this->input->post('contacto');
  echo ($this->Mtablaayuda->vendedor_cliente($contacto));
  }

  public function excel_precios(){
    $this->load->library('Excel');

          $this->excel->setActiveSheetIndex(0);
          $this->excel->getActiveSheet()->setTitle('despacho');

          $precios=$this->db->query('SELECT t0.articuloid,t0.precio_usd,t0.desc_maximo,t1.costo FROM precio_articulo t0 inner join costo_articulo t1 on t0.articuloid=t1.articuloid ')->result();
          //cabeceras
        $this->excel->getActiveSheet()->setCellValue('A2','Código');
          $this->excel->getActiveSheet()->setCellValue('B2','Costo');
          $this->excel->getActiveSheet()->setCellValue('C2','Precio');
          $this->excel->getActiveSheet()->setCellValue('D2','Descuento %');
          //cuerpo
          $fila=3;
          foreach ($precios as $key) {
            $this->excel->getActiveSheet()->setCellValue('A'.$fila,$key->articuloid);
            $this->excel->getActiveSheet()->setCellValue('B'.$fila,$key->costo);
            $this->excel->getActiveSheet()->setCellValue('C'.$fila,$key->precio_usd);
            $this->excel->getActiveSheet()->setCellValue('D'.$fila,$key->desc_maximo);
            $fila++;
          }
          $this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
          $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
          $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
          $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
        //Limpiar el búfer de salida y deshabilitar el almacenamiento en el mismo
        ob_end_clean();
        $filename='Lista de Precio.xls';
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
}
