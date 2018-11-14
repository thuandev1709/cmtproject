<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Event_M');
		$this->load->model('Page_M');
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

	public function faq()
	{
        $this->header();
		$this->load->view('page/faq.php');
		$this->footer();
	}

	public function flow()
	{
        $this->header();
		$this->load->view('page/flow.php');
		$this->footer();
	}

	public function terms()
	{
        $this->header();
		$this->load->view('page/terms.php');
		$this->footer();
	}

	public function law()
	{
        $this->header();
		$this->load->view('page/law.php');
		$this->footer();
	}

	public function privacy()
	{
        $this->header();
		$this->load->view('page/privacy.php');
		$this->footer();
	}

	public function is_logged_in()
	{
		$event = $this->session->userdata('event_id');
    	if(isset($event)) {

    	}
    	else {
      		redirect(base_url().'page/checkPasswordEvent');
    	}
	}

	public function checkPasswordEvent($id_event)
	{
		if($this->session->userdata('event_id') == $id_event){
			// $this->header();
			redirect("Cart/listCategory/$id_event");
		}
		$event = $this->Event_M->getEventByID($id_event);
		$err = '';

		if ($this->input->post('btnSubmitToList')) {
			$password_event = $this->input->post("password_event");
			$password_event = $password_event;

			if ($this->Page_M->checkPassEvent($password_event) == true) {
				$data_event = $this->getDataEvent($id_event);
				$this->session->set_userdata($data_event);
				redirect("Cart/listCategory/$id_event");
			}else {
				$err .= 'パスワードが間違っています。';
			}
		}

		$this->data['err'] = $err;
		$this->data['event'] = $event;
        $this->header();
		$this->load->view('check_pass_event', $this->data);
		$this->footer();
	}
	private function getDataEvent($id_event)
  {
    $event_info = $this->Page_M->getEvent($id_event)[0];
    $data = array(
		'event_id'  => $event_info['lm10_event_id'],
    );
    return $data;
  }
}
