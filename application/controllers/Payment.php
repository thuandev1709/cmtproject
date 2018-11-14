<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_company_M');		
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
       
	}

	public function bank_transfer() {
		$info_company = $this->Info_company_M->fetchInfo();
		$this->_data['info_company'] = $info_company;
        $this->header();
		$this->load->view('payment/bank_transfer.php',$this->_data);
		$this->footer();
	}

	public function bank_card()  {
        $this->header();
		$this->load->view('payment/bank_card.php');
		$this->footer();
	}
}

