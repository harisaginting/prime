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

	function add($data){
		foreach($data as $key => $value){

                if($key=='TGL_SPK'){
                    $this->db->set("TGL_SPK","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if($key=='TGL_KL'){
                    $this->db->set("TGL_KL","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if($key=='TGL_BAST'){
                    $this->db->set("TGL_BAST","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if(($key=='RECC_START_DATE')&&(!empty($key=='RECC_START_DATE'))){
                    $this->db->set("RECC_START_DATE","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if(($key=='RECC_END_DATE')&&(!empty($key=='RECC_END_DATE'))){
                    $this->db->set("RECC_END_DATE","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else{
                    if(!empty($value)){
                        $this->db->set($key , trim($value));
                    }
                    
                }       
            } 
        if(empty($data['BAPP'])){
            $this->db->set('BAPP','');
        }
        $this->db->set('DATE_CREATED',"TO_DATE('".date('m/d/Y')."','MM/DD/YYYY')",FALSE);
        $this->db->set('DATE_MODIFIED',"TO_DATE('".date('m/d/Y H:i')."','MM/DD/YYYY HH24:MI')",FALSE);          
        return $this->db->insert('PRIME_BAST_HGN');
	}

	function add_history($data){
		foreach($data as $key => $value){
            $this->db->set($key , $value);        
        }
        $this->db->set('DATE_UPDATED',"TO_DATE('".date('m/d/Y H:i:s')."','MM/DD/YYYY HH24:MI:SS')",FALSE);
        $query = $this->db->insert('PRIME_BAST_HISTORY');
        return $query;
	}

	function get_bast($id){
        $q = $this->db->select("A.*,TO_CHAR(A.TGL_BAST, 'MM/DD/YYYY') TGL_BAST2, TO_CHAR(A.TGL_KL, 'MM/DD/YYYY') TGL_KL2, TO_CHAR(A.TGL_SPK, 'MM/DD/YYYY') TGL_SPK2, TO_CHAR(A.RECC_START_DATE, 'MM/DD/YYYY') RECC_START_DATE2, TO_CHAR(A.RECC_END_DATE, 'MM/DD/YYYY') RECC_END_DATE2, C.ID_PROJECT, A.ID_LOP ID_LOP")
                      ->distinct()
                      ->from('PRIME_BAST_HGN A')
                      ->join('PRIME_PROJECT_PARTNERS B','A.NO_SPK = B.NO_P8','LEFT')
                      ->join('PRIME_PROJECT C','C.ID_PROJECT = B.ID_PROJECT','LEFT')
                      ->where('A.ID_BAST',$id);

        return $q->get()->row_array();
    }

	function get_history($id){
        $q = $this->db
            ->select("ROW_NUMBER() OVER(ORDER BY DATE_UPDATED ASC) AS NO ,PRIME_BAST_HISTORY.*, TO_CHAR(DATE_UPDATED, 'DD MONTH YYYY [HH24:MI]') TIME")
            ->from('PRIME_BAST_HISTORY')
            ->where('ID_PROJECT',$id)
            ->order_by('DATE_UPDATED','DESC')
            ->get()->result_array();

        foreach ($q as $key => $value) { 
                $x = @explode('|||',$q[$key]['BY_USER']);
                $q[$key]['ID_USER']     = $x[0];
                $q[$key]['NAME_USER']   = $x[1];
                $q[$key]['PHOTO_USER']  = null;
            }    
            return $q;
    }


   function get_p8_bast($no_spk,$id){
        $q = $this->db->select("A.*,TO_CHAR(A.TGL_BAST, 'MM/DD/YYYY') TGL_BAST2, TO_CHAR(A.TGL_KL, 'MM/DD/YYYY') TGL_KL2, TO_CHAR(A.TGL_SPK, 'MM/DD/YYYY') TGL_SPK2, TO_CHAR(A.RECC_START_DATE, 'MM/DD/YYYY') RECC_START_DATE2, TO_CHAR(A.RECC_END_DATE, 'MM/DD/YYYY') RECC_END_DATE2 ")
                      ->from('PRIME_BAST_HGN A')
                      ->where('NO_SPK',$no_spk)
                      ->where('EXIST','1')
                      ->where('ID_BAST !=',$id)
                      ->order_by('TGL_BAST','DESC');

        return $q->get()->result_array();
    }

   function update_proccess($data,$id){
        foreach($data as $key => $value){
            
                if($key=='TGL_SPK'){
                    $this->db->set("TGL_SPK","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if($key=='TGL_KL'){
                    $this->db->set("TGL_KL","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if($key=='TGL_BAST'){
                    $this->db->set("TGL_BAST","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if(($key=='RECC_START_DATE')&&(!empty($key=='RECC_START_DATE'))){
                    $this->db->set("RECC_START_DATE","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else if(($key=='RECC_END_DATE')&&(!empty($key=='RECC_END_DATE'))){
                    $this->db->set("RECC_END_DATE","TO_DATE('".$value."','MM/DD/YYYY')",FALSE);
                    }
                else{
                    if(!empty($value)){
                        $this->db->set($key , trim($value));
                    }
                    
                }       
            } 

        if(empty($data['BAPP'])){
            $this->db->set('BAPP','');
        }
        $this->db->set('DATE_MODIFIED',"TO_DATE('".date('m/d/Y H:i')."','MM/DD/YYYY HH24:MI')",FALSE);    
        $this->db->where('ID_BAST',$id); 
        $q = $this->db->update('PRIME_BAST_HGN');
        //echo $this->db->last_query();die;
        return $q;
    }


    function get_squen($no_spk){
        $arr = array('APPROVED','TAKE OUT','DONE');
        $this->db->select("COUNT(1) TOTAL");
        $this->db->from("PRIME_BAST_HGN");
        $this->db->where("NO_SPK",$no_spk);
        $this->db->where_in('STATUS', $arr);
        $total = $this->db->get()->row()->TOTAL;
        $total = $total+1;
        return $total;
    }

    function add_symptoms($data) {
        foreach($data as $key => $value){
            $this->db->set($key , $value);        
        }
        $query = $this->db->insert('PRIME_BAST_REVISION_HISTORY');
        return $query;
    }

    function get_revision($id){
        $q = $this->db
            ->select("PRIME_BAST_REVISION_HISTORY.*, TO_CHAR(DATE_CREATED, 'DD MONTH YYYY [HH24:MI]') TIME")
            ->from('PRIME_BAST_REVISION_HISTORY')
            ->where('ID_BAST',$id)
            ->order_by('DATE_CREATED','DESC')
            ->get()->result_array();
        return $q;
    }

}