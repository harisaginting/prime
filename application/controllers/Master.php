<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Master extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Master','main_model'); 
    }

    function partner(){
    	$this->adminView('master/partner');
    }


    function customer(){
        $this->adminView('master/index');
    }


    function history(){
        $this->adminView('master/index');
    }



}