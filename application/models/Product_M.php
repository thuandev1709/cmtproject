<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_M extends CI_Model {

	protected $table_lm03_category = "lm03_category";
	protected $table_lm04_product = "lm04_product";
	protected $table_lm11_default_value = "lm11_default_value";
	protected $table_lm08_order_details = "lm08_order_details";
	protected $table_lm05_image = "lm05_image";
	protected $table_lm06_movie = "lm06_movie";

	public function __construct() {
		parent::__construct();
	}

	public function getListProductFollowEvent($event_id) {
		// $this->db->join("lm03_category",'lm04_product.lm04_cate_id = lm03_category.lm03_cate_id');
		$this->db->where("lm04_event_id",$event_id);
		$this->db->where("lm04_active_status", '1');
		return $this->db->get($this->table_lm04_product)->result_array();
	}

	public function getListProductSearch($event_id, $lm04_pro_name, $lm04_pro_type) {
		// $this->db->join("lm03_category",'lm04_product.lm04_cate_id = lm03_category.lm03_cate_id');
		if ($lm04_pro_type != '') {
			$this->db->where("lm04_pro_type", $lm04_pro_type);
		}
		if ($lm04_pro_name != '') {
			$this->db->like("lm04_pro_name", $lm04_pro_name);
		}
		$this->db->where("lm04_event_id",$event_id);
		$this->db->where("lm04_active_status", '1');
		return $this->db->get($this->table_lm04_product)->result_array();
	}

	public function getProductByID($id_product, $product_type) {
		$this->db->join("lm10_event",'lm04_product.lm04_event_id = lm10_event.lm10_event_id');
		if ($product_type == 0) {
			$this->db->join("lm05_image",'lm04_product.lm04_pro_id = lm05_image.lm05_pro_id');
			$this->db->where("lm04_product.lm04_pro_type", $product_type);
		}
		if ($product_type == 1) {
			$this->db->join("lm06_movie",'lm04_product.lm04_pro_id = lm06_movie.lm06_pro_id');
			$this->db->where("lm04_product.lm04_pro_type", $product_type);
		}
		$this->db->where("lm04_product.lm04_pro_id", $id_product);
		return $this->db->get($this->table_lm04_product)->row_array();
	}

	public function getCategoryByEventID($id_event) {
		$this->db->where("lm03_event_id",$id_event);
		return $this->db->get($this->table_lm03_category)->result_array();
	}

	public function insertProduct($array_product) {
		return $this->db->insert($this->table_lm04_product, $array_product);
	}

	public function editProduct($id_product, $data){
		$this->db->where("lm04_pro_id", $id_product);
		return $this->db->update($this->table_lm04_product, $data);
	}

	public function getTotalProduct() {
		return $this->db->count_all($this->table_lm04_product);
	}

	public function getValueDefault($id) {
		$this->db->where("lm11_id",$id);
		return $this->db->get($this->table_lm11_default_value)->row_array();
	}

	public function insertDefault($array_default) {
		return $this->db->insert($this->table_lm11_default_value, $array_default);
	}

	public function deleteAllDefault() {
		$this->db->empty_table($this->table_lm11_default_value);
	}

	public function getTotalQuantityDVD($lm04_pro_type) {
		$this->db->select_sum('lm04_pro_quantity');
		$this->db->where("lm04_pro_type",$lm04_pro_type);
		$result = $this->db->get($this->table_lm04_product)->row_array();
		return $result['lm04_pro_quantity'];
	}

	public function getTotalQuantityDVDsell($id_product, $lm04_pro_type) {
		$this->db->select_sum('lm08_quantity');
		$this->db->join("lm04_product",'lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id');
		$this->db->where("lm08_pro_id",$id_product);
		$this->db->where("lm04_pro_type",$lm04_pro_type);
		$result = $this->db->get($this->table_lm08_order_details)->row_array();
		return $result['lm08_quantity'];
	}

	public function totalProduct() {
		$this->db->select_max("lm04_pro_id");
		$total = $this->db->get($this->table_lm04_product)->row_array();
		return $total['lm04_pro_id'];
	}

	public function deleteImage($id_product) {
		$this->db->where('lm05_pro_id', $id_product);
		$this->db->delete($this->table_lm05_image);
	}

	public function deleteVideo($id_product) {
		$this->db->where('lm06_pro_id', $id_product);
		$this->db->delete($this->table_lm06_movie);
	}

	public function addImage($arr_add_image) {
		return $this->db->insert($this->table_lm05_image, $arr_add_image);
	}

	public function addVideo($arr_add_movie) {
		return $this->db->insert($this->table_lm06_movie, $arr_add_movie);
	}

	public function updateImage($id_product, $data) {
		$this->db->where('lm05_pro_id', $id_product);
		$this->db->update($this->table_lm05_image, $data);
	}

	public function updateVideo($id_product, $data) {
		$this->db->where('lm06_pro_id', $id_product);
		$this->db->update($this->table_lm06_movie, $data);
	}
}