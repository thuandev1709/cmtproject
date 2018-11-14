<style>
    * {
        font-family: mgenplus-regular !important;
    }
    .title4{
      margin: 20px;
      text-align: center;
      font-size: 25px;
    }
    .table02{
      text-align: center;
      font-size: 13px;
      table-layout: fixed;
    width: 100%;
    }
    .table02 td{
    	padding: 10px 50px;
      	word-wrap: break-word;
   		overflow-wrap: break-word;
      
    }
    .td{
      text-align: center;
    }
    .border{
      border: 1px #0a0a0a solid;
    }
}
</style>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<?php if(!empty($list_order_prod_pdf)) {
	foreach ($list_order_prod_pdf as $order_val) {
		$lm01_county = !empty($order_val['order_user']['lm01_county']) ? $order_val['order_user']['lm01_county'] : '';
        $lm01_city   = !empty($order_val['order_user']['lm01_city']) ? $order_val['order_user']['lm01_city'] : '';
        $address     = $lm01_county.' '.$lm01_city;

        $lm01_firstname = !empty($order_val['order_user']['lm01_firstname']) ? $order_val['order_user']['lm01_firstname'] : '';
        $lm01_lastname  = !empty($order_val['order_user']['lm01_lastname']) ? $order_val['order_user']['lm01_lastname'] : '';
        $full_name      = $lm01_firstname.' '.$lm01_lastname;


	 ?>
	 	<div style="font-size: 25px;text-align: center;">納　品　書</div>
		<section style="height: 950px">			
		  	<div>
		    		<div style="width: 50%; float: left; font-size: 13px;text-align: left;">
			        <p>注文ID：<?= !empty($order_val['order_user']['lm07_order_id']) ? $order_val['order_user']['lm07_order_id'] :'' ?></p>
			        <p>注文日：<?= !empty($order_val['order_user']['lm07_date_order']) ? date("Y/m/d", strtotime($order_val['order_user']['lm07_date_order'])) : '' ?></p>
			        <p>〒<?= !empty($order_val['order_user']['lm01_zipcode']) ? $order_val['order_user']['lm01_zipcode'] :'' ?></p>
			        <p><?= !empty($address) ? $address :'' ?></p>
			        <p><?= !empty($order_val['order_user']['lm01_street']) ? $order_val['order_user']['lm01_street'] :'' ?></p>
			        <p><?= !empty($full_name) ? $full_name :'' ?></p>
		      	</div>
		      	<div style="width: 50%; float: left;font-size: 13px;text-align: left; margin-left: 50px">
			        <p>納品日：<?= date('Y/m/d') ?></p>
			        <p><img src="assets/admin/common/images/logo.png" alt="Leme Shop" style="width: 300px"></p>
			        <p><?= !empty($info_company['lm12_address']) ? nl2br($info_company['lm12_address']) : '' ?></p>
		      	</div>
		      	<span style="content: '';display: block;clear: both;"></span>
		  	</div>

		  	<!-- <div>
		    	<div  style="float: left; font-size: 13px;text-align: left;">
			        <p>イベントID/イベント名:  <?= !empty($order_val['order_user']['lm10_event_id']) ? $order_val['order_user']['lm10_event_id']:'' ?> / <?= !empty($order_val['order_user']['lm10_event_name']) ? $order_val['order_user']['lm10_event_name']:'' ?> </p>
		        	<p>合計金額: <?= isset($order_val['order_user']['lm08_total_price']) ? $order_val['order_user']['lm08_total_price'].'円' :'' ?></p>
		      	</div>
		      	<div  style="float: left;font-size: 13px;text-align: left; margin-left: 50px">
			        <p>【納品物】DVD：1枚、USB1個</p>
			        <p>お支払方法：<?= !empty($order_val['order_user']['lm13_method_name']) ? $order_val['order_user']['lm13_method_name'] :'' ?></p>
		      	</div>
		      	<span style="content: '';display: block;clear: both;"></span>
		  	</div> -->

		  	<div>
		  		<table class="table02" border="1" cellspacing="0" style="text-align: center;margin: auto;">
		          	<tr>
			            <td>商品ID/商品名</td>
			            <td>数量</td>
		          	</tr>
		        <?php
		            foreach($order_val['product'] as $prodcut_value) {
		            	foreach ($prodcut_value as $key => $value) {
		            		if(!empty($value['lm08_pro_id']) || !empty($value['lm04_pro_name'])) {?>
			                <tr>
			                    <td><?= !empty($value['lm08_pro_id']) ? $value['lm08_pro_id']:'' ?> / <?= !empty($value['lm04_pro_name']) ? $value['lm04_pro_name']:'' ?></td>
			                    <td><?= !empty($order_val['order_user']['lm08_quantity']) ? $order_val['order_user']['lm08_quantity'] : '' ?></td>
			                </tr>
		            		
		        <?php } }  } ?>
		        </table>
		  	</div>
		</section>
<?php } } ?>
 </body>
 </html>