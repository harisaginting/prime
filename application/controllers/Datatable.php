<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Datatable extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Datatable','main_model'); 
    }

    function project_active(){

        $length         = $this->input->post('length');
        $start          = $this->input->post('start');
        $searchValue    = strtoupper($_POST['search']['value']);
        $orderColumn    = $_POST['order']['0']['column'];
        $orderDir       = $_POST['order']['0']['dir'];
        $order          = $_POST['order'];

        $status         = $this->input->post('status');
        $pm             = $this->input->post('pm');
        $customer       = $this->input->post('customer');
        $partner        = $this->input->post('mitra');
        $type           = $this->input->post('type');
        $regional       = $this->input->post('regional');
        $segmen         = $this->input->post('segmen');

        $model = $this->main_model->get_table_project_active($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status,$pm,$customer,$partner,$type,$regional,$segmen);

        foreach ($model as $key => $value) {
            //echo json_encode($model[$key]->POTENTIAL );die;
            $model[$key]->POTENTIAL         = floor($model[$key]->POTENTIAL);  
            $model[$key]->POTENTIAL_WEEK    = floor($model[$key]->POTENTIAL_WEEK);  
        }

        //echo $this->db->last_query();die;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main_model->count_all_table_project_active($status,$pm,$customer,$partner,$type,$regional,$segmen),
            "recordsFiltered" => $this->main_model->count_filtered_table_project_active($searchValue, $orderColumn, $orderDir, $order,$status,$pm,$customer,$partner,$type,$regional,$segmen),
            "data" => $model,
        );
        echo json_encode($output);
    }

    function project_closed(){
        $length = !empty($this->input->post('length'))? $this->input->post('length') : null;
        $start = !empty($this->input->post('start'))?$this->input->post('start'): null;
        $searchValue = !empty(strtoupper($_POST['search']['value']) )? strtoupper($_POST['search']['value'])  : null;
        $orderColumn = !empty($_POST['order']['0']['column'])?$_POST['order']['0']['column']:null;
        $orderDir = !empty($_POST['order']['0']['dir'])? $_POST['order']['0']['dir']:null;
        $order = !empty($_POST['order'])? $_POST['order']: null;

        $status     = $this->input->post('status');
        $pm         = $this->input->post('pm');
        $customer   = $this->input->post('customer');
        $partner    = $this->input->post('mitra');
        $type       = $this->input->post('type');
        $regional   = $this->input->post('regional');
        $segmen     = $this->input->post('segmen');
        $escorded   = $this->input->post('escorded');

        $model = $this->main_model->get_table_project_closed($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded);

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main_model->count_all_table_project_closed($status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded),
            "recordsFiltered" => $this->main_model->count_filtered_table_closed($searchValue, $orderColumn, $orderDir, $order,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded),
            "data" => $model,
        );
        echo json_encode($output);
    }
    
      



}

?> 