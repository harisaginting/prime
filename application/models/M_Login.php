<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_Login extends CI_Model
{
    
    function validate_login($nik,$pass)
    {   
        $this->db->where('NIK', $nik);
        // $this->db->where('PASSWORD', $pass);
        $check = $this->db->get('PRIME_USERS');
        if ($check->num_rows() == 1) {
            // buat array select data
            $data = $check->row_array();
            if ($data['PASSWORD'] === $pass) {

                $dataSession = array(
                    'nik_sess'      => $data['NIK'],
                    'nama_sess'     => $data['NAMA'],
                    'tipe_sess'     => $data['TIPE'],
                    'segmen_sess'   => $data['SEGMEN'],
                    'divisi_sess'   => $data['DIVISI'],
                    'kategori_sess' => $data['KATEGORI'],
                    'email_sess'    => $data['EMAIL'],
                    'mitra'         => $data['MITRA'],
                    'validated'     => true,
                    'regional'      => $data['REGIONAL'], 
                    'photo'         => $data['PHOTO_URL']
                );
                
                $this->session->set_userdata($dataSession); 
                return true;
            }else{
                if ($this->ldap->auth($nik,$pass)){
                    $dataSession = array(
                    'nik_sess'      => $data['NIK'],
                    'nama_sess'     => $data['NAMA'],
                    'tipe_sess'     => $data['TIPE'],
                    'segmen_sess'   => $data['SEGMEN'],
                    'divisi_sess'   => $data['DIVISI'],
                    'kategori_sess' => $data['KATEGORI'],
                    'email_sess'    => $data['EMAIL'],
                    'mitra'         => $data['MITRA'],
                    'validated'     => true,
                    'regional'      => $data['REGIONAL'],
                    'photo'         => $data['PHOTO_URL']
                    );
                    $this->session->set_userdata($dataSession);
                return true;    
                }
            }
        }else{
            $checkLdap = $this->ldap->auth($nik,$pass);
            if ($checkLdap){
                $q = $this->db->select('*')->from('PRIME_USERS_MITRA')
                ->where('ID',$nik)
                ->where('PASSWORD',$pass)
                ->get()->row_array();

                if(count($q) > 0){
                    $dataSession = array(
                                'nik_sess'      => $q['ID'],
                                'nama_sess'     => $q['NAMA'],
                                'tipe_sess'     => 'MITRA',
                                'segmen_sess'   => null,
                                'divisi_sess'   => $q['KODE_MITRA'],
                                'kategori_sess' => 'MITRA',
                                'email_sess'    => $q['EMAIL'],
                                'validated'     => true,
                                'photo'         => null 
                    ); 

                    
                    if($q['VALID']=='0'){
                            $dataSession['validated'] = false;
                            return true;
                            //echo 'Your account not authorized, please contact PJM section;';exit;
                        }
                    else{
                            $dataSession['validated'] = true;
                        }   

                    $this->session->set_userdata($dataSession);
                    return true;
                }
                else{

                    $dataSession = array(
                    'nik_sess'      => $nik,
                    'nama_sess'     => $nik.' (GUEST)',
                    'tipe_sess'     => "GUEST",
                    'validated'     => true
                    );
                    // bentuk session
                    $this->session->set_userdata($dataSession);
                    return true;

                }
            }
        }

        return false;
    }


    function registration_mitra($model){
        $this->db->insert('PRIME_USERS_MITRA',$model);
    }

    function get_ex_ucs_am($nik)
    {
        $q = $this->db->query("SELECT DISTINCT EX_UCS
                               FROM ACCOUNT_TEAM_DES
                               WHERE NIK_AM='$nik'")->row_array();
        echo $q['EX_UCS'];
    }

    function checkId($value){
        $q = $this->db
                ->select('*')
                ->from('PRIME_USERS_MITRA')
                ->where('ID',$value)
                ->get()->result_array();
        return count($q);
    }

    function set_session_mitra($id){
        $query = $this->db
                ->select("NAMA_PARTNER")
                ->from("PRIME_PARTNER_TATA")
                ->where("KODE_PARTNER",$id)
                ->get()
                ->row();

        if(!empty($query->NAMA_PARTNER)){
            $this->session->set_userdata(
                array('mitra_name' => $query->NAMA_PARTNER)
            );
        }
        return true;
    }

}

?>