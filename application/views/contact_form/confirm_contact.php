<script>
	function backpagefrom(){
		$('#form_confirm').attr('action', '');
		$('#back').val('back');
		$('#form_confirm').submit();
	}
</script>
<div class="l-contents">
		<div class="p-contact">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>確認画面</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-contact_sec01">
				<div class="c-wrap relative">
					<p>内容によっては回答をさしあげるのにお時間をいただくこともございます。</p>
					<p>また、休業日は翌営業日以降の対応となりますのでご了承ください。</p>
					<hr>
					<form action="" method="post" id="form_confirm">
						<input type="hidden" name="back" id="back" value="">
						<table class="table_form">
							<tr>
								<th>お名前</th>
								<td>
									<p><?=$sender_name?></p>
									<input class="table_form_input_5" type="hidden" name="fist_name" id="fist_name" value="<?=$fist_name?>">
									<input class="table_form_input_5" type="hidden" name="last_name" id="last_name" value="<?=$last_name?>">
								</td>
							</tr>
							<tr>
								<th>住所</th>
								<td>
									<p>〒 <?=$fist_zipcode?> - <?=$last_zipcode?></p>
									<p><?=$county_box?></p>
									<p><?=$city?></p>
									<p><?=$street?></p>
									<input type="hidden" id="fist_zipcode" name="contact[zip][zip01]" value="<?=$fist_zipcode?>">
									<input type="hidden" id="last_zipcode" name="contact[zip][zip02]" value="<?=$last_zipcode?>"> 
									<input type="hidden" class="table_form_input_10" name="street" id="street" value="<?=$street?>">
									<input type="hidden" class="table_form_input_10" name="city" id="city" value="<?=$city?>">
									<input type="hidden" class="table_form_input_10" name="lm01_county" id="lm01_county" value="<?=$county_box?>">
								</td>
							</tr>
							<tr>
								<th>電話番号</th>
								<td>
									<?=$fist_phone?> - <?=$center_phone?> - <?=$last_phone?>
									<input type="hidden" name="fist_phone" id="fist_phone" value="<?=$fist_phone?>">
									<input type="hidden" name="center_phone" id="center_phone" value="<?=$center_phone?>">
									<input type="hidden" name="last_phone" id="last_phone" value="<?=$last_phone?>">
								</td>
							</tr>
							<tr>
								<th>メールアドレス</th>
								<td>
									<?=$email?>
									<input type="hidden" class="table_form_input_10" name="email" id="email" value="<?=$email?>">
								</td>
							</tr>
							<tr>
								<th>お問い合わせ内容</th>
								<td>
									<?=$content_mail?>
									<textarea id="content_email" name="content_email" style="display:none;"><?=$content_mail?></textarea>
								</td>
							</tr>
						</table>
						<p class="sunmit_form">
							<input type="button" name="" value="戻る" class="btn" onclick="backpagefrom();">
							<input type="button" name="" id ="submit_sendmail" value="送信する" class="btn btn_submit"></p>
					</form>
				</div>
			</section><!-- /.p-top__sec02 -->
			<!-- /.p-top__sec03 -->
		</div><!-- /.p-top -->
	</div><!-- /.l-contents -->

<script>
	$(document).on('click', '#submit_sendmail', function(event){  
    event.preventDefault(); 
   
	  	$.ajax({
	      url: 'contact/confirm',
	      type: 'POST',
	      data: $('#form_confirm').serialize(),
	      beforeSend: function () {
	          $('#submit_sendmail').attr('disabled', 'disabled');
	          $('#submit_sendmail').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i><span class="sr-only">Loading...</span> 送信中...');
	      },
	        success: function (data) {
	          if(data == 'ok'){
	            $('#submit_sendmail').removeAttr('disabled');
	            $('#submit_sendmail').html('確認ページへ');

		        window.location.href = 'contact/success';
	          } else{
	            $('#submit_sendmail').removeAttr('disabled');
	          }
	        }
	    })
	});
</script>
