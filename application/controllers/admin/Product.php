<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_M');
		$this->load->model('Category_M');
		$this->load->model('Product_M');
		$this->load->model('Event_M');
		$this->load->model('');
	}

	public function header()
	{
		$this->load->view('admin/header.php');
	}

	public function index($offset = 1)
	{	
		$this->session->all_userdata();

		$list_event = $this->Event_M->getlistEvent();
		foreach ($list_event as $ev) {
			$lm10_event_id       = $ev['lm10_event_id'];
			$lm10_event_id_input = $ev['lm10_event_id_input'];
			$lm10_event_name     = $ev['lm10_event_name'];
			$list_pro_with_event = $this->Product_M->getListProductFollowEvent($lm10_event_id);

			$list_product[] = [
				'lm10_event_id'       => $lm10_event_id,
				'lm10_event_id_input' => $lm10_event_id_input,
				'lm10_event_name'     => $lm10_event_name,
				'list_product_ev'     => $list_pro_with_event
			];
		}

		$config['base_url']    = base_url().'admin/product/index';
		$config['uri_segment'] = 4;
		$config['per_page']    = 10;
		$start                 = ($offset-1)*$config['per_page'];
		$lenght                = $config['per_page'];
		$list_product_pagi     = array_slice($list_product, $start, $lenght);

		$total_product = $this->Product_M->getTotalProduct();

		$config['total_rows'] = count($list_event);
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
		
		$this->_data['list_product_pagi'] = $list_product_pagi;
		$this->_data['total_product'] = $total_product;
		$this->header();
		$this->load->view('admin/product/index', $this->_data);
	}

	public function searchProduct($offset = 1) {
		$lm10_event_id   = $this->input->post("lm10_event_id");
		$lm10_event_name = $this->input->post("lm10_event_name");
		$lm10_date_start = str_replace('/','',$this->input->post("lm10_date_start"));
		$lm10_date_end   = str_replace('/','',$this->input->post("lm10_date_end"));
		$lm04_pro_name   = $this->input->post("lm04_pro_name");
		$lm04_pro_type   = $this->input->post("lm04_pro_type");

		$list_event = $this->Event_M->getSearchlistEvent($lm10_event_id, $lm10_event_name, $lm10_date_start, $lm10_date_end);
		$list_product = [];

		$totalListSearchPro = 0;
		foreach ($list_event as $ev) {
			$lm10_event_id       = $ev['lm10_event_id'];
			$lm10_event_id_input = $ev['lm10_event_id_input'];
			$lm10_event_name     = $ev['lm10_event_name'];
			$list_pro_with_event = $this->Product_M->getListProductSearch($lm10_event_id, $lm04_pro_name, $lm04_pro_type);

			foreach ($list_pro_with_event as $pro) {
				$totalListSearchPro += 1;
			}

			$list_product[] = [
				'lm10_event_id'       => $lm10_event_id,
				'lm10_event_id_input' => $lm10_event_id_input,
				'lm10_event_name'     => $lm10_event_name,
				'list_product_ev'     => $list_pro_with_event
			];
		}

		$config['base_url']    = "#";
		$config['uri_segment'] = 4;
		$config['per_page']    = 10;
		$total_rows = count($list_event);
		$config['total_rows'] = $total_rows;
        $total_rows = CEIL($config['total_rows']/$config['per_page']);
        $config['use_page_numbers'] = TRUE;
        $config['num_tag_open']     = '<li class="pagclick">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="prev">';
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

        $start                 = ($offset-1)*$config['per_page'];
		$lenght                = $config['per_page'];
		$list_search_product   = array_slice($list_product, $start, $lenght);

        $html = '<thead>
	              <tr>
	                <th style="width: 25%">イベントID</th>
	                <th style="width: 25%">イベント名</th>
	                <th style="width: 25%">商品ID/商品名/種類</th>
	                <th style="width: 25%" colspan="2">操作</th>
	              </tr>
	            </thead>';
	    $html .= '<tbody>';
	    if(!empty($list_search_product)) {
		    $rowspan = 0;
	        foreach ($list_search_product as $ev_pro) {
		        $product_of_event = count($ev_pro['list_product_ev']);
		        if ($product_of_event > 0) {
		          $rowspan = $product_of_event +1;
		        }else {
		          $rowspan = 0;
		        }

		        $html .='<tr>';
			        $html .= '<td ';
			        	if($rowspan > 0) { 
			        		$html .= 'rowspan='.$rowspan;
			        	}
			        	$html .= '>'.$ev_pro['lm10_event_id_input'];
			        $html .= '</td>';
			        $html .= '<td ';
			        	if($rowspan > 0) { 
			        		$html .= 'rowspan='.$rowspan;
			        	}
			        	$html .= '>'.$ev_pro['lm10_event_name'];
			        $html .= '</td>';
			        $html .= '<td style="padding: 0px;"></td>';
			        if(!empty($ev_pro['list_product_ev'])) {
			        	$html .= '<td style="padding: 0px;"></td>';
			        	$html .= '<td ';
				        	if($rowspan > 0) { 
				        		$html .= 'rowspan='.$rowspan;
				        	}
				        	$html .= ' style="text-align: center;"><input type="button" class="btn01 btn_add" onclick="location.href=\''.base_url().'admin/product/addFollowEvent/'.$ev_pro['lm10_event_id'].'\'" value="商品を追加する">';
				        $html .= '</td>';
			        }else {
			        	$html .= '<td colspan="3" style="text-align: center;">';
			        	$html .= '<input type="button" class="btn01 btn_add" onclick="location.href=\''.base_url().'admin/product/addFollowEvent/'.$ev_pro['lm10_event_id'].'\'" value="商品を追加する">';
			        	$html .= '</td>';
			        }
		        $html .='</tr>';
		        if(!empty($ev_pro['list_product_ev'])) {
		        	foreach ($ev_pro['list_product_ev'] as $pro) {
		        		if ($pro['lm04_pro_type'] == '0') {
	                        $lm04_pro_type_name = '写真';
	                    }else {
	                        $lm04_pro_type_name = '動画';
	                    }
		        		$html .='<tr>';
		        			$html .= '<td style="text-align: center;">'.$pro['lm04_pro_id'].'/'.$pro['lm04_pro_name'].'/'.$lm04_pro_type_name.'</td>';
		        			$html .= '<td style="text-align: center; width: 13%">';
		        			$html .= '<input type="button" class="btn01 btn_edit" onclick="location.href=\''.base_url().'admin/product/edit/'.$pro['lm04_pro_id'].'_'.$pro['lm04_pro_type'].'\'" value="編集する">';
		        			$html .= '</td>';
		        		$html .='</tr>';
		        	}
		        }
	    	}
	    }else {
	    	$html .= '<tr><td colspan="5" style="color: red">結果はありません。</td></tr>';
	    }
	    $html .= '</tbody>';

	    $data_count='<div>'.$totalListSearchPro.'件です。</div>';
        $myObj['data_count'] = $data_count;
        $myObj['data_html'] = $html;
        $myObj['data_pagination'] = $pagination;
        $myObj['data_page'] = $offset;
        $myObj['data_total_rows'] = $total_rows;
        $myObj['data_this_page'] = $offset;
        $myJSON = json_encode($myObj);
        echo $myJSON;
	}

	public function add()
	{
		$list_event = $this->Event_M->getlistEvent();
		$list_category = $this->Category_M->getListCategory();

		//Get quantity default
		$quantityDefault = $this->Product_M->getValueDefault(5);
		$quantityDefault = $quantityDefault['lm11_value_default'];

		//Get price default
		$priceImageDefault = $this->Product_M->getValueDefault(1);
		$priceImageDefault = $priceImageDefault['lm11_value_default'];

		//Get Total Quantity DVD
		$lm04_pro_type = 1;
		$totalQuantityDVD = $this->Product_M->getTotalQuantityDVD($lm04_pro_type);

		if ($this->input->post('btnAddProduct')) {

			$lm04_pro_id       = $this->Product_M->totalProduct() + 1;
			$lm4_event_id      = $this->input->post("lm4_event_id");
			$lm04_pro_type     = $this->input->post("lm04_pro_type");
			$lm04_cate_id      = '0';
			$lm04_pro_name     = $this->input->post("lm04_pro_name");
			$lm04_pro_price    = $this->input->post("lm04_pro_price");
			$lm04_pro_quantity = $this->input->post("lm04_pro_quantity");
			if ($lm04_pro_type == '0') {
				$lm04_pro_quantity = '';
				$lm04_cate_id      = $this->input->post("lm04_cate_id");
			}
			$lm04_display      = $this->input->post("lm04_display");
			$lm04_created_at   = $lm04_updated_at = dateInsert();

			$arr_product = [
				"lm04_pro_id"               => $lm04_pro_id,
                "lm04_pro_type"             => $lm04_pro_type,
                "lm04_cate_id"              => $lm04_cate_id,
                "lm04_event_id"             => $lm4_event_id,
                "lm04_pro_name"             => $lm04_pro_name,
                "lm04_pro_content"          => '',
                "lm04_pro_keyword"          => '',
                "lm04_pro_price"            => $lm04_pro_price,
                "lm04_pro_discount"         => '',
                "lm04_pro_quantity"         => $lm04_pro_quantity,
                "lm04_active_status"        => '1',
                "lm04_display"              => $lm04_display,
                "lm04_sort"                 => '',
                "lm04_datetime_final_sales" => '',
                "lm04_created_at"           => $lm04_created_at,
                "lm04_updated_at"           => $lm04_updated_at
            ];
            // echo '<pre>';
            // var_dump($arr_product);die;

            if ($this->Product_M->insertProduct($arr_product) == true) {
            	$this->session->set_flashdata('product_success', ' 更新成功。');
            }

            if ($lm04_pro_type == '0') {
            	if(!empty($_SESSION['image_path'])) {
	                $exp_image_path = explode('.', $_SESSION['image_path']);
	                $id_product = $exp_image_path[0];
	                $this->Product_M->deleteImage($id_product);

	                $arr_add_image = [
	                    "lm05_pro_id"       => $id_product,
	                    "lm05_image_name"   => $_SESSION['image_path'],
	                    "lm05_image_rename" => $_SESSION['image_rename'],
	                    "lm05_image_path"   => '',
	                    "lm05_image_ext"    => $_SESSION['image_ext'],
	                    "lm05_created_at"   => $lm04_created_at,
	                    "lm05_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_image); die;

	                if (($this->Product_M->addImage($arr_add_image)) == true) {
	                	unset($_SESSION['image_path']);
	                    unset($_SESSION['image_rename']);
	                    unset($_SESSION['image_ext']);
	                }
            	}else {
            		$id_product = $this->Product_M->totalProduct();
	                $arr_add_image = [
	                    "lm05_pro_id"       => $id_product,
	                    "lm05_image_name"   => '',
	                    "lm05_image_rename" => '',
	                    "lm05_image_path"   => '',
	                    "lm05_image_ext"    => '',
	                    "lm05_created_at"   => $lm04_created_at,
	                    "lm05_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_image); die;

	                $this->Product_M->addImage($arr_add_image);
            	}
            }else {
            	if(!empty($_SESSION['video_path'])) {
	                $exp_video_path = explode('.', $_SESSION['video_path']);
	                $id_product = $exp_video_path[0];
	                $this->Product_M->deleteVideo($id_product);

	                $arr_add_movie = [
	                    "lm06_pro_id"       => $id_product,
	                    "lm06_movie_name"   => $_SESSION['video_path'],
	                    "lm06_movie_rename" => $_SESSION['video_rename'],
	                    "lm06_movie_path"   => '',
	                    "lm06_movie_ext"    => $_SESSION['video_ext'],
	                    "lm06_created_at"   => $lm04_created_at,
	                    "lm06_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_movie); die;

	                if (($this->Product_M->addVideo($arr_add_movie)) == true) {
	                	unset($_SESSION['video_path']);
	                    unset($_SESSION['video_rename']);
	                    unset($_SESSION['video_ext']);
	                }
            	}else {
            		$id_product = $this->Product_M->totalProduct();
	                $arr_add_movie = [
	                    "lm06_pro_id"       => $id_product,
	                    "lm06_movie_name"   => '',
	                    "lm06_movie_rename" => '',
	                    "lm06_movie_path"   => '',
	                    "lm06_movie_ext"    => '',
	                    "lm06_created_at"   => $lm04_created_at,
	                    "lm06_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_movie); die;

	                $this->Product_M->addVideo($arr_add_movie);
            	}
            }
            redirect('admin/product/index');
		}

		$this->_data['priceImageDefault']  = $priceImageDefault;
		$this->_data['totalQuantityDVD']   = $totalQuantityDVD;
		$this->_data['quantityDefault']   = $quantityDefault;
		$this->_data['list_event']   = $list_event;
		$this->_data['list_category']   = $list_category;
		$this->header();
		$this->load->view('admin/product/add', $this->_data);
	}

	public function getNameEvent() {
		$name_event = '';
		$event_id = $this->input->post('event_id');
		$name_event = $this->Event_M->getEventByID($event_id);
		echo $name_event['lm10_event_name'];
	}

	public function getCategoryWithEvent() {
		$name_event = '';
		$event_id = $this->input->post('event_id');
		$list_category_with_event_id = $this->Product_M->getCategoryByEventID($event_id);
		echo json_encode($list_category_with_event_id);
	}

	public function uploadImage($id_product = '') {
		if (!empty($_FILES['image_path']['name'])) {

            $type = explode('.', $_FILES['image_path']['name']);

            $id_pro_next = $this->Product_M->totalProduct()+1;
            $name_current = $id_pro_next.'.'.$type[1];
            $rename = md5($id_pro_next);

            if($id_product != '') {
            	$name_current = $id_product.'.'.$type[1];
            	$rename = md5($id_product);
            }
            
			$config['upload_path']   = 'upload/image/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name']     = $name_current;
			$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$data["path"] = $config['upload_path'].$config['file_name'];

			if (file_exists(FCPATH.$data["path"])) {
				unlink($data["path"]);
				if ($this->upload->do_upload('image_path')) {
				  	$uploadData = $this->upload->data();
				}
			}else {
				if ($this->upload->do_upload('image_path')) {
				  	$uploadData = $this->upload->data();
				}
			}
			$root_path = dirname(dirname(dirname(dirname(__FILE__))));
			//Size image
			$get_size_image = getimagesize($root_path."/upload/image/$name_current");

			$mime = $get_size_image['mime'];
			switch ($mime) {
	            case 'image/jpeg':
	                    $image_create_func = 'imagecreatefromjpeg';
	                    $image_save_func = 'imagejpeg';
	                    $new_image_ext = 'jpg';
	                    break;

	            case 'image/png':
	                    $image_create_func = 'imagecreatefrompng';
	                    $image_save_func = 'imagepng';
	                    $new_image_ext = 'png';
	                    break;

	            case 'image/gif':
	                    $image_create_func = 'imagecreatefromgif';
	                    $image_save_func = 'imagegif';
	                    $new_image_ext = 'gif';
	                    break;

	            default: 
	                    throw new Exception('ファイルはサポートされていません!');
	    	}

	    	$width_img = $get_size_image[0];
			$height_img = $get_size_image[1];
			$ratio_img = $width_img/$height_img;
			// echo $width_img.'x'.$height_img.' '.$ratio_img.' '.$mime.' ';
			
			if ($width_img > 1280 || $height_img > 1280) {
				if ($width_img > 1280 && $width_img >= $height_img) {
					$new_width_img = 1280;
					$new_height_img = $new_width_img / $ratio_img;
				}elseif ($height_img > 1280 && $height_img >= $width_img) {
					$new_height_img = 1280;
					$new_width_img = $new_height_img * $ratio_img;
				}
			}else {
				$new_width_img = $width_img;
				$new_height_img = $height_img;
			}
			// echo $new_width_img.'x'.$new_height_img.' ';

			$img = $image_create_func($root_path."/upload/image/$name_current");
			$tmp = imagecreatetruecolor($new_width_img, $new_height_img);
			imagecopyresampled($tmp, $img, 0, 0, 0, 0, $new_width_img, $new_height_img, $width_img, $height_img);

			if (file_exists($root_path."/upload/image/$name_current")) {
            	unlink($root_path."/upload/image/$name_current");
		    }
		    if ($image_save_func != 'imagepng') {
		    	$image_save_func($tmp, $root_path."/upload/image/$name_current", 85);
		    }else {
		    	$image_save_func($tmp, $root_path."/upload/image/$name_current", 8);
		    }

			rename($root_path."/upload/image/$name_current", $root_path."/upload/image/$rename");

            $_SESSION['image_rename'] = $rename;
            $_SESSION['image_ext']    = $type[1];
            $_SESSION['image_path']   = $config['file_name'];
        	echo $rename.'-'.$type[1];
		}
	}

	public function uploadVideo($id_product = '') {
		if (!empty($_FILES['video_path']['name'])) {
			$type = explode('.', $_FILES['video_path']['name']);

            $id_pro_next = $this->Product_M->totalProduct()+1;
            $name_current = $id_pro_next.'.'.$type[1];
            $rename = md5($id_pro_next);

            if($id_product != '') {
            	$name_current = $id_product.'.'.$type[1];
            	$rename = md5($id_product);
            }
            
			$config['upload_path']   = 'upload/movie/';
			$config['allowed_types'] = 'avi|flv|mwv|mp4|mov';
			$config['file_name']     = $name_current;
			$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$data["path"] = $config['upload_path'].$config['file_name'];

			if (file_exists(FCPATH.$data["path"])) {
				unlink($data["path"]);
				if ($this->upload->do_upload('video_path')) {
				  	$uploadData = $this->upload->data();
				}
			}else {
				if ($this->upload->do_upload('video_path')) {
				  	$uploadData = $this->upload->data();
				}
			}
			$root_path = dirname(dirname(dirname(dirname(__FILE__))));
			rename($root_path."/upload/movie/$name_current", $root_path."/upload/movie/$rename");

            $_SESSION['video_rename'] = $rename;
            $_SESSION['video_ext']    = $type[1];
            $_SESSION['video_path']   = $config['file_name'];
        	echo $rename.'-'.$type[1];
		}
	}

	public function addFollowEvent($event_id)
	{
		$value_event_id = $event_id;
		$event_name = $this->Event_M->getEventByID($event_id);
		$value_event_name = $event_name['lm10_event_name'];

		$list_event = $this->Event_M->getlistEvent();
		$list_category = $this->Category_M->getListCategory();

		//Get quantity default
		$quantityDefault = $this->Product_M->getValueDefault(5);
		$quantityDefault = $quantityDefault['lm11_value_default'];

		//Get price default
		$priceImageDefault = $this->Product_M->getValueDefault(1);
		$priceImageDefault = $priceImageDefault['lm11_value_default'];

		//Get Total Quantity DVD
		$lm04_pro_type = 1;
		$totalQuantityDVD = $this->Product_M->getTotalQuantityDVD($lm04_pro_type);

		if ($this->input->post('btnAddProduct')) {

			$lm04_pro_id       = $this->Product_M->totalProduct() + 1;
			$lm4_event_id      = $this->input->post("lm4_event_id");
			$lm04_pro_type     = $this->input->post("lm04_pro_type");
			$lm04_cate_id      = '0';
			$lm04_pro_name     = $this->input->post("lm04_pro_name");
			$lm04_pro_price    = $this->input->post("lm04_pro_price");
			$lm04_pro_quantity = $this->input->post("lm04_pro_quantity");
			if ($lm04_pro_type == '0') {
				$lm04_pro_quantity = '';
				$lm04_cate_id      = $this->input->post("lm04_cate_id");
			}
			$lm04_display      = $this->input->post("lm04_display");
			$lm04_created_at   = $lm04_updated_at = dateInsert();

			$arr_product = [
				"lm04_pro_id"               => $lm04_pro_id,
                "lm04_pro_type"             => $lm04_pro_type,
                "lm04_cate_id"              => $lm04_cate_id,
                "lm04_event_id"             => $lm4_event_id,
                "lm04_pro_name"             => $lm04_pro_name,
                "lm04_pro_content"          => '',
                "lm04_pro_keyword"          => '',
                "lm04_pro_price"            => $lm04_pro_price,
                "lm04_pro_discount"         => '',
                "lm04_pro_quantity"         => $lm04_pro_quantity,
                "lm04_active_status"        => '1',
                "lm04_display"              => $lm04_display,
                "lm04_sort"                 => '',
                "lm04_datetime_final_sales" => '',
                "lm04_created_at"           => $lm04_created_at,
                "lm04_updated_at"           => $lm04_updated_at
            ];
            // echo '<pre>';
            // var_dump($arr_product);die;

            if ($this->Product_M->insertProduct($arr_product) == true) {
            	$this->session->set_flashdata('product_success', ' 更新成功。');
            }

            if ($lm04_pro_type == '0') {
            	if(!empty($_SESSION['image_path'])) {
	                $exp_image_path = explode('.', $_SESSION['image_path']);
	                $id_product = $exp_image_path[0];
	                $this->Product_M->deleteImage($id_product);

	                $arr_add_image = [
	                    "lm05_pro_id"       => $id_product,
	                    "lm05_image_name"   => $_SESSION['image_path'],
	                    "lm05_image_rename" => $_SESSION['image_rename'],
	                    "lm05_image_path"   => '',
	                    "lm05_image_ext"    => $_SESSION['image_ext'],
	                    "lm05_created_at"   => $lm04_created_at,
	                    "lm05_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_image); die;

	                if (($this->Product_M->addImage($arr_add_image)) == true) {
	                	unset($_SESSION['image_path']);
	                    unset($_SESSION['image_rename']);
	                    unset($_SESSION['image_ext']);
	                }
            	}else {
            		$id_product = $this->Product_M->totalProduct();
	                $arr_add_image = [
	                    "lm05_pro_id"       => $id_product,
	                    "lm05_image_name"   => '',
	                    "lm05_image_rename" => '',
	                    "lm05_image_path"   => '',
	                    "lm05_image_ext"    => '',
	                    "lm05_created_at"   => $lm04_created_at,
	                    "lm05_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_image); die;

	                $this->Product_M->addImage($arr_add_image);
            	}
            }else {
            	if(!empty($_SESSION['video_path'])) {
	                $exp_video_path = explode('.', $_SESSION['video_path']);
	                $id_product = $exp_video_path[0];
	                $this->Product_M->deleteVideo($id_product);

	                $arr_add_movie = [
	                    "lm06_pro_id"       => $id_product,
	                    "lm06_movie_name"   => $_SESSION['video_path'],
	                    "lm06_movie_rename" => $_SESSION['video_rename'],
	                    "lm06_movie_path"   => '',
	                    "lm06_movie_ext"    => $_SESSION['video_ext'],
	                    "lm06_created_at"   => $lm04_created_at,
	                    "lm06_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_movie); die;

	                if (($this->Product_M->addVideo($arr_add_movie)) == true) {
	                	unset($_SESSION['video_path']);
	                    unset($_SESSION['video_rename']);
	                    unset($_SESSION['video_ext']);
	                }
            	}else {
            		$id_product = $this->Product_M->totalProduct();
	                $arr_add_movie = [
	                    "lm06_pro_id"       => $id_product,
	                    "lm06_movie_name"   => '',
	                    "lm06_movie_rename" => '',
	                    "lm06_movie_path"   => '',
	                    "lm06_movie_ext"    => '',
	                    "lm06_created_at"   => $lm04_created_at,
	                    "lm06_updated_at"   => $lm04_updated_at
	                ];
	                // echo '<pre>';
	                // var_dump($arr_add_movie); die;

	                $this->Product_M->addVideo($arr_add_movie);
            	}
            }
            redirect('admin/product/index');
		}

		$this->_data['priceImageDefault']   = $priceImageDefault;
		$this->_data['totalQuantityDVD']   = $totalQuantityDVD;
		$this->_data['quantityDefault']   = $quantityDefault;
		$this->_data['list_event']     = $list_event;
		$this->_data['list_category']  = $list_category;
		$this->_data['value_event_id'] = $value_event_id;
		$this->_data['value_event_name'] = $value_event_name;
		$this->header();
		$this->load->view('admin/product/add', $this->_data);
	}

	public function getPriceAjaxDVD() {
		$priceDVD_default = $this->Product_M->getValueDefault(2);
		$priceDVD_default = $priceDVD_default['lm11_value_default'];
		echo $priceDVD_default;
	}

	public function getPriceAjaxImage() {
		$priceImage_default = $this->Product_M->getValueDefault(1);
		$priceImage_default = $priceImage_default['lm11_value_default'];
		echo $priceImage_default;
	}

	public function deleteImage($file_del= '') {
		$config['upload_path'] = 'upload/image/';
        $data["path"] = $config['upload_path'].$file_del;
        if (file_exists(FCPATH.$data["path"])) {
            echo "file_exists";
            unlink($data["path"]);
        }
	}

	public function deleteVideo($file_del= '') {
		$config['upload_path'] = 'upload/movie/';
        $data["path"] = $config['upload_path'].$file_del;
        if (file_exists(FCPATH.$data["path"])) {
            echo "file_exists";
            unlink($data["path"]);
        }
	}

	public function edit($id_pro)
	{
		$get_product = explode('_', $id_pro);
		$id_product = $get_product[0];
		$product_type = !empty($get_product[1]) ? $get_product[1] : '';

		$product = $this->Product_M->getProductByID($id_product, $product_type);

		$list_event = $this->Event_M->getlistEvent();
		$list_category = $this->Category_M->getListCategory();

		//Get quantity default
		$quantityDefault = $this->Product_M->getValueDefault(5);
		$quantityDefault = $quantityDefault['lm11_value_default'];

		//Get price default
		$priceImageDefault = $this->Product_M->getValueDefault(1);
		$priceImageDefault = $priceImageDefault['lm11_value_default'];

		//Get Total Quantity DVD
		$lm04_pro_type = 1;
		$totalQuantityDVD = $this->Product_M->getTotalQuantityDVD($lm04_pro_type);

		//Get Total Quantity DVD sell
		$totalQuantityDVDsell = $this->Product_M->getTotalQuantityDVDsell($id_product, $lm04_pro_type);

		if (!empty($this->input->post('btnEditProduct'))) {
			$lm4_event_id      = $this->input->post("lm4_event_id");
			$lm04_pro_type     = $this->input->post("lm04_pro_type");
			$lm04_cate_id      = '0';
			$lm04_pro_name     = $this->input->post("lm04_pro_name");
			$lm04_pro_price    = $this->input->post("lm04_pro_price");
			$lm04_pro_quantity = $this->input->post("lm04_pro_quantity");
			if ($lm04_pro_type == '0') {
				$lm04_pro_quantity = '';
				$lm04_cate_id      = $this->input->post("lm04_cate_id");
			}
			$lm04_display      = $this->input->post("lm04_display");
			$lm04_updated_at = dateInsert();
			$delete_image = $this->input->post("delete_image");
			$image_before = $this->input->post("image_before");
			$delete_video = $this->input->post("delete_video");
			$video_before = $this->input->post("video_before");

			$arr_product = [
				"lm04_cate_id"              => $lm04_cate_id,
                "lm04_event_id"             => $lm4_event_id,
                "lm04_pro_type"             => $lm04_pro_type,
                "lm04_pro_name"             => $lm04_pro_name,
                "lm04_pro_price"            => $lm04_pro_price,
                "lm04_pro_quantity"         => $lm04_pro_quantity,
                "lm04_display"              => $lm04_display,
                "lm04_updated_at"           => $lm04_updated_at
            ];
            echo '<pre>';
            var_dump($arr_product);

            $editProduct = $this->Product_M->editProduct($id_product, $arr_product);
            if($editProduct == true) {
            	$this->session->set_flashdata('product_success', ' 更新成功。');
            }

            if ($lm04_pro_type == "0") { //Image
            	if($delete_image == "0") {
            		if (!empty($_SESSION['image_path'])) {

            			$arr_update_image = [
		                	"lm05_image_name"   => $_SESSION['image_path'],
		                    "lm05_image_rename" => $_SESSION['image_rename'],
		                    "lm05_image_path"   => '',
		                    "lm05_image_ext"    => $_SESSION['image_ext'],
		                    "lm05_updated_at"   => $lm04_updated_at
		                ];
		                echo '<pre>';
		                var_dump($arr_update_image);

		                $this->Product_M->updateImage($id_product, $arr_update_image);
            		}
            	}elseif ($delete_image == "1") {

            		//Del image
            		$config['upload_path'] = 'upload/image/';
			        $data["path"] = $config['upload_path'].$image_before;
			        if (file_exists(FCPATH.$data["path"])) {
			            echo "file_exists";
			            unlink($data["path"]);
			        }

            		$arr_update_image = [
	                    "lm05_image_name"   => '',
	                    "lm05_image_rename" => '',
	                    "lm05_image_ext"    => '',
	                    "lm05_updated_at"   => $lm04_updated_at
	                ];
	                echo '<pre>';
	                var_dump($arr_update_image);

	                $this->Product_M->updateImage($id_product, $arr_update_image);
            	}
            	
                unset($_SESSION['image_path']);
                unset($_SESSION['image_rename']);
                unset($_SESSION['image_ext']);
            }else {
            	if($delete_video == "0") {
            		if (!empty($_SESSION['video_path'])) {

            			$arr_update_movie = [
		                	"lm06_movie_name"   => $_SESSION['video_path'],
		                    "lm06_movie_rename" => $_SESSION['video_rename'],
		                    "lm06_movie_path"   => '',
		                    "lm06_movie_ext"    => $_SESSION['video_ext'],
		                    "lm06_updated_at"   => $lm04_updated_at
		                ];
		                echo '<pre>';
		                var_dump($arr_update_movie);

		                $this->Product_M->updateVideo($id_product, $arr_update_movie);
            		}
            	}elseif ($delete_video == "1") {

            		//Del image
            		$config['upload_path'] = 'upload/image/';
			        $data["path"] = $config['upload_path'].$image_before;
			        if (file_exists(FCPATH.$data["path"])) {
			            echo "file_exists";
			            unlink($data["path"]);
			        }

            		$arr_update_movie = [
	                    "lm06_movie_name"   => '',
	                    "lm06_movie_rename" => '',
	                    "lm06_movie_ext"    => '',
	                    "lm06_updated_at"   => $lm04_updated_at
	                ];
	                echo '<pre>';
	                var_dump($arr_update_movie);

	                $this->Product_M->updateVideo($id_product, $arr_update_movie);
            	}
            	
                unset($_SESSION['video_path']);
                unset($_SESSION['video_rename']);
                unset($_SESSION['video_ext']);
            }
            redirect('admin/product/index');
		}

		$this->_data['product']              = $product;
		$this->_data['priceImageDefault']    = $priceImageDefault;
		$this->_data['totalQuantityDVD']     = $totalQuantityDVD;
		$this->_data['totalQuantityDVDsell'] = $totalQuantityDVDsell;
		$this->_data['quantityDefault']      = $quantityDefault;
		$this->_data['list_event']           = $list_event;
		$this->_data['list_category']        = $list_category;
		$this->header();
		$this->load->view('admin/product/edit', $this->_data);
	}

	public function deleteProduct($id_product) {
        $data = array(
            "lm04_active_status" => '0'
        );

        if($this->Product_M->editProduct($id_product, $data) == true){
            $this->session->set_flashdata('product_success', '削除されました。');
            redirect('admin/product/index');
        }
    }
	
	public function valuedefault()
	{	
		$value_default = [];
		for ($i=1; $i <= 7; $i++) { 
			$value = $this->Product_M->getValueDefault($i);
			$value_default[] = $value['lm11_value_default'];
		}

		if ($this->input->post('btnSetDefault')) {

			$this->Product_M->deleteAllDefault();

			$lm11_value_1    = $this->input->post("lm11_value_1");
			$lm11_value_2    = $this->input->post("lm11_value_2");
			$lm11_value_3    = $this->input->post("lm11_value_3");
			$lm11_value_4    = $this->input->post("lm11_value_4");
			$lm11_value_5    = $this->input->post("lm11_value_5");
			$lm11_value_6    = $this->input->post("lm11_value_6");
			$lm11_value_7    = $this->input->post("lm11_value_7");
			$lm11_updated_at = dateInsert();

			$arr_value_1 = [
				"lm11_id"            => '1',
				"lm11_value_name"    => '画像の値段＊',
				"lm11_value_default" => $lm11_value_1,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_1 = $this->Product_M->insertDefault($arr_value_1);

            $arr_value_2 = [
				"lm11_id"            => '2',
				"lm11_value_name"    => 'DVDの値段＊',
				"lm11_value_default" => $lm11_value_2,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_2 = $this->Product_M->insertDefault($arr_value_2);

            $arr_value_3 = [
				"lm11_id"            => '3',
				"lm11_value_name"    => '運送料金',
				"lm11_value_default" => $lm11_value_3,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_3 = $this->Product_M->insertDefault($arr_value_3);

            $arr_value_4 = [
				"lm11_id"            => '4',
				"lm11_value_name"    => '掲載期限',
				"lm11_value_default" => $lm11_value_4,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_4 = $this->Product_M->insertDefault($arr_value_4);

            $arr_value_5 = [
				"lm11_id"            => '5',
				"lm11_value_name"    => '最初のDVD枚数',
				"lm11_value_default" => $lm11_value_5,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_5 = $this->Product_M->insertDefault($arr_value_5);

            $arr_value_6 = [
				"lm11_id"            => '6',
				"lm11_value_name"    => '警告DVD枚数',
				"lm11_value_default" => $lm11_value_6,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_6 = $this->Product_M->insertDefault($arr_value_6);

            $arr_value_7 = [
				"lm11_id"            => '7',
				"lm11_value_name"    => 'USB 料金',
				"lm11_value_default" => $lm11_value_7,
				"lm11_updated_at"    => $lm11_updated_at
            ];
            $insert_value_7 = $this->Product_M->insertDefault($arr_value_7);

            if ($insert_value_1 == true && $insert_value_2 == true && $insert_value_3 == true && $insert_value_4 == true && $insert_value_5 == true && $insert_value_6 == true && $insert_value_7 == true) {
            	$this->session->set_flashdata('update_value_default_success', ' 更新成功。');
            }
            redirect('admin/product/valuedefault');
		}

		$this->_data['value_default'] = $value_default;
		$this->header();
		$this->load->view('admin/product/default', $this->_data);
	}

	public function category()
	{
		$this->header();
		$this->load->view('admin/product/category');
	}
}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */