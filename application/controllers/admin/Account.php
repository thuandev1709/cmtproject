<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_M');
	}

	public function signin()
	{
		if($this->session->userdata('id_admin') != NULL){
			redirect(base_url().'admin','location');
		}
		
		$error_message = '';
		if($this->input->post('btn_login')){
			$account = $this->input->post('username');
			$password = $this->input->post('password');
			$hash_password = md5(md5($password));

			if($this->Account_M->checkLogin_admin($account, $hash_password) == TRUE){

				$data_admin = $this->getDataAdmin($account);

				// Check active_status_user
				if($data_admin["cmt01_active"] == 1) {
					$this->session->set_userdata($data_admin);
					redirect(base_url().'admin');
				}else{
					$error_message = 'Tài khoản chưa kích hoạt!';
				}
			}else{
				$error_message = 'Tài khoản hoặc mật khẩu không hợp lệ!';
			}
		}

		$this->_data['error_message'] = $error_message;
		$this->load->view('admin/sign_in', $this->_data);
	}


	private function getDataAdmin($account)
	  {
	    $admin_info = $this->Account_M->getAdmin($account)[0];
	    $data = array(
	      'cmt01_id_admin'  => $admin_info['cmt01_id_admin'],
	      'cmt01_firstname' => $admin_info['cmt01_firstname'],
	      'cmt01_lastname'  => $admin_info['cmt01_lastname'],
	      'cmt01_username'  => $admin_info['cmt01_username'],
	      'cmt01_email'     => $admin_info['cmt01_email'],
	      'cmt01_image'     => $admin_info['cmt01_image'],
	      'cmt01_active'    => $admin_info['cmt01_active'],
	    );
	    return $data;
	  }

  	public function signout(){
		$this->session->sess_destroy();
	    redirect('admin/signin','location');
	}	
}

/* End of file Account.php */
/* Location: ./application/controllers/admin/Account.php */