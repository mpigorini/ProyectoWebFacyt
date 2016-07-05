<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class LoginController extends CI_Controller {
    
    public function index() {
        $this->load->view('login/main');
    }
    
    public function authenticate() {
        
       
       try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("login"=>$_GET['username']));
           if($user != null){
               if($user->getPassword() == $_GET['password']) {
                   $result['message'] ="success";
                   $result['id']= $user->getId();
               }
               else {
                   $result['message'] = "Error en password";
               }
           }
           else {
               $result['message'] = "Error en login";
           }
           
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
        
       echo json_encode($result);
    }
}