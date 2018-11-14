<div class="l-contents">
		<div class="p-contact">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>メールを変更する</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-contact_sec01">
				<div class="c-wrap relative">
					<nav id="navi_list_box" class="local_nav favorite">
				    <ul id="navi_list">
								<li class=""><a href="mypage"><i class="fa fa-user" aria-hidden="true"></i> マイページ</a></li>
				        <li class=""><a href="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> アカウントの編集</a></li>
		            <li class="active"><a href="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a></li>
		            <li class=""><a href="secure"><i class="fa fa-lock" aria-hidden="true"></i> パスワードを変更する</a></li>
				        <li class=""><a href="<?=base_url('history')?>"><i class="fa fa-list-alt" aria-hidden="true"></i> 購入履歴</a></li>
				    </ul>
					</nav>
					<div>
						<?php
						if(validation_errors() != ''){
							echo validation_errors(); }
						if(isset($error_message)){
							echo $error_message;
						}
						?>
					</div>
					<form action="<?=base_url('account/email')?>" method = "POST" id="entry_form">
						<table class="table_form">
              <tr>
  							<th class="">現在のメールアドレス</th>
  							<td>
  								<?=$user['lm01_email']?>
  							</td>
  						</tr>
              <tr>
  							<th class="table_form_haveto">現在のパスワード</th>
  							<td>
  								<input type="password" class="table_form_input_10" name="current_password" value="" placeholder="現在のパスワードを入力してください" data-validation="required" data-validation-error-msg-required="現在のパスワードを入力を記入してください。">
  							</td>
  						</tr>
              <tr>
  							<th class="table_form_haveto">メールアドレス</th>
  							<td>
  								<input type="email" class="table_form_input_10" name="email" value="<?php echo set_value('email') ?>" data-validation="email" data-validation-error-msg-email="正しいメールアドレスを入力を記入してください。">
  								<input type="email" class="table_form_input_10" name="confirm_email" value="<?php echo set_value('confirm_email') ?>" placeholder="確認のためもう一度入力してください" data-validation="confirmation" data-validation-confirm="email" data-validation-error-msg-confirmation="「メールアドレス」は一致しません。">
  							</td>
  						</tr>
					</table>
					<p class="sunmit_form">
						<input type="button" name="btnNoSubmit" value="戻る" class="btn " onclick="location.href='mypage'">
						<input type="submit" name="btnSubmit" value="保存する" class="btn btn_submit" >
					</p>
					</form>

				</div>
			</section><!-- /.p-top__sec02 -->
			<!-- /.p-top__sec03 -->
		</div><!-- /.p-top -->
	</div><!-- /.l-contents -->

<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script>
  	function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode;
       if(charCode == 59 || charCode == 46)
        return true;
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
    }
    $(function() {
        $('#zip-search').click(function() {
            AjaxZip3.zip2addr('contact[zip][zip01]', 'contact[zip][zip02]', 'lm01_county', 'lm01_city');
        });
    });
	$.validate({
		modules : 'security',
		form : '#entry_form',
		lang: japan,
		validateOnBlur : true,
		showHelpOnFocus : true,
		addSuggestions : true,
	});
  $('.error-msg').show().delay(3000).fadeOut("fast");
	// $('#year_birthday, #month_birthday').on('change', function() {
	// 	var month_birthday = $('#month_birthday').val();
	// 	console.log($(this).val());
	// 	var year_datepicker = $('#year_birthday').val();
	//
	// 	var dateObj = new Date(year_datepicker, month_birthday, 0);
	// 	var day = dateObj.getUTCDate();
	//
	// 	// console.log(day);
  // 		$('#day_birthday').empty();
  // 		$("<option />").val('').text('').appendTo($('#day_birthday'));
  // 		for (var i = 1; i <= day+1; i++) {
	// 			if(i < 10) { i = '0'+i;}
  // 			$("<option />").val(i).text(i).appendTo($('#day_birthday'));
  // 		}
	// });
</script>
