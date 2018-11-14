<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_M');
		$this->load->model('Statistics_M');
		// $this->header();
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

	public function index()
	{
		$this->header();
		$data['list_event'] = $this->Statistics_M->getAll_Event('');
		$data['list_order'] = $this->Statistics_M->getPayment('', '', '', '', '');
		$data['list_payment'] = $this->Statistics_M->getAll_payment();

		$this->load->view('admin/statistics/index.php',$data);
		// redirect(base_url().'account/login','location');
	}

	public function detail()
	{
		$this->header();
		$post = $this->input->post();
		if($post == NULL || !isset($post)){
			redirect(base_url().'admin/statistics/','location');
		}
		$fromdate = $todate = '';
		if($post['date_star'] != '')
			$fromdate = substr($post['date_star'],  0, 4) . substr($post['date_star'],  7, 2) . substr($post['date_star'],  12, 2);
		if($post['date_end'] != '')
			$todate = substr($post['date_end'],  0, 4) . substr($post['date_end'],  7, 2) . substr($post['date_end'],  12, 2);
		// echo $fromdate.' - '.$todate;

		$list_order = $this->Statistics_M->getPayment($post['event_key'], $fromdate, $todate, '', '');

		$listdate = array();
		foreach ($list_order as $key) {
			$day = substr( $key['lm07_date_order'],  0, 8);
			if(!in_array($day, $listdate)){
				array_push($listdate, $day);
			}
		}
		$listdata = array();
		$i = 0;
		foreach ($listdate as $key) {
			$rowpan = 0;
			$data = array();
			foreach ($list_order as $key2) {
				$day = substr( $key2['lm07_date_order'],  0, 8);
				if($day == $key){
					++$rowpan;
					array_push($data, $key2);
				}
			}
			$listdata[$i]['rowpan'] = $rowpan;
			$listdata[$i]['day'] = $key;
			$listdata[$i]['daydata'] = $data;
			++$i;
		}
		// echo '<pre>';
		// print_r($post);
		// echo '</pre>';
		$this->_data['listdata'] = $listdata;
		$this->_data['datapost'] = $post;
		$this->_data['dataevent'] = '';
		if($post['event_key'] != '')
		 $this->_data['dataevent'] =  $this->Statistics_M->getAll_Event($post['event_key']);
		$this->load->view('admin/statistics/detail.php',$this->_data);

		// redirect(base_url().'account/login','location');
	}

	public function dvd()
	{

		$id = '';
		$warn = '';
		$data['list_event'] = $this->Statistics_M->getAll_Event($id);

		if($this->input->post('btn_search')&&$this->input->post('event')!=''){

			$search_idEvent = $this->input->post('event');

			$event_byid = $this->Statistics_M->getAll_Event($search_idEvent);

			$event_byid = $event_byid[0];

			$data['list_event'] = $this->Statistics_M->getAll_Event_diff($search_idEvent);


			$limit ='';
			$start='';
			$list_event = $this->Statistics_M->all_event($limit, $start,$search_idEvent);
			 
			$data['is'] = count($list_event);
				if(count($list_event)>0){
			foreach ($list_event as $LE) {
			 	$aData = [
			 		'id_event' => $LE['lm10_event_id']
			 	];

			$product_event = $this->Statistics_M->product_event($aData,$warn);

			$L_product[] = [
				'id_event' => $LE['lm10_event_id'],
				'id_event_input' => $LE['lm10_event_id_input'],
				'name_event' => $LE['lm10_event_name'],
				'active'	=> $LE['lm04_active_status'],
				'type'	=> $LE['lm04_pro_name'],
				'total_event' => $LE['total'],
				'list_pro'   => $product_event

			];
			 }
		 $data['L_product']     = $L_product;
		 }

		 $data['id_event'] = $event_byid['lm10_event_id'];
		 $data['id_event_input'] = $event_byid['lm10_event_id_input'];
		 $data['name_event'] = $event_byid['lm10_event_name'];

		}else{
		$data['is'] = 1;
		$config['base_url'] = base_url('admin/statistics/dvd');
        //$config['uri_segment'] = 2;
        $config['per_page'] =  10;
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="'.$config['base_url'].'?per_page=0">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

         $config['last_link']        = false;
         $config['first_link']       = false;

        $data['page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

        $search_idEvent = '';

        $list_event = $this->Statistics_M->all_event($config["per_page"], $data['page'],$search_idEvent);


        	foreach ($list_event as $LE) {
		 	$aData = [
		 		'id_event' => $LE['lm10_event_id']
		 	];


		$product_event = $this->Statistics_M->product_event($aData,$warn);

		$L_product[] = [
			'id_event' => $LE['lm10_event_id'],
			'id_event_input' => $LE['lm10_event_id_input'],
			'name_event' => $LE['lm10_event_name'],
			'active'	=> $LE['lm04_active_status'],
			'type'	=> $LE['lm04_pro_name'],
			'total_event' => $LE['total'],
			'list_pro'   => $product_event

			];

		 }


	$config['total_rows'] = $this->Statistics_M->count_all_event_dvd();

    $total_rows  = CEIL($config['total_rows']/$config['per_page']);

    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();
    $data['total_rows'] = $total_rows;
    $data['offset']     = $data['page']/$config['per_page'] + 1;


    $data['L_product']     = $L_product;

  }

    



		$this->header();
		$this->load->view('admin/statistics/detaildvd.php',$data);
		// redirect(base_url().'account/login','location');
	}

		public function getEvent_byId()
	{

		$id_event = $this->input->post('event') ? $this->input->post('event'): '';
		$data['name_event'] = $this->Statistics_M->getAll_Event($id_event);


		$this->load->view('admin/statistics/getEvent_byId.php',$data);

	}

	public function inventory()
	{
		//add quantity

		//get warn vaule
		$min_value = $this->Statistics_M->get_value_warn();
		foreach ($min_value as $value) {
			 $warn = $value['lm11_value_default'];
		}

		$data['warn']=$warn[0];


		$config['base_url'] = base_url('admin/statistics/inventory');
        //$config['uri_segment'] = 2;
        $config['per_page'] =  10;
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="'.$config['base_url'].'?per_page=0">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

         $config['last_link']        = false;
         $config['first_link']       = false;

        $data['page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;


        $list_event = $this->Statistics_M->all_event_have_warn($config["per_page"], $data['page'],$warn);


        	foreach ($list_event as $LE) {
		 	$aData = [
		 		'id_event' => $LE['lm10_event_id']
		 	];


		$product_event = $this->Statistics_M->product_event($aData,$warn);

		$L_product[] = [
			'id_event' => $LE['lm10_event_id'],
			'name_event' => $LE['lm10_event_name'],
			'id_event_input' => $LE['lm10_event_id_input'],
			'total_event' => $LE['total'],
			'list_pro'   => $product_event

			];
			// echo "<pre>";
			// var_dump($L_product);die;
		 }


	$config['total_rows'] = $this->Statistics_M->count_all_event($warn);

    $total_rows  = CEIL($config['total_rows']/$config['per_page']);

    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();
    $data['total_rows'] = $total_rows;
    $data['offset']     = CEIL($data['page']/$config['per_page'] + 1);


	if(isset($L_product)){
		$data['L_product']     = $L_product;

	}else{
		$data['L_product']     = "";
	}


		$this->header();
		$this->load->view('admin/statistics/inventory.php',$data);
		// redirect(base_url().'account/login','location');
	}

	public function addStockInventory()
	{
		$plus_quantity = $this->input->post('add_quantity')?$this->input->post('add_quantity'):'0';
		$id_pro = $this->input->post('id_product')?$this->input->post('id_product'):'0';
		$current_qua = $this->input->post('current_qua')?$this->input->post('current_qua'):'0';
		 $total_quantity = $plus_quantity + $current_qua;
		 $update_pro = array(
             'lm04_pro_quantity' => $total_quantity
          );

		 if($this->Statistics_M->update_quantity_product($id_pro,$update_pro)){
			 echo 'ok';
		 }

	}

	public function addStockDVD()
	{
		$plus_quantity = $this->input->post('add_quantity')?$this->input->post('add_quantity'):'0';
		$id_pro = $this->input->post('id_product')?$this->input->post('id_product'):'0';
		$current_qua = $this->input->post('current_qua')?$this->input->post('current_qua'):'0';
		 $total_quantity = $plus_quantity + $current_qua;
		 $update_pro = array(
						 'lm04_pro_quantity' => $total_quantity
					);
		 if($this->Statistics_M->update_quantity_product($id_pro,$update_pro)){
			 echo 'ok';
		 }

	}

	public function search_statistics()
	{
		$post = $this->input->post();
		// print_r($post);
		$fromdate = substr($post['fromdate'],  0, 4) . substr($post['fromdate'],  7, 2) . substr($post['fromdate'],  12, 2);
		$todate = substr($post['todate'],  0, 4) . substr($post['todate'],  7, 2) . substr($post['todate'],  12, 2);
		// echo $fromdate.' - '.$todate;
		$list_payment = $this->Statistics_M->getAll_payment();
		$list_order = $this->Statistics_M->getPayment($post['id_event'], $fromdate, $todate, '', '');

		// print_r($list_order);
		
		foreach ($list_payment as $key_payment) {
            $id = $key_payment['lm13_method_id'];
            $data['total_payment'.$id] = $data['total_amount'.$id] = $data['payment'.$id] = $data['amount'.$id] = $data['amount_payed'.$id] = 0;
            foreach ($list_order as $key_order) {
              if($key_order['lm07_method_id'] == $id){
                ++$data['total_payment'.$id];
                $data['total_amount'.$id] = $data['total_amount'.$id] + $key_order['lm07_total_price'];
                if($key_order['lm07_pay_status'] == '1'){
                  $data['amount_payed'.$id] = $data['amount_payed'.$id] + $key_order['lm07_total_price'];
                }else{
                  ++$data['payment'.$id];
                  $data['amount'.$id] = $data['amount'.$id] + $key_order['lm07_total_price'];
                }
              }
            }
        }

      	$all_total_payment = $all_total_amount = $all_payment = $all_amount = $all_amount_payed = 0;
      	$html = "";
        foreach ($list_payment as $key) {
          $id = $key['lm13_method_id'];
          $all_total_payment = $all_total_payment + $data['total_payment'.$id];
          $all_total_amount = $all_total_amount + $data['total_amount'.$id];
          $all_payment = $all_payment + $data['payment'.$id];
          $all_amount = $all_amount + $data['amount'.$id];
          $all_amount_payed = $all_amount_payed + $data['amount_payed'.$id];
					$disabled = 'disabled';
          $html .= "<tr>
            <td>".$key['lm13_method_name']."</td>
            <td>".$data['total_payment'.$id]."</td>
            <td>".$data['total_amount'.$id]."円</td>
            <td>".$data['payment'.$id]."</td>
            <td>".$data['amount'.$id]."円</td>
            <td>".$data['amount_payed'.$id]."円</td>
          </tr>";
        }
        $html .= "<tr>
    		<td>合計</td>
            <td>".$all_total_payment."</td>
            <td>".$all_total_amount."円</td>
            <td>".$all_payment."</td>
            <td>".$all_amount."円</td>
            <td>".$all_amount_payed."円</td>

          </tr>
					<input type='hidden' id='get_total_payment' name='get_total_payment' value='".$all_total_payment."' />";

      	echo $html;
	}
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */
