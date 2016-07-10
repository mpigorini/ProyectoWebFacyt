<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include (APPPATH. '/libraries/ChromePhp.php');
class UsersAdminController extends CI_Controller {


	/**
	 * Load user administration view
	 */
	public function index(){
		$this->load->view('administration/manageUsers');
	}

	public function getAllUsers(){
		try {
            
            $em = $this->doctrine->em;
            $users = $em->getRepository('\Entity\Users')->findAll();
            
            foreach ($users as $key=>$user) {
                $result['data'][$key]['id'] = $user->getId();
                $result['data'][$key]['login'] = $user->getLogin();
                $result['data'][$key]['password'] = $user->getPassword();
                $result['data'][$key]['name'] = $user->getName();
                $result['data'][$key]['lastname'] = $user->getLastname();
                $result['data'][$key]['cedula'] = $user->getCedula();
                $result['data'][$key]['phone'] = $user->getPhone();
                $result['data'][$key]['type'] = $user->getTypeText();
                $result['data'][$key]['department'] = $user->getDepartment()->getName();
                $result['data'][$key]['position'] = $user->getPosition()->getName();
            }
            
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }

        echo json_encode($result);
	}

	public function saveUser() {
		try {
            $em = $this->doctrine->em;
            if( isset($_GET['id']) && !empty( $_GET['id']) ) {
            	\ChromePhp::log("entra?");
                $user = $em->find('\Entity\Users', $_GET['id']);
                $department = $em->find('\Entity\Department', $_GET['indexDepartment']);
                $position = $em->find('\Entity\Position', $_GET['indexPosition']);
                
                $user->setLogin( $_GET['login']);
                $user->setPassword( $_GET['password']);
                $user->setName( $_GET['name']);
                $user->setLastname($_GET['lastname']);
                $user->setCedula( $_GET['cedula']);
                $user->setPhone( $_GET['phone']);
                // the select options....
                $user->setDepartment( $department );
                $user->setPosition( $position );
                $user->setType( $_GET['updateType']);

                $em->merge($user);
                $em->persist($user);
                $em->flush();
            } else {
                $user = new \Entity\Users();
                $department = $em->find('\Entity\Department', $_GET['indexDepartment']);
                $position = $em->find('\Entity\Position', $_GET['indexPosition']);

                $user->setLogin( $_GET['login']);
                $user->setPassword( $_GET['password']);
                $user->setName( $_GET['name']);
                $user->setLastname($_GET['lastname']);
                $user->setCedula( $_GET['cedula']);
                $user->setPhone( $_GET['phone']);
                // the select options....
                $user->setDepartment( $department );
                $user->setPosition( $position );
                $user->setType( $_GET['updateType']);

                $em->persist($user);
                $em->flush();
            }
            $result['message'] = "success";
        } catch(Exception $e) {
            $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
	}

	public function getAllDepartments() {
        try {
            
            $em = $this->doctrine->em;
            $departments = $em->getRepository('\Entity\Department')->findAll();
            
            foreach ($departments as $key=>$department) {
                $result['data'][$key]['id'] = $department->getId();
                $result['data'][$key]['name'] = $department->getName();
                $result['data'][$key]['description'] = $department->getDescription();
                //$result['data'][$key]['positions'] = $department->getPositions();
                $positions = $department->getPositions();
                foreach ($positions as $pkey=>$position) {
                    $result['data'][$key]['positions'][$pkey]['id'] = $position->getId();
                    $result['data'][$key]['positions'][$pkey]['name'] = $position->getName();
                    $result['data'][$key]['positions'][$pkey]['description'] = $position->getDescription();
                }
            }
            
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }

        echo json_encode($result);
    }

    public function deleteUser () {
    	try {
            $em = $this->doctrine->em;
            $user = $em->find('\Entity\Users', $_GET['deleteId']);
            $em->remove($user);
            $em->flush();
            $result['message'] = "success";
        } catch (Exception $e) {
            $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
    }
}
