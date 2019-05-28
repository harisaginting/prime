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


    function update_proccess(){
        $result['data']         = "error";

        $id_bast                = $this->input->post('id_bast');
        $data['NAMA_MITRA']     = $this->input->post('partner_name');
        $data['ID_MITRA']       = $this->input->post('partner_id');
        $data['NO_SPK']         = $this->input->post('no_p8');
        $data['TGL_SPK']        = $this->input->post('p8_date');
        $data['PROJECT_NAME']   = $this->input->post('project_name');
        $data['NILAI_PEKERJAAN']= $this->input->post('value');
        $data['NO_KL']          = $this->input->post('kl');
        $data['TGL_KL']         = $this->input->post('kl_date');
        $data['TYPE_BAST']      = $this->input->post('type_bast');
        $data['TGL_BAST']       = $this->input->post('bast_date');
        $data['NILAI_RP_BAST']  = $this->input->post('bast_value');
        $data['NILAI_RECCURING']= $this->input->post('reccuring_val');
        $data['RECC_START_DATE']= $this->input->post('recc_start_date');
        $data['RECC_END_DATE']  = $this->input->post('recc_end_date');
        $data['PENANDA_TANGAN'] = $this->input->post('signer');
        $data['NIK_PM']         = $this->input->post('pm');
        $data['NAMA_PM']        = $this->input->post('pm_name');
        $data['PIC_MITRA']      = $this->input->post('pic');
        $data['EMAIL_MITRA']    = $this->input->post('email_pic');
        $data['KELENGKAPAN_DELIVERY']   = $this->input->post('evidence');
        $data['STATUS']             =   $data_history['STATUS']     = $this->input->post('status');
        $data['PROGRESS_LAPANGAN']  = $this->input->post('progress_actual');
        $data['NAMA_TERMIN']        = $this->input->post('termin');
        $data['ID_LOP']             = $this->input->post('id_lop');
        $data['BAPP']               = !empty($this->input->post('bapp')) ? 1 : null;
        $data['P71']               = !empty($this->input->post('p71')) ? 1 : null;
        $data['ID_PROJECT']         = $this->input->post('id_project');
        $data['LAST_EDITED_BY']     =   $data_history['BY_USER']    =  $this->session->userdata('nik_sess')."|||".$this->session->userdata('nama_sess');
        if($data['TYPE_BAST']=='OTC'){$data['PROGRESS_LAPANGAN'] = '100';}

        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
        }

        // MAIN PROCCESS UPDATE
        if($data['STATUS'] == 'APPROVED'){
                    $dateBast   = explode("/", $data['TGL_BAST']);
                    $yearBast   = $dateBast[2];
                    $monthBast  = $dateBast[0];
                    $monthBast  = $this->getMonthRomawi($monthBast);
                    $spk        = explode(".", $data['NO_SPK']);
                    $spk        = explode("/", $spk[1]);
                    $spk        = $spk[0];
                    $spk_squen  = $this->main_model->get_squen($data['NO_SPK']);
                    
                    switch ($data['TYPE_BAST']) {
                        case 'OTC':
                            $type = 'O';
                            break;
                        case 'TERMIN':
                            $type = 'T';
                            break;
                        case 'PROGRESS': 
                            $type = 'P';
                            break;
                        case 'RECURRING':
                            $type = 'R';
                            break;
                        case 'OTC & RECURRING':
                            $type = 'OR';
                            break;
                        default:
                            $type = "#ERROR";
                    }
                    switch ($data['PENANDA_TANGAN'] ) {
                        case 'Coordinator Project Management':
                            $signer = 'C';
                            break;
                            case 'Senior Expert Project Management Office 1':
                            $signer = '1';
                            break;
                            case 'Senior Expert Project Management Office 2':
                            $signer = '2';
                            break;
                        default:
                            $signer = '3';
                            break;
                    } 
                    
                    $c_no_bast  = $this->main_model->get_bast($id_bast);

                    if(empty($c_no_bast['NO_BAST'])){
                    $bappbast = 'BAST';
                        if(!empty($data['BAPP'])){
                            $bappbast = 'BAPP';
                        }

                        $no_bast    = $spk.'.'.$spk_squen.'/'.$bappbast.'/'.$type.$signer."/DES/".$data['ID_MITRA'].'/'.$monthBast.'/'.$yearBast;
                    }else{
                    $no_bast    = $c_no_bast['NO_BAST'];
                    }

                    $data['NO_BAST'] = $no_bast;
        }else if($data['STATUS'] == 'DONE'){
                    $no_bast                = $this->input->post('no_bast');
                    $kode_bast              = explode('/',$no_bast)[0];
                    $project_name           = strtoupper($this->makeurl($data['PROJECT_NAME']));
                    $nama_mitra             = strtoupper($this->makeurl($data['NAMA_MITRA']));
                    
                    $targetDir = "../bast/".substr($no_bast, strlen($no_bast)-4)."/".$this->makefoldername($data['NAMA_MITRA']);
                    if(!is_dir($targetDir)){
                        mkdir($targetDir,0777,true);
                    }
                    
                    $newName              = 'BAST_'.date('Ymd',strtotime($data['TGL_BAST'])).'_'.$kode_bast.'_DES_'.$nama_mitra.'_'.substr($project_name, 0,150).'_.'.pathinfo($_FILES['file_bast']['name'], PATHINFO_EXTENSION);
                    $uploaded_file = $this->upload_file('file_bast',$targetDir,$newName);
                    
                    $data['FILENAME']     = $uploaded_file['file_name'];
                    $data['FILENAME_URI'] = $targetDir.'/'.$uploaded_file['file_name'];

                    $progress     = "";
                    if(!empty($data['PROGRESS_LAPANGAN'])){
                        $progress = $data['PROGRESS_LAPANGAN'];
                    }else if($data['TYPE_BAST']=='OTC'){ 
                        $progress = '100%';
                    }else if($data['TYPE_BAST']=='RECURRING'){
                        $progress = $data['RECC_START_DATE'].' - '.$data['RECC_END_DATE'];              
                    }else if($data['TYPE_BAST']=='TERMIN'){
                        $progress = $data['NAMA_TERMIN'];}          

                    if(!empty($this->input->post('id_project'))){
                        $data_project = null;
                        if($this->Project_model->get_detail_project2($data['ID_PROJECT'])){
                            $data_project = $this->main_model->getProjectBySPK($data['ID_PROJECT']);    
                        }

                        if(!empty($data_project)){
                            $urlEpic        = "http://des.telkom.co.id/epic/index.php/api/project/mitra?id=".$data_project->ID_ROW."&id_lop=".$data_project->ID_LOP_EPIC."&prog_lapangan=".$progress;
                        } 

                         
                    }
                    
                    $sign           = $this->makeurl($data['PENANDA_TANGAN']);
                    $evidence       = $this->makeurl($data['KELENGKAPAN_DELIVERY']);
                    $urlNumero   = "http://numero.telkom.co.id/JSONAPITERIMABAST.aspx?NomorBAST=".$no_bast."&FILEBAST=".base_url().$data['FILENAME_URI']."&NomorSPK=".$data['NO_SPK']."&TanggalBAST=".date('m/d/Y', strtotime($data['TGL_BAST']))."&IDPenandaTangan=".$sign."&IDPM=".$data['NIK_PM']."&ProgressLapangan=".$progress."&KelengkapanDelivery=".$evidence;    
        }

        
        if($this->main_model->update_proccess($data,$id_bast)){
                $this->addLog($this->session->userdata('nik_sess'),"UPDATE BAST",'BAST',json_encode($data));
                
                $data_history['ID_HISTORY']     = $this->getGUID();
                $data_history['COMMEND']        = $this->input->post('commend');
                $data_history['ID_PROJECT']     = $id_bast;


                $revision_s = $this->input->post('revision_symptoms');
                $revision_v = "";
                if(!empty($revision_s)){
                    foreach ($revision_s as $key => $value) {
                        $revision_v = $revision_v.",".$value; 

                        $dataRev['ID'] = $this->getGUID();
                        $dataRev['ID_BAST'] = $id_bast;
                        $dataRev['REASON'] = $value;
                        $this->main_model->addBASTSymptoms($dataRev);

                    }
                    $revision_v = ltrim($revision_v, ",");
                    $data_history['REASON'] = $revision_v;
                }

                if($this->main_model->add_history($data_history)){
                    $result['data']     = "success";
                    $result['id_bast']  = $id_bast;
                    }
            }

        echo json_encode($result);
        
    }
}