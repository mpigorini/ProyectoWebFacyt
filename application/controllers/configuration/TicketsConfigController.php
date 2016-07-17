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
            $result['data'] = [];
            foreach($ticketTypes as $key=>$ticketType){
                $result['data'][$key]['id'] = $ticketType->getId();
                $result['data'][$key]['name'] = $ticketType->getName();
                $result['data'][$key]['states'] = explode(',', $ticketType->getStates());
                $result['data'][$key]['types'] = explode(',', $ticketType->getTypes());
                $result['data'][$key]['levels'] = explode(',', $ticketType->getLevels());
                $result['data'][$key]['priorities'] =  explode(',', $ticketType->getPriorities());
                $result['data'][$key]['qualityOfServices'] =  explode(',', $ticketType->getQualityOfServices());
                // $maxAnswerTimes = $ticketType->getMaxAnswerTimes();
                // foreach($result['data'][$key]['types'] as $tKey => $type) {
                //     foreach($result['data'][$key]['priorities'] as $pKey => $priority) {
                //         foreach ($maxAnswerTimes a $mKey => $maxAnswerTime) {
                //             $result['data'][$key]['maxAnswerTimes'][$tKey][$pKey][$mKey] = $maxAnswerTime->getMaxTime();
                //         }
                //     }
                // }
                // \ChromePhp::log($result['data'][$key]['maxAnswerTimes']);
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
                // $ticketType->setMaxAnswerTimes( $_GET['answerTimes']);
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
                // $ticketType->setAnswerTimes( $_GET['answerTimes']);
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

    public function setAsActive() {
        try{
            $em = $this->doctrine->em;
            // Set selected config as active
            $ticketType = $em->find('\Entity\TicketType', $_GET['id']);
            $ticketType->setActive(true);
            // Set previous config as unactive, if there was any.
            $oldId = $_GET['oldId'];
            if ($oldId != -1) {
                $oldTicketType = $em->find('\Entity\TicketType', $oldId);
                $oldTicketType->setActive(false);
                $em->merge($oldTicketType);
                $em->persist($oldTicketType);
            }
            // Persist changes
            $em->merge($ticketType);
            $em->persist($ticketType);
            $em->flush();
            $result['message'] = "success";
        }catch(Exception $e){
             $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
    }
}
