<div id="main">
      <section class="sec01">
        <h3 class="tt_main">新規会員登録</h3>
        <div class="research_box">
            <div>
              <?php
              if(validation_errors() != ''){
                echo validation_errors(); }
              if(isset($message)){
                echo $message;
              }
              ?>
            </div>
          <form method="POST" action="<?php echo base_url() ?>admin/User/add" id="add_user_form">
            <table class="mb20 formtable">
              <tr>
                <th class="notnull">お名前</th>
                <td>
                  <input type="text" class="input_50"  id="parent_name"  name="firstName" value="<?php echo set_value('firstName') ?>" placeholder="姓" data-validation="required" data-validation-error-msg-required="「姓」の入力を記入してください。">
                  <input type="text" class="input_50"  id="parent_name"  name="lastName" value="<?php echo set_value('lastName') ?>" placeholder="名" data-validation="required" data-validation-error-msg-required="「名」の入力を記入してください。">
                </td>
              </tr>
              <tr>
                <th class="notnull">お名前(フリガナ)</th>
                <td>
                  <input type="text" class="input_50" id="parent_name"  name="phoneticName1" value="<?php echo set_value('phoneticName1') ?>" placeholder="セイ" data-validation="required" data-validation-error-msg-required="「セイ」の入力を記入してください。">
                  <input type="text" class="input_50" id="parent_name"  name="phoneticName2" value="<?php echo set_value('phoneticName2') ?>" placeholder="メイ" data-validation="required" data-validation-error-msg-required="「メイ」の入力を記入してください。">
                </td>
              </tr>
              <tr>
                <th class="">会社名</th>
                <td>
                  <input type="text" class="input_50" name="companyName" id="parent_name" value="<?php echo set_value('companyName') ?>" >
                </td>
              </tr>
              <tr>
                <th class="notnull">住所</th>
                <td class="inputs_data">
                  <p>
                    〒 <input type="text" class="input_20" name="contact[zip][zip01]" value="<?php echo set_value('contact[zip][zip01]') ?>"  onkeypress="return isNumberKey(event)" maxlength="3" data-validation="required" data-validation-error-msg-required="「Zipcode」の入力を記入してください。"> - <input type="text" class="input_20" name="contact[zip][zip02]" value="<?php echo set_value('contact[zip][zip02]') ?>" onkeypress="return isNumberKey(event)" maxlength="4" data-validation="required" data-validation-error-msg-required="「Zipcode」の入力を記入してください。">
                    <a class="question-circle" href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a>
                  </p>
                  <p>
                    <input type="button" class="btn" id="zip-search" value="郵便番号から自動入力">
                  </p>
                  <p>
                      <select id="lm01_county" name="lm01_county" data-validation="required" data-validation-error-msg-required="オプションを選択してください。">
                        <option value="">都道府県を選択</option>
                        <?php $county_list = county_list();
                        foreach($county_list as $county){?>
                           <option value="<?=$county?>"><?=$county?></option>
                        <?php } ?>
                      </select>
                  </p>
                  <p>
                    <input type="text" name="lm01_city" id="lm01_city" value="<?php echo set_value('lm01_city') ?>" placeholder="市区町村名 (例：千代田区神田神保町)" data-validation="required" data-validation-error-msg-required="「市区町村名」の入力を記入してください。">
                  </p>
                  <p>
                    <input type="text" name="street" id="street" value="<?php echo set_value('street') ?>" placeholder="番地・ビル名 (例：1-3-5)">
                  </p>
                </td>
              </tr>
              <tr>
                <th class="notnull">電話番号</th>
                <td>
                  <input type="text" class="input_20" name="phoneNumber1" id="parent_name" value="<?php echo set_value('phoneNumber1') ?>" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="phoneNumber2" id="parent_name" value="<?php echo set_value('phoneNumber2') ?>" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="phoneNumber3" id="parent_name" value="<?php echo set_value('phoneNumber3') ?>" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。" onkeypress="return isNumberKey(event)">
                </td>
              </tr>
              <tr>
                <th class="">FAX番号</th>
                <td>
                  <input type="text" class="input_20" name="faxNumber1" id="parent_name" value="<?php echo set_value('faxNumber1') ?>" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="faxNumber2" id="parent_name" value="<?php echo set_value('faxNumber2') ?>" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="faxNumber3" id="parent_name" value="<?php echo set_value('faxNumber3') ?>" onkeypress="return isNumberKey(event)">
                </td>
              </tr>
              <tr>
                <th class="notnull">メールアドレス</th>
                <td class="inputs_data">
                  <p>
                    <input type="text" name="email" id="parent_name" value="<?php echo set_value('email') ?>" placeholder="" data-validation="email" data-validation-error-msg-email="あなたは正しい電子メールアドレスを与えていません。">
                  </p>
                  <p>
                    <input type="text" name="confirm_email" id="parent_name" value="<?php echo set_value('confirm_email') ?>" placeholder="確認のためもう一度入力してください" data-validation="confirmation" data-validation-confirm="email" data-validation-error-msg-confirmation="「メールアドレス」は一致しません。">
                  </p>
                </td>
              </tr>
              <tr>
                <th class="notnull">パスワード</th>
                <td class="inputs_data">
                  <p>
                    <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="半角英数字記号8～32文字" data-validation="length" data-validation-length="min8" data-validation-error-msg-length="入力値が8文字未満です">
                  </p>
                  <p>
                    <input type="password" name="repass" id="repass" value="<?php echo set_value('repass') ?>" placeholder="確認のためもう一度入力してください " data-validation="confirmation" data-validation-confirm="password"  data-validation-error-msg-confirmation="「パスワード」は一致しません。">
                  </p>
                </td>
              </tr>
              <tr>
                <th class="">生年月日</th>
                <td>
                  <?php
                    $year_now = date('Y')-1;
                  ?>
                      <select name="year_birthday" id="year_birthday" required>
                        <option value="">----</option>
                        <?php for ($year_birthday = $year_now; $year_birthday >= 1920; $year_birthday --) { ?>
                          <option value="<?php echo $year_birthday; ?>" <?=set_select('year_birthday',$year_birthday)?>><?php echo $year_birthday; ?></option>
                        <?php } ?>
                      </select> /
                    <!-- Month -->
                      <select name="month_birthday" id="month_birthday" required>
                        <option value="">--</option>
                        <?php for ($month_birthday = 1; $month_birthday <= 12; $month_birthday ++) {
                          if($month_birthday < 10){ $month_birthday = '0'.$month_birthday;}?>
                          <option value="<?php echo $month_birthday; ?>" <?=set_select('month_birthday',$month_birthday)?>><?php echo $month_birthday; ?></option>
                        <?php } ?>
                      </select> /
                      <select name="day_birthday" id="day_birthday" required>
                        <option value="">--</option>
                      </select>
                </td>
              </tr>
              <tr>
                <th>性別</th>
                <td>
                  <label><input type="radio" name="gender" value="1" <?=set_radio('gender','1',TRUE)?>>男性 </label>
                  <label><input type="radio" name="gender" value="0" <?=set_radio('gender','0')?>>女性 </label>
                </td>
              </tr>
              <tr>
                <th>職業</th>
                <td class="inputs_data">
                  <p>
                      <select class="table_form_input_5" name = "job">
                        <option>選択してください</option>
                        <?php $job_list = job_list();
                        foreach($job_list as $job){?>
                           <option value="<?=$job?>"  <?=set_select('job',$job)?>><?=$job?></option>
                        <?php } ?>
                      </select>
                  </p>
                </td>
              </tr>
              <tr>
                <th>状態</th>
                <td>
                  <label><input type="radio" name="status" value="1" <?=set_radio('status','1',TRUE)?>>アクティブ </label>
                  <label><input type="radio" name="status" value="0" <?=set_radio('status','0')?>>インアクティブ </label>
                </td>
              </tr>
              <!-- <tr>
                <th>レベル</th>
                <td>
                  <div class="clearfix sel_box">
                    <select name="level" id="level">
                      <option value="0" <?=set_select('level','0')?>>0</option>
                      <option value="1" <?=set_select('level','1')?>>1</option>
                    </select>
                  </div>
                </td>
              </tr> -->
