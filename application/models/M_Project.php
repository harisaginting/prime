<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_Project extends CI_Model
{
    public function __construct() {
        parent::__construct();       
    }


   function get_project($id_project){
   		$this->db->select("A.*, TO_CHAR(A.START_DATE, 'DD MONTH YYYY') START_DATE2, TO_CHAR(A.END_DATE, 'DD MONTH YYYY') END_DATE2, TO_CHAR(A.UPDATED_DATE, 'DD MONTH YYYY') UPDATED_DATE2, A.START_DATE START_DATEX, B.ACH, B.PLAN, (A.END_DATE - A.START_DATE) DAY_DURATION, ROUND(SYSDATE - A.START_DATE) CURRENT_DAY, A.COUNT_OF_WEEK TOTAL_WEEK");
		$data = $this->db
						->from("PRIME_PROJECT A")
						->join("PRIME_MONITORING_PROJECT B","A.ID_PROJECT = B.ID_PROJECT","LEFT")
						->where('A.ID_PROJECT', $id_project)
						->get()
						->row_array();

		// get partnert
		$data['partners'] 	= 	$this->db
				->select("A.*, CASE WHEN LINK_P8 LIKE '%../%' THEN 'https://prime.telkom.co.id/'||LINK_P8  ELSE LINK_p8 END LINK_P82")
				->from('PRIME_PROJECT_PARTNERS A')
				->where('ID_PROJECT',$id_project)
				->get()
				->result_array();

		if(!empty($data['PM_NIK'])){
					$data['pm'] 	= 	$this->db
						->select("*")
						->from('PRIME_USERS A')
						->where('NIK',$data['PM_NIK'])
						->get()
						->row_array();
				}

		$data['document']  	= $this->db
					  ->select('*')
					  ->from('PRIME_PROJECT_DOCUMENT')
					  ->where('ID_PROJECT',$id_project)
					  ->order_by('CATEGORY','ASC')
					  ->get()->result_array();

		$data['bast'] 		= $this->db->select('A.*')
			     ->from('PRIME_BAST_HGN A')
			     ->join('PRIME_PROJECT_PARTNERS B','B.NO_P8 = A.NO_SPK')
			     ->where('B.ID_PROJECT',$id_project)
			     ->where('A.EXIST','1')
			     ->order_by('TGL_BAST')
			     ->distinct()->get()->result_array();

		$data['history']	= $this->db
								->select('*')
								->from('PRIME_HISTORY')
								->where('ID',$id_project)
								->order_by('DATE_CREATED','desc')->get()->result_array();
		return $data;

   }

  	function get_project_current_week($id){
		$q = $this->db->select("ceil((SYSDATE-A.START_WEEK_1+1)/7) VAL")->from("PRIME_PROJECT A")->where("A.ID_PROJECT",$id)->get()->row()->VAL;
		return $q;
	}

	function get_project_current_plan($id,$current_week){
		$q = $this->db->query("SELECT PLAN FROM PRIME_PROJECT_S_CURVE_WEEK A
                                        WHERE ID_PROJECT = '".$id."'
                                        AND ROWNUM <= 1
                                        AND WEEK = ".$current_week)->row_array();
		$v = 0;
		if(!empty($q['PLAN'])){
			$v= $q['PLAN'];
		}
		return $v;

	} 

	function get_project_curva_s($id_project) {
			$query = $this->db->query("	SELECT 'WEEK #'||NVL(WEEK,0) WEEKS, NVL(PLAN,0) PLAN,REAL, PERIODE
										FROM PRIME_PROJECT_S_CURVE_WEEK
										WHERE ID_PROJECT = '$id_project' 
										ORDER BY WEEK ASC");
			
			$arrData = array(
					'WEEK' => array_column($query->result_array(), "WEEKS"),
					'PLAN' => array_column($query->result_array(), "PLAN"),
					'REAL' => array_column($query->result_array(), "REAL"),
					'PERIOD' => array_column($query->result_array(), "PERIODE"),
				);
			return $arrData;
		}

	function get_project_acquisition_s_curve($id_project){
			$query = $this->db->query("	SELECT MONTH, YEAR, A_VALUE REAL, T_VALUE PLAN, MONTH||'/'||YEAR PERIOD, A_NOTE NOTE
										,NVL(T_PROGRESS,0) PROG1, NVL(A_PROGRESS,0) PROG2, TOP_EXPLANATION EXP
											FROM PRIME_PROJECT_ACQ
											WHERE ID_PROJECT = '$id_project' 
											ORDER BY YEAR, MONTH ASC");
				
				$arrData = array(
						'MONTH' => array_column($query->result_array(), "MONTH"),
						'YEAR' => array_column($query->result_array(), "YEAR"),
						'PLAN' => array_column($query->result_array(), "PLAN"),
						'REAL' => array_column($query->result_array(), "REAL"),
						'PERIOD' => array_column($query->result_array(), "PERIOD"),
						'NOTE' => array_column($query->result_array(), "NOTE"),
						'PROG1' => array_column($query->result_array(), "PROG1"),
						'PROG2' => array_column($query->result_array(), "PROG2"),
						'EXP' => array_column($query->result_array(), "EXP"),
					);
				return $arrData;
		}

	function get_project_progress($id_project) {
				return $this->db->query("	SELECT SUM(WEIGHT) WEIGHT, SUM(PROGRESS_VALUE) ACHIEVEMENT
											FROM PRIME_PROJECT_DELIVERABLES
											WHERE ID_PROJECT='$id_project'")->row();
		}


	function get_project_symptoms($id_project){
			$query = $this->db
					->select("A.*, TO_CHAR(DATE_CREATED,'DD MONTH YYYY') DATES")
					->from("PRIME_PROJECT_SYMPTOM A")
					->where('ID_PROJECT' , $id_project)
					->order_by('DATE_CREATED','DESC')
					->get()
					->result_array();
			return $query;
		}

	function get_project_issue($id_project){
			$data = $this->db
					->select("*")
					->from("PRIME_PROJECT_ISSUE")
					->where("ID_PROJECT",$id_project)
					->order_by("STATUS_ISSUE","DESC")
					->order_by("ISSUE_NAME","ASC")
					->get()
					->result_array();
			return $data;

		}

	function get_project_deliverables_for_assign($id_project){
			$data = $this->db
					->select("A.*, TO_CHAR(END_DATE,'DD/MM/YYYY') END_DATE2, TO_CHAR(START_DATE, 'DD/MM/YYYY') START_DATE2")
					->from("PRIME_PROJECT_DELIVERABLES A")
					->where("ID_PROJECT",$id_project)
					->get()
					->result_array();
			return $data;

		}

	function get_project_deliverables($id_project){
			$data = $this->db
					->select("A.*, TO_CHAR(END_DATE,'DD/MM/YYYY') END_DATE2, TO_CHAR(START_DATE, 'DD/MM/YYYY') START_DATE2")
					->from("PRIME_PROJECT_DELIVERABLES A")
					->where("ID_PROJECT",$id_project)
					->get()
					->result_array();
			return $data;

		}

	function get_deliverable_issue($id_deliverable){
			$data = $this->db
					->select("*")
					->from("PRIME_PROJECT_ISSUE")
					->where("ID_DELIVERABLE",$id_deliverable)
					->order_by("STATUS_ISSUE","DESC")
					->order_by("ISSUE_NAME","ASC")
					->get()
					->result_array();
			return $data;

		}
		
	function get_project_actionPlan	($id_issue){
			$data = $this->db
					->select("*")
					->from("PRIME_PROJECT_ACTION_PLAN")
					->where("ID_ISSUE",$id_issue)
					->order_by("ACTION_STATUS","DESC")
					->order_by("ACTION_NAME","ASC")
					->get()
					->result_array();
			return $data;
		}

	function get_project_acquisition($id_project,$month,$year){
			if(empty($year)){
			$year = date('Y');	
		}

		$q = $this->db->select('A.*')
				->from('PRIME_PROJECT_ACQ A')
				->where('ID_PROJECT',$id_project)
				->where('MONTH', $month)
				->where('YEAR', $year);

		return $q->get()->row_array();

		}

	// GET DELIVERABLE 
	function get_deliverable($id_dev) {
				$query = $this->db->query("SELECT ID_DELIVERABLE,A.ID_PROJECT,A.NAME,TO_CHAR(WEIGHT,'900.00') WEIGHT,TO_CHAR(A.START_DATE,'MM/DD/YYYY') START_DATE,
											       TO_CHAR(A.END_DATE,'MM/DD/YYYY') END_DATE,A.DESCRIPTION, NVL(A.PROGRESS_VALUE,0) ACHIEVEMENT, B.ID_LOP_EPIC, STATUS, REASON_OF_DELAY, A.ATTACHMENT, TO_CHAR(A.LAST_UPDATE, 'DD MONTH YYYY, HH24:MI') LAST_UPDATE2
											FROM PRIME_PROJECT_DELIVERABLES A, PRIME_PROJECT B
											WHERE A.ID_PROJECT = B.ID_PROJECT
											AND ID_DELIVERABLE='{$id_dev}'")->row_array();
				return $query;
	}


	// UPDATE DELIVERABLE
		function update_deliverable($data){
					$idPro = $data['ID_PROJECT'];	
					$idDev = $data['ID_DELIVERABLE'];

					$this->db->set('NAME',  $data['NAME']);
					$this->db->set('WEIGHT',  $data['WEIGHT']);
					$this->db->set('DESCRIPTION',  $data['DESCRIPTION']);
					$this->db->set('PROGRESS_VALUE',$data['PROGRESS_VALUE']);
					$this->db->set('START_DATE', "to_date('".$data['START_DATE']."','MM/DD/YYYY')",false);
					$this->db->set('END_DATE', "to_date('".$data['END_DATE']."','MM/DD/YYYY')",false);
					
					$this->db->set('LAST_UPDATE', "to_date('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",false);
					$this->db->set('LAST_UPDATED_BY',  $this->session->userdata('nik_sess'));

					$this->db->where('ID_DELIVERABLE', $data['ID_DELIVERABLE']);
					$query = $this->db->update('PRIME_PROJECT_DELIVERABLES');
					// call procedure
					$this->db->query("call PRIME_MONITORING_PROJ_SINGLE('$idPro')");
					$this->db->query("BEGIN PRIME_MONITORING_PROJECT_PROC; END;");
					return $query;
		}


	// ADD ISSUE
	function add_issue($data) {
		$this->db->set('ID_ISSUE',  $data['ID_ISSUE']);
		$this->db->set('ID_PROJECT',  $data['ID_PROJECT']);
		$this->db->set('ID_DELIVERABLE',  $data['ID_DELIVERABLE']);
		$this->db->set('ISSUE_NAME',  $data['ISSUE_NAME']);
		$this->db->set('STATUS_ISSUE',  "OPEN");			
		$this->db->set('RISK_IMPACT',  $data['RISK_IMPACT']);			
		$this->db->set('IMPACT',  $data['IMPACT']);
		$this->db->set('IN_CHARGE',  $data['IN_CHARGE']);
		$this->db->set('CATEGORY',  $data['CATEGORY']);


		$this->db->set('INSERTED_DATE', "to_date('".date('d/m/Y H:i:s')."','DD/MM/YYYY HH24:MI:SS')",false);
		$this->db->set('INSERTED_BY_ID',  $this->session->userdata('nik_sess'));
		$this->db->set('INSERTED_BY_NAME',  $this->session->userdata('nama_sess'));
		$this->db->set('LAST_UPDATED_BY',  $this->session->userdata('nik_sess'));
		$this->db->set('LAST_UPDATE', "to_date('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",false);
		
		return $this->db->insert('PRIME_PROJECT_ISSUE');
	}


	// GET ISSUE
		function get_issue($id){
			$q = $this->db
					->select("A.*, TO_CHAR(A.ISSUE_CLOSED_DATE, 'MM/DD/YYYY') CLOSED_DATE")
					->from('PRIME_PROJECT_ISSUE A')
					->where('ID_ISSUE',$id)
					->get()
					->row_array();
			return $q;
		}

		// UPDATE ISSUE
		function update_issue($id_issue,$data){
					$this->db->set('ID_PROJECT',  $data['ID_PROJECT']);
					$this->db->set('ISSUE_NAME',  $data['ISSUE_NAME']);
					$this->db->set('RISK_IMPACT',  $data['RISK_IMPACT']);
					$this->db->set('IMPACT',  $data['IMPACT']);
					$this->db->set('STATUS_ISSUE',  $data['STATUS_ISSUE']);
					$this->db->set('IN_CHARGE',  $data['IN_CHARGE']);
					$this->db->set('CATEGORY',  $data['CATEGORY']);
					$this->db->set('LAST_UPDATED_BY',  $this->session->userdata('nik_sess'));
					$this->db->set('LAST_UPDATE', "to_date('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",false);
					
					if($data['STATUS_ISSUE'] == 'CLOSED'){
						$this->db->set('ISSUE_CLOSED_DATE',  "to_date('".$data['ISSUE_CLOSED_DATE']."','MM/DD/YYYY')",false);
					}

					$this->db->where('ID_ISSUE', $id_issue);
					return $this->db->update('PRIME_PROJECT_ISSUE');
		}




	// Update Log Project
	function updateLogProject($id_project){
    	$this->db->set('UPDATED_DATE',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
    	$this->db->set('UPDATED_BY_ID',$this->session->userdata('nik_sess'));
    	$this->db->set('UPDATED_BY_NAME',$this->session->userdata('nama_sess'));
    	$this->db->where('ID_PROJECT', $id_project);       
    	return $this->db->update('PRIME_PROJECT');
    }	


   function updateProjectHistory($data){
        $this->db->set('UPDATED_DATE',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
        $this->db->set('UPDATED_BY_ID',$data['ID_USER']);
        $this->db->set('UPDATED_BY_NAME',$data['NAME_USER']);
        $this->db->set('UPDATE_ACTION',$data['STATUS']);
        $this->db->where('ID_PROJECT',$data['ID']);
        $this->db->update('PRIME_PROJECT'); 
       //echo json_encode($data);die;
       return true;   
    }

    // ADD ACTION
	function add_action($data,$dataPIC){
		$this->db->set('ID_ACTION_PLAN',  $data['ID_ACTION_PLAN']);
		$this->db->set('ID_PROJECT',  $data['ID_PROJECT']);
		$this->db->set('ID_ISSUE',  $data['ID_ISSUE']);			
		$this->db->set('ACTION_NAME',  $data['ACTION_NAME']);
		$this->db->set('ASSIGN_TO',  $data['ASSIGN_TO']);
		$this->db->set('ASSIGN_TO_DETAIL',  $data['ASSIGN_TO_DETAIL']);
		$this->db->set('ACTION_STATUS',  "OPEN");
		$this->db->set('ACTION_REMARKS',  $data['ACTION_REMARKS']);
		$this->db->set('DUE_DATE', "to_date('".$data['DUE_DATE']."','MM/DD/YYYY')",false);
		$this->db->set('INSERTED_DATE', "to_date('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",false);
		$this->db->set('INSERTED_BY_ID',  $this->session->userdata('nik_sess'));
		$this->db->set('INSERTED_BY_NAME',  $this->session->userdata('nama_sess'));
		$this->db->set('LAST_UPDATED_BY',  $this->session->userdata('nik_sess'));
		$this->db->set('LAST_UPDATE', "to_date('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",false);
		$query = $this->db->insert('_PROJECT_ACTION_PLAN');

		$idPro = $data['ID_PROJECT'];
		if(!empty($dataPIC)){
			$this->db->insert_batch('PRIME_ACTION_PLAN_PIC', $dataPIC);
		}
		return true;
	}

	// UPDATE ACTION
	function update_action($data,$pic){
		$this->db->set('ACTION_NAME',  $data['ACTION_NAME']);
		$this->db->set('ACTION_STATUS',  $data['ACTION_STATUS']);
		$this->db->set('ACTION_REMARKS',  $data['ACTION_REMARKS']);
		$this->db->set('LAST_UPDATED_BY',  $this->session->userdata('nik_sess'));
		$this->db->set('DUE_DATE', "to_date('".$data['DUE_DATE']."','MM/DD/YYYY')",false);
		if(!empty($data['ACTION_CLOSED_DATE'])){
			$this->db->set('ACTION_CLOSED_DATE', "to_date('".$data['ACTION_CLOSED_DATE']."','MM/DD/YYYY')",false);
		}	
		$this->db->set('LAST_UPDATE', "to_date('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",false);
		$this->db->where('ID_ACTION_PLAN',$data['ID_ACTION_PLAN']);
		$this->db->update('PRIME_PROJECT_ACTION_PLAN');
	
		$idPro = $data['ID_PROJECT'];
		//echo $this->db->last_query();die;
		// $this->db->query("call PRIME_MONITORING_PROJ_SINGLE('$idPro')");
		if(!empty($pic)){
			$this->db->where('ID_ACTION_PLAN', $data['ID_ACTION_PLAN']);
			$this->db->delete('PRIME_ACTION_PLAN_PIC');			
			$this->db->insert_batch('PRIME_ACTION_PLAN_PIC', $pic);
		}
		return true;

	}


	function get_action($id){
			// get project list
			$dataPro = $this->db->query("	SELECT A.*, B.*, TO_CHAR(A.DUE_DATE,'MM/DD/YYYY') DUE_DATE_N, TO_CHAR(A.LAST_UPDATE, 'DD MONTH YYYY, HH24:MI') LAST_UPDATE2
											FROM PRIME_PROJECT_ACTION_PLAN A, PRIME_PROJECT_ISSUE B
											WHERE A.ID_ISSUE = B.ID_ISSUE(+)
											AND A.ID_ACTION_PLAN='$id'")->row_array();

			// get partnert list
			$this->db->where('ID_ACTION_PLAN', $id);
			$dataPart = $this->db->get('PRIME_ACTION_PLAN_PIC')->result_array();
			$dataPro['pics'] = $dataPart;
			return $dataPro;
		}


	// DELETE ACTION PLAN
	function delete_action($id_project,$id_action){
		$this->db->where('ID_ACTION_PLAN',$id_action);
		if($this->db->delete('PRIME_PROJECT_ACTION_PLAN')){
			$this->db->query("call PRIME_MONITORING_PROJ_SINGLE('$id_project')");
			return true;
		}
		return false;
	}

	// DELETE ISSUE
	function delete_issue($id_project,$id_issue){
		$this->db->where('ID_ISSUE',$id_issue);
		if($this->db->delete('PRIME_PROJECT_ISSUE')){
			$this->db->query("call PRIME_MONITORING_PROJ_SINGLE('$id_project')");
			return true;
		}
		return false;
	}

	function delete_deliverable($id_project,$id_deliverable){
		$this->db->where('ID_DELIVERABLE',$id_deliverable);
		if($this->db->delete('PRIME_PROJECT_DELIVERABLES')){
			$this->db->query("call PRIME_MONITORING_PROJ_SINGLE('$id_project')");
			return true;
		}
		return false;
	}


	function add_document($data){
		$this->db->insert('PRIME_PROJECT_DOCUMENT', $data);
	}

	// SAVE UPDATE ACQUISITION
	function update_acquisition($id_project,$month,$year,$data){
		$method = "add";
		$id 	= $this->db->select("ID")->from("PRIME_PROJECT_ACQ")
				 ->where("ID_PROJECT",$id_project)
				 ->where("MONTH",$month)
				 ->where("YEAR",$year)
				 ->get()->row();
		if(!empty($id)){
			$method= "update";
		}

		foreach ($data as $key => $value) {
				if($key=='UPDATED_DATE'){
					$this->db->set('UPDATED_DATE', "to_date('".date('d/m/Y H:i:s')."','DD/MM/YYYY HH24:MI:SS')",false);
					}
				if(($method=="update")&&($key == "ID")){

				}
				else{
					if(!empty($value)){  
						$this->db->set($key , $value);
					}
					
				}
		}
		
		if($method == "update"){
			$this->db->where("ID",$id->ID);
			return $this->db->update("PRIME_PROJECT_ACQ");
		}else{
			if(!empty($data['T_VALUE'])){
				$this->db->set('A_VALUE' , $data['T_VALUE']);
			}
			
			if(!empty($data['T_NOTE'])){
				$this->db->set('A_NOTE'  , $data['T_NOTE']);
			}
			
			$this->db->set('CREATED_DATE', "to_date('".date('d/m/Y H:i:s')."','DD/MM/YYYY HH24:MI:SS')",false);
			$this->db->set('CREATED_BY', $this->session->userdata('nik_sess'));
			return $this->db->insert("PRIME_PROJECT_ACQ");
		}
	}


	function update_field_project($id_project,$keys,$value){
			foreach ($keys as $key => $isi) {
				if($keys[$key]	==	'START_DATE'){
					$this->db->set("START_DATE","TO_DATE('".$value[$key]."','MM/DD/YYYY')",FALSE);
					}
				else if($keys[$key]	 ==	'END_DATE'){
					$this->db->set("END_DATE","TO_DATE('".$value[$key]."','MM/DD/YYYY')",FALSE);
					}
				else{
						if(!empty($isi)){  
							$this->db->set($keys[$key] , $value[$key] );
						}
					}
				}

			$this->db->where('ID_PROJECT',$id_project);
			return $this->db->update('PRIME_PROJECT');
		}

	// Add Symptom
	function addSymptom($data){
		return $this->db->insert('PRIME_PROJECT_SYMPTOM',$data);
	}
}