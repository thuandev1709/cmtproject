<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Contact_M');
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
		$this->header();
        $fist_name=$this->input->post('fist_name');
        $last_name=$this->input->post('last_name');
        $name=$fist_name.' '.$last_name;
        $fist_zipcode=$this->input->post('contact[zip][zip01]');
        $last_zipcode=$this->input->post('contact[zip][zip02]');
        $zipcode=$fist_zipcode.$last_zipcode;
        $country=$this->input->post('lm01_county');
        $city=$this->input->post('city');
        $street=$this->input->post('street');
        $email=$this->input->post('email');
        $content_email=$this->input->post('content_email');
        $question_type=$this->input->post('question_type');
        $fist_phone=$this->input->post('fist_phone');
        $center_phone=$this->input->post('center_phone');
        $last_phone=$this->input->post('last_phone');
        $phone=$fist_phone.$center_phone.$last_phone;

        $this->_data['fist_name'] = $fist_name;
        $this->_data['last_name'] = $last_name;
        $this->_data['content_mail'] = $content_email;
        $this->_data['sender_name'] = $name;
        $this->_data['email'] = $email;
        $this->_data['fist_zipcode'] = $fist_zipcode;
        $this->_data['last_zipcode'] = $last_zipcode;
        $this->_data['county_box'] = $country;
        $this->_data['street'] = $street;
        // $this->_data['question_type'] = $question_type;
        $this->_data['city'] = $city;
        $this->_data['fist_phone'] = $fist_phone;
        $this->_data['center_phone'] = $center_phone;
        $this->_data['last_phone'] = $last_phone;
        $this->_data['date_sent'] = dateInsert();

        if($this->input->post() != NULL){
            $this->_data['error'] = '';
            if($this->input->post('back') == 'back'){
                $this->load->view('contact_form/contact.php',$this->_data);
            }else if($this->_data['error'] == ''){
                $this->load->view('contact_form/confirm_contact.php',$this->_data);
            }else{
                $this->load->view('contact.php',$this->_data);
            }

        } else {
    		$this->load->view('contact_form/contact.php',$this->_data);
        }
        $this->footer();
	}

	public function confirm()
	{
		$fist_name=$this->input->post('fist_name');
        $last_name=$this->input->post('last_name');
        $name=$fist_name.' '.$last_name;
        $fist_zipcode=$this->input->post('contact[zip][zip01]');
        $last_zipcode=$this->input->post('contact[zip][zip02]');
        $zipcode=$fist_zipcode.$last_zipcode;
        $country=$this->input->post('lm01_county');
        $city=$this->input->post('city');
        $street=$this->input->post('street');
        $email=$this->input->post('email');
        $content_email=$this->input->post('content_email');
        $question_type=$this->input->post('question_type');
        $fist_phone=$this->input->post('fist_phone');
        $center_phone=$this->input->post('center_phone');
        $last_phone=$this->input->post('last_phone');
        $phone=$fist_phone.$center_phone.$last_phone;

        $data = array(
            'lm02_firstname_sender' => $fist_name,
            'lm02_lastname_sender'  => $last_name,
            'lm02_email_sender  '   => $email,
            'lm02_zipcode'          => $zipcode,
            'lm02_county'           => $country,
            'lm02_city  '           => $city,
            'lm02_street'           => $street,
            'lm02_phone_number'     => $phone,
            'lm02_question_type'    => $question_type,
            'lm02_content_email'    => $content_email,
            'lm02_created_at'       => dateInsert(),
            'lm02_updated_at'       => dateInsert(),
                     );

        $this->_data['fist_name'] = $fist_name;
        $this->_data['last_name'] = $last_name;
        $this->_data['content_mail'] = $content_email;
        $this->_data['sender_name'] = $name;
        $this->_data['email'] = $email;
        $this->_data['fist_zipcode'] = $fist_zipcode;
        $this->_data['last_zipcode'] = $last_zipcode;
        $this->_data['county_box'] = $country;
        $this->_data['street'] = $street;
        $this->_data['city'] = $city;
        $this->_data['fist_phone'] = $fist_phone;
        $this->_data['center_phone'] = $center_phone;
        $this->_data['last_phone'] = $last_phone;
        $this->_data['date_sent'] = dateInsert();

        $email_template = $this->load->view('email_template/email_contact.php', $this->_data, TRUE);
        if(contact_mail($email, $name,'Contact from '.$name,$email_template)){
            if($this->Contact_M->insert_Contact($data)){
                echo 'ok';
            }
        }
	}

	public function success()
	{
		$this->header();
        $this->load->view('contact_form/success_contact.php');
        $this->footer();
	}

}

/* End of file  */
/* Location: ./application/controllers/ */