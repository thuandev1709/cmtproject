<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_M extends CI_Model {
	protected $table_contact = "lm02_contact";
	public function __construct() {
		parent::__construct();
	}
	
	public function insert_Contact($data)
	{
		$this->db->insert('lm02_contact',$data); 
	}
}