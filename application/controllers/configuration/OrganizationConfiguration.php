<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');

class OrganizationConfiguration extends CI_Controller {
    
    public function index() {
        $this->load->view('configuration/organizationConfig');
    }
    
    public function getAllDepartments() {
        try {
            $em = $this->doctrine->em;
            $departments = $em->getRepository('\Entity\Department')->findAll();
            
            $result['departments'] = array();
            foreach ($departments as $department) {
                $result['deparments'][] = array(
                    'id' => $department->getId(),
                    'name' => $department->getName(),
                    'description' => $department->getDescription(),
                    'positions' => $department->getPositions()
                );
                $result['here'] = "yes";
            }
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }

        echo json_encode($result);
    }
}