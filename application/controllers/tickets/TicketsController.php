<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsController extends CI_Controller {


	/**
	 * Load ticket administration view
	 */
	public function index()
	{
		$data['state'] = $this->state();
		$this->load->view('tickets/tickets',$data);
	}


		public function state(){
			$result = array();
			$em = $this->doctrine->em;
			$user = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>'1'));
			if($user != null)
			{
					$result = explode(',', $user->getStates());
					foreach ($result as $key => $value) {
						$result[$key] = trim($value);
					}
			}
			return($result);
		}

		public function listTicket()
		{
			try {
					$em = $this->doctrine->em;
					$query = $em->createQuery('SELECT t FROM \Entity\Ticket t');
					$tickets = $query->getResult(); // array de objetos User
					$result['message'] = "success";
					foreach ($tickets as $key => $value) {
						$list_tickets[$key]['subject'] = $value->getSubject();
						$list_tickets[$key]['description'] = $value->getDescription();
						$list_tickets[$key]['type'] = $value->getType();
						$list_tickets[$key]['level'] = $value->getLevel();
						$list_tickets[$key]['priority'] = $value->getPriority();
						$list_tickets[$key]['answerTime'] = $value->getAnswerTime();
						$list_tickets[$key]['qualityOfService'] = $value->getQualityOfService();
						$list_tickets[$key]['userReporter'] = $value->getUserReporter();
						$list_tickets[$key]['deparment'] = $value->getDepartment();
						$list_tickets[$key]['submitDate'] = date_format($value->getSubmitDate(),'m-d-Y');
						$list_tickets[$key]['closeDate'] = date_format($value->getCloseDate(),'m-d-Y');
						$list_tickets[$key]['state'] = $value->getState();
						$list_tickets[$key]['solutionDescription'] = $value->getSolutionDescription();
						$list_tickets[$key]['evaluation'] = $value->getevaluation();
						$list_tickets[$key]['observations'] = $value->getObservations();
					}
					$result['tickets'] = $list_tickets;
			}catch(Exception $e){
					$result['message'] = "Error";
			}
			echo json_encode($result);
		}
}
