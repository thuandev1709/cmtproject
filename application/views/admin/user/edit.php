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
          <form method="POST" action="" id="add_user_form">
            <table class="mb20 formtable">
              <tr>
                <th class="notnull">お名前</th>
                <td>
                  <input type="text" class="input_50"  id="parent_name"  name="firstName" value="<?=$user['lm01_firstname']?>" placeholder="姓" data-validation="required" data-validation-error-msg-required="「姓」の入力を記入してください。">
                  <input type="text" class="input_50"  id="parent_name"  name="lastName" value="<?=$user['lm01_lastname']?>" placeholder="名" data-validation="required" data-validation-error-msg-required="「名」の入力を記入してください。">
                </td>
              </tr>
              <tr>
                <th class="notnull">お名前(フリガナ)</th>
                <td>
                  <input type="text" class="input_50" id="parent_name"  name="phoneticName1" value="<?=$user['lm01_phonetic_name_1']?>" placeholder="セイ" data-validation="required" data-validation-error-msg-required="「セイ」の入力を記入してください。">
                  <input type="text" class="input_50" id="parent_name"  name="phoneticName2" value="<?=$user['lm01_phonetic_name_2']?>" placeholder="メイ" data-validation="required" data-validation-error-msg-required="「メイ」の入力を記入してください。">
                </td>
              </tr>
              <tr>
                <th class="">会社名</th>
                <td>
                  <input type="text" class="input_50" name="companyName" id="parent_name" value="<?=$user['lm01_company_name']?>" >
                </td>
              </tr>
              <tr>
                <th class="notnull">住所</th>
                <td class="inputs_data">
                  <p>
                    <?php
                      $zipcode = explode('-',$user['lm01_zipcode']);
                    ?>
                    〒 <input type="text" class="input_20" name="contact[zip][zip01]" value="<?=$zipcode[0]?>"  onkeypress="return isNumberKey(event)" maxlength="3" data-validation="required" data-validation-error-msg-required="「Zipcode」の入力を記入してください。"> - <input type="text" class="input_20" name="contact[zip][zip02]" value="<?=$zipcode[1]?>" onkeypress="return isNumberKey(event)" maxlength="4" data-validation="required" data-validation-error-msg-required="「Zipcode」の入力を記入してください。">
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
                           <option value="<?=$county?>" <?php if($county == $user['lm01_county']){echo 'selected';} else {echo '';}?>><?=$county?></option>
                        <?php } ?>
                      </select>
                  </p>
                  <p>
                    <input type="text" name="lm01_city" id="lm01_city" value="<?=$user['lm01_city']?>" placeholder="市区町村名 (例：千代田区神田神保町)" data-validation="required" data-validation-error-msg-required="「市区町村名」の入力を記入してください。">
                  </p>
                  <p>
                    <input type="text" name="street" id="street" value="<?=$user['lm01_street']?>" placeholder="番地・ビル名 (例：1-3-5)">
                  </p>
                </td>
              </tr>
              <tr>
                <th class="notnull">電話番号</th>
                <td>
                  <input type="text" class="input_20" name="phoneNumber1" id="parent_name" value="<?=$user['lm01_phone_number_1']?>" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="phoneNumber2" id="parent_name" value="<?=$user['lm01_phone_number_2']?>" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="phoneNumber3" id="parent_name" value="<?=$user['lm01_phone_number_3']?>" data-validation="required" data-validation-error-msg-required="「電話番号」の入力を記入してください。" onkeypress="return isNumberKey(event)">
                </td>
              </tr>
              <tr>
                <th class="">FAX番号</th>
                <td>
                  <input type="text" class="input_20" name="faxNumber1" id="parent_name" value="<?=$user['lm01_fax_number_1']?>" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="faxNumber2" id="parent_name" value="<?=$user['lm01_fax_number_2']?>" onkeypress="return isNumberKey(event)"> - <input type="text" class="input_20" name="faxNumber3" id="parent_name" value="<?=$user['lm01_fax_number_3']?>" onkeypress="return isNumberKey(event)">
                </td>
              </tr>
              <tr>
                <th class="">メールアドレス</th>
                <td class="inputs_data">
                  <p>
                    <span id="user_mail_input"><?=$user['lm01_email']?></span> (<a href="javascript:avoid(0)" class="edit_email" id="<?=$user['lm01_user_id']?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a>)
                  </p>
                 <!--  <p>
                    <input type="text" name="confirm_email" id="parent_name" value="<?php echo set_value('confirm_email') ?>" placeholder="確認のためもう一度入力してください" data-validation="confirmation" data-validation-confirm="email" data-validation-error-msg-confirmation="「メールアドレス」は一致しません。">
                  </p> -->
                </td>
              </tr>
              <tr>
                <th class="">パスワード</th>
                <td class="inputs_data">
                  <p>
                    <a href="#" class="edit_password" id="<?=$user['lm01_user_id']?>">パスワードを変更する</a>
                  </p>
               <!--    <p>
                    <input type="password" name="repass" id="repass" value="<?php echo set_value('repass') ?>" placeholder="確認のためもう一度入力してください " data-validation="confirmation" data-validation-confirm="password"  data-validation-error-msg-confirmation="「パスワード」は一致しません。">
                  </p> -->
                </td>
              </tr>
              <tr>
                <th class="">生年月日</th>
                <td>
                  <?php
                    $year_now = date('Y')-1;
                  ?>
                      <select name="year_birthday" id="year_birthday" required>
                        <option>----</option>
                        <?php for ($year_birthday = $year_now; $year_birthday >= 1920; $year_birthday --) { ?>
                          <option value="<?php echo $year_birthday; ?>" <?php if($year_birthday == date('Y',strtotime($user['lm01_birthday']))){echo 'selected';} else { echo ''; } ?>><?php echo $year_birthday; ?></option>
                        <?php } ?>
                      </select> /
                    <!-- Month -->
                      <select name="month_birthday" id="month_birthday" required>
                        <option>--</option>
                        <?php for ($month_birthday = 1; $month_birthday <= 12; $month_birthday ++) {
                          if($month_birthday < 10){ $month_birthday = '0'.$month_birthday;}?>
                          <option value="<?php echo $month_birthday; ?>" <?php if($month_birthday == date('m',strtotime($user['lm01_birthday']))){echo 'selected';} else { echo ''; } ?>><?php echo $month_birthday; ?></option>
                        <?php } ?>
                      </select> /
                      <select name="day_birthday" id="day_birthday" required>
                        <option <?php if($year_birthday == date('d',strtotime($user['lm01_birthday']))){echo 'selected';} else { echo ''; } ?>><?=date('d',strtotime($user['lm01_birthday']))?></option>
                      </select>
                </td>
              </tr>
              <tr>
                <th>性別</th>
                <td>
                  <label><input type="radio" name="gender" value="1" <?php if($user['lm01_sex'] == 1){echo 'checked';} else {echo '';} ?>>男性 </label>
                  <label><input type="radio" name="gender" value="0" <?php if($user['lm01_sex'] == 0){echo 'checked';} else {echo '';} ?>>女性 </label>
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
                           <option value="<?=$job?>"  <?php if($job == $user['lm01_job']){echo 'selected';} else { echo ''; } ?>><?=$job?></option>
                        <?php } ?>
                      </select>
                  </p>
                </td>
              </tr>
              <tr>
                <th>状態</th>
                <td>
                  <label><input type="radio" name="status" value="1" <?php if($user['lm01_active_status'] == 1){echo 'checked';} else {echo '';} ?>>アクティブ </label>
                  <label><input type="radio" name="status" value="0" <?php if($user['lm01_active_status'] == 0){echo 'checked';} else {echo '';} ?>>インアクティブ </label>
                </td>
              </tr>
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
       <div id="edit_user_email_popup" class="modal">
          <div id="loading"></div>
          <form id="edit_user_email" method="post" action="">
            <div style="font-size: 16px;margin-bottom: 10px;font-weight: bold">ユーザーの電子メールを変更する<span id="new_student_name"></span></div>
            <input type="text" class="student_name_input_popup" name="a_user_email" id="a_user_email" value="">
              <input type="hidden" name="a_user_id" id="a_user_id" value="">
              <div style="margin-top: 20px; text-align: center">
              <button type="submit" class="btn btn_update" name="save_new_student_name" id="save_new_student_name">保存</button>
            </div>
          </form>
        </div>

        <div id="edit_user_password_popup" class="modal">
          <div id="loading"></div>
          <form id="edit_user_password" method="post" action="">
            <div style="font-size: 16px;margin-bottom: 10px;font-weight: bold">ユーザーのパスワードを変更する<span id="new_student_name"></span></div>
            <input type="password" class="student_name_input_popup" name="a_user_password" id="a_user_password" value="">
              <input type="hidden" name="a_user_id_2" id="a_user_id_2" value="">
              <div style="margin-top: 20px; text-align: center">
              <button type="submit" class="btn btn_update" name="save_new_user_password" id="save_new_user_password">保存</button>
            </div>
          </form>
        </div>
    </div><!-- main -->
  </div>

  <footer>

  </footer>
