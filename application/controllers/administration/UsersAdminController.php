<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersAdminController extends CI_Controller {


	/**
	 * Load user administration view
	 */
	public function index(){
		$this->load->view('administration/manageUsers');
	}

	public function getAllUsers(){
		try {
            
            $em = $this->doctrine->em;
            $users = $em->getRepository('\Entity\Users')->findAll();
            
            foreach ($users as $key=>$user) {
                $result['data'][$key]['id'] = $user->getId();
                $result['data'][$key]['name'] = $user->getName();
                $result['data'][$key]['lastname'] = $user->getLastname();
                $result['data'][$key]['cedula'] = $user->getCedula();
                $result['data'][$key]['phone'] = $user->getPhone();
                $result['data'][$key]['type'] = $user->getType();
                $result['data'][$key]['department'] = $user->getDepartment()->getName();
                $result['data'][$key]['position'] = $user->getPosition()->getName();
            }
            
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }

        echo json_encode($result);
	}
}
