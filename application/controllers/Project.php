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
        $data['edit']               = ($this->session->userdata('nik_sess') == $project['PM_NIK'])||($this->get_access_value('MASTER')>0 && (($data['project'] == 'LEAD') || ($data['project'] == 'LAG') || ($data['project'] == 'DELAY'))) ? 1 : 0;
        $data['edit'] = 0;
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


    function get_deliverable($id_deliverable){
        $data = $this->main_model->get_deliverable($id_deliverable);
        echo json_encode($data);
    }
    
    // UPDATE DELIVERABLE
    function update_deliverable($id_project){
        $id_deliverable          = $this->input->post('deliverable_id_project');
        
        $data['ID_PROJECT']      = $id_project;
        $data['ID_DELIVERABLE']  = $id_deliverable;
        $data['NAME']            = $this->input->post('deliverable_name');
        $data['START_DATE']      = $this->input->post('deliverable_start_date');
        $data['END_DATE']        = $this->input->post('deliverable_end_date'); 
        $data['DESCRIPTION']     = $this->input->post('deliverable_description');
        $data['WEIGHT']          = $this->input->post('deliverable_weight');
        $data['PROGRESS_VALUE']  = $this->input->post('deliverable_achievement');

        if ($this->main_model->update_deliverable($data)) {
                $this->main_model->updateLogProject($id_project);
                $this->add_credit_point('DELIVERABLE '.$id_deliverable,$id_project,"UPDATE DELIVERABLE",1,json_encode($data));
                $this->addLog($id_project,'UPDATE DELIVERY','PROJECT',json_encode($data));            
                $result['data']      = 'success';
            }
        echo json_encode($result);
    }


    function add_issue($id_project){
        $result['data']          = 'failed';
        $seqIssue = $this->get_sequence("PRIME_PROJECT_ISSUE_SEQ");
            $data = array(
                    'ID_ISSUE'          => 'IS'.$seqIssue['ID'],
                    'ID_PROJECT'        => $id_project,
                    'ISSUE_NAME'        => $this->input->post('issue_name'),
                    'RISK_IMPACT'       => $this->input->post('risk_impact'),
                    'IMPACT'            => $this->input->post('impact'),
                    'IN_CHARGE'         => $this->input->post('responsible'),
                    'CATEGORY'          => $this->input->post('symptom_issue'),
                    'ID_DELIVERABLE'    => $this->input->post('id_deliverable_issue'),
            );
            
            $this->add_credit_point('ISSUE '.$data['ID_ISSUE'],$id_project,"ADD ISSUE",1,$data['ISSUE_NAME']);
            if ($this->main_model->add_issue($data)) {
                $this->addLog($id_project,'ADD ISSUE','PROJECT',json_encode($data));
                $data = $data['ID_ISSUE'];
                $this->main_model->updateLogProject($id_project);
                $result['data']         = 'success';
            }

        echo json_encode($result);
    }


    function get_issue($id_issue) {
        $data = $this->main_model->get_issue($id_issue);
        echo json_encode($data);
    }


    function update_issue($id_project){                      
            $result['data']         = 'failed';
            $id_issue               = $this->input->post('issue_id');
            
            $data = array(
                    'ID_ISSUE'          => $id_issue,
                    'ID_PROJECT'        => $id_project,
                    'ISSUE_NAME'        => $this->input->post('issue_name'),
                    'RISK_IMPACT'       => $this->input->post('risk_impact'),
                    'IMPACT'            => $this->input->post('impact'),
                    'STATUS_ISSUE'      => $this->input->post('issue_status'),
                    'ISSUE_CLOSED_DATE' => $this->input->post('issue_closed_date'),
                    'CATEGORY'          => $this->input->post('symptom_issue'),
                    'IN_CHARGE'         => $this->input->post('responsible'),
                    'ID_DELIVERABLE'    => $this->input->post('id_deliverable_issue')
            ); 
            
            

            if ($this->main_model->update_issue($id_issue,$data)) {
                $this->addLog($id_project,'UPDATE ISSUE','PROJECT',json_encode($data));
                $this->main_model->updateLogProject($id_project);
                $this->add_credit_point('ISSUE '.$id_issue,$id_project,"UPDATE ISSUE",1,json_encode($data));    
                $result['data']         = 'success';
            }
        echo json_encode($result);
    }


    function add_action($id_project){
        $result['data']          = 'failed';
        $seqAction  = $this->get_sequence("PRIME_PROJECT_ACTION_SEQ");    
            $action = array(
                    'ID_ACTION_PLAN'    => 'AP'.$seqAction['ID'],
                    'ID_PROJECT'        => $id_project,
                    'ID_ISSUE'          => empty($this->input->post('action_issue_id')) ? $this->input->post('action_issue_id_') : $this->input->post('action_issue_id') ,
                    'ACTION_NAME'       => $this->input->post('action_name'),
                    'ACTION_REMARKS'    => $this->input->post('action_remarks'),
                    'ASSIGN_TO'         => $this->input->post('action_in_charge'),
                    'ASSIGN_TO_DETAIL'  => $this->input->post('action_in_charge'),
                    'DUE_DATE'          => $this->input->post('action_due_date'),
                    'ACTION_STATUS'     => 'OPEN',
            );
            $pic_name       = $this->input->post('pic_name');
            $pic_email      = $this->input->post('pic_email');
            $arrPic         = array();


            if (!empty($pic_name)) {
                for($i=0;$i<count($pic_name);$i++){
                    $seqPic = $this->get_sequence("PRIME_ACTION_PIC_SEQ");
                    if (!empty($pic_name[$i])) {
                        $picArr = array(
                                'ID_PIC'         => $seqPic['ID'],
                                'ID_ACTION_PLAN' => 'AP'.$seqAction['ID'],
                                'PIC_NAME'       => $pic_name[$i],
                                'PIC_EMAIL'      => $pic_email[$i],
                            );
                        array_push($arrPic, $picArr);
                    }
                }
            }   
            //echo json_encode($arrPic);die; 
            if($this->main_model->add_action($action,$arrPic)){
            $this->add_credit_point('ACTION PLAN '.$action['ID_ACTION_PLAN'],$id_project,"ADD ACTION PLAN",1,json_encode($action));
            $this->addLog($id_project,'ADD ACTION PLAN','PROJECT',json_encode($action));
            $result['data']         = 'success';
        }
        echo json_encode($result);
    }

    function get_action($id){
        $data   = $this->main_model->get_action($id);
        echo json_encode($data);
    }

    function update_action($id_project){
            $result['data'] = 'failed';
            $arrPic         = array();
            $id_action      = $this->input->post('action_id'); 
            $pic_name       = $this->input->post('pic_name');
            $pic_email      = $this->input->post('pic_email');

            $data = array(
                    'ID_ACTION_PLAN'    => $id_action,
                    'ID_PROJECT'        => $id_project,
                    'ACTION_NAME'       => $this->input->post('action_name'),
                    'ACTION_REMARKS'    => $this->input->post('action_remarks'),
                    'DUE_DATE'          => $this->input->post('action_due_date'),
                    'ACTION_STATUS'     => $this->input->post('action_status'),
                    'ACTION_CLOSED_DATE'=> $this->input->post('action_closed_date')
            );

            if (!empty($pic_name)) {
                for($i=0;$i<count($pic_name);$i++){
                    $seqPic = $this->get_sequence("PRIME_ACTION_PIC_SEQ");
                    if (!empty($pic_name[$i])) {
                        $picArr = array(
                                'ID_PIC'         => $seqPic['ID'],
                                'ID_ACTION_PLAN' => $id_action,
                                'PIC_NAME'       => $pic_name[$i],
                                'PIC_EMAIL'      => $pic_email[$i],
                            );
                        array_push($arrPic, $picArr);
                    }
                }
            } 

            if($this->main_model->update_action($data,$arrPic)){
                $this->add_credit_point('ACTION PLAN '.$id_action , $id_project,"UPDATE ACTION PLAN",1,json_encode($data));
                $this->addLog($id_project,'UPDATE ACTION PLAN','PROJECT',json_encode($data)); 
                $result['data'] = 'success';
            }

            echo json_encode($result);
            
    }


    // DELETE ACTION
    function delete_action($id_project){
        $result['data']     = 'failed';   
        $id_action           = $this->input->post('id');
        $this->main_model->delete_action($id_project,$id_action);
        $result['data']     = 'success';
        echo json_encode($result);
    }

    // DELETE ISSUE 
    function delete_issue($id_project){
        $result['data']     = 'failed';   
        $id_issue           = $this->input->post('id');
        $this->main_model->delete_issue($id_project,$id_issue);
        $result['data']     = 'success';
        echo json_encode($result);
    }

    function delete_deliverable($id_project){
        $result['data']     = 'failed';   
        $id_deliverable     = $this->input->post('id');
        $this->main_model->delete_deliverable($id_project,$id_deliverable);
        $result['data']     = 'success';
        echo json_encode($result);
    }

    // ADD DOCUMENT
    function add_document($id_project){
         $this->load->library('upload');
        //untuk upload dokumen proyek
        $targetDir = '../_files/'.$id_project;
        if(!is_dir($targetDir)){
            mkdir($targetDir,0777);
        }

        $config['upload_path'] = $targetDir;
        $config['allowed_types'] = '*';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
                
        $this->upload->initialize($config);


        $files = $_FILES['documentProject'];
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']     = $files['name'][$key];
            $_FILES['images[]']['type']     = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error']    = $files['error'][$key];
            $_FILES['images[]']['size']     = $files['size'][$key];

            if(!empty($_FILES['images[]']['name'])){
                if ($this->upload->do_upload('images[]')) {
                    $dataUpload = $this->upload->data();
                    $dataInsert['ID_PROJECT'] = $id_project; 
                    $dataInsert['CATEGORY'] = $this->input->post('document_category'); 
                    $dataInsert['ATTACHMENT'] = $id_project.'/'.$dataUpload['file_name'];  
                    $dataInsert['NAME'] = $this->input->post('document_name'); 

                    $this->main_model->add_document($dataInsert); 

                    $result['result'] = 'success';
                    $this->main_model->updateLogProject($id_project);
                    $this->add_credit_point('DOCUMENT',$id_project,"ADD DOCUMENT ".$dataInsert['CATEGORY'],1,json_encode($dataInsert));
                    $this->addLog($id_project,'ADD DOCUMENT','PROJECT',json_encode($dataInsert));
                    
                    echo json_encode($result);
                } else {
                    echo 'error';
                }
            }
        }
    } 


    // ADD ACQUISITION
    function update_acquisition($id_project){
        //echo json_encode($this->input->post());

        $result['data'] = 'failed';
        $month          = date('n');
        $month_lm       = $month - 1;
        $year           = date('Y');
        $year_lm        = date('Y');
        if($month_lm == 0){
            $month_lm = 12;
            $year_lm  = $year_lm - 1;
        }

        $data_c     = array();
        $data_lm    = array();

        $data_c['ID']              = $this->getGUID();
        $data_c['ID_PROJECT']      = $id_project;
        $data_c['TOP']             = $this->input->post('target_top');
        $data_c['T_VALUE']         = $this->input->post('target_value');
        $data_c['TOP_EXPLANATION'] = $this->input->post('target_to_exp');
        $data_c['UPDATED_BY']       = $this->session->userdata('nik_sess');
        $data_c['MONTH']           = $month;
        $data_c['YEAR']            = $year;
        $data_c['T_NOTE']          = $this->input->post('target_note');

        $data_lm['ID']              = $this->getGUID();
        $data_lm['ID_PROJECT']      = $id_project;
        $data_lm['TOP']             = $this->input->post('actual_top');
        $data_lm['A_VALUE']         = $this->input->post('actual_value');
        $data_lm['TOP_EXPLANATION'] = $this->input->post('actual_to_exp');
        $data_lm['UPDATED_BY']      = $this->session->userdata('nik_sess');
        $data_lm['MONTH']           = $month_lm;
        $data_lm['YEAR']            = $year_lm;
        $data_lm['A_NOTE']          = $this->input->post('actual_note');

        
        if($this->main_model->update_acquisition($id_project,$month_lm,$year_lm,$data_lm)){
            if($this->main_model->update_acquisition($id_project,$month,$year,$data_c)){
                $result['data'] = 'success';
            }
        };
        echo json_encode($result);
    }

    // EDIT PROJECT 
    function update_base_project($type = null){
        $result['data']     = 'failed';
        $id_project         = $this->input->post('id_project');

        if(empty($type)){
            echo json_encode($result);die;
        }

        $key        = array();
        $value      = array();

        switch ($type) {
            case 'NAME':
                array_push($key, 'NAME');
                array_push($value, $this->input->post('project_name')); 
                break;
            case 'CUSTOMER':
                $nipnas         = $this->input->post('project_customer');
                $customer_name  = $this->main_model->get_customer_name($nipnas); 
                array_push($key, 'NIP_NAS');
                array_push($key, 'STANDARD_NAME');
                array_push($value, $nipnas);
                array_push($value, $customer_name);
                break; 
            case 'SEGMEN':
                $array_push($key, 'SEGMEN');
                array_push($value, $this->input->post('project_segmen')); 
                break; 
            case 'AM_NAME':
                $nik_am         = $this->input->post('project_am');
                $am_name        = $this->main_model->get_am_name($nik_am); 
                array_push($key, 'AM_NIK');
                array_push($key, 'AM_NAME');
                array_push($value, $nik_am);
                array_push($value, $am_name);
                break; 
            case 'TYPE':
                array_push($key, 'TYPE');
                array_push($value, $this->input->post('project_type')); 
                break;
            case 'DESCRIPTION':
                array_push($key, 'DESCRIPTION');
                array_push($value, $this->input->post('project_description')); 
                break;
            case 'NO_KB':
                array_push($key, 'NO_KB');
                array_push($value, $this->input->post('project_no_kb')); 
                break;
            case 'STATUS':
                array_push($key, 'STATUS');
                array_push($value, $this->input->post('project_status')); 
                break;
            case 'NO_KL':
                array_push($key, 'NO_KL');
                array_push($value, $this->input->post('project_no_kl')); 
                break;
            case 'REGIONAL':
                array_push($key, 'REGIONAL');
                array_push($value, $this->input->post('project_regional')); 
                break;
            case 'START_DATE':
                array_push($key, 'START_DATE');
                array_push($value, $this->input->post('project_start_date')); 
                break;
            case 'END_DATE':
                array_push($key, 'END_DATE');
                array_push($value, $this->input->post('project_end_date')); 
                
                $end_date       = $this->input->post('project_end_date');
                $end_date_note  = $this->input->post('end_date_note');
                $end_date_before= $this->main_model->get_end_date_project($id_project);
                break;
            case 'SYMPTOM':
                array_push($key, 'REASON_OF_DELAY');
                array_push($value, $this->input->post('project_symptom')); 

                $dataSymptom = array(
                    'ID' => $this->getGUID(), 
                    'ID_PROJECT' => $id_project, 
                    'SYMPTOM' => trim($this->input->post('project_symptom')) 
                    );

                $this->main_model->addSymptom($dataSymptom);
                break;
            default:
                echo json_encode($result);die;
                break;
        }

        if(!empty($key)){
            if($this->main_model->update_field_project($id_project,$key,$value)){
                $result['data']     = 'success';
                $this->addLog($id_project,'EDIT PROJECT'.json_encode($key).' to '.json_encode($value),'PROJECT',json_encode($value));
                $this->main_model->updateLogProject($id_project); 
                if(!empty($end_date)){
                    $data = array(
                            'ID'            => $this->getGUID(),
                            'ID_PROJECT'    => $id_project, 
                            'END_DATE'      => $end_date,
                            'END_DATE_BEFORE'      => $end_date_before,
                            'NOTE'          => $end_date_note, 
                            'UPDATE_BY_ID'  => $this->session->userdata('nik_sess'),
                            'UPDATE_BY_NAME'=> $this->session->userdata('nama_sess'),
                            );
                    $this->main_model->update_end_project($id_project,$data);
                }   
            }
        }


        echo json_encode($result);

        //echo $id_project.'<br>'.json_encode($key).'<br>'.json_encode($value);
    }

}

?> 