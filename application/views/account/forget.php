
<div class="l-contents">
		<div class="p-contact">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>パスワードの再発行</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-contact_sec01">
				<div class="c-wrap relative">
					<p>ご登録時のメールアドレスを入力して「次へ」ボタンをクリックしてください。</p>
					<p>※新しくパスワードを発行いたしますので、お忘れになったパスワードはご利用できなくなります。</p>
					<hr>
					<?php
						if(validation_errors() != ''){
							echo validation_errors(); }
						if(isset($message)) {
							echo $message;
						}
					?>
					<form action="" method="post" id="forget_form">
						<table class="table_form">
							
							<tr>
								<th class="table_form_haveto">メールアドレス</th>
								<td>
									<input type="text" class="table_form_input_10" id="user_email" name="user_email" value="<?=set_value('user_email')?>" data-validation="email" data-validation-error-msg-email="あなたは正しい電子メールアドレスを与えていません。">
								</td>
							</tr>
							
						</table>
						<p class="sunmit_form"><input type="submit" name="send_new_password_btn" value="次のページへ" class="btn btn_submit"></p>
					</form>
				</div>
			</section><!-- /.p-top__sec02 -->
			<!-- /.p-top__sec03 -->
		</div><!-- /.p-top -->
	</div><!-- /.l-contents -->

<script type="text/javascript">
	$.validate({
		modules : 'security',
		form : '#forget_form',
		lang: japan,
		validateOnBlur : true,
		showHelpOnFocus : true,
		addSuggestions : true,
	});
</script>

