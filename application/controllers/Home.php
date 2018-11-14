<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->header();
		$this->load->model('News_M');
	}

	public function header()
	{
		$this->load->view('header.php');
	}

	public function footer()
	{
		$this->load->view('footer.php');
	}

	public function index()

	{
		if($this->input->get('bnt_search'))
		{
			$key = $this->input->get('event_key');
			$url_encrypted = protect_url('encrypted',$key,'leme_search');
			redirect(base_url('search/result/').$url_encrypted);
		}
		$this->_data['news'] = $this->News_M->getAllNewsHome();
		$this->load->view('index.php',$this->_data);
		$this->footer();
	}

	public function message()
	{
		$this->load->view('message.php');
		$this->footer();
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
