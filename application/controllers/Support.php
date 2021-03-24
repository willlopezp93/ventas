<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
      $this->load->model('Mtransaccion');$this->load->model('Msupport');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
        $pedido = "0016167";
        $cabecera = $this->db->query('SELECT * FROM PEDCAB WHERE CFNUMPED ="'.$pedido.'"');
        $info['cotizacion'] = $this->db->query('SELECT * FROM COTCAB WHERE CCNUMDOC="'.$cabecera->row('CFRFNUMDOC').'"')->row();
        //$info['fecha_entrega'] = $this->db->query('SELECT DFFECENT FROM PEDDET WHERE DFNUMPED ="'.$pedido.'" order by DFFECENT desc limit 1')->row('DFFECENT');
        $info['detalle'] = $this->db->query('SELECT * FROM PEDDET WHERE DFNUMPED ="0016167"')->result();
        $info['pedido'] = "0016167";
        //$mensaje = $this->load->view('correo/pedido',$info);
        $this->load->library("email");
        $config['protocol'] = 'smtp';
        $config["smtp_host"] = 'mail.rockdrillgroup.com';
        $config["smtp_user"] = 'ticket@rockdrillgroup.com';
        $config["smtp_pass"] = 'Rockketro753';
        $config["smtp_port"] = '587';
        $config['charset'] = 'UTF-8';
        $config['wordwrap'] = TRUE;
        $config['smtp_timeout'] = '25';
        $config['validate'] = true;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('jose.adrian@codrise.com');
        $this->email->to(',william.lopez@codrise.com,william.lopez@rockdrillgroup.com'); //Cambiar correo
        $this->email->subject('xd');
        $this->email->message('xd');
    //    $this->email->cc(''..'');
        $this->email->set_mailtype('html');

        if($this->email->send()){
          echo $pedido;
       }else{
         echo $this->email->print_debugger();
        }
  }
  public function carga(){
    $this->load->view('layout/header');
    $this->load->view('layout/menu');
    $this->load->view('test');
    $this->load->view('layout/footer');
  }
  public function fecha_post($a,$fecha){
    if (date('d-m',strtotime($fecha))=="31-12" or date('d-m',strtotime($fecha))=="30-04" or date('d-m',strtotime($fecha))=="28-06" or date('d-m',strtotime($fecha))=="27-07" or date('d-m',strtotime($fecha))=="29-08" or date('d-m',strtotime($fecha))=="07-10" or date('d-m',strtotime($fecha))=="31-10" or date('d-m',strtotime($fecha))=="07-12" or date('d-m',strtotime($fecha))=="24-12" or date('N',strtotime($fecha))==5) {
      if ($a>=3) {
        echo  $this->dia_entrega2($fecha,1).' '.date('H');
      } else {
        echo $fecha.' '.date('H');
      }
    } else {
      echo $fecha.' '.date('H');
    }


  }
  public function cargartemporal(){
    $this->load->library('Excel');
      if(isset($_FILES["excelfile"]["name"])){
        $path=$_FILES["excelfile"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);

        foreach ($object->getWorksheetIterator() as $Worksheet) {
          $highestrow=$Worksheet->getHighestRow();
          $highestColumn = $Worksheet->getHighestColumn();

          for($row=4 ; $row<=$highestrow; $row++){
            $articulo_codigo= trim($Worksheet->getCellByColumnAndRow(0,$row)->getValue(),' ');
            $costo=  trim($Worksheet->getCellByColumnAndRow(2,$row)->getValue(),' ');
            $precio=  trim($Worksheet->getCellByColumnAndRow(3,$row)->getValue(),' ');
            $descuento=  trim($Worksheet->getCellByColumnAndRow(4,$row)->getValue(),' ');
            if($articulo_codigo=='' or is_null($articulo_codigo) ){

            }
            else{
              $query=$this->db->query("select * from costo_articulo where articuloid like '".$articulo_codigo."'");
              if ($query->row()>0) {
                $costoupdate=array(
                                'costo'  =>$costo
                               );
                               $this->db->where('articuloid',$articulo_codigo);
                               $this->db->update('costo_articulo',$costoupdate);
              } else {
                $costoinsert= array('articuloid' =>$articulo_codigo ,
                                'costo'  =>$costo
                               );

                               $this->db->insert('costo_articulo',$costoinsert);
              }
              $query2=$this->db->query("select * from precio_articulo where  articuloid like '".$articulo_codigo."'");
              if ($query2->row()>0) {
                $precioupdate=array(
                                'precio_usd'  =>$precio,
                                'desc_maximo'=>$descuento*100
                               );

                               $this->db->where('articuloid',$articulo_codigo);
                               $this->db->update('precio_articulo',$precioupdate);
              }else {
                $precioinsert=array('articuloid' =>$articulo_codigo ,
                                'precio_usd'  =>$precio,
                                'desc_maximo'=>$descuento*100
                               );
                               $this->db->insert('precio_articulo',$precioinsert);
              }


            }

          }
        }

        echo "correcto";
      }
      else{
        echo 'Error al cargar excel';
      }
  }


  public function dia_entrega(){
    //Esta pequeña funcion me crea una fecha de entrega sin sabados ni domingos
    $fechaInicial = $this->input->post('fecha');
  //  date("Y-m-d"); obtenemos la fecha de hoy, solo para usar como referencia al usuario

    $MaxDias = $this->input->post('dias');
    $Segundos=0;
    //3; Cantidad de dias maximo para el prestamo, este sera util para crear el for
    //Creamos un for desde 0 hasta 3
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

        echo date('d-m-Y',strtotime($FechaFinal));
  }

  public function guardar_proyecto(){
        $this->load->model(array('Mtransaccion'));
    $proyecto=$this->input->post('proyecto');
    $actividades=json_decode($this->input->post('tbldetalle'));

    echo $this->Mtransaccion->crearproyecto($proyecto,$actividades);
  }


  public function gantt($gantt){
            $this->load->model(array('Mtransaccion'));
  //  $proyecto=$this->db->get('proyecto')->result();
    $actividades=$this->db->get('actividades')->result();

    $data='';
    $inicio='';
    $ejecucion='';
    $pruebas='';
    $produccion='';
    $cierre='';

    echo json_encode($actividades);

  }
  private function dia_entrega2($fechaInicial,$MaxDias){
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

  public function carga_masiva(){
    $starsoft=$this->load->database('starsoft',TRUE);

    $header=$starsoft->query("select* from cotcab where ccnumdoc='0016227'");

    foreach ($header->result() as $key) {
      $cabecera['CCNUMDOC']=substr($key->CCNUMDOC,-5);
      $cabecera['CCFECDOC']=date('Y-m-d H:i:s',strtotime($key->CCFECDOC));
      $cabecera['CCFECSYS']=date('Y-m-d H:i:s',strtotime($key->CCFECDOC));
      $cabecera['CCVENDE']=$key->CCVENDE;
      $cabecera['CCFORPAG']=$key->CCFORVEN;
      $cabecera['CCPUNVEN']=$key->CCPUNVEN;
      $cabecera['CCCODCLI']=$key->CCCODCLI;
      $cabecera['CCDIRECC']=$key->CCDIRECC;
      $cabecera['CCPORDESCL']=$key->CCPORDESCL;
      $cabecera['CCPORDESES']=$key->CCPORDESES;
      $cabecera['CCIMPORTE']=$key->CCIMPORTE;
      $cabecera['CCTIPCAM']=$key->CCTIPCAM;
      $cabecera['CCCODMON']=$key->CCCODMON;

      if ($key->CCFECDOC='VENTA01') {
        $cabecera['CCUSER']=80;
      }elseif ($key->CCFECDOC='70141852') {
        $cabecera['CCUSER']=78;
      }elseif ($key->CCFECDOC='47680316') {
        $cabecera['CCUSER']=79;
      }

      $cabecera['CCREF']=$key->CCGLOSA;
      $cabecera['CCDESVAL']=$key->CCDESVAL;
      $cabecera['CCIGV']=$key->CCIGV;
      $cabecera['CCTIPCOTIZA']='NAC';
      $cabecera['CCLUGENT']=$key->CCLUGENT;
      $cabecera['COD_CONTACTO']=$key->COD_CONTACTO;
      $cabecera['CCESTADO']=1;
      $cabecera['CLOSED']='F';
      $FechaFinal=$this->dia_entrega2($cabecera['CCFECDOC'],30);
      $cabecera['CCFECVEN']=date('Y-m-d H:i:s',strtotime($FechaFinal));

      $CCVENDE=$starsoft->query("select CVENDE from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
      $cabecera['CCVENDE']=$CCVENDE->row('CVENDE');
      $CDIRFISC=$starsoft->query("select cdircli from maecli where CCODCLI like '%".$cabecera['CCCODCLI']."'");
      $cabecera['CDIRFISC']=$CDIRFISC->row('cdircli');
      $CCRUC=$starsoft->query("select CNUMRUC from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
      $cabecera['CCRUC']=$CCRUC->row('CNUMRUC');
      $CCNOMBRE=$starsoft->query("select cnomcli from maecli where CCODCLI like '".$cabecera['CCCODCLI']."'");
      $cabecera['CCNOMBRE']=$CCNOMBRE->row('cnomcli');


    $this->db->insert('COTCAB',$cabecera);

    }
    $detail=$starsoft->query("select(select ccfecdoc from cotcab where ccnumdoc=cdnumdoc) as 'CDFECDOC' ,* from cotdet where cdnumdoc like '0016227'");
    foreach ($detail->result() as $key1) {

    $centrocosto=$this->centrocosto($key1->CDCODIGO);
    $rowdetalle=array('CDNUMDOC'=>$key1->CDNUMDOC,
                      'CDSECUEN'=>$key1->CDSECUEN,
                      'CDCODIGO'=>$key1->CDCODIGO,
                      'CDDESCRI'=>$key1->CDDESCRI,
                      'CDCANTID'=>$key1->CDCANTID,
                      'CDCANTPEN'=>$key1->CDCANTID,
                      'CDPREC_ORI'=>$key1->CDPREC_ORI,
                      'CDFECDOC'=>$key1->CDFECDOC,
                      'CDFECENT'=>$key1->CDFECDOC,
                      'CDPORDES'=>$key1->CDPORDES,
                      'CDDESCLI'=>$key1->CDDESCLI,
                      'CDDESESP'=>$key1->CDDESESP,
                      'CDIGVPOR'=>$key1->CDIGVPOR,
                      'CDIMPUS'=>$key1->CDIMPUS,
                      'CDIMPMN'=>$key1->CDIMPMN,
                      'CDALMA'=>$key1->CDALMA,
                      'CDESTADO'=>0,
                      'PLAZO'=>0,
                      'CCTIPTIME'=>1,
                      'CDUNIDAD'=>$key1->CDUNIDAD,
                      'DFCENCOS'=>$centrocosto,
                      //'CDTEXTO'=>$key->CDTEXTO
                    );
                    $precio1=$starsoft->query("select dbo.fn_NI_pre2('".$key1->CDCODIGO."','1') 'COST_ULT'");
                    if ($precio1->row('COST_ULT')==NULL or $precio1->row('COST_ULT')=='') {
                      $costo1=0;
                    }else {
                      $costo1=$precio1->row('COST_ULT');
                    }
                    $precio2=$starsoft->query("select dbo.fn_NI_pre2('".$key1->CDCODIGO."','2') 'COST_ULT'");
                    if ($precio2->row('COST_ULT')==NULL or $precio2->row('COST_ULT')=='') {
                      $costo2=0;
                    }else {
                      $costo2=$precio2->row('COST_ULT');
                    }
                    $precio3=$starsoft->query("select dbo.fn_NI_pre2('".$key1->CDCODIGO."','3') 'COST_ULT'");
                    if ($precio3->row('COST_ULT')==NULL or $precio3->row('COST_ULT')=='') {
                      $costo3=0;
                    }else {
                      $costo3=$precio3->row('COST_ULT');
                    }
                    $costo=$this->db->query("select costo from costo_articulo where articuloid='".$key1->CDCODIGO."'");
                    if ($costo->num_rows()>0) {
                      $COSTO_REF=$costo->row('costo');
                    }else {
                      $COSTO_REF=0;
                    }
                    $analisis=array('cotizacion'=>$key1->CDNUMDOC,
                                    'codigo'=>$key1->CDCODIGO,
                                    'descripcion'=>$key1->CDDESCRI,
                                    'costo1'=>$costo1,
                                    'costo2'=>$costo2,
                                    'costo3'=>$costo3,
                                    'costo_ref'=>$COSTO_REF,
                                    'precio_lista'=>$key1->CDPREC_ORI,
                                    'descuento'=>$key1->CDPORDES,
                                    'precio_neto'=>$key1->CDPREC_ORI*(1-$key1->CDPORDES/100)
                                  );

                                  print_r($rowdetalle);
                  $this->db->insert('COTDET', $rowdetalle);
                    $this->db->insert('analisis_precio', $analisis);
              }
  }

  private  function centrocosto($articulo){
    $this->db->select('centrocosto');
    $this->db->from('centrodecosto');
    $this->db->where('articuloid',$articulo);
    return $this->db->get()->row('centrocosto');
  }

  public function consultar_detalle_pendiente($pedido){
    $data['pedido']=$pedido;
    $data['detalle']=$this->Mtransaccion->get_pedido_det($pedido);
    $this->load->view('secciones/proceso/seguimiento',$data);
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
      $this->db->update('seguimiento_area',$data);
    } else {
      $this->db->insert('seguimiento_area',$data);
    }


    echo $this->db->affected_rows();
  }

public function actualizar_familia(){
    $starsoft=$this->load->database('starsoft',TRUE);
  $query=$this->db->query("select*from COTDET");

  foreach ($query->result() as $key) {
    $familia=$starsoft->query("SELECT AFAMILIA FROM MAEART WHERE ACODIGO='".$key->CDCODIGO."' ");
    $this->db->set('CDFAMILIA',$familia->row('AFAMILIA'));
    $this->db->where('CDSECUEN',$key->CDSECUEN);
    $this->db->where('CDCODIGO',$key->CDCODIGO);
    $this->db->update('COTDET');
  }
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
    	//$cabecera['CFFECENT_ALM']=$this->input->post('CFFECENT_ALM');
    	//$cabecera['CFTURNO']=$this->input->post('CFTURNO');
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

    $info=$this->Msupport->generar_orden($detalle,$cabecera,$igvpor,$TPDOLAR,$TPSOL,$cotizacion,$this->input->post('CFGLOSA'),$punto_venta);
    if (!$info) {
      echo "Intentar de nuevo";
    }else {
       echo $info;
    }
  }else {
    echo "ALERT";
  }

}

public function adjuntar_archivo($pedido,$fec_entrega,$turno){
  //$pedido = $this->input->post('pedido');
  $pedido = str_pad($pedido, 7, "0", STR_PAD_LEFT);
  $filename = $_FILES['file']['name'];
  $new_filename = str_replace(' ','_',$filename);
  $carpeta = "./assets/pedido/".$pedido."/";
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
    $config = [
      "upload_path" => $carpeta,
      'allowed_types' => "*"
    ];
    $this->load->library("upload",$config);

    if ($this->upload->do_upload('file')) {
      $imagen = '1';
    $msg = "Se subio exitosamente";
    }else{
      $imagen = '0';
      $msg=$this->upload->display_errors();
    }

    $detalle = $this->db->query('SELECT * FROM PEDDET WHERE DFNUMPED ="'.$pedido.'"')->result();
    $cabecera = $this->db->query('SELECT * FROM PEDCAB WHERE CFNUMPED ="'.$pedido.'"');
    $starsoft = $this->load->database('starsoft',TRUE);
    $email_vendedor = $starsoft->query("SELECT Ema_Ven FROM VENDEDOR WHERE Cod_Ven='".$cabecera->row('CFVENDE')."'")->row('Ema_Ven');
    $info['cotizacion'] = $this->db->query('SELECT * FROM COTCAB WHERE CCNUMDOC="'.$cabecera->row("CFRFNUMDOC").'"')->row();
    //$info['fecha_entrega'] = $this->db->query('SELECT DFFECENT FROM PEDDET WHERE DFNUMPED ="'.$pedido.'" order by DFFECENT desc limit 1')->row('DFFECENT');
    $compras = $this->db->query('SELECT * FROM PEDDET WHERE DFRESPONSABLE ="compras" AND DFNUMPED ="'.$pedido.'"')->result();
    $planeamiento = $this->db->query('SELECT * FROM PEDDET WHERE DFRESPONSABLE ="planeamiento" AND DFNUMPED ="'.$pedido.'"')->result();
    $stock_07 = $this->db->query('SELECT * FROM PEDDET WHERE DFRESPONSABLE ="stock_07" AND DFNUMPED ="'.$pedido.'"')->result();
    $asunto = $cabecera->row("CFNOMBRE").' | PD '.$cabecera->row("CFNUMPED").' | OC '.$cabecera->row("CFORDCOM").' | CT '.$cabecera->row("CFRFNUMDOC");
    $info['detalle']=$detalle;
    $info['compras']=$compras;
    $info['planeamiento']=$planeamiento;
    $info['fec_entrega']=$fec_entrega;
    $info['turno']=$turno;
    $info['INFO_DIR']=$this->input->post('INFO');
    $cc_planeamiento = "";
    $cc_compras = "";
    $info['pedido']=$pedido;

    $cc_planeamiento .= "juan.castillo@codrise.com,roland.reynaga@codrise.com";
    $correo_almacen ="wilder.garcia@codrise.com,martha.peralta@codrise.com,almacen01@codrise.com";
    if (count($compras)>0) {
      $cc_compras .= "milly.castro@codrise.com,silvana.veliz@codrise.com";
    }
    $cc_ventas="christian.proano@codrise.com,ayrton.kriete@codrise.com,karen.peralta@codrise.com,herzon.bustamante@codrise.com,fernando.nunez@codrise.com";
    $mensaje = $this->load->view('correo/pedido',$info,TRUE);

    $this->load->library("email");
    $config['protocol'] = 'smtp';
    $config["smtp_host"] = 'mail.rockdrillgroup.com';
    $config["smtp_user"] = 'ticket@rockdrillgroup.com';
    $config["smtp_pass"] = 'Rockketro753';
    $config["smtp_port"] = '587';
    $config['charset'] = 'UTF-8';
    $config['wordwrap'] = TRUE;
    $config['smtp_timeout'] = '25';
    $config['validate'] = true;
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from(''.$this->session->user_correo.'');
    $this->email->to(''.$correo_almacen.''); //Cambiar correo
    $this->email->cc(''..'');
    $this->email->subject(''.$asunto.'');
    $this->email->message($mensaje);
    $this->email->cc(''.$cc_ventas.','.$cc_planeamiento.','.$cc_compras.','.$email_vendedor.'');
    $this->email->set_mailtype('html');

    if ($imagen==1) {
      $this->email->attach("./assets/pedido/".$pedido."/".$new_filename."");
    }
    if($this->email->send()){
      if ($imagen==1) {
          unlink("./assets/pedido/".$pedido."/".$new_filename."");
      }
      echo $pedido;
   }else{
     echo $this->email->print_debugger();
    }
}
public function adjuntar_guia(){
  $guia = $this->input->post('guias');
  $pedido = $this->input->post('pedido');
  $pedido = str_pad($pedido, 7, "0", STR_PAD_LEFT);
  $filename = $_FILES['file']['name'];
  $new_filename = str_replace(' ','_',$filename);
  $carpeta = "./assets/guia/".$guia."/";
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
    $config = [
      "upload_path" => $carpeta,
      'allowed_types' => "*"
    ];
    $this->load->library("upload",$config);

    if ($this->upload->do_upload('file')) {
      $imagen = '1';
    $msg = "Se subio exitosamente";
    }else{
      $imagen = '0';
      $msg=$this->upload->display_errors();
    }

    $cabecera = $this->db->query('SELECT * FROM PEDCAB WHERE CFNUMPED ="'.$pedido.'"');
    $asunto = $cabecera->row("CFNOMBRE").' | PD '.$cabecera->row("CFNUMPED").' | OC '.$cabecera->row("CFORDCOM").' | CT '.$cabecera->row("CFRFNUMDOC");
    $info['guia']=$guia;
    $info['pedido']=$pedido;
    $mensaje = $this->load->view('correo/guia',$info,TRUE);
    $email_vendedor = $starsoft->query("SELECT Ema_Ven FROM VENDEDOR WHERE Cod_Ven='".$cabecera->row('CFVENDE')."'")->row('Ema_Ven');
    $cc_ventas="christian.proano@codrise.com,ayrton.kriete@codrise.com,karen.peralta@codrise.com,herzon.bustamante@codrise.com,fernando.nunez@codrise.com";

    $this->load->library("email");
    $config['protocol'] = 'smtp';
    $config["smtp_host"] = 'mail.rockdrillgroup.com';
    $config["smtp_user"] = 'ticket@rockdrillgroup.com';
    $config["smtp_pass"] = 'Rockketro753';
    $config["smtp_port"] = '587';
    $config['charset'] = 'UTF-8';
    $config['wordwrap'] = TRUE;
    $config['smtp_timeout'] = '25';
    $config['validate'] = true;
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from(''.$this->session->user_correo.'');
    $this->email->to(''.$cc_ventas.','.$email_vendedor); //Cambiar correo
    $this->email->subject(''.$asunto.'');
    $this->email->message($mensaje);
//    $this->email->cc(''..'');
    $this->email->set_mailtype('html');

    if ($imagen==1) {
      $this->email->attach("./assets/guia/".$guia."/".$new_filename."");
    }
    if($this->email->send()){
      unlink("./assets/guia/".$guia."/".$new_filename."");
      $starsoft = $this->load->database('starsoft',TRUE);
      $data_guia = array('GUIA' => $guia,
                    'FECHA' => date('d-m-Y'));
      $starsoft->insert('[010BDAPLICACION]..GUIAS_ENVIADAS', $data_guia);
      echo $guia;
   }else{
     echo $this->email->print_debugger();
    }
}
public function actualizar_programacion_entrega($tipo){
    $detalle = json_decode($this->input->post('detalle'));

    foreach ($detalle as $key) {
      if ($key->DFSALDO>0) {
        $this->db->where('DFNUMPED', $key->DFNUMPED);
        $this->db->where('DFSECUEN', $key->DFSECUEN);
        $this->db->set('DFFECENT_ALM', date('Y-m-d H:i:s',strtotime($key->DFFECENT)));
        $this->db->set('DFTURNO', $key->DFTURNO);
        $this->db->update('PEDDET');
      }
    }

    if ($tipo==1) {
      $data['detalle'] = $detalle;
      $mensaje = $this->load->view('correo/programacion_entrega',$data,TRUE);
      $email_vendedor = $starsoft->query("SELECT Ema_Ven FROM VENDEDOR WHERE Cod_Ven in ('08','09','11')")->row('Ema_Ven');

      $cc_ventas="christian.proano@codrise.com,ayrton.kriete@codrise.com,karen.peralta@codrise.com,herzon.bustamante@codrise.com,fernando.nunez@codrise.com";

      $this->load->library("email");
      $config['protocol'] = 'smtp';
      $config["smtp_host"] = 'mail.rockdrillgroup.com';/*
      $config["smtp_user"] = 'aplicaciones.rovheco@gmail.com';
      $config["smtp_pass"] = 'local258';*/
      $config["smtp_user"] = 'ticket@rockdrillgroup.com';
      $config["smtp_pass"] = 'Rockketro753';
      $config["smtp_port"] = '587';
      $config['charset'] = 'UTF-8';
      $config['wordwrap'] = TRUE;
      $config['smtp_timeout'] = '25';
      $config['validate'] = true;
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from(''.$this->session->user_correo.'');
      $this->email->to(''.$cc_ventas.','.$email_vendedor.''); //Cambiar correo
      $this->email->subject('PROGRAMACIÓN DE ENTREGA DE PEDIDOS');
      $this->email->message($mensaje);
  //    $this->email->cc(''..'');
      $this->email->set_mailtype('html');

      if($this->email->send()){
        echo 1;
     }else{
       echo $this->email->print_debugger();
      }
    }else {
      echo 1;
    }
}
  public function apitest(){

    $this->load->view('apitest');
  }
}
