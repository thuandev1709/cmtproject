<div class="l-contents">
		<div class="p-login">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>ログイン</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-login_sec01">
				<div class="c-wrap relative">
					<div class="p-login_sec01_formlogin">
						<p class="p-login_sec01_formlogin_avatar">
							<i class="fa fa-user-circle-o" aria-hidden="true"></i>
						</p>
						<?php 
							if(isset($error_message) && $error_message != ''){
								echo "<p style='color: red'>".$error_message."</p>";
							}
							if($this->session->flashdata('message')) {
								echo $this->session->flashdata('message');
							}
							
						?>

						<form  method="post" class="formlogin"> 
							<input type="email" name="account" placeholder="メールアドレス" required />
							<input type="password" name="password" placeholder="パスワード" required />
							<input type="submit" class="btn btn_login" name="btn-login" value="ログイン"  />
						</form>
						<p class="more">
							<a href="<?=base_url('account/forget')?>" class="forget">ログイン情報をお忘れですか？</a>
							<a href="<?=base_url('account/entry')?>" class="entry">新規会員登録</a>
						</p>
					</div>
				</div>
			</section><!-- /.p-top__sec02 -->
			<!-- /.p-top__sec03 -->
		</div><!-- /.p-top -->
	</div><!-- /.l-contents -->
