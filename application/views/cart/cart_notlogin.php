
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
															<select id="quantity_<?= $key ?>" onclick="changeQuantity(<?= $key ?>)" style="width: 50px;">
																<?php 
																	$lm04_pro_quantity = $item_cart['lm04_pro_quantity'];
																	for ($i = 1; $i <= $lm04_pro_quantity; $i++) { ?> 
																		<option <?php if($item_cart['quantity'] == $i) echo 'selected = selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
																	<?php }
																?>
															</select>
														</td>
													<?php }else { ?>
														<td>
													<?php } ?>

													<td class="td_info">
														<p>値段(税込)：
															<?php 
																$price_tax = round($item_cart['lm04_pro_price']+($item_cart['lm04_pro_price']*$item_cart['tax']/100));
																echo number_format($price_tax).'円'; 
															?>
															<input type="hidden" id="sub_price_tax<?= $key ?>" value="<?php echo $price_tax; ?>">
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

						<?php  } ?>
						
					</div>
					<div class="info_total_amount info_40">
						<table class="table_form">
							<tr>
								<td>ご注文合計 :</td>
								<td class="total_all">0円</td>
							</tr>
							<tr>
								<td>会員の方</td>
								<td><a href="<?=base_url()?>account/login" class="btn ">ログイン</a></td>
							</tr>
							<tr>
								<td>はじめての利用の方</td>
								<td><a href="<?=base_url()?>account/entry" class="btn ">新規会員登録</a></td>
							</tr>
						</table>
					</div>
				</div>				
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->

<script>

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