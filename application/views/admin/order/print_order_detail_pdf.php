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
    @media all {
	 .page-break {page-break-after:always; }
	}
}
</style>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div class="page-break">
<?php if(!empty($list_order)) {
  $lm01_county = !empty($list_order['lm01_county']) ? $list_order['lm01_county'] : '';
  $lm01_city   = !empty($list_order['lm01_city']) ? $list_order['lm01_city'] : '';
  $address     = $lm01_county.' '.$lm01_city;

  $lm01_firstname = !empty($list_order['lm01_firstname']) ? $list_order['lm01_firstname'] : '';
  $lm01_lastname  = !empty($list_order['lm01_lastname']) ? $list_order['lm01_lastname'] : '';
  $full_name      = $lm01_firstname.' '.$lm01_lastname;
  ?>
    	<div style="width: 50%; float: left; font-size: 13px;text-align: left;">
	        <p>注文ID：<?= !empty($list_order['lm07_order_id']) ? $list_order['lm07_order_id'] :'' ?></p>
	        <p>注文日：<?= !empty($list_order['lm07_date_order']) ? date("Y/m/d", strtotime($list_order['lm07_date_order'])) : '' ?></p>
	        <p>〒<?= !empty($list_order['lm01_zipcode']) ? $list_order['lm01_zipcode'] :'' ?></p>
	        <p><?= !empty($address) ? $address :'' ?></p>
	        <p><?= !empty($list_order['lm01_street']) ? $list_order['lm01_street'] :'' ?></p>
	        <p><?= !empty($full_name) ? $full_name :'' ?></p>
      	</div>
      	<div style="width: 50%; float: left;font-size: 13px;text-align: left; margin-left: 50px">
	        <p>納品日：<?= date('Y/m/d') ?></p>
	        <p><img src="assets/admin/common/images/logo.png" alt="Leme Shop" style="width: 300px"></p>
	        <p><?= !empty($info_company['lm12_address']) ? nl2br($info_company['lm12_address']) : '' ?></p>
      	</div>
      	<span style="content: '';display: block;clear: both;"></span>
  	
		
<?php } ?>
</div>
<div>
	<table class="table02" border="1" cellspacing="0" style="text-align: center">
      	<tr>
            <td>商品ID/商品名</td>
            <td>数量</td>
      	</tr>
	    <?php if(!empty($list_product)) { 
	        foreach($list_product as $prodcut_value) {
	        	if(!empty($prodcut_value['lm04_pro_id']) && !empty($prodcut_value['lm04_pro_name'])) {
	        	?>
	            <tr>
	                <td><?php echo  $prodcut_value['lm04_pro_id'].'/'.$prodcut_value['lm04_pro_name'];?></td>
	                <td><?= !empty($prodcut_value['lm08_quantity']) ? $prodcut_value['lm08_quantity'] : '' ?></td>
	            </tr>
	    <?php } } } ?>
    </table>
	</div>
	
 </body>
 </html>