<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_User');  
        //$this->isLoggedIn();  
    } 

    public function index(){
    	$this->adminView('user/index',null,'Users');
    }

    public function show(){

    }


}