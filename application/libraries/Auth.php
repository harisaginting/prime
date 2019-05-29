<?php

if(!defined('BASEPATH')) exit('No direct access is allowed');

class Auth {

	protected $ci; 

  	protected $parent;

  	protected $SESS_USERID 		= "nik_sess";
  	protected $SESS_USERNAME	= "nama_sess";
  	protected $SESS_USERROLE 	= "tipe_sess";  	
  	protected $SESS_SEGMEN 		= "segmen_sess";
  	protected $SESS_DIVISION	= "divisi_sess";
  	protected $SESS_CATEGORY	= "kategori_sess";
  	protected $SESS_EMAIL 		= "email_sess";

  	protected $USER_MODEL 		= 'User_model';

	public function __construct(){
        $this->ci = & get_instance();
        // @todo list todo di auth
        // - double check jika session telah dipasangi kunci sebagai warning pas dev
        // - jadikan ini sebagai fungsi utama yang bisa di inherit oleh berbagai cara login
	}

	public function isLogin($id=""){

		$userid = $this->ci->session->userdata($this->SESS_USERID);
		if(!empty($userid)){
			return TRUE;			
		}else{
			return FALSE;
		}
	}

	/**
	 * Mengembalikan semua data dari session
	 * @return array Semua data session
	 */
	public function getLoginData(){

		if(!$this->isLogin()){
			return false;
		}
		$data = array();
		$data['user'] = array(
					'nik'   	=> $this->getSession($this->SESS_USERID),
					'name'		=> $this->getSession($this->SESS_USERNAME),
					'type'	 	=> $this->getSession($this->SESS_USERROLE),
					'segmen' 	=> $this->getSession($this->SESS_SEGMEN),
					'division' 	=> $this->getSession($this->SESS_DIVISION),
					'category' 	=> $this->getSession($this->SESS_CATEGORY),
					'email' 	=> $this->getSession($this->SESS_EMAIL)
			);
		//$data['info'] = $this->getSession($this->SESS_INFO, true);

		return $data;
	}


	/**
	 * Ambil nilai session
	 * @param  string  $sess_name nama session
	 * @param  boolean $isJson    apakah ini json
	 * @return array/string       kalau json, kembalikan array. selain itu, string.
	 */
	protected function getSession($sess_name, $isJson=false){
		if(empty($sess_name)) return "";

		$data = $this->ci->session->userdata($sess_name);
		if(!empty($data)){
			if($isJson)
				return json_decode($data, true);
			else
				return $data;
		}else{
			if($isJson)
				return array();
			else
				return "";
		}
	}

	public function getUserNik(){
		
		return $this->ci->session->userdata($this->SESS_USERID);		
	}
	

	public function getUserName(){

		return $this->ci->session->userdata($this->SESS_USERNAME);		
	}

	public function getUserTipe(){

		return $this->ci->session->userdata($this->SESS_USERROLE);		
	}


	public function doLogout(){
		// logout		
		$this->ci->session->unset_userdata($this->SESS_USERID);
		$this->ci->session->unset_userdata($this->SESS_USERNAME);		
		$this->ci->session->unset_userdata($this->SESS_USERROLE);
		$this->ci->session->unset_userdata($this->SESS_SEGMEN);
		$this->ci->session->unset_userdata($this->SESS_DIVISION);
		$this->ci->session->unset_userdata($this->SESS_CATEGORY);
		$this->ci->session->unset_userdata($this->SESS_EMAIL);
		$this->ci->session->set_userdata(array('validated' => false));
		//session_destroy();
		return true;
	}	

	public function get_access_value($configName)
	{
	    $CI =& get_instance();
	    $role = $this->getUserTipe();
	    $CI->load->model($this->USER_MODEL);

	    $accessArray = $CI->User_model->get_by_field(array('ROLE_NAME' => $role));
	    //echo json_encode($accessArray);
	    return $accessArray[$configName];
	}


	public function checkUserName($username=""){

		/*if(empty($username)){
			return false;
		}

		$this->ci->load->model($this->MODEL_NAME,'UserModel');
		$result = $this->ci->UserModel->data(array('username' => $username));		

		if(!empty($result)){
			return true;
		}else{
			return false;
		}*/
	}

	public function doLogin($username, $password){

		/*
		$this->ci->load->model($this->MODEL_NAME, 'UserModel');

		$userLogin = $this->ci->UserModel->doLogin($username, $password);
		if(!empty($userLogin)){
			$userData = $this->ci->UserModel->get($userLogin['id']);

			// login
			$this->ci->session->set_userdata($this->SESS_USERNAME, $userData['username']);
			$this->ci->session->set_userdata($this->SESS_USERID, $userData['id']);
			$this->ci->session->set_userdata($this->SESS_USERROLE, $userData['role']);

			return true;
		}else{
			return false;
		}*/
	}
	

}