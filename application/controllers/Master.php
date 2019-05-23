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
        $this->adminView('master/customer');
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

    function get_project_wfm(){
        $q          = $this->input->post('q');
        $data       = $this->main_model->get_project_wfm($q);
        echo json_encode($data);
    }

    function get_p8(){
        $p8 = $this->input->post('no_p8');
        $result['data'] = null;

        if(!empty($p8)){
            $result['data'] = $this->main_model->get_p8($p8);            
        }

        echo json_encode($result);
    }

    function get_all_p8($id_partner){
        $result['data'] = $this->main_model->get_all_p8($id_partner);  
        echo json_encode($result);
    }



}