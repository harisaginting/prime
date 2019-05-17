<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_Datatable extends CI_Model
{
    public function __construct() {
        parent::__construct();       
    }


    ## Datatable Project Active
		var $column_orderActive = array('A.NAME','A.VALUE','ACH','A.END_DATE','UPDATED_DATE',null); //set column field database for datatable orderable
		var $column_searchActive = array('A.ID_PROJECT','UPPER(A.NAME)','UPPER(A.STANDARD_NAME)','UPPER(PARTNERS)','UPPER(A.TYPE)','UPPER(A.SEGMEN)','UPPER(A.NIP_NAS)','UPPER(A.PM_NAME)','A.STATUS',' A.ID_LOP_EPIC','A.NO_QUOTE'); //set column field database for datatable searchable
		var $orderActive = array('SEQ', 'desc'); // default order

		public function _get_all_queryActive($status,$pm,$customer,$partner,$type,$regional,$segmen){
			//$regional =	$this->session->userdata('regional');
			$arr = array('LAG','LEAD','DELAY','CANCEL');
			$query = $this->db
							/*->select('A.ID_PROJECT')*/
							->select("CASE A.STATUS WHEN 'LEAD' THEN 'success' WHEN 'LAG' THEN 'warning' ELSE 'danger' END INDICATOR, TO_NUMBER(SUBSTR(A.ID_PROJECT, 5,7)) SEQ, A.UPDATED_DATE,B.PARTNERS, A.ID_PROJECT ,A.NAME, A.TYPE ,A.PM_NAME ,A.DESCRIPTION , A.NIP_NAS NIP_NAS, A.STANDARD_NAME , A.SEGMEN , A.AM_NIK , A.AM_NAME , NVL(C.PLAN,0) WEIGHT, NVL(C.ACH,0) ACH, A.VALUE VALUE,A.STATUS STATUS, A.END_DATE, A.REASON_OF_DELAY, A.NO_QUOTE, A.ID_LOP_EPIC, TO_CHAR(A.END_DATE,'DD-MM-YYYY') END_DATE2, TO_CHAR(A.START_DATE,'DD-MM-YYYY') START_DATE2
								, CASE WHEN A.STATUS = 'DELAY' THEN (((100 - TO_NUMBER(C.ACH)) / 100) * A.VALUE) WHEN C.ACH > C.PLAN THEN ((100 - TO_NUMBER(C.ACH))/100) * A.VALUE ELSE (((TO_NUMBER(NVL(C.PLAN,0)) - TO_NUMBER(C.ACH)) /100) * A.VALUE) END POTENTIAL_WEEK, (((100 - TO_NUMBER(C.ACH)) / 100) * A.VALUE) POTENTIAL ")
							->from('PRIME_PROJECT A')
							->join("(SELECT ID_PROJECT, LISTAGG(A.PARTNER_NAME, ', ') 
									  WITHIN GROUP (ORDER BY A.ID_PROJECT) AS PARTNERS
									  FROM PRIME_PROJECT_PARTNERS A
									  GROUP BY ID_PROJECT
									  ) B",
									  "B.ID_PROJECT = A.ID_PROJECT","LEFT")
							->join("PRIME_MONITORING_PROJECT C","A.ID_PROJECT = C.ID_PROJECT","LEFT")
							->where('PM_EXIST','1')
							->where("A.EXIST","1")
							->where_in('A.STATUS',$arr);

					if(!empty($this->session->userdata("mitra_name"))){
						$query = $query->like('PARTNERS',$this->session->userdata("mitra_name"));
					}

					if($this->session->userdata('tipe_sess') == 'PROJECT_MANAGER' ){
						$nik_pm = $this->session->userdata('nik_sess');
						$query = $query->where('A.PM_NIK', $nik_pm);
					}

					$regional1 =	$this->session->userdata('regional');
					if($regional1 != '0' && !empty($regional1)){
						$query = $query->where('A.REGIONAL', $regional1);
					}

					if($status != null){
						$query = $query->where('A.STATUS',$status);
					}
					if($pm != null){
						$query = $query->where('A.PM_NIK',$pm);
					}
					if($type != null){
						$query = $query->where('A.TYPE',$type);
					}
					if($customer != null){
						$query = $query->where('A.NIP_NAS',$customer);
					}
					if($regional != null){
						$query = $query->where('A.REGIONAL',$regional);
					}
					if($segmen != null){
						$query = $query->where('A.SEGMEN',$segmen);
					}

					return $query;

		}

		private function _get_datatables_queryActive($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen){

		    $this->_get_all_queryActive($status,$pm,$customer,$partner,$type,$regional,$segmen);

		    $i = 0;

		    foreach ($this->column_searchActive as $item) // loop column
		    {
		        if ($searchValue) // if datatable send POST for search
		        {

		            if ($i === 0) // first loop
		            {
		                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
		                $this->db->like($item, $searchValue);
		            } else {
		                $this->db->or_like($item, $searchValue);
		            }

		            if (count($this->column_searchActive) - 1 == $i) //last loop
		                $this->db->group_end(); //close bracket
		        }
		        $i++;
		    }

		    if(isset($getOrder)&&$orderColumn!=null) // here order processing
		    {	
		        $this->db->order_by($this->column_orderActive[$orderColumn], $orderDir);
		    }
		    else if(isset($this->orderActive))
		    {	
		        $order = $this->orderActive;
		        $this->db->order_by($order[0], $orderDir);
		    }
		}

		function get_table_project_active($length, $start, $searchValue, $orderColumn, $orderDir, $getOrder, $status,$pm,$customer,$partner,$type,$regional,$segmen){
		    $this->_get_datatables_queryActive($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen);
		    if ($length != -1)
		        $this->db->limit($length, $start);
		    	$query = $this->db->get();
		    
		    return $query->result();
		}

		function count_filtered_table_project_active($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen){
		    $this->_get_datatables_queryActive($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen);
		    $query = $this->db->get();
		    return $query->num_rows();
		}

		public function count_all_table_project_active($status,$pm,$customer,$partner,$type,$regional,$segmen){
		    $this->_get_all_queryActive($status,$pm,$customer,$partner,$type,$regional,$segmen);
		    return $this->db->count_all_results();
		}
    ## End of Datatable Project Active



	## Datatable Project Closed
		var $column_orderClosed = array('NAME','SEGMEN','PM_NAME','TYPE','VALUE',"CLOSED_DATE",'UPDATED_DATE'); //set column field database for datatable orderable
	    var $column_searchClosed = array('A.ID_PROJECT','NAME'); //set column field database for datatable searchable
	    var $orderClosed = array('SEQ' => 'desc'); // default order
		
		public function _get_all_queryClosed($status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded){
				if($this->session->userdata('tipe_sess') == 'PROJECT_MANAGER' ){
				$nama_pm = $this->session->userdata('nama_sess');
					$query = $this->db
						->select("TO_NUMBER(SUBSTR(ID_PROJECT, 5,7)) SEQ, TO_CHAR(A.CLOSED_DATE, 'DD MONTH YYYY') CLOSED_DATE2,  A.*,
									ROW_NUMBER() OVER(ORDER BY ID_PROJECT DESC) XRNUM")
						->from("PRIME_PROJECT A")
						->where(1,1)
						->where('PM_NAME',$nama_pm)
						->where("EXIST",'1')
						->where('STATUS', 'CLOSED');

				}else if($this->session->userdata('tipe_sess')=='SUBSIDIARY'){
					$query = $this->db
						->select("TO_NUMBER(SUBSTR(A.ID_PROJECT, 5,7)) SEQ, A.*, TO_CHAR(A.CLOSED_DATE, 'DD MONTH YYYY') CLOSED_DATE2,
									ROW_NUMBER() OVER(ORDER BY A.ID_PROJECT DESC) XRNUM")
						->from("PRIME_PROJECT A")
						->join("PRIME_PROJECT_PARTNERS B","A.ID_PROJECT = B.ID_PROJECT")
						->where(1,1)
						->where("EXIST",'1')
						->where('STATUS', 'CLOSED');
				}else{
					$query = $this->db
						->select("TO_NUMBER(SUBSTR(ID_PROJECT, 5,7)) SEQ, A.*, TO_CHAR(A.CLOSED_DATE, 'DD MONTH YYYY') CLOSED_DATE2,
									ROW_NUMBER() OVER(ORDER BY ID_PROJECT DESC) XRNUM")
						->from("PRIME_PROJECT A")
						->where(1,1)
						->where("EXIST",'1')
						->where('STATUS', 'CLOSED');

				}

					$regional1 =	$this->session->userdata('regional');
					if($regional1 != '0' && !empty($regional1)){
						$query = $query->where('REGIONAL', $regional1);
					}
					
					if($status != null){
						$query = $query->where('STATUS',$status);
					}
					
					if($pm != null){
						if($pm=='x'){
							$query = $query->where("PM_NIK IS NULL");
						}else{
							$query = $query->where('PM_NIK',$pm);
						}
						
					}else{
						$query = $query->where("PM_NIK IS NOT NULL");
					}


					if($type != null){
						$query = $query->where('TYPE',$type);
					}
					if($customer != null){
						$query = $query->where('NIP_NAS',$customer);
					}
					if($regional != null){
						$query = $query->where('REGIONAL',$regional);
					}
					if($segmen != null){
						$query = $query->where('SEGMEN',$segmen);
					}

					if(!empty($escorded)&&$escorded=='1'){
						$query = $query->where("MANAGE_SERVICE",1);
					}

					if(!empty($escorded)&&$escorded=='x'){
						$query = $query->where("MANAGE_SERVICE",0);
					}	
				
				return $query;
	    }

	    private function _get_datatables_queryClosed($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded){

	        $this->_get_all_queryClosed($status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded);

	        $i = 0;

	        foreach ($this->column_searchClosed as $item) // loop column
	        {
	            if ($searchValue) // if datatable send POST for search
	            {

	                if ($i === 0) // first loop
	                {
	                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	                    $this->db->like($item, $searchValue);
	                } else {
	                    $this->db->or_like($item, $searchValue);
	                }

	                if (count($this->column_searchClosed) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }

	        if(isset($getOrder)&&$orderColumn!=null) // here order processing
	        {	
	        		
	            $this->db->order_by($this->column_orderClosed[$orderColumn], $orderDir);
	        }
	        else if(isset($this->orderClosed))
	        {
	            $order = $this->orderClosed;
	            $this->db->order_by(key($order), $orderDir);
	        }
	    }

	    function get_table_project_closed($length, $start, $searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded){
	        $this->_get_datatables_queryClosed($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded);
	        if ($length != -1)
	            $this->db->limit($length, $start);
	        	$query = $this->db->get();
	        	// echo $this->db->last_query();exit;
	        return $query->result();
	    }

	    function count_filtered_table_closed($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded){
	        $this->_get_datatables_queryClosed($searchValue, $orderColumn, $orderDir, $getOrder,$status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    public function count_all_table_project_closed($status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded){
	        $this->_get_all_queryClosed($status,$pm,$customer,$partner,$type,$regional,$segmen,$escorded);
	        return $this->db->count_all_results();
	    }
	## End of Datatable Project Closed
   

   	## Datatable BAST
	    var $table_bast = 'PRIME_BAST_HGN';
	    var $column_order_bast = array('H1.NO_SPK',"H1.NAMA_MITRA",'H1.NAMACC','H1.TYPE_BAST','H1.TGL_BAST','TO_NUMBER(H1.NILAI_RP_BAST)','H1.STATUS',null); //set column field database for datatable orderable
	    var $column_search_bast = array('UPPER(H1.PROJECT_NAME)','UPPER(H1.NO_SPK)','UPPER(H1.NAMACC)','UPPER(H1.NAMA_MITRA)','UPPER(H1.NAMA_PM)','H1.PENANDA_TANGAN','H1.NO_KL','H1.SEGMENT','H1.STATUS','H1.SEGMENT','H1.ID_BAST','H1.NO_BAST'); //set column field database for datatable searchable
	    var $order = array('DATE_CREATED' => 'desc'); // default order
	    
	    public function _get_all_query_bast($status,$mitra2,$segmen,$customer,$spk){
	          $mitra = $this->session->userdata('mitra');
	          $nik = $this->session->userdata('nik_sess');

	          if(!empty($this->session->userdata('segmen_sess'))){
	            $segmen = $this->session->userdata('segmen_sess');
	          }


	             $this->db
	            ->distinct()
	            ->select("H1.*,  to_char(TGL_BAST, 'DD MONTH YYYY') TGL_BAST2") 
	            ->from('PRIME_BAST_HGN H1','H1.ID_BAST = H2.ID_PROJECT');
	            if($status   != null){$this->db->where('H1.STATUS',$status);}
	            if($segmen   != null){$this->db->where('H1.SEGMENT',$segmen);}
	            if($spk      != null){$this->db->where('H1.NO_SPK',$spk);}
	            if($customer != null){$this->db->where('H1.NIPNAS',$customer);}

	            if($this->session->userdata('tipe_sess') == 'PROJECT_MANAGER' ){
	            $nama_pm = $this->session->userdata('nama_sess');
	            $this->db->where('NAMA_PM',$nama_pm);
	            }

	            if(!empty($mitra) && $nik != 'admin_mitra'){$query = $this->db->where('ID_MITRA',$mitra);}
	                else{$query = $this->db->where('H1.EXIST','1');}

	            return $query;
	    }

	    private function _get_datatables_query_bast($searchValue, $orderColumn, $orderDir, $getOrder,$status,$mitra,$segmen,$customer,$spk){

	        $this->_get_all_query_bast($status,$mitra,$segmen,$customer,$spk);

	        $i = 0;

	        foreach ($this->column_search_bast as $item) // loop column
	        {
	            if ($searchValue) // if datatable send POST for search
	            {

	                if ($i === 0) // first loop
	                {
	                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	                    $this->db->like($item, $searchValue);
	                } else {
	                    $this->db->or_like($item, $searchValue);
	                }

	                if (count($this->column_search_bast) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }

	        if(isset($getOrder)) // here order processing
	        {   
	                
	            $this->db->order_by($this->column_order_bast[$orderColumn], $orderDir);
	        }
	        else if(isset($this->order_bast))
	        {
	            $order = $this->order_bast;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }

	    function get_table_bast($length, $start, $searchValue, $orderColumn, $orderDir, $getOrder, $status,$mitra,$segmen,$customer,$spk){
	        $this->_get_datatables_query_bast($searchValue, $orderColumn, $orderDir, $getOrder,$status,$mitra,$segmen,$customer,$spk);
	        if ($length != -1)
	            $this->db->limit($length, $start);
	            $query = $this->db->get();
	            // echo $this->db->last_query();exit;
	        return $query->result();
	    }

	    function count_filtered_table_bast($searchValue, $orderColumn, $orderDir, $getOrder,$status,$mitra,$segmen,$customer,$spk){
	        $this->_get_datatables_query_bast($searchValue, $orderColumn, $orderDir, $getOrder,$status,$mitra,$segmen,$customer,$spk);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    public function count_all_table_bast($status,$mitra,$segmen,$customer,$spk){
	        $this->_get_all_query_bast($status,$mitra,$segmen,$customer,$spk);
	        return $this->db->count_all_results();
	    }
	## End of Project Datatable

	## Datatable User
	    var $table_user = 'PRIME_USERS';
	    var $column_order_user = array(null,null,null); //set column field database for datatable orderable
	    var $column_search_user = array('UPPER(NAMA)'); //set column field database for datatable searchable
	    var $order_user = array('NAMA' => 'asc'); // default order
	    
	    public function _get_all_query_user(){
		        $data = $this->db
		        		->select("*")
		        		->from("PRIME_USERS");
	            return $data;
	    }

	    private function _get_datatables_query_user($searchValue, $orderColumn, $orderDir, $getOrder){

	        $this->_get_all_query_user();

	        $i = 0;

	        foreach ($this->column_search_user as $item) // loop column
	        {
	            if ($searchValue) // if datatable send POST for search
	            {

	                if ($i === 0) // first loop
	                {
	                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	                    $this->db->like($item, $searchValue);
	                } else {
	                    $this->db->or_like($item, $searchValue);
	                }

	                if (count($this->column_search_user) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }

	        if(isset($getOrder)) // here order processing
	        {   
	                
	            $this->db->order_by($this->column_order_user[$orderColumn], $orderDir);
	        }
	        else if(isset($this->order_user))
	        {
	            $order = $this->order_user;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }

	    function get_table_user($length, $start, $searchValue, $orderColumn, $orderDir, $getOrder){
	        $this->_get_datatables_query_user($searchValue, $orderColumn, $orderDir, $getOrder);
	        if ($length != -1)
	            $this->db->limit($length, $start);
	            $query = $this->db->get();
	            // echo $this->db->last_query();exit;
	        return $query->result();
	    }

	    function count_filtered_table_user($searchValue, $orderColumn, $orderDir, $getOrder){
	        $this->_get_datatables_query_user($searchValue, $orderColumn, $orderDir, $getOrder);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    public function count_all_table_user(){
	        $this->_get_all_query_user();
	        return $this->db->count_all_results();
	    }
	## End of User


}

  