<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class TicketsAdminController extends CI_Controller {


	/**
	 * Load ticket administration view
	 */
	public function index()
	{
		$this->load->view('administration/manageTickets');
		// $this->load->view('welcome_message');
	}

	public function getStates() {

		try{
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
				// Store each max time in a hashed max answer times structure
				$counter = 0;
				foreach($types as $tKey => $type) {
					 foreach($priorities as $pKey => $priority) {
						$hashedTimes[$type][$priority] = $temp[$counter];
						$counter++;
					}
				}
				// Store current config created tickets for each state
                foreach(explode(',', $config->getStates()) as $key=>$state) {
                    $result['states'][$key]['name'] = $state;
                    $tickets = $em->getRepository('\Entity\Ticket')->findBy(array("state"=>$state));
                    foreach($tickets as $keyTicket => $ticket) {
		        		$result['states'][$key]['table'][$keyTicket]['id'] = $ticket->getId();
						$result['states'][$key]['table'][$keyTicket]['paddedId'] = sprintf('%06d', $ticket->getId());
		        		$result['states'][$key]['table'][$keyTicket]['subject'] = $ticket->getSubject();
		        		$result['states'][$key]['table'][$keyTicket]['description'] = $ticket->getDescription();
		        		$result['states'][$key]['table'][$keyTicket]['type'] = $ticket->getType();
		        		$result['states'][$key]['table'][$keyTicket]['level'] = $ticket->getLevel();
		        		$result['states'][$key]['table'][$keyTicket]['priority'] = $ticket->getPriority();
						$result['states'][$key]['table'][$keyTicket]['answerTime'] = $ticket->getAnswerTime() !== null ? $ticket->getAnswerTime() . "d / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d" : "- / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d";
		        		$result['states'][$key]['table'][$keyTicket]['qualityOfService'] = $ticket->getQualityOfService();
		        		//Load user
	        			$result['states'][$key]['table'][$keyTicket]['userReporter']['id'] = $ticket->getUserReporter()->getId();
	        			$result['states'][$key]['table'][$keyTicket]['userReporter']['name'] = $ticket->getUserReporter()->getName();
		        	    //Load user assigned
		        	    if($ticket->getUserAssigned() != null ) {
		        	       $result['states'][$key]['table'][$keyTicket]['userAssigned']['id'] = $ticket->getUserAssigned()->getId();
		        	       $result['states'][$key]['table'][$keyTicket]['userAssigned']['showName'] = $ticket->getUserAssigned()->getName() ." " . $ticket->getUserAssigned()->getLastName();
		        	    }
		        		$result['states'][$key]['table'][$keyTicket]['department'] = $ticket->getDepartment();
		        		$result['states'][$key]['table'][$keyTicket]['submitDate'] =$ticket->getSubmitDate();
		        		$result['states'][$key]['table'][$keyTicket]['closeDate'] = $ticket->getCloseDate();
		        		$result['states'][$key]['table'][$keyTicket]['state'] = $ticket->getState();
		        		$result['states'][$key]['table'][$keyTicket]['solutionDescription'] = $ticket->getSolutionDescription();
		        		$result['states'][$key]['table'][$keyTicket]['evaluation'] = $ticket->getEvaluation();
						// Determine how many days are left and whether we should warn user about it
						$currentDate = new \DateTime('now');
						$interval = $ticket->getSubmitDate()->diff($currentDate);
						$daysPassed = $interval->format("%a");
						$daysLeft = $hashedTimes[$ticket->getType()][$ticket->getPriority()] - $daysPassed;
						// If days left is three or less and it has not been closed yet, we must warn user.
						$result['states'][$key]['table'][$keyTicket]['warn'] = $daysLeft <= 3  && $ticket->getState() != "Cerrado" ? true : false;
						$result['states'][$key]['table'][$keyTicket]['daysLeft'] = $daysLeft < 0 ? 0 : $daysLeft;
		        	}
                }
				// Put all tickets (regardless of state) from current configuration in a single container
				$counter = 0;
				foreach ($result['states'] as $state) {
					if (isset($state['table'])) {
						foreach ($state['table'] as $table) {
							$result['tickets'][$counter] = $table;
							$counter++;
						}
					}
				}
                $result['message'] = "success";

            }

        }catch(Exception $e){
            \ChromePhp::log($e);
             $result['message']="error";
        }

        echo json_encode($result);
	}
	// public function getTickets() {
	//      try {
	//
    //         $em = $this->doctrine->em;
    //         $tickets = $em->getRepository('\Entity\Ticket')->findAll();
	//
    //     	foreach($tickets as $key => $ticket) {
    //     		$result['tickets'][$key]['id'] = $ticket->getId();
    //     		$result['tickets'][$key]['subject'] = $ticket->getSubject();
    //     		$result['tickets'][$key]['description'] = $ticket->getDescription();
    //     		$result['tickets'][$key]['type'] = $ticket->getType();
    //     		$result['tickets'][$key]['level'] = $ticket->getLevel();
    //     		$result['tickets'][$key]['priority'] = $ticket->getPriority();
    //     		$result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime();
    //     		$result['tickets'][$key]['qualityOfService'] = $ticket->getQualityOfService();
    //     		// Load user
    // 			$result['tickets'][$key]['userReporter']['id'] = $ticket->getUserReporter()->getId();
    // 			$result['tickets'][$key]['userReporter']['name'] = $ticket->getUserReporter()->getName();
	// 		   // Load user assigned
    //     	    if($ticket->getUserAssigned() != null ) {
    //     	        $result['tickets'][$key]['userAssigned']['id'] = $ticket->getUserAssigned()->getId();
    //     	        $result['tickets'][$key]['userAssigned']['showName'] =$ticket->getUserAssigned()->getName() ." " .$ticket->getUserAssigned()->getLastName() ;
    //     	    }
    //     		$result['tickets'][$key]['department'] = $ticket->getDepartment();
    //     		$result['tickets'][$key]['submitDate'] =$ticket->getSubmitDate();
    //     		$result['tickets'][$key]['closeDate'] = $ticket->getCloseDate();
    //     		$result['tickets'][$key]['state'] = $ticket->getState();
    //     		$result['tickets'][$key]['solutionDescription'] = $ticket->getSolutionDescription();
    //     		$result['tickets'][$key]['evaluation'] = $ticket->getEvaluation();
    //     	}
	//
    //         $result['message'] = "success";
    //    } catch(Exception $e) {
    //        \ChromePhp::log($e);
    //        $result['message'] = "Error";
    //    }
	//
	//
    //     echo json_encode($result);
	// }

	public function getConfiguration() {

        try{
            $em = $this->doctrine->em;
            $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

            if($config != null){
                // Only need these three to create a new ticket.
                foreach(explode(',', $config->getTypes()) as $key=>$type){
                    $result['types'][$key] = $type;
                }
                foreach(explode(',', $config->getLevels()) as $key=>$level){
                    $result['levels'][$key] = $level;
                }
                foreach(explode(',', $config->getPriorities()) as $key=>$priority){
                    $result['priorities'][$key] = $priority;
                }
                 foreach(explode(',', $config->getStates()) as $key=>$state){
                    $result['states'][$key] = $state;
                }
                 foreach(explode(',', $config->getQualityOfServices()) as $key=>$qualityOfServices){
                    $result['qualityOfServices'][$key] = $qualityOfServices;
                }

                $result['message'] = "success";

            }

        }catch(Exception $e){
            \ChromePhp::log($e);
             $result['message']="error";
        }

        echo json_encode($result);
    }

    public function save() {

        try {
            \ChromePhp::log($_GET);
            $em = $this->doctrine->em;

            $ticket = $em->find('\Entity\Ticket' , $_GET['id']);
            if($ticket != null) {
				if ($ticket->getState() == "Cerrado" && $_GET['state'] != "Cerrado") {
					// Re-opening ticket.
					// Reset answer time from ticket.
					$ticket->setAnswerTime(null);
					// Reset closing date
					$ticket->setCloseDate(null);
				} else if ($_GET['state'] == "Cerrado" && $ticket->getState() != "Cerrado") {
					// Closing ticket!
					// Set answer time (in days) for ticket resolution.
					$today = new \DateTime('now');
					\ChromePhp::log($today->diff($ticket->getSubmitDate())->format("%a"));
					$ticket->setAnswerTime($today->diff($ticket->getSubmitDate())->format("%a"));
					// Set closing date
					$ticket->setCloseDate($today);
					// TODO: SENT EMAIL TO USER - TICKET CLOSED!
				}
                $ticket->setState($_GET['state']);
                $ticket->setSolutionDescription(isset($_GET['solutionDescription']) ? $_GET['solutionDescription'] : "" );
                if(isset($_GET['userAssigned'])) {
                    $userAssigned = json_decode( $_GET['userAssigned']);
                    $userAssigned = $em->find('\Entity\Users', $userAssigned->id);
                    $ticket->setUserAssigned($userAssigned);
                }

                $em->merge($ticket);
                $em->persist($ticket);
                $em->flush();
                $result['message'] = "success";
            }
        }catch(Exception $e) {
            \ChromePhp::log($e);
            $result['message'] = "error";
        }

        echo json_encode($result);
    }
}
