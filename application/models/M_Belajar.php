<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Belajar extends CI_Model {


	function get_all_user(){
		//$this->load->library('database');
		//$result = $this->db->query("SELECT * FROM PRIME_USERS")->result_array();

		// QUERY BUILDER / ACTIVE RECORD BAWAAN CODEIGNITER
		$result = $this->db
					->select("*")
					->where("TIPE","PROJECT_MANAGER")
					->get('PRIME_USERS')
					->result_array();

		return $result;
	}

    
}