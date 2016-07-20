<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
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
    		$result['message'] = "error";
    	}
    	echo json_encode($result);
    }

    public function getTicketsForDepartment() {


    	try {
    		\ChromePhp::log($_GET['name']);
    		$em = $this->doctrine->em;
    		$qb = $em->createQueryBuilder();
    		$tickets = $qb->select('t')
    			->from('\Entity\Ticket', 't')
    			->where('t.department = :dep')
    			->setParameter('dep',  $_GET['name'])
    			->getQuery()->getResult();
    		$config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

            if($config != null) {
	            foreach($tickets as $key => $ticket) {

	         		$result['tickets'][$key]['id'] = $ticket->getId();
	         		$result['tickets'][$key]['paddedId'] = sprintf('%06d', $ticket->getId());
	         		$result['tickets'][$key]['subject'] = $ticket->getSubject();
	         		$result['tickets'][$key]['description'] = $ticket->getDescription();
	         		$result['tickets'][$key]['type'] = $ticket->getType();
	         		$result['tickets'][$key]['level'] = $ticket->getLevel();
	         		$result['tickets'][$key]['priority'] = $ticket->getPriority();
	         		$result['tickets'][$key]['answerTime'] = $result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime() !== null ? $ticket->getAnswerTime() . "d / " . $ticket->getMaxAnswerTime() . "d" : "- / " . $ticket->getMaxAnswerTime() . "d";
	         		$result['tickets'][$key]['qualityOfService'] = $ticket->getQualityOfService();
	         		// Load user
	     			$result['tickets'][$key]['userReporter']['id'] = $ticket->getUserReporter()->getId();
	     			$result['tickets'][$key]['userReporter']['name'] = $ticket->getUserReporter()->getName();
		 		   // Load user assigned
	         	    if($ticket->getUserAssigned() != null ) {
	         	        $result['tickets'][$key]['userAssigned']['id'] = $ticket->getUserAssigned()->getId();
	         	        $result['tickets'][$key]['userAssigned']['showName'] =$ticket->getUserAssigned()->getName() ." " .$ticket->getUserAssigned()->getLastName() ;
	         	    }
	         		$result['tickets'][$key]['department'] = $ticket->getDepartment();
	         		$result['tickets'][$key]['submitDate'] =$ticket->getSubmitDate();
	         		$result['tickets'][$key]['closeDate'] = $ticket->getCloseDate();
	         		$result['tickets'][$key]['state'] = $ticket->getState();


	         		$result['tickets'][$key]['solutionDescription'] = $ticket->getSolutionDescription();
	         		$result['tickets'][$key]['evaluation'] = $ticket->getEvaluation();
	 				// Determine how many days are left and whether we should warn user about it
					$currentDate = new \DateTime('now');
					$interval = $ticket->getSubmitDate()->diff($currentDate);
					$daysPassed = $interval->format("%a");
					$daysLeft = $ticket->getMaxAnswerTime() - $daysPassed;
					// If days left is three or less and it has not been closed yet, we must warn user.
					$result['tickets'][$key]['warn'] = $daysLeft <= 3  && $ticket->getState() != "Cerrado" ? true : false;
					$result['tickets'][$key]['daysLeft'] = $daysLeft < 0 ? 0 : $daysLeft;
					$result['tickets'][$key]['maxAnswerTime'] = $ticket->getMaxAnswerTime();

	            }

    			$result['message'] = "success";
        	}
    	}catch(Exception $e){
    		\ChromePhp::log($e);
    		$result['message'] = "error";
    	}
    	echo json_encode($result);
    }
}
