<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Wfm extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_Wfm','main_model');  
        $this->load->model('M_Master','master_model');  
        //$this->isLoggedIn();  
    } 

    public function index(){
    	$this->adminView('wfm/index',null,null);
    }


    function get_view_detail_so($get_no_p8 = null){
    	$no_p8              = !empty($this->input->post('no_p8')) ? $this->input->post('no_p8') : $get_no_p8;

        $data['data']       = $this->main_model->get_project_so($no_p8);
        //echo $this->db->last_query();die;
        $data['no_p8']     = $no_p8;
        /*echo json_encode($data['data']);die;*/
        $this->load->view('wfm/project_detail_so',$data);
    }

    function add_no_so(){
    	$no_p8 = $this->input->post('no_p8');
    	$no_so = $this->input->post('no_so');
 		
    	$p8    = $this->master_model->get_p8($no_p8);

    	$data = array(
    		'NO_P8'=> $p8['NO_SPK'],
    		'ID_LOP'=> $p8['ID_LOP'],
    		'NO_SO' => $no_so,
    		'VALID' => 0,
    		'EXIST' => 1,
    		'UPDATED_BY_ID' => $this->session->userdata('nik_sess'),
    		'UPDATED_BY_NAME' => $this->session->userdata('nama_sess'),
    	);

    	$cek  = $this->main_model->check_p8_so($data['NO_P8'],$data['NO_SO']);
        if($cek == 0){
           $this->main_model->add_no_so($data);  
        }
        //echo $this->db->last_query();die;
        $this->get_view_detail_so($no_p8);
    }


    function validate_so($valid){
    	$no_p8 = $this->input->post('no_p8');
    	$no_so = $this->input->post('no_so');
    	return $this->main_model->validate_so($no_p8,$no_so,$valid);
    }

    function delete_so(){
    	$no_p8 = $this->input->post('no_p8');
    	$no_so = $this->input->post('no_so');
    	return $this->main_model->delete_so($no_p8,$no_so);
    }

}