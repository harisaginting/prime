<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_Dashboard');  
        //$this->isLoggedIn();  
    } 


    // View Dashboard Page 
    public function index(){
        $data['title']          = 'Dashboard';
        $data['total_project_c']=  array();
        $data['scale']          =  $scale              = array("MEGA","BIG","REGULAR","ORDINARY");
        $data['status_active']  =  $status_active      = array("LEAD","LAG","DELAY");
        $data['total_project']  = $this->M_Dashboard->get_total_project_active();
        $data['bast_p']         = $this->M_Dashboard->get_total_bast_progress();
        $data['bast_r']         = $this->M_Dashboard->get_total_bast_revision();
        $data['total_pm']       = $this->M_Dashboard->get_total_project_pm();
        $type_project           = $this->get_project_type();
        $data['colorTProj']     = array(
                                    "#ff8201","#ffc801",
                                    "#31f7c9","#0b8fc1",
                                    "#0a43c3","#890dd6",
                                    "#9fd03e","#03b732",
                                    "#d60db4","#ff0b65"
                                    );
        foreach ($type_project as $key => $value) {
                $data['total_project_c'][$value['VALUE']] = $this->M_Dashboard->get_total_project_active($value['VALUE']);
            }
        $data['chartProgress']          = $this->get_chart_progress();
        $data['chartProjectScale']      = $this->get_chart_project_scale();
        $data['chartSymptoms']          = $this->M_Dashboard->getdDataSymptoms();
        $data['segmen']                 = $segmen       = $this->get_segmen();
        $data['segmen']['s_name']       = $segmen_scale         = $d_segmen_scale   = $segmen_value         = $segmen_status 
                                          = $d_segmen_status    = $segmen_status_progress         = $bast   = $d_bast 
                                          = $bastDrilldown      = $t_bastDrilldown  = $d_bastDrilldown      = array();
        $bastYear                       = array(2015,2016,2017,2018,2019);
        $month                          = array(1,2,3,4,5,6,7,8,9,10,11,12);
        $bast['name']             = 'BAST';
        $bast['colorByPoint']     = 'true';
        $bast['data']             = array();

        foreach ($bastYear as $key => $value) {    
            $d_bast['name']             = strval($value);
            $d_bast['y']                = $this->M_Dashboard->getCountBastApproved($value);
            $d_bast['drilldown']        = strval($value);
            array_push($bast['data'], $d_bast);
        }


        foreach ($bast['data'] as $key => $value) {

            $bastDrilldown['name']  =   $value['name'];
            $bastDrilldown['id']    =   $value['name'];
            $bastDrilldown['data']  = array();
            
            foreach ($month as $key1 => $value1) {
                $d_bastDrilldown = array();
                array_push($d_bastDrilldown,date('F', mktime(0, 0, 0, $value1, 10)));
                array_push($d_bastDrilldown,$this->M_Dashboard->getCountBastApproved($value['name'],$value1)) ;
                array_push($bastDrilldown['data'],$d_bastDrilldown);
                unset($d_bastDrilldown);
            }
            
            array_push($t_bastDrilldown, $bastDrilldown);
        }
        $data['bast']           = $bast;
        $data['bastDrilldown']  = $t_bastDrilldown;
        
        foreach ($segmen as $key => $value) {
            array_push($data['segmen']['s_name'], $value['SEGMEN']);
            array_push($segmen_value, floatval(number_format($this->M_Dashboard->getSegemenProjectsValue($value['SEGMEN']), 2, '.', '')));
            }     

            foreach ($scale as $key1 => $value1) {
                $d_segmen_scale['name'] = $value1;
                $d_segmen_scale['data'] = array();

                switch ($value1) {
                case "BIG":
                    $d_segmen_scale['color'] = '#0b8fc1';
                    break;
                case "MEGA":
                     $d_segmen_scale['color'] = '#0fc13e';
                    break;
                case "ORDINARY":
                     $d_segmen_scale['color'] = '#bfbfbf';
                    break;
                default:
                    $d_segmen_scale['color'] = '#d810a6';
                     }

                foreach ($segmen as $key => $value) {
                    array_push($d_segmen_scale['data'], $this->M_Dashboard->getScaleSegmen($value1,$value['SEGMEN']));
                }

                array_push($segmen_scale, $d_segmen_scale);
            }


            foreach ($status_active as $key2 => $value2) {
                $d_segmen_status['name'] = $value2;
                $d_segmen_status['data'] = array();

                switch ($value2) {
                case "LEAD":
                    $d_segmen_status['color'] = '#0fc13e';
                    break;
                case "LAG":
                     $d_segmen_status['color'] = '#ffc107';
                    break;
                case "DELAY": 
                     $d_segmen_status['color'] = '#da1213';
                    break;
                default:
                    $d_segmen_status['color'] = '#d810a6';
                     }

                foreach ($segmen as $key => $value) {
                    array_push($d_segmen_status['data'], intval($this->M_Dashboard->getSegemenProjectsProgress($value['SEGMEN'],$value2)));
                }
                   array_push($segmen_status, $d_segmen_status);  
            }

            //echo $this->db->last_query();die;
        $data['segmen_scale']   = $segmen_scale;
        $data['segmen_value']   = $segmen_value ;
        $data['segmen_status']  = $segmen_status ;
        $potential              = $this->M_Dashboard->get_total_potential_scaling();
        $data['scaling']        = $data['scaling_week']= 0;
       // echo $this->db->last_query();die;
        foreach ($potential as $key => $value) {
            $data['scaling']        = $value['POTENTIAL'] + $data['scaling'];
            $data['scaling_week']   = $value['POTENTIAL_WEEK'] + $data['scaling_week'];
        }

        $data['scaling']        = floor($data['scaling']);
        $data['scaling_week']   = floor($data['scaling_week']);

        $data['target']         = $this->M_Dashboard->getTarget()['TARGET'];
        $data['real']           = $this->M_Dashboard->getTargetValid()['TARGET'];

        $data['regional']['path05']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('1')."</span>";
        $data['regional']['path14']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('2')."</span>";
        $data['regional']['path12']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('3')."</span>";
        $data['regional']['path13']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('4')."</span>";
        $data['regional']['path17']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('5')."</span>";
        $data['regional']['path21']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('6')."</span>";
        $data['regional']['path32']           = "<span class='reg_marker'>".$this->M_Dashboard->countProjectByRegional('7')."</span>"; 
        $this->adminView("dashboard/index",$data,'Dashboard');         
    }

     // View Chart Project Scale
    private function get_chart_project_scale(){
        $start   = !empty($this->input->post('d_start'))? $this->input->post('d_start') : null;
        $end     = !empty($this->input->post('d_end'))? $this->input->post('d_end') : null;
        $dataz   =$this->M_Dashboard->get_chart_scale($start, $end);
        foreach ($dataz as $key1 => $value1) {
           $total = array();
           
            $dataz[$key1]['Y'] = intval($dataz[$key1]['Y']); 
            $dataz[$key1]['drilldown'] = array();
            $dataz[$key1]['drilldown']['name']           = $value1['name'];
            $dataz[$key1]['drilldown']['data']           = $total;
            $dataz[$key1]['drilldown']['value']          = intval($dataz[$key1]['V']);
            switch ($value1['name']) {
                case "BIG":
                    $dataz[$key1]['color'] = '#0b8fc1';
                    break;
                case "MEGA":
                     $dataz[$key1]['color'] = '#0fc13e';
                    break;
                case "ORDINARY":
                     $dataz[$key1]['color'] = '#bfbfbf';
                    break;
                default:
                      $dataz[$key1]['color'] = '#d810a6';
            }
        }
        //echo json_encode($dataz);die;
        return  $dataz;   
    }


    // View Chart Project Progress
    private function get_chart_progress(){
        $start   = !empty($this->input->post('start'))? $this->input->post('start') : null;
        $end     = !empty($this->input->post('end'))? $this->input->post('end') : null;
        $data           = $this->M_Dashboard->get_chart_by_status($start, $end);
        $type           = array();
        $type_project   = $this->get_project_type();

        foreach ($type_project as $key => $value) {
            array_push($type, $value['VALUE']);
        }

        foreach ($data as $key1 => $value1) {
           $total = array();
           
            foreach ($type as $key2 => $value2) {
               array_push($total, intval($this->M_Dashboard->get_chart_by_status_type($value1['name'],$value2, $start, $end)));
                
            }
            $data[$key1]['Y'] = intval($data[$key1]['Y']); 
            $data[$key1]['drilldown'] = array();
            $data[$key1]['drilldown']['name']           = $value1['name'];
            $data[$key1]['drilldown']['categories']     = $type;
            $data[$key1]['drilldown']['data']           = $total;
            switch ($value1['name']) {
                case "LEAD":
                    $data[$key1]['color'] = '#0fc13e';
                    break;
                case "LAG":
                     $dataz[$key1]['color'] = '#ffc107';
                    break;
                case "DELAY":
                     $data[$key1]['color'] = '#F42021';
                    break;
                default:
                      $dataz[$key1]['color'] = '#b0b0b0';
            }
        }
        return $data;
    }


    
}

?>