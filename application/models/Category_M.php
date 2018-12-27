<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_M extends CI_Model {

	protected $table_cmt03_category = "cmt03_category";

	public function __construct() {
		parent::__construct();
	}

	public function getListCategoryAll() {
		$this->db->where('cmt03_delete', 0);
		return $this->db->get($this->table_cmt03_category)->result_array();
	}

	public function getListCategoryParentMax() {
		$this->db->where('cmt03_level <>', 3);
		$this->db->where('cmt03_delete', 0);
		return $this->db->get($this->table_cmt03_category)->result_array();
	}

	public function getCategoryByID($id_cate) {
		$this->db->where("cmt03_id_cate", $id_cate);
		return $this->db->get($this->table_cmt03_category)->row_array();
	}

	public function insertCategory($arr_cmt03_category) {
		return $this->db->insert($this->table_cmt03_category, $arr_cmt03_category);
	}

	public function updateCategory($data, $id_cate) {
		$this->db->where('cmt03_id_cate', $id_cate);
		return $this->db->update($this->table_cmt03_category, $data);
	}

}

/* End of file Category_M.php */
/* Location: ./application/models/Category_M.php */
