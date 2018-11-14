<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

    public function footer()
    {
        $this->load->view('admin/footer.php');
    }

	public function index()
	{
		$this->header();
		$this->load->view('admin/home.php');
        $this->footer();
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */