<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<p><?php echo $firstname_user.' '.$lastname_user;?></p>

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
		foreach ($list_order_detail as $value) {
			$total_price_all_pro += $value['lm08_total_price'];
			$fee_transport = $value['lm07_fee_transport'];
			$usb_money = $value['lm07_usb_money'];
			$total = $value['lm08_total_price'];
		?>
			<p>商品コード: <?php echo $value['lm04_pro_id']; ?></p>
			<p>商品名: <?php echo $value['lm04_pro_name']; ?></p>
			<p>単価： <?php echo number_format($value['lm08_price']); ?>円</p>
			<?php if ($value['lm04_pro_type'] == 1) { ?>
				<p>数量： <?php echo $value['lm08_quantity']; ?></p>
			<?php } ?>
			<br>
			-----------
		<?php } ?>

		<p>-------------------------------------------------</p>
		<p>小　計　　<?php echo number_format($total_price_all_pro); ?>円</p>
		<p>運送料金　<?php echo number_format($fee_transport); ?>円</p>

		<?php if ($usb_money > 0) { ?>
		<p>送 料　 　<?php echo number_format($usb_money); ?>円</p>
		<?php } ?>

		<p>============================================</p>
		<p>合　計　　<?php echo number_format(round($total_price_all_pro + $fee_transport + $usb_money)); ?>円</p>

		<p>************************************************</p>
		<p>　お振込先</p>
		<p>************************************************</p>

		<p>【ゆうちょ銀行からのお手続き】</p>
		<p>口座記号番号：00560-1-51963 口座名義：サルーテ</p>

		<p>【ゆうちょ銀行以外からのお手続き】</p>
		<p>ゆうちょ銀行(9900) 〇五九支店(059) 当座 0051963</p>
		<p>口座名義：サルーテ</p>
		<p>※口座種別は当座預金ですのでご注意ください※</p>

	</body>
</html>
