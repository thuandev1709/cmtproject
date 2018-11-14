<div id="main">
      <section class="sec01">
        <h3 class="tt_main">受注一覧</h3>
        <div class="research_box">
          <div class="error"></div>
          <form action="" id="search_parent">
            <table class="formtable">
              <tr>
                <th>購入ID</th>
                <td><input type="text" class="input_30" name="lm07_order_id" id="lm07_order_id" value=""></td>
              </tr>
              <tr>
                <th>イベントID</th>
                <td>
                  <select name="id_event" id="id_event">
                    <option value=""></option>
                    <?php foreach ($list_events as $event) { ?>
                          <option value="<?= $event["lm10_event_id"] ?>"><?= $event["lm10_event_id_input"] ?></option>;
                     <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>イベント名</th>
                <td id="name_event">All</td>
              </tr>
              <tr>
                <th>期限</th>
                <td>
                 <input type="text" id="datepicker_from"> ~ <input type="text" id="datepicker_to">
                </td>
              </tr>

              <tr>
                <th>支払い状況</th>
                <td>
                  <label><input type="radio" name="lm07_pay_status" value="3" checked > 全て </label>
                  <label><input type="radio" name="lm07_pay_status" value="0" > 決済待ち </label>
                  <label><input type="radio" name="lm07_pay_status" value="1" > 決済済み </label>
                  <label><input type="radio" name="lm07_pay_status" value="2" > 運送済み </label></td>
              </tr>
            </table>
            <div class="search_cf">
              <!-- <p>
                <input type="button" class="btn01 today" value="今日" >
                <input type="button" class="btn01 lastweek" value="今週" >
                <input type="button" class="btn01 lastmonth" value="今月" >
                <input type="button" class="btn01 thisyear" value="今年" >
              </p> -->
               <br>
              <p><input type="submit" class="btn btn_search" value="検索" id="btn_search"></p>
            </div>
          </form>
        </div>
        <div class="count_list"><?= $total_order_search ?>件です。</div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>日付</th>
                <th>購入ID</th>
                <th>金額</th>
                <th>状況</th>
                <th>状態変更</th>
                <th>選択する</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($total_order_search > 0){
              $_lm07_date_order = "";
              foreach ($all_list_orders as $list_order) {
                foreach ($list_order['list_orders'] as $key => $order_val) {
                  $lm07_date_order = !empty($order_val['lm07_date_order']) ? date("Y年m月d日", strtotime($order_val['lm07_date_order'])) : '';
                  $lm07_pay_status = "";
                  if($order_val['lm07_pay_status'] == 0) {
                      $lm07_pay_status ='<span style="color: red">決済待ち</span>';
                  } elseif ($order_val['lm07_pay_status'] == 1) {
                      $lm07_pay_status ='<span style="color: green">決済済み</span>';
                  } else {
                      $lm07_pay_status ='<span style="color: blue">運送済み</span>';
                  }
                  ?>
                  <tr>
                    <?php if($key == 0) { ?>
                     <td rowspan="<?= $list_order['rowspan']['total'] ?>"><?=  $lm07_date_order ?></td>
                    <?php } ?>
                    <td><?=  $order_val['lm07_order_id'] ?>   </td>
                    <td><?=  !empty($order_val['lm07_total_price']) ? $order_val['lm07_total_price'].'円' :'' ?></td>
                    <td><?=  $lm07_pay_status ?></td>
                    <td><input type="button" class="btn01 btn_edit" onclick="location.href='<?=base_url()?>admin/order/detail/<?= $order_val['lm07_order_id'] ?>'" value="編集する"></td>
                    <td><label><input type="checkbox" name="lm07_pay_status" <?= $order_val['lm07_pay_status'] == 0 ? 'disabled' :'' ?> value="<?=  $order_val['lm07_order_id'] ?>"></label></td>
                  </tr>
              <?php } } } ?>
            </tbody>

          </table>
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
              <?php
                if($total_rows != 0 && $total_rows > 1 && !empty($pagination)){
                  echo "<li class='btn_prev'><span>ページ ".$offset."/".$total_rows."</span></li>";
                  echo $pagination;
                }
              ?>
          </ul>
        </div>

        <p align="center"><button type="button" class="btn" style="width: 200px;margin-top: 15px" id="print_pdf_csv" name="">選択したのを印刷する</button></p>
      </section>
       <!-- end sec01 -->
    </div><!-- main -->
  </div>

  <footer>

  </footer>
</div>
<!-- end wrapper -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=base_url()?>assets/js/japandatapicker.js"></script>

<script type="text/javascript">
  $('.m_order').addClass('active');
  $('.m_order').find('ul').addClass('active');
  $('.order_list').addClass('active');

  $( function() {
    $( "#datepicker_from" ).datepicker({
      dateFormat: 'yy年mm月dd日',
    });

    $( "#datepicker_to" ).datepicker({
      dateFormat: 'yy年mm月dd日'
    });
  });

  $('.today').click(function(){
    var today = new Date();
    var y = today.getFullYear();
    var m = today.getMonth() + 1;
    var d = today.getDate();
    if(m < 10)
      m = '0'+m;
    if(d < 10)
      d = '0'+d;
    $('#datepicker_from').val(y+'年'+m+'月'+d+'日');
    $('#datepicker_to').val('');
    $('#btn_search').click();
  });

  $('.lastweek').click(function(){
    var days = ["0","1","2","3","4","5","6"];
    var today = new Date();
    var m = today.getMonth() + 1;
    var d = today.getDate();
    var NumOfDay = days[today.getDay()];
    if(NumOfDay==0){
      var NumToMo =  6;
    }else{
      var NumToMo =  NumOfDay - 1;
    }

     var lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - NumToMo);
    console.log(days[today.getDay()]);
    if(m < 10)
      m = '0'+m;
    if(d < 10)
      d = '0'+d;

    var m1 = lastWeek.getMonth() + 1;
    var d1 = lastWeek.getDate();

    if(m1 < 10)
      m1 = '0'+m1;
    if(d1 < 10)
      d1 = '0'+d1;
    $('#datepicker_from').val(lastWeek.getFullYear()+'年'+m1+'月'+d1+'日');
    $('#datepicker_to').val(today.getFullYear()+'年'+m+'月'+d+'日');
    // $('#btn_search').click();
  });

  $('.lastmonth').click(function(){
    var today = new Date();
    var m = today.getMonth() + 1;
    var d = today.getDate();
    var lastWeek = new Date(today.getFullYear(), m - 1, d);

    if(m < 10)
      m = '0'+m;
    if(d < 10)
      d = '0'+d;

    var m1 = today.getMonth();
    var d1 = today.getDate();
    if(m1 < 10)
      m1 = '0'+m1;
    if(d1 < 10)
      d1 = '0'+d1;
    $('#datepicker_from').val(today.getFullYear()+'年'+m+'月'+'01'+'日');
    $('#datepicker_to').val(today.getFullYear()+'年'+m+'月'+d+'日');
    $('#btn_search').click();
  });

  $('.thisyear').click(function(){
    var today = new Date();
    var y = today.getFullYear();
    var m = today.getMonth() + 1;
    var d = today.getDate();
    if(m < 10)
      m = '0'+m;
    if(d < 10)
      d = '0'+d;

    $('#datepicker_from').val(y+'年01月01日');
    $('#datepicker_to').val(y+'年'+m+'月'+d+'日');
    $('#btn_search').click();
  });
  var id_event = $('#id_event').val();
  $('#id_event').on('change', function() {
    id_event = this.value;
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: "<?php echo base_url('admin/order/getEventName') ?>",
        data: {id_event:id_event},
        success: function(data) {
          if(data !== null && data !== '') {
            console.log(data)
            $('#name_event').empty()
            $('#name_event').text(data.lm10_event_name);
          } else {
            $('#name_event').empty()
            $('#name_event').text('All');
          }
        }
    });
  });

  $('#search_parent').submit(function(event){
    event.preventDefault();
    var lm07_order_id   = $('#lm07_order_id').val();
    var id_event        = $('#id_event').val();
    var datepicker_from = $('#datepicker_from').val();
    var datepicker_to   = $('#datepicker_to').val();
    var lm07_pay_status =  $('input[name="lm07_pay_status"]:checked').val();
    $.ajax({
        url: '<?=base_url()?>admin/order/searchOrder',
        data: {
          lm07_order_id:lm07_order_id,
          id_event:id_event,
          datepicker_from:datepicker_from,
          datepicker_to:datepicker_to,
          lm07_pay_status:lm07_pay_status
        },
        type: 'POST',
        success: function (data) {
          var obj = JSON.parse(data);
          console.log(obj.data_html)
          $('.table02').html(obj.data_html);
          if (obj.data_total_rows == 1 ||  obj.data_total_rows == 0) {
            $('.pagination .page').html("<li class='btn_prev'><span></span></li>");
            $('.count_list').empty();
            $('.count_list').text(obj.total_search+'件です。');
          } else {
            $('.pagination .page').html("<li class='btn_prev'><span>ページ "+obj.data_page+"/"+obj.data_total_rows+"</span></li>"+obj.data_pagination);
            $('#this_page').val(obj.data_this_page);
            $('.count_list').empty();
            $('.count_list').text(obj.total_search+'件です。');
            rewrite_onclick();
          }

        }
    });
  });
  function F_pageSearch(pageSearch){
    var lm07_order_id   = $('#lm07_order_id').val();
    var id_event        = $('#id_event').val();
    var datepicker_from = $('#datepicker_from').val();
    var datepicker_to   = $('#datepicker_to').val();
    var lm07_pay_status =  $('input[name="lm07_pay_status"]:checked').val();
    $.ajax({
        url: '<?=base_url()?>admin/order/searchOrder/'+pageSearch,
        data: {
          lm07_order_id:lm07_order_id,
          id_event:id_event,
          datepicker_from:datepicker_from,
          datepicker_to:datepicker_to,
          lm07_pay_status:lm07_pay_status
        },
        type: 'POST',
        success: function (data) {
          var obj = JSON.parse(data);
          $('.table02').html(obj.data_html);
          $('#this_page').val(obj.data_this_page);
          $('.pagination .page').html("<li class='btn_prev'><span>ページ "+obj.data_page+"/"+obj.data_total_rows+"</span></li>"+obj.data_pagination);
          rewrite_onclick();
        }
    });
  }

  function clicknext(){
    var pageSearch = $('#this_page').val();
    ++pageSearch;
    F_pageSearch(pageSearch);
  }

  function clickprev(){
    var pageSearch = $('#this_page').val();
    --pageSearch;
    F_pageSearch(pageSearch);
  }

  function rewrite_onclick(){
    $('.pagclick').each(function() {
      var thisa = $(this);
      var childa = thisa.find('a');
      childa.attr('href','javascript:void(0)');
      childa.attr('onclick','F_pageSearch('+childa.html()+');');
    });
    $('.next').each(function() {
      var thisa = $(this);
      var childa = thisa.find('a');
      childa.attr('href','javascript:void(0)');
      childa.attr('onclick','clicknext();');
    });
    $('.prev').each(function() {
      var thisa = $(this);
      var childa = thisa.find('a');
      childa.attr('href','javascript:void(0)');
      childa.attr('onclick','clickprev();');
    });
  }

  function delete_file(values){
      $.ajax({
          url: '<?=base_url()?>admin/order/delete_file',
          method: "GET",
          data: {
            name_csv: values.folder_csv,
            name_pdf: values.folder_pdf,
          },
          dataType: "json",
        });
  }

  $('#print_pdf_csv').on('click', function() {
    var lm07_order_id = [];
    $("input:checkbox:checked").each(function(){
      lm07_order_id.push(this.value);
    });
    var uploading_text = '<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i>';
    $.ajax({
            url: '<?=base_url()?>admin/order/printPDFexportCsv',
            data: {lm07_order_id:lm07_order_id},
            type: 'post',
            dataType: 'JSON',
            beforeSend: function(){
              // $(".loading").addClass("pending_show");
              // $('.loading').html(uploading_text);

              $('#print_pdf_csv').html('<i class="fa fa-refresh fa-spin fa-fw"></i><span class="sr-only">Loading...</span> 読み込み中...');
              $('#print_pdf_csv').attr('disabled','disabled');
            },
            success: function(data){
              var a_csv      = document.createElement("a");
              a_csv.href     = data.filename_csv;
              a_csv.download = '';

              var a_pdf    = document.createElement("a");
              a_pdf.href   = data.filename_pdf;
              a_pdf.download = '';

              a_csv.onclick = function () {
                setTimeout(function(){
                  delete_file(data);
                }, 2000);
              };

              document.body.appendChild(a_csv);
              a_csv.click();
              a_csv.remove();

              document.body.appendChild(a_pdf);
              a_pdf.click();
              a_pdf.remove();

              // $('.loading').empty();
              // $('.loading').removeClass("pending_show");
              $('#print_pdf_csv').html('選択したのを印刷する');
              $('#print_pdf_csv').removeAttr('disabled');
            },
            error: function(xhr) { // if error occured
                // $('.loading').remove();
                $('#print_pdf_csv').html('選択したのを印刷する');
                $('#print_pdf_csv').removeAttr('disabled');
                $(".error").addClass("error_show");
                $('.error').text('注文を選択してください');
            },
        });
  });
</script>
</body>
</html>
