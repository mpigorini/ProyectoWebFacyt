<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListtimeController extends CI_Controller {
    
    public function index() {
        echo "loool";
       $this->load->view('reportes/listtime');
    }
    
   
}