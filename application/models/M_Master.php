<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Master extends CI_Model {

	 function addLog($data){
        $this->db->set('DATE_CREATED',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
        $this->db->insert('PRIME_HISTORY',$data); 
       return true;
    }


    function get_all_pic($q) 
    {
        if (!empty($q)) {
            $q = "AND UPPER(NAMA) LIKE UPPER('%$q%') OR UPPER(EMAIL) LIKE UPPER('%$q%')";
        }

        $query = $this->db->query(" SELECT *
                                    FROM
                                    (
                                        SELECT NAMA, EMAIL
                                        FROM PRIME_USERS
                                        UNION
                                        SELECT NAME NAMA, EMAIL
                                        FROM PRIME_MASTER_PIC
                                    )
                                    WHERE 1=1
                                    $q")->result_array();
        return $query;
    }

    function get_all_pic_email($q)
    {
        if (!empty($q)) {
            $q = "AND UPPER(NAMA) = UPPER('$q')";
        }

        $query = $this->db->query(" SELECT *
                                    FROM
                                    (
                                        SELECT NAMA, EMAIL
                                        FROM PRIME_USERS
                                        UNION
                                        SELECT NAME NAMA, EMAIL
                                        FROM PRIME_MASTER_PIC
                                    )
                                    WHERE 1=1
                                    $q")->row_array();
        return $query;
    }

    function get_project_wfm($q = null){

        if(empty($q)){
             $query = $this->db
                        ->select("M.NO_SPK NO_P8,  '['||M.NO_SPK||']'||' - '||M.PROJECT_NAME PROJECT_NAME")
                        ->distinct()
                        ->from('PRIME_SPK_NUMERO M')
                        ->order_by("DATE_CREATED","DESC")
                        ->limit(50)
                        ->get()->result();  
            return $query;  
        }else{
             $query = $this->db
                        ->select("M.NO_SPK NO_P8,  '['||M.NO_SPK||']'||' - '||M.PROJECT_NAME PROJECT_NAME")
                        ->distinct()
                        ->from('PRIME_SPK_NUMERO M')
                        ->like('UPPER(M.PROJECT_NAME)',strtoupper($q))
                        ->or_like('UPPER(M.NO_SPK)',strtoupper($q))
                        ->get()->result();  
            return $query;  
        }


       
    }


    function get_p8($p8){
        $query = $this->db
                 ->select("A.*,  TO_CHAR(TANGGAL_BAST,'MM/DD/YYYY')  DATE_P8")
                 ->from("PRIME_SPK_NUMERO A")
                 ->where("NO_SPK",$p8)
                 ->get()
                 ->row_array();

        return $query;
    }

    function get_all_p8($id_partner){
        $query = $this->db
                 ->select('*')
                 ->from("PRIME_SPK_NUMERO")
                 ->where("ID_MITRA",$id_partner)
                 ->get()
                 ->result_array();

        return $query;
    }

    

}