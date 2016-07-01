<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
class LoginController extends CI_Controller {
    
    public function index(){
        $this->load->view('Login/login');
        
    }
    
    public function authenticate(){
        
       
       try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("login"=>$_GET['username']));
           if($user !== null){
               if($user->getPassword() === $_GET['password']) {
                   $result ="success";
               }
               else {
                   $result = "Error en password";
               }
           }
           else {
               $result = "Error en login";
           }
           
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result = "Error";
       }
        
       echo $result;
    }
}