
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

				<form action="<?php echo base_url().'search/confirm_info' ?>" method="post" >
					
				
				<table class="table_form">
					<tr>
						<th>メールアドレスをご入力ください。*</th>
						<td>
							<input type="hidden" id="id_event" name="id_event" class="toppage_input_text"  value="<?=$id_event?>" >
							<input type="email" id="email" name="email" class="toppage_input_text"  required >
							<p style="color: red" id="mail-result"></p>
						</td>
						
					</tr>

					

					<tr>
						<th>イベント参加者とのご関係*</th>
						<td>
							<label><input value="1" type="radio" name="confirm" > 本人</label> 
							<label><input value="2" type="radio" name="confirm" checked> 関係者</label> 
							<label><input value="0" type="radio" name="confirm"> 無関係</label> 
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" id="button">
							<input type="submit" name="sub" class="btn btn_submit" value="確認画面へ">
							
						</td>
					</tr>
				</table>
				
			</form>	
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->

<script >
      $(document).ready(function(){
        $("#email").keyup( function(e){
          e.preventDefault();
            $.ajax({
              url:"<?php echo base_url() ?>Search/check_mail",
              type:"POST",
              data:{'email':email.value},
              success: function(data){
              $('#mail-result').html(data);
              var test = $('#mail-result').html();
              if (test!='') {
                $('#button').html("<input type='button' class='btn btn_submit 'value='確認画面へ'>");
              }else{
                $('#button').html("<input type='submit' class='btn btn_submit 'value='確認画面へ' name='sub' >");
              }
              },
              error: function(){
              alert("Error"); 
              }
            });
          
        });
      });
    </script>

