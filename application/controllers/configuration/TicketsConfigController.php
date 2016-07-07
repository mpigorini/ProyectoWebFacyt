<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class TicketsConfigController extends CI_Controller {
    
    public function index() {
        $this->load->view('configuration/ticketsConfig');
    }
    
    public function getTicketTypes(){
        
        try{
            $em = $this->doctrine->em;
            
            $qb = $em->createQueryBuilder();
            
            $ticketTypes = $qb->select('Tt')
                            ->from('\Entity\TicketType' , 'Tt')
                            ->getQuery()
                            ->getResult()
                            ;
            foreach($ticketTypes as $key=>$ticketType){
                $result['data'][$key]['id'] = $ticketType->getId();
                $result['data'][$key]['name'] = $ticketType->getName();
                $result['data'][$key]['states'] = $ticketType->getStates();
                $result['data'][$key]['types'] = $ticketType->getTypes();
                $result['data'][$key]['levels'] = $ticketType->getLevels();
                $result['data'][$key]['priorities'] =  $ticketType->getPriorities();
                $result['data'][$key]['answerTimes'] = $ticketType->getAnswerTimes();
                $result['data'][$key]['active'] = $ticketType->getActive();
            }
            
            $result['message'] = "success";
        }catch(Exception $e){
            $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
        
    }
    
    public function save(){
        
        try{
            
            $em = $this->doctrine->em;
            if(isset($_GET['id']) ) {
                $ticketType = $em->find('\Entity\TicketType', $_GET['id']);   
                $ticketType->setName( $_GET['name']);
                $ticketType->setStates( $_GET['states']);
                $ticketType->setTypes( $_GET['types']);
                $ticketType->setLevels( $_GET['levels']);
                $ticketType->setPriorities( $_GET['priorities']);
                $ticketType->setAnswerTimes( $_GET['answerTimes']);
                $em->merge($ticketType);
                $em->persist($ticketType);
                $em->flush();
            }else {
                $ticketType = new \Entity\TicketType();
                $ticketType->setName( $_GET['name']);
                $ticketType->setStates( $_GET['states']);
                $ticketType->setTypes( $_GET['types']);
                $ticketType->setLevels( $_GET['levels']);
                $ticketType->setPriorities( $_GET['priorities']);
                $ticketType->setAnswerTimes( $_GET['answerTimes']);
                $ticketType->setQualityOfServices('aqsadsad');
                $ticketType->setActive(false);
                $em->persist($ticketType);
                $em->flush();
            }
            $result['message'] = "success";
        }catch(Exception $e){
             $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
    }
    
    public function delete() {
       
       try{
           
           $em = $this->doctrine->em;
           $entity = $em->find('\Entity\TicketType', $_GET['id']);
           $em->remove($entity);
           $em->flush();
           $result['message']="success";
       }catch(Exception $e) {
           \ChromePhp::log($e);
        $result['message'] = "error";
       }
        echo json_encode($result);
    }
}