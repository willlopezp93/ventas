<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mchart'));
  }

  function index()
  {

  }

  public function consulta_mes($año,$mes){
   $data['metasvsfacturado']=$this->Mchart->metasvsfacturado($año,$mes);
    $data['consolidadoanual']=$this->Mchart->consolidadoanual($año,$mes);
    $data['consolidadoanualrelacionada']=$this->Mchart->consolidadoanualrelacionada($año,$mes);
    $data['consolidadoanualtercero']=$this->Mchart->consolidadoanualtercero($año,$mes);
    $data['consolidadoxtipo']=$this->Mchart->consolidadoxtipo($año,$mes);

 $this->load->view('secciones/dashboard/dashboard_mes',$data);
  }

  public function consulta_trimestre($año,$mes){
    if ($mes=='T1') {
      $mes="1,2,3";
    }elseif ($mes=='T2') {
      $mes="4,5,6";
    }elseif ($mes=='T3') {
      $mes="7,8,9";
    }elseif ($mes=='T4') {
      $mes="10,11,12";
    }
   $data['metasvsfacturado']=$this->Mchart->metasvsfacturado_trimestre($año,$mes);
   $data['consolidadoanual']=$this->Mchart->consolidadoanual_acumulada($año,$mes);
    $data['consolidadoporaños']=($this->Mchart->consolidadoporaños($año,$mes));
    $data['metaanual']=$this->Mchart->metaanual($año,$mes);
    $data['ventaproyectadaanual']=$this->Mchart->ventaproyectadaanual($año,$mes);
    $data['ventaanualrelacionado']=($this->Mchart->ventaanualrelacionado($año,$mes));
    $data['ventaanualtercero']=($this->Mchart->ventaanualtercero($año,$mes));
    $data['comparativo_anual']=($this->Mchart->comparativo_anual($año,$mes));

    $data['año']=$año;
    $data['mes']=$mes;
    $starsoft=$this->load->database('starsoft',TRUE);
    $query=$starsoft->query("(select mes,index2 from  (select  DATENAME(mm,CFFECDOC) as 'mes',MONTH(cffecdoc) as 'index2'
    from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)=2012) as tablettt GROUP BY mes,index2) ORDER BY index2");
    $data['meses_delaño']=$query->result();

  //  $data['consolidadoanualtercero']=$this->Mchart->consolidadoanualtercero_trimestre($año,$mes);
  //  $data['consolidadoxtipo']=$this->Mchart->consolidadoxtipo_trimestre($año,$mes);
 $this->load->view('secciones/dashboard/dashboard_trimestre',$data);
  }

public function consulta_semanal($fechainicio,$fechafin,$tipo){
  $data['facturadoxsemana']=$this->Mchart->facturadoxsemana($fechainicio,$fechafin);
  $data['meta_anualxsemana']=$this->Mchart->meta_anualxsemana($fechainicio,$fechafin);
  $data['meta_clienterelacionadoxsemana']=$this->Mchart->meta_clienterelacionadoxsemana($fechainicio,$fechafin);
  $data['meta_clienteterceroxsemana']=$this->Mchart->meta_clienteterceroxsemana($fechainicio,$fechafin);
  $data['meta_empresarelacionadoxsemana']=$this->Mchart->meta_empresarelacionadoxsemana($fechainicio,$fechafin);
  $data['empresarelacionadoxsemana']=$this->Mchart->empresarelacionadoxsemana($fechainicio,$fechafin);
  $data['meta_tercerovendedorxsemana']=$this->Mchart->meta_tercerovendedorxsemana($fechainicio,$fechafin);
  $data['vendedorxsemana']=$this->Mchart->vendedorxsemana($fechainicio,$fechafin);
  $data['facturacion_suministro']=$this->Mchart->facturacion_suministro($fechainicio,$tipo);
  $data['tipo']=$tipo;
   $this->load->view('secciones/dashboard/dashboard_semanal',$data);
}
public function cotizaciones_pedidos($mes){
  $data['cotizaciones_pedidos']=$this->Mchart->cotizaciones_pedidos($mes);
  $data['cotizaciones_pedidos_relacionadas']=$this->Mchart->cotizaciones_pedidos_relacionadas($mes);
  $data['cotizaciones_pedidos_mercado_gavilan']=$this->Mchart->cotizaciones_pedidos_mercado_gavilan($mes);
  $data['cotizaciones_pedidos_mercado_nunez']=$this->Mchart->cotizaciones_pedidos_mercado_nunez($mes);
  $data['cotizaciones_pedidos_mercado_cds']=$this->Mchart->cotizaciones_pedidos_mercado_cds($mes);
  $this->load->view('secciones/reportes/cotizaciones_pedidos',$data);
}
public function cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo){
  $data['tipo']=$tipo;
  if ($tipo=='relacionado') {
    $data['cotizaciones_pedidos_semanal']=$this->Mchart->cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo,'00');
    $data['objetivopor']='90';
  }elseif ($tipo=='terceros') {
    $data['cotizaciones_pedidos_semanalgavilan']=$this->Mchart->cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo,'08');
    $data['cotizaciones_pedidos_semanalnunez']=$this->Mchart->cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo,'10');
    $data['cotizaciones_pedidos_semanalcds']=$this->Mchart->cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo,'07');
    $data['objetivopor']='55';
  }elseif ($tipo=='general') {
    $data['cotizaciones_pedidos_semanal']=$this->Mchart->cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo,'00');
    $data['objetivopor']='55';
  }
  $this->load->view('secciones/dashboard/cotizaciones_pedidos_semanal',$data);
}

public function cumplimiento_pedidos($mes){
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));


      $data['cumplimiento_pedidos']= $this->Mchart->cumplimiento_pedidos($month,$year);
$this->load->view('secciones/dashboard/cumplimiento_pedidos',$data);
}
public function reprogramacion($mes){
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));


      $data['reprogramacion']= $this->Mchart->reprogramacion($month,$year);
$this->load->view('secciones/dashboard/reprogramacion',$data);
}
public function cumplimiento_pedidos_detalle($mes,$condicion){
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));

      $data['condicion']=$condicion;
      $data['cumplimiento_pedidos']= $this->Mchart->cumplimiento_pedidos($month,$year);
$this->load->view('secciones/dashboard/cumplimiento_pedidos_detalle',$data);
}
public function reprogramacion_detalle($mes,$condicion){
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));

      $data['condicion']=$condicion;
      $data['reprogramacion']= $this->Mchart->reprogramacion($month,$year);
$this->load->view('secciones/dashboard/reprogramacion_detalle',$data);
}
}
