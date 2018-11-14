<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_company_M');
	}

	public function index()
	{
		redirect('info','location');
	}

	public function info()
	{	
		if($this->input->post('btnSubmit')){
			$name = $this->input->post('name') ? $this->input->post('name') : '';
			$address = $this->input->post('address') ? $this->input->post('address') : '';
			$phone = $this->input->post('phone') ? $this->input->post('phone') : '';
			$info = $this->input->post('info') ? $this->input->post('info') : '';
			if(is_numeric($phone)==true){
				$value = array(
		      'lm12_name'   => $name,
		      'lm12_address'   => $address,
		      'lm12_phone' => $phone,
		      'lm12_info_customer'   => $info,
	    		);
	    	$this->Info_company_M->insert_info_company($value);
	    	//$data['notify'] = "Successly";
	    	$this->session->set_flashdata('category_success', '更新成功。');
	    	redirect(base_url().'admin/system/info','location');
			}else{
			//$data['notify'] = "Error phone";
			$this->session->set_flashdata('category_error', 'Error phone');
			redirect(base_url().'admin/system/info','location');
			}
		}
		$this->header();
		$this->_data['info'] = $this->Info_company_M->fetchInfo();
		$this->load->view('admin/info.php', $this->_data);

		
	}

}

/* End of file  */
/* Location: ./application/controllers/ */