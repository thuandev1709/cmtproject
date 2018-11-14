
<div class="l-contents">
		<div class="p-contact">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>お問い合わせ</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-contact_sec01">
				<?php if ($this->session->flashdata('category_success')) { ?>
        		<div style="margin-bottom: 20px;" class="c-wrap relative btn btn_submit" id="message"><?= $this->session->flashdata('category_success') ?></div>
          		<?php } ?>
				<div class="c-wrap relative">
					<p>内容によっては回答をさしあげるのにお時間をいただくこともございます。</p>
					<p>また、休業日は翌営業日以降の対応となりますのでご了承ください。</p>
					<hr>
					<form action="" method="POST" id="form_contact" name="form_contact">
						<table class="table_form">
						<tr>
							<th class="table_form_haveto">お名前</th>
							<td>
								<input class="table_form_input_5" type="text" name="fist_name" id="fist_name" placeholder="姓" data-validation="required" data-validation-error-msg-required="「姓」の入力を記入してください。" value="<?=$fist_name?>">
								<input class="table_form_input_5" type="text" name="last_name" id="last_name" placeholder="名" data-validation="required" data-validation-error-msg-required="「名」の入力を記入してください。" value="<?=$last_name?>">
							</td>
						</tr>
						<tr>
							<th>住所：</th>
							<td>
								<p>〒 <input type="tel" id="fist_zipcode" name="contact[zip][zip01]" onkeydown="return isNumberKey(event)" maxlength="3" value="<?=$fist_zipcode?>"> - <input type="tel" id="last_zipcode" name="contact[zip][zip02]" onkeydown="return isNumberKey(event)" maxlength="4" value="<?=$last_zipcode?>"> <a class="question-circle" href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a></p>
								<p>
									<input type="button" id="zip-search" name="" value="郵便番号から自動入力">
								</p>
								<p>
									<select id="lm01_county" name="lm01_county">
										<option value="">都道府県を選択</option>
										<?php $county_list = county_list();
										foreach($county_list as $county){?>
											 <option value="<?=$county?>" <?php if($county_box == $county){echo 'selected';}?>><?=$county?></option>
										<?php } ?>
									</select>
								</p>
								<p>
									<input type="text" class="table_form_input_10" name="city" id="city" value="<?=$city?>">
								</p>
								<p>
									<input type="text" class="table_form_input_10" name="street" id="street" value="<?=$street?>">
								</p>
							</td>
						</tr>
						<tr>
							<th>電話番号</th>
							<td>
								<input type="tel" name="fist_phone" id="fist_phone" onkeydown="return isNumberKey(event)" value="<?=$fist_phone?>" pattern="\d*"> - <input type="tel" name="center_phone" id="center_phone" onkeydown="return isNumberKey(event)" value="<?=$center_phone?>" pattern="\d*"> - <input type="tel" name="last_phone" id="last_phone" onkeydown="return isNumberKey(event)" value="<?=$last_phone?>" pattern="\d*">
							</td>
						</tr>
						<tr>
							<th class="table_form_haveto">メールアドレス</th>
							<td>
								<input style="border-radius: 5px;border: 1px solid #C4CCCE;padding-left: 10px;height: 40px;" type="email" class="table_form_input_10" name="email" id="email" data-validation="email" data-validation-error-msg-email="あなたは正しい電子メールアドレスを与えていません。" value="<?=$email?>">
							</td>
						</tr>
						<!-- <tr>
							<th>お問い合わせの種類</th>
							<td>
								<select class="table_form_input_10" id="question_type" name="question_type">
									<option value="" selected="selected">選択してください</option>
									<option value="商品に関するお問い合わせ">商品に関するお問い合わせ</option>
									<option value="ご注文に関するお問い合わせ">ご注文に関するお問い合わせ</option>
									<option value="販売店・サロンへの導入に関するお問い合わせ">販売店・サロンへの導入に関するお問い合わせ</option>
									<option value="その他">その他</option>
								</select>
							</td>
						</tr> -->
						<tr>
							<th class="table_form_haveto">お問い合わせ内容</th>
							<td>
								<textarea id="content_email" name="content_email" data-validation="required" data-validation-error-msg-required="「お問い合わせ内容」の入力を記入してください。"><?=$content_mail?></textarea>
								<p>	ご注文に関するお問い合わせには、必ず「ご注文番号」をご記入くださいますようお願いいたします。</p>
							</td>
						</tr>
					</table>
					<p class="sunmit_form"><button type="submit" id="submit_sendmail" name="btn_submit" class="btn btn_submit">確認ページへ</button></p>
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
            AjaxZip3.zip2addr('contact[zip][zip01]', 'contact[zip][zip02]', 'lm01_county', 'city');
        });
    });
    function validateEmail($email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( $email );
	}

	$.validate({
	  form : '#form_contact',
	  lang: japan,
	  validateOnBlur : true,
	  showHelpOnFocus : true,
	  addSuggestions : true
	});
	// $("#fist_phone, #center_phone, #last_phone").keydown(function (e) {
	// 	console.log(isNumberKey(e));
		
	// });
// $(document).on('click', '#submit_sendmail', function(event){  
//     event.preventDefault(); 
//     var first_name = $('#fist_name').val();
//     var last_name = $('#last_name').val();
//     var fist_zipcode = $('#fist_zipcode').val();
//     var last_zipcode = $('#last_zipcode').val();
//     var lm01_county  = $('#lm01_county').val();
//     var email = $('#email').val();
//     var question_type = $('#question_type').val();
//     var content_email = $('#content_email').val();
//     if(first_name == ''){
//     	swal({type: 'error',text: '「お名前」の入力を記入してください。'})
//     } else if(last_name == ''){
//     	swal({type: 'error',text: '「お名前」の入力を記入してください。'})
//     } else if(email == ''){
//     	swal({type: 'error',text: '「メールアドレス」の入力を記入してください。'})
//     } else if(!validateEmail(email)){
//     	swal({type: 'error',text: '「メールアドレス」形式を正確に記入してください。'})
//     } else if(content_email == ''){
//     	swal({type: 'error',text: '「お問い合わせ内容」の入力を記入してください。'})
//     } else {

//       $.ajax({
//           url: 'ajaxSendContact',
//           type: 'POST',
//           data: $('#form_contact').serialize(),
//           beforeSend: function () {
//               $('#submit_sendmail').attr('disabled', 'disabled');
//               $('#submit_sendmail').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i><span class="sr-only">Loading...</span> 送信中...');
//           },
//             success: function (data) {
//               if(data == 'ok'){
//                 $('#submit_sendmail').removeAttr('disabled');
//                 $('#submit_sendmail').html('確認ページへ');
//                 const toast = swal.mixin({
// 		          toast: true,
// 		          position: 'center',
// 		          showConfirmButton: false,
// 		          timer: 2500
// 		        });
// 		        toast({
// 		          type: 'success',
// 		          title: 'あなたの電子メールは正常に送信されました。',
// 		        });
// 		        setTimeout("location.reload();",2500);
//               } else{
//                 $('#submit_sendmail').removeAttr('disabled');
//               }
//             }
//         })
//   	}	
// });
</script>
