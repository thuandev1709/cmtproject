<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics_M extends CI_Model {

	public $event = 'lm10_event';
	public $order_details = 'lm08_order_details';

	public $order = 'lm07_order';

	public $product = 'lm04_product';
	public $default = 'lm11_default_value';


	public function __construct()
	{
		parent::__construct();

	}

	public function getAll_Event($id) {
		$this->db->select('*');
		if($id!=''){
			$this->db->where('lm10_event_id',$id);
		}
		return $this->db->get($this->event)->result_array();
	}

	public function getAll_Event_diff($id) {
		$this->db->select('*');
		$this->db->where('lm10_event_id <>',$id);
		return $this->db->get($this->event)->result_array();
	}


	public function all_event($limit, $start,$search){

		if($search !=''){

		$qr = $this->db->select(" *,COUNT(lm10_event_id) as total FROM lm10_event as tb1  JOIN (SELECT * from lm04_product WHERE lm04_product.lm04_pro_type = '1' and lm04_product.lm04_active_status = '1') as tb2 ON tb1.lm10_event_id = tb2.lm04_event_id WHERE lm10_event_id = '$search' GROUP BY lm10_event_id ORDER by lm10_event_id ASC ");

		}else{

		$qr = $this->db->select(" *,COUNT(lm10_event_id) as total FROM lm10_event as tb1  JOIN (SELECT * from lm04_product WHERE lm04_product.lm04_pro_type = '1' and lm04_product.lm04_active_status = '1') as tb2 ON tb1.lm10_event_id = tb2.lm04_event_id GROUP BY lm10_event_id ORDER by lm10_event_id ASC ");
		$this->db->limit($limit, $start);
		}



		return $this->db->get()->result_array();
	}

	public function count_all_event($warn){
		$this->db->select('*,count(lm10_event_id) as total');
		$this->db->join($this->product,'lm10_event.lm10_event_id = lm04_product.lm04_event_id','left');
		$this->db->where('lm04_pro_quantity <=',$warn);
		$this->db->group_by('lm10_event_id');
		$this->db->order_by('lm10_event_id','ASC');
		return $this->db->get($this->event)->num_rows();
	}

	public function count_all_event_dvd(){
		$this->db->select(" *,COUNT(lm10_event_id) as total FROM lm10_event as tb1  JOIN (SELECT * from lm04_product WHERE lm04_product.lm04_pro_type = '1' and lm04_product.lm04_active_status = '1') as tb2 ON tb1.lm10_event_id = tb2.lm04_event_id GROUP BY lm10_event_id ORDER by lm10_event_id ASC ");

		return $this->db->get()->num_rows();
	}

	public function product_event($aData = array(),$warn){
		$this->db->select(" *,sum(lm08_quantity) as sumqt FROM `lm10_event` as tb1 left JOIN ( SELECT * from lm04_product left JOIN lm08_order_details on lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id WHERE lm04_pro_type ='1' and lm04_active_status ='1') as tb2 on tb1.lm10_event_id = tb2.lm04_event_id  ");
		if($warn!=''){
			$this->db->where('lm04_pro_quantity <=',$warn);
		}

		$this->db->where('lm10_event_id',$aData['id_event']);
		$this->db->group_by('lm04_pro_id');
		return $this->db->get()->result_array();
	}

	public function get_value_warn(){
		$this->db->select('*');
		$this->db->where('lm11_id','6');
		return $this->db->get($this->default)->result_array();
	}


	public function all_event_have_warn($limit, $start,$warn){
		$this->db->select("*,COUNT(lm10_event_id) as total FROM lm10_event as tb1 LEFT JOIN (SELECT * from lm04_product WHERE lm04_product.lm04_pro_type = '1' and lm04_product.lm04_active_status = '1') as tb2 ON tb1.lm10_event_id = tb2.lm04_event_id WHERE lm04_pro_quantity <= '$warn' GROUP BY lm10_event_id ORDER by lm10_event_id ASC ");

		$this->db->limit($limit, $start);

		return $this->db->get()->result_array();
	}






	public function getAll_payment() {
		$this->db->select('*');
		return $this->db->get('lm13_pay_method')->result_array();
	}

	public function getPayment($event_id, $fromdate, $todate, $name_product, $type) {
		$today = date('Ymd');
		$this->db->select('*');
		$this->db->join(' lm08_order_details',' lm08_order_details.lm08_order_id = lm07_order.lm07_order_id', 'left');
		$this->db->join(' lm04_product',' lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id', 'left');
		$this->db->join(' lm13_pay_method',' lm13_pay_method.lm13_method_id = lm07_order.lm07_method_id');
		if($event_id != "")
			$this->db->where('lm04_product.lm04_event_id =', $event_id);
		if($name_product != "")
			$this->db->like('lm04_product.lm04_pro_name =', $name_product);

		// if($todate == $fromdate) {
		// 	$this->db->where('lm07_order.lm07_date_delivery >=', $fromdate);
		// } else {
		// 	if(isset($fromdate) && isset($todate) ) {
		// 		$this->db->where('lm07_order.lm07_date_delivery >=', $fromdate);
		// 		$this->db->where('lm07_order.lm07_date_delivery <=', $todate);
		// 	}
		// }

		if($fromdate != "" && $fromdate != $todate )
			$this->db->where('lm07_order.lm07_date_order >=', $fromdate);

		if($todate != ""  && $fromdate != $todate)
			$this->db->where('lm07_order.lm07_date_order <=', $todate);

		if($fromdate == $todate)
			$this->db->where('lm07_order.lm07_date_order >=', $fromdate);

		if($type != "")
			$this->db->where('lm04_product.lm04_pro_type =', $type);
		$this->db->group_by('lm07_order_id');
		return $this->db->get($this->order)->result_array();
	}

	public function getToday_payment() {
		$today = date('Ymd');
		$this->db->select('*');
		// $this->db->where('lm07_order.lm07_date_delivery >=', $today);
		$this->db->join(' lm08_order_details',' lm08_order_details.lm08_order_id = lm07_order.lm07_order_id', 'left');
		$this->db->join(' lm04_product',' lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id', 'left');
		// $this->db->join('lm13_pay_method','lm13_pay_method.lm13_method_id = lm07_order.lm07_method_id', 'right');
		return $this->db->get($this->order)->result_array();
	}

	public function getHistory_detail($order_id) {
		$this->db->select('*');
		$this->db->where('lm07_order.lm07_order_id',$order_id);
		$this->db->join('lm13_pay_method','lm07_order.lm07_method_id  = lm13_pay_method.lm13_method_id', 'left');
    	return $this->db->get($this->order)->row_array();
	}

	public function getHistory_product($order_id) {
		$this->db->select('*');
		$this->db->where('lm07_order_id',$order_id);
		$this->db->join('lm08_order_details','lm08_order_details.lm08_order_id = lm07_order.lm07_order_id','left');
		$this->db->join('lm04_product','lm08_order_details.lm08_pro_id = lm04_product.lm04_pro_id', 'left');
		$this->db->join('lm10_event','lm10_event.lm10_event_id = lm04_product.lm04_event_id', 'left');
    	return $this->db->get($this->order)->result_array();
	}

	public function update_quantity_product($id_pro,$update_pro) {
		$this->db->where('lm04_pro_id',$id_pro);
    	return $this->db->update($this->product, $update_pro);
	}

	public function old_date($user,$fromdate,$todate,$type,$start,$limit) {
		$today = date('Ymd');
		$this->db->select('lm07_order.lm07_date_order');
		$this->db->where('lm07_order.lm07_user_id',$user);
		if ($type != '' )
			$this->db->where('lm07_order.lm07_pay_status =',$type);

		if($todate != '' && $fromdate != $todate){
			$this->db->where('lm07_order.lm07_date_order <=', $todate);
		}

		if($fromdate != '' && $fromdate != $todate){
			$this->db->where('lm07_order.lm07_date_order >=', $fromdate);
		}

		if($fromdate == $todate)
			$this->db->where('lm07_order.lm07_date_order >=', $fromdate);

		$this->db->join('lm13_pay_method','lm07_order.lm07_method_id  = lm13_pay_method.lm13_method_id');
    	return $this->db->get($this->order,$start,$limit)->result_array();
	}

	public function all_date($user,$fromdate,$todate,$type) {
		$today = date('Ymd');
		$this->db->select('lm07_order.lm07_date_order');
		$this->db->where('lm07_order.lm07_user_id',$user);
		if ($type != '' )
			$this->db->where('lm07_order.lm07_pay_status',$type);

		if($todate != '' && $fromdate != $todate){
			$this->db->where('lm07_order.lm07_date_order <=', $todate);
		}

		if($fromdate != '' && $fromdate != $todate){
			$this->db->where('lm07_order.lm07_date_order >=', $fromdate);
		}

		if($fromdate == $todate)
			$this->db->where('lm07_order.lm07_date_order >=', $fromdate);

		$this->db->join('lm13_pay_method','lm07_order.lm07_method_id  = lm13_pay_method.lm13_method_id');
    	return $this->db->get($this->order)->num_rows();
	}

	public function get_order_bydate($user,$date,$type) {
		$this->db->select('*');
		$this->db->where('lm07_user_id',$user);
		$this->db->like('lm07_date_order',$date);
		if ($type != '' )
			$this->db->where('lm07_pay_status =',$type);

		$this->db->join('lm13_pay_method','lm07_method_id  = lm13_method_id');
    	return $this->db->get($this->order);
	}


	public function getLatestOrder($user)
	{
		$this->db->select('*');
		$this->db->where('lm07_user_id',$user);
		$this->db->join('lm13_pay_method','lm07_method_id  = lm13_method_id');
		$this->db->order_by('lm07_order_id','DESC');
		return $this->db->get($this->order)->row_array();
	}






}



 ?>
