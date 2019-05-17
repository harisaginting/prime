<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Belajar extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Belajar','main_model');
    }

    function index(){
        $data ['user'] =$this->main_model->get_all_user();

        //echo json_encode($data ['user']);die;

        $this->adminView('tampilan_belajar',$data,'BELAJAR');
    }

    function edit($id){
        echo "ini untuk edit ".$id;
    }

}