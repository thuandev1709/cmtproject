<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_M');
		$this->load->model('Event_M');
        $this->load->model('Product_M');
		// $this->load->library('_mcrypt_encrypt');
		// $this->header();
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

	public function index($offset = 1)
	{
        $config['base_url']    = base_url().'admin/event/index';
        $config['uri_segment'] = 4;
        $config['per_page']    = 10;
        $list_event = $this->Event_M->getListEvent();
        $list_all_event = [];
         foreach ($list_event as $event) {
            $date=$event['lm10_date_start'];
            $date_start_format = date('Y年m月d日', strtotime($date));
                $list_all_event[] = [
                    'id_event'   => $event['lm10_event_id'],
                    'id_event_input'   => $event['lm10_event_id_input'],
                    'date_start' =>  $date_start_format,
                    'name_event' => $event['lm10_event_name'],
                    
                ];
            }
        $count=count($list_all_event);
        $config['total_rows']       = $count ;
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
        
        $off = ($offset - 1) * $config['per_page'];
        $list_all = array_slice($list_all_event,$off, $config['per_page']);

        $this->data['count']          = $count;
        $this->data['pagination']     = $pagination;
        $this->data['total_rows']     = $total_rows;
        $this->data['offset']         = $offset;
        
        $this->data['list_all_event'] = $list_all;
		$this->header();
		$this->load->view('admin/event/index.php',$this->data);
	}

    public function search($offset = 1)
    {
        $per_page = 10;
        $config['base_url'] ="#";
        $config['uri_segment'] = 4;
        $config['per_page'] = $per_page;
        $id_event = $this->input->post('id_event');
        $name_event = $this->input->post('name_event');
        $type = $this->input->post('type');
        $fromdate = $this->input->post('fromdate');
        $todate = $this->input->post('todate');
        $date_create = substr($fromdate,  0, 4) . substr($fromdate,  7, 2) . substr($fromdate,  12, 2);
        $date_end = substr($todate,  0, 4) . substr($todate,  7, 2) . substr($todate,  12, 2);
         $list_Search_Event=$this->Event_M->getListEvent_Search($id_event,$name_event,$type,$fromdate,$todate,$date_create,$date_end);
         $list_all_search = [];
         
            foreach ($list_Search_Event as $event_search) {
                $date_search=$event_search['lm10_date_start'];
                $date_search_format = date('Y年m月d日', strtotime($date_search));
                $list_all_search[] = [
                                    'id_event'   => $event_search['lm10_event_id'],
                                    'id_event_input'   => $event_search['lm10_event_id_input'],
                                    'name_event' => $event_search['lm10_event_name'],
                                    'date_start' => $date_search_format,
                                ];
                                 
            
            }
            // print_r($list_all_search);die();
        $count_search=count($list_all_search);
        $config['total_rows'] = $count_search ;
        $total_rows = CEIL($config['total_rows']/$config['per_page']);
        $config['use_page_numbers'] = TRUE;
        $config['num_tag_open'] = '<li class="pagclick">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link']  = false;
        $config['first_link'] = false;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        $off = ($offset - 1) * $per_page;
        $list_all = array_slice($list_all_search,$off, $per_page);

        $html = '<tr>
              <th>イベントID</th>
                <th>イベント名</th>
                <th>開催日</th>
                <th>操作</th>
            </tr>';
            if(count($list_all) > 0){
                foreach ($list_all as $value1){
                    $html.='
                     <td style="vertical-align: middle;text-align: center;">'.$value1['id_event_input'].'</td>
                     <td style="vertical-align: middle;text-align: center;">'.$value1['name_event'].'</td>
                     <td style="vertical-align: middle;text-align: center;">'.$value1['date_start'].'</td>
                     <td style="vertical-align: middle;text-align: center;"><a href="'.base_url().'admin/event/edit'.'/'.$value1['id_event'].'"><button class="btn btn_edit" data-url="export_order.php" type="button">編集する</button></a></td></tr>';

                
                }
            
            }
            else{
                $html .= '<tr><td style="vertical-align: middle;text-align: center;color: red" colspan="5" >結果はありません。</td></tr>';
            }
        $b='<div>'.$count_search.'件です。</div>';  
        $myObj['data_html'] = $html;
        $myObj['data_count'] = $b;
        $myObj['data_pagination'] = $pagination;
        $myObj['data_page'] = $offset;
        $myObj['data_total_rows'] = $total_rows;
        $myObj['data_this_page'] = $offset;
        $myJSON = json_encode($myObj);
        echo $myJSON;

    }

	public function add()
	{
		$date_Default = $this->Product_M->getValueDefault(4);
        if($this->input->post('btn_insert')){
            $id_event=$this->input->post('id_event');
            $name_event=$this->input->post('name_event');
            $password=$this->input->post('password');
            $password_MD5=md5(md5($password));
            $date_start=$this->input->post('date_start');
            $date_start_format = substr($date_start,  0, 4) . substr($date_start,  7, 2) . substr($date_start,  12, 2);
            $date_predetermine=$this->input->post('date_predetermine');
            $date_predetermine_format = substr($date_predetermine,  0, 4) . substr($date_predetermine,  7, 2) . substr($date_predetermine,  12, 2);
            $date_end=$this->input->post('date_end');
            $date_end_format = substr($date_end,  0, 4) . substr($date_end,  7, 2) . substr($date_end,  12, 2);
            $type = $this->input->post('type');

            $data = array(
             
                'lm10_event_id_input'     => $id_event,
                'lm10_event_name'         => $name_event,
                'lm10_event_password'     => $password,
                'lm10_date_start'         => $date_start_format,
                'lm10_date_predetermine'  => $date_predetermine_format,
                'lm10_date_end'           => $date_end_format,
                'lm10_display'            => $type,
                'lm10_created_at'         => dateInsert(),
                'lm10_updated_at'         => dateInsert(),
    
                         );
            
                $this->Event_M->insert_event($data);
                $this->session->set_flashdata('category_success', '正常に作成されました。');
                redirect('admin/event');
        
        }
        $this->data['Default'] = $date_Default;
        $this->header();
        $this->load->view('admin/event/add.php',$this->data);
	}

	public function check_event()
	{
		$data=$this->input->post('id_event');
        $check_IdEvent=$this->Event_M->check_Event($data);
        if ($check_IdEvent!='') {
        	echo "イベント $data 存在する。 もう一度お試しください。"; 
        }
	}

	public function edit($id=""){
		$data['id'] = $id;
        if($id !="" ){
           if( $this->Event_M->getEventByID($id) == null){
           		redirect('admin/event');
            }else{
                $date_Default = $this->Product_M->getValueDefault(4);
                $event = $this->Event_M->getEventByID($id);
                $list_product = $this->Event_M->getListProduct_byEvent($id);
                $data['list_product'] = $list_product;
                $data['event']=$event;
                if ($this->input->post('btn_update')) {
                    $id_event=$this->input->post('id_event');
                    $id_event_history=$this->input->post('id_event_history');
                    $name_event=$this->input->post('name_event');
                    $password=$this->input->post('password');
                    $password_MD5=md5(md5($password));
                    if ($password=='') {
                        $password_MD5=$this->input->post('pass');
                    }
                
                    $date_start=$this->input->post('date_start');
                    $date_start_format = substr($date_start,  0, 4) . substr($date_start,  7, 2) . substr($date_start,  12, 2);
                    $date_predetermine=$this->input->post('date_predetermine');
                    $date_predetermine_format = substr($date_predetermine,  0, 4) . substr($date_predetermine,  7, 2) . substr($date_predetermine,  12, 2);
                    $date_end=$this->input->post('date_end');
                    $date_end_format = substr($date_end,  0, 4) . substr($date_end,  7, 2) . substr($date_end,  12, 2);
                    $type = $this->input->post('type');
        
                    $data = array(
             
                        'lm10_event_id_input'     => $id_event,
                        'lm10_event_name'         => $name_event,
                        'lm10_event_password'     => $password,
                        'lm10_date_start'         => $date_start_format,
                        'lm10_date_predetermine'  => $date_predetermine_format,
                        'lm10_date_end'           => $date_end_format,
                        'lm10_display'            => $type,
                        'lm10_updated_at'         => dateInsert(),
        
                             );

                    $this->Event_M->update_event($data,$id_event_history);
                     $this->session->set_flashdata('category_success', '更新成功。');
                    redirect('admin/event');
                }
            }
            $data['Default'] = $date_Default;
            $this->header();
            $this->load->view('admin/event/edit.php',$data);
  		}else{
  			redirect('admin/event');
  		}
	}

    public function delete_event(){
        $id_event = $this->input->post('id_event_history');
        $this->Event_M->delete_event($id_event);
        $this->session->set_flashdata('category_success', '削除されました。');
        redirect('admin/event');
    }

     public function tax($offset = 1,$id=null){
        $config['base_url']    = base_url().'admin/event/tax';
        $config['uri_segment'] = 4;
        $config['per_page']    = 10;
        $date_now = date('YmdHis');
        $this->data['id'] = $id;
        $Tax = $this->Event_M->getTaxByID($id);
        $id_max = $this->Event_M->max_idTax();
        $date_max = $this->Event_M->date_max($date_now);
        $list_tax = $this->Event_M->getListTax();
        $list_all_tax = [];
            foreach ($list_tax as $tax) {
                $date_start=$tax['lm14_date_start'];
                $date_start_format = date('Y年m月d日', strtotime($date_start));
                $date_end=$tax['lm14_date_end'];
                $date_end_format = date('Y年m月d日', strtotime($date_end));
                $list_all_tax[] = [
                                    'id_tax'   => $tax['lm14_tax_id'],
                                    'percent' => $tax['lm14_percent'],
                                    'date_start' => $date_start_format,
                                    'date_end' => $date_end_format,
                                ];
                                 
            
            }
        $count=count($list_all_tax);
        $config['total_rows']       = $count ;
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
        $off = ($offset - 1) * $config['per_page'];
        $list_all = array_slice($list_all_tax,$off, $config['per_page']);
        
        $this->data['count']          = $count;
        $this->data['Tax']          = $Tax;
        $this->data['pagination']     = $pagination;
        $this->data['total_rows']     = $total_rows;
        $this->data['offset']         = $offset;
        $this->data['list_tax'] = $list_all;
        $this->data['id_max'] = $id_max;
        $this->data['date_max'] = $date_max;
        $this->header();
        $this->load->view('admin/tax.php',$this->data);
    }

    public function add_tax()
    {
        $id_tax=$this->input->post('id_tax');
        $date_start=$this->input->post('fromdate');
        $time_now = date('His');
        $date_start_format = substr($date_start,  0, 4) . substr($date_start,  7, 2) . substr($date_start,  12, 2).$time_now;
        $date_end=$this->input->post('todate');
        if($date_end == ''){
            $date_end_format = date('YmdHis', strtotime('20990101103030'));
        } else {
            $date_end_format = substr($date_end,  0, 4) . substr($date_end,  7, 2) . substr($date_end,  12, 2).$time_now;
        }
        $percent=$this->input->post('percent');
        $data = array(
         
            'lm14_tax_id'           => $id_tax,
            'lm14_date_start'         => $date_start_format,
            'lm14_date_end'     => $date_end_format,
            'lm14_percent'         => $percent,
            'lm14_created_at'         => dateInsert(),
            'lm14_updated_at'         => dateInsert(),

                     );
        
            $this->Event_M->insert_tax($data);
            redirect('admin/event/tax');
    }

    public function edit_tax()
    {
        $id_tax=$this->input->post('id_tax_update');
        $date_start=$this->input->post('fromdate');
        $time_now = date('His');
        $date_start_format = substr($date_start,  0, 4) . substr($date_start,  7, 2) . substr($date_start,  12, 2).$time_now;
        $date_end=$this->input->post('todate');
        if($date_end == ''){
            $date_end_format = date('YmdHis', strtotime('20990101103030'));
        } else {
            $date_end_format = substr($date_end,  0, 4) . substr($date_end,  7, 2) . substr($date_end,  12, 2).$time_now;
        }
        $percent=$this->input->post('percent');
        $data = array(
            'lm14_tax_id'           => $id_tax,
            'lm14_date_start'         => $date_start_format,
            'lm14_date_end'     => $date_end_format,
            'lm14_percent'         => $percent,
            'lm14_updated_at'         => dateInsert(),

                     );
        
            $this->Event_M->update_Tax($data,$id_tax);
            redirect('admin/event/tax');
    }

	
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */