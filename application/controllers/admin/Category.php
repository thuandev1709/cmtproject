<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_M');
		$this->load->model('Statistics_M');
		// $this->header();
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

	public function index($offset = 1,$id=null)
	{
		$config['base_url']    = base_url().'admin/category/index';
        $config['uri_segment'] = 4;
        $config['per_page']    = 10;
		$list_category = $this->Category_M->getList_Category();
		$Category_ById = $this->Category_M->getCategory_ById($id);
        $list_all_category = [];
            foreach ($list_category as $category) {
                $list_all_category[] = [
                                    'id_event'   => $category['lm10_event_id'],
                                    'id_event_input'   => $category['lm10_event_id_input'],
                                    'id_category' => $category['lm03_cate_id'],
                                    'name_category' => $category['lm03_cate_name'],
                                ];
                                 
            
            }

        $count=count($list_all_category);
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
        $list_all = array_slice($list_all_category,$off, $config['per_page']);
        $this->data['id'] = $id;
        $this->data['Category_ById']  = $Category_ById;
        $this->data['count']          = $count;
        $this->data['pagination']     = $pagination;
        $this->data['total_rows']     = $total_rows;
        $this->data['offset']         = $offset;
        $this->data['list_category'] = $list_all;
        $this->data['id_max'] = $this->Category_M->max_idTax();
		$this->data['list_event'] = $this->Statistics_M->getAll_Event('');
		$this->header();
		$this->load->view('admin/product/category.php',$this->data);
		// redirect(base_url().'account/login','location');
	}

	public function add_category()
    {
        $id_event=$this->input->post('event_key');
        $id_category=$this->input->post('id_category');
        $name_category=$this->input->post('name_category');
        $data = array(
         
            'lm03_cate_id'       => $id_category,
            'lm03_event_id'      => $id_event,
            'lm03_cate_name'     => $name_category,
            'lm03_active_status' => 1,
            'lm03_display'       => '1',
            'lm03_sort'          => '',
            'lm03_created_at'    => dateInsert(),
            'lm03_updated_at'    => dateInsert(),

                     );

        
            $this->Category_M->insert_category($data);
            redirect('admin/category/');
    }

    public function edit_category()
    {	
    	$id_category=$this->input->post('id_category_update');
        $id_event=$this->input->post('event_key');
		$name_category=$this->input->post('name_category');
        $data = array(
        	'lm03_cate_id'       => $id_category,
            'lm03_event_id'      => $id_event,
            'lm03_cate_name'     => $name_category,
            'lm03_updated_at'    => dateInsert(),

                     );
            $this->Category_M->update_Category($data,$id_category);
            redirect('admin/category/');
    }

	// public function detail()
	// {
	// 	$this->header();
	// 	$this->load->view('admin/order/detail.php');
	// 	// redirect(base_url().'account/login','location');
	// }

	
	
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */