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
                $result['type']= $user->getType();
           }
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       echo json_encode($result);
    }

    public function editUserInfo() {
        try {
            \ChromePhp::log($_GET);
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("id"=>$_GET['id']));
           if($user !== null){
                $user->setLogin( $_GET['login'] );
                $user->setPassword( $_GET['password'] );
                $user->setName( $_GET['username'] );
                $user->setLastName( $_GET['lastname'] );
                $user->setType( $_GET['type'] );
                $result['message'] = "";
                $em->merge($user);
                $em->persist($user);
                $em->flush($user);
           }
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       echo json_encode($result);
    }
}