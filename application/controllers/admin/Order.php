<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Dompdf\FontMetrics;
class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Account_M');
        $this->load->model('Event_M');
        $this->load->model('Order_M');
        $this->load->model('Info_company_M');
        $this->load->library('pagination');
        // $this->header();
    }

    public function header() {
        $this->load->view('admin/header.php');
    }

    public function index($offset = 1) {
        $list_events = $this->Event_M->getListEvent();
        $this->_data['list_events'] = $list_events;
        $config['base_url']    =  $config['base_url']    = base_url().'admin/order';;
        $config['uri_segment'] = 3;
        $config['per_page']    = 10;

        $aData = [
            'start' => $config['per_page'],
            'limit' => ($offset-1)*$config['per_page']
        ];
        $totalOrderByDate = $this->Order_M->groupByOder($aData);
        // print_r($totalOrderByDate);die();

        $all_list_orders = [];
        foreach ($totalOrderByDate as $key => $value) {
            $aData = [
                'start'           => $config['per_page'],
                'limit'           => ($offset-1)*$config['per_page'],
                'lm07_date_order' => $value['lm07_date_order']
            ];
            $list_order_by_date = $this->Order_M->getListOrder($aData);
            $all_list_orders[] = [
                'rowspan'     => $value,
                'list_orders' => ($list_order_by_date)
            ];
        }

        $total_order_search  = $this->Order_M->getListOrder('');
        $config['total_rows'] = $total_order_search;
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

        $pagination                = $this->pagination->create_links();
        $this->_data['pagination'] = $pagination;
        $this->_data['total_rows'] = $total_rows;
        $this->_data['offset']     = $offset;

        //list all users
        $this->_data['all_list_orders']    = ($all_list_orders);
        $this->_data["total_order_search"] = $total_order_search;

        $this->header();
        $this->load->view('admin/order/index.php',$this->_data);
        // redirect(base_url().'account/login','location');
    }

    public function searchOrder($offset = 1) {
        $data = $this->input->post();

        $search          = ['年', '月', '日'];
        $replace         = '';
        $date_from_search = '';
        $date_to_search   = '';

        if(!empty($data['datepicker_from'])) {
            $date_from_search = date("Ymd", strtotime(str_replace($search, $replace, $data['datepicker_from'])));
        }

        if(!empty($data['datepicker_to'])) {
            $date_to_search   = date("Ymd", strtotime(str_replace($search, $replace, $data['datepicker_to'])));
        }

        $config['base_url']    = '#';
        $config['uri_segment'] = 4;
        $config['per_page']    = 10;

        $aData = [
            'start' => $config['per_page'],
            'limit' => ($offset-1)*$config['per_page'],
            'lm07_order_id'    => trim($this->input->post("lm07_order_id")),
            'id_event'         => trim($this->input->post("id_event")),
            'date_from_search' => $date_from_search,
            'date_to_search'   => $date_to_search,
            'lm07_pay_status'  => trim($this->input->post("lm07_pay_status")),
        ];
        $totalOrderByDate = $this->Order_M->groupByOder($aData);
        $all_list_orders = [];
        foreach ($totalOrderByDate as $key => $value) {
            $aData = [
                'start'           => $config['per_page'],
                'limit'           => ($offset-1)*$config['per_page'],
                'lm07_order_id'    => trim($this->input->post("lm07_order_id")),
                'lm07_date_order' => $value['lm07_date_order'],
                'id_event'         => trim($this->input->post("id_event")),
                'date_from_search' => $date_from_search,
                'date_to_search'   => $date_to_search,
                'lm07_pay_status'  => trim($this->input->post("lm07_pay_status")),
            ];

            $list_order_by_date = $this->Order_M->getListOrder($aData);
            $all_list_orders[] = [
                'rowspan'     => $value,
                'list_orders' => $list_order_by_date
            ];
        }


        $aData = [
            'lm07_order_id'    => trim($this->input->post("lm07_order_id")),
            'id_event'         => trim($this->input->post("id_event")),
            'date_from_search' => $date_from_search,
            'date_to_search'   => $date_to_search,
            'lm07_pay_status'  => trim($this->input->post("lm07_pay_status")),
        ];

        $total_order_search  = $this->Order_M->getListOrder($aData);

        $aData = [
            'lm01_email'  => $this->input->post("lm01_email"),
        ];
        $config['total_rows'] = $total_order_search;
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


        $html = '<tr>
             <th>日付</th>
             <th>購入ID</th>
            <th>金額</th>
            <th>状況</th>
            <th>状態変更</th>
            <th>選択する</th>
            </tr>';
        if($total_order_search > 0){
            foreach ($all_list_orders as $list_order) {
                foreach ($list_order['list_orders'] as $key => $order_val) {
                    $lm07_date_order = !empty($order_val['lm07_date_order']) ? date("Y年m月d日", strtotime($order_val['lm07_date_order'])) : '';
                    $lm07_pay_status = "";
                    $disabled = "";
                    if($order_val['lm07_pay_status'] == 0) {
                        $lm07_pay_status ='<span style="color: red">決済待ち</span>';
                        $disabled = 'disabled';
                    } elseif ($order_val['lm07_pay_status'] == 1) {
                        $lm07_pay_status ='<span style="color: green">決済済み</span>';
                    } else {
                        $lm07_pay_status ='<span style="color: blue">運送済み</span>';
                    }
                    if($key == 0) {
                        $html .= '<tr> <td style="vertical-align: middle;" rowspan="'.$list_order['rowspan']['total'].'">'.$lm07_date_order.'</td>';
                    }
                    $html .='<td style="vertical-align: middle;">'.$order_val['lm07_order_id'].'</td>';
                    $html .='<td style="vertical-align: middle;">'.$order_val['lm07_total_price'].'円</td>';
                    $html .='<td style="vertical-align: middle;">'.$lm07_pay_status.'</td>';
                    $html .='<td style="vertical-align: middle;"><input type="button" class="btn01 btn_edit" onclick="location.href=\''.base_url().'admin/order/detail/'.$order_val['lm07_order_id'].'\'" value="編集する"></td>';
                    $html .='<td style="vertical-align: middle;"><label><input type="checkbox" name="lm07_pay_status"'.$disabled.' value="'.$order_val['lm07_order_id'].'"></label></td>';
                    $html .= '</td></tr>';
                }
            }
        } else {
            $html .= '<tr><td colspan="5" style="color: red">結果はありません。</td></tr>';
        }

        $data['pagination']   = $pagination;
        $data['total_rows']   = $total_rows;
        $data['offset']       = $offset;
        $myObj['data_html']       = $html;
        $myObj['data_pagination'] = $pagination;
        $myObj['data_page']       = $offset;
        $myObj['data_total_rows'] = $total_rows;
        $myObj['data_this_page']  = $offset;
        $myObj['total_search']    = $total_order_search;
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    public function detail($order_id,$offset = 1) {
        $config['base_url']    = base_url().'admin/order/detail/'.$order_id;
        $config['uri_segment'] = 5;
        $page = $offset;
        $config['per_page']    = 10;
        $list_order = $this->Order_M->getListOrderById($order_id);
        $price_order_by_id = $this->Order_M->getPriceOrderByID($order_id);
        $aData = [
            'start'    => $config['per_page'],
            'limit'    => ($offset-1)*$config['per_page'],
            'order_id' => $order_id
        ];
        $list_order_detail = $this->Order_M->getListDetailOrder($aData);
        $aData = [
            'order_id' => $order_id
        ];

        $total_order_detail = $this->Order_M->getListDetailOrder($aData);

        $oUser = $this->session->userdata();

        if ($this->input->method() == 'post') {
            $data          = $this->input->post();
            if($data['lm07_pay_status'] == 2) {
                $email = $data['lm01_email'];
                $this->_email['firstname_user']     = $list_order['lm01_firstname'];
  		        	$this->_email['lastname_user']      = $list_order['lm01_lastname'];
  		        	$this->_email['order_id']           = $order_id;
                $this->_email['lm07_total_price']   = $price_order_by_id;
                $this->_email['list_order_detail']  = $list_order_detail;
                $this->_email['message'] = 'あなたは正常に支払いを済ませました';
                $email_template = $this->load->view('email_template/pay_status.php',$this->_email,TRUE);
                send_mail($email,'決済済み',$email_template);
            }
            $data_update = [
                'lm07_pay_status' => $data['lm07_pay_status']
            ];
            $this->Order_M->updateOrder($order_id,$data_update);
            redirect('admin/order/detail/'.$order_id);
        }

        $config['total_rows'] = $total_order_detail;
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

        $this->_data['list_user']  = $oUser;
        $this->_data['list_order_detail']  = $list_order_detail;
        $this->_data['list_order']  = $list_order;
        $this->_data["total_order_detail"] = $total_order_detail;
        $this->header();
        $this->load->view('admin/order/detail.php',$this->_data);
        // redirect(base_url().'account/login','location');
    }

    public function getEventName() {
        $name_event = '';
        $id_event = $_REQUEST['id_event'];
        $name_event = $this->Event_M->getEventByID($_REQUEST['id_event']);
        echo json_encode($name_event);
    }

    public function delete_file() {
        if(!empty($_REQUEST['name_csv'])) {
            unlink($_REQUEST['name_csv']);
        }
        if(!empty($_REQUEST['name_pdf'])) {
            unlink($_REQUEST['name_pdf']);
        }
    }

    public function printPDFexportCsv() {
        if(!empty($_REQUEST['lm07_order_id'])) {
            foreach ($_REQUEST['lm07_order_id'] as $lm07_order_id) {
                $aData = [
                    'print_pdf' => 1,
                    'lm07_order_id' => $lm07_order_id
                ];
                $list_order_detail[] = $this->Order_M->getListOrder($aData);
            }
            require_once APPPATH . "third_party/Classes/PHPExcel.php";
            set_time_limit(0);
            ini_set('memory_limit', '1G');
            $objExcel = new PHPExcel;
            // create sheet ①担当者 save data from m01_manager
            $objExcel->createSheet();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('宛名');
                $sheet->setCellValue("A1",'郵便番号');
                $sheet->setCellValue("B1",'都道府県市区町村名');
                $sheet->setCellValue("C1",'番地');
                $sheet->setCellValue("D1",'宛名');
                $sheet->setCellValue("E1",'電話番号');
                $numRow = 1;
                foreach ($list_order_detail as $user_val) {
                    if(!empty($user_val[0])) {
                        $numRow++;
                        $lm01_phone_number_1 =!empty($user_val[0]['lm01_phone_number_1']) ? $user_val[0]['lm01_phone_number_1'] : '';
                        $lm01_phone_number_2 =!empty($user_val[0]['lm01_phone_number_2']) ? $user_val[0]['lm01_phone_number_2'] : '';
                        $lm01_phone_number_3 =!empty($user_val[0]['lm01_phone_number_3']) ? $user_val[0]['lm01_phone_number_3'] : '';
                        $phone_number =$lm01_phone_number_1.'-'.$lm01_phone_number_2.'-'.$lm01_phone_number_3;

                        $lm01_firstname = !empty($user_val[0]['lm01_firstname']) ? $user_val[0]['lm01_firstname'] : '';
                        $lm01_lastname  = !empty($user_val[0]['lm01_lastname']) ? $user_val[0]['lm01_lastname'] : '';
                        $full_name      = $lm01_firstname.' '.$lm01_lastname;

                        $lm01_street = !empty($user_val[0]['lm01_street']) ? $user_val[0]['lm01_street'] : '';
                        $lm01_county = !empty($user_val[0]['lm01_county']) ? $user_val[0]['lm01_county'] : '';
                        $lm01_city   = !empty($user_val[0]['lm01_city']) ? $user_val[0]['lm01_city'] : '';
                        $address     = $lm01_county.' '.$lm01_city;


                        $sheet->setCellValue("A$numRow",!empty($user_val[0]['lm01_zipcode']) ? $user_val[0]['lm01_zipcode'] : '');
                        $sheet->setCellValue("B$numRow",!empty($address) ? $address : '');
                        $sheet->setCellValue("C$numRow",$lm01_street);
                        $sheet->setCellValue("D$numRow",$full_name);
                        $sheet->setCellValue("E$numRow",$phone_number);
                    }
                }

            $list_order_prod_pdf = [];
            $product = [];
            foreach ($list_order_detail as $key => $order_val) {
                foreach ($order_val as $value) {

                if(!empty($value['lm07_order_id'])) {
                    $aData = [
                        'print_pdf' => 1,
                        'order_id' => $value['lm07_order_id']
                    ];
                    $product[] = $this->Order_M->getListDetailOrder($aData);
                }

                }
                $list_order_prod_pdf[] = [
                    'order_user' => !empty($order_val[0]) ? $order_val[0] : '',
                    'product'    =>$product
                ];
                // array_merge($list_order_prod_pdf,$product);
            }
            $info_company = $this->Info_company_M->fetchInfo();
            $data = nl2br($info_company['lm12_address']);
            $this->_data['info_company'] = $info_company;

            $this->_data['list_order_prod_pdf'] = $list_order_prod_pdf;
            $this->load->library('Pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $html = $this->load->view('admin/order/print_order_pdf',$this->_data,true);

            $this->pdf->loadHtml(($html));
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->render();

            $canvas = $this->pdf->get_canvas();
            $font = $this->getFont("helvetica", "normal");
            $canvas->page_text(450, 10, "{PAGE_NUM} / {PAGE_COUNT}", $font, 12, array(0,0,0));
            $date_export = date('YmdHis');
            $name_file_csv= 'system_data_'.$date_export.'.csv';
            PHPExcel_IOFactory::createWriter($objExcel, 'CSV')->save($name_file_csv);

            $date_pdf = date('YmdHis');
            $name_file_pdf = 'system_data_'.$date_pdf.'.pdf';
            file_put_contents('upload/'.$name_file_pdf, $this->pdf->output());
            $response =  array(
                'filename_pdf' => base_url().'upload/'.$name_file_pdf,
                'filename_csv' => base_url().$name_file_csv,
                'folder_csv'   => $name_file_csv,
                'folder_pdf'   => 'upload/'.$name_file_pdf
            );
            print_r(json_encode($response));
        }
    }

    public function printPDF() {
        if(!empty($_REQUEST['lm07_order_id'])) {
            $list_order_prod_pdf = [];
            $product = [];
            $list_order = $this->Order_M->getListOrderById($_REQUEST['lm07_order_id']);

            $aData = [
                'print_pdf' => 1,
                'order_id' => $_REQUEST['lm07_order_id']
            ];
            $list_product = $this->Order_M->getListDetailOrder($aData);
            $info_company = $this->Info_company_M->fetchInfo();
            $this->_data['info_company'] = $info_company;

            $this->_data['list_order'] = $list_order;
            $this->_data['list_product'] = $list_product;
            $this->load->library('Pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $html = $this->load->view('admin/order/print_order_detail_pdf',$this->_data,true);

            $this->pdf->loadHtml(($html));
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->render();

            $date_pdf = date('YmdHis');
            $name_file_pdf = 'system_data_'.$date_pdf.'.pdf';
            file_put_contents('upload/'.$name_file_pdf, $this->pdf->output());
            $response =  array(
                'filename_pdf' => base_url().'upload/'.$name_file_pdf,
                'folder_pdf'   => 'upload/'.$name_file_pdf
            );
            print_r(json_encode($response));
        }
    }


}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */
