<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('News_M');
  }

  public function header()
	{
		$this->load->view('admin/header.php');
	}

  function index($offset = 1)
  {
    $this->header();
    $config['base_url']    = base_url().'admin/news';
        $config['uri_segment'] = 3;
        $config['per_page']    = 10;

        $aData = [
            'start'            => $config['per_page'],
            'limit'            => ($offset-1)*$config['per_page'],
        ];
        $list_news = $this->News_M->getAllNews($aData);
        $total_news  = $this->News_M->getAllNews('');

		//pagination
        $config['total_rows']       = $total_news;
        $total_rows                 = CEIL($config['total_rows']/$config['per_page']);
        $config['use_page_numbers'] = TRUE;
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '>';
        $config['prev_link']        = '<';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['last_link']        = 'Last';
        $config['first_link']       = 'First';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $this->_data['pagination'] = $pagination;
        $this->_data['total_rows'] = $total_rows;
        $this->_data['offset'] = $offset;
      //list all users
    		$this->_data['list_news'] = $list_news;
    		$this->_data["count"]    = $total_news;
        $this->_data['latest_id'] = $this->News_M->getMaxID();
      // add news
        $post = $this->input->post();
        if(isset($post['btn_submit'])){
          $title = $post['lm16_news_title'];
          $date = $post['lm16_news_date'];
          $date_create = substr($date,  0, 4) . substr($date,  7, 2) . substr($date,  12, 2);
          $content = $post['lm16_news_content'];
          $status = $post['lm16_news_status'];
          $data = array(
            'lm16_news_title' => $title,
            'lm16_news_date' => $date_create,
            'lm16_news_content' => $content,
            'lm16_news_status' => $status,
            'lm16_news_created_at' => date('YmdHis'),
            'lm16_news_updated_at' => date('YmdHis'),
          );
          if($this->News_M->addNews($data)){
            $this->session->set_flashdata('category_success', '正常に作成されました。');
            redirect(base_url().'admin/news');
          }
        }
    $this->load->view('admin/news/index.php',$this->_data);
  }

  public function edit($id)
  {
    $this->header();
    $this->_data['news'] = $this->News_M->fetchNewsDetails($id);

    $post = $this->input->post();
    if(isset($post['btn_submit'])){
      $title = $post['lm16_news_title'];
      $date = $post['lm16_news_date'];
      $date_create = substr($date,  0, 4) . substr($date,  7, 2) . substr($date,  12, 2);
      $content = $post['lm16_news_content'];
      $status = $post['lm16_news_status'];
      $data = array(
        'lm16_news_title' => $title,
        'lm16_news_date' => $date_create,
        'lm16_news_content' => $content,
        'lm16_news_status' => $status,
        'lm16_news_updated_at' => date('YmdHis'),
      );
      if($this->News_M->updateNews($id,$data)){
        $this->session->set_flashdata('category_success', '正常に作成されました。');
        redirect(base_url().'admin/news','location');
      }
    }
    $this->load->view('admin/news/edit.php',$this->_data);
  }

}
