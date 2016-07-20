<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class ListtimeController extends CI_Controller {

    public function index() {
       $this->load->view('reportes/listtime');
    }

    public function getTicketsForDate()
	{
		try {

		    \ChromePhp::log($_GET);
			$startTime = date_create_from_format('d/m/Y',$_GET['from'] );
		    $endTime = date_create_from_format('d/m/Y',$_GET['to'] );
		    \ChromePhp::log($startTime);
		    \ChromePhp::log($endTime);
		    $result['atendidas'] = 0;
		    $result['enEspera'] = 0;
		    $result['excedidas'] = 0;
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT t FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2');
            $query->setParameter(1, $startTime);
            $query->setParameter(2, $endTime);
            $tickets = $query->getResult();

            foreach($tickets as $key => $ticket) {

         		$result['tickets'][$key]['id'] = $ticket->getId();
         		$result['tickets'][$key]['paddedId'] = sprintf('%06d', $ticket->getId());
         		$result['tickets'][$key]['subject'] = $ticket->getSubject();
         		$result['tickets'][$key]['description'] = $ticket->getDescription();
         		$result['tickets'][$key]['type'] = $ticket->getType();
         		$result['tickets'][$key]['level'] = $ticket->getLevel();
         		$result['tickets'][$key]['priority'] = $ticket->getPriority();
                $result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime() !== null ? $ticket->getAnswerTime() . "d / " . $ticket->getMaxAnswerTime() . "d" : "- / " . $ticket->getMaxAnswerTime() . "d";
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

				if($ticket->getState() != "Cerrado") {
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
            $result['todas'] = isset($result['tickets']) ? count($result['tickets']) : '-';
			$result['message'] = "success";

		}catch(Exception $e){
			\ChromePhp::log($e);
				$result['message'] = "Error";
		}


			echo json_encode($result);

	}
}
