<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_M extends CI_Model {

	public $table_users = 'lm01_users';
	public $table_admin = 'lm09_admin';

	public function __construct()
	{
		parent::__construct();

	}

	public function checkLogin($account,$password)
	{
		$this->db->where('lm01_email',$account);
		$this->db->where('lm01_password',$password);
		$query=$this->db->get($this->table_users)->num_rows();
		if($query > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function getUser($account)
	{
		$this->db->select('*');
		$this->db->where('lm01_email',$account);
		return $this->db->get($this->table_users)->result_array();
	}


	public function checkLogin_admin($account,$password)
	{
		$this->db->where('lm09_username',$account);
		$this->db->where('lm09_password',$password);
		$query=$this->db->get($this->table_admin)->num_rows();
		if($query > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function getAdmin($account)
	{
		$this->db->select('*');
		$this->db->where('lm09_username',$account);
		return $this->db->get($this->table_admin)->result_array();
	}


	public function checkEmail($data) {
		$this->db->where('lm01_email', $data);
		$query = $this->db->get("lm01_users");
		if($query->num_rows() > 0){
			return $data;
		}
		return '';
	}

	public function updateUserPassword($email,$data)
	{
		$this->db->where('lm01_email', $email);
		return $this->db->update('lm01_users', $data);
	}

	public function user_add($data){
		return $this->db->insert('lm01_users',$data);
	}

	public function updateUser($id,$data)
	{
		$this->db->where('lm01_user_id', $id);
		return $this->db->update('lm01_users', $data);
	}

	public function getAllListUser($aData) {
		if (isset($aData['lm01_email']) && !empty($aData['lm01_email'])) {
			$this->db->like('lm01_email',$aData['lm01_email']);
		}

		if (isset($aData['start']) && isset($aData['limit'])) {
			$this->db->select('lm01_firstname,lm01_lastname,lm01_email,lm01_city,lm01_user_id,lm01_active_status');
			return $this->db->get($this->table_users,$aData['start'],$aData['limit'])->result_array();
		} else {
			$this->db->select('lm01_firstname,lm01_lastname,lm01_email,lm01_city,lm01_user_id.lm01_active_status');
			return $this->db->count_all_results($this->table_users);
		}

	}

	public function checkUserID($id)
	{
		$this->db->where('lm01_user_id', $id);
		$query = $this->db->get("lm01_users");
		if($query->num_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getUserDetail($id)
	{
		$this->db->select('*');
		$this->db->where('lm01_user_id', $id);
		return $this->db->get($this->table_users)->row_array();
	}

	public function fetchUserInfo($user_id)
	{
		$this->db->where('lm01_user_id', $user_id);
		$this->db->select('lm01_email,lm01_user_id');
		$query = $this->db->get('lm01_users')->row_array();
		if($query){
			$data['status'] = 'ok';
		    $data['result'] = $query;
		} else {
			$data['status'] = 'error';
		    $data['result'] = '';
		}
		echo json_encode($data);
	}

	public function editUserMail($user_id,$data_update)
	{
		$this->db->where('lm01_user_id', $user_id);
		return $this->db->update('lm01_users', $data_update);
	}

	public function checkCurrentPassword($user_id,$password)
	{
		$this->db->where('lm01_user_id', $user_id);
		$this->db->where('lm01_password', $password);
		$query = $this->db->get('lm01_users')->num_rows();
		if($query > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getUserInfoByEmail($email)
	{
		$this->db->select('lm01_email,lm01_user_activation,lm01_user_activation_token,lm01_firstname,lm01_lastname');
		$this->db->where('lm01_email',$email);
		return $this->db->get($this->table_users)->row_array();
	}

	public function activateUser($email,$data)
	{
		$this->db->where('lm01_email', $email);
		return $this->db->update($this->table_users, $data);
	}

}

/* End of file Account_M.php */
/* Location: ./application/models/Account_M.php */
