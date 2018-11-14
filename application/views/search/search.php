

<div class="l-contents">
	<div class="p-contact">
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				
				
				<p>「<?php echo $key; ?>」で検索結果：</p>
				<div>
					<form method="" action="" id="">
						<input type="hidden" name="key" id="key" value="<?php echo $key; ?>">
						<a href="#have_img"><input type="button"  value="掲載中イベント" class="btn "></a>  <a href="#empty_img"><input type="button" value="掲載予定イベント" class="btn "></a>
					</form>
					
				</div>
				<br>
				<div id="empty_img">
					<h4 id="test1">掲載予定イベント</h4>
					<p class="count_list" id="count1"><?php echo $count_empty_img; ?>件です。</p>
					<table class="table_info" id="table1">
						<thead>
							<tr>
								<th style="width: 25%;">開催日</th>
								<th style="width: 25%;">イベントID</th>
								<th style="width: 25%;">イベント</th>
								<th style="width: 25%;">掲載予定</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($count_empty_img>0) { 
							 	foreach ($list_empty_img as $value) { ?>
							<tr>
								<td style="vertical-align: middle;text-align: center;"><?php echo $value['date_start']; ?></td>
								<td style="vertical-align: middle;text-align: center;"><?php echo $value['id_event_input']; ?></td>
								<?php
								if($this->session->userdata('user_id') != NULL){?>
								<td style="vertical-align: middle;text-align: center;"><a style="text-decoration: none" href="<?=base_url()?>search/confirm/<?php echo $value['id_event']; ?>"><?php echo $value['name_event']; ?></a></td>
								<?php }else{ ?>
									<td style="vertical-align: middle;text-align: center;"><a style="text-decoration: none" href="<?=base_url()?>account/login/<?php echo $value['id_event']; ?>/empty"><?php echo $value['name_event']; ?></a></td>
								<?php } ?>
								<td style="vertical-align: middle;text-align: center;"><?php echo $value['date_plan']; ?></td>
							</tr>
						<?php }}else{ ?>
							<td style="vertical-align: middle;text-align: center;color: red" colspan="5" >結果はありません。</td>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<br>
				<div id="have_img">
					<h4 id="test2">掲載中イベント</h4>
					<p id="count2"><?php echo $count_have_img; ?>件です。</p>
					<table class="table_info" id="table2">
						<thead>
							<tr>
								<th style="width: 25%;">開催日　</th>
								<th style="width: 25%;">イベントID</th>
								<th style="width: 25%;">イベント</th>
								<th style="width: 25%;">掲載期限</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($count_have_img>0) { 
							 	foreach ($list_have_img as $value) { ?>
							<tr>
								<td style="vertical-align: middle;text-align: center;"><?php echo $value['date_start']; ?></td>
								<td style="vertical-align: middle;text-align: center;"><?php echo $value['id_event_input']; ?></td>
								<?php
								if($this->session->userdata('user_id') != NULL){?>
								<td style="vertical-align: middle;text-align: center;"><a style="text-decoration: none" href="<?=base_url()?>page/checkPasswordEvent/<?php echo $value['id_event']; ?>"><?php echo $value['name_event']; ?></a></td>
								<?php }else{ ?>
									<td style="vertical-align: middle;text-align: center;"><a style="text-decoration: none" href="<?=base_url()?>account/login/<?php echo $value['id_event']; ?>/have"><?php echo $value['name_event']; ?></a></td>
								<?php } ?>
								<td style="vertical-align: middle;text-align: center;"><?php echo $value['date_end']; ?></td>
							</tr>
						<?php }}else{ ?>
							<td style="vertical-align: middle;text-align: center;color: red" colspan="5" >結果はありません。</td>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<br>
						
				
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->


