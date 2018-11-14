<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Account_M');

	}

	public function is_logged_in()
	{
		$user = $this->session->userdata('user_id');
    if(isset($user)) {

    }
    else {
      redirect(base_url().'account/login');
    }
	}

	public function header()
	{
		$this->load->view('header.php');
	}

	public function footer()
	{
		$this->load->view('footer.php');
	}

	public function index()
	{
		$this->header();
		redirect(base_url().'account/login','location');
	}

	public function login($key='',$text='')
	{
		// isset session user_id
		if($this->session->userdata('user_id') != NULL){
			// $this->header();
			redirect(base_url().'home','location');
		}
		//

		$error_message = '';

		if($this->input->post('btn-login')){
			$account = $this->input->post('account');
			$password = $this->input->post('password');
			$redirect = $this->input->get('redirect_url');
			$new_pass = $this->input->get('t');
			$hash_password = md5(md5($password));
			$email = protect_url('encrypted',$account,'lemeshop_resend');
			$resend_url = base_url('account/resend/'.$email);
			if($this->Account_M->checkLogin($account,$hash_password)==TRUE){
				$data_user = $this->getDataUser($account);
				// check active_status_user
				if($data_user["active_status_user"]==1){
					if($data_user["verify_status_user"]==1){
						$this->session->set_userdata($data_user);
						if(isset($redirect) && !empty($redirect)){
							$redirect = protect_url('decrypted',$redirect,'lemeshop');
							$new_pass = protect_url('decrypted',$new_pass,'lemeshop_password');
							$this->session->set_flashdata('value',$new_pass);
							redirect($redirect,'location');
						} else {
							if ($key=='') {
								redirect(base_url().'home','location');
							}
							else{
								if ($text=='empty') {
									redirect(base_url('search/confirm/').$key);
								}
								else{
									redirect(base_url('page/checkPasswordEvent/').$key);
								}	
							}
						}

					}else{
						$error_message = 'このアカウントはまだ確認されていません。<br><a href="'.$resend_url.'">こちら</a>をクリックして確認メールを再送信してください。';
					}
				}else{
					$error_message = 'アカウントがロックされました';
				}
			}else{
				$error_message = '不正なアカウントまたはパスワード';
			}
		}
		$data['error_message'] = $error_message;
		$this->header();
		$this->load->view('account/login.php',$data);
		$this->footer();
	}

	private function getDataUser($account)
  {
    $user_info = $this->Account_M->getUser($account)[0];
    $data = array(
		'user_id'            => $user_info['lm01_user_id'],
		'email_user'         => $user_info['lm01_email'],
		'firstname_user'     => $user_info['lm01_firstname'],
		'lastname_user'      => $user_info['lm01_lastname'],
		'address'            => $user_info['lm01_zipcode'].' '.$user_info['lm01_street'].' '.$user_info['lm01_city'] ,
		'tel'                => $user_info['lm01_phone_number_1'].'-'.$user_info['lm01_phone_number_2'].'-'.$user_info['lm01_phone_number_3'] ,
		'sex_user'      	 => $user_info['lm01_sex'],
		'active_status_user' => $user_info['lm01_active_status'],
		'verify_status_user' => $user_info['lm01_user_activation'],
    );
    return $data;
  }

	public function entry()
	{
		// isset session user_id
		if($this->session->userdata('user_id') != NULL){
			// $this->header();
			redirect(base_url().'home','location');
		}
		$post = $this->input->post();
			if (isset($post['btnSubmit'])) {
					$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
					$this->form_validation->set_rules('phoneticName1', 'phoneticName1', 'trim|required');
					$this->form_validation->set_rules('phoneticName2', 'phoneticName2', 'trim|required');
					// $this->form_validation->set_rules('companyName', 'companyName ', 'trim|required');
					$this->form_validation->set_rules('phoneNumber1', 'phoneNumber1', 'trim|required|numeric');
					$this->form_validation->set_rules('phoneNumber2', 'phoneNumber2', 'trim|required|numeric');
					$this->form_validation->set_rules('phoneNumber3', 'phoneNumber3', 'trim|required|numeric');
					// $this->form_validation->set_rules('faxNumber1', 'faxNumber1', 'trim|required|numeric');
					// $this->form_validation->set_rules('faxNumber2', 'faxNumber2', 'trim|required|numeric');
					// $this->form_validation->set_rules('faxNumber3', 'faxNumber3', 'trim|required|numeric');
					$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
					$this->form_validation->set_rules('confirm_email', 'confirm_email ', 'trim|required|matches[email]');
					$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[8]|max_length[32]');
					$this->form_validation->set_rules('repass', 'repass', 'trim|required|matches[password]');
					$this->form_validation->set_rules('gender', 'gender', 'required');
					// $this->form_validation->set_rules('job', 'job', 'required');
					$this->form_validation->set_rules('lm01_city', 'lm01_city', 'trim|required');
					$this->form_validation->set_rules('lm01_county', 'lm01_county', 'required');
					$this->form_validation->set_rules('street', 'street', 'trim|required');
					$this->form_validation->set_rules('contact[zip][zip01]', 'contact[zip][zip01]', 'trim|required|numeric');
					$this->form_validation->set_rules('contact[zip][zip02]', 'contact[zip][zip02]', 'trim|required|numeric');

					if ($this->form_validation->run() == TRUE) {

						$firstname     = $post['firstName'];
						$lastname      = $post['lastName'];
						$company_name  = $post['companyName'];
						$phone_number_1  = $post['phoneNumber1'];
						$phone_number_2  = $post['phoneNumber2'];
						$phone_number_3  = $post['phoneNumber3'];
						$fax_number_1    = $post['faxNumber1'];
						$fax_number_2    = $post['faxNumber2'];
						$fax_number_3    = $post['faxNumber3'];
						$email         = $post['email'];
						$password      = $post['password'];
						$password      = md5(md5($password));
						$gender        = $post['gender'];
						$phonetic_1    = $post['phoneticName1'];
						$phonetic_2	   = $post['phoneticName2'];
						$job           = $post['job'];
						$street        = $post['street'];
						$county        = $post['lm01_county'];
						$city          = $post['lm01_city'];
						$zipcode       = $post['contact']['zip']['zip01'] ."-". $post['contact']['zip']['zip02'];
						$birthday      = $post['year_birthday'] ."-". $post['month_birthday'] ."-". $post['day_birthday'];
						$bday          = date('Ymd', strtotime($birthday));
						$token				 = inviteTokenGenerator();

						$data = array(
							'lm01_email '        => $email,
							'lm01_password'      => $password,
							'lm01_firstname'     => $firstname,
							'lm01_lastname'      => $lastname,
							'lm01_company_name ' => $company_name,
							'lm01_phonetic_name_1' => $phonetic_1,
							'lm01_phonetic_name_2' => $phonetic_2,
							'lm01_zipcode'       => $zipcode,
							'lm01_street'        => $street,
							'lm01_county'        => $county,
							'lm01_city'			 => $city,
							'lm01_phone_number_1' => $phone_number_1,
							'lm01_phone_number_2' => $phone_number_2,
							'lm01_phone_number_3' => $phone_number_3,
							'lm01_fax_number_1'   => $fax_number_1,
							'lm01_fax_number_2'   => $fax_number_2,
							'lm01_fax_number_3'   => $fax_number_3,
							'lm01_birthday '    => $bday,
							'lm01_sex'          => $gender,
							'lm01_job'			=> $job,
							'lm01_active_status' => 1,
							'lm01_user_activation' => 0,
							'lm01_user_activation_token' => $token,
							'lm01_created_at'   => dateInsert(),
							'lm01_updated_at'	=> dateInsert()
						);

						$url_time = time();
						$decode_url = $token.'?email='.$email;
						$encode_url = protect_url('encrypted',$decode_url,'lemeshop_activation');
						$activation_url = base_url('account/activation/'.$encode_url.'?t='.$url_time);
						$check_email = $this->Account_M->checkEmail($email);
						$this->_email['fullname'] = $firstname.' '.$lastname;
						$this->_email['url'] = $activation_url;
						$email_template = $this->load->view('email_template/activation.php', $this->_email, TRUE);
						if($check_email != ''){
							$this->session->set_flashdata('error', '<div class="error-msg"><i class="fa fa-times-circle"></i> 電子メール 「'.$email.'」が存在しました。他のメールアドレスでもう一度お試しください。</div>');
						} else {
							if($this->Account_M->user_add($data)){
								if(send_mail($email,'[Leme.Shop]会員登録のご確認',$email_template)){
									$email_encrypted = protect_url('encrypted',$email,'lemeshop_resend');
									$resend_url = base_url('account/resend/'.$email_encrypted);
									$this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> あなたのアカウントは保留中です。 メールを確認してアカウントを有効にしてください。<br>電子メールが届かない場合は、<a href="'.$resend_url.'">ここをクリック</a>して確認メールを送信してください。</div>');
									redirect(base_url().'home/message','location');
								}
							}
						}
					}

			}
			$this->header();
			$this->load->view('account/entry.php');
			$this->footer();

	}

	public function resend($key)
	{
		// isset session user_id
		if($this->session->userdata('user_id') != NULL){
			// $this->header();
			redirect(base_url().'home','location');
		}
		$decode_key = protect_url('decrypted',$key,'lemeshop_resend');
		$user_info = $this->Account_M->getUserInfoByEmail($decode_key);
		$url_time = time();
		$token = $user_info['lm01_user_activation_token'];
		$email = $user_info['lm01_email'];
		$decode_url = $token.'?email='.$email;
		$encode_url = protect_url('encrypted',$decode_url,'lemeshop_activation');
		$activation_url = base_url('account/activation/'.$encode_url.'?t='.$url_time);
		$this->_email['url'] = $activation_url;
		$this->_email['fullname'] = $user_info['lm01_firstname'].' '.$user_info['lm01_lastname'];
		if($user_info['lm01_user_activation'] == 1){
			$this->session->set_flashdata('message', '<div class="error-msg"><i class="fa fa-warning"></i> あなたのアカウントはすでに有効化されています。 この場合、再送機能は使用できません。 アカウント<a href="'.base_url('account/login').'">こちら</a>にログインしてください。</div>');
			redirect(base_url().'message','location');
		} else {
			$email_template = $this->load->view('email_template/activation.php', $this->_email, TRUE);
			if(send_mail($email,'[Leme.Shop]会員登録のご確認',$email_template)){
				$this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> 確認メールが送信されました。 メールを確認してください。</div>');
				redirect(base_url().'message','location');
			}
		}
	}

	public function activation($token)
	{
		// isset session user_id
		if($this->session->userdata('user_id') != NULL){
			// $this->header();
			redirect(base_url().'home','location');
		}
		$link_time = $this->input->get('t');
		if(!isset($link_time) && $link_time == ''){
			redirect_url(base_url(),'location');
		} else {
			echo $decode_token = protect_url('decrypted',$token,'lemeshop_activation');
			$url = explode('?email=',$decode_token);
			$get_token = $url[0];
			$get_email = $url[1];
			$user_info = $this->Account_M->getUserInfoByEmail($url[1]);
			$firstname = $user_info['lm01_firstname'];
			$lastname = $user_info['lm01_lastname'];
			$current_time = time();
			if($get_token == $user_info['lm01_user_activation_token'] && $get_email == $user_info['lm01_email']){
				if((int)$current_time - (int)$link_time < 86300){
					$token = inviteTokenGenerator();
					$data = array(
						'lm01_user_activation' => 1,
						'lm01_user_activation_token' => $token,
						'lm01_updated_at'	=> dateInsert()
					);
					$this->_email['fullname'] = $firstname.' '.$lastname;
					$email_template = $this->load->view('email_template/account_activated.php', $this->_email, TRUE);

						if($this->Account_M->activateUser($get_email,$data)){
							if(send_mail($get_email,'[Leme.Shop] 会員登録が完了しました。',$email_template)){
								// $this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> あなたのアカウントは確認済みです。 下にログインしてください。</div>');
								// redirect(base_url().'account/login','location');
								$data_user = $this->getDataUser($get_email);
								$this->session->set_userdata($data_user);
								$this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> あなたのアカウントは確認済みです。</div>');
								redirect(base_url('account/mypage'),'location');
							}
						}
					} else {
						$email_encrypted = protect_url('encrypted',$get_email,'lemeshop_resend');
						$resend_url = base_url('account/resend/'.$email_encrypted);
						$this->session->set_flashdata('message', '<div class="error-msg"><i class="fa fa-warning"></i> リンクが切れました。 <a href="'.$resend_url.'">ここをクリック</a>して新しい確認メールを受信してください。</div>');
						redirect(base_url().'message','location');
					}

			} else {
				$this->session->set_flashdata('message', '<div class="error-msg"><i class="fa fa-warning"></i> データが見つからないか、URLが間違っています。</div>');
				redirect(base_url().'message','location');
			}
		}

	}

	public function logout(){
		$this->session->sess_destroy();
	    redirect(base_url().'account/login','location');
	}

	private function createPassword($length = 8) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyz', ceil($length/strlen($x)) )),1,$length);
	}

	public function forget()
	{
		// isset session user_id
		if($this->session->userdata('user_id') != NULL){
			// $this->header();
			redirect(base_url().'home','location');
		}
		$this->header();
		$message = '';
		$post = $this->input->post();
		$this->_data['message'] = $message;
		$this->form_validation->set_rules('user_email', 'メールアドレス', 'trim|required|xss_clean');
		if(isset($post['send_new_password_btn'])){
			if($this->form_validation->run() == TRUE){
				$email = $this->input->post('user_email');
				$user_info = $this->Account_M->getUserInfoByEmail($email);
				if($this->Account_M->checkEmail($email) != ''){
					if($user_info['lm01_user_activation'] == 1){
						$new_password = $this->createPassword();
						$md5_password = md5(md5($new_password));
						$update_data = array(
							"lm01_password" => $md5_password,
							'lm01_updated_at'	=> dateInsert()
						);
						$update_password = $this->Account_M->updateUserPassword($email,$update_data);
						$this->_email['new_password'] = $new_password;
						$key = protect_url('encrypted',base_url('account/secure'),'lemeshop');
						$new_pass = protect_url('encrypted',$new_password,'lemeshop_password');
						$this->_email['login_url'] = base_url('account/login?redirect_url='.$key.'&t='.$new_pass);

						$email_template = $this->load->view('email_template/new_password.php', $this->_email, TRUE);
						if($update_password){
							if(send_mail($email,'[Leme.Shop]パスワード変更のお知らせ',$email_template)){
								$message = '<div class="success-msg" style="text-align: center"><h3>パスワード再発行メールの送信が完了しました。</h3>
														ご登録メールアドレスにパスワードを再発行するためのメールを送信いたしました。<br>
														メールの内容をご確認いただきますよう、お願いいたします。<br>
														※メールが届かない場合はメールアドレスをご確認の上、再度お試しください。<br></div>';
								$this->_data['message'] = $message;
							}
						}
					} else {
						$message = '<div class="error-msg"><i class="fa fa-times-circle"></i> '.$email.'はまだ活動化されていません。</div>';
						$this->_data['message'] = $message;
					}
				} else {
					$message = '<div class="error-msg"><i class="fa fa-times-circle"></i> '.$email.'はシステム上に存在しません。</div>';
					$this->_data['message'] = $message;
				}
			}
		}
		$this->load->view('account/forget.php',$this->_data);
		$this->footer();
	}

	public function mypage()
	{
		$this->load->model('Statistics_M');
		$this->header();
		$this->is_logged_in();
		$user_id = $this->session->userdata('user_id').' '.$this->session->userdata('firstname_user');
		$fullname = $this->Account_M->getUserDetail($user_id);
		$this->_data['order'] = $this->Statistics_M->getLatestOrder($user_id);
		$this->_data['fullname'] = $fullname['lm01_firstname'].' '.$fullname['lm01_lastname'];
		$this->load->view('mypage',$this->_data);
		$this->footer();
	}

	public function edit()
	{
		$this->header();
		$this->is_logged_in();
		$user_id = $this->session->userdata('user_id');
		$post = $this->input->post();
		if (isset($post['btnSubmit'])) {
				$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
				$this->form_validation->set_rules('phoneticName1', 'phoneticName1', 'trim|required');
				$this->form_validation->set_rules('phoneticName2', 'phoneticName2', 'trim|required');
				$this->form_validation->set_rules('phoneNumber1', 'phoneNumber1', 'trim|required|numeric');
				$this->form_validation->set_rules('phoneNumber2', 'phoneNumber2', 'trim|required|numeric');
				$this->form_validation->set_rules('phoneNumber3', 'phoneNumber3', 'trim|required|numeric');
				$this->form_validation->set_rules('gender', 'gender', 'required');
				$this->form_validation->set_rules('lm01_city', 'lm01_city', 'trim|required');
				$this->form_validation->set_rules('lm01_county', 'lm01_county', 'required');
				$this->form_validation->set_rules('street', 'street', 'trim|required');
				$this->form_validation->set_rules('contact[zip][zip01]', 'contact[zip][zip01]', 'trim|required|numeric');
				$this->form_validation->set_rules('contact[zip][zip02]', 'contact[zip][zip02]', 'trim|required|numeric');

				if ($this->form_validation->run() == TRUE) {
					$firstname     = $post['firstName'];
					$lastname      = $post['lastName'];
					$company_name  = $post['companyName'];
					$phone_number_1  = $post['phoneNumber1'];
					$phone_number_2  = $post['phoneNumber2'];
					$phone_number_3  = $post['phoneNumber3'];
					$fax_number_1    = $post['faxNumber1'];
					$fax_number_2    = $post['faxNumber2'];
					$fax_number_3    = $post['faxNumber3'];
					$gender        = $post['gender'];
					$phonetic_1    = $post['phoneticName1'];
					$phonetic_2	   = $post['phoneticName2'];
					$job           = $post['job'];
					$street        = $post['street'];
					$county        = $post['lm01_county'];
					$city          = $post['lm01_city'];
					$zipcode       = $post['contact']['zip']['zip01'] ."-". $post['contact']['zip']['zip02'];
					$birthday      = $post['year_birthday'] ."-". $post['month_birthday'] ."-". $post['day_birthday'];
					$bday          = date('Ymd', strtotime($birthday));

					$data = array(
						'lm01_firstname'     => $firstname,
						'lm01_lastname'      => $lastname,
						'lm01_company_name ' => $company_name,
						'lm01_phonetic_name_1' => $phonetic_1,
						'lm01_phonetic_name_2' => $phonetic_2,
						'lm01_zipcode'       => $zipcode,
						'lm01_street'        => $street,
						'lm01_county'        => $county,
						'lm01_city'			 => $city,
						'lm01_phone_number_1' => $phone_number_1,
						'lm01_phone_number_2' => $phone_number_2,
						'lm01_phone_number_3' => $phone_number_3,
						'lm01_fax_number_1'   => $fax_number_1,
						'lm01_fax_number_2'   => $fax_number_2,
						'lm01_fax_number_3'   => $fax_number_3,
						'lm01_birthday '    => $bday,
						'lm01_sex'          => $gender,
						'lm01_job'			=> $job,
						'lm01_active_status' => 1,
						'lm01_updated_at'	=> dateInsert()
					);

					$update = $this->Account_M->updateUser($user_id,$data);
					if($update){
						$this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> あなたはあなたの情報を正常に更新しました。</div>');
						redirect(base_url().'account/mypage','location');
					}
				}

		}
		$this->_data['user'] = $this->Account_M->getUserDetail($user_id);
		$this->load->view('account/edit',$this->_data);
		$this->footer();
	}
	public function secure(){
		$this->header();
		$this->is_logged_in();
		$user_id = $this->session->userdata('user_id');
		$post = $this->input->post();
		$this->_data['error_message'] = '';
		if (isset($post['btnSubmit'])) {
			$current_password_input = md5(md5($post['current_password']));
			$password = md5(md5($post['password']));
			if($this->Account_M->checkCurrentPassword($user_id,$current_password_input) == TRUE){
				$data = array(
					'lm01_password' => $password,
				);
				$update = $this->Account_M->updateUser($user_id,$data);
				if($update){
					$this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> あなたはあなたの情報を正常に更新しました。</div>');
					redirect(base_url().'account/mypage','location');
				}
			} else {
				$this->_data['error_message'] = '<div class="error-msg"><i class="fa fa-warning"></i> 現在のパスワードが間違っています。</div>';
			}
		}
		$this->load->view('account/secure.php',$this->_data);
		$this->footer();
	}

	public function email()
	{
		$this->header();
		$this->is_logged_in();
		$user_id = $this->session->userdata('user_id');
		$post = $this->input->post();
		if (isset($post['btnSubmit'])) {
			$current_password_input = md5(md5($post['current_password']));
			$email = $post['email'];
			if($this->Account_M->checkCurrentPassword($user_id,$current_password_input) == TRUE){
				if($this->Account_M->checkEmail($email) == ''){
					$data = array(
						'lm01_email' => $email,
					);
					$update = $this->Account_M->updateUser($user_id,$data);
					if($update){
						$this->session->set_flashdata('message', '<div class="success-msg"><i class="fa fa-check"></i> あなたはあなたの情報を正常に更新しました。</div>');
						redirect(base_url().'account/mypage','location');
					}
				} else {
					$this->_data['error_message'] = '<div class="error-msg"><i class="fa fa-times-circle"></i> '.$email.'はシステム上に存在します。</div>';
				}

			} else {
				$this->_data['error_message'] = '<div class="error-msg"><i class="fa fa-warning"></i> 現在のパスワードが間違っています。</div>';
			}
		}
		$this->_data['user'] = $this->Account_M->getUserDetail($user_id);
		$this->load->view('account/email.php',$this->_data);
		$this->footer();
	}
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */
