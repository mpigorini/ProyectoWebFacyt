<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsController extends CI_Controller {


	/**
	 * Load ticket administration view
	 */
	public function index() {
		$this->load->view('tickets/tickets');
	}

	// Get currently active tickets states that were created by the specified user
	public function getStates() {

		try{
            $em = $this->doctrine->em;
			// get active tickets configuration
            $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

            if($config != null) {
				// for each current config's state
                foreach(explode(',', $config->getStates()) as $key=>$state){
					// save state value
                    $result['states'][$key]['name'] = $state;
					// get all the tickets with specified state
                    $tickets = $em->getRepository('\Entity\Ticket')->findBy(array("state"=>$state));
                    foreach($tickets as $keyTicket => $ticket) {
						// Add this ticket to result only if it belongs to the specified user
						if ($ticket->getUserReporter()->getId() == $_GET['userId'])  {
							// save all the ticket info we need
			        		$result['states'][$key]['table'][$keyTicket]['id'] = $ticket->getId();
							$result['states'][$key]['table'][$keyTicket]['paddedId'] = sprintf('%06d', $ticket->getId());
			        		$result['states'][$key]['table'][$keyTicket]['subject'] = $ticket->getSubject();
			        		$result['states'][$key]['table'][$keyTicket]['description'] = $ticket->getDescription();
			        		$result['states'][$key]['table'][$keyTicket]['type'] = $ticket->getType();
			        		$result['states'][$key]['table'][$keyTicket]['level'] = $ticket->getLevel();
							$result['states'][$key]['table'][$keyTicket]['state'] = $ticket->getState();
			        		$result['states'][$key]['table'][$keyTicket]['priority'] = $ticket->getPriority();
			        		$result['states'][$key]['table'][$keyTicket]['answerTime'] = $ticket->getAnswerTime();
			        		$result['states'][$key]['table'][$keyTicket]['qualityOfService'] = $ticket->getQualityOfService();
			        	    // Load assigned user
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

	public function getActiveQoS() {

        try{
            $em = $this->doctrine->em;
            $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

            if($config != null){
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
                $ticket->setState($_GET['state']);
                $ticket->setSolutionDescription(isset($_GET['solutionDescription']) ? $_GET['solutionDescription'] : "" );
                $ticket->setObservations(isset($_GET['observations']) ? $_GET['observations'] : "");
                $ticket->setQualityOfService(isset($_GET['qualityOfService'] ) ? $_GET['qualityOfService'] : "");
                $ticket->setEvaluation(isset($_GET['evaluation']) ? $_GET['evaluation'] : "");
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
