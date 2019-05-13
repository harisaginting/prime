<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Project extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Project','main_model'); 
    }

    // List Projects
   public function index($type = null)  
    {
        redirect(base_url().'project/data');
             
    }

    function data($type = null){
        $data['title']       = 'Projects'; 
        $data['list_pm']     = $this->get_pm();
        $data['list_mitra']  = $this->get_partner();
        $data['list_cc']     = $this->get_customer();
        $data['list_segmen'] = $this->get_segmen();
        $data['list_type']   = $this->get_project_type();
        $data['type']        = !empty($type) ? $type : 'active';
        $this->adminView('project/index',$data,'Project');
    }


    function show($id_project=null){
        if(empty($id_project)){
             redirect(base_url().'project/data');
        }
       

        $data['id_project']         = $id_project;
        $data['project']            = $project      = $this->main_model->get_project($id_project);
        $data['edit']               = ($this->session->userdata('nik_sess') == $project['PM_NIK'])||($this->get_access_value('MASTER')>0) ? 1 : 0;

        $data['current_week']       = $current_week     = $this->main_model->get_project_current_week($id_project); 
        $data['current_plan']       = $this->main_model->get_project_current_plan($id_project, $current_week); 
        $data['progress']           = $this->main_model->get_project_progress($id_project);  
        $data['kurva']              = $this->main_model->get_project_curva_s($id_project);
        $data['arrAssignTo']        = array('SDV','MITRA','SEGMEN','BDM','DSS','TREG');

        $data['acq']                = $this->main_model->get_project_acquisition_s_curve($id_project);
        $data['symptoms']           = $this->main_model->get_project_symptoms($id_project);
        $data['issue']              = $this->main_model->get_project_issue($id_project);
        $data['deliverables_2']     = $this->main_model->get_project_deliverables_for_assign($id_project);

        $month          = date('n');
        $month_lm       = $month - 1;
        $year           = $year_lm = date('Y');
        $data['c_acq']              = $this->main_model->get_project_acquisition($id_project,$month,$year);
            if($month_lm==0){
                $month_lm       = 12;
                $year_lm           = $year_lm - 1;
            }
        $data['l_acq']              = $this->main_model->get_project_acquisition($id_project,$month_lm,$year_lm);
        
        $deliverables               = $this->main_model->get_project_deliverables($id_project);
        foreach ($deliverables as $key => $value) {
            $deliverables[$key]['issue']    = $this->main_model->get_deliverable_issue($value['ID_DELIVERABLE']);

            foreach ($deliverables[$key]['issue'] as $key1 => $value1) {
                $deliverables[$key]['issue'][$key1]['action'] = $this->main_model->get_project_actionPlan($value1['ID_ISSUE']);
            }

        }
        $data['deliverables']       = $deliverables;
        ##S CURVE
            foreach ($data['kurva']['REAL'] as $key => $value) {
                    if((empty($data['kurva']['REAL'][$key]))&&(!empty($data['kurva']['REAL'][$key-1]))&&($key <= $current_week)){
                        $data['kurva']['REAL'][$key] = $data['kurva']['REAL'][$key-1];
                    }
                    if($key > $current_week){
                        unset($data['kurva']['REAL'][$key]);
                    }
                }


            $data['acq']['REAL2']       = array();
            $data['acq']['PLAN2']       = array();
            $data['acq']['PROG_C']       = array();
            $data['acq']['REAL2'][0]    = 0;
            $data['acq']['PLAN2'][0]    = 0;
            foreach ($data['acq']['REAL'] as $key => $value) {
                    if(empty($data['acq']['REAL'][$key])){
                        $data['acq']['REAL'][$key] = 0;
                    }

                    if($key == 0){
                        $data['acq']['REAL2'][$key] = $data['acq']['REAL'][$key];
                    }else{
                       $data['acq']['REAL2'][$key] = $data['acq']['REAL2'][$key-1] + $data['acq']['REAL'][$key]; 
                    }
                }
            foreach ($data['acq']['PLAN'] as $key => $value) {
                    if(empty($data['acq']['PLAN'][$key])){
                        $data['acq']['PLAN'][$key] = 0;
                    }

                    if($key == 0){
                        $data['acq']['PLAN2'][$key] =  $data['acq']['PLAN'][$key];
                    }else{
                        $data['acq']['PLAN2'][$key] = $data['acq']['PLAN2'][$key-1] + $data['acq']['PLAN'][$key];
                    }

                    
                }
            foreach ($data['acq']['PROG2'] as $key => $value) {
                    if(empty($data['acq']['PROG2'][$key])){
                        $data['acq']['PROG2'][$key] = 0;
                    }

                    if($key == 0){
                        $data['acq']['PROG_C'][$key] =  $data['acq']['PROG2'][$key];
                    }else{
                        $data['acq']['PROG_C'][$key] = $data['acq']['PROG_C'][$key-1] + $data['acq']['PROG2'][$key];
                    }

                    
                }

            $data['acq2'] = array();

            foreach ($data['acq'] as $key => $value) {
                $data['acq2'][$key] = array_reverse($value); 
            }


        $this->adminView('project/show',$data,'Project');
    }
    
      



}

?> 