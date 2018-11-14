<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_M extends CI_Model {

	protected $table_lm10_event = "lm10_event";
	protected $table_product = 'lm04_product';
	protected $table_tax = 'lm14_tax_setting';

	public function __construct() {
		parent::__construct();
	}

	public function getListEvent() {
		return $this->db->get($this->table_lm10_event)->result_array();
	}

	public function getSearchlistEvent($lm10_event_id, $lm10_event_name, $lm10_date_start, $lm10_date_end) {
		if ($lm10_event_id != '') {
			$this->db->like("lm10_event_id_input", $lm10_event_id);
		}
		if ($lm10_event_name != '') {
			$this->db->like("lm10_event_name", $lm10_event_name);
		}
		if ($lm10_date_start != '') {
			$this->db->where('lm10_date_start >=', $lm10_date_start.'000000');
		}
		if ($lm10_date_end != '') {
			$this->db->where('lm10_date_end <=', $lm10_date_end.'000000');
		}
		return $this->db->get($this->table_lm10_event)->result_array();
	}

	public function getEventByID($event_id) {
		$this->db->where("lm10_event_id",$event_id);
		return $this->db->get($this->table_lm10_event)->row_array();
	}

	public function check_Event($data) {
		$this->db->where('lm10_event_id_input', $data);
		$query = $this->db->get("lm10_event");
		if($query->num_rows() > 0){
			return $data;
		}
		return '';
	}

	public function insert_event($data){
		return $this->db->insert('lm10_event',$data);
	}

	public function update_event($data,$id_event_history){
		$this->db->where('lm10_event_id',$id_event_history);
		$this->db->update('lm10_event',$data);
	}

	public function delete_event($id_event){
		$this->db->where('lm10_event_id',$id_event);
		$this->db->delete('lm10_event');
	}

	public function getListEvent_Search($id_event,$name_event,$type, $fromdate,$todate,$date_create,$date_end){
		$this->db->select("*");
		$this->db->like("lm10_event_id_input",$id_event);
		$this->db->like("lm10_event_name",$name_event);
		if($type != '') $this->db->where('lm10_display', $type);
		if($fromdate != '') $this->db->where('lm10_date_start >=', $date_create);
		if($todate != '') $this->db->where('lm10_date_start <=', $date_end);
		return $this->db->get($this->table_lm10_event)->result_array();
	}

	public function getListProduct_byEvent($id){
		$this->db->select("*");
		$this->db->where("lm04_event_id",$id);
		return $this->db->get($this->table_product)->result_array();
	}

	public function getListTax() {
		return $this->db->get($this->table_tax)->result_array();
	}
	public function max_idTax(){
		$this->db->select_max('lm14_tax_id');
		return $this->db->get($this->table_tax)->row_array();
	}
	public function date_max($date_now){
		$this->db->select('*');
		$this->db->where('lm14_date_start <=', $date_now);
		$this->db->order_by("lm14_date_start", "desc");
		$this->db->limit(1);
		return $this->db->get($this->table_tax)->row_array();
	}
	
	public function insert_tax($data){
		return $this->db->insert('lm14_tax_setting',$data);
	}

	public function getTaxByID($id) {
		$this->db->where("lm14_tax_id",$id);
		return $this->db->get($this->table_tax)->row_array();
	}

	public function update_Tax($data,$id_tax){
		$this->db->where('lm14_tax_id',$id_tax);
		$this->db->update('lm14_tax_setting',$data);
	}
}

/* End of file Event_M.php */
/* Location: ./application/models/Event_M.php */
