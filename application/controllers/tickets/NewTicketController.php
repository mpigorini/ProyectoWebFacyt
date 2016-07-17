<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class NewTicketController extends CI_Controller {

    public function index() {
        $this->load->view('tickets/newTicket');
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
                $result['message'] = "success";

            }

        }catch(Exception $e){
            \ChromePhp::log($e);
             $result['message']="error";
        }

        echo json_encode($result);
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

    public function saveTicket() {
       
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
            $ticket->setState($_GET['state']);
            $ticket->setPriority($_GET['priority']);
            $ticket->setUserReporter($user);
            $ticket->setDepartment($_GET['department']);
            // Set submit date as today
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
