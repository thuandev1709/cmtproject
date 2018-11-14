<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_M');
		// $this->header();
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

	public function index($offset = 1) {
		$config['base_url']    = base_url().'admin/user';
        $config['uri_segment'] = 3;
        $config['per_page']    = 10;

        $aData = [
            'start'            => $config['per_page'],
            'limit'            => ($offset-1)*$config['per_page'],
        ];
        $list_users = $this->Account_M->getAllListUser($aData);
        $total_user  = $this->Account_M->getAllListUser('');

		//pagination
        $config['total_rows']       = $total_user;
        $total_rows                 = CEIL($config['total_rows']/$config['per_page']);
        $config['use_page_numbers'] = TRUE;
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '>';
        $config['prev_link']        = '<';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['last_link']        = 'Last';
        $config['first_link']       = 'First';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $this->_data['pagination'] = $pagination;
        $this->_data['total_rows'] = $total_rows;
        $this->_data['offset'] = $offset;
        //list all users
		$this->_data['list_users'] = $list_users;
		$this->_data["count"]    = $total_user;
		$this->header();
		$this->load->view('admin/user/index.php',$this->_data);
		// redirect(base_url().'account/login','location');
	}

	public function add()
	{
		$message = '';
		$this->_data['message'] = $message;
		$post = $this->input->post();
		if (isset($post['btnSubmit'])) {
			$this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
			$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
			$this->form_validation->set_rules('phoneticName1', 'phoneticName1', 'trim|required');
			$this->form_validation->set_rules('phoneticName2', 'phoneticName2', 'trim|required');
			// $this->form_validation->set_rules('companyName', 'companyName ', 'trim|required');
			$this->form_validation->set_rules('contact[zip][zip01]', 'contact[zip][zip01]', 'trim|required|numeric');
			$this->form_validation->set_rules('contact[zip][zip02]', 'contact[zip][zip02]', 'trim|required|numeric');
			$this->form_validation->set_rules('lm01_city', 'lm01_city', 'trim|required');
			$this->form_validation->set_rules('lm01_county', 'lm01_county', 'required');
			// $this->form_validation->set_rules('street', 'street', 'trim|required');
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
			// $this->form_validation->set_rules('gender', 'gender', 'required');
			// $this->form_validation->set_rules('job', 'job', 'required');
			// $this->form_validation->set_rules('level', 'level', 'required');



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
				$status        = $post['status'];
				$token				 = inviteTokenGenerator();

				$data = array(
					'lm01_email'        => $email,
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
					'lm01_active_status ' => $status,
					'lm01_user_activation' => 1,
					'lm01_user_activation_token' => $token,
					'lm01_created_at'   => dateInsert(),
					'lm01_updated_at'	=> dateInsert()
				);

				if ($this->Account_M->checkEmail($email) == '' ) {
					if ($this->Account_M->user_add($data)) {
						$this->session->set_flashdata('message', '<div id="message"><div class="w3-panel w3-green"><i class="fa fa-check"></i> アカウントが正常に登録されています。 </div></div>');
						redirect('admin/user','location');
					}
				}else {
					$message = '<div class="error-msg"><i class="fa fa-times-circle"></i> '.$email.'はシステム上に存在しません。</div>';
					$this->_data['message'] = $message;
				}

			}
		}

		$this->header();
		$this->load->view('admin/user/add.php',$this->_data);
		// redirect(base_url().'account/login','location');
	}

	public function edit($key)
	{
		$this->header();

		$check_id = $this->Account_M->checkUserID($key);
		if($check_id != TRUE){
			redirect('admin/user','location');
		}
		$message = '';
		$this->_data['message'] = $message;
		$post = $this->input->post();
		if (isset($post['btnSubmit'])) {
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
			$status        = $post['status'];

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
				'lm01_active_status ' => $status,
				'lm01_created_at'   => dateInsert(),
				'lm01_updated_at'	=> dateInsert()
			);
			if ($this->Account_M->updateUser($key,$data)) {
				$this->session->set_flashdata('message', '<div id="message"><div class="w3-panel w3-green"><i class="fa fa-check"></i> アカウントが正常に登録されています。 </div></div>');
				redirect(base_url().'admin/user','location');
			}

		}


		$this->_data['user'] = $this->Account_M->getUserDetail($key);

		$this->load->view('admin/user/edit.php', $this->_data);
	}

	public function fetchUser()
	{
		$user_id = $this->input->post('lm01_user_id');
		if(isset($user_id)){
			$this->Account_M->fetchUserInfo($user_id);
		}
	}

	public function modifyUserEmail()
	{
		$data = $this->input->post();
		$user_id = $data['a_user_id'];
		$data_update = array(
			"lm01_email" => $data['a_user_email'],
		);
		if($this->Account_M->editUserMail($user_id,$data_update)){
			echo 'ok';
		} else {
			echo 'Error';
		}

	}

	public function modifyUserPassword()
	{
		$data = $this->input->post();
		$user_id = $data['a_user_id_2'];
		$data_update = array(
			"lm01_password" => md5(md5($data['a_user_password'])),
		);
		if($this->Account_M->editUserMail($user_id,$data_update)){
			echo 'ok';
		} else {
			echo 'Error';
		}

	}

	public function login()
	{
		$this->load->view('admin/login.php');
		// redirect(base_url().'account/login','location');
	}

	public function search($offset=1) {
		$config['base_url']    = '#';
        $config['uri_segment'] = 4;
        $config['per_page']    = 10;

        $aData = [
            'start' => $config['per_page'],
            'limit' => ($offset-1)*$config['per_page'],
            'lm01_email'  => trim($this->input->post("lm01_email")),
        ];
        $list_users_search = $this->Account_M->getAllListUser($aData);

        $aData = [
            'lm01_email'  => $this->input->post("lm01_email"),
        ];
        $total_user_search = $this->Account_M->getAllListUser($aData);
        $config['total_rows'] = $total_user_search;
        $total_rows = CEIL($config['total_rows']/$config['per_page']);
        $config['use_page_numbers'] = TRUE;
        $config['num_tag_open']     = '<li class="pagclick">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '>';
        $config['prev_link']        = '<';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['last_link']        = 'Last';
        $config['first_link']       = 'First';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();


        $html = '<tr>
				<th>ユーザーID</th>
				<th>フルネーム</th>
				<th>状態</th>
				<th>メールアドレス</th>
				<th>操作</th>
            </tr>';
        if($total_user_search > 0){
        	$stt = 0;
            foreach ($list_users_search as $user_val) {
							if($user_val['lm01_active_status'] == 1){
								$status = '<font color="green">アクティブ</font>';
							} else {
								$status = '<font color="red">インアクティブ</font>';
							}
            	$stt += 1;
                $html .= '<tr> <td style="vertical-align: middle;">'.$user_val['lm01_user_id'].'</td>';
                $html .='<td style="vertical-align: middle;">'.$user_val['lm01_firstname'].' '.$user_val['lm01_lastname'].'</td>';
                $html .='<td style="vertical-align: middle;">'.$status.'</td>';
                $html .='<td style="vertical-align: middle;">'.$user_val['lm01_email'].'</td>';
                $html .='<td style="vertical-align: middle;"><input type="button" class="btn01 btn_edit" onclick="location.href=\''.base_url().'admin/user/edit/'.$user_val['lm01_user_id'].'\'" value="編集"></td>';

                $html .= '</td></tr>';
            }
        } else {
            $html .= '<tr><td colspan="5" style="color: red">結果はありません。</td></tr>';
        }

        $data['pagination']   = $pagination;
        $data['total_rows']   = $total_rows;
        $data['offset']       = $offset;
        $myObj['data_html']       = $html;
        $myObj['data_pagination'] = $pagination;
        $myObj['data_page']       = $offset;
        $myObj['data_total_rows'] = $total_rows;
        $myObj['data_this_page']  = $offset;
        $myObj['total_search']    = $total_user_search;
        $myJSON = json_encode($myObj);
        echo $myJSON;
	}


}
