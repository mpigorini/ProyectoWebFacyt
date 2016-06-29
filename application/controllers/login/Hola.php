<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hola extends CI_Controller {
    
    public function index(){
        $this->load->view('hola');
        
        $em = $this->doctrine->em;
        
        $user = new \Entity\Users();
        
        $user->setLogin('mpigorini');
        $user->setPassword('123456');
        $user->setName('marioandre');
        $user->setLastName('pigorini');
        $user->setType('0');
        
        
    }
}