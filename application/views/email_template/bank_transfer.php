<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<p><?php echo $firstname_user.' '.$lastname_user;?>様</p>

		<p>この度はご注文いただき誠にありがとうございます。</p>
		<p>下記の通りお振込くださいますようよろしくお願いいたします。</p>

		<p>************************************************</p>
		<p>　ご請求金額</p>
		<p>************************************************</p>

		<p>注文No: <?php echo $order_id; ?></p>
		<p>ご注文合計: <?php echo number_format(round($lm07_total_price)); ?>円</p>
		<p>お支払い方法：銀行振込</p>
		<p><?php echo $message; ?></p>

		<p>************************************************</p>
		<p>　ご注文商品明細</p>
		<p>************************************************</p>
		
		<?php

		$total_price = 0;
		$total_price_all_pro = 0;
		$fee_transport = 0;
		$usb_money = 0;
		foreach ($arr_cart as $value) {
			$fee_transport = round($value['fee_transport']);
			if ($value['lm04_pro_type'] == 0) {
				$usb_money = round($value['usb_money']);
			}
			$price_tax = round($value['lm04_pro_price'] + ($value['lm04_pro_price']*$value['tax']/100));
			if ($value['lm04_pro_type'] == 1) {
				$total_price = round($price_tax * $value['quantity']);
			}else {
				$total_price = $price_tax;
			}
			$total_price_all_pro += $total_price;
		?>
			<p>商品コード: <?php echo $value['lm04_pro_id']; ?></p>
			<p>商品名: <?php echo $value['lm04_pro_name']; ?></p>
			<p>単価： <?php echo number_format($price_tax); ?>円</p>
			<?php if ($value['lm04_pro_type'] == 1) { ?>
				<p>数量： <?php echo $value['quantity']; ?></p>
			<?php } ?>
			<br>
		<?php } ?>

		<p>-------------------------------------------------</p>
		<p>小　計　　<?php echo number_format($total_price_all_pro); ?>円</p>
		<p>運送料金　<?php echo number_format($fee_transport); ?>円</p>

		<?php if ($usb_money > 0) { ?>
		<p>USB 料金　<?php echo number_format($usb_money); ?>円</p>
		<?php } ?>

		<p>============================================</p>
		<p>合　計　　<?php echo number_format(round($total_price_all_pro + $usb_money + $fee_transport)); ?>円</p>

		<p>************************************************</p>
		<p>　お振込先</p>
		<p>************************************************</p>

		<p>口座: <?php echo $info['lm12_info_customer']; ?></p>
		<p>※口座種別は当座預金ですのでご注意ください※</p>

	</body>
</html>
