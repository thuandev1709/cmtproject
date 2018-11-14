<style type="text/css">
	a {
		text-decoration: none !important;
	}
	div.info_cart_mini {
		text-align: center;
	}
	div.info_cart_mini_item {
		text-align: left;
	}
	a.link-cart {
		padding: 5px 30px!important;
		font-weight: 100;
		font-size: 14px;
		margin-right: 0px;
		background-color: buttonface;
	}
</style>
<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>写真区分一覧 </h3>
				<?php if ($this->session->flashdata('addCartFail')) { ?>
		        <div id="message">
		          <div class="w3-panel w3-red" style="padding: 15px 16px;">
		            <i class="fa fa-gratipay" aria-hidden="true"></i><?= $this->session->flashdata('addCartFail') ?>
		          </div>
		        </div>
		        <?php } ?>
			</div>
		</section>
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				<div class="info_row">

					<div class="info_cart_mini">
						<h5 class="info_cart_mini_title">カート</h5>
						<?php
							if(!empty($_SESSION['cart'])) { 
								$arr_cart = $_SESSION['cart'];
								foreach ($arr_cart as $item) { 
									if($item['lm04_pro_type'] == 1) { ?>
										<div class="info_cart_mini_item">
											<img src="<?=base_url()?>assets/img/demo.jpg">
											<p><?php echo '動画'.$item['lm04_pro_id'].'/'.$item['lm04_pro_name']; ?></p>
										</div>
									<?php }else { ?>
										<div class="info_cart_mini_item">
											<img src="<?php echo base_url() ?>upload/image/<?php echo $item['lm05_image_rename']; ?>" style="height: 40px;">
											<p><?php echo '写真'.$item['lm04_pro_id'].'/'.$item['lm04_pro_name']; ?></p>
										</div>
									<?php } ?>
								<?php } ?>

								<?php
									if ($this->session->userdata('user_id') == NULL) { ?> 
										<a href="<?=base_url('cart/cart_notlogin')?>" class="btn link-cart">
											購入する
										</a>
								<?php }else { ?>
										<a href="<?=base_url('cart/cart_login')?>" class="btn link-cart">
											購入する
										</a>
								<?php } ?>

						<?php }else { 
							echo '<span style="color: red">結果はありません。</span>'; 
						} ?>
					</div>


					<div class="info_list ">
						<table class="table_form">
							<tr>
								<th>イベントID</th>
								<td><?php if(isset($event)) echo $event['lm10_event_id_input']; ?></td>
								<th>残り時間</th>
								<?php
									$days = 0;
									if(isset($event)) {
										$date_end_event = strtotime($event['lm10_date_end']);
										$date_now = strtotime(date('Ymd'));

										$secs = $date_end_event - $date_now;
										$days = $secs / 86400;
									}
								?>
								<td><?php if($days > 0) echo $days; else echo 0; ?>日</td>
							</tr>
							<tr>
								<th>イベント名</th>
								<td colspan="3"><?php if(isset($event)) echo $event['lm10_event_name']; ?></td>

							</tr>
							<?php if(isset($product_details)) { ?>
								<tr>
									<form method="post" action="<?=base_url()?>cart/addtocart/<?php echo $product_details['lm04_pro_id'].'_dvd'; ?>">
										<td colspan="2" style="text-align: center;">
											<?php if(isset($product_details)) { ?>
												<video id="video_show" height="300" controls="" style="margin-top: 5px; max-width: 400px;">
							                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product_details['lm06_movie_rename']; ?>" type="video/avi">
							                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product_details['lm06_movie_rename']; ?>" type="video/flv">
							                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product_details['lm06_movie_rename']; ?>" type="video/mp4">
							                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product_details['lm06_movie_rename']; ?>" type="video/wmv">
							                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product_details['lm06_movie_rename']; ?>" type="video/mov">
							                      お使いのブラウザはHTML5ビデオをサポートしていません。
							                    </video>
												<p><?php echo 'DVD '.$product_details['lm04_pro_id']."/".$product_details['lm04_pro_name']; ?></p>
											<?php } ?>
										</td>
										<?php
											// echo '<pre>';
											// var_dump($_SESSION['cart']);

											$flag_add_to_cart = 0;
											$quantity_dvd_in_cart = 0;
											if (!empty($_SESSION['cart'])) {
												foreach ($_SESSION['cart'] as $vl) {
													if ($product_details['lm04_pro_id'] == $vl['lm04_pro_id']) {
														$quantity_dvd_in_cart = $vl['quantity'];
													}
												}
											}
											if ($quantity_dvd_in_cart > 10) {
												$flag_add_to_cart = 1;
											}
											
										?>
										<td colspan="2" style="vertical-align: middle;">
											<?php if($product_details['lm04_pro_quantity'] > 0) { ?>
												<label>枚数</label>
												<select name="quantity_dvd" id="quantity_dvd">
													<?php
													$quantity_dvd = 10;
													if ($product_details['lm04_pro_quantity'] < 10) {
														$quantity_dvd = $product_details['lm04_pro_quantity'];
													}
													for($q = 1; $q <= $quantity_dvd; $q ++) { ?>
														<option value="<?php echo $q; ?>"><?php echo $q; ?></option>
													<?php } ?>
												</select>
												<input type="submit" name="addtocart" id="addtocart" value="カートに追加する" class="btn" <?php if($flag_add_to_cart == 1) echo "disabled = disabled"; ?> >
												<?php 
													$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
												?>
												<input type="hidden" name="url" id="url" value="<?php echo $actual_link; ?>">
											<?php }else {
												echo '<span style="color: red;"> 在庫切れ </span>';
											} ?>
										</td>
									</form>
								</tr>
							<?php } ?>
						</table><br><br>
						
					</div>
				</div>
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->

<script>
	$("#message").delay(2000).fadeOut("fast");
</script>