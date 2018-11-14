<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_M');
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

	public function login()
	{
		// isset session id_admin
		if($this->session->userdata('id_admin') != NULL){
			// $this->header();
			redirect(base_url().'admin','location');
		}
		//
		$error_message = '';
    	
		if($this->input->post('btn_login')){
			$account = $this->input->post('username');
			$password = $this->input->post('password');
			$hash_password = md5(md5($password));
			if($this->Account_M->checkLogin_admin($account,$hash_password)==TRUE){
				$data_admin = $this->getDataAdmin($account);
				// check active_status_user
				if($data_admin["active_status_admin"]==1){
				$this->session->set_userdata($data_admin);
				redirect(base_url().'admin/user','location');
				}else{
					$error_message = 'アカウントがロックされました';
				}
        		
			}else{
				$error_message = '不正なアカウントまたはパスワード';
			}

		}

		$data['error_message'] = $error_message;
		$this->load->view('admin/login.php',$data);
	}


	private function getDataAdmin($account)
	  {
	    $admin_info = $this->Account_M->getAdmin($account)[0];
	    $data = array(
	      'lm09_admin_id'       => $admin_info['lm09_admin_id'],
	      'lm09_username'       => $admin_info['lm09_username'],
	      'id_admin'   => $admin_info['lm09_username'],
	      'email_admin'   => $admin_info['lm09_email'],
	      'fullname_admin' => $admin_info['lm09_fullname'],
	      'active_status_admin'   => $admin_info['lm09_active_status'],
	    );
	    return $data;
	  }

  	public function logout(){
		$this->session->sess_destroy();
	    redirect('admin/account/login','location');
	}

	
}

/* End of file Account.php */
/* Location: ./application/controllers/admin/Account.php */