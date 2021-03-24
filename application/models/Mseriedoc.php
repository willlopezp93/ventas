<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mseriedoc extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function getseries(){
    $series = array('RQM','SCC');
    $this->db->select('*');
    $this->db->from('serie_doc');
    $this->db->where_not_in('serie_doc_id',$series);
    $query=  $this->db->get();
    return $query->result();

  }
}
