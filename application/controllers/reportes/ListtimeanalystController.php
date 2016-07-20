<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class ListtimeanalystController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listtimeanalyst');
    }
    
	public function getAnalysts() {
		try {
    		
    		$em = $this->doctrine->em;
    		$qb = $em->createQueryBuilder();
    		$analysts = $qb ->select('a')
    			->from('\Entity\Users', 'a')
    			->where('a.type <= 3')
    			->getQuery()->getResult();
    		foreach($analysts as $key=>$analyst) {
    			$result['data'][$key]['id'] = $analyst->getId();
    			$result['data'][$key]['name'] = $analyst->getName(). " " . $analyst->getLastName();
    		}
    		$result['message'] = "success";
    	}catch(Exception $e){
    		\ChromePhp::log($e);
    		$result['message'] = "error";
    	}
    	echo json_encode($result);
	}
	
	public function getTicketsForAnalyst() {
		try {
		    $startTime = date_create_from_format('d/m/Y',$_GET['from'] );
		    $endTime = date_create_from_format('d/m/Y',$_GET['to'] );
		    $result['atendidas'] = 0;
		    $result['enEspera'] = 0;
		    $result['excedidas'] =0;
		    $em = $this->doctrine->em;
		    $analyst = $em->find('\Entity\Users', $_GET['id']);
		    $qb = $em->createQueryBuilder();
		    $tickets = $qb-> select('t')
		    	->from('\Entity\Ticket', 't')
		    	->where('t.userAssigned = :analyst')
		    	->setParameter('analyst', $analyst)
		    	->andWhere('t.submitDate BETWEEN :start AND :end')
		    	->setParameter('start', $startTime)
		    	->setParameter('end', $endTime)
		    	->getQuery()->getResult();
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
				if($tickets != null) {
	            	foreach($tickets as $key => $ticket) {
	            	
	         		$result['tickets'][$key]['id'] = $ticket->getId();
	         		$result['tickets'][$key]['paddedId'] = sprintf('%06d', $ticket->getId());
	         		$result['tickets'][$key]['subject'] = $ticket->getSubject();
	         		$result['tickets'][$key]['description'] = $ticket->getDescription();
	         		$result['tickets'][$key]['type'] = $ticket->getType();
	         		$result['tickets'][$key]['level'] = $ticket->getLevel();
	         		$result['tickets'][$key]['priority'] = $ticket->getPriority();
	         		$result['tickets'][$key]['answerTime'] = $result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime() !== null ? $ticket->getAnswerTime() . "d / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d" : "- / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d";
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
					
					if($ticket->getState() == "Cerrado") {
	         			$result['enEspera'] = $result['enEspera'] + 1 ; 
	         		}else if($ticket->getState() == "Cerrado") {
	         			$result['atendidas'] = $result['atendidas'] + 1;
	         		}
	         		
	         		if($ticket->getCloseDate() != null) {
	         			$closeDate = $ticket->getCloseDate();
						$interval = $ticket->getSubmitDate()->diff($closeDate); 
						if($interval->format("%a") >  $result['tickets'][$key]['maxAnswerTime'] ) {
							$result['excedidas'] = $result['excedidas'] + 1 ;
						}
	         		}else {
						$interval = $ticket->getSubmitDate()->diff($currentDate);
						$daysPassed = $interval->format("%a");
						if($interval->format("%a") >  $result['tickets'][$key]['maxAnswerTime'] ) {
							$result['excedidas'] = $result['excedidas'] + 1 ;
						}
	         		}
		         	
	            }
	            	$result['todas'] = count($result['tickets']);
	            
				}
				$result['message'] = "success";
            }
		}catch(Exception $e){
			\ChromePhp::log($e);
				$result['message'] = "Error";
		}
			
		
			echo json_encode($result);
	}
	
	
}