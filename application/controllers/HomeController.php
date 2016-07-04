<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HomeController extends CI_Controller {
	/**
	 * Load Home
	 */
	public function index()
	{
		$this->load->view('home');
		// $this->load->view('welcome_message');
	}
}
