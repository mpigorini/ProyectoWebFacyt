<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class NewTicketController extends CI_Controller {
    
    public function index() {
        $this->load->view('tickets/newTicket');
    }
    
    public function getAllDepartments() {
        try {
            $em = $this->doctrine->em;
            $departments = $em->getRepository('\Entity\Department')->findAll();
            
            foreach ($departments as $key=>$department) {
                // We only need id and name for this purpose
                $result['data'][$key]['id'] = $department->getId();
                $result['data'][$key]['name'] = $department->getName();
            }
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "error";
       }

        echo json_encode($result);
    }
    
    public function getConfig() {
        try {
            /*$em = $this->doctrine->em;
            $ticketType = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>"1"));*/
            $result['data']['priority'][0] = "Baja";
            $result['data']['priority'][1] = "Normal";
            $result['data']['priority'][2] = "Alta";
            $result['data']['level'][0] = "Especialista";
            $result['data']['level'][1] = "General";
            $result['data']['type'][0] = "Hardware";
            $result['data']['type'][1] = "Software";
            $result['message'] = "success";
        } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "error";
       }
        echo json_encode($result);
    }
    
    public function saveTicket() {
        \ChromePhp::log("Ticket subject: ");
        \ChromePhp::log($_GET['subject']);
        // dont forget to add date and user reporter (with associations)
        try {
            $em = $this->doctrine->em;

            $ticket = new \Entity\Ticket();
            $user = $em->getRepository('\Entity\Users')->findOneBy(array("id"=>$_GET['user']));
            $user->addTicket($ticket);
            $ticket->setSubject($_GET['subject']);
            $ticket->setDescription($_GET['description']);
            $ticket->setType($_GET['type']);
            $ticket->setLevel($_GET['level']);
            $ticket->setPriority($_GET['priority']);
            $ticket->setUserReporter($user);
            $ticket->setDepartment($_GET['department']);
            $ticket->setSubmitDate(new \DateTime('now'));
            
            $em->persist($ticket);
            $em->merge($user);
            $em->persist($user);
            $em->flush();
            $result['message'] = "success";
        } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "error";
       }
        echo json_encode($result);
    }
}