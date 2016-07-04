<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoordinadorController extends CI_Controller {


	/**
	 * Load Home
	 */
	public function index()
	{
		$this->load->view('coordinador/main');
	}
}
