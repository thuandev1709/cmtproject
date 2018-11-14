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
								// echo '<pre>';
								// var_dump($arr_cart);
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
						</table><br><br>
						<div class="info_row">
							
							<?php if (!empty($list_category)) {
								foreach ($list_category as $item) {
									if ($item['type'] == 'dvd') { ?>
										
										<div class="item info_item3" style="text-align: center;">
											<form method="post" action="<?=base_url()?>cart/addtocart/<?php echo $item['id'].'_'.$item['type']; ?>">
												<a href="<?=base_url()?>cart/cartMoveDetail/<?php echo $item['event_id'].'_'.$item['id'] ?>" style="text-decoration: underline !important;">
													<img src="<?=base_url()?>assets/img/demo.jpg" style="width: 100%; height: 230px; object-fit: cover;">
													<p>動画<?php echo $item['id'].'/'.$item['name']; ?></p>
												</a>
												<p>値段（税込）：<?php echo number_format($item['price_tax']); ?>円</p><br>

												<?php if($item['pro_type'] == 1 && $item['quantity'] > 0) { ?>
													<input type="submit" name="addtocart" id="addtocart" value="カートに追加する" class="btn">
													<?php 
														$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
													?>
													<input type="hidden" name="url" id="url" value="<?php echo $actual_link; ?>">
												<?php }else {
													echo '<span style="color: red;"> 在庫切れ </span>';
												} ?>
											</form>
										</div>
										
									<?php } else { ?>
										<div class="item info_item3" style="text-align: center;">
											<a href="<?=base_url()?>cart/listProductByCateID/<?php echo $event['lm10_event_id'].'_'.$item['id'] ?>" style="text-decoration: underline !important;">
												<img src="<?=base_url()?>assets/img/img.png" style="width: 100%; height: 230px; object-fit: cover;">
												<p><?php echo $item['name']; ?></p>
											</a>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } ?>

						</div>

					</div>
				</div>
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->