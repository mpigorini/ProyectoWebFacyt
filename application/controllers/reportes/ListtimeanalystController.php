<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListtimeanalystController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listtimeanalyst');
    }
    
    public function TicketsFiltered(){

        	$em = $this->doctrine->em;
        	$user = $em->getRepository('\Entity\Users')->findOneBy(array("name"=>$_GET['Analyst'],"type"=>"3"));
            
            if (!$user) {
    		 $result['message'] = "Error, analista no encontrado";
    		}else
    		{
    			$TechId=$user->getId();
		            try {
				    $em = $this->doctrine->em;
				    $query = $em->createQuery('SELECT Count(t.id),AVG(t.answerTime) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.userAssigned=:tech');
		            $query->setParameter(1, $_GET['StartTime']);
		            $query->setParameter(2, $_GET['EndTime']);
		            $query->setParameter('tech',$TechId);
				    $countTickets = $query->getResult();
		            $countTickets2=array_shift($countTickets);
					$result['message'] = "success";
				    $result['tickets'] = $countTickets2[1];
				    $result['avg'] = $countTickets2[2];
				    
					}catch(Exception $e){
						$result['message'] = "Error";
					}
					try {
				    $em = $this->doctrine->em;
				    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status AND t.userAssigned=:analyst');
		            $query->setParameter(1, $_GET['StartTime']);
		            $query->setParameter(2, $_GET['EndTime']);
		            $query->setParameter('status','atendido');
		            $query->setParameter('analyst', $TechId);
		            $countTickets = $query->getResult();
		            $countTickets2=array_shift($countTickets);
					$result['message'] = "success";
				    $result['atendidas'] = $countTickets2[1];
					}catch(Exception $e){
						    $result['message'] = "Error";
					}
					try {
				    $em = $this->doctrine->em;
				    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status AND t.userAssigned=:analyst' );
		            $query->setParameter(1, $_GET['StartTime']);
		            $query->setParameter(2, $_GET['EndTime']);
		            $query->setParameter('status','espera');
		            $query->setParameter('analyst', $TechId);
		            $countTickets = $query->getResult();
		            $countTickets2=array_shift($countTickets);
					$result['message'] = "success";
				    $result['En_espera'] = $countTickets2[1];
					}catch(Exception $e){
							$result['message'] = "Error";
					}
					try {
				    $em = $this->doctrine->em;
				    $query = $em->createQuery('SELECT COUNT(t.id) FROM \Entity\Ticket t WHERE t.submitDate BETWEEN ?1 AND ?2 AND t.state= :status AND t.userAssigned=:analyst');
		            $query->setParameter(1, $_GET['StartTime']);
		            $query->setParameter(2, $_GET['EndTime']);
		            $query->setParameter('status','exedido');
		            $query->setParameter('analyst', $TechId);
		            $countTickets = $query->getResult();
		            $countTickets2=array_shift($countTickets);
					$result['message'] = "success";
				    $result['exedidos'] = $countTickets2[1];
					}catch(Exception $e){
							$result['message'] = "Error";
					}
    		}
			echo json_encode($result);
		}
}