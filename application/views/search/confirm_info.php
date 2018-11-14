
<div class="l-contents">
	<div class="p-contact">
		<!-- <section class="tile_page">
			<div class="c-wrap relative">
				<h3>トップページ </h3>
			</div>
		</section> -->
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				<h4>このイベントは掲載準備中です</h4>
				<p>メールアドレスをご登録いただくと、イベント公開後に公開通知メールをお送りします。</p><br><br>
				<form action="<?php echo base_url().'search/confirm_info' ?>" method="post">

				<input type="hidden"  name="id_event1" class="toppage_input_text"  value="<?=$id_event?>" >

				<table class="table_form">
					<tr>
						<th>メールアドレス:</th>
						<td>
							<input type="hidden"  name="mail1"  value="<?=$email ?>" />
							<?=$email ?>
						</td>
					</tr>
					<tr>
						<th>イベント参加者とのご関係:</th>
						<td>
							<input style="background:transparent;border-top:transparent !important;border-left:transparent !important;border-right: transparent!important;border-bottom:transparent !important;" readonly name="confirm1"  value="<?php if($confirm==1){
								echo "本人";
							}else if($confirm==2){
								echo "関係者";
							}else if($confirm==0){
								echo "無関係";
							}  ?>" />
							
						</td>
						
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="btn" class="btn btn_submit" value="送信する">
						</td>
					</tr>
				</table>
				</form>
				
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->

