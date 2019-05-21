<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {


    function get_user($id){
        return $this->db
                    ->select("*")
                    ->from("PRIME_USERS")
                    ->where("NIK",$id)
                    ->get()
                    ->row_array();
    }

	function addCreditPoint($data){
        $this->db->set('DATE_CREATED',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
        $this->db->set('DATE_EVENT',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
        $this->db->set('DATE_MODIFIED',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
        return $this->db->insert('PRIME_POST',$data);
    }

    function checkCreditPoint($title,$content,$meta){
        $q = $this->db->select("COUNT(1) TOTAL")
                ->from("PRIME_POST")
                ->where("TITLE",$title)
                ->where("CONTENT",$content)
                ->where("META_DATA",$meta)
                ->get()
                ->row();
        $result = $q->TOTAL;
        return $result;
    }


}