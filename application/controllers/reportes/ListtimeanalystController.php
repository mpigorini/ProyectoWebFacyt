<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListtimeanalystController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listtimeanalyst');
    }
    
    public function TicketsFiltered(){
            
            
            
            $_GET['StartTime'];
            $_GET['EndTime'];
        	
        	$em = $this->doctrine->em;
        	$user = $em->getRepository('\Entity\Users')->findOneBy(array("name"=>$_GET['Analyst']));
            
            $product = $em->getRepository('\Entity\Ticket')->findAll();
            //$result=$product->getTicketsAssigneds();
            /*try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT u.tickets FROM \Entity\Users u WHERE u.name=:analyst');
		    $query->setParameter('analyst', $_GET['Analyst']);
		    
            $userID = $query->getResult()->getTickets();
            //$UserID2=array_shift($userID);
			}catch(Exception $e){
				\ChromePhp::log($e);
					$result['message'] = "Error";
			}
			print_r($userID);
			
            /*try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT t.us FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);

            $countTickets = $query->getResult();
            print_r($countTickets);
            /*
            $countTickets2=array_shift($countTickets);
			$result['message'] = "success";
		    $result['tickets'] = $countTickets2[1];
		    
			}catch(Exception $e){
				\ChromePhp::log($e);
				print_r($e);
					//$result['message'] = "Error";
			}/*
			try {
		    $em = $this->doctrine->em;
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status AND t.user_id=:analyst');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $query->setParameter('status','atendido');
            $query->setParameter('analyst', $_GET['Analyst']);
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
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status AND t.user_id=:analyst' );
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $query->setParameter('status','espera');
            $query->setParameter('analyst', $_GET['Analyst']);
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
		    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status AND t.user_id=:analyst');
            $query->setParameter(1, $_GET['StartTime']);
            $query->setParameter(2, $_GET['EndTime']);
            $query->setParameter('status','exedido');
            $query->setParameter('analyst', $_GET['Analyst']);
            $countTickets = $query->getResult();
            $countTickets2=array_shift($countTickets);
			$result['message'] = "success";
		    $result['exedidos'] = $countTickets2[1];
			}catch(Exception $e){
				\ChromePhp::log($e);
					$result['message'] = "Error";
			}*/
			
			print_r($product);
			//echo json_encode($userID);
		}
}