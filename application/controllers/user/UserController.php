<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include (APPPATH. '/libraries/ChromePhp.php');
class UserController extends CI_Controller {
    
    public function index() {
        $this->load->view('user/main');
    }

    public function userInfo() {
        try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("id"=>$_GET['id']));
           if($user !== null){
                $result['login']= $user->getLogin();
                $result['password']= $user->getPassword();
                $result['name']= $user->getName();
                $result['lastname']= $user->getLastName();
                $result['cedula']= $user->getCedula();
                $result['phone']= $user->getPhone();
                $result['type']= $user->getTypeText();
                $result['typeInt']= $user->getType();
                $result['email']= $user->getEmail();

                $pos = $user->getPosition();
                if($pos !== null){
                    $result['position']= $pos->getName();
                }else{
                    $result['position']= "ERROR";
                }

                $dep = $user->getDepartment();
                if($dep !== null){
                    $result['department']= $dep->getName();
                }else{
                    $result['department']= "ERROR";
                }

                $result['message'] = "";
           }
           $result['message'] = "success";
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       echo json_encode($result);
    }

    public function editUserInfo() {
        try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("id"=>$_GET['id']));
           if($user !== null){
                $user->setPassword( $_GET['password'] );
                $user->setName( $_GET['username'] );
                $user->setLastName( $_GET['lastname'] );
                $user->setPhone( $_GET['phone'] );
                $user->setEmail( $_GET['email'] );
                $em->merge($user);
                $em->persist($user);
                $em->flush($user);
           }
           $result['message'] = "success";
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       echo json_encode($result);
    }
}