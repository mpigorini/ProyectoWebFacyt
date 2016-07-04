<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class LoginController extends CI_Controller {
    
    public function index(){
        $this->load->view('login/main');
    }
    
    public function authenticate() {
        
       
       try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("login"=>$_GET['username']));
<<<<<<< HEAD
           if($user != null){
               if($user->getPassword() == $_GET['password']) {
=======
           if($user !== null){
               if($user->getPassword() === $_GET['password']) {
>>>>>>> af59cbb6f86203ab7caab5c534cbe00bb0fffa27
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