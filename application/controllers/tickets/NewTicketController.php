<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class NewTicketController extends CI_Controller {
    
    public function index() {
        $this->load->view('tickets/newTicket');
    }
    
    public function getConfigutarion() {
        
        try{
            $em = $this->doctrine->em;
            $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

            if($config != null){
                foreach(explode(',', $config->getStates()) as $key=>$state){
                    $result['states'][$key] = $state;
                }
                foreach(explode(',', $config->getTypes()) as $key=>$type){
                    $result['types'][$key] = $type;
                }
                foreach(explode(',', $config->getLevels()) as $key=>$level){
                    $result['levels'][$key] = $type;
                }
                foreach(explode(',', $config->getPriorities()) as $key=>$priority){
                    $result['priorities'][$key] = $priority;
                }
                 foreach(explode(',', $config->getQualityOfServices()) as $key=>$qualityOfService){
                    $result['qualityOfService'][$key] = $qualityOfService;
                }
                $result['message'] = "success";
            }            
            
        }catch(Exception $e){
            \ChromePhp::log($e);
             $result['message']="error";
        }
        \ChromePhp::log($result);
        echo json_encode($result);
    }
}