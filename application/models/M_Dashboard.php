<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {
 
	function get_total_project_active($type = null){
		$q = $this->db
			->select('COUNT(1) TOTAL')
			->from("PRIME_PROJECT A")
			->where_in('STATUS',array('LEAD','LAG','DELAY'))
			->where("EXIST",1);

		if(!empty($this->session->userdata("mitra_name"))){$q = $q->like('B.PARTNERS',$this->session->userdata("mitra_name"));}

		if(!empty($type)){$q = $q->where("TYPE",$type);}
		$q 		= $q->get()->row_array();
		$result = 0;
		if(!empty($q['TOTAL'])){$result = $q['TOTAL'];}

		return $result;
	}

	function get_chart_scale($start = null, $end = null){
		$this->db->select("SCALE name, count(*) as Y, SUM(VALUE) as V ")
					->from('PRIME_PROJECT A')
					->where_in('A.STATUS',array('LEAD','LAG','DELAY'));
		

		if(!empty($this->session->userdata("mitra_name"))){
						$this->db->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}
		
		if(!empty($start)){
		
			$this->db->where("START_DATE >="," TO_DATE('".$start."','MM/DD/YYYY')",false);
		}		

		if(!empty($end)){
			$this->db->where("(CLOSED_DATE <=  TO_DATE('".$end."','MM/DD/YYYY') OR CLOSED_DATE IS NULL)");
			$this->db->where("END_DATE <= TO_DATE('".$end."','MM/DD/YYYY') ");
		}	

		$regional1 =    $this->session->userdata('regional');
                    if($regional1 != '0' && !empty($regional1)){
                        $this->db->where('REGIONAL', $regional1);
                    }
						  
		return $this->db->where('EXIST',1)->group_by('SCALE')->get()->result_array();				  
	}


	function getChartProjectClosed($month = null,$type = null,$year = null){
		$q = $this->db
				->select('COUNT(1) Y')
				->from('PRIME_PROJECT A')
				->where('STATUS','CLOSED');
		

		if(!empty($this->session->userdata("mitra_name"))){
						$q = $q->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}


		if(!empty($month)){
			$q = $q->where("EXTRACT(MONTH FROM TO_DATE(CLOSED_DATE)) = ".$month);
		}

		if(!empty($year)){
			$q = $q->where("EXTRACT(YEAR FROM TO_DATE(CLOSED_DATE)) = ".$year);
		}

		if(!empty($type)){
			$q = $q->where("SCALE",$type);
		}

		$q  = $q->get()->row_array();

		if(!empty($q['Y'])){
			return intval($q['Y']);
		}else{
			return 0;
		}
	}


	function getScaleSegmen($scale,$segmen){
		$q = $this->db
				->select("COUNT(1) TOTAL")
				->from("PRIME_PROJECT A")
				->where("SCALE",$scale)
				->where("SEGMEN",$segmen)
				->where("EXIST",1)
				->where_in("STATUS",array("LEAD","LAG","DELAY"));


		if(!empty($this->session->userdata("mitra_name"))){
						$q = $q->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}

		$q = $q->get()->row_array();

		if(empty($q['TOTAL'])){
			return 0;
		}else{
			return intval($q['TOTAL']);
		}

	}

	function getSegemenProjectsValue($segmen){
		$q = $this->db
				->select("SUM(VALUE) TOTAL")
				->from("PRIME_PROJECT A")
				->where("SEGMEN",$segmen)
				->where("EXIST",1)
				->where_in("STATUS",array("LEAD","LAG","DELAY"));


		if(!empty($this->session->userdata("mitra_name"))){
						$q = $q->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}
		$q = $q->get()->row_array();

		if(empty($q['TOTAL'])){
			return 0;
		}else{
			return floatval($q['TOTAL']/1000000000);
		}
	}

	function getSegemenProjectsProgress($segmen,$status){
		$q = $this->db
			 	->select("COUNT(1) TOTAL")
			 	->from("PRIME_PROJECT A")
			 	->where("SEGMEN",$segmen)
			 	->where("STATUS",$status)
			 	->where("EXIST",1)
			 	->where_in("STATUS",array("LEAD","LAG","DELAY"));


		if(!empty($this->session->userdata("mitra_name"))){
						$q = $q->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}
		$q = $q->get()->row_array();

		if(empty($q['TOTAL'])){
			return 0;
		}else{
			return floatval($q['TOTAL']);
		}

	}


	function getCountBastApproved($year, $month = null){
		if(empty($month)){
			$q = $this->db
				->select("COUNT(1) TOTAL")
				->from("PRIME_BAST_HGN A")
				->where("EXTRACT(YEAR FROM TO_DATE(TGL_BAST)) =". $year)
				->where("BAPP = 0")
				->where("EXIST",1);
				
				if(!empty($this->session->userdata("mitra"))){
						$q = $q->where('A.ID_MITRA',$this->session->userdata("mitra"));
					}

				$q = $q->get()->row_array();
			}else{
				$q = $this->db
				->select("COUNT(1) TOTAL")
				->from("PRIME_BAST_HGN A")
				->where("EXTRACT(YEAR FROM TO_DATE(TGL_BAST)) =". $year)
				->where("EXTRACT(MONTH FROM TO_DATE(TGL_BAST)) =". $month)
				->where("EXIST",1);
				
				if(!empty($this->session->userdata("mitra"))){
						$q = $q->where('A.ID_MITRA',$this->session->userdata("mitra"));
					}

				$q = $q->get()->row_array();
			}
		//echo $this->db->last_query();die;
		if(empty($q['TOTAL'])){
			return 0;
		}else{
			return intval($q['TOTAL']);
		}
	}

	function getCountBastApprovedValue($year, $month = null){
		if(empty($month)){
			$q = $this->db
				->select("SUM(NILAI_RP_BAST)/1000000000 TOTAL")
				->from("PRIME_BAST_HGN A")
				->where("EXTRACT(YEAR FROM TO_DATE(TGL_BAST)) =". $year)
				->where("EXIST",1);
				
				if(!empty($this->session->userdata("mitra"))){
						$q = $q->where('A.ID_MITRA',$this->session->userdata("mitra"));
					}

				$q = $q->get()->row_array();
			}else{
				$q = $this->db
				->select("SUM(NILAI_RP_BAST)/1000000000 TOTAL")
				->from("PRIME_BAST_HGN A")
				->where("EXTRACT(YEAR FROM TO_DATE(TGL_BAST)) =". $year)
				->where("EXTRACT(MONTH FROM TO_DATE(TGL_BAST)) =". $month)
				->where("EXIST",1);
				
				if(!empty($this->session->userdata("mitra"))){
						$q = $q->where('A.ID_MITRA',$this->session->userdata("mitra"));
					}

				$q = $q->get()->row_array();
			}

		if(empty($q['TOTAL'])){
			return 0;
		}else{
			return intval($q['TOTAL']);
		}
	}

	function getCountProject($status = null){
		if($status == 'ACTIVE'){
			$q = $this->db
				->select('COUNT(1) TOTAL')
				->from("PRIME_PROJECT A")
				->where_in("STATUS",array("LEAD","LAG","DELAY"))
				->where("EXIST",1)
				->get()
				->row_array();
		}else{
			$q = $this->db
				->select('COUNT(1) TOTAL')
				->from("PRIME_PROJECT A")
				->where("STATUS",$status)
				->where("EXIST",1)
				->get()
				->row_array();
		}

		if(empty($q['TOTAL'])){
			return 0;
		}else{
			return $q['TOTAL'];
		}
	}


	function get_total_project_pm(){
		$q = $this->db
				->select("COUNT(1) T")
			    ->from("PRIME_USERS A")
			    ->where("NIK IN (SELECT PM_NIK FROM PRIME_PROJECT WHERE STATUS IN ('LEAD','LAG','DELAY'))")
			    ->get()
			    ->row_array();

		//echo $this->db->last_query();die;
		if($q['T']==0){
			return 0;
		}else{
			return intval($q['T']);
		}
	}

	function get_total_bast_progress(){
		$q = $this->db
			->select("count(1) T")
			->from("PRIME_BAST_HGN")
			->where_in("STATUS", array("RECEIVED","CHECK BY ADM","CHECK BY SE PMO", "CHECK BY SE DI","CHECK BY COORD","SUBMIT BY PARTNER","APPROVED"))
			->where("EXIST",1)
			->get()
			->row_array();


		if(empty($q['T'])){
			return 0;
		}else{
			return intval($q['T']);
		}
	}

	function get_total_bast_revision(){
		$q = $this->db
			->select("count(1) T")
			->from("PRIME_BAST_HGN")
			->where_in("STATUS", array("REVISION","REVISIONED"))
			->where("EXIST",1)
			->get()
			->row_array();

		if(empty($q['T'])){
			return 0;
		}else{
			return intval($q['T']);
		}
	}

	function get_chart_by_status($start = null, $end = null){
		/*$q 		= $this->db->query("select count(*) TOTAL from PRIME_PROJECT where STATUS in ('LEAD','LAG','DELAY')")->row();
		$total =  $q->TOTAL;*/

		$this->db->select("A.STATUS name, count(*) as Y");
		$this->db->from('PRIME_PROJECT A');
		$this->db->where_in('STATUS',array('LEAD','LAG','DELAY'));
		

		if(!empty($this->session->userdata("mitra_name"))){
						$this->db->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}



		if(!empty($start)){
		
			$this->db->where("START_DATE >="," TO_DATE('".$start."','MM/DD/YYYY')",false);
		}		

		if(!empty($end)){
			$this->db->where("(CLOSED_DATE <=  TO_DATE('".$end."','MM/DD/YYYY') OR CLOSED_DATE IS NULL)");
			$this->db->where("END_DATE <= TO_DATE('".$end."','MM/DD/YYYY') ");
		}	

		$regional1 =    $this->session->userdata('regional');
                    if($regional1 != '0' && !empty($regional1)){
                        $this->db->where('REGIONAL', $regional1);
                    }
						  
		return $this->db->where('EXIST',1)->group_by('STATUS')->get()->result_array();				  
	}

	
	function get_chart_by_status_type($status,$type,$start = null, $end = null){
		$this->db->select("count(*) T");
		$this->db->from('PRIME_PROJECT A');
		$this->db->where_in('A.STATUS',array('LEAD','LAG','DELAY'));
		

		if(!empty($this->session->userdata("mitra_name"))){
						$this->db->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}


		if(!empty($start)){
		
			$this->db->where("START_DATE >="," TO_DATE('".$start."','MM/DD/YYYY')",false);
		}		

		if(!empty($end)){
			$this->db->where("(CLOSED_DATE <=  TO_DATE('".$end."','MM/DD/YYYY') OR CLOSED_DATE IS NULL)");
			$this->db->where("END_DATE <= TO_DATE('".$end."','MM/DD/YYYY') ");
		}	

		$regional1 =    $this->session->userdata('regional');
                    if($regional1 != '0' && !empty($regional1)){
                        $this->db->where('REGIONAL', $regional1);
                    }
		$this->db->where("STATUS",$status);				  
		$this->db->where("TYPE",$type);				  
		$res =  $this->db->where('EXIST',1)->get()->row();	
		//echo $res->T;die;
		return $res->T;			  
	}



	function countProjectByRegional($regional,$start  = null, $end = null){
		$arr 	= array('LEAD','LAG','DELAY');
		$q = $this->db
					->select("COUNT(1) TOTAL")
				  	->from("PRIME_PROJECT A")
				  	->where("PM_EXIST",1)
				  	->where("REGIONAL",$regional)
				  	->where_in("STATUS",$arr);

		if(!empty($this->session->userdata("mitra_name"))){
						$q = $q->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}



		if(!empty($start)){
		
			$q = $q->where("START_DATE >="," TO_DATE('".$start."','MM/DD/YYYY')",false);
		}		

		if(!empty($end)){
			$q = $q->where("(CLOSED_DATE <=  TO_DATE('".$end."','MM/DD/YYYY') OR CLOSED_DATE IS NULL)");
			$q = $q->where("END_DATE <= TO_DATE('".$end."','MM/DD/YYYY') ");
		}	


		return $q->get()->row()->TOTAL;
	}

	
	function getTarget($start = null, $end = null){
		$this->db->select("sum(ACQ) TARGET");
		$this->db->from('PRIME_PROJECT_TARGET A');
		$this->db->where('MONTH',intval(date('n')));
		

		if(!empty($this->session->userdata("mitra_name"))){
						$this->db->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}


		return $this->db->get()->row_array();
	}

	function getTargetValid($start = null, $end = null){
		$month = intval(date('n'))-1;
		if($month == 0){
			$month = 12;
		}
		$query = $this->db->select('SUM(ACQ) TARGET')
						  ->from('PRIME_PROJECT_TARGET A')
						  ->where('MONTH',$month)
						  ->where('VALID','1');

		if(!empty($this->session->userdata("mitra_name"))){
						$query = $query->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}


		return $this->db->get()->row_array();
		return $query->get()->row_array();
	}

	function getdDataSymptoms(){
		$query = $this->db
					->select("COUNT(1) TOTAL, REASON_OF_DELAY")
					->from("PRIME_PROJECT A")
					->where("A.EXIST",'1')
					->where("REASON_OF_DELAY IS NOT NULL")
					->where_in("A.STATUS",array("LAG","DELAY"))
					->order_by("TO_NUMBER(SUBSTR(A.REASON_OF_DELAY,0,2))","ASC",false)
					->group_by("A.REASON_OF_DELAY");

		if(!empty($this->session->userdata("mitra_name"))){
						$query = $query->like('B.PARTNERS',$this->session->userdata("mitra_name"));
					}

		return $query->get()->result_array();
	}	


	function get_total_potential_scaling(){
		$arr 	= array('LEAD','LAG','DELAY');
		$q 		= 	$this->db
	                        ->select("
	                        	A.ID_PROJECT,  
	                        	CASE 
	                        		WHEN A.STATUS = 'DELAY' THEN (((100 - TO_NUMBER(C.ACH)) / 100) * A.VALUE) 
	                        		WHEN C.ACH > C.PLAN THEN ((100 - TO_NUMBER(C.ACH))/100) * A.VALUE 
	                        		ELSE (((TO_NUMBER(NVL(C.PLAN,0)) - TO_NUMBER(C.ACH)) /100) * A.VALUE) 
	                        		END POTENTIAL_WEEK, 
	                        	(((100 - TO_NUMBER(C.ACH)) / 100) * A.VALUE) POTENTIAL ")
	                        ->from('PRIME_PROJECT A')
	                        ->join("PRIME_MONITORING_PROJECT C","C.ID_PROJECT = A.ID_PROJECT","LEFT")
	                        ->join("(
	                        		SELECT ID_PROJECT,
	                                        LISTAGG(PARTNER_NAME, ', ') WITHIN GROUP (ORDER BY ID_PROJECT) AS MITRA
	                                        FROM PRIME_PROJECT_PARTNERS
	                                        GROUP BY ID_PROJECT
	                        		) PARTNER","PARTNER.ID_PROJECT = A.ID_PROJECT","LEFT")
	                        ->where_in('A.STATUS', $arr) 
	                        ->where(1,1)
	                        ->where("A.EXIST","1");
					if(!empty($this->session->userdata("mitra_name"))){
						$q = $q->like('PARTNER.MITRA',$this->session->userdata("mitra_name"));
					}

	    return $q->get()->result_array();
	}
}