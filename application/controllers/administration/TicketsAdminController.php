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
	
	public function getStates() {
		
		try{
            $em = $this->doctrine->em;
            $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));
	
            if($config != null){
                foreach(explode(',', $config->getStates()) as $key=>$state){
                    $result['states'][$key]['name'] = $state;
                    $tickets = $em->getRepository('\Entity\Ticket')->findBy(array("state"=>$state));
                    foreach($tickets as $keyTicket => $ticket) {
		        		$result['states'][$key]['table'][$keyTicket]['id'] = $ticket->getId();
		        		$result['states'][$key]['table'][$keyTicket]['subject'] = $ticket->getSubject();
		        		$result['states'][$key]['table'][$keyTicket]['description'] = $ticket->getDescription();
		        		$result['states'][$key]['table'][$keyTicket]['type'] = $ticket->getType();
		        		$result['states'][$key]['table'][$keyTicket]['level'] = $ticket->getLevel();
		        		$result['states'][$key]['table'[$keyTicket]]['priority'] = $ticket->getPriority();
		        		$result['states'][$key]['table'][$keyTicket]['answerTime'] = $ticket->getAnswerTime();
		        		$result['states'][$key]['table'][$keyTicket]['qualityOfService'] = $ticket->getQualityOfService();
		        		//Load user 
		        			$result['states'][$key]['table'][$keyTicket]['userReporter']['id'] = $ticket->getUserReporter()->getId();
		        			$result['states'][$key]['table'][$keyTicket]['userReporter']['name'] = $ticket->getUserReporter()->getName();
		        		$result['states'][$key]['table'][$keyTicket]['department'] = $ticket->getDepartment();
		        		$result['states'][$key]['table'][$keyTicket]['submitDate'] =$ticket->getSubmitDate();
		        		$result['states'][$key]['table'][$keyTicket]['closeDate'] = $ticket->getCloseDate();
		        		$result['states'][$key]['table'][$keyTicket]['state'] = $ticket->getState();
		        		$result['states'][$key]['table'][$keyTicket]['solutionDescription'] = $ticket->getSolutionDescription();
		        		$result['states'][$key]['table'][$keyTicket]['evaluation'] = $ticket->getEvaluation();
		        		$result['states'][$key]['table'][$keyTicket]['observation'] = $ticket->getObservations();
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
	public function getTickets() {
	     try {
            
            $em = $this->doctrine->em;
            $tickets = $em->getRepository('\Entity\Ticket')->findAll();
            
        	foreach($tickets as $key => $ticket) {
        		$result['tickets'][$key]['id'] = $ticket->getId();
        		$result['tickets'][$key]['subject'] = $ticket->getSubject();
        		$result['tickets'][$key]['description'] = $ticket->getDescription();
        		$result['tickets'][$key]['type'] = $ticket->getType();
        		$result['tickets'][$key]['level'] = $ticket->getLevel();
        		$result['tickets'][$key]['priority'] = $ticket->getPriority();
        		$result['tickets'][$key]['answerTime'] = $ticket->getAnswerTime();
        		$result['tickets'][$key]['qualityOfService'] = $ticket->getQualityOfService();
        		//Load user 
        			$result['tickets'][$key]['userReporter']['id'] = $ticket->getUserReporter()->getId();
        			$result['tickets'][$key]['userReporter']['name'] = $ticket->getUserReporter()->getName();
        		$result['tickets'][$key]['department'] = $ticket->getDepartment();
        		$result['tickets'][$key]['submitDate'] =$ticket->getSubmitDate();
        		$result['tickets'][$key]['closeDate'] = $ticket->getCloseDate();
        		$result['tickets'][$key]['state'] = $ticket->getState();
        		$result['tickets'][$key]['solutionDescription'] = $ticket->getSolutionDescription();
        		$result['tickets'][$key]['evaluation'] = $ticket->getEvaluation();
        		$result['tickets'][$key]['observation'] = $ticket->getObservations();
        	}
        	
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       

        echo json_encode($result);
	}
	
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
}
