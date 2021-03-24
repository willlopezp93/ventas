<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mchart extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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

public function metasvsfacturado($año,$mes){
  $data=$this->data($año,$mes);
  $facturado_relacionado=0;
  $facturado_tercero=0;
  foreach ($data as $key) {
    if ($key->TIPO_CLIENTE=='RELACIONADA') {
      if ($key->CFCODMON=='ME') {
        $facturado_relacionado=$facturado_relacionado+$key->MONTO_VENTA;
      }elseif ($key->CFCODMON=='MN') {
        $facturado_relacionado=$facturado_relacionado+($key->MONTO_VENTA/$key->CFTIPCAM);
      }
    }
    if ($key->TIPO_CLIENTE=='TERCERO') {
      if ($key->CFCODMON=='ME') {
        $facturado_tercero=$facturado_tercero+$key->MONTO_VENTA;
      }elseif ($key->CFCODMON=='MN') {
        $facturado_tercero=$facturado_tercero+($key->MONTO_VENTA/$key->CFTIPCAM);
      }
    }
  }
    $fechainicio=date('Y-m-d',strtotime($año.'-'.$mes));
    $fechafin=date("Y-m-d",strtotime(date("Y-m-d",strtotime($año.'-'.$mes.' + 1 month')).'- 1 days'));

    $year=date('Y',strtotime($fechainicio));
    $diasferiados =  [ $year.'-01-01',$year.'-05-01',$year.'-06-29',$year.'-07-28',$year.'-07-29',$year.'-08-30',$year.'-10-08',$year.'-11-01',$year.'-12-08',$year.'-12-25' ];


  $info['facturado_relacionado']=($facturado_relacionado);
  $info['facturado_tercero']=$facturado_tercero;

  $query2=$this->db->query("SELECT * FROM meta_venta where año=".$año." and mes=".$mes);
  $info['diashabiles']=count($this->getDiasHabiles($fechainicio, $fechafin,$diasferiados))+$query2->row('dias_extraodinarios');
  $info['diasacumulados']=count($this->getDiasHabiles($fechainicio, date('Y-m-d'),$diasferiados))+$query2->row('dias_extraodinarios');
  $info['meta_relacionado']=($query2->row('meta_relacionada'));
  $info['meta_tercero']=($query2->row('meta_tercero'));

  return $info;
}

