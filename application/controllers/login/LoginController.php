<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                   $result['type'] = $user->getType();
               }
               else {
                   $result['message'] = "Error en password";
               }
           }
           else {
               $result['message'] = "Error en login";
           }

       }catch(Exception $e){
           $result['message'] = "Error";
       }

       echo json_encode($result);
    }

    public function getQuestion () {
        try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("login"=>$_GET['login']));
           if($user !== null){
                $result['id']= $user->getId();
                $result['question']= $user->getQuestionText();
                $result['answer']= $user->getAnswer();
                $result['message'] = "success";
           }else{
                $result['message'] = "Error";
           }
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       echo json_encode($result);
    }

    public function setPassword () {
        try {
           $em = $this->doctrine->em;
           $user = $em->getRepository('\Entity\Users')->findOneBy(array("id"=>$_GET['id']));
           if($user !== null){
                $user->setPassword( $_GET['newPassword']);
                $em->merge($user);
                $em->persist($user);
                $em->flush();
                $result['message'] = "success";
           }else{
                $result['message'] = "Error";
           }
       }catch(Exception $e){
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }
       echo json_encode($result);
    }
}
