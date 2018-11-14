<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_M extends CI_Model {

	protected $table_lm03_category = "lm03_category";
	protected $table_lm04_product = "lm04_product";
	protected $table_lm14_tax_setting = "lm14_tax_setting";

	public function __construct() {
		parent::__construct();
	}

	public function listDVDByEventID($id_event) {
		$this->db->where("lm04_event_id", $id_event);
		$this->db->where("lm04_pro_type", '1');
		$this->db->where("lm04_active_status", '1');
		$this->db->where("lm04_display", '1');
		return $this->db->get($this->table_lm04_product)->result_array();
	}

	public function listCategoryByEventID($id_event) {
		$this->db->where("lm03_event_id", $id_event);
		$this->db->where("lm03_active_status", '1');
		$this->db->where("lm03_display", '1');
		return $this->db->get($this->table_lm03_category)->result_array();
	}

	public function listProductByCateID($id_cate) {
		$this->db->join("lm05_image",'lm04_product.lm04_pro_id = lm05_image.lm05_pro_id');
		$this->db->where("lm04_cate_id", $id_cate);
		$this->db->where("lm04_active_status", '1');
		$this->db->where("lm04_display", '1');
		return $this->db->get($this->table_lm04_product)->result_array();
	}

	public function getNameCateByID($id_cate) {
		$this->db->where("lm03_cate_id", $id_cate);
		$result = $this->db->get($this->table_lm03_category)->row_array();
		return $result['lm03_cate_name'];
	}

	public function getTax($today) {
		$this->db->where("lm14_date_start <=", $today);
		$this->db->where("lm14_date_end >=", $today);
		$result = $this->db->get($this->table_lm14_tax_setting)->row_array();
		if ($result) {
			return $result['lm14_percent'];
		}else return 0;
	}

}