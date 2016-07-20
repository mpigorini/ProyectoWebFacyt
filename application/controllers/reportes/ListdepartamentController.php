<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListdepartamentController extends CI_Controller {

    public function index() {
       $this->load->view('reportes/listdepartament');
    }

    public function listTicket(){
			try {
					$em = $this->doctrine->em;
					$query = $em->createQuery('SELECT t.id,t.subject,t.type,t.answerTime,t.qualityOfService,t.department FROM \Entity\Ticket t');
					$tickets = $query->getResult(); // array de objetos User

					$result['message'] = "success";

					$result['tickets'] = $tickets;
			}catch(Exception $e){
					$result['message'] = "Error";
			}

			echo json_encode($result);
	}

    public function getDepartments() {

    	try {

    		$em = $this->doctrine->em;
    		$departments = $em->getRepository('\Entity\Department')->findAll();
    		foreach($departments as $key=>$department) {
    			$result['data'][$key]['id'] = $department->getId();
    			$result['data'][$key]['name'] = $department->getName();
    		}
    		$result['message'] = "success";
    	}catch(Exception $e){
    		\ChromePhp::log($e);
    	}
    }
}