</div>
<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script>

  $(document).on('click', '.edit_email', function(){
    var lm01_user_id = $(this).attr("id");
    $.ajax({
      url:"../fetchUser",
      method:"POST",
      data: {lm01_user_id:lm01_user_id},
      dataType:"json",

      success:function(data){
        if(data.status == 'ok'){
          $("input[name='a_user_email']").val(data.result.lm01_email);
          $("input[name='a_user_id']").val(data.result.lm01_user_id);
          $('#edit_user_email_popup').modal({fadeDuration: 100});
        }
      }
    });
  });

  $(document).on('click', '.edit_password', function(){
    var lm01_user_id = $(this).attr("id");
    $.ajax({
      url:"../fetchUser",
      method:"POST",
      data: {lm01_user_id:lm01_user_id},
      dataType:"json",

      success:function(data){
        if(data.status == 'ok'){
          $("input[name='a_user_id_2']").val(data.result.lm01_user_id);
          $('#edit_user_password_popup').modal({fadeDuration: 100});
        }
      }
    });
  });

  $('#edit_user_email').submit(function(event){
    event.preventDefault();
        var user_email_input = $('#a_user_email').val();
        if(user_email_input !== ''){
          $.ajax({
            url:"../modifyUserEmail",
            method:"POST",
            data:$('#edit_user_email').serialize(),
            beforeSend: function () {
             $('#save_new_student_name').html('<i class="fa fa-refresh fa-spin fa-fw"></i><span class="sr-only">Loading...</span> 読み込み中...');
             $('#save_new_student_name').attr('disabled','disabled');
             $('#edit_student_name').hide();
            },
            success: function (data) {
              $('#loading').html('');
              $("#user_mail_input").load(" #user_mail_input");
              $.modal.close();
              $('#save_new_student_name').html('保存');
              $('#save_new_student_name').removeAttr('disabled');
              const toast = swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 2500
              });

              toast({
                type: 'success',
                title: '電子メールが正常に変更されました。',
              });
              $('#edit_user_email').show();
            }
          });
        } else {
          const toast = swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000
          });
          toast({
            type: 'warning',
            title: '新しいパスワードを入力してください。',
          });
        }
  });

  $('#edit_user_password').submit(function(event){
    event.preventDefault();
    var user_password_input = $('#a_user_password').val();
    if(user_password_input != ''){
      if(user_password_input.length >= 8){
        $.ajax({
          url:"../modifyUserPassword",
          method:"POST",
          data:$('#edit_user_password').serialize(),
          beforeSend: function () {
           $('#save_new_user_password').html('<i class="fa fa-refresh fa-spin fa-fw"></i><span class="sr-only">Loading...</span> 読み込み中...');
           $('#save_new_user_password').attr('disabled','disabled');
          },
          success: function (data) {
            $('#loading').html('');
            $.modal.close();
            $('#a_user_password').val('');
            $('#save_new_user_password').html('保存');
            $('#save_new_user_password').removeAttr('disabled');
            const toast = swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 2500
            });

            toast({
              type: 'success',
              title: 'ユーザーのパスワードが正常に変更されました。',
            });
            $('#edit_user_email').show();
          }
        });
        } else {
          const toast = swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000
          });
          toast({
            type: 'warning',
            title: 'パスワードは8文字以上です。',
          });
        }
      } else {
        const toast = swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 3000
        });
        toast({
          type: 'warning',
          title: '新しいパスワードを入力してください。',
        });
      }
  });

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

  $('.m_user').addClass('active');
  $('.m_user').find('ul').addClass('active');
  $('.parents_class_add').addClass('active');
</script>
</body>
</html>
