<div class="l-contents">
		<div class="p-contact">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>お知らせ詳細</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-contact_sec01">
				<div class="c-wrap relative">
					<div>
						<?php
						if(validation_errors() != ''){
							echo validation_errors(); }
						if(isset($error_message)){
							echo $error_message;
						}
						?>
					</div>
						<table class="table_form">
              <tr>
  							<th>日付</th>
  							<td>
                  <?=date('Y年m月d日',strtotime($news['lm16_news_date']))?>
  							</td>
  						</tr>
              <tr>
  							<th>タイトル</th>
  							<td>
                  <?=$news['lm16_news_title']?>
  							</td>
  						</tr>
              <tr>
  							<th>内容</th>
  							<td>
                  <?=$news['lm16_news_content']?>
  							</td>
  						</tr>
					</table>
          <p class="sunmit_form">
						<input type="button" name="btnNoSubmit" value="トップページへ" class="btn " onclick="location.href='<?=base_url()?>'">
					</p>

				</div>
			</section><!-- /.p-top__sec02 -->
			<!-- /.p-top__sec03 -->
		</div><!-- /.p-top -->
	</div><!-- /.l-contents -->
</script>
