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
                $result['data'][$key]['active'] = $ticketType->getActive();
                // Get all max answer times
                $maxAnswerTimes = $ticketType->getMaxAnswerTimes();
                // Pre-process max answer times: Put all of em into a single array
                $temp = array();
                foreach ($maxAnswerTimes as $maxAnswerTime) {
                    array_push($temp, $maxAnswerTime->getMaxTime());
                }
                // Store each max time into it's corresponding structure, which will be used in UI
                $counter = 0;
                foreach($result['data'][$key]['types'] as $tKey => $type) {
                     foreach($result['data'][$key]['priorities'] as $pKey => $priority) {
                        $result['data'][$key]['maxAnswerTimes'][$tKey][$pKey] = $temp[$counter];
                        $counter++;
                    }
                }
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
            // Decode max answer times and convert back to array
            $times = json_decode($_GET['maxAnswerTimes'], true);
            if(isset($_GET['id']) ) {
                // Update existing ticket type
                $ticketType = $em->find('\Entity\TicketType', $_GET['id']);
                $ticketType->setName( $_GET['name']);
                $ticketType->setStates( $_GET['states']);
                $ticketType->setTypes( $_GET['types']);
                $ticketType->setLevels( $_GET['levels']);
                $ticketType->setPriorities( $_GET['priorities']);
                $ticketType->setQualityOfServices($_GET['qualityOfServices']);
                // Pre-process max answer times: Put all of em into a single array
                $temp = array();
                foreach(explode(',', $_GET['types']) as $tKey => $type) {
                     foreach(explode(',', $_GET['priorities']) as $pKey => $priority) {
                        array_push($temp, $times[$tKey][$pKey]);
                    }
                }
                // Update all max answer times for this ticket type
                $maxAnswerTimes = $ticketType->getMaxAnswerTimes();
                foreach ($maxAnswerTimes as $mKey => $maxAnswerTime) {
                    $maxAnswerTime->setMaxTime($temp[$mKey]);
                    $em->merge($maxAnswerTime);
                }
                $em->merge($ticketType);
                $em->persist($ticketType);
                $em->flush();
                $result['newConfigId'] = $ticketType->getId();
            }else {
                // Create new ticket type
                $ticketType = new \Entity\TicketType();
                $ticketType->setName( $_GET['name']);
                $ticketType->setStates( $_GET['states']);
                $ticketType->setTypes( $_GET['types']);
                $ticketType->setLevels( $_GET['levels']);
                $ticketType->setPriorities( $_GET['priorities']);
                $ticketType->setQualityOfServices($_GET['qualityOfServices']);
                $ticketType->setActive(false);
                // Save all max answer times
                foreach(explode(',', $_GET['types']) as $tKey => $type) {
                     foreach(explode(',', $_GET['priorities']) as $pKey => $priority) {
                        $maxAnswerTime = new \Entity\MaxAnswerTime();
                        $maxAnswerTime->setIncidentPriority($priority);
                        $maxAnswerTime->setIncidentType($type);
                        $maxAnswerTime->setMaxTime($times[$tKey][$pKey]);
                        $maxAnswerTime->setTicketType($ticketType);
                        $ticketType->addMaxAnswerTime($maxAnswerTime);
                        $em->persist($maxAnswerTime);
                    }
                }
                $em->persist($ticketType);
                $em->flush();
                $result['newConfigId'] = $ticketType->getId();
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
