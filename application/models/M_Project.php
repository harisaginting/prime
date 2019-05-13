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

}