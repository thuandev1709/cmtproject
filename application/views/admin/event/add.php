<div id="main">
      <section class="sec01">
        <h3 class="tt_main">イベントを作成</h3>
        <div class="research_box">
          <p id="result"></p>
          <form method="POST" action="" id="form_insert">
            <input type="hidden" name="default" id="default" value="<?php echo $Default['lm11_value_default']; ?>">
            <table class="mb20 formtable"> 
              <tr>
                <th class="notnull">イベントID</th>
                <td>
                  <input maxlength="8" type="text" class=""  id="id_event"  name="id_event" value="" placeholder="" required>
                  <span style="color: red" id="user-result"></span>
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント名</th>
                <td>
                  <input type="text" class=""  id="name_event"  name="name_event" value="" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="notnull">イベントパスワード</th>
                <td>
                  <input type="text" class=""  id="password"  name="password" value="" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th  class="notnull">イベント開催日</th>
                <td>
                  <input type="text" class="readonly"  id="date_start"  name="date_start" value="" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント掲載予定日</th>
                <td>
                  <input type="text" class="readonly"  id="date_predetermine"  name="date_predetermine" value="" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="notnull">イベント掲載期限</th>
                <td>
                  <input type="text" class="readonly"  id="date_end"  name="date_end" value="" placeholder="" required> 
                </td>
              </tr>
              <tr>
                <th class="">表示</th>
                <td>
                  <label><input type="radio" name="type" checked value="1"> する </label> 
                  <label><input type="radio" name="type" value="0"> しない </label>
                </td>
              </tr>
            </table>
            <div class="form_button form_button02 clearfix">
              <a id="button"><input type="submit" class="btn btn_update" value="保存する" name="btn_insert" id="btn_insert"></a>
              <input type="button" class="btn btn_delete" onclick="clear_form_elements()" value="クリア" name="btnNoSubmit">
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
<!--  -->
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
<!-- <script type="text/javascript" src="assets/js/jquery-1.9.0.min.js"></script> -->

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
              $('#user-result').html(data);
              var test = $('#user-result').html();
              if (test!='') {
                $('#button').html("<input type='button' class='btn btn_update 'value='保存する'>");
              }else{
                $('#button').html("<input type='submit' class='btn btn_update 'value='保存する' name='btn_insert' id='btn_insert'>");
              }
              
              },
              error: function(){
              alert("Error"); 
              }
            });
          
        });
      });
    </script>

    <script type="text/javascript">
  function clear_form_elements() {
    $('#form_insert').find('input:text').val('');
    $('#form_insert').find('input:password').val('');
    $('#form_insert').find('span').html('');
    $('#form_insert').find('input:radio').removeAttr('checked');
    
  }

  $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
</script>

<script >
      
  $(document).ready(function(){
  $("#date_predetermine").change(function(){
    var date_predetermine = $('#date_predetermine').val();
    var date_predetermine_format = date_predetermine.substring(0, 4)+ "/" + date_predetermine.substring(5, 7)+ "/" + date_predetermine.substring(8, 10);
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


