<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {


	/**
	 * Load Headers
	 */
	public function index()
	{
		$this->load->view('templates/headers');
		// $this->load->view('welcome_message');
	}
}
