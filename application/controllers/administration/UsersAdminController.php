<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersAdminController extends CI_Controller {


	/**
	 * Load user administration view
	 */
	public function index()
	{
		$this->load->view('administration/manageUsers');
		// $this->load->view('welcome_message');
	}
}
