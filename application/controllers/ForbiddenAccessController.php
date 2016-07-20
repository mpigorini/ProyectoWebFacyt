<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForbiddenAccessController extends CI_Controller {

    public function index() {
        $this->load->view('templates/forbidden');
    }
}
