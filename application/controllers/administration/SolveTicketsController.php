<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class SolveTicketsController extends CI_Controller {

    	/**
    	 * Load ticket solving view
    	 */
    	public function index()
    	{
    		$this->load->view('administration/solveTickets');
    	}

        public function getStates() {

            try{
                $em = $this->doctrine->em;
                $config = $em->getRepository('\Entity\TicketType')->findOneBy(array("active"=>true));

                if($config != null) {
                    // Get current config types and priorities
                    $types = explode(',', $config->getTypes());
                    $priorities = explode(',', $config->getPriorities());
                    // Get all max answer times
                    $maxAnswerTimes = $config->getMaxAnswerTimes();
                    // Pre-process max answer times: Put all of em into a single array
                    $temp = array();
                    foreach ($maxAnswerTimes as $maxAnswerTime) {
                        array_push($temp, $maxAnswerTime->getMaxTime());
                    }
                    // Store each max time in a hashed max answer time structures
                    $counter = 0;
                    foreach($types as $tKey => $type) {
                         foreach($priorities as $pKey => $priority) {
                            $hashedTimes[$type][$priority] = $temp[$counter];
                            $counter++;
                        }
                    }
                    // Store current config created tickets for each state
                    foreach(explode(',', $config->getStates()) as $key=>$state) {
                        $result['states'][$key]['name'] = $state;
                        $tickets = $em->getRepository('\Entity\Ticket')->findBy(array("state"=>$state));
                        foreach($tickets as $keyTicket => $ticket) {
                            // This view is accessed by technicians and above type users only, so...
                            // only store tickets that were assigned to this particular user.
                            if ($ticket->getUserAssigned() !== null && $ticket->getUserAssigned()->getId() == $_GET['userId']) {
                                $result['states'][$key]['table'][$keyTicket]['id'] = $ticket->getId();
                                $result['states'][$key]['table'][$keyTicket]['paddedId'] = sprintf('%06d', $ticket->getId());
                                $result['states'][$key]['table'][$keyTicket]['subject'] = $ticket->getSubject();
                                $result['states'][$key]['table'][$keyTicket]['description'] = $ticket->getDescription();
                                $result['states'][$key]['table'][$keyTicket]['type'] = $ticket->getType();
                                $result['states'][$key]['table'][$keyTicket]['level'] = $ticket->getLevel();
                                $result['states'][$key]['table'][$keyTicket]['priority'] = $ticket->getPriority();
                                $result['states'][$key]['table'][$keyTicket]['answerTime'] = $ticket->getAnswerTime() !== null ? $ticket->getAnswerTime() . "d / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d" : "- / " . $hashedTimes[$ticket->getType()][$ticket->getPriority()] . "d";
                                $result['states'][$key]['table'][$keyTicket]['qualityOfService'] = $ticket->getQualityOfService();
                                //Load user
                                $result['states'][$key]['table'][$keyTicket]['userReporter']['id'] = $ticket->getUserReporter()->getId();
                                $result['states'][$key]['table'][$keyTicket]['userReporter']['name'] = $ticket->getUserReporter()->getName();
                                //Load user assigned
                                if($ticket->getUserAssigned() != null ) {
                                   $result['states'][$key]['table'][$keyTicket]['userAssigned']['id'] = $ticket->getUserAssigned()->getId();
                                   $result['states'][$key]['table'][$keyTicket]['userAssigned']['showName'] = $ticket->getUserAssigned()->getName() ." " . $ticket->getUserAssigned()->getLastName();
                                }
                                $result['states'][$key]['table'][$keyTicket]['department'] = $ticket->getDepartment();
                                $result['states'][$key]['table'][$keyTicket]['submitDate'] =$ticket->getSubmitDate();
                                $result['states'][$key]['table'][$keyTicket]['closeDate'] = $ticket->getCloseDate();
                                $result['states'][$key]['table'][$keyTicket]['state'] = $ticket->getState();
                                $result['states'][$key]['table'][$keyTicket]['solutionDescription'] = $ticket->getSolutionDescription();
                                $result['states'][$key]['table'][$keyTicket]['evaluation'] = $ticket->getEvaluation();
                                // Determine how many days are left and whether we should warn user about it
                                $currentDate = new \DateTime('now');
                                $interval = $ticket->getSubmitDate()->diff($currentDate);
                                $daysPassed = $interval->format("%a");
                                $daysLeft = $hashedTimes[$ticket->getType()][$ticket->getPriority()] - $daysPassed;
                                // If days left is three or less and it has not been closed yet, we must warn user.
                                $result['states'][$key]['table'][$keyTicket]['warn'] = $daysLeft <= 3  && $ticket->getState() != "Cerrado" ? true : false;
                                $result['states'][$key]['table'][$keyTicket]['daysLeft'] = $daysLeft < 0 ? 0 : $daysLeft;
                            }
                        }
                    }
                    // Put all tickets (regardless of state) from current configuration in a single container
                    $counter = 0;
                    foreach ($result['states'] as $state) {
                        if (isset($state['table'])) {
                            foreach ($state['table'] as $table) {
                                $result['tickets'][$counter] = $table;
                                $counter++;
                            }
                        }
                    }
                    $result['message'] = "success";

                }

            }catch(Exception $e){
                \ChromePhp::log($e);
                 $result['message']="error";
            }

            echo json_encode($result);
        }
}
