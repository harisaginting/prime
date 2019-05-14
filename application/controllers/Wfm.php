<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Wfm extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_Wfm');  
        //$this->isLoggedIn();  
    } 

    public function index(){
    	$this->adminView('wfm/index',null,null);
    }


}