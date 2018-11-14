<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_M extends CI_Model {
	protected $table_lm10_event = "lm10_event";
	protected $table_lm03_category = "lm03_category";

	public function __construct() {
		parent::__construct();
	}

	public function max_idTax(){
		$this->db->select_max('lm03_cate_id');
		return $this->db->get($this->table_lm03_category)->row_array();
	}
	public function getList_Category(){
		$this->db->select("*");
		$this->db->join("lm10_event",'lm03_category.lm03_event_id  = lm10_event.lm10_event_id');
		$this->db->order_by("lm03_cate_id", "asc");
		return $this->db->get($this->table_lm03_category)->result_array();
	}
	public function insert_category($data){
		return $this->db->insert('lm03_category',$data);
	}

	public function getCategory_ById($id) {
		$this->db->select("*");
		$this->db->join("lm10_event",'lm03_category.lm03_event_id  = lm10_event.lm10_event_id');
		$this->db->where("lm03_cate_id",$id);
		return $this->db->get($this->table_lm03_category)->row_array();
	}

	public function update_Category($data,$id_category){
		$this->db->where('lm03_cate_id',$id_category);
		$this->db->update('lm03_category',$data);
	}


	public function getListCategory() {
		$this->db->select("*");
		return $this->db->get($this->table_lm03_category)->result_array();
	}

}