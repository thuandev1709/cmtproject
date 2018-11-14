<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_M');
		$this->load->model('Event_M');
		$this->load->model('Product_M');
		$this->load->model('Order_M');
		$this->load->model('Info_company_M');
	}

	public function header()
	{
		$this->load->view('header.php');
	}

	public function footer()
	{
		$this->load->view('footer.php');
	}

	public function listCategory($id_event) {

		$event                 = $this->Event_M->getEventByID($id_event);
		$listDVDByEventID      = $this->Cart_M->listDVDByEventID($id_event);
		$listCategoryByEventID = $this->Cart_M->listCategoryByEventID($id_event);

		$today = dateInsert();
		$tax = $this->Cart_M->getTax($today);

		$list_category = [];
		if (!empty($listDVDByEventID)) {
			foreach ($listDVDByEventID as $dvd) {
				$price_tax = $dvd['lm04_pro_price'] + ($dvd['lm04_pro_price']*$tax/100);
				$list_category[] = [
					'id'         => $dvd['lm04_pro_id'],
					'cate_id'    => $dvd['lm04_cate_id'],
					'event_id'   => $dvd['lm04_event_id'],
					'pro_type'   => $dvd['lm04_pro_type'],
					'name'       => $dvd['lm04_pro_name'],
					'price'      => $dvd['lm04_pro_price'],
					'price_tax'  => $price_tax,
					'quantity'   => $dvd['lm04_pro_quantity'],
					'type'       => 'dvd',
					'created_at' => $dvd['lm04_created_at']
				];
			}
		}
		if (!empty($listCategoryByEventID)) {
			foreach ($listCategoryByEventID as $cate) {
				$list_category[] = [
					'id'         => $cate['lm03_cate_id'],
					'name'       => $cate['lm03_cate_name'],
					'price_tax'  => '',
					'type'       => 'cate',
					'created_at' => $cate['lm03_created_at']
				];
			}
		}

		$this->_data['event']         = $event;
		$this->_data['list_category'] = $list_category;
        $this->header();
		$this->load->view('cart/list_category', $this->_data);
		$this->footer();
	}

	public function listProductByCateID($id,$offset = 1) {



		$get_product  = explode('_', $id);
		$id_event     = $get_product[0];
		$id_cate      = $get_product[1];


		$config['base_url']    = base_url().'cart/listProductByCateID/'.$id;
        $config['uri_segment'] = 4;
        $config['per_page']    = 12;

		$event        = $this->Event_M->getEventByID($id_event);
		$name_cate    = $this->Cart_M->getNameCateByID($id_cate);
		$list_product = $this->Cart_M->listProductByCateID($id_cate);

		$today = dateInsert();
		$tax = $this->Cart_M->getTax($today);

		$list_product_new = [];
		if (!empty($list_product)) {
			foreach ($list_product as $pro) {
				$price_tax = $pro['lm04_pro_price'] + ($pro['lm04_pro_price']*$tax/100);
				$list_product_new[] = [
					'lm04_pro_id'       => $pro['lm04_pro_id'],
					'lm04_cate_id'      => $pro['lm04_cate_id'],
					'lm04_event_id'     => $pro['lm04_event_id'],
					'lm04_pro_name'     => $pro['lm04_pro_name'],
					'lm04_pro_price'    => $pro['lm04_pro_price'],
					'price_tax'         => $price_tax,
					'lm05_image_rename' => $pro['lm05_image_rename']
				];
			}
		}

		 $count=count($list_product_new);
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

        $list_all = array_slice($list_product_new,$off, $config['per_page']);

        $this->_data['count']          = $count;
        $this->_data['pagination']     = $pagination;
        $this->_data['total_rows']     = $total_rows;
        $this->_data['offset']         = $offset;

		$this->_data['event']        = $event;
		$this->_data['name_cate']    = $name_cate;
		$this->_data['list_product'] = $list_all;
		$this->_data['id'] = $id;
        $this->header();
		$this->load->view('cart/list_product', $this->_data);
		$this->footer();
	}

	public function cartImageDetail($id) {

		$get_product     = explode('_', $id);
		$id_event        = $get_product[0];
		$id_cate         = $get_product[1];
		$id_image        = $get_product[2];

		$event           = $this->Event_M->getEventByID($id_event);
		$name_cate       = $this->Cart_M->getNameCateByID($id_cate);
		$product_details = $this->Product_M->getProductByID($id_image, 0);

		$this->_data['event']           = $event;
		$this->_data['name_cate']       = $name_cate;
		$this->_data['product_details'] = $product_details;
        $this->header();
		$this->load->view('cart/cart_img_detail.php', $this->_data);
		$this->footer();
	}

	public function cartMoveDetail($id) {

		$get_product     = explode('_', $id);
		$id_event        = $get_product[0];
		$id_movie        = $get_product[1];

		$event           = $this->Event_M->getEventByID($id_event);
		$product_details = $this->Product_M->getProductByID($id_movie, 1);

		$this->_data['event']           = $event;
		$this->_data['product_details'] = $product_details;
        $this->header();
		$this->load->view('cart/cart_movie_detail.php', $this->_data);
		$this->footer();
	}

	public function addToCart($id) {

		if ($this->input->post('addtocart')) {

			$flag                         = 1;
			$url                          = $this->input->post('url');
			$get_product                  = explode('_', $id);
			$id_product                   = $get_product[0];
			$type                         = $get_product[1];
			$lm04_pro_id                  = $id_product;
			$lm05_image_rename            = '';
			$lm06_movie_rename            = '';
			$value_usb_money_default      = $this->Product_M->getValueDefault(7);
			$value_fee_transport_default  = $this->Product_M->getValueDefault(3);
			$fee_transport 				  = $value_fee_transport_default['lm11_value_default'];

			$today = dateInsert();
			$tax = $this->Cart_M->getTax($today);

			if ($type == 'dvd') {
				$product_item_cart = $this->Product_M->getProductByID($id_product, 1);

				$lm04_cate_id      = $product_item_cart['lm04_cate_id'];
				$lm04_event_id     = $product_item_cart['lm04_event_id'];
				$lm04_pro_type     = $product_item_cart['lm04_pro_type'];
				$lm04_pro_name     = $product_item_cart['lm04_pro_name'];
				$lm04_pro_price    = $product_item_cart['lm04_pro_price'];
				$lm04_pro_quantity = $product_item_cart['lm04_pro_quantity'];
				$lm06_movie_rename = $product_item_cart['lm06_movie_rename'];
				$quantity          = !empty($this->input->post('quantity_dvd')) ? $this->input->post('quantity_dvd') : 1;
				$usb_money		   = 0;
			}else {
				$product_item_cart = $this->Product_M->getProductByID($id_product, 0);

				$lm04_cate_id      = $product_item_cart['lm04_cate_id'];
				$lm04_event_id     = $product_item_cart['lm04_event_id'];
				$lm04_pro_type     = $product_item_cart['lm04_pro_type'];
				$lm04_pro_name     = $product_item_cart['lm04_pro_name'];
				$lm04_pro_price    = $product_item_cart['lm04_pro_price'];
				$lm04_pro_quantity = 0;
				$lm05_image_rename = $product_item_cart['lm05_image_rename'];
				$quantity          = 0;
				$usb_money		   = $value_usb_money_default['lm11_value_default'];
			}

			if(isset($_SESSION['cart'])) {
				$arr_item_cart = $_SESSION['cart'];
			}else {
				$arr_item_cart = [];
			}

			$id = count($arr_item_cart) + 1;
			if (!empty($arr_item_cart)) {
				foreach ($arr_item_cart as $key => $value) {
					if ($value['lm04_pro_id'] == $id_product) {
						if ($value['lm04_pro_type'] == 1) {
							$vl_quantity = $value['quantity'] + $quantity;
							if ($vl_quantity <= 10) {
								if ($vl_quantity <= $value['lm04_pro_quantity']) {
									$arr_item_cart[$key]['quantity'] += $quantity;
								}else {
									$this->session->set_flashdata('addCartFail', ' 製品は十分ではありません！');
								}
							}else {
								$this->session->set_flashdata('addCartFail', ' 製品の最大数は10です！');
							}
						}
						$flag = 0;
					}
				}
			}else {
				$flag = 1;
			}

			if ($flag == 1) {
				$arr_item_cart[] = [
					'id_arr_cart'       => $id,
					'lm04_pro_id'       => $lm04_pro_id,
					'lm04_cate_id'      => $lm04_cate_id,
					'lm04_event_id'     => $lm04_event_id,
					'lm04_pro_type'     => $lm04_pro_type,
					'lm04_pro_name'     => $lm04_pro_name,
					'lm04_pro_price'    => $lm04_pro_price,
					'lm04_pro_quantity' => $lm04_pro_quantity,
					'lm05_image_rename' => $lm05_image_rename,
					'lm06_movie_rename' => $lm06_movie_rename,
					'quantity'          => $quantity,
					'usb_money'         => $usb_money,
					'tax'				=> $tax,
					'fee_transport'		=> $fee_transport
				];
			}

			$_SESSION['cart'] = $arr_item_cart;
			redirect($url);
		}
	}

	public function cart_notlogin() {
		if(isset($_REQUEST['key_product'])) {

			unset($_SESSION['cart'][$_REQUEST['key_product']]);
			$arr_cart = $_SESSION['cart'];
			$html = '';
			$flag_usb = 0;
			$usb_money = 0;
	        if($arr_cart > 0){
	        	$total_record = 0;
	            foreach ($arr_cart as $key => $item_cart) {
	            	if ($flag_usb == 0 && $item_cart['usb_money'] > 0) {
	            		$usb_money = $item_cart['usb_money'];
	            		$flag_usb = 1;
	            	}
	            	$total_record += 1;
            		if($item_cart['lm04_pro_type'] == 1) {
            			$img = '<img src="'.base_url().'assets/img/demo.jpg" class="td_img">';
            		} else {
            			$img = '<img src="'.base_url().'upload/image/'.$item_cart['lm05_image_rename'].'" style="height: 40px;">';
            		}
                    $html .= '<div class="item_product"> <table>';
                    $html .= '<tr> <td rowspan="2" >'.$img.'</td>';
                    $html .= '<td> <label>枚数</label> ';
                    $html .= '<select  id="quantity_'.$key.'" onclick="myFunction('.$key.')"> <option value="1">1</option> <option value="2">2</option> </select> </td>';
                    $html .= '<td class="td_info"> ';
                    $html .= '<p> 値段(税込)：'.$item_cart['lm04_pro_price'] . '円'.'</p>';
                    $html .= '<input type="hidden" id="lm04_pro_price_'.$key.'" name="lm04_pro_price" value="'.$item_cart['lm04_pro_price'].'">';
                    $html .= '<p> 小計 <span id="subtotal_'.$key.'">'.$item_cart['lm04_pro_price'].'</span></p>';
                    $html .= '</td> </tr>';
                    $html .= '<tr> <td colspan="2">';
                    $html .='<input type="button" class="btn btn_delete" onclick="deleteItem('.$key.')" name="btn_delete" value="削除">';
                    $html .= '</tr>';
                    $html .= '</table> </div>';
	            }
            	$html .= '<input type="hidden" id="total_record" value="'.$key.'">';
                $html .= '<div class="info_row"> <table style="float: right;margin-right: 20px; ">';
                $html .= '<tr> <td>合計（税込）</td> <td class="total_money_include_tax"></td> </tr>';
                $html .= '<tr> <td>合計（税抜）</td> <td class="total_tax_excluded"></td> </tr>';
                if ($usb_money > 0) {
                	$html .= '<tr> <td>USB 料金</td> <td>'.$usb_money.'円</td> </tr>';
                }
                $html .= '<tr> <td>税金</td> <td>0円</td> </tr>';
                $html .= '<tr> <td>運送料金</td> <td>0円</td> </tr>';
                $html .= '<tr> <td>合計：</td> <td class="total_all"></td> </tr>';
                $html .= '</table></div>';
	        }
            $myObj['data_html'] = $html;
	        $myJSON = json_encode($myObj);
	        echo $myJSON;
        } else {
        	$this->_data['_arr_item_cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
	        $this->header();
			$this->load->view('cart/cart_notlogin.php',$this->_data);
			$this->footer();
        }

	}

	public function cart_login() {
    	$this->_data['_arr_item_cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
    	if ($this->input->method() == 'post') {
    		$data = $this->input->post();
			foreach ($_SESSION['cart'] as $key => $value) {
				$arr_item_cart[] = [
					'id_arr_cart'       => $value['id_arr_cart'],
					'lm04_pro_id'       => $value['lm04_pro_id'],
					'lm04_cate_id'      => $value['lm04_cate_id'],
					'lm04_event_id'     => $value['lm04_event_id'],
					'lm04_pro_type'     => $value['lm04_pro_type'],
					'lm04_pro_name'     => $value['lm04_pro_name'],
					'lm04_pro_price'    => $value['lm04_pro_price'],
					'lm04_pro_quantity' => $value['lm04_pro_quantity'],
					'lm05_image_rename' => $value['lm05_image_rename'],
					'lm06_movie_rename' => $value['lm06_movie_rename'],
					'quantity'          =>( (!empty($data['quantity_'.$value['lm04_pro_id']]))) ? ($data['quantity_'.$value['lm04_pro_id']]) : 1,
					'usb_money'       	=> $value['usb_money'],
					'tax'       		=> $value['tax'],
					'fee_transport'     => $value['fee_transport']
				];
			}
			$_SESSION['cart'] = $arr_item_cart;
			$_SESSION['data_input'] = $data;
			redirect(base_url().'cart/cart_confirm');
    	}
        $this->header();
		$this->load->view('cart/cart_login.php',$this->_data);
		$this->footer();
	}

	public function cart_confirm() {
		$arr_data_input = $_SESSION['data_input'];
		$this->_data['_arr_item_cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
		$this->_data['data_input']     = isset($_SESSION['data_input']) ? $_SESSION['data_input'] : '';
		if($this->input->method() == 'post') {
			$data = $this->input->post();
			// echo '<pre>';
			// var_dump($_SESSION['data_input']['address_cart']);
			// die;

			if($data['payment'] == 1) { //Card
				$data = array(
					'lm07_user_id'              => $this->session->userdata('user_id'),
					'lm07_total_quantity'       => $data['total_record'],
					'lm07_total_price'          => $data['lm07_total_price_tax'],
					'lm07_tax'                  => $data['lm07_tax'],
					'lm07_usb_money'            => $data['lm07_usb_money'],
					'lm07_fee_transport'        => $data['lm07_fee_transport'],
					'lm07_date_order'           => dateInsert(),
					'lm07_delivery_address_new' => $arr_data_input['address_cart'],
					'lm07_active_status'        => 1,
					'lm07_pay_status'           => 1,
					'lm07_method_id'            => $data['payment'],
					'lm07_date_delivery'        => dateInsert(),
					'lm07_created_at'           => dateInsert(),
					'lm07_updated_at'           => dateInsert(),
		        );
		        $order_id = $this->Order_M->insertOrder($data);
		        $price_order_by_id = $this->Order_M->getPriceOrderByID($order_id);

		        $_SESSION['order_id'] = $order_id;
		        $_SESSION['lm07_total_price'] = $price_order_by_id;

		        // Add lm17_delivery_address_new
				if ($arr_data_input['address_cart'] == 1) {
					$lm17_zipcode = $arr_data_input['lm17_zipcode_1'].'-'.$arr_data_input['lm17_zipcode_2'];
					$lm17_address = $arr_data_input['lm17_address_1'].'-'.$arr_data_input['lm17_address_2'];
					$lm17_phone   = $arr_data_input['lm17_phone_1'].'-'.$arr_data_input['lm17_phone_2'].'-'.$arr_data_input['lm17_phone_3'];

					$arr_lm17 = array(
						'lm17_order_id'      => $order_id,
						'lm17_receiver_name' => $arr_data_input['lm17_receiver_name'],
						'lm17_zipcode'       => $lm17_zipcode,
						'lm17_address'       => $lm17_address,
						'lm17_phone'         => $lm17_phone,
						'lm17_created_at'    => dateInsert()
					);
					$this->Order_M->insertDeliveryAddress($arr_lm17);
				}

		        if(!empty($order_id)) {

		        	// send mail
		        	// $email = $this->session->userdata('email_user');
		        	// $this->_email['order_id'] = $order_id;
		        	// $this->_email['lm07_total_price'] = $price_order_by_id;
		        	// $this->_email['message'] = '支払い完了';
		            // $email_template = $this->load->view('email_template/bank_card.php',$this->_email,TRUE);
		            // send_mail($email,'決済済み',$email_template);

		        	foreach ($_SESSION['cart'] as $key => $item_cart) {
		        		$lm04_pro_price = (int)$item_cart['lm04_pro_price'];
		        		$tax = (int)$item_cart['tax'];
		        		$lm08_price = $lm04_pro_price + ($lm04_pro_price*$tax/100);

		        		if($item_cart['lm04_pro_type'] == 0) {
		        			$lm08_total_price = $lm08_price;
		        		}else {
		        			$lm08_total_price = $lm08_price * $item_cart['quantity'];
		        		}

		        		$data = array(
							'lm08_order_id'    => $order_id,
							'lm08_pro_id'      => !empty($item_cart['lm04_pro_id']) ? $item_cart['lm04_pro_id'] : '',
							'lm08_pro_number'  => $key + 1,
							'lm08_quantity'    => !empty($item_cart['quantity']) ?$item_cart['quantity'] : 0,
							'lm08_price'       => $lm08_price,
							'lm08_tax'         => $tax,
							'lm08_discount'    => '',
							'lm08_total_price' => $lm08_total_price,
							'lm08_created_at'  => dateInsert(),
							'lm08_updated_at'  => dateInsert(),
				        );
				        $this->Order_M->insertOrderDetail($data);

				        if ($item_cart['lm04_pro_type'] == 1) {
				        	$pro_id_change = $item_cart['lm04_pro_id'];
			        		$lm04_pro_quantity_new = $item_cart['lm04_pro_quantity'] - $item_cart['quantity'];
			        		$arr_update_quantity_pro = array(
								'lm04_pro_quantity' => $lm04_pro_quantity_new
				        	);
			        		$this->Product_M->editProduct($pro_id_change, $arr_update_quantity_pro);
			        	}
		        	}
		        }
		        unset($_SESSION['cart']);
				redirect(base_url().'payment/bank_card');

			} else { //Transfer
				$data = array(
					'lm07_user_id'              => $this->session->userdata('user_id'),
					'lm07_total_quantity'       => $data['total_record'],
					'lm07_total_price'          => $data['lm07_total_price_tax'],
					'lm07_tax'                  => $data['lm07_tax'],
					'lm07_usb_money'            => $data['lm07_usb_money'],
					'lm07_fee_transport'        => $data['lm07_fee_transport'],
					'lm07_date_order'           => dateInsert(),
					'lm07_delivery_address_new' => $arr_data_input['address_cart'],
					'lm07_active_status'        => 1,
					'lm07_pay_status'           => 0,
					'lm07_method_id'            => $data['payment'],
					'lm07_date_delivery'        => dateInsert(),
					'lm07_created_at'           => dateInsert(),
					'lm07_updated_at'           => dateInsert(),
		        );
		        $order_id = $this->Order_M->insertOrder($data);
		        $price_order_by_id = $this->Order_M->getPriceOrderByID($order_id);

		        $_SESSION['order_id'] = $order_id;
		        $_SESSION['lm07_total_price'] =  $price_order_by_id;

		        // Add lm17_delivery_address_new
				if ($arr_data_input['address_cart'] == 1) {
					$lm17_zipcode = $arr_data_input['lm17_zipcode_1'].'-'.$arr_data_input['lm17_zipcode_2'];
					$lm17_address = $arr_data_input['lm17_address_1'].'-'.$arr_data_input['lm17_address_2'];
					$lm17_phone   = $arr_data_input['lm17_phone_1'].'-'.$arr_data_input['lm17_phone_2'].'-'.$arr_data_input['lm17_phone_3'];

					$arr_lm17 = array(
						'lm17_order_id'      => $order_id,
						'lm17_receiver_name' => $arr_data_input['lm17_receiver_name'],
						'lm17_zipcode'       => $lm17_zipcode,
						'lm17_address'       => $lm17_address,
						'lm17_phone'         => $lm17_phone,
						'lm17_created_at'    => dateInsert()
					);
					$this->Order_M->insertDeliveryAddress($arr_lm17);
				}

		        if(!empty($order_id)) {
		        	foreach ($_SESSION['cart'] as $key => $item_cart) {
		        		$lm04_pro_price = (int)$item_cart['lm04_pro_price'];
		        		$tax = (int)$item_cart['tax'];
		        		$lm08_price = $lm04_pro_price + ($lm04_pro_price*$tax/100);

		        		if($item_cart['lm04_pro_type'] == 0) {
		        			$lm08_total_price = $lm08_price;
		        		}else {
		        			$lm08_total_price = $lm08_price * $item_cart['quantity'];
		        		}

		        		$data = array(
							'lm08_order_id'    => $order_id,
							'lm08_pro_id'      => !empty($item_cart['lm04_pro_id']) ? $item_cart['lm04_pro_id'] : '',
							'lm08_pro_number'  => $key + 1,
							'lm08_quantity'    => !empty($item_cart['quantity']) ?$item_cart['quantity'] : 0,
							'lm08_price'       => $lm08_price,
							'lm08_tax'         => $tax,
							'lm08_discount'    => '',
							'lm08_total_price' => $lm08_total_price,
							'lm08_created_at'  => dateInsert(),
							'lm08_updated_at'  => dateInsert(),
				        );
				        $this->Order_M->insertOrderDetail($data);

				        if ($item_cart['lm04_pro_type'] == 1) {
				        	$pro_id_change = $item_cart['lm04_pro_id'];
			        		$lm04_pro_quantity_new = $item_cart['lm04_pro_quantity'] - $item_cart['quantity'];
			        		$arr_update_quantity_pro = array(
								'lm04_pro_quantity' => $lm04_pro_quantity_new
				        	);
			        		$this->Product_M->editProduct($pro_id_change, $arr_update_quantity_pro);
			        	}
		        	}

		        	// send mail
		        	$email     		= $this->session->userdata('email_user');
		        	$firstname_user = $this->session->userdata('firstname_user');
		        	$lastname_user  = $this->session->userdata('lastname_user');

		        	$this->_email['info'] 				= $this->Info_company_M->fetchInfo();
		        	$this->_email['firstname_user']     = $firstname_user;
		        	$this->_email['lastname_user']      = $lastname_user;
		        	$this->_email['order_id']           = $order_id;
		        	$this->_email['lm07_total_price']   = $price_order_by_id;
		        	$this->_email['message'] 		    = '';
		        	$this->_email['data_user']          = $this->session->userdata();
		        	$this->_email['arr_cart']           = $_SESSION['cart'];
		        	$this->_email['arr_data_input']     = $arr_data_input;


	                $email_template = $this->load->view('email_template/bank_transfer.php',$this->_email,TRUE);
	                send_mail($email,'[Salute]お振込お願いします',$email_template);
		        }
		        unset($_SESSION['cart']);
				redirect(base_url().'payment/bank_transfer');
			}
		}
        $this->header();
		$this->load->view('cart/cart_confirm.php',$this->_data);
		$this->footer();
	}
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */
