<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('Mcorrelativo','Mguiasalida','Mtransaccion','Mtablaayuda','Mcorreo'));
    $this->load->library('pdf');

  }


  public function cotizacion($documento){
    $data['cabecera']=$this->Mtransaccion->get_cabecera_pdf($documento);
    $data['detalle']=$this->Mtransaccion->get_detalle($documento);

 $paper_size = array(0,0,0,0);
  $html_content= $this->load->view('pdf/cotizacion_newformat',$data,true);
  $this->pdf->set_paper($paper_size);
  $this->pdf->set_paper('a4','portrait');
ini_set("memory_limit","10000M");
   $this->pdf->loadHtml($html_content);
$this->pdf->render();
$font  =  $this->pdf->getFontMetrics()->getFont("Arial","negrita");
$this->pdf->getCanvas()->page_text(510,20,"Página: {PAGE_NUM} de {PAGE_COUNT}" ,$font,8,array(0,0,0));

$this->pdf->stream("COTIZACION.pdf", array("Attachment"=>0));
 }
 public function cotizacion_en($documento){
   $data['cabecera']=$this->Mtransaccion->get_cabecera_pdf($documento);
   $data['detalle']=$this->Mtransaccion->get_detalle($documento);

$paper_size = array(0,0,0,0);
 $html_content= $this->load->view('pdf/cotizacion_newformat_en',$data,true);
 $this->pdf->set_paper($paper_size);
 $this->pdf->set_paper('a4','portrait');
ini_set("memory_limit","10000M");
  $this->pdf->loadHtml($html_content);
$this->pdf->render();
$font  =  $this->pdf->getFontMetrics()->getFont("Arial","negrita");
$this->pdf->getCanvas()->page_text(510,20,"Página: {PAGE_NUM} de {PAGE_COUNT}" ,$font,8,array(0,0,0));

$this->pdf->stream("COTIZACION.pdf", array("Attachment"=>0));
}
public function correo_cotizacion($documento){
/*
  $data['cabecera']=$this->Mtransaccion->get_cabecera_pdf($documento);
  $data['detalle']=$this->Mtransaccion->get_detalle($documento);
  $html_content= $this->load->view('pdf/cotizacion_newformat',$data,true);
   $paper_size = array(0,0,0,0);
  $this->pdf->set_paper($paper_size);
  $this->pdf->set_paper('a4','portrait');
  ini_set("memory_limit","10000M");*/
	$file_name = 'COTIZACION.pdf';
	/*$this->pdf->load_html($html_content);
	$this->pdf->render();
  $font  =  $this->pdf->getFontMetrics()->getFont("Arial","negrita");
  $this->pdf->getCanvas()->page_text(510,20,"Página: {PAGE_NUM} de {PAGE_COUNT}" ,$font,8,array(0,0,0));
	$file = $this->pdf->output();
	file_put_contents($file_name, $file);*/

      $correo['destino']='william.lopezP93@gmail.com';
      $correo['remitente']='william.lopez@codrise.com';
      $correo['asunto']=$file_name;
  $this->Mcorreo->enviar_cotizacion($correo);
            //unlink('./'.$file_name);
            echo 'enviado';
    }

}
