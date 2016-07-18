<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class ListticketsController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listtickets');
    }
    
    public function ListTickets(){
            
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
			/*
        	$em = $this->doctrine->em;
        	$tickets = $em->getRepository('\Entity\Ticket')->findAll();
            
            /*if (!$tickets) {
                $result['message']="Error, no se encuentran tickets en la base de datos";
        	}else
    		{
    		    $result['message']="success";
        	    $result['tickets']=$tickets->getResult();
    		    
    		}*/
    		//print_r($tickets);
			//echo json_encode($result);
		}
}