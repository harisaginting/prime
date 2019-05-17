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

}