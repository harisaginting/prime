<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class MY_Controller extends CI_Controller {

	// Menampilkan Tema 
    function adminView($viewName = "", $data = null,$title = null){

    	$header['title'] 			  = !empty($title) ? $title : 'SDV'; 
		$CI =& get_instance();
		$sidebar = array();

        $this->load->view('template/header',$header);
        $this->load->view('template/sidebar',$sidebar);
        $this->load->view($viewName, $data);
        $this->load->view('template/footer');
    }

   
    //  MITRA
	function get_partner(){
		$q = $this->db->query("SELECT KODE_PARTNER, NAMA_PARTNER FROM PRIME_PARTNER_TATA")->result_array(); 	
    	return $q;
	}


	//  get project manager
	function get_pm(){
		$q = $this->db->query("SELECT NAMA, NIK FROM PRIME_USERS WHERE TIPE = 'PROJECT_MANAGER' OR TIPE = 'ADMIN_WEB' OR TIPE = 'PROJECT_MANAGER_OFFICER' ")->result_array(); 	
    	return $q;
	}

	//  get customers
	function get_customer($segmen=null)
	{
		if (!empty($segmen)) {
			$segmen = "AND SEGMEN='$segmen'";
		}
			$data = $this->db->query("	SELECT NIP_NAS, STANDARD_NAME
								  			FROM CBASE_DIVES
								  			WHERE 1=1
								  			$segmen
								  			ORDER BY STANDARD_NAME ASC");
		return $data->result_array();
	}

	// get Segmen
	public function get_segmen()
	{
		$data = $this->db->query("	SELECT DISTINCT SEGMEN, SEGMENT_6_LNAME
							  			FROM CBASE_DIVES
							  			ORDER BY SEGMENT_6_LNAME ASC");
		return $data->result_array();
	}

	// get project Type
	public function get_project_type(){
		$data = $this->db->query("	SELECT DISTINCT VALUE
							  			FROM PRIME_CONFIG
							  			WHERE TYPE = 'PROJECT'
							  			AND NAME = 'TYPE' 
							  			ORDER BY VALUE ASC");
		return $data->result_array();
	}
	
	// Check if login?
	public function isLoggedIn(){
		$userid = $this->session->userdata("nik_sess");
		if(!empty($userid)){
			return true;			
		}else{
			return redirect(base_url().'login');;
		}
	}



	// alert
	function alert($alert_tipe,$alert_text)
	{
		$alert = 	'<div class="alert '.$alert_tipe.'">
						'.$alert_text.'
					</div>';
		return $alert;
	}

	// generate GUID
	public function getGUID()
    {
        if (function_exists('getGUID')){
            return getGUID();
        }
        else {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = //chr(123)// "{"
                substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
                //.chr(125);// "}"
            return $uuid;
        }
    } 

	// Curl EPIC
	function getCurlEpic($url) {
		$username = 'prime_user';
    	$password = 'T3lk0mDes2017';

    	$curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, $url);
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
     
	    $result = curl_exec($curl_handle);
	    curl_close($curl_handle);
	   	
	   	return $result;  
	  
	}


	// ROMANIZE
	function getMonthRomawi($bln){
                switch ($bln){
                    case '01': 
                        return "I";
                        break;
                    case '02':
                        return "II";
                        break;
                    case '03':
                        return "III";
                        break;
                    case '04':
                        return "IV";
                        break;
                    case '05':
                        return "V";
                        break;
                    case '06':
                        return "VI";
                        break;
                    case '07':
                        return "VII";
                        break;
                    case '08':
                        return "VIII";
                        break;
                    case '09':
                        return "IX";
                        break;
                    case '10':
                        return "X";
                        break;
                    case '11':
                        return "XI";
                        break;
                    case '12':
                        return "XII";
                        break;
                }
    }

 	// ENCODE URL
    function ecapeChar($url) {
		   $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
		   $url = trim($url, "-");
		   $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
		   $url = strtolower($url);
		   $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
		   return $url;
		}

	function makeurl2($url) {
		   $new = str_replace(' ', '%20', $url);
		   return $new;
		}	


 ##UPLOAD FILE
	function upload_file($filename,$upload_path,$newName){
		$this->load->library('upload');
		$config['upload_path'] 	 = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size']      = 1000000;
		$config['file_name'] 	 = $newName;
		$config['remove_spaces'] = FALSE;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($filename))
		{
		    // case - failure
		    echo $upload_path;
		    $upload_error = array('error' => $this->upload->display_errors());
		    echo json_encode($upload_error);die();
		}
		else
		{
		    // case - success
		    $upload_data = $this->upload->data();
		    //echo json_encode(value);die;
		    return $upload_data;
		}
    }

  ##CHECK ACCESS
    public function getUserTipe(){
		return $this->session->userdata('tipe_sess');		
	}

    public function get_access_value($configName)
	{
	    $CI =& get_instance();
	    $role = $this->getUserTipe();
	    //$CI->load->model('User_model');
	    // $accessArray = $CI->User_model->getAccess(array('ROLE_NAME' => $role));
	    // return $accessArray[$configName];
		return 1;
	}

  ##LOG
	public function addLog($id,$status,$type,$meta_data=null){
		$CI =& get_instance();
	    $CI->load->model('Master_model');
	    $ip = $this->input->ip_address();
	    $data = array(
            'ID_HISTORY'    => $this->getGUID(),
            'ID'            => $id,
            'STATUS'        => $status,
            'META'          => $meta_data,
            'ID_USER'       => $this->session->userdata('nik_sess'),
            'NAME_USER'     => $this->session->userdata('nama_sess'),
            'PHOTO_USER'    => !empty($this->session->userdata('photo')) ? $this->session->userdata('photo') : '',
            'TYPE'          => $type,
            'IP'			=> $ip
        ); 
	    $CI->Master_model->updateProjectHistory($data);
	    return $CI->Master_model->addLog($data);
	}

	public function add_credit_point($category,$title,$content,$point,$meta = null){
		$CI =& get_instance();
	    $CI->load->model('Master_model');


	    $data_insert['ID']			= $this->getGUID();
        $data_insert['TITLE']       = $title;
        $data_insert['PIC']         = $this->session->userdata('nik_sess');
        $data_insert['CONTENT']     = $content;;
        $data_insert['POINT']       = $point;
        $data_insert['CATEGORY']    = $category;
        $data_insert['CREATED_BY']  = $this->session->userdata('nik_sess');
        $data_insert['META_DATA']   = $meta;

        if(!empty($meta)){
        	$check = $CI->Master_model->checkCreditPoint($title,$content,$meta);
        	if($check < 1){
        		return $CI->Master_model->addCreditPoint($data_insert);
        	}else{
        		return true;
        	}
        }
	    return $CI->Master_model->addCreditPoint($data_insert);
	}

	function getNotification(){
		$CI =& get_instance();
	    $role = $this->getUserTipe();
	    $CI->load->model('User_model');
	    $accessArray = $CI->User_model->getNotification($this->session->userdata('nik_sess'));
	    return $accessArray[$configName];
	}

	function hari($day){
		switch ($day) {
			case 'Monday':
				return 'Senin';
				break;
			case 'Tuesday':
				return 'Selasa';
				break;
			case 'Wednesday':
				return 'Rabu';
				break;
			case 'Thursday':
				return 'Kamis';
				break;
			case 'Friday':
				return "Jum'at";
				break;
			case 'Saturday':
				return 'Sabtu';
				break;
			case 'Sunday':
				return 'Minggu';
				break;	
			default:
				return '';
				break;
		}

	}

	function ejaHari($day){
		switch ($day) {
			case '01':
				return "Satu";
				break;
			case '02':
				return "Dua";
				break;
			case '03':
				return "Tiga";
				break;
			case '04':
				return "Empat";
				break;
			case '05':
				return "Lima";
				break;
			case '06':
				return "Enam";
				break;
			case '07':
				return "Tujuh";
				break;
			case '08':
				return "Delapan";
				break;
			case '09':
				return "Sembilan";
				break;
			case '10':
				return "Sepuluh";
				break;
			case '11':
				return "Sebelas";
				break;
			case '12':
				return "Dua Belas";
				break;
			case '13':
				return "Tiga Belas";
				break;
			case '14':
				return "Empat Belas";
				break;
			case '15':
				return "Lima Belas";
				break;
			case '16':
				return "Enam Belas";
				break;
			case '17':
				return "Tujuh Belas";
			case '18':
				return "Delapan Belas";
				break;
			case '19':
				return "Sembilan Belas";
				break;
			case '20':
				return "Dua Puluh ";
				break;
			case '21':
				return "Dua Puluh Satu";
				break;
			case '22':
				return "Dua Puluh Dua";
				break;
			case '23':
				return "Dua Puluh Tiga";
				break;
			case '24':
				return "Dua Puluh Empat";
				break;
			case '25':
				return "Dua Puluh Lima";
				break;
			case '26':
				return "Dua Puluh Enam";
				break;
			case '27':
				return "Dua Puluh Tujuh";
				break;
			case '28':
				return "Dua Puluh Delapan";
				break;
			case '29':
				return "Dua Puluh Sembilan";
				break;
			case '30':
				return "Tiga Puluh";
				break;
			case '31':
				return "Tiga Puluh Satu";
				break;
			
			default:
				return "";
				break;
		}
	}

	function bulan($month){
		switch ($month) {
			case '01':
				return 'Januari';
				break;
			case '02':
				return 'Februari';
				break;
			case '03':
				return 'Maret';
				break;
			case '04':
				return 'April';
				break;
			case '05':
				return 'Mei';
				break;
			case '06':
				return 'Juni';
				break;
			case '07':
				return 'Juli';
				break;
			case '08':
				return 'Agustus';
				break;
			case '09':
				return 'September';
				break;
			case '10':
				return 'Oktober';
				break;
			case '11':
				'return November';
				break;
			case '12':
				return 'Desember';
				break;
			default:
				return '';
				break;
		}
	}

	function tahun($year){
		switch ($year) {
			case '2018':
				return "Dua Ribu Delapan Belas";
				break;
			case '2019':
				return "Dua Ribu Sembilan Belas";
				break;
			case '2020':
				return "Dua Ribu Dua Puluh";
				break;
			case '2021':
				return "Dua Ribu Dua Puluh Satu";
				break;
			case '2022':
				return "Dua Ribu Dua Puluh Dua";
				break;
			
			default:
				# code...
				break;
		}
	}

}