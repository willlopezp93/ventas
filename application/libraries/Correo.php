<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PHPMailer Class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category    Libraries
 * @author      CodexWorld
 * @link        https://www.codexworld.com
 */
 require_once APPPATH.'/third_party/PHPMailer/class.phpmailer.php';
 require_once APPPATH.'/third_party/PHPMailer/class.smtp.php';

class Correo extends PHPMailer
{
    public function __construct(){
      parent::__construct();
  }

}
