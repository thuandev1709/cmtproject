<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info_company_M extends CI_Model {
	protected $table_info = "lm12_info_company";
	public function __construct() {
		parent::__construct();
	}

	public function fetchInfo()
	{
		$this->db->select('*');
		$this->db->where('lm12_id', 1);
		return $this->db->get($this->table_info)->row_array();
	}
	
	public function insert_info_company($data)
	{
		return $this->db->update($this->table_info,$data); 
	}
}