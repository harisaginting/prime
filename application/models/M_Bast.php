<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Bast extends CI_Model {

	function get_all_pic($q){
		$this->db
			->select("EMAIL_MITRA EMAIL, PIC_MITRA NAME")
			->from("PRIME_BAST_HGN")
			->like("EMAIL_MITRA",$q) 
			->or_like("PIC_MITRA",$q);

		return $this->db->get()->result_array(); 
	}
}