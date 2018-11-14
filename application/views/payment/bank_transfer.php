
<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>カード決済 </h3>
			</div>
		</section>
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				<div class="info_row">
					<div class="info_payment">
						<p>振込口座</p>
						<ul>
							<li><?= $info_company['lm12_info_customer'] ?></li>
						</ul>
					</div>
					<div class="info_total_amount">
						<table class="table_info">
							<tr>
								<td>ご注文合計 :</td>
								<td><?= number_format($_SESSION['lm07_total_price']) ?> 円</td>
							</tr>
							<tr>
								<td>注文No</td>
								<td><?= $_SESSION['order_id'] ?></td>
							</tr>
							<tr>
								<td>お支払い方法：</td>
								<td>銀行振込</td>
							</tr>
						</table>
					</div>
				</div>
				<p style="color: red">※振込手数料はお客様負担でお願い致します。</p>
				<p>※お振込名義人は（注文No）＋（お客様名）を入力してお振込ください。</p>
				<p>（例:　10000035グラフィック）</p><br>
				<p align="center"><a href="<?= base_url() ?>" class="btn btn_submit" >トップページへ</a></p><br><br>
				
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->

