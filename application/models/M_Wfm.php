<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Wfm extends CI_Model {

	function get_project_so($no_p8 = null){
		$query   = $this->db->query("SELECT DISTINCT ID_LOP, NO_QUOTE, NO_SO, VALID, EXIST, ID_ROW, NO_P8 FROM PRIME_NO_QUOTE_SO WHERE NO_P8 = '".$no_p8."' AND EXIST = 1 ORDER BY NO_QUOTE ASC")->result_array();

        return $query;
	}

	function check_p8_so($no_p8,$no_so){
	
		$query = $this->db
					->select('count(1) T')
					->from('PRIME_NO_QUOTE_SO')
					->where('NO_SO',$no_so)
					->where('NO_P8', $no_p8)
					->where('EXIST',1)
					->get()->row()->T;
		
		if(empty($query)){
			return 0;
		}
		return $query;
	
	}

	function check_p8($no_p8){
		$query = $this->db
					->select('count(1) T')
					->from('PRIME_SPK_NUMERO')
					->where('NO_SPK', $no_p8)
					->get()->row()->T;
		
		if(empty($query)){
			return 0;
		}
		return $query;
	
	}


	function add_no_so($data){
		return  $this->db->insert('PRIME_NO_QUOTE_SO',$data);	
	}

	function validate_so($no_p8,$no_so,$valid){
        $this->db->where('NO_P8',$no_p8);
        $this->db->where('NO_SO',$no_so);
		$this->db->set('VALID',$valid);
		
		return $this->db->update('PRIME_NO_QUOTE_SO');
    }

    function delete_so($no_p8,$no_so){
    	$this->db->where('NO_P8',$no_p8);
    	$this->db->where('NO_SO',$no_so);
		$this->db->set('VALID',0);
		$this->db->set('EXIST',0);
		return $this->db->update('PRIME_NO_QUOTE_SO');

    }
}