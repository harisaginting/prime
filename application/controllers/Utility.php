<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Utility extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_Utility');  
        //$this->isLoggedIn();  
    } 

    public function index(){
    	$this->adminView('utility/index',null,null);
    }


}