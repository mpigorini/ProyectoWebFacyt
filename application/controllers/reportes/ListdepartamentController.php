<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListdepartamentController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listdepartament');
    }
    
   
}