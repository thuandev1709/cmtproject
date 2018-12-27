<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_M extends CI_Model {

	public $table_admin = 'cmt01_admin';
	public $table_users = 'cmt02_users';

	public function __construct() {
		parent::__construct();
	}

	public function checkLogin($account,$password) {
		$this->db->where('cmt02_username',$account);
		$this->db->where('cmt02_password',$password);
		$query=$this->db->get($this->table_users)->num_rows();
		if($query > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function checkLogin_admin($account,$password) {
		$this->db->where('cmt01_username',$account);
		$this->db->where('cmt01_password',$password);
		$query=$this->db->get($this->table_admin)->num_rows();
		if($query > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getAdmin($account) {
		$this->db->select('*');
		$this->db->where('cmt01_username',$account);
		return $this->db->get($this->table_admin)->result_array();
	}
}

/* End of file Account_M.php */
/* Location: ./application/models/Account_M.php */
