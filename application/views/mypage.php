
<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>マイページ </h3>
				<?php
				if($this->session->flashdata('message')) {
					echo $this->session->flashdata('message');
				}
				?>
			</div>
		</section><!-- /.p-top__sec01 -->
		<section class="p-contact_sec01">

			<div class="c-wrap relative">
				<nav id="navi_list_box" class="local_nav favorite">
			    <ul id="navi_list">
					<li class="active"><a href="#"><i class="fa fa-user" aria-hidden="true"></i> マイページ</a></li>
			        <li class=""><a href="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> アカウントの編集</a></li>
	            	<li class=""><a href="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a></li>
	            	<li class=""><a href="secure"><i class="fa fa-lock" aria-hidden="true"></i> パスワードを変更する</a></li>
			        <li class=""><a href="<?=base_url('history')?>"><i class="fa fa-list-alt" aria-hidden="true"></i> 購入履歴</a></li>
			    </ul>
				</nav>
				<!-- <p><a href="edit" class="btn"> アカウントの編集</a></p><br>
				<p><a href="email" class="btn"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a></p><br>
				<p><a href="secure" class="btn"><i class="fa fa-lock" aria-hidden="true"></i> パスワードを変更する</a></p><br>
				<p><a href="<?=base_url('history')?>" class="btn"><i class="fa fa-list-alt" aria-hidden="true"></i> 購入履歴</a></p><br> -->
				<br>
				<p style="text-align: center">ようこそ ／ <?=$fullname?> 様</p>
				<br>
				<?php if(isset($order['lm07_order_id']) && !empty($order['lm07_order_id'])){ ?>
				<p>最新の注文書：</p>
				<table class="table_info">
					<thead>
						<tr>
							<th>日付</th>
							<th>購入ID</th>
							<th>金額</th>
							<th>決済方法</th>
							<th>状況</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<tr>
							<td>
								<?=substr($order['lm07_date_order'], 0,4).'年'.substr($order['lm07_date_order'], 4,2).'月'.substr($order['lm07_date_order'], 6,2).'日'?>
							</td>
							<td><a href="<?=base_url('history/detail/'.$order['lm07_order_id'])?>"><?=$order['lm07_order_id']?></a></td>
							<td><?=$order['lm07_total_price']?>円</td>
							<td><?=$order['lm13_method_name']?></td>
							<td>
								<?php
									if($order['lm07_pay_status'] == 0)
										echo '<span style="color: gray">決済待ち</span>';
									else
										echo '<span style="color: green">決済済み</span>';
								?>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<p align = "center"><input type="submit" value="すべての注文履歴を表示" class="btn btn_submit" onclick="location.href='<?=base_url('history');?>'"></p>
			<?php } else { echo 'ご注文履歴がありません。<br>'; }?>
				<br>
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->
<script>
$('.success-msg').show().delay(3000).fadeOut("fast");
</script>
