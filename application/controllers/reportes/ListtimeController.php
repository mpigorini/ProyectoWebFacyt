<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListtimeController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listtime');
    }
    public function TicketsFiltered()
		{   
		    try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $countTickets = $query->getResult();
            $countTickets2=array_shift($countTickets);
			$result['message'] = "success";
		    $result['tickets'] = $countTickets2[1];
			}catch(Exception $e){
				\ChromePhp::log($e);
					$result['message'] = "Error";
			}
			try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $query->setParameter('status','atendido');
            $countTickets = $query->getResult();
            $countTickets2=array_shift($countTickets);
			$result['message'] = "success";
		    $result['atendidas'] = $countTickets2[1];
			}catch(Exception $e){
				\ChromePhp::log($e);
					$result['message'] = "Error";
			}
			try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $query->setParameter('status','espera');
            $countTickets = $query->getResult();
            $countTickets2=array_shift($countTickets);
			$result['message'] = "success";
		    $result['En_espera'] = $countTickets2[1];
			}catch(Exception $e){
				\ChromePhp::log($e);
					$result['message'] = "Error";
			}
			try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $query->setParameter('status','exedido');
            $countTickets = $query->getResult();
            $countTickets2=array_shift($countTickets);
			$result['message'] = "success";
		    $result['exedidos'] = $countTickets2[1];
			}catch(Exception $e){
				\ChromePhp::log($e);
					$result['message'] = "Error";
			}
			
			echo json_encode($result);
		}
}