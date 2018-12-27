<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_M');
	}

	public function index($offset = 1) {
		$db_list_category = $this->Category_M->getListCategoryAll();

		$config['base_url']    = base_url().'admin/category/index';
		$config['uri_segment'] = 4;
		$config['per_page']    = 10;
		$start                 = ($offset-1)*$config['per_page'];
		$lenght                = $config['per_page'];
		$list_category         = array_slice($db_list_category, $start, $lenght);

		$config['total_rows'] = count($db_list_category);
        $total_rows = CEIL($config['total_rows']/$config['per_page']);
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
        $this->_data['offset']     = $offset;

		$this->header();

		$this->_sidebar['page_name'] = 'category';
		$this->load->view('admin/sidebar.php', $this->_sidebar);

		$this->_data['list_category'] = $list_category;
		$this->load->view('admin/category/index', $this->_data);
        $this->footer();
	}

	public function add() {
		$list_cate_parent_max = $this->Category_M->getListCategoryParentMax();

		if ($this->input->post('btnAddCategory')) {
			$value_selectBox     = $this->input->post("cmt03_parents");
			$arr_value_selectBox = explode('_', $value_selectBox);

			$cmt03_level         = $arr_value_selectBox[1] + 1;
			$cmt03_parents       = $arr_value_selectBox[0];

			$cmt03_name          = $this->input->post("cmt03_name");
			$cmt03_active        = $this->input->post("cmt03_active");
			$cmt03_delete        = '0';
			$cmt03_created_at    = $cmt03_updated_at = dateInsert();

			$arr_cmt03_category = [
				"cmt03_level"      => $cmt03_level,
				"cmt03_parents"    => $cmt03_parents,
				"cmt03_name"       => $cmt03_name,
				"cmt03_active"     => $cmt03_active,
				"cmt03_delete"     => $cmt03_delete,
				"cmt03_created_at" => $cmt03_created_at,
				"cmt03_updated_at" => $cmt03_updated_at
            ];
            
            if ($this->Category_M->insertCategory($arr_cmt03_category) == true) {
            	$this->session->set_flashdata('category_success', ' Đã Thêm Loại Mới ! ');
            }
            redirect('admin/category/index');
		}

		$this->header();
		$this->_sidebar['page_name'] = 'category_add';
		$this->load->view('admin/sidebar.php', $this->_sidebar);

		$this->_data['list_cate_parent_max'] = $list_cate_parent_max;
		$this->load->view('admin/category/add', $this->_data);
        $this->footer();
	}

	public function edit($id_cate) {
		$getCategoryByID = $this->Category_M->getCategoryByID($id_cate);
		$list_cate_parent_max = $this->Category_M->getListCategoryParentMax();

		if ($this->input->post('btnEditCategory')) {
			$value_selectBox     = $this->input->post("cmt03_parents");
			$arr_value_selectBox = explode('_', $value_selectBox);

			$cmt03_level         = $arr_value_selectBox[1] + 1;
			$cmt03_parents       = $arr_value_selectBox[0];

			$cmt03_name          = $this->input->post("cmt03_name");
			$cmt03_active        = $this->input->post("cmt03_active");
			$cmt03_delete        = '0';
			$cmt03_created_at    = $cmt03_updated_at = dateInsert();

			$arr_cmt03_category = [
				"cmt03_level"      => $cmt03_level,
				"cmt03_parents"    => $cmt03_parents,
				"cmt03_name"       => $cmt03_name,
				"cmt03_active"     => $cmt03_active,
				"cmt03_delete"     => $cmt03_delete,
				"cmt03_updated_at" => $cmt03_updated_at
            ];
            
            if ($this->Category_M->updateCategory($arr_cmt03_category, $id_cate) == true) {
            	$this->session->set_flashdata('category_success', ' Đã Sửa Thông Tin Loại ! ');
            }
            redirect('admin/category/index');
		}

		$this->header();

		$this->_sidebar['page_name'] = 'category_edit';
		$this->load->view('admin/sidebar.php', $this->_sidebar);

		$this->_data['getCategoryByID'] = $getCategoryByID;
		$this->_data['list_cate_parent_max'] = $list_cate_parent_max;
		$this->load->view('admin/category/edit', $this->_data);
        $this->footer();
	}

	public function delete($id_cate) {
		$data = array(
        	'cmt03_delete'  => 1
        );
        $this->Category_M->updateCategory($data, $id_cate);
        redirect('admin/category');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */