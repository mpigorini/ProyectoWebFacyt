<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class TicketsConfiguration extends CI_Controller {
    
    public function index() {
        $this->load->view('configuration/ticketsConfig');
    }

}