<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_M extends CI_Model {

	protected $table_event = "lm10_event";
	protected $table_product = "lm04_product";
	protected $table_img = "lm05_image";
	protected $table_email = "lm15_email_send_mail";

	public function __construct() {
		parent::__construct();
	}
	public function getListEvent_Search_have_img($key,$date_now){
		$this->db->select("*");
		$this->db->like("lm10_event_id_input",$key);
		$this->db->where("lm10_display	",1);
		$this->db->where("lm10_date_end	>=",$date_now);
		$this->db->where("lm10_date_predetermine <=",$date_now);
		$this->db->group_by('lm10_event.lm10_event_id');
		return $this->db->get($this->table_event)->result_array();
	}
	public function getListEvent_Search_empty_img($key,$date_now){
		$this->db->select("*");
		$this->db->like("lm10_event_id_input",$key);
		$this->db->where("lm10_display	",1);
		$this->db->where("lm10_date_end	>=",$date_now);
		$this->db->where("lm10_date_predetermine >",$date_now);
		$this->db->group_by('lm10_event.lm10_event_id');
		return $this->db->get($this->table_event)->result_array();
	}

	public function creat_email($arr_mail){
		return $this->db->insert('lm15_email_send_mail',$arr_mail);
	}

	public function check_email($data) {
		$this->db->where('lm15_email', $data);
		$query = $this->db->get("lm15_email_send_mail")->num_rows();;
		if($query > 0){
			return TRUE;
		}else{
			return FALSE;
		}

	}
}