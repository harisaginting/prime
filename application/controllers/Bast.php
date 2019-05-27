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

    function add(){
        $init_partner = $this->input->post('init_partner');
        $init_p8 = $this->input->post('init_p8');


        if(!empty($init_p8)){
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

    function add_proccess(){
        //echo json_encode($this->input->post());die;
        $result['data'] = "failed";

        $data['ID_BAST']        = $data_history['ID_PROJECT']  = $this->getGUID();
        $data['NIPNAS']         = $this->input->post('nipnas');
        $data['NAMACC']         = $this->input->post('customer');
        $data['SEGMENT']        = $this->input->post('segmen');
        $data['ID_MITRA']       = $this->input->post('partner_id');
        $data['NAMA_MITRA']     = $this->input->post('partner_name');
        $data['NO_SPK']         = $this->input->post('no_p8');
        $data['TGL_SPK']        = $this->input->post('p8_date');
        $data['PROJECT_NAME']   = $this->input->post('project');
        $data['NILAI_PEKERJAAN']= $this->input->post('value');
        $data['NO_KL']          = $this->input->post('kl');
        $data['TGL_KL']         = $this->input->post('kl_date');
        $data['TYPE_BAST']      = $this->input->post('top');
        $data['TGL_BAST']       = $this->input->post('bast_date');
        $data['NILAI_RP_BAST']  = $this->input->post('bast_value');
        $data['NILAI_RECCURING']  = $this->input->post('reccuring_val');
        $data['RECC_START_DATE']= $this->input->post('recc_start_date');
        $data['RECC_END_DATE']  = $this->input->post('recc_end_date');
        $data['PENANDA_TANGAN'] = $this->input->post('signer');
        $data['NIK_PM']         = $this->input->post('pm');
        $data['ID_LOP']         = $this->input->post('id_lop');
        $data['NAMA_PM']        = $this->input->post('pm_name');
        $data['PIC_MITRA']      = $this->input->post('pic');
        $data['EMAIL_MITRA']    = $this->input->post('pic_email');
        $data['KELENGKAPAN_DELIVERY']   = $this->input->post('evidence');
        $data['STATUS']             =   $data_history['STATUS']     = "RECEIVED";
        $data['PROGRESS_LAPANGAN']  = $this->input->post('progress');
        $data['NAMA_TERMIN']        = $this->input->post('termin');
        $data['BAPP']               = !empty($this->input->post('bapp')) ? 1 : null;
        $data['LAST_EDITED_BY']     =   $data_history['BY_USER']    =  $this->session->userdata('nik_sess')."|||".$this->session->userdata('nama_sess');

        if($this->session->userdata('tipe_sess')=='SUBSIDIARY'){
            $data['STATUS']             =   $data_history['STATUS']     = "SUBMIT BY PARTNER";
        }

        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
        }
        //echo json_encode($data);die;
        if($data['TYPE_BAST']=='OTC'){$data['PROGRESS_LAPANGAN'] = '100';}
        if($this->main_model->add($data)){
            $this->addLog($this->session->userdata('nik_sess'),'SUBMIT BAST','BAST',json_encode($data));
            $data_history['ID_HISTORY'] = $this->getGUID();
            $data_history['COMMEND']    = $this->input->post('commend');
            if($this->main_model->add_history($data_history)){
                $result['data']     = "success";
                $result['id_bast']  = $data['ID_BAST'];
            }
        }
        echo json_encode($result);
    }

    function show($id){
        // if($this->auth->get_access_value('BAST')<3){
        //     redirect(base_url().'bast/hview/'.$id_bast);
        // }
        $data['id_bast']       = $id;
        $data['list_customer'] = $this->get_customer();
        $data['list_segmen']   = $this->get_segmen();
        $data['list_partner']  = $this->get_partner();
        $data['history']       = $this->main_model->get_history($id);
        $data['bast']          = $this->main_model->get_bast($id);
        $data['p8_bast']       = $this->main_model->get_p8_bast($data['bast']['NO_SPK'],$id);
        $data['evidence']      = @explode(',',$data['bast']['KELENGKAPAN_DELIVERY']);
        
        // echo json_encode($data['bast']);die;
        $this->adminView('bast/show',$data,'BAST');
    }

}