<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_User','main_model');  
        //$this->isLoggedIn();  
    } 

    public function index(){
    	$this->adminView('user/index',null,'Users');
    }

    public function profile($id){
        $data['user']   = $this->main_model->get_user($id);
        $this->adminView('user/profile',$data,'Profile');
    }

    public function add(){
        $this->adminView('user/add',null,'Add User');
    }

    public function add_proccess(){
        echo json_encode($this->input->post());                  
    }


}