<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_M extends CI_Model {

	public $table_lm10_event = 'lm10_event';

	public function __construct()
	{
		parent::__construct();

	}

	public function checkPassEvent($password)
	{
		$this->db->where('lm10_event_password', $password);
		$query = $this->db->get($this->table_lm10_event)->num_rows();
		if($query > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function getEvent($id_event)
	{
		$this->db->select('*');
		$this->db->where('lm10_event_id',$id_event);
		return $this->db->get($this->table_lm10_event)->result_array();
	}

}

/* End of file Page_M.php */
/* Location: ./application/models/Page_M.php */