<!--               <tr>
                <th></th>
                <td >
                  <label>
                    <input type="checkbox" name="chkCheck" id="chkCheck" > <a href="#">利用規約</a>に同意してお進みください</label>
                </td>
              </tr> -->

            </table>
            <div class="form_button form_button02 clearfix">
              <input type="submit" class="btn btn_update" value="保存する" name="btnSubmit">
              <!-- <a href="<?=base_url()?>admin/level/">
                <input type="button" class="btn btn_delete" value="同意しない" name="btnNoSubmit">
              </a> -->
            </div>
          </form>
        </div>
      </section>
       <!-- end sec01 -->
    </div><!-- main -->
  </div>

  <footer>

  </footer>
</div>
<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script>
  $.validate({
    modules : 'security',
    form : '#add_user_form',
    validateOnBlur : true,
    showHelpOnFocus : true,
    addSuggestions : true,
  });
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

  $('#year_birthday, #month_birthday').on('change', function() {
    var month_birthday = $('#month_birthday').val();
    console.log($(this).val());
    var year_datepicker = $('#year_birthday').val();

    var dateObj = new Date(year_datepicker, month_birthday, 0);
    var day = dateObj.getUTCDate();

    // console.log(day);
      $('#day_birthday').empty();
      $("<option />").val('').text('').appendTo($('#day_birthday'));
      for (var i = 1; i <= day+1; i++) {
        if(i < 10) { i = '0'+i;}
        $("<option />").val(i).text(i).appendTo($('#day_birthday'));
      }
  });

  $("#chkCheck").click(function() {
      if($("#chkCheck").prop("checked") == true) {
          $(".btn_submit").removeAttr("disabled");
      }else {
          $(".btn_submit").attr("disabled", '');
      }
  });

  $(document).ready(function() {
      $("#phoneNumber1, #phoneNumber2, #phoneNumber3").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          console.log(e.keyCode);
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
               // Allow: Ctrl+A, Command+A
              (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
               // Allow: home, end, left, right, down, up
              (e.keyCode >= 35 && e.keyCode <= 40)) {
                   // let it happen, don't do anything
                   return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
  });

  $('.m_user').addClass('active');
  $('.m_user').find('ul').addClass('active');
  $('.parents_class_add').addClass('active');
</script>
</body>
</html>
