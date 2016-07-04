<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministracionController extends CI_Controller {


	/**
	 * Load Headers
	 */
	public function index()
	{
		$this->load->view('coordinador/administracion/administracion');
		// $this->load->view('welcome_message');
	}
}
