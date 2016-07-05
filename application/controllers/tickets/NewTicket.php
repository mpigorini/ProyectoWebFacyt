<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class NewTicket extends CI_Controller {
    
    public function index() {
        $this->load->view('tickets/newTicket');
    }
}