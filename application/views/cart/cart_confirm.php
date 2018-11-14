<?php if(count(($data_input)) == 0) { redirect(base_url().'cart/cart_login'); } ?>
<style>
	.table_form td {
		width: 120px;
	}
</style>
<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>カート </h3>
			</div>
		</section>
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				<p>カートに<?= !empty($_arr_item_cart) ? count($_arr_item_cart) : 0 ?>枚が入っています。</p><br>
				<form method="POST" action="">
					<div class="info_row">
						<div class="info_payment info_60">
							<?php
								// echo '<pre>';
								// var_dump($_arr_item_cart);
								// die;
								$total_all = 0;
								$lm07_total_quantity = 0;
								if(!empty($_arr_item_cart)) {
									$total_record = 0;
									$flag_usb = 0;
									$usb_money = 0;
									$fee_transport = 0;
									foreach ($_arr_item_cart as $key => $item_cart) {
										$fee_transport = $item_cart['fee_transport'];
										if ($flag_usb == 0 && $item_cart['usb_money'] > 0) {
						            		$usb_money = $item_cart['usb_money'];
						            		$flag_usb = 1;
						            	}
										$total_record += 1;
										$lm07_total_quantity += (int)($item_cart['quantity']);	?>
											<div class="item_product">
												<table>
													<tr>
														<td rowspan="2" >
															<?php if($item_cart['lm04_pro_type'] == 1) { ?>
																<img src="<?=base_url()?>assets/img/demo.jpg" class="td_img" style="height: 60px; width: auto;">
															<?php } else { ?>
																<img src="<?php echo base_url() ?>upload/image/<?php echo $item_cart['lm05_image_rename']; ?>" style="height: 60px;">
															<?php } ?>
															<p><?= $item_cart['lm04_pro_id'] . '/'. $item_cart['lm04_pro_name']?></p>
														</td>

														<?php if($item_cart['lm04_pro_type'] == 1) { ?>
															<td>
																<label>枚数</label> <?= $item_cart['quantity'] ?>
															</td>
														<?php } ?>

														<td class="td_info">
															<p>値段(税込)：
																<?php 
																	$price_tax = round($item_cart['lm04_pro_price']+($item_cart['lm04_pro_price']*$item_cart['tax']/100));
																	echo number_format($price_tax).'円'; 
																?>
																<input type="hidden" id="sub_price_tax<?= $key ?>" name="price_tax_<?= $item_cart['lm04_pro_id'] ?>" value="<?php echo $price_tax; ?>">
															</p><br>
															<p>小計	
																<span id="subtotal_price_tax_text<?= $key ?>">
																	<?php
																		if($item_cart['lm04_pro_type'] == 1)
																			$price_tax = $price_tax*$item_cart['quantity'];
																		echo number_format($price_tax).'円';
																	?>
																</span>
																<?php
																	$total_all += $price_tax;
																?>
																<input type="hidden" id="subtotal_price_tax<?= $key ?>" value="<?php echo $price_tax; ?>">
															</p>
														</td>
													</tr>
												</table>
											</div>				
									<?php } ?> 
								<input type="hidden" id="total_record" value="<?php echo $key ?>">
								<input type="hidden" id="lm07_total_quantity" name="lm07_total_quantity" value="<?php echo $lm07_total_quantity ?>">
								<input type="hidden" id="lm07_total_price" name="lm07_total_price_tax" value="<?php echo $total_all+$usb_money+$fee_transport; ?>">
								<input type="hidden" name="total_record" value="<?php echo $total_record ?>">
								<input type="hidden" name="lm07_tax" value="<?php echo $item_cart['tax']; ?>">
								<div class="info_row">
									<table style="float: right;margin-right: 20px; ">
										<tr>
											<td>合計（税込）</td>
											<td class="total_price_tax"></td>
										</tr>
										<?php if($usb_money > 0) { ?>
											<tr>
												<td>USB 料金 </td>
												<td><?php echo number_format(round($usb_money))."円"; ?></td>
											</tr>
											<input type="hidden" id="flag_usb" value="1">
										<?php }else { ?>
											<input type="hidden" id="flag_usb" value="0">
										<?php } ?>
										<input type="hidden" id="usb_money" value="<?php echo $usb_money; ?>">
										<tr>
											<td>運送料金</td>
											<td><?php echo number_format(round($fee_transport)); ?>円</td>
											<input type="hidden" id="fee_transport" value="<?php echo round($fee_transport); ?>">
										</tr>
										<tr>
											<td>合計：</td>
											<td class="total_all"></td>
										</tr>
									</table>
								</div>
							<?php } ?>
						</div>
						<input type="hidden" id="usb_money" name="lm07_usb_money" value="<?php echo $usb_money ?>">
						<input type="hidden" id="fee_transport" name="lm07_fee_transport" value="<?php echo $fee_transport ?>">

						<div class="info_total_amount info_40">
							<table class="table_form">
							<tr>
								<td style="width: 30%">ご注文合計 :</td>
								<td style="width: 70%"><?php echo number_format($total_all+$usb_money+$fee_transport).'円' ?></td>
							</tr>
							<tr>
								<td style="width: 30%">お支払い方法：</td>
								<td style="width: 70%"><?= $data_input['payment'] == 1 ? 'カード決済' : '銀行振込' ?></td>
								<input type="hidden" name="payment" value="<?= $data_input['payment'] ?>">
							</tr>
							<tr>
								<td style="width: 30%">お届け先：</td>
								<td style="width: 70%">
									<p>名前: <?= ($data_input['address_cart']) == 0 ? $data_input['lastname_user'] :  $data_input['lm17_receiver_name'] ?></p>
									<p>住所: <?= ($data_input['address_cart']) == 0 ? $data_input['address_1'] :  $data_input['lm17_zipcode_1'].'-'.$data_input['lm17_zipcode_2'].' '.$data_input['lm17_address_1'].$data_input['lm17_address_2'] ?></p>
									<p>電話番号: <?= ($data_input['address_cart']) == 0 ? $this->session->userdata('tel') :  $data_input['lm17_phone_1'].'-'.$data_input['lm17_phone_2'].'-'.$data_input['lm17_phone_3'] ?></p>
								</td>
							</tr>
							
							<tr>
								<td colspan="2" align="center">
									<input type="submit" name="btn_submit" class="btn btn_submit" value="ご注文を確定する">
								</td>
							</tr>
						</table>
						</div>
					</div>
				</form>
				<!-- <p style="color: red">※振込手数料はお客様負担でお願い致します。</p>
				<p>※お振込名義人は（注文No）＋（お客様名）を入力してお振込ください。</p>
				<p>（例:　10000035グラフィック）</p><br>
				<p align="center"><input type="submit" name="" value="トップページへ" class="btn btn_submit"></p><br><br> -->
				
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->
<script type="text/javascript">
	$('.address_check').click(function(){
		var va = "";
		$('.address_check').each(function(){
			if($(this).prop('checked') == true )
				va = $(this).val();
		});

		if(va == 1){
			$('#address_detail').css('display', 'table-row');
			$('#address_oder').css('display', 'none');
		}else{
			$('#address_detail').css('display', 'none');
			$('#address_oder').css('display', 'table-row');
		}
	});

  	var total_record  = $('#total_record').val();
  	var fee_transport = $('#fee_transport').val();
  	var flag_usb      = $('#flag_usb').val();
  	if (flag_usb == 1) {
  		usb_money = $('#usb_money').val();
  	}else {
  		usb_money = 0;
  	}

	var arr_price_tax = [];
	var total_price_tax = 0;
	for (var i = 0; i <= total_record; i++) {
		arr_price_tax.push(parseInt($('#subtotal_price_tax'+i).val()) ||0);
	}
	$.each(arr_price_tax, function (index, value) {
		total_price_tax += value;
	});
	total_price_tax = Math.round(total_price_tax);
	$('.total_price_tax').text(total_price_tax.toLocaleString() + '円');

	total_all = total_price_tax - (-usb_money) - (-fee_transport);
	total_all = Math.round(total_all);
	console.log(total_all);

	var intRegex = /^\d+$/;
	var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

	if(intRegex.test(total_all) || floatRegex.test(total_all)) {
	   $('.total_all').text(total_all.toLocaleString() + '円');
	}

</script>
