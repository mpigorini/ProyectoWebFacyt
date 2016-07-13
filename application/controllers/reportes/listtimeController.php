<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ReportesController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listtime');
    }
    
   
}