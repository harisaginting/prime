<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Bast extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Bast","main_model");
        $this->load->model("M_Master","master_model");
    }

    function index(){
    	$this->adminView('bast/index',null,'BAST'); 
    }

    function show(){
    	$this->adminView('bast/show');
    }

    function add(){
        $init_partner = $this->input->post('init_partner');
        $init_p8 = $this->input->post('init_p8');


        if(!empty($init_p8) && !empty($init_partner) ){
            $data = $this->master_model->get_p8($init_p8);
            $this->adminView('bast/add',$data,'SUBMIT BAST');
        }else{
            $data['partner'] = $this->get_partner();
            $this->adminView('bast/add_1',$data,'SUBMIT BAST');    
        }
    	
    }

    function get_all_pic(){
        $q = $this->input->post('q');
        echo json_encode($this->main_model->get_all_pic($q));
    }

}