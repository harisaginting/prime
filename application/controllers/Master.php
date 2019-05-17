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

    function get_all_pic(){
        $q = $this->input->get('q');
        $data = $this->main_model->get_all_pic($q);
        echo json_encode($data);
    }

    function get_all_pic_email(){
        $q = $this->input->get('q');
        $data = $this->main_model->get_all_pic_email($q);
        echo $data['EMAIL']; 
    }



}