
<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>購入履歴詳細</h3>
			</div>
		</section>
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				<nav id="navi_list_box" class="local_nav">
					<ul id="navi_list">
							<li class=""><a href="<?=base_url('account/mypage')?>"><i class="fa fa-user" aria-hidden="true"></i> マイページ</a></li>
							<li class=""><a href="<?=base_url('account/edit')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> アカウントの編集</a></li>
							<li class=""><a href="<?=base_url('account/email')?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a></li>
							<li class=""><a href="<?=base_url('account/secure')?>"><i class="fa fa-lock" aria-hidden="true"></i> パスワードを変更する</a></li>
							<li class="active"><a href="<?=base_url('history')?>"><i class="fa fa-list-alt" aria-hidden="true"></i> 購入履歴</a></li>
					</ul>
				</nav>
				<form>
					<table class="table_form">
						<tr>
							<th>購入ID</th>
							<td colspan="3">
								<?php echo $data1['lm07_order_id'] ?>
							</td>
						</tr>
						<tr>
							<th>日付</th>
							<td colspan="3">
								<?php echo date('Y年m月d日', strtotime($data1['lm07_date_order'])); ?>
							</td>
						</tr>
						<tr>
							<th>金額</th>
							<td><?php echo number_format(round($data1['lm07_total_price'])) ?>円</td>
							<th>支払い方法：</th>
							<td><?php echo $data1['lm13_method_name'] ?></td>
						</tr>
						<tr>
							<th>支払い状況</th>
							<td colspan="3">
								<?php  if($data1['lm07_pay_status']==0){
									echo "<span style='color: gray'>決済待ち</span>";
								}elseif($data1['lm07_pay_status']==1){
									echo "<span style='color: orange'>決済済み</span>";
								}else{
									echo "<span style='color: green'>運送済み</span>";
								} ?>
							</td>
						</tr>
					</table><br><br>
					</form>
					<table class="table_info">
						<thead>
							<tr>
								<th>ID/商品名</th>
								<th>イベントID</th>
								<th>イベント名</th>
								<th>種類</th>
								<th>値段(税込)</th>
								<th>枚数</th>
								<th>金額</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_amount = 0;
							foreach ($data2 as $value):
								if($value['lm08_quantity'] > 0){
									$total = $value['lm08_quantity']*$value['lm08_price'];
								} else {
									$total = $value['lm08_price'];
								}

								$usb_price = $value['lm07_usb_money'];
								$fee_transport = $value['lm07_fee_transport'];
								$total_amount += $total;

								?>
								<tr>
									<td >
										<?php echo $value['lm08_pro_id'] ?> / <?php echo $value['lm04_pro_name'] ?>
									</td>
									<td><?php echo $value['lm10_event_id_input'] ?></td>
									<td><?php echo $value['lm10_event_name'] ?></td>
									<td><?php if( $value['lm04_pro_type'] == 0) echo '画像'; else echo 'DVD';?></td>
									<td><?php echo number_format(round($value['lm08_price'])).'円' ?> </td>
									<td><?php echo $value['lm08_quantity'] ?></td>
									<td> <?php echo number_format(round($total)).'円'; ?></td>
								</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="6">小計</td>
								<td><?=number_format(round($total_amount)).'円'?></td>
							</tr>
							<tr>
								<td colspan="6">運送料金</td>
								<td><?=number_format(round($fee_transport)).'円'?></td>
							</tr>
							<?php if($usb_price > 0) {?>
							<tr>
								<td colspan="6">USB 料金</td>
								<td><?=number_format(round($usb_price)).'円'?></td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="6">合計</td>
								<td><?=number_format(round($total_amount + $fee_transport + $usb_price)).'円'?></td>
							</tr>

						</tbody>
					</table>

				<br><br>
				<p align="center"><a href="<?=base_url()?>"><input type="submit" name="" value="トップページへ" class="btn btn_submit"></a></p><br><br>
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->
