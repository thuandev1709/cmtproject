
<div class="l-contents">
	<div class="p-contact">
		<!-- <section class="tile_page">
			<div class="c-wrap relative">
				<h3>トップページ </h3>
			</div>
		</section> -->
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
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
						<td><?php echo $days; ?>日</td>
					</tr>
					<tr>
						<th>イベント名</th>
						<td colspan="3"><?php if(isset($event)) echo $event['lm10_event_name']; ?></td>
					</tr>
				</table><br><br>
				<form method="post" action="<?php echo base_url() ?>Page/checkPasswordEvent/<?php if(isset($event)) echo $event['lm10_event_id']; ?>">
					<p>
						<label style="color: #DE5D50;font-weight: bold;">イベントパスワードを入力*</label>
						<input type="password" name="password_event" id="password_event" class="toppage_input_text" style="height: 37px;margin-right: 20px">
						
						<input type="submit" name="btnSubmitToList" value="商品の一覧へ" class="btn btn_submit">
						<?php if(isset($err)) echo '<span style="color:red;">'.$err.'</span>'; ?>
						
					</p>


					
					<br><br>
				</form>
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->

