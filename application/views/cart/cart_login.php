<?php if(empty($_SESSION['cart'])) { redirect(base_url()); } ?>
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
										?>
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
													<?php if($item_cart['lm04_pro_type'] == 1){ ?>
														<td>
															<label>枚数</label>
															<select id="quantity_<?= $key ?>" name="quantity_<?= $item_cart['lm04_pro_id'] ?>" onclick="changeQuantity(<?= $key ?>)" style="width: 50px;">
																<?php 
																		$lm04_pro_quantity = $item_cart['lm04_pro_quantity'];

																		$quantity_dvd = 10;
																		if ($item_cart['lm04_pro_quantity'] < 10) {
																			$quantity_dvd = $item_cart['lm04_pro_quantity'];
																		}
																		for($i = 1; $i <= $quantity_dvd; $i ++) { ?>
																		<option <?php if($item_cart['quantity'] == $i) echo 'selected = selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
																	<?php }
																?>
															</select>
														</td>
													<?php }else { ?>
														<td></td>
													<?php } ?>

													<td class="td_info">
														<p>値段(税込)：
															<?php 
																$price_tax = round($item_cart['lm04_pro_price']+($item_cart['lm04_pro_price']*$item_cart['tax']/100));
																echo number_format($price_tax).'円'; 
															?>
															<input type="hidden" id="sub_price_tax<?= $key ?>" name="price_tax_<?= $item_cart['lm04_pro_id'] ?>" value="<?php echo $price_tax; ?>">
														</p>
														<p>小計	
															<span id="subtotal_price_tax_text<?= $key ?>">
																<?php
																	if($item_cart['lm04_pro_type'] == 1)
																		$price_tax = $price_tax*$item_cart['quantity'];
																	echo number_format($price_tax).'円';
																?>
															</span>
															<input type="hidden" id="subtotal_price_tax<?= $key ?>" value="<?php echo $price_tax; ?>">
														</p>
													</td>

												</tr>

												<tr>
													<td colspan="2">
														<input type="button" class="btn btn_delete" onclick="deleteItem('<?= $key; ?>')" name="btn_delete" value="削除">
													</td>
												</tr>
											</table>
										</div>			
							<?php } ?> 
							<input type="hidden" id="total_record" value="<?php echo $key ?>">
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

						<div class="info_total_amount info_40">
							<table class="table_form">
								<tr>
									<td style="width: 30%">ご注文合計 :</td>
									<td class="total_all" style="width: 70%">0円</td>
								</tr>
								<tr>
									<td style="width: 30%">お支払い方法：</td>
									<td style="width: 70%">
										<label><input type="radio" name="payment" value="1" checked> カード決済</label><br>
										<label><input type="radio" name="payment" value="2"> 銀行振込</label>
									</td>
								</tr>
								<tr>
									<td style="width: 30%">お届け先：</td>
									<td style="width: 70%">
										<label><input type="radio" id="address_cart" name="address_cart" class="address_check" checked value="0"> 登録した住所</label><br>
										<label><input type="radio" id="address_cart" name="address_cart" class="address_check" value="1"> 別の住所</label>
									</td>
								</tr>
								<tr id="address_detail">
									<td colspan="2">
										<p><?= $this->session->userdata('lastname_user') ?></p>
										<input type="hidden" name="lastname_user" value="<?= $this->session->userdata('lastname_user') ?>">
										<p><?= $this->session->userdata('address') ?></p>
										<input type="hidden" name="address_1" value="<?= $this->session->userdata('address') ?>">
									</td>
								</tr>
								<tr id="delivery_address_new">
								</tr>
								<tr>
									<td colspan="2" align="center">
										<input type="submit" name="" class="btn btn_submit" value="確認画面へ">
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
	$(document).ready(function(){
		var address_cart = $("input[id='address_cart']:checked"). val();
		console.log(address_cart);
		if (address_cart == '1') {
			$html = '<td colspan="2">';
			$html += '<table class="table_form">';
			$html += '<tr>';
			$html += '<th>名前＊</th>';
			$html += '<td><input type="text" name="lm17_receiver_name" required></td>';
			$html += '</tr>';
			$html += '<tr>';
			$html += '<th>郵便番号＊</th>';
			$html += '<td>';
			$html += '<input type="text" name="lm17_zipcode_1" class="table_form_input_5">- <input type="text" name="lm17_zipcode_2" class="table_form_input_5" required>';
			$html += '</td>';
			$html += '</tr>';
			$html += '<tr>';
			$html += '<th>住所＊</th>';
			$html += '<td>';
			$html += '<p><label>都道府県市区町村名＊</label><textarea name="lm17_address_1" required></textarea></p>';
			$html += '<p><label>番地＊</label><input type="text" name="lm17_address_2" class="table_form_input_10" required></p>';
			$html += '</td>';
			$html += '</tr>';
			$html += '<tr>';
			$html += '<th>電話番号</th>';
			$html += '<td><input type="tel" name="lm17_phone_1" class="table_form_input_3">- <input type="tel" name="lm17_phone_2" class="table_form_input_3">- <input type="tel" name="lm17_phone_3" class="table_form_input_3"></td>';
			$html += '</tr>';
			$html += '</table>';
			$html += '</td>';
			$('#delivery_address_new').html($html);
			$('#address_detail').css('display', 'none');
		}else {
			$('#delivery_address_new').html('');
			$('#address_detail').css('display', 'table-row');
		}
	});


	$('input[type=radio][name=address_cart]').change(function() {
		console.log(this.value);
		if (this.value == '1') {
			$html = '<td colspan="2">';
			$html += '<table class="table_form">';
			$html += '<tr>';
			$html += '<th>名前＊</th>';
			$html += '<td><input type="text" name="lm17_receiver_name" required></td>';
			$html += '</tr>';
			$html += '<tr>';
			$html += '<th>郵便番号＊</th>';
			$html += '<td>';
			$html += '<input type="text" name="lm17_zipcode_1" class="table_form_input_5">- <input type="text" name="lm17_zipcode_2" class="table_form_input_5" required>';
			$html += '</td>';
			$html += '</tr>';
			$html += '<tr>';
			$html += '<th>住所＊</th>';
			$html += '<td>';
			$html += '<p><label>都道府県市区町村名＊</label><textarea name="lm17_address_1" required></textarea></p>';
			$html += '<p><label>番地＊</label><input type="text" name="lm17_address_2" class="table_form_input_10" required></p>';
			$html += '</td>';
			$html += '</tr>';
			$html += '<tr>';
			$html += '<th>電話番号</th>';
			$html += '<td><input type="tel" name="lm17_phone_1" class="table_form_input_3">- <input type="tel" name="lm17_phone_2" class="table_form_input_3">- <input type="tel" name="lm17_phone_3" class="table_form_input_3"></td>';
			$html += '</tr>';
			$html += '</table>';
			$html += '</td>';
			$('#delivery_address_new').html($html);
			$('#address_detail').css('display', 'none');
		}
		else {
			$('#delivery_address_new').html('');
			$('#address_detail').css('display', 'table-row');
		}
	});

	function deleteItem($id) {
		var uploading_text = '<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i>';
		$.ajax({
		    url: '<?=base_url()?>cart/cart_notlogin/',
		    data: {key_product:$id},
		    type: 'POST',
		    // beforeSend: function(){
		    //   $(".loading").addClass("pending_show");
		    //   $('.loading').html(uploading_text);
		    // },
		    success: function(data){
		    	location.reload();
			    //  var obj = JSON.parse(data);
			    // 	$('.info_payment').empty();
			    // 	$('.info_payment').html(obj.data_html);
		    },
		});
		// location.reload();
	}

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

	function changeQuantity($id) {
		$('#quantity_'+$id).change(function(){
		    var quantity       = $(this).val();
		    var lm04_pro_price = $('#sub_price_tax'+$id).val();
		    var subtotal       = quantity *lm04_pro_price;
		    $('#subtotal_price_tax_text' + $id).text(subtotal.toLocaleString() + '円');
		    $('#subtotal_price_tax' + $id).val(subtotal);

		    var total_record = $('#total_record').val();
		    var fee_transport = $('#fee_transport').val();
		    var flag_usb      = $('#flag_usb').val();
		  	if (flag_usb == 1) {
		  		usb_money = $('#usb_money').val();
		  	}else {
		  		usb_money = 0;
		  	}

			var arr_price_tax_new = [];
			for (var i = 0; i <= total_record; i++) {
				arr_price_tax_new.push(parseInt($('#subtotal_price_tax'+i).val()) ||0);
			}
			var total_price_tax = 0;
			$.each(arr_price_tax_new, function (index, value) {
				total_price_tax += value;
			});
			$('.total_price_tax').text(total_price_tax.toLocaleString() + '円');

			total_all = total_price_tax - (-usb_money) - (-fee_transport);
			$('.total_all').text(total_all.toLocaleString() + '円');

	  	});
	}
</script>
