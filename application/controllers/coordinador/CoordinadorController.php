<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoordinadorController extends CI_Controller {


	/**
	 * Load coordinator main view
	 */
	public function index()
	{
		$this->load->view('coordinador/main');
	}
}
