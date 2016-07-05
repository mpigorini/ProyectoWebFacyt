<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {


	/**
	 * Load ticket administration view
	 */
	public function index()
	{
		$this->load->view('tickets/tickets');
		// $this->load->view('welcome_message');
	}
}
