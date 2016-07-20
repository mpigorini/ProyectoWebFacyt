<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListsatisfactionController extends CI_Controller {
    
    public function index() {
       $this->load->view('reportes/listsatisfaction');
    }
    
    public function getStatics() {
        
        try {
            
            $result['undf'] = 0;
            $result['todas'] = 0;
            $flag =false;
            $em = $this->doctrine->em;
            $tickets =  $em->getRepository('\Entity\Ticket')->findAll();
            $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));
            $qualityOfServices = explode(',', $config->getQualityOfServices());
            foreach($qualityOfServices as $keyQ => $QoS) {
                $result['static'][$keyQ]['value'] = 0;
                $result['static'][$keyQ]['name'] = $QoS;
            }
            foreach($tickets as $key => $ticket) {
                foreach($qualityOfServices as $keyQ => $QoS) { 
                   if($ticket->getQualityOfService() == $QoS) {
                       $result['static'][$keyQ]['value'] = $result['static'][$keyQ]['value'] + 1;
                       $flag = true;
                   }
                }
                if(!$flag) {
                    $result['undf'] =  $result['undf'] + 1 ;
                }
                else {
                    $flag = false;
                }
                
                 $result['todas'] =  $result['todas'] + 1 ;
            }
            $result['message']="success";
        }catch(Exception $e) {
            \ChromePhp::log($e);
            $result['message']="error";
        }
        
        echo json_encode($result);
    }
   
}