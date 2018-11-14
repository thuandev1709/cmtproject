<style type="text/css">
	a {
		text-decoration: none !important;
	}
	
	div.mfp-content ,
	div.watermarked,
	div.watermarked:hover {
	  position: relative;
	  overflow: hidden;
	}
	
	div.watermarked img,
	div.watermarked img:hover {
	  width: 100%;
	  opacity: 1 !important;
	}
	
	div.watermarked::before,
	div.watermarked:hover ::before {
	  position: absolute;
	  top: -75%;
	  left: -75%;
	  
	  display: block;
	  width: 150%;
	  height: 150%;
	  
	  transform: rotate(-45deg);
	  content: attr(data-watermark);
	  
	  opacity: 0.3;
	  line-height: 7em;
	  letter-spacing: 2px;
	  word-spacing: 30px;
	  color: #fff;
	}

	div.mfp-figure:before {
		position: absolute;
		top: -49%;
	    left: -27%;
	    display: block;
	    width: 155%;
	    height: 200%;
	    transform: rotate(-45deg);
	    content: 'コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止 コピー及び写真転載禁止';
	    opacity: 0.3;
	    line-height: 9em;
	    letter-spacing: 5px;
	    word-spacing: 30px;
	    color: #fff;
	    font-size: 1.6em;
	}
	
	div.mfp-figure {
		position: relative;
	}
	figure:before {
		font-family: FontAwesome;
		position: absolute;
	    display: block;
	    content: "\f05e コピー及び写真転載禁止";
	    opacity: 0.5;
	    letter-spacing: 0;
	    color: #fff;
	    font-size: 2.5em;
	    bottom: 15%;
	    right: 5%;
	    font-weight: bold;
	}

	/*Popup image*/
	.image-link {
	  cursor: -webkit-zoom-in;
	  cursor: -moz-zoom-in;
	  cursor: zoom-in;
	}
	/* This block of CSS adds opacity transition to background */
	.mfp-with-zoom .mfp-container,
	.mfp-with-zoom.mfp-bg {
		opacity: 0;
		-webkit-backface-visibility: hidden;
		-webkit-transition: all 0.3s ease-out; 
		-moz-transition: all 0.3s ease-out; 
		-o-transition: all 0.3s ease-out; 
		transition: all 0.3s ease-out;
	}
	.mfp-with-zoom.mfp-ready .mfp-container {
			opacity: 1;
	}
	.mfp-with-zoom.mfp-ready.mfp-bg {
			opacity: 0.8;
	}
	.mfp-with-zoom.mfp-removing .mfp-container, 
	.mfp-with-zoom.mfp-removing.mfp-bg {
		opacity: 0;
	}
	/* padding-bottom and top for image */
	.mfp-no-margins img.mfp-img {
		padding: 0;
	}
	/* position of shadow behind the image */
	.mfp-no-margins .mfp-figure:after {
		top: 0;
		bottom: 0;
	}
	/* padding for main container */
	.mfp-no-margins .mfp-container {
		padding: 0;
	}
	/* aligns caption to center */
	.mfp-title {
	  text-align: center;
	  padding: 6px 0;
	}
	.image-source-link {
	  color: #DDD;
	}
</style>
<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>写真区分一覧 </h3>
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
								<td><?php if(isset($event)) echo $event['lm10_event_name']; ?></td>
								<th>写真区分名:</th>
								<td><?php if(isset($name_cate)) echo $name_cate; ?></td>
							</tr>
							<?php if(isset($product_details)) { ?>
								<tr>
									<td colspan="2" style="text-align: center;">
										<div class="watermarked" data-watermark="コピー及び写真転載禁止" oncontextmenu="return false;">
											<a href="<?php echo base_url() ?>upload/image/<?php echo $product_details['lm05_image_rename']; ?>" class="without-caption image-link">
												<img src="<?php echo base_url() ?>upload/image/<?php echo $product_details['lm05_image_rename']; ?>" style="height: 300px; width: auto;"/>  
											</a>
										</div>
										<p><?php echo "写真".$product_details['lm04_pro_id']."/".$product_details['lm04_pro_name']; ?></p>
									</td>
									<td style="vertical-align: middle;">
										<form method="post" action="<?=base_url()?>cart/addtocart/<?php echo $product_details['lm04_pro_id'].'_img'; ?>">

											<?php
												$disabled = '';
												if(!empty($_SESSION['cart'])) { 
													$arr_cart = $_SESSION['cart'];
													foreach ($arr_cart as $vl) { 
														if($vl['lm04_pro_id'] == $product_details['lm04_pro_id']) {
															$disabled = 'disabled="disable"';
														}
													}
												}
											?>

											<input type="submit" name="addtocart" id="addtocart" value="カートに追加する" class="btn" <?php echo $disabled; ?> style="margin-left: 20px;">
											<?php 
												$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
											?>
											<input type="hidden" name="url" id="url" value="<?php echo $actual_link; ?>">
										</form>
									</td>
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
	Array.from(document.querySelectorAll('.watermarked')).forEach(function(el) {
	 	el.dataset.watermark = (el.dataset.watermark + ' ').repeat(100);
	});

    $('.without-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-no-margins mfp-with-zoom',
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 200
		}
	});

	$('.watermarked').on('click', function() {
		$(".mfp-container.mfp-s-ready.mfp-image-holder").attr("oncontextmenu", "return false;");
	});

</script>