<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Statistics_M');

	}

	public function is_logged_in()
	{
		$user = $this->session->userdata('user_id');
	    if(isset($user)) {

	    }
	    else {
	      redirect(base_url().'account/login');
	    }
	}

	public function header()
	{
		$this->load->view('header.php');
	}

	public function footer()
	{
		$this->load->view('footer.php');
	}

	public function index($offset = 1)
	{
    	$this->header();
		$this->is_logged_in();
		$config['per_page'] = 10;
		$limit = ($offset-1)*$config['per_page'];
		$user = $this->session->userdata('user_id');
		$listdate_db = $this->Statistics_M->old_date($user,'','','',$config['per_page'],$limit);
		$listdate = array();
		foreach ($listdate_db as $key) {
			$day = substr( $key['lm07_date_order'],  0, 8); 
			if(!in_array($day, $listdate)){
				array_push($listdate, $day);
			}
		}
		$data = array();
		$i = 0;
		foreach ($listdate as $key ) {
			$list_order = $this->Statistics_M->get_order_bydate($user,$key,'');
			$rowspan = $list_order->num_rows();
			$row_data = $list_order->result_array();
			$data['list_data'][$i]['rowspan'] = $rowspan;
			$data['list_data'][$i]['date'] = $key;
			$data['list_data'][$i]['row_data'] = $row_data;
			++$i;
		}
		
		$total_order_search  = $this->Statistics_M->all_date($user,'','','');
        $config['total_rows'] = $total_order_search;
        $total_rows                 = CEIL($config['total_rows']/$config['per_page']);
        $config['base_url']    = base_url().'history/index';
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
		// print_r($listdate);
        $pagination                = $this->pagination->create_links();
        $data['pagination'] = $pagination;
        $data['total_rows'] = $total_order_search;
        $data['offset']     = $offset;

		$this->load->view('history/index.php',$data);
		$this->footer();
	}

	public function search($offset = 1){
		$this->is_logged_in();
		$user = $this->session->userdata('user_id');
		$post = $this->input->post();
		
		$fromdate = substr($post['fromdate'],  0, 4) . substr($post['fromdate'],  7, 2) . substr($post['fromdate'],  12, 2);
		$todate = substr($post['todate'],  0, 4) . substr($post['todate'],  7, 2) . substr($post['todate'],  12, 2);

		$config['per_page']    = 10;
		$limit = ($offset-1)*$config['per_page'];

		$listdate_db = $this->Statistics_M->old_date($user,$fromdate,$todate,$post['type_search'],$config['per_page'],$limit);
		$listdate = array();
		foreach ($listdate_db as $key) {
			$day = substr( $key['lm07_date_order'],  0, 8); 
			if(!in_array($day, $listdate)){
				array_push($listdate, $day);
			}
		}

		$data_html = array();
		$i = 0;
		foreach ($listdate as $key ) {
			$list_order = $this->Statistics_M->get_order_bydate($user,$key,$post['type_search']);
			$rowspan = $list_order->num_rows();
			$row_data = $list_order->result_array();
			$data_html[$i]['rowspan'] = $rowspan;
			$data_html[$i]['date'] = $key;
			$data_html[$i]['row_data'] = $row_data;
			++$i;
		}

		$total_order_search  = $this->Statistics_M->all_date($user,$fromdate,$todate,$post['type_search']);
        $config['total_rows'] = $total_order_search;
        $total_rows                 = CEIL($config['total_rows']/$config['per_page']);
        $config['base_url']    = base_url().'history/search';
        $config['use_page_numbers'] = TRUE;
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
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
		// print_r($listdate);
        $pagination                = $this->pagination->create_links();
        $data['pagination'] = $pagination;
        $data['total_rows'] = $total_order_search;
        $data['offset']     = $offset;

        $html = "";
        foreach ($data_html as $key ) {
        	if($key['row_data'][0]['lm07_pay_status'] == 0)
				$status = '<span style="color: gray">決済待ち</span>';
			else
				$status = '<span style="color: green">決済済み</span>';
			$url = base_url('history/detail/'.$key['row_data'][0]['lm07_order_id']);
        	$html .= '<tr>
				<td rowspan="'.$key['rowspan'].'>">
					'.substr($key['date'], 0,4).'年'.substr($key['date'], 4,2).'月'.substr($key['date'], 6,2).'日'.'
				</td>
				<td><a href="'.$url.'">'.$key['row_data'][0]['lm07_order_id'].'</a></td>
				<td>'.$key['row_data'][0]['lm07_total_price'].'円</td>
				<td>'.$key['row_data'][0]['lm13_method_name'].'</td>
				<td>'.$status.'</td>
			</tr>';
			if($key['rowspan'] > 1){
				for ($i=1; $i < $key['rowspan']; $i++) {
					if($key['row_data'][$i]['lm07_pay_status'] == 0)
						$status = '<span style="color: gray">決済待ち</span>';
					else
						$status = '<span style="color: green">決済済み</span>';
					$url = base_url('history/detail/'.$key['row_data'][$i]['lm07_order_id']);
					$html .= '<tr>
						</td>
						<td><a href="'.$url.'">'.$key['row_data'][$i]['lm07_order_id'].'</a></td>
						<td>'.$key['row_data'][$i]['lm07_total_price'].'円</td>
						<td>'.$key['row_data'][$i]['lm13_method_name'].'</td>
						<td>'.$status.'</td>
					</tr>';
				}
			}
        }
        $data['html_data'] = $html;

        echo json_encode($data);
	}

	public function detail($order_id)
	{
		$this->data['data1'] = $this->Statistics_M->getHistory_detail($order_id);
		$this->data['data2'] = $this->Statistics_M->getHistory_product($order_id);

   	$this->header();
		$this->is_logged_in();
		$this->load->view('history/detail.php',$this->data);
		$this->footer();
	}
}


