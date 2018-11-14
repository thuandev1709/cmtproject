<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
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

  function index()
  {
    redirect(base_url(),'location');
  }

  public function view($id)
  {
    $this->header();
    $id = protect_url('decrypted',$id,'lemeshop@2018');
    if(!isset($id) || $id == ''){
      redirect(base_url(),'location');
    }
    $this->_data['news'] = $this->News_M->fetchNewsDetails($id);
    $this->load->view('news.php',$this->_data);
    $this->footer();
  }

}
