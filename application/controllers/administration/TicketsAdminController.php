<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsAdminController extends CI_Controller {


	/**
	 * Load ticket administration view
	 */
	public function index()
	{
		$this->load->view('administration/manageTickets');
		// $this->load->view('welcome_message');
	}
}
