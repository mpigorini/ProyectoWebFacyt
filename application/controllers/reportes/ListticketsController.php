<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class ListticketsController extends CI_Controller {

    public function index() {
       $this->load->view('reportes/listtickets');
    }

  /*  public function ListTickets(){

            	try {
					$em = $this->doctrine->em;
					$query = $em->createQuery('SELECT t FROM \Entity\Ticket t');
					$tickets = $query->getResult(); // array de objetos User
					$result['message'] = "success";
					foreach ($tickets as $key => $value) {
					    $list_tickets[$key]['id'] = $value->getId();
						$list_tickets[$key]['subject'] = $value->getSubject();
						$list_tickets[$key]['description'] = $value->getDescription();
						$list_tickets[$key]['type'] = $value->getType();
						$list_tickets[$key]['level'] = $value->getLevel();
						$list_tickets[$key]['priority'] = $value->getPriority();
						$list_tickets[$key]['answerTime'] = $value->getAnswerTime();
						$list_tickets[$key]['qualityOfService'] = $value->getQualityOfService();
						$list_tickets[$key]['userReporter'] = $value->getUserReporter();
						$list_tickets[$key]['userAssigned'] = $value->getUserAssigned();
						$list_tickets[$key]['department'] = $value->getDepartment();
						$list_tickets[$key]['submitDate'] = date_format($value->getSubmitDate(),'m-d-Y');
						$list_tickets[$key]['closeDate'] = date_format($value->getCloseDate(),'m-d-Y');
						$list_tickets[$key]['state'] = $value->getState();
						$list_tickets[$key]['solutionDescription'] = $value->getSolutionDescription();
						$list_tickets[$key]['evaluation'] = $value->getevaluation();
					}
					$result['tickets'] = $list_tickets;
			}catch(Exception $e){
					$result['message'] = "Error";
			}
			echo json_encode($result);

        	$em = $this->doctrine->em;
        	$tickets = $em->getRepository('\Entity\Ticket')->findAll();

            if (!$tickets) {
                $result['message']="Error, no se encuentran tickets en la base de datos";
        	}else
    		{
    		    $result['message']="success";
        	    $result['tickets']=$tickets->getResult();

    		}
    		//print_r($tickets);
			//echo json_encode($result);
		} */

		public function getTickets() {
	      try {

             $em = $this->doctrine->em;
             $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

            if($config != null) {
				// Get current config types and priorities
				$types = explode(',', $config->getTypes());
				$priorities = explode(',', $config->getPriorities());
				// Get all max answer times
				$maxAnswerTimes = $config->getMaxAnswerTimes();
				// Pre-process max answer times: Put all of em into a single array
				$temp = array();
				foreach ($maxAnswerTimes as $maxAnswerTime) {
					array_push($temp, $maxAnswerTime->getMaxTime());
				}
				// Store each max time in a hashed max answer time structure
				$counter = 0;
				foreach($types as $tKey => $type) {
					 foreach($priorities as $pKey => $priority) {
						$hashedTimes[$type][$priority] = $temp[$counter];
						$counter++;
					}
				}
	            $tickets = $em->getRepository('\Entity\Ticket')->findAll();

	         	foreach($tickets as $key => $ticket) {
	         		$result['tickets'][$key]['id'] = $ticket->getId();
	         		$result['tickets'][$key]['paddedId'] = sprintf('%06d', $ticket->getId());
	         		$result['tickets'][$key]['subject'] = $ticket->getSubject();
	         		$result['tickets'][$key]['description'] = $ticket->getDescription();
	         		$result['tickets'][$key]['type'] = $ticket->getType();
	         		$result['tickets'][$key]['level'] = $ticket->getLevel();
	         		$result['tickets'][$key]['priority'] = $ticket->getPriority();
	         		$result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime();
                    $result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime() !== null ? $ticket->getAnswerTime() . "d / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d" : "- / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d";
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
					$daysLeft = $hashedTimes[$ticket->getType()][$ticket->getPriority()] - $daysPassed;
					// If days left is three or less and it has not been closed yet, we must warn user.
					$result['tickets'][$key]['warn'] = $daysLeft <= 3  && $ticket->getState() != "Cerrado" ? true : false;
					$result['tickets'][$key]['daysLeft'] = $daysLeft < 0 ? 0 : $daysLeft;
					$result['tickets'][$key]['maxAnswerTime'] = $hashedTimes[$ticket->getType()][$ticket->getPriority()];
	         	}
	        	$result['message'] = "success";
           }
        } catch(Exception $e) {
            \ChromePhp::log($e);
            $result['message'] = "Error";
        }


         echo json_encode($result);
	 }
}
