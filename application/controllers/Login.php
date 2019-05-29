<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login','main_model');  
    }

    public function index()
        {
            if($this->isLoggedIn()){
                redirect(base_url().'dashboard');
            }else{
                $this->load->view('login/index');  
            }  
            
        }

    
    function login_proccess(){
        $this->form_validation->set_rules('username', 'NIK', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username        = $this->security->xss_clean($this->input->post('username'));
            $password        = $this->security->xss_clean($this->input->post('password'));

                $check_login = $this->main_model->validate_login($username,$password); 
                if ($check_login) {
                     $this->addLog($this->session->userdata('nik_sess'),'Log In','AUTH');

                }else{
                    $this->session->set_flashdata('alError', $this->alert('alert-danger','Maaf NIK atau Password Salah'));
                }
        }else{
                $this->session->set_flashdata('alError', $this->alert('alert-danger','Mohon lengkapi inputan data'));  
        }

        //echo json_encode($this->session->userdata());die();
        redirect(base_url().'login');
    }


    function logout(){
        $this->session->sess_destroy();
        $this->auth->doLogout();
        echo json_encode($this->session->userdata());
        $this->addLog($this->session->userdata('nik_sess'),'Log Out','AUTH');
        redirect(base_url());
    }


}

?>