<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargaexcel extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mcargaexcel','Mtablaayuda'));
    $this->load->library('Excel');
  }

  function index()
  {

  }
public function listar(){
  $query=$this->db->query("select*, 0 as 'stock' from carga_excel where usuario=".$this->session->userdata('user_id')." order by item asc");
  $temporal=$query->result();
  echo json_encode($temporal);
}
/*
  public function cargartemporal(){
      if(isset($_FILES["excelfile"]["name"])){
        $path=$_FILES["excelfile"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);

        foreach ($object->getWorksheetIterator() as $Worksheet) {
          $highestrow=$Worksheet->getHighestRow();
          $highestColumn = $Worksheet->getHighestColumn();
            $item=1;
            $contador=0;
          for($row=2 ; $row<=$highestrow; $row++){
            $codigo= trim($Worksheet->getCellByColumnAndRow(0,$row)->getValue(),' ');

                $starsoft=$this->load->database('starsoft',TRUE);
                $query=$starsoft->query("SELECT AUNIDAD,ADESCRI from MAEART WHERE ACODIGO='".$codigo."'");
                $descripcion=$query->row('ADESCRI');
                $unidad=$query->row('AUNIDAD');
                $cantidad=  trim($Worksheet->getCellByColumnAndRow(1,$row)->getValue(),' ');
                $query2=$this->db->query("SELECT * FROM precio_articulo where articuloid='".$codigo."'");
                $precio=  $query2->row('precio_usd');
                $descuento=  0;
                $dias=  trim($Worksheet->getCellByColumnAndRow(2,$row)->getValue(),' ');
            $tiempo=  1;
            $stock=0;
            if($codigo=='' or is_null($codigo) ){

            }
            else{
              $query2=$starsoft->query("SELECT * from MAEART WHERE ACODIGO='".$codigo."' and aestado='v'");
              if ($query2->num_rows()<1) {
                $contador++;
              }
              if ($contador==0) {
                $data= array( 'item'=>$item,
                              'codigo'=>$codigo ,
                              'unidad'=>$unidad,
                                'cantidad'=>$cantidad,
                                'precio'=>$precio,
                                'descripcion'=>$descripcion,
                                'descuento'=>$descuento/100,
                                'tiempo'=>$tiempo,
                                'dias'=>$dias,
                                'stock'=>$stock
                               );
              $this->Mcargaexcel->insertar_temporal($data);
              }


            $item++;
          }
    }

        }
        if ($contador>0) {
          echo $contador."<br><p style='font-style:italic;color:#757575;font-size: 16pt'> Códigos Inexistentes, revise el archivo excel</p>";
        } else {
          $carga=$this->Mcargaexcel->listarcarga();
          $usuario=$this->session->userdata('user_id');
          $data['filas']=$carga;

            //$this->db->query('DELETE FROM carga_excel WHERE usuario='.$usuario.'');
          //  echo $contador;
          $this->load->view('secciones/proceso/carga_excel',$data);
        }
      }
      else{
        echo 'Error al cargar el excel';
      }
  }*/
  public function cargartemporal(){
    if(isset($_FILES["excelfile"]["name"])){
      $path=$_FILES["excelfile"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);

      foreach ($object->getWorksheetIterator() as $Worksheet) {
        $highestrow=$Worksheet->getHighestRow();
        $highestColumn = $Worksheet->getHighestColumn();
          $item=1;
          $contador=0;
        for($row=2 ; $row<=$highestrow; $row++){
          $codigo= trim($Worksheet->getCellByColumnAndRow(0,$row)->getValue(),' ');

          $starsoft=$this->load->database('starsoft',TRUE);
          $query=$starsoft->query("SELECT AUNIDAD,ADESCRI from MAEART WHERE ACODIGO='".$codigo."'");
          $descripcion=str_replace("  ", " ", trim($Worksheet->getCellByColumnAndRow(1,$row)->getValue(),' '));
          $unidad=$query->row('AUNIDAD');
          $cantidad=  trim($Worksheet->getCellByColumnAndRow(2,$row)->getValue(),' ');
        //  $query2=$this->db->query("SELECT * FROM precio_articulo where articuloid='".$codigo."'");
          $precio=  trim($Worksheet->getCellByColumnAndRow(3,$row)->getValue(),' ');
          $descuento= trim($Worksheet->getCellByColumnAndRow(4,$row)->getValue(),' ');
          $dias=  trim($Worksheet->getCellByColumnAndRow(5,$row)->getValue(),' ');
          $tiempo=  1;
          $stock=0;
          if($codigo=='' or is_null($codigo) ){

          }
          else{
            $query2=$starsoft->query("SELECT * from MAEART WHERE ACODIGO='".$codigo."' and aestado='v'");
            if ($query2->num_rows()<1) {
              $contador++;
            }
            if ($contador==0) {
              $data= array( 'item'=>$item,
                            'codigo'=>$codigo ,
                            'unidad'=>$unidad,
                              'cantidad'=>$cantidad,
                              'precio'=>$precio,
                              'descripcion'=>$descripcion,
                              'descuento'=>$descuento/100,
                              'tiempo'=>$tiempo,
                              'dias'=>$dias,
                              'stock'=>$stock
                             );
            $this->Mcargaexcel->insertar_temporal($data);
            }


          $item++;
        }
  }

      }
      if ($contador>0) {
        echo $contador."<br><p style='font-style:italic;color:#757575;font-size: 16pt'> Códigos Inexistentes, revise el archivo excel</p>";
      } else {
        $carga=$this->Mcargaexcel->listarcarga();
        $usuario=$this->session->userdata('user_id');
        $data['filas']=$carga;

          //$this->db->query('DELETE FROM carga_excel WHERE usuario='.$usuario.'');
        //  echo $contador;
        $this->load->view('secciones/proceso/carga_excel',$data);
      }
    }
    else{
      echo 'Error al cargar el excel';
    }
}
public function agregar_fila(){
  $query=$this->db->query("SELECT item FROM carga_excel WHERE usuario=".$this->session->userdata('user_id')." order by item desc limit 1 ");

  $item=$query->row('item');
  $codigo=$this->input->post('codigo');
  $descripcion=$this->input->post('descripcion');
  $unidad=$this->input->post('unidad');
  $cantidad= 1;
  $precio= $this->input->post('precio');
  $descuento= $this->input->post('descuento');
  $dias=0;
  $tiempo= 1;
  $stock= $this->input->post('stock');

  $fila= array( 'item'=>$item+1,
                'codigo'=>$codigo ,
                'unidad'=>$unidad,
                  'cantidad'=>$cantidad,
                  'precio'=>$precio,
                  'descripcion'=>$descripcion,
                  'descuento'=>$descuento,
                  'tiempo'=>$tiempo,
                  'dias'=>$dias,
                  'stock'=>$stock
                 );
$this->Mcargaexcel->insertar_temporal($fila);
$carga=$this->Mcargaexcel->listarcarga();
$data['filas']=$carga;
$this->load->view('secciones/proceso/carga_excel',$data);
}



  public function eliminarfila(){
    $item=$this->input->post('item');
    $codigo=$this->input->post('codigo');
    $this->db->where('item',$item);
    $this->db->where('codigo',$codigo);
          $this->db->where('usuario',$this->session->userdata('user_id'));
    $this->db->delete('carga_excel');
    $data['filas']=$this->Mcargaexcel->listarcarga();
    $this->load->view('secciones/proceso/carga_excel',$data);
  }

  public function duplicarfila(){
    $item=$this->input->post('item');
    $codigo=$this->input->post('codigo');
    $descripcion=$this->input->post('descripcion');
    $unidad=$this->input->post('unidad');
    $cantidad= $this->input->post('cantidad');
    $precio= $this->input->post('precio');
    $descuento= $this->input->post('descuento');
    $dias=$this->input->post('dias');
    $tiempo=$this->input->post('tiempo');
    $stock=$this->input->post('stock');

    $query=$this->db->query("SELECT item,codigo FROM carga_excel where item>".$item." and usuario=".$this->session->userdata('user_id')."");
    $temporal=$query->result();
    foreach ($temporal as $key) {
      $this->db->set('item','item+1',FALSE);
      $this->db->where('item',$key->item);
      $this->db->where('codigo',$key->codigo);
      $this->db->where('usuario',$this->session->userdata('user_id'));
      $this->db->update('carga_excel');
    }
    $carga= array( 'item'=>$item+1,
                  'codigo'=>$codigo ,
                  'unidad'=>$unidad,
                    'cantidad'=>$cantidad,
                    'precio'=>$precio,
                    'descripcion'=>$descripcion,
                    'descuento'=>$descuento,
                    'tiempo'=>$tiempo,
                    'dias'=>$dias,
                    'stock'=>$stock
                   );
                   $this->Mcargaexcel->insertar_temporal($carga);

    $data['filas']=$this->Mcargaexcel->listarcarga();

    $this->load->view('secciones/proceso/carga_excel',$data);
  }

/*
  public function carga_temporal_consumo(){
    $data= array('CODIGO' =>$this->input->post('codigo') ,
                    'SERIE'  =>$this->input->post('serie'),
                    'CANTIDAD'=>$this->input->post('cantidad'),
                    'MAQUINA'=>$this->input->post('maquina'),
                    'DOC_REF'=>$this->input->post('doc_ref'),
                    'idsolicitante'=>$this->input->post('solicitante'),
                    'area'=>$this->input->post('areacencos')
                   );
    $this->Mcargaexcel->insertar_temporal($data);
    $seriedoc=$this->input->post('seriedoc');
    $data['carga']=$this->Mcargaexcel->consumo_listar_temporal2($seriedoc);
    $this->load->view('secciones/consumo/grid_consumo', $data);
  }

  public function listar_consumo(){
    $seriedoc=$this->input->post('seriedoc');
    $data['carga']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/consumo/grid_consumo', $data);

  }
  public function eliminar_consumo(){
    $id=$this->input->post('id');
    $seriedoc=$this->input->post('seriedoc');
    $this->Mcargaexcel->eliminar($id);
    $data['carga']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);
  }
*/
}