public function consolidadoanual($año,$mes){
  $query1=$this->db->query("SELECT * FROM meta_venta where año=".$año);
  $info=array();
  $starsoft=$this->load->database('starsoft',TRUE);
  $query2=$starsoft->query("select index1,mes, sum(monto_venta) as 'monto_venta' from
                            (select DATENAME(mm,CFFECDOC) as 'mes', MONTH(cffecdoc) as 'index1',
                            'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                            from faccab where  YEAR(CFFECDOC)=".$año."AND MONTH(CFFECDOC)<=".$mes.") as tablettt GROUP BY mes,index1 order by index1");
     foreach ($query2->result() as $key) {
        $data['mes']=$key->mes;
        $data['real']=$key->monto_venta;
        $query1=$this->db->query("SELECT meta_relacionada+meta_tercero as 'meta' FROM meta_venta where año=".$año." and mes=".$key->index1);
        $data['meta']=$query1->row('meta');

        $info[]=$data;
      }
    return $info;
  }

  public function consolidadoanualrelacionada($año,$mes){
    $query1=$this->db->query("SELECT * FROM meta_venta where año=".$año);
    $info=array();
    $starsoft=$this->load->database('starsoft',TRUE);
    $query2=$starsoft->query("select index1,mes, sum(monto_venta) as 'monto_venta' from
                              (select DATENAME(mm,CFFECDOC) as 'mes', MONTH(cffecdoc) as 'index1',
                              'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                              'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                              from faccab where  YEAR(CFFECDOC)=".$año."AND MONTH(CFFECDOC)<=".$mes.") as tablettt where TIPO_CLIENTE='RELACIONADA' GROUP BY mes,index1 order by index1");
       foreach ($query2->result() as $key) {
          $data['mes']=$key->mes;
          $data['real']=$key->monto_venta;
          $query1=$this->db->query("SELECT meta_relacionada as 'meta' FROM meta_venta where año=".$año." and mes=".$key->index1);
          $data['meta']=$query1->row('meta');

          $info[]=$data;
        }
      return $info;
    }

    public function consolidadoanualtercero($año,$mes){

      $info=array();
      $starsoft=$this->load->database('starsoft',TRUE);
      $query2=$starsoft->query("select index1,mes, sum(monto_venta) as 'monto_venta' from
                                (select DATENAME(mm,CFFECDOC) as 'mes', MONTH(cffecdoc) as 'index1',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab where  YEAR(CFFECDOC)=".$año."AND MONTH(CFFECDOC)<=".$mes.") as tablettt where TIPO_CLIENTE='TERCERO' GROUP BY mes,index1 order by index1,monto_venta");
         foreach ($query2->result() as $key) {
            $data['mes']=$key->mes;
            $data['real']=$key->monto_venta;
            $query1=$this->db->query("SELECT meta_tercero as 'meta' FROM meta_venta where año=".$año." and mes=".$key->index1);
            $data['meta']=$query1->row('meta');

            $info[]=$data;
          }
        return $info;
      }

      public function consolidadoxtipo($año,$mes){

        $info=array();
        $starsoft=$this->load->database('starsoft',TRUE);
        $query2=$starsoft->query("SELECT mes, sum(monto_venta) as 'monto_venta',CFNOMBRE,TIPO_CLIENTE,vendedor from (select DATENAME(mm,CFFECDOC) as 'mes', MONTH(cffecdoc) as 'index1', 'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,CFNOMBRE
                ,'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
              'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END from faccab where YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)=".$mes.")
              as tablettt GROUP BY mes,CFNOMBRE,TIPO_CLIENTE,vendedor order by  monto_venta desc");

           foreach ($query2->result() as $key) {
             $data['TIPO_CLIENTE']=$key->TIPO_CLIENTE;
             $data['CFNOMBRE']=$key->CFNOMBRE;
             $data['vendedor']=$key->vendedor;
              $data['mes']=$key->mes;
              $data['real']=$key->monto_venta;
              $info[]=$data;
            }
          return $info;
        }

private function data($año,$mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT cftd,CFNUMSER,CFNUMDOC,'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
CFIMPORTE,CFTIPCAM,CFCODMON,CFIGV,'MONTO_VENTA'=CFIMPORTE-CFIGV,'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI)
from faccab where cfestado like 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)=".$mes);

return $query->result();
}



public function metasvsfacturado_trimestre($año,$mes){
  $data=$this->data2($año,$mes);
  $facturado_relacionado1=0;
  $facturado_tercero1=0;
  $facturado_relacionado2=0;
  $facturado_tercero2=0;
  $facturado_relacionado3=0;
  $facturado_tercero3=0;
  $facturado_relacionado4=0;
  $facturado_tercero4=0;
  $meta_relacionado1=0;
  $meta_tercero1=0;
  $meta_relacionado2=0;
  $meta_tercero2=0;
  $meta_relacionado3=0;
  $meta_tercero3=0;
  $meta_relacionado4=0;
  $meta_tercero4=0;
  foreach ($data as $key) {

    if ($key->MES==1 or $key->MES==2 or $key->MES==3) {
      if ($key->TIPO_CLIENTE=='RELACIONADA') {
        if ($key->CFCODMON=='ME') {
          $facturado_relacionado1=$facturado_relacionado1+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_relacionado1=$facturado_relacionado1+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
      if ($key->TIPO_CLIENTE=='TERCERO') {
        if ($key->CFCODMON=='ME') {
          $facturado_tercero1=$facturado_tercero1+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_tercero1=$facturado_tercero1+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
    }

    if ($key->MES==4 or $key->MES==5 or $key->MES==6) {
      if ($key->TIPO_CLIENTE=='RELACIONADA') {
        if ($key->CFCODMON=='ME') {
          $facturado_relacionado2=$facturado_relacionado2+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_relacionado2=$facturado_relacionado2+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
      if ($key->TIPO_CLIENTE=='TERCERO') {
        if ($key->CFCODMON=='ME') {
          $facturado_tercero2=$facturado_tercero2+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_tercero2=$facturado_tercero2+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
    }

    if ($key->MES==7 or $key->MES==8 or $key->MES==9) {
      if ($key->TIPO_CLIENTE=='RELACIONADA') {
        if ($key->CFCODMON=='ME') {
          $facturado_relacionado3=$facturado_relacionado3+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_relacionado3=$facturado_relacionado3+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
      if ($key->TIPO_CLIENTE=='TERCERO') {
        if ($key->CFCODMON=='ME') {
          $facturado_tercero3=$facturado_tercero3+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_tercero3=$facturado_tercero3+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
    }

    if ($key->MES==10 or $key->MES==11 or $key->MES==12) {
      if ($key->TIPO_CLIENTE=='RELACIONADA') {
        if ($key->CFCODMON=='ME') {
          $facturado_relacionado4=$facturado_relacionado4+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_relacionado4=$facturado_relacionado4+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
      if ($key->TIPO_CLIENTE=='TERCERO') {
        if ($key->CFCODMON=='ME') {
          $facturado_tercero4=$facturado_tercero4+$key->MONTO_VENTA;
        }elseif ($key->CFCODMON=='MN') {
          $facturado_tercero4=$facturado_tercero4+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
    }
  }

  $query2=$this->db->query("SELECT * FROM meta_venta where año=".$año);

  foreach ($query2->result() as $key2) {
    if ($key2->mes==1 or $key2->mes==2 or $key2->mes==3) {
      $meta_relacionado1=$meta_relacionado1+$key2->meta_relacionada;
      $meta_tercero1=$meta_tercero1+$key2->meta_tercero;
    }
    if ($key2->mes==4 or $key2->mes==5 or $key2->mes==6) {
      $meta_relacionado2=$meta_relacionado2+$key2->meta_relacionada;
      $meta_tercero2=$meta_tercero2+$key2->meta_tercero;
    }
    if ($key2->mes==7 or $key2->mes==8 or $key2->mes==9) {
      $meta_relacionado3=$meta_relacionado3+$key2->meta_relacionada;
      $meta_tercero3=$meta_tercero3+$key2->meta_tercero;
    }
    if ($key2->mes==10 or $key2->mes==11 or $key2->mes==12) {
      $meta_relacionado4=$meta_relacionado4+$key2->meta_relacionada;
      $meta_tercero4=$meta_tercero4+$key2->meta_tercero;
    }
  }
  $info['meta_relacionado1']=str_replace(',','',number_format($meta_relacionado1));
  $info['meta_tercero1']=str_replace(',','',number_format($meta_tercero1));
  $info['meta_relacionado2']=str_replace(',','',number_format($meta_relacionado2));
  $info['meta_tercero2']=str_replace(',','',number_format($meta_tercero2));
  $info['meta_relacionado3']=str_replace(',','',number_format($meta_relacionado3));
  $info['meta_tercero3']=str_replace(',','',number_format($meta_tercero3));
  $info['meta_relacionado4']=str_replace(',','',number_format($meta_relacionado4));
  $info['meta_tercero4']=str_replace(',','',number_format($meta_tercero4));
  $info['facturado_relacionado1']=str_replace(',','',number_format($facturado_relacionado1));
  $info['facturado_tercero1']=str_replace(',','',number_format($facturado_tercero1));
  $info['facturado_relacionado2']=str_replace(',','',number_format($facturado_relacionado2));
  $info['facturado_tercero2']=str_replace(',','',number_format($facturado_tercero2));
  $info['facturado_relacionado3']=str_replace(',','',number_format($facturado_relacionado3));
  $info['facturado_tercero3']=str_replace(',','',number_format($facturado_tercero3));
  $info['facturado_relacionado4']=str_replace(',','',number_format($facturado_relacionado4));
  $info['facturado_tercero4']=str_replace(',','',number_format($facturado_tercero4));

  return $info;
}
public function consolidadoanual_acumulada($año,$mes){
  $data=$this->data2($año,$mes);
  $starsoft=$this->load->database('starsoft',TRUE);
  /*$query=$starsoft->query("SELECT cftd,CFNUMSER,CFNUMDOC,'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
  CFIMPORTE,CFTIPCAM,CFCODMON,CFIGV,'MONTO_VENTA'=CFIMPORTE-CFIGV,'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI)
  from faccab where cfestado like 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)<".$mes);
  $transcurrido=$query->result();*/
  $acumulada_relacionada=0;
  $acumulada_tercero=0;
  $transcurrido_relacionada=0;
  $transcurrido_tercero=0;
  $meta_relacionada=0;
  $meta_tercero=0;
  $meta_relacionadotrans=0;
  $meta_tercerotrans=0;
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
  foreach ($data as $key) {
    if ($key->MES<$mes) {
      if ($key->TIPO_CLIENTE=='RELACIONADA') {
        if ($key->CFCODMON=='ME') {
          $transcurrido_relacionada=$transcurrido_relacionada+($key->MONTO_VENTA);
        }elseif ($key->CFCODMON=='MN') {
          $transcurrido_relacionada=$transcurrido_relacionada+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
      if ($key->TIPO_CLIENTE=='TERCERO') {
        if ($key->CFCODMON=='ME') {
          $transcurrido_tercero=$transcurrido_tercero+($key->MONTO_VENTA);
        }elseif ($key->CFCODMON=='MN') {
          $transcurrido_tercero=$transcurrido_tercero+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
    }
    if ($key->MES<=$mes) {
      if ($key->TIPO_CLIENTE=='RELACIONADA') {
        if ($key->CFCODMON=='ME') {
          $acumulada_relacionada=$acumulada_relacionada+($key->MONTO_VENTA);
        }elseif ($key->CFCODMON=='MN') {
          $acumulada_relacionada=$acumulada_relacionada+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
      if ($key->TIPO_CLIENTE=='TERCERO') {
        if ($key->CFCODMON=='ME') {
          $acumulada_tercero=$acumulada_tercero+($key->MONTO_VENTA);
        }elseif ($key->CFCODMON=='MN') {
          $acumulada_tercero=$acumulada_tercero+($key->MONTO_VENTA/$key->CFTIPCAM);
        }
      }
    }
  }

  $query2=$this->db->query("SELECT * FROM meta_venta where año=".$año);
  foreach ($query2->result() as $key2) {
    if ($key2->mes<=$mes) {
      $meta_relacionada=$meta_relacionada+$key2->meta_relacionada;
      $meta_tercero=$meta_tercero+$key2->meta_tercero;
    }
    if ($key2->mes<$mes) {
      $meta_relacionadotrans=$meta_relacionadotrans+$key2->meta_relacionada;
      $meta_tercerotrans=$meta_tercerotrans+$key2->meta_tercero;
    }
  }

  $info['acumulada_relacionada']=$acumulada_relacionada;
  $info['acumulada_tercero']=$acumulada_tercero;
  $info['transcurrido_relacionada']=$transcurrido_relacionada;
  $info['transcurrido_tercero']=$transcurrido_tercero;
  $info['meta_relacionado']=$meta_relacionada;
  $info['meta_tercero']=$meta_tercero;
  $info['meta_relacionadotrans']=$meta_relacionadotrans;
  $info['meta_tercerotrans']=$meta_tercerotrans;

return $info;
}

public function consolidadoporaños($año,$mes){
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("(select index1,sum(monto_venta) as 'monto_venta' from
                                (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)<".$año.") as tablettt GROUP BY index1)
                                UNION
                                (select index1, sum(monto_venta) as 'monto_venta'from
                                (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)<=".$mes.") as tablettt GROUP BY index1
                								)
                								ORDER BY index1");
return $query->result();

}
public function metaanual($año,$mes){
    $query2=$this->db->query("SELECT SUM(meta_relacionada+meta_tercero) as 'meta_anual' FROM meta_venta where año=".$año);
    return $query2->row('meta_anual');
}
public function ventaproyectadaanual($año,$mes){
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("				select index1, sum(monto_venta)+(avg(MONTO_VENTA)*(12-".$mes."-1)) as 'proyectada' from
                                  (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                  'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                  from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)<=".$mes.") as tablettt GROUP BY index1");
  return $query->row('proyectada');
}

public function ventaanualrelacionado($año,$mes){
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
$data=$this->data3($año,$mes,'RELACIONADA');
$meses=$this->traermeses();
$starsoft=$this->load->database('starsoft',TRUE);

foreach ($meses as $key) {
  $datos['nombre']= $key->mes;
  $datos['num']= $key->index2;
  foreach ($data as $key2) {
    for ($i=2013; $i <=$año ; $i++) {
      if ($key2->index1==$i and $key2->index2==$key->index2 ) {
        $datos['mes'.$i]=$key2->monto_venta;
      }
      elseif ($i==$año and $key->index2>=$mes) {
        $datos['mes'.$i]=0;
      }
    }
  }
  $utf8carga[]=$datos;
}
    return $utf8carga;
}
public function ventaanualtercero($año,$mes){
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
$data=$this->data3($año,$mes,'TERCERO');
$meses=$this->traermeses();
$starsoft=$this->load->database('starsoft',TRUE);

foreach ($meses as $key) {
  $datos['nombre']= $key->mes;
  $datos['num']= $key->index2;
  foreach ($data as $key2) {
    for ($i=2013; $i <=$año ; $i++) {
      if ($key2->index1==$i and $key2->index2==$key->index2 ) {
        $datos['mes'.$i]=$key2->monto_venta;
      }
      elseif ($i==$año and $key->index2>=$mes) {
        $datos['mes'.$i]=0;
      }
    }
  }
  $utf8carga[]=$datos;
}
    return $utf8carga;
}

public function comparativo_anual($año,$mes){
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("(select index1, sum(monto_venta) as 'monto_venta',TIPO_CLIENTE from
                                (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)<".$año.") as tablettt GROUP BY index1,TIPO_CLIENTE)
                                  UNION
                                  (select index1,sum(monto_venta) as 'monto_venta',TIPO_CLIENTE from
                                (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)<=".$mes.") as tablettt  GROUP BY index1,TIPO_CLIENTE
                                )	ORDER BY index1
                                ");

  for ($i=2013; $i <=$año ; $i++) {
    $info['año']=$i;
    foreach ($query->result() as $key ) {
      if ($key->TIPO_CLIENTE=='RELACIONADA' and $key->index1==$i) {
        $info['relacionado']=$key->monto_venta;
      }elseif ($key->TIPO_CLIENTE=='TERCERO' and $key->index1==$i) {
        $info['tercero']=$key->monto_venta;
      }
    }
    $utf8carga[]=$info;
  }

  return $utf8carga;
}

public function facturadoxsemana($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("DECLARE @Date1 DATE, @Date2 DATE
SET @Date1 = '".date('d-m-Y',strtotime($fechainicio))."'
SET @Date2 = '".date('d-m-Y',strtotime($fechafin))."'
SELECT DATEADD(DAY,number+1,@Date1) as 'fecha'
FROM master..spt_values
WHERE type = 'P'
AND DATEADD(DAY,number+1,@Date1) < @Date2 and
DATENAME(dw, DATEADD(DAY,number+1,@Date1))='Domingo'");
$domingos=$query->result();
$item=1;
$iniciorelativo=$fechainicio;
foreach ($domingos as $key) {
  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto' from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <'".date('d-m-Y',strtotime($key->fecha))."') as tablett ");

  $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
  $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
  $diff = $date1->diff($date2);

  $info['inicio']=$iniciorelativo;
  $info['fin']=$key->fecha;
  $info['monto']=$query2->row('monto');
  $info['dias']=$diff->days;
  $item++;
    $utf8carga[]=$info;

    $iniciorelativo = $key->fecha;
  }
  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto' from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
  from faccab where cfestado like 'V' and
  cffecdoc >='".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <'".date('d-m-Y',strtotime($fechafin))."') as tablett ");

  $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
  $date2 = new DateTime(date('Y-m-d',strtotime($fechafin)));
  $diff = $date1->diff($date2);

  $info['inicio']=$iniciorelativo;
  $info['fin']=$fechafin;
  $info['monto']=$query2->row('monto');
  $info['dias']=$diff->days;
    $utf8carga[]=$info;
  return $utf8carga;
}

public function meta_clienterelacionadoxsemana($fechainicio,$fechafin){
  $starsoft=$this->load->database('starsoft',TRUE);
$query=$starsoft->query("DECLARE @Date1 DATE, @Date2 DATE
SET @Date1 = '".date('d-m-Y',strtotime($fechainicio))."'
SET @Date2 = '".date('d-m-Y',strtotime($fechafin))."'
SELECT DATEADD(DAY,number+1,@Date1) as 'fecha'
FROM master..spt_values
WHERE type = 'P'
AND DATEADD(DAY,number+1,@Date1) < @Date2 and
DATENAME(dw, DATEADD(DAY,number+1,@Date1))='Domingo'");
$domingos=$query->result();
$item=1;
$iniciorelativo=$fechainicio;
foreach ($domingos as $key) {
  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto',TIPO_CLIENTE from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <'".date('d-m-Y',strtotime($key->fecha))."') as tablett where TIPO_CLIENTE LIKE 'RELACIONADA' group by TIPO_CLIENTE");

  $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
  $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
  $diff = $date1->diff($date2);

  $info['inicio']=$iniciorelativo;
  $info['fin']=$key->fecha;
  $info['monto']=$query2->row('monto');
  $info['dias']=$diff->days;
  $item++;
    $utf8carga[]=$info;

    $iniciorelativo = $key->fecha;
  }

  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto',TIPO_CLIENTE from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <='".date('d-m-Y',strtotime($fechafin))."') as tablett where TIPO_CLIENTE LIKE 'RELACIONADA' group by TIPO_CLIENTE");

  $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
  $date2 = new DateTime(date('Y-m-d',strtotime($fechafin)));
  $diff = $date1->diff($date2);

  $info['inicio']=$iniciorelativo;
  $info['fin']=$fechafin;
  $info['monto']=$query2->row('monto');
  $info['dias']=$diff->days;
    $utf8carga[]=$info;
  return $utf8carga;
}
public function empresarelacionadoxsemana($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);
    $query2=$starsoft->query("select CFCODCLI,CFNOMBRE from
    (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFCODCLI,CFNOMBRE,
    'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
    'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
    'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
    from faccab where cfestado like 'V' and
    cffecdoc >= '".date('d-m-Y',strtotime($fechainicio))."' and cffecdoc <='".date('d-m-Y',strtotime($fechafin))."') as tablett
    where TIPO_CLIENTE LIKE 'RELACIONADA' group by CFCODCLI,CFNOMBRE");
    return $query2->result();
}
public function meta_empresarelacionadoxsemana($fechainicio,$fechafin){
  $starsoft=$this->load->database('starsoft',TRUE);
$query=$starsoft->query("DECLARE @Date1 DATE, @Date2 DATE
SET @Date1 = '".date('d-m-Y',strtotime($fechainicio))."'
SET @Date2 = '".date('d-m-Y',strtotime($fechafin))."'
SELECT DATEADD(DAY,number+1,@Date1) as 'fecha'
FROM master..spt_values
WHERE type = 'P'
AND DATEADD(DAY,number+1,@Date1) < @Date2 and
DATENAME(dw, DATEADD(DAY,number+1,@Date1))='Domingo'");
$domingos=$query->result();
$item=1;
$iniciorelativo=$fechainicio;
foreach ($domingos as $key) {
  $info['semana']=$item;
  $query2=$starsoft->query("select CFCODCLI,SUM(MONTO_VENTA) as 'monto',CFNOMBRE,TIPO_CLIENTE from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFCODCLI,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc < '".date('d-m-Y',strtotime($key->fecha))."') as tablett
  where TIPO_CLIENTE LIKE 'RELACIONADA' group by CFCODCLI,CFNOMBRE,TIPO_CLIENTE");
  foreach ($query2->result() as $key2 ) {
    $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
    $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
    $diff = $date1->diff($date2);

    $info['inicio']=$iniciorelativo;
    $info['fin']=$key->fecha;
    $info['monto']=$key2->monto;
    $info['CFNOMBRE']=$key2->CFNOMBRE;
    $info['CFCODCLI']=$key2->CFCODCLI;
    $info['dias']=$diff->days;
        $utf8carga[]=$info;
  }

  $item++;


    $iniciorelativo = $key->fecha;
  }

  $info['semana']=$item;
  $query2=$starsoft->query("select CFCODCLI,SUM(MONTO_VENTA) as 'monto',CFNOMBRE,TIPO_CLIENTE from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFCODCLI,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <='".date('d-m-Y',strtotime($fechafin))."') as tablett
   where TIPO_CLIENTE LIKE 'RELACIONADA' group by CFCODCLI,CFNOMBRE,TIPO_CLIENTE");

   foreach ($query2->result() as $key2) {
     $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
     $date2 = new DateTime(date('Y-m-d',strtotime($fechafin)));
     $diff = $date1->diff($date2);
     $info['semana']=$item;
     $info['inicio']=$iniciorelativo;
     $info['fin']=$fechafin;
     $info['monto']=$key2->monto;
     $info['CFNOMBRE']=$key2->CFNOMBRE;
     $info['CFCODCLI']=$key2->CFCODCLI;
     $info['dias']=$diff->days;
       $utf8carga[]=$info;
   }
  return $utf8carga;
}

public function meta_clienteterceroxsemana($fechainicio,$fechafin){
  $starsoft=$this->load->database('starsoft',TRUE);
$query=$starsoft->query("DECLARE @Date1 DATE, @Date2 DATE
SET @Date1 = '".date('d-m-Y',strtotime($fechainicio))."'
SET @Date2 = '".date('d-m-Y',strtotime($fechafin))."'
SELECT DATEADD(DAY,number+1,@Date1) as 'fecha'
FROM master..spt_values
WHERE type = 'P'
AND DATEADD(DAY,number+1,@Date1) < @Date2 and
DATENAME(dw, DATEADD(DAY,number+1,@Date1))='Domingo'");
$domingos=$query->result();
$item=1;
$iniciorelativo=$fechainicio;
foreach ($domingos as $key) {
  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto',TIPO_CLIENTE from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <'".date('d-m-Y',strtotime($key->fecha))."') as tablett where TIPO_CLIENTE LIKE 'TERCERO' group by TIPO_CLIENTE");

  $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
  $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
  $diff = $date1->diff($date2);

  $info['inicio']=$iniciorelativo;
  $info['fin']=$key->fecha;
  $info['monto']=$query2->row('monto');
  $info['dias']=$diff->days;
  $item++;
    $utf8carga[]=$info;

    $iniciorelativo = $key->fecha;
  }

  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto',TIPO_CLIENTE from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <='".date('d-m-Y',strtotime($fechafin))."') as tablett where TIPO_CLIENTE LIKE 'TERCERO' group by TIPO_CLIENTE");

  $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
  $date2 = new DateTime(date('Y-m-d',strtotime($fechafin)));
  $diff = $date1->diff($date2);

  $info['inicio']=$iniciorelativo;
  $info['fin']=$fechafin;
  $info['monto']=$query2->row('monto');
  $info['dias']=$diff->days;
    $utf8carga[]=$info;
  return $utf8carga;
}

public function facturacion_suministro($fechainicio,$tipo){
  $mes=date('Y-m',strtotime($fechainicio));
  if ($tipo=='manual') {
      $query=$this->db->query("select * from contrato_suministro where mes='".$mes."'");
  } else {
    $query=$this->db->query("select DISTINCT semana,(monto_facturado*0) as 'monto_facturado' from contrato_suministro");
  //  $query=$this->db->query("select docentry,mes,semana,(monto_facturado*0) as 'monto_facturado' from contrato_suministro where mes='".$mes."'");
  }

  return $query->result();
}

public function meta_tercerovendedorxsemana($fechainicio,$fechafin){
  $starsoft=$this->load->database('starsoft',TRUE);
$query=$starsoft->query("DECLARE @Date1 DATE, @Date2 DATE
SET @Date1 = '".date('d-m-Y',strtotime($fechainicio))."'
SET @Date2 = '".date('d-m-Y',strtotime($fechafin))."'
SELECT DATEADD(DAY,number+1,@Date1) as 'fecha'
FROM master..spt_values
WHERE type = 'P'
AND DATEADD(DAY,number+1,@Date1) < @Date2 and
DATENAME(dw, DATEADD(DAY,number+1,@Date1))='Domingo'");
$domingos=$query->result();
$item=1;
$iniciorelativo=$fechainicio;
foreach ($domingos as $key) {
  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto',TIPO_CLIENTE,VENDEDOR,COD_VEN from
    (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFCODCLI,CFNOMBRE,
    'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
    'COD_VEN'=(SELECT CVENDE FROM MAECLI WHERE CCODCLI=CFCODCLI),
    'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
    'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
    from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc < '".date('d-m-Y',strtotime($key->fecha))."') as tablett
  where TIPO_CLIENTE LIKE 'TERCERO' group by TIPO_CLIENTE,VENDEDOR,COD_VEN");
  foreach ($query2->result() as $key2 ) {
    $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
    $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
    $diff = $date1->diff($date2);

    $info['inicio']=$iniciorelativo;
    $info['fin']=$key->fecha;
    $info['monto']=$key2->monto;
     $info['COD_VEN']=$key2->COD_VEN;
    $info['VENDEDOR']=$key2->VENDEDOR;
    $info['dias']=$diff->days;
        $utf8carga[]=$info;
  }

  $item++;


    $iniciorelativo = $key->fecha;
  }

  $info['semana']=$item;
  $query2=$starsoft->query("select SUM(MONTO_VENTA) as 'monto',TIPO_CLIENTE,VENDEDOR,COD_VEN from
  (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFCODCLI,CFNOMBRE,
  'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
  'COD_VEN'=(SELECT CVENDE FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
  'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
  from faccab where cfestado like 'V' and
  cffecdoc >= '".date('d-m-Y',strtotime($iniciorelativo))."' and cffecdoc <='".date('d-m-Y',strtotime($fechafin))."') as tablett
  where TIPO_CLIENTE LIKE 'TERCERO' group by TIPO_CLIENTE,VENDEDOR,COD_VEN");

   foreach ($query2->result() as $key2) {
     $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
     $date2 = new DateTime(date('Y-m-d',strtotime($fechafin)));
     $diff = $date1->diff($date2);
     $info['semana']=$item;
     $info['inicio']=$iniciorelativo;
     $info['fin']=$fechafin;
     $info['monto']=$key2->monto;
     $info['COD_VEN']=$key2->COD_VEN;
     $info['VENDEDOR']=$key2->VENDEDOR;
     $info['dias']=$diff->days;
       $utf8carga[]=$info;
   }
  return $utf8carga;
}

public function vendedorxsemana($fechainicio,$fechafin){
    $starsoft=$this->load->database('starsoft',TRUE);
    $query2=$starsoft->query("select VENDEDOR,COD_VEN from
    (SELECT 'SEMANA'=DATEPART(week,CFFECDOC),'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFCODCLI,CFNOMBRE,
    'MONTO_VENTA'=case CFCODMON WHEN 'ME' THEN CFIMPORTE-CFIGV  ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END,
    'COD_VEN'=(SELECT CVENDE FROM MAECLI WHERE CCODCLI=CFCODCLI),
    'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI),
    'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END
    from faccab where cfestado like 'V' and
    cffecdoc >= '".date('d-m-Y',strtotime($fechainicio))."' and cffecdoc <='".date('d-m-Y',strtotime($fechafin))."') as tablett
    where TIPO_CLIENTE LIKE 'TERCERO'group by VENDEDOR,COD_VEN");
    return $query2->result();
}

public function meta_anualxsemana($fechainicio,$fechafin){
    $año=date('Y',strtotime($fechainicio));
    $mes=date('m',strtotime($fechainicio));
    $query2=$this->db->query("SELECT meta_relacionada,meta_tercero FROM meta_venta where mes=".$mes." and año=".$año);
    return $query2->row();
}
private function data2($año,$mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("SELECT cftd,CFNUMSER,CFNUMDOC,'MES'=MONTH(CFFECDOC),YEAR(CFFECDOC) AS 'ANIO',CFFECDOC,CFNOMBRE,
'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
CFIMPORTE,CFTIPCAM,CFCODMON,CFIGV,'MONTO_VENTA'=CFIMPORTE-CFIGV,'VENDEDOR'=(SELECT ( SELECT DES_VEN FROM VENDEDOR WHERE COD_VEN=CVENDE)FROM MAECLI WHERE CCODCLI=CFCODCLI)
from faccab where cfestado like 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC) IN(".$mes.")");

return $query->result();
}

private function data3($año,$mes,$tipo){
  if ($mes='1,2,3') {
    $mes=3;
  }elseif ($mes='4,5,6') {
    $mes=6;
  }elseif ($mes='7,8,9') {
    $mes=9;
  }elseif ($mes='10,11,12') {
    $mes=12;
  }
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("(select index1,index2,mes, sum(monto_venta) as 'monto_venta',TIPO_CLIENTE from
                                (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)<".$año.") as tablettt where TIPO_CLIENTE='".$tipo."' GROUP BY index1,index2,mes,TIPO_CLIENTE)
                                  UNION
                                  (select index1,index2,mes, sum(monto_venta) as 'monto_venta',TIPO_CLIENTE from
                                (select  DATENAME(mm,CFFECDOC) as 'mes',YEAR(cffecdoc) as 'index1',MONTH(cffecdoc) as 'index2',
                                'TIPO_CLIENTE'=CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END,
                                'MONTO_VENTA'=CASE WHEN CFCODMON='ME' THEN CFIMPORTE-CFIGV ELSE (CFIMPORTE-CFIGV)/CFTIPCAM END
                                from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)=".$año." AND MONTH(CFFECDOC)<=".$mes.") as tablettt where TIPO_CLIENTE='".$tipo."' GROUP BY index1,index2,mes ,TIPO_CLIENTE
                                )	ORDER BY index1,index2
                                ");
  return $query->result();
}

private function traermeses(){
  $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("(select mes,index2 from  (select  DATENAME(mm,CFFECDOC) as 'mes',MONTH(cffecdoc) as 'index2'
  from faccab WHERE CFESTADO LIKE 'V' AND YEAR(CFFECDOC)=2012) as tablettt GROUP BY mes,index2) ORDER BY index2");
  return $query->result();
}

public function cotizaciones_pedidos($mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));
  $query=$this->db->query("select T1.* ,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where month(T1.CCFECDOC)='".$month."' and year(T1.CCFECDOC)='".$year."'");
  $cotizacion=0;
  $pedido=0;
  foreach ($query->result() as $key) {
    if ($key->CDIMPORTE>0) {
      if ($key->CCCODMON=='MN') {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV)/$key->CCTIPCAM);
      }else {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV));
      }

      $query2=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and month(cffecdoc)='".$month."' and year(cffecdoc)='".$year."'");
      if ($query2->num_rows()>0) {
        $pedido=$pedido+$query2->row('monto');
      }
    }

  }
  $data['cotizacion']=$cotizacion;
  $data['pedido']=$pedido;

  return $data;
}
public function cotizaciones_pedidos_relacionadas($mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));
  $query=$this->db->query("select T1.* ,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where T1.CCCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and month(T1.CCFECDOC)='".$month."' and year(T1.CCFECDOC)='".$year."'");
  $cotizacion=0;
  $pedido=0;
  foreach ($query->result() as $key) {
    if ($key->CDIMPORTE>0) {
      if ($key->CCCODMON=='MN') {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV)/$key->CCTIPCAM);
      }else {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV));
      }

      $query2=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and CFRFNUMDOC='".str_pad($key->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and month(cffecdoc)='".$month."' and year(cffecdoc)='".$year."'");
      if ($query2->num_rows()>0) {
        $pedido=$pedido+$query2->row('monto');
      }
    }

  }
  $data['cotizacion']=$cotizacion;
  $data['pedido']=$pedido;

  return $data;
}
public function cotizaciones_pedidos_mercado_gavilan($mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));
  $query=$this->db->query("select T1.* ,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where T1.CCVENDE='08' AND  T1.CCCODCLI not IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and month(T1.CCFECDOC)='".$month."' and year(T1.CCFECDOC)='".$year."'");
  $cotizacion=0;
  $pedido=0;
  foreach ($query->result() as $key) {
    if ($key->CDIMPORTE>0) {
      if ($key->CCCODMON=='MN') {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV)/$key->CCTIPCAM);
      }else {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV));
      }

      $query2=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFCODCLI not IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and CFRFNUMDOC='".str_pad($key->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and month(cffecdoc)='".$month."' and year(cffecdoc)='".$year."'");
      if ($query2->num_rows()>0) {
        $pedido=$pedido+$query2->row('monto');
      }

    }
    }
  $data['cotizacion']=$cotizacion;
  $data['pedido']=$pedido;

  return $data;
}
public function cotizaciones_pedidos_mercado_nunez($mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));
  $query=$this->db->query("select T1.* ,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where T1.CCVENDE='10' AND T1.CCCODCLI not IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and month(T1.CCFECDOC)='".$month."' and year(T1.CCFECDOC)='".$year."'");
  $cotizacion=0;
  $pedido=0;
  foreach ($query->result() as $key) {
    if ($key->CDIMPORTE>0) {
      if ($key->CCCODMON=='MN') {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV)/$key->CCTIPCAM);
      }else {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV));
      }

      $query2=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFCODCLI not IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and CFRFNUMDOC='".str_pad($key->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and month(cffecdoc)='".$month."' and year(cffecdoc)='".$year."'");
      if ($query2->num_rows()>0) {
        $pedido=$pedido+$query2->row('monto');
      }

    }
    }
  $data['cotizacion']=$cotizacion;
  $data['pedido']=$pedido;

  return $data;
}
public function cotizaciones_pedidos_mercado_cds($mes){
  $starsoft=$this->load->database('starsoft',TRUE);
  $month=date('m',strtotime($mes));
  $year=date('Y',strtotime($mes));
  $query=$this->db->query("select T1.* ,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where T1.CCVENDE='07' AND T1.CCCODCLI not IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and month(T1.CCFECDOC)='".$month."' and year(T1.CCFECDOC)='".$year."'");
  $cotizacion=0;
  $pedido=0;
  foreach ($query->result() as $key) {
    if ($key->CDIMPORTE>0) {
      if ($key->CCCODMON=='MN') {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV)/$key->CCTIPCAM);
      }else {
        $cotizacion=$cotizacion+(($key->CDIMPORTE-$key->CCIGV));
      }

      $query2=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFCODCLI not IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and CFRFNUMDOC='".str_pad($key->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and month(cffecdoc)='".$month."' and year(cffecdoc)='".$year."'");
      if ($query2->num_rows()>0) {
        $pedido=$pedido+$query2->row('monto');
      }

    }
    }
  $data['cotizacion']=$cotizacion;
  $data['pedido']=$pedido;

  return $data;
}
public function cotizaciones_pedidos_semanal($fechainicio,$fechafin,$tipo,$vendedor){
    $starsoft=$this->load->database('starsoft',TRUE);
  $query=$starsoft->query("DECLARE @Date1 DATE, @Date2 DATE
  SET @Date1 = '".date('d-m-Y',strtotime($fechainicio))."'
  SET @Date2 = '".date('d-m-Y',strtotime($fechafin))."'
  SELECT DATEADD(DAY,number+1,@Date1) as 'fecha'
  FROM master..spt_values
  WHERE type = 'P'
  AND DATEADD(DAY,number+1,@Date1) < @Date2 and
  DATENAME(dw, DATEADD(DAY,number+1,@Date1))='Domingo'");
  $domingos=$query->result();
  $item=1;
  $iniciorelativo=$fechainicio;

  if ($tipo=='general') {
    foreach ($domingos as $key) {
      $info['semana']=$item;
      $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
      $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
      $diff = $date1->diff($date2);
      $cotizacion=0;
      $pedido=0;
      $info['inicio']=$iniciorelativo;
      $info['fin']=$key->fecha;
      $info['dias']=$diff->days;
      $query2=$this->db->query("select T1.*,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where T1.CCFECDOC >= '".$iniciorelativo."' and T1.CCFECDOC < '".$key->fecha."'");
      foreach ($query2->result() as $key2 ) {
        if ($key2->CDIMPORTE>0) {
          if ($key2->CCCODMON=='MN') {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV)/$key2->CCTIPCAM);
          }else {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV));
          }
          $query3=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key2->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and CFFECDOC >= '".date('d-m-Y',strtotime($iniciorelativo))."' and CFFECDOC < '".date('d-m-Y',strtotime($key->fecha))."'");
          if ($query3->num_rows()>0) {
            $pedido=$pedido+$query3->row('monto');
          }
        }
      }
        $info['cotizacion']=$cotizacion;
        $info['pedido']=$pedido;
      $item++;
        $utf8carga[]=$info;

        $iniciorelativo = $key->fecha;
      }

      $info['semana']=$item;
      $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
      $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
      $diff = $date1->diff($date2);
      $cotizacion=0;
      $pedido=0;
      $info['inicio']=$iniciorelativo;
      $info['fin']=$fechafin;
      $info['dias']=$diff->days;
      $query2=$this->db->query("select T1.*,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where CCFECDOC >= '".$iniciorelativo."' and CCFECDOC < '".$fechafin."'");
      foreach ($query2->result() as $key2 ) {
        if ($key2->CDIMPORTE>0) {
          if ($key2->CCCODMON=='MN') {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV)/$key2->CCTIPCAM);
          }else {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV));
          }
          $query3=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key2->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and CFFECDOC >= '".date('d-m-Y',strtotime($iniciorelativo))."' and CFFECDOC < '".date('d-m-Y',strtotime($fechafin))."'");
          if ($query3->num_rows()>0) {
            $pedido=$pedido+$query3->row('monto');
          }
        }
      }
        $info['cotizacion']=$cotizacion;
        $info['pedido']=$pedido;
    $utf8carga[]=$info;
   return $utf8carga;
  } elseif ($tipo=='relacionado') {
    foreach ($domingos as $key) {
      $info['semana']=$item;
      $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
      $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
      $diff = $date1->diff($date2);
      $cotizacion=0;
      $pedido=0;
      $info['inicio']=$iniciorelativo;
      $info['fin']=$key->fecha;
      $info['dias']=$diff->days;
      $query2=$this->db->query("select T1.*,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where CCCODCLI in ('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and CCFECDOC >= '".$iniciorelativo."' and CCFECDOC < '".$key->fecha."'");
      foreach ($query2->result() as $key2 ) {
        if ($key2->CDIMPORTE>0) {
          if ($key2->CCCODMON=='MN') {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV)/$key2->CCTIPCAM);
          }else {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV));
          }
          $query3=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key2->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and CFFECDOC >= '".date('d-m-Y',strtotime($iniciorelativo))."' and CFFECDOC < '".date('d-m-Y',strtotime($key->fecha))."'");
          if ($query3->num_rows()>0) {
            $pedido=$pedido+$query3->row('monto');
          }
        }
      }
        $info['cotizacion']=$cotizacion;
        $info['pedido']=$pedido;
      $item++;
        $utf8carga[]=$info;

        $iniciorelativo = $key->fecha;
      }

      $info['semana']=$item;
      $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
      $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
      $diff = $date1->diff($date2);
      $cotizacion=0;
      $pedido=0;
      $info['inicio']=$iniciorelativo;
      $info['fin']=$fechafin;
      $info['dias']=$diff->days;
      $query2=$this->db->query("select T1.*,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where CCCODCLI in ('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and CCFECDOC >= '".$iniciorelativo."' and CCFECDOC < '".$fechafin."'");
      foreach ($query2->result() as $key2 ) {
        if ($key2->CDIMPORTE>0) {
          if ($key2->CCCODMON=='MN') {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV)/$key2->CCTIPCAM);
          }else {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV));
          }
          $query3=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key2->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and CFFECDOC >= '".date('d-m-Y',strtotime($iniciorelativo))."' and CFFECDOC < '".date('d-m-Y',strtotime($fechafin))."'");
          if ($query3->num_rows()>0) {
            $pedido=$pedido+$query3->row('monto');
          }
        }
      }
        $info['cotizacion']=$cotizacion;
        $info['pedido']=$pedido;
    $utf8carga[]=$info;
   return $utf8carga;
  } elseif ($tipo=='terceros') {
    foreach ($domingos as $key) {
      $info['semana']=$item;
      $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
      $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
      $diff = $date1->diff($date2);
      $cotizacion=0;
      $pedido=0;
      $info['inicio']=$iniciorelativo;
      $info['fin']=$key->fecha;
      $info['dias']=$diff->days;
      $query2=$this->db->query("select T1.*,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where CCCODCLI not in ('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and T1.CCVENDE='".$vendedor."' and CCFECDOC >= '".$iniciorelativo."' and CCFECDOC < '".$key->fecha."'");
      foreach ($query2->result() as $key2 ) {
        if ($key2->CDIMPORTE>0) {
          if ($key2->CCCODMON=='MN') {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV)/$key2->CCTIPCAM);
          }else {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV));
          }
          $query3=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key2->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and CFFECDOC >= '".date('d-m-Y',strtotime($iniciorelativo))."' and CFFECDOC < '".date('d-m-Y',strtotime($key->fecha))."'");
          if ($query3->num_rows()>0) {
            $pedido=$pedido+$query3->row('monto');
          }
        }
      }
        $info['cotizacion']=$cotizacion;
        $info['pedido']=$pedido;
      $item++;
        $utf8carga[]=$info;

        $iniciorelativo = $key->fecha;
      }

      $info['semana']=$item;
      $date1 = new DateTime(date('Y-m-d',strtotime($iniciorelativo)));
      $date2 = new DateTime(date('Y-m-d',strtotime($key->fecha)));
      $diff = $date1->diff($date2);
      $cotizacion=0;
      $pedido=0;
      $info['inicio']=$iniciorelativo;
      $info['fin']=$fechafin;
      $info['dias']=$diff->days;
      $query2=$this->db->query("select T1.*,(SELECT sum(CDIMPUS) FROM COTDET WHERE CDNUMDOC = T1.CCNUMDOC AND (CDESTADO IN (1,3,4) or CDCANTPEN<CDCANTID) GROUP By CDNUMDOC) AS 'CDIMPORTE' from COTCAB T1 where CCCODCLI not in ('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') and T1.CCVENDE='".$vendedor."' and CCFECDOC >= '".$iniciorelativo."' and CCFECDOC < '".$fechafin."'");
      foreach ($query2->result() as $key2 ) {
        if ($key2->CDIMPORTE>0) {
          if ($key2->CCCODMON=='MN') {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV)/$key2->CCTIPCAM);
          }else {
            $cotizacion=$cotizacion+(($key2->CDIMPORTE-$key2->CCIGV));
          }
          $query3=$starsoft->query("select (CASE when CFCODMON='MN' THEN (CFIMPORTE-CFIGV)/CFTIPCAM else (CFIMPORTE-CFIGV) end) as 'monto' from PEDCAB where CFRFNUMDOC='".str_pad($key2->CCNUMDOC, 7, "0", STR_PAD_LEFT)."' and CFFECDOC >= '".date('d-m-Y',strtotime($iniciorelativo))."' and CFFECDOC < '".date('d-m-Y',strtotime($fechafin))."'");
          if ($query3->num_rows()>0) {
            $pedido=$pedido+$query3->row('monto');
          }
        }
      }
        $info['cotizacion']=$cotizacion;
        $info['pedido']=$pedido;
    $utf8carga[]=$info;
   return $utf8carga;
  }
}
public function cumplimiento_pedidos($month,$year){

    $starsoft=$this->load->database('starsoft',TRUE);
  $QUERY=$starsoft->query("select dfnumped,DFSECUEN,
case WHEN ltrim(rtrim(REFERENCIA_GLOSA))='' then cast(cast(CFFECDOC as date) as varchar) ELSE CAST(REFERENCIA_GLOSA AS DATE)  end AS 'fec_ent',
'fec_fact'=(select top 1 cast(cast(CFFECDOC as date) as varchar) from FACDET inner join faccab on cftd=dftd and cfnumser=dfnumser and cfnumdoc=dfnumdoc
where cfnroped=t0.dfnumped and dfcodigo=t0.DFCODIGO ),cast(CFFECDOC as date) as 'CFFECDOC',CFVENDE,cfrfnumdoc,CFORDCOM,CFCODCLI,CFNOMBRE,DFCODIGO,
dfdescri,CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END as 'TIPO_CLIENTE', dfcantid,(dfcantid-DFSALDO) 'POR_ATENDER',
DFSALDO, cfcotiza as 'situacion', ((dfimpus/DFCANTID)/1.18) as 'val_unit',((dfimpus)/1.18) as 'total' from PEDDET t0  inner join PEDCAB t1 on cfnumped=dfnumped where cfcotiza in ('ATENDIDO','LIQUIDADO') AND DFCODIGO NOT LIKE 'TEXTO'
  and DFSALDO=0 and  month(CFFECDOC)='".$month."' and year(CFFECDOC)='".$year."' order by dfnumped,dfsecuen ");

    /*foreach ($QUERY->result() as $key) {
      $info['dfnumped']=$key->dfnumped;
      $info['DFSECUEN']=$key->DFSECUEN;
      if (trim($key->REFERENCIA_GLOSA)=='') {
        $info['REFERENCIA_GLOSA']=date('Y-m-d',strtotime($key->CFFECDOC));
      } else {
        $info['REFERENCIA_GLOSA']=date('Y-m-d',strtotime($key->REFERENCIA_GLOSA));
      }
      $info['CFFECDOC']=$key->CFFECDOC;
      $info['CFVENDE']=$key->CFVENDE;
      $info['CFCODCLI']=$key->CFCODCLI;
      $info['CFNOMBRE']=$key->CFNOMBRE;
      $info['DFCODIGO']=$key->DFCODIGO;
      $info['dfdescri']=$key->dfdescri;
      $info['TIPO_CLIENTE']=$key->TIPO_CLIENTE;
      $info['DFSALDO']=$key->DFSALDO;
      $info['situacion']=$key->situacion;
      $info['val_unit']=$key->val_unit;
      $info['total']=$key->total;
      $query2=$starsoft->query("select top 1 cffecdoc as 'fec_fact' from FACDET inner join faccab on  cftd=dftd and cfnumser=dfnumser and cfnumdoc=dfnumdoc where cfnroped='".$key->dfnumped."' and dfcodigo='".$key->DFCODIGO."' ");
      $info['fec_fact']=$query2->row('fec_fact');

      $utf8carga[]=$info;
    }*/

    return $QUERY->result();
}
public function reprogramacion($month,$year){
$starsoft=$this->load->database('starsoft',TRUE);
  $QUERY=$starsoft->query("select dfnumped,DFSECUEN,
case WHEN ltrim(rtrim(REFERENCIA_GLOSA))='' then cast(cast(CFFECDOC as date) as varchar) ELSE CAST(REFERENCIA_GLOSA AS DATE)  end AS 'fec_ent',
cast(CFFECDOC as date) as 'CFFECDOC',CFVENDE,cfrfnumdoc,CFORDCOM,CFCODCLI,CFNOMBRE,DFCODIGO,
dfdescri,CASE WHEN CFCODCLI IN('20535689394','20469962246','1008206G1','20600670949','OD151012DG7') THEN 'RELACIONADA' ELSE 'TERCERO' END as 'TIPO_CLIENTE', DFCANTID,
DFSALDO, cfcotiza as 'situacion', ((dfimpus/DFCANTID)/1.18) as 'val_unit',((dfimpus)/1.18) as 'total' from PEDDET t0  inner join PEDCAB t1 on cfnumped=dfnumped
 where DFCODIGO!='TEXTO' AND MONTH(CFFECDOC)='".$month."' and YEAR(CFFECDOC)='".$year."'");

foreach ($QUERY->result() as $key){
  $info['dfnumped']=$key->dfnumped;
  $info['DFSECUEN']=$key->DFSECUEN;
  $info['CFFECDOC']=$key->CFFECDOC;
  $info['CFVENDE']=$key->CFVENDE;
  $info['CFCODCLI']=$key->CFCODCLI;
  $info['CFNOMBRE']=$key->CFNOMBRE;
  $info['DFCODIGO']=$key->DFCODIGO;
  $info['dfcantid']=$key->DFCANTID;
  $info['dfdescri']=$key->dfdescri;
  $info['val_unit']=$key->val_unit;
  $info['total']=$key->total;
  $query2=$this->db->query("SELECT DFREPROGRAM,DFFECENT,fecha_reprogramada1,fecha_reprogramada2,fecha_reprogramada3 FROM PEDDET WHERE DFSECUEN LIKE '".$key->DFSECUEN."' AND DFNUMPED LIKE '".$key->dfnumped."'");
  if ($query2->num_rows()>0) {
      $info['DFREPROGRAM']=$query2->row('DFREPROGRAM');
      $info['DFFECENT']=$query2->row('DFFECENT');
      if ($info['DFREPROGRAM']==0) {
        $info['DFFECREP']=$query2->row('DFFECENT');
      }elseif ($info['DFREPROGRAM']==1) {
        $info['DFFECREP']=$query2->row('fecha_reprogramada1');
      }elseif ($info['DFREPROGRAM']==2) {
        $info['DFFECREP']=$query2->row('fecha_reprogramada2');
      }elseif ($info['DFREPROGRAM']==3) {
        $info['DFFECREP']=$query2->row('fecha_reprogramada3');
      }

  } else {
    $info['DFREPROGRAM']=0;
    $info['DFFECENT']=$key->CFFECDOC;
    $info['DFFECREP']=$key->CFFECDOC;
  }
$utf8carga[]=$info;
}

return $utf8carga;
}
}
