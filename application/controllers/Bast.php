<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Bast extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Bast','main_model'); 
    }

    function index(){
    	$this->adminView('bast/index',null,'BAST');
    }

    function show($id_bast){
    	$this->adminView('bast/show',null,'BAST');
    }

}