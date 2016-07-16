<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListsatisfactionController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listsatisfaction');
    }
    
   
}