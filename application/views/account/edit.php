<div class="l-contents">
		<div class="p-contact">
			<section class="tile_page">
				<div class="c-wrap relative">
					<h3>アカウントの編集</h3>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-contact_sec01">
				<div class="c-wrap relative">
					<nav id="navi_list_box" class="local_nav favorite">
				    <ul id="navi_list">
								<li class=""><a href="mypage"><i class="fa fa-user" aria-hidden="true"></i> マイページ</a></li>
				        <li class="active"><a href="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> アカウントの編集</a></li>
		            <li class=""><a href="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a></li>
		            <li class=""><a href="secure"><i class="fa fa-lock" aria-hidden="true"></i> パスワードを変更する</a></li>
				        <li class=""><a href="<?=base_url('history')?>"><i class="fa fa-list-alt" aria-hidden="true"></i> 購入履歴</a></li>
				    </ul>
					</nav>
					<div>
						<?php
						if(validation_errors() != ''){
							echo validation_errors(); }
						if($this->session->flashdata('error')){
							echo $this->session->flashdata('error');
						}

						$zipcode = explode('-',$user['lm01_zipcode']);
						?>
					</div>
					<form action="" method = "POST" id="entry_form">
						<table class="table_form">

						<tr>
							<th class="table_form_haveto">お名前</th>
							<td>
								<input type="text" class="table_form_input_5" name="firstName" id="firstName" value="<?=$user['lm01_firstname']?>" placeholder="姓" data-validation="required" data-validation-error-msg-required="「姓」の入力を記入してください。">
								<input type="text" class="table_form_input_5" name="lastName" id="lastName" value="<?=$user['lm01_lastname']?>" placeholder="名" data-validation="required" data-validation-error-msg-required="「名」の入力を記入してください。">
							</td>
						</tr>
						<tr>
							<th class="table_form_haveto">お名前(フリガナ)</th>
							<td>
								<input type="text" class="table_form_input_5" name="phoneticName1" value="<?=$user['lm01_phonetic_name_1']?>" placeholder="セイ" data-validation="required" data-validation-error-msg-required="「セイ」の入力を記入してください。">
								<input type="text" class="table_form_input_5" name="phoneticName2" value="<?=$user['lm01_phonetic_name_2']?>" placeholder="メイ" data-validation="required" data-validation-error-msg-required="「メイ」の入力を記入してください。">
							</td>
						</tr>
						<tr>
							<th class="">会社名</th>
							<td>
								<input type="text" class="table_form_input_5" name="companyName" value="<?=$user['lm01_company_name']?>">
							</td>
						</tr>
						<tr>
							<th class="table_form_haveto">住所</th>
							<td>
								<p>〒 <input type="text" name="contact[zip][zip01]" onkeydown="return isNumberKey(event)" maxlength="3" value="<?=$zipcode[0]?>" data-validation="required" data-validation-error-msg-required="「Zipcode」の入力を記入してください。"> - <input type="text" name="contact[zip][zip02]" onkeydown="return isNumberKey(event)" maxlength="4" value="<?=$zipcode[1]?>" data-validation="required" data-validation-error-msg-required="「Zipcode」の入力を記入してください。"> <a class="question-circle" href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a></p>
								<p>
									<input type="button" id="zip-search" name="" value="郵便番号から自動入力">
								</p>
								<p>
									<select id="lm01_county" name="lm01_county" data-validation="required" data-validation-error-msg-required="オプションを選択してください。">
										<option value="">都道府県を選択</option>
										<?php $county_list = county_list();
										foreach($county_list as $key => $county){?>
											 <option value="<?=$county?>" <?php if($county == $user['lm01_county']){echo 'selected';} else {echo '';}?>><?=$county?></option>
										<?php } ?>
									</select>
								</p>
								<p>
									<input type="text" class="table_form_input_10" id="lm01_city" name="lm01_city" value="<?=$user['lm01_city']?>" placeholder="市区町村名 (例：千代田区神田神保町)" data-validation="required" data-validation-error-msg-required="「市区町村名」の入力を記入してください。">
								</p>
								<p>
									<input type="text" class="table_form_input_10" name="street" value="<?=$user['lm01_street']?>" placeholder="番地・ビル名 (例：1-3-5)">
								</p>
							</td>
						</tr>
						<tr>
							<th class="table_form_haveto">電話番号</th>
							<td>
								<input type="tel" name="phoneNumber1" id="phoneNumber1" value="<?=$user['lm01_phone_number_1']?>" onkeydown="return isNumberKey(event)" pattern="\d*" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。"> - <input type="tel" id="phoneNumber2" name="phoneNumber2" value="<?=$user['lm01_phone_number_2']?>" onkeydown="return isNumberKey(event)" pattern="\d*" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。"> - <input type="tel" id="phoneNumber3" name="phoneNumber3" value="<?=$user['lm01_phone_number_3']?>" onkeydown="return isNumberKey(event)" pattern="\d*" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。">
							</td>
						</tr>
						<tr>
							<th class="">FAX番号</th>
							<td>
								<input type="tel" name="faxNumber1" value="<?=$user['lm01_fax_number_1']?>"  pattern="\d*" onkeydown="return isNumberKey(event)"> - <input type="tel" name="faxNumber2" value="<?=$user['lm01_fax_number_2']?>"  pattern="\d*" onkeydown="return isNumberKey(event)"> - <input type="tel" name="faxNumber3" value="<?=$user['lm01_fax_number_3']?>"  pattern="\d*" onkeydown="return isNumberKey(event)">
							</td>
						</tr>
						<tr>
							<th class="">生年月日</th>
							<td>
								<!-- Year -->
								<?php
									$year_now = date('Y')-1;
								?>
								<select name="year_birthday" id="year_birthday">
									<option>----</option>
									<?php for ($year_birthday = $year_now; $year_birthday >= 1920; $year_birthday --) { ?>
										<option value="<?=$year_birthday?>" <?php if($year_birthday == date('Y',strtotime($user['lm01_birthday']))){echo 'selected';} else { echo ''; } ?> <?=set_select('year_birthday',$year_birthday)?>><?=$year_birthday?></option>
									<?php } ?>

								</select> /
								<!-- Month -->
								<select name="month_birthday" id="month_birthday">
									<option>--</option>
									<?php for ($month_birthday = 1; $month_birthday <= 12; $month_birthday ++) {
										if($month_birthday < 10){ $month_birthday = '0'.$month_birthday;}?>
										<option value="<?=$month_birthday?>" <?php if($month_birthday == date('m',strtotime($user['lm01_birthday']))){echo 'selected';} else { echo ''; } ?> <?=set_select('month_birthday',$month_birthday)?>><?=$month_birthday?></option>
									<?php } ?>
								</select> /
								<select name="day_birthday" id="day_birthday">
									<option>--</option>
									<?php for ($day_birthday = 1; $day_birthday <= 31; $day_birthday ++) {
										if($day_birthday < 10){ $day_birthday = '0'.$day_birthday;}?>
										<option value="<?=$day_birthday?>" <?php if($day_birthday == date('d',strtotime($user['lm01_birthday']))){echo 'selected';} else { echo ''; } ?> <?=set_select('day_birthday',$day_birthday)?>><?=$day_birthday?></option>
										<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="">性別</th>
							<td>
								<label><input type="radio" name="gender" value = "1" <?php if($user['lm01_sex'] == 1){echo 'checked';} else {echo '';} ?>> 男性</label>
								<label><input type="radio" name="gender"  value = "0" <?php if($user['lm01_sex'] == 0){echo 'checked';} else {echo '';} ?>> 女性</label>
							</td>
						</tr>
						<tr>
							<th class="">職業</th>
							<td>
								<select class="table_form_input_5" name = "job">
									<option>選択してください</option>
									<?php $job_list = job_list();
										foreach($job_list as $job){?>
										<option value="<?=$job?>"  <?php if($job == $user['lm01_job']){echo 'selected';} else { echo ''; } ?>><?=$job?></option>
									<?php } ?>

								</select>
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
