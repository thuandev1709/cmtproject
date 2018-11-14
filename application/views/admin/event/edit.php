<div id="main">
      <section class="sec01">
        <h3 class="tt_main">編集する</h3>
        <div class="research_box">
          <div  id='message_date' style="display:none;"><div class='w3-panel w3-green'><i class='fa fa-times-circle'></i></i> 削除できません。 開始日は現在の日付よりも大きくなければなりません</div></div>
          <div  id='message_id' style="display:none;"><div class='w3-panel w3-green'><i class='fa fa-times-circle'></i></i> 削除できません。 製品にはこのイベントがありました</div></div>
          <div id="m" style="display:none;">Click!</div>
          <form method="POST" action="" id="from_event">
            <input type="hidden" name="default" id="default" value="<?php echo $Default['lm11_value_default']; ?>">
            <input type="hidden" class=""  id="pass"  name="pass" value="<?php echo $event['lm10_event_password']; ?>" placeholder="">
            <input type="hidden" class=""  id="id_event_history"  name="id_event_history" value="<?php echo $event['lm10_event_id']; ?>" placeholder="">
            <input type="hidden" class=""  id="id_event_input"  name="id_event_input" value="<?php echo $event['lm10_event_id_input']; ?>"> 
            <?php
                $date_start = $event['lm10_date_start'];
                $date_start_format = date('Y年m月d日', strtotime($date_start));
                $date_predetermine = $event['lm10_date_predetermine'];
                $date_predetermine_format = date('Y年m月d日', strtotime($date_predetermine));
                $date_end = $event['lm10_date_end'];
                $date_end_format = date('Y年m月d日', strtotime($date_end));
                $year_now = date("Ymd");

                
             ?>
            <table class="mb20 formtable"> 
              <tr>
                <th class="notnull">イベントID</th>
                <td>
                  <input maxlength="8" type="text" class=""  id="id_event"  name="id_event" value="<?php echo $event['lm10_event_id_input']; ?>" placeholder="" required> 
                  <span style="color: red" id="user-result"></span>
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント名</th>
                <td>
                  <input type="text" class=""  id="name_event"  name="name_event" value="<?php echo $event['lm10_event_name']; ?>" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="notnull">イベントパスワード</th>
                 <td>
                  <input type="text" class=""  id="password"  name="password" value="<?php echo $event['lm10_event_password']; ?>" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント開催日</th>
                <td>
                  <input type="text" class="readonly"  id="date_start"  name="date_start" value="<?php echo $date_start_format; ?>" placeholder="" autocomplete="off" required>  
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント掲載予定日</th>
                <td>
                  <input type="text" class="readonly"  id="date_predetermine"  name="date_predetermine" value="<?php echo $date_predetermine_format; ?>" autocomplete="off" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント掲載期限</th>
                <td>
                  <input type="text" class="readonly"  id="date_end"  name="date_end" value="<?php echo $date_end_format; ?>" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="">表示</th>
                <td>
                  <label><input value="1" type="radio" name="type" <?php echo ($event['lm10_display']) == 1 ? 'checked' : ''; ?>> する </label> 
                  <label><input value="0" type="radio" name="type" <?php echo ($event['lm10_display']) == 0 ? 'checked' : ''; ?>> しない </label>
                </td>
              </tr>
            </table>
            <div class="form_button form_button02 clearfix">
              <a id="button" ><input style="margin-top: 9px; height: 31px" type="submit" class="btn btn_update" value="保存する" name="btn_update" id="btn_update"></a>
              <?php 

                  if (empty($list_product)&& $date_start>= $year_now ) {
               ?>
               <input type="button" class="btn btn_delete" id="delete" value="削除する" name="btnNoSubmit">
               
             <?php }else{if (!empty($list_product)) {
                ?>

              <input type="button" class="btn btn_delete" id="fails_id" value="削除する" name="btnNoSubmit">
            <?php  }elseif($date_start< $year_now){ ?>
              <input type="button" class="btn btn_delete" id="fails_date" value="削除する" name="btnNoSubmit">
            <?php } } ?>
              <a href="<?=base_url('admin/event')?>"><input type="button" class="btn" value="戻る" name="btnNoSubmit"></a>
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
  function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode;
       if(charCode == 59 || charCode == 46)
        return true;
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
    }
</script>
<script>
    $(function() {
        $('#zip-search').click(function() {
            AjaxZip3.zip2addr('contact[zip][zip01]', 'contact[zip][zip02]', 'lm01_county', 'lm01_city');
        });
    });
</script>
<!-- end wrapper -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $('.m_event').addClass('active');
  $('.m_event').find('ul').addClass('active');
  $('.event_add').addClass('active');
</script>
<!-- <script type='text/javascript'src='http://senthilraj.github.io/TimePicki/js/timepicki.js'></script> -->
<script>
  window.jQuery || document.write('<script src="<?=base_url()?>assets/manage/common/js/jquery.js"><\/script>');
</script>
<!-- jQuery Fallback -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/js/japandatapicker.js"></script>
<script type="text/javascript">
  $(function(){
      $('#date_start').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
      $('#date_predetermine').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
      $('#date_end').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
  });
</script>

<script >
      $(document).ready(function(){
        $("#id_event").keyup( function(e){
          e.preventDefault();
            $.ajax({
              url:"<?php echo base_url() ?>admin/Event/check_event",
              type:"POST",
              data:{'id_event':id_event.value},
              success: function(data){
                var id_event = $('#id_event').val();
                var id_event_input = $('#id_event_input').val();
                if (id_event.toLocaleLowerCase()!=id_event_input.toLocaleLowerCase()) {
                  $('#user-result').html(data);
                  var test = $('#user-result').html();
                  if (test!='') {
                    $('#button').html("<input style='margin-top: 9px; height: 31px' type='button' class='btn btn_update 'value='保存する' name='btn_update' id='btn_update'>");
                  }else{
                    $('#button').html("<input style='margin-top: 9px; height: 31px 'type='submit' class='btn btn_update 'value='保存する' name='btn_update' id='btn_update'>");
                  }
                }else{
                  $('#user-result').html('');
                  $('#button').html("<input style='margin-top: 9px; height: 31px 'type='submit' class='btn btn_update 'value='保存する' name='btn_update' id='btn_update'>");
                }
              
              },
              error: function(){
              alert("Error"); 
              }
            });
          
        });
      });
  </script>

  <script>
    $(document).ready(function(){
    $("#delete").click(function(){
      var x = confirm("削除しますか？");
      if(x==true){
        $('#from_event').attr('action', '<?php echo base_url() ?>admin/event/delete_event');
        $('#from_event').submit();    
      }
      else{
        return false;
      }
    });
    });
  </script>
    
  <script>
    $("#fails_date").click(function(){
      $('#message_date').show().delay(4000).fadeOut("fast");
    });
    
    $("#fails_id").click(function(){
      $('#message_id').show().delay(4000).fadeOut("fast");   
    });
  </script>
  <script>
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
</script>

<script >
      
  $(document).ready(function(){
  $("#date_predetermine").change(function(){
    var date_predetermine = $('#date_predetermine').val();
    var date_predetermine_format = date_predetermine.substring(0, 4)+"/" + date_predetermine.substring(5, 7)+"/"+ date_predetermine.substring(8, 10);
    console.log(date_predetermine_format);
    var date_final = $('#default').val();
    var date_final_format = Number(date_final);  
    var date = new Date(date_predetermine_format);
    date.setDate(date.getDate() + date_final_format);
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    var date_end = y+'年'+m+'月'+d+'日';
    $('#date_end').val(date_end);
      
  }); 
  });
    
  </script>
</body>
</html>


