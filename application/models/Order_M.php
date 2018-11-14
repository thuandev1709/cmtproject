<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_M extends CI_Model {

	protected $table_lm04_product       = 'lm04_product';
	protected $table_lm07_order         = 'lm07_order';
	protected $table_lm08_order_details = 'lm08_order_details';
	protected $table_lm10_event         = 'lm10_event';
	protected $table_lm17_delivery_address_new = 'lm17_delivery_address_new';

	public function __construct() {
		parent::__construct();
	}

	public function queryOrder($aData) {
		$this->db->join(' lm08_order_details',' lm08_order_details.lm08_order_id = lm07_order.lm07_order_id','left');
		$this->db->join(' lm04_product',' lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id','left');
		$this->db->join('lm10_event','lm10_event.lm10_event_id = lm04_product.lm04_event_id','left');
		$this->db->join('lm13_pay_method','lm13_pay_method.lm13_method_id = lm07_order.lm07_method_id','left');
		$this->db->group_by('lm07_order_id');
		if(!empty($aData['lm07_order_id'])) $this->db->like('lm07_order.lm07_order_id', $aData['lm07_order_id']);
		if(!empty($aData['id_event'])) $this->db->like('lm04_product.lm04_event_id',$aData['id_event']);
		if(!empty($aData['date_from_search'])) $this->db->where('lm07_order.lm07_date_order >=', $aData['date_from_search']);
		if(!empty($aData['date_to_search'])) $this->db->where('lm07_order.lm07_date_order <=', $aData['date_to_search']);
		if(!empty($aData['lm07_date_order'])) $this->db->where('lm07_date_order', $aData['lm07_date_order']);
		if(isset($aData['lm07_pay_status'])) {
			if ($aData['lm07_pay_status'] < 3) {
				$this->db->where('lm07_order.lm07_pay_status', $aData['lm07_pay_status']);
			}
		}
	}

	public function getListOrder($aData) {
		$this->queryOrder($aData);
		if (isset($aData['start']) && isset($aData['limit'])) {
			$this->db->select("*");
			return $this->db->get($this->table_lm07_order)->result_array();
		} elseif (!empty($aData['print_pdf']) && $aData['print_pdf'] == 1) {
			$this->db->join('lm01_users','lm01_users.lm01_user_id = lm07_order.lm07_user_id','left');
			$this->db->select("lm10_event_id,lm10_event_id_input,lm10_event_name,lm07_order_id,lm07_method_id,lm08_price,lm08_order_details_id,lm08_quantity,lm08_pro_id,lm08_total_price,lm07_date_order,lm01_users.*,lm13_pay_method.*");
			return $this->db->get($this->table_lm07_order)->result_array();
		} else {
			$this->db->group_by('lm07_date_order');
			return $this->db->count_all_results($this->table_lm07_order);
		}
	}

	public function getListDetailOrder($aData) {
		$this->db->join('lm07_order','  lm07_order.lm07_order_id = lm08_order_details.lm08_order_id','left');
		$this->db->join('lm04_product',' lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id','left');
		$this->db->join('lm10_event','lm10_event.lm10_event_id = lm04_product.lm04_event_id','left');
		$this->db->join('lm03_category','lm03_category.lm03_cate_id = lm04_product.lm04_cate_id','left');
		$this->db->where('lm08_order_details.lm08_order_id', $aData['order_id']);

		if (isset($aData['start']) && isset($aData['limit'])) {
			$this->db->select("lm04_pro_id,lm04_pro_name,lm10_event_id,lm10_event_id_input,lm10_event_name,lm03_cate_name,lm07_order_id,lm08_price,lm08_quantity,lm08_total_price,lm07_date_order,lm04_pro_type,lm07_fee_transport,lm07_usb_money");
			return $this->db->get($this->table_lm08_order_details,$aData['start'],$aData['limit'])->result_array();
		}  elseif (!empty($aData['print_pdf']) && $aData['print_pdf'] == 1) {
			$this->db->select("lm10_event_id,lm10_event_id_input,lm10_event_name,lm07_order.lm07_order_id,lm07_order.lm07_method_id,lm08_price,lm08_order_details_id,lm08_quantity,lm08_pro_id,lm08_total_price,lm07_date_order,lm04_product.lm04_pro_id,lm04_product.lm04_pro_name,lm07_fee_transport");

			return $this->db->get($this->table_lm08_order_details)->result_array();
		} else {
			return $this->db->count_all_results($this->table_lm08_order_details);
		}
	}

	public function groupByOder($aData) {
		$this->db->select("lm07_date_order,count(lm07_date_order) as total");
		$this->db->group_by('lm07_date_order');
		return $this->db->get($this->table_lm07_order,$aData['start'],$aData['limit'])->result_array();
	}

	public function getListOrderById($lm07_order_id) {
		$this->db->select("lm07_order.*,lm01_users.lm01_zipcode,lm01_users.lm01_county,lm01_users.lm01_street,lm01_users.lm01_lastname,lm01_users.lm01_firstname,lm01_users.lm01_phone_number_1,lm01_users.lm01_user_id,lm01_users.lm01_email,lm13_pay_method.lm13_method_name");
		$this->db->join('lm01_users','lm01_users.lm01_user_id = lm07_order.lm07_user_id','left');
		$this->db->join('lm13_pay_method','lm13_pay_method.lm13_method_id = lm07_order.lm07_method_id','left');
		$this->db->where('lm07_order_id', $lm07_order_id);
		return $this->db->get($this->table_lm07_order)->row_array();
	}

	public function updateOrder($lm07_order_id,$data_update) {
		$this->db->where('lm07_order_id', $lm07_order_id);
		$this->db->update($this->table_lm07_order,$data_update);
	}

	public function getLisProdById($lm04_pro_id) {
		$this->db->select("*");
		$this->db->where('lm04_pro_id', $lm04_pro_id);
		return $this->db->get($this->table_lm04_product)->row_array();
	}

	public function insertOrder($data){
		$this->db->insert('lm07_order',$data);
		return $this->db->insert_id();
	}

	public function insertOrderDetail($data){
		return $this->db->insert('lm08_order_details',$data);
	}

	public function getPriceOrderByID($order_id) {
		$this->db->where("lm07_order_id",$order_id);
		$result = $this->db->get($this->table_lm07_order)->row_array();
		return $result['lm07_total_price'];
	}

	public function insertDeliveryAddress($data) {
		return $this->db->insert($this->table_lm17_delivery_address_new, $data);
	}
}

/* End of file Order_M.php */
/* Location: ./application/models/Order_M.php */
