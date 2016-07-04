<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserController extends CI_Controller {

    public function index() {

        $this->load->view('user/main');
    }

    public function save($user) {
        $em = $this->doctrine->em;

        try{
            $oldUser = $em->finOneBy(array('login'=> 'mpigorini'));

        }catch(Execption $e){

        }
    }
}
