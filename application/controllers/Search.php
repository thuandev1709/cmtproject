<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Search_M');
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

  }

  public function result($key)
  {
    $key = protect_url('decrypted',$key,'leme_search');

    if(!isset($key) || $key == ''){
      redirect(base_url(),'location');
    }
    // $key=$this->input->get('event_key');
    $date_now = date('Ymd');
    $list_have_img=$this->Search_M->getListEvent_Search_have_img($key,$date_now);

    $list_have = [];

            foreach ($list_have_img as $have_img) {
                $date_start=$have_img['lm10_date_start'];
                $date_end=$have_img['lm10_date_end'];
                $date_start_format = date('Y年m月d日', strtotime($date_start));
                $date_end_format = date('Y年m月d日', strtotime($date_end));
                $list_have[] = [
                                    'id_event'   => $have_img['lm10_event_id'],
                                    'id_event_input'   => $have_img['lm10_event_id_input'],
                                    'name_event' => $have_img['lm10_event_name'],
                                    'date_start' => $date_start_format,
                                    'date_end' => $date_end_format,
                                ];


            }

            $list_empty_img=$this->Search_M->getListEvent_Search_empty_img($key,$date_now);
            $list_empty = [];

            foreach ($list_empty_img as $empty_img) {
                $date_start=$empty_img['lm10_date_start'];
                $date_plan=$empty_img['lm10_date_predetermine'];
                $date_start_format = date('Y年m月d日', strtotime($date_start));
                $date_plan_format = date('Y年m月d日', strtotime($date_plan));
                $list_empty[] = [
                                    'id_event'   => $empty_img['lm10_event_id'],
                                    'id_event_input'   => $empty_img['lm10_event_id_input'],
                                    'name_event' => $empty_img['lm10_event_name'],
                                    'date_start' => $date_start_format,
                                    'date_plan' => $date_plan_format,
                                ];


            }
    $this->data['key'] = $key;
    $this->data['count_have_img'] = count($list_have);
    $this->data['count_empty_img'] = count($list_empty);
    $this->data['list_have_img'] = $list_have;
    $this->data['list_empty_img'] = $list_empty;
    $this->header();
    $this->load->view('search/search.php',$this->data);
    $this->footer();
  }

  public function confirm($id_event='')
  {
    if($id_event==''){
      redirect(base_url());
    }
    $data['id_event'] = $id_event;
    $this->header();
    $this->load->view('search/confirm.php',$data);
    $this->footer();
  }

public function check_mail()
  {

    $c_mail=$this->input->post('email');
        $check_email = $this->Search_M->check_email($c_mail);
        if ($check_email==TRUE) {
          echo " $c_mail 存在する。 もう一度お試しください。";
        }

  }


  public function confirm_info()
  {

      if($this->input->post('btn')){
        $id_event1 = $this->input->post('id_event1');
        $email1 = $this->input->post('mail1');
        $confirm1 = $this->input->post('confirm1');
        $create_at = dateInsert();
        $updated_at = dateInsert();
        if($confirm1=='本人'){
                $confirm1 = 1;
              }else if($confirm1=='関係者'){
                $confirm1 = 2;
              }else if($confirm1=='無関係'){
                $confirm1 = 0;
              }
        $arr_mail = [
          "lm15_event_id" => $id_event1,
          "lm15_email" => $email1,
          "lm15_type" => $confirm1,
          "lm15_created_at" => $create_at,
          "lm15_updated_at" => $updated_at
        ];
      $this->Search_M->creat_email($arr_mail);
       redirect(base_url('search/success'));
      }


    if($this->input->post('sub')){
        $data['id_event'] = $this->input->post('id_event') ? $this->input->post('id_event') : '';
        $data['email'] = $this->input->post('email') ? $this->input->post('email') : '';
        $data['confirm'] = strlen($this->input->post('confirm')) ? $this->input->post('confirm') : '2';

    }else{
      redirect(base_url('search/confirm'));
    }

    $this->header();
    $this->load->view('search/confirm_info.php',$data);
    $this->footer();
  }


  public function success()
  {
    $this->header();
    $this->load->view('search/success.php');
    $this->footer();
  }

}
