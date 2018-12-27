<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->header();
		$this->_sidebar['page_name'] = 'home';
		$this->load->view('admin/sidebar.php', $this->_sidebar);
		$this->load->view('admin/home');
        $this->footer();
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */