<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsController extends CI_Controller {


	/**
	 * Load Headers
	 */
	public function index()
	{
		$this->load->view('coordinador/tickets/tickets');
		// $this->load->view('welcome_message');
	}
}
