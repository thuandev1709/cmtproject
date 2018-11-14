<style type="text/css" media="screen">
  .ui-datepicker-calendar td a.ui-state-default {
    height: 25px;
    line-height: 25px;
    text-align: center;
  }
  #ui-datepicker-div {
    font-size: 12px;
  }
  td.point_cust div.point01 {
    margin-left: 0px;
  }

  td.point_cust div.point01 input{
    width: 190px
  }
</style>
<div id="main">
  <p id="demo"></p>
      <section class="sec01">
        <h3 class="tt_main">全体</h3>
        <div class="research_box">
          <form action="<?=base_url()?>admin/statistics/detail" id="search_parent" method="post">
            <table class="formtable">
              <tr>
                <th>イベントID</th>
                <td>
                  <select id="event_key" name="event_key">
                    <option></option>
                    <?php
                      foreach ($list_event as $key ) {
                    ?>
                    <option value="<?php echo $key['lm10_event_id'];?>"><?php echo $key['lm10_event_id_input'];?></option>
                  <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>イベント名</th>
                <td id="name_id">All</td>
              </tr>
              <tr>
                <th>期限</th>
                <td>
                  <input type="text" class="input_30" name="date_star" id="date_star" value="" > ~ <input type="text" class="input_30" name="date_end" id="date_end" value="">
                </td>
              </tr>
              <!-- <tr>
                <th>商品名</th>
                <td><input type="text" class="input_30" name="name_order" id="name_order" value=""></td>
              </tr>
              <tr>
                <th>商品種類</th>
                <td><label><input type="radio" name="type" class="checkboxtype" value="0"> 写真 </label> <label><input type="radio" name="type" class="checkboxtype" value="1"> 動画 </label></td>
              </tr> -->
            </table>
            <div class="search_cf">
              <p>
                <input type="button" class="btn01 today" value="今日" >
                <input type="button" class="btn01 lastweek" value="今週" >
                <input type="button" class="btn01 lastmonth" value="今月" >
                <input type="button" class="btn01 thisyear" value="今年" >
              </p>
               <br>
              <p><input type="button" class="btn btn_search" value="集計" id="btn_search"></p>
            </div>
          </form>
        </div>
        
        <?php
          // print_r($list_order );
          foreach ($list_payment as $key_payment) {
            $id = $key_payment['lm13_method_id'];
            $data['total_payment'.$id] = $data['total_amount'.$id] = $data['payment'.$id] = $data['amount'.$id] = $data['amount_payed'.$id] = 0;
            foreach ($list_order as $key_order) {

              if($key_order['lm07_method_id'] == $id){
                ++$data['total_payment'.$id];
                $data['total_amount'.$id] = $data['total_amount'.$id] + $key_order['lm07_total_price'];
                if($key_order['lm07_pay_status'] == '1'){
                  $data['amount_payed'.$id] = $data['amount_payed'.$id] + $key_order['lm07_total_price'];
                }else{
                  ++$data['payment'.$id];
                  $data['amount'.$id] = $data['amount'.$id] + $key_order['lm07_total_price'];
                }
              }
            }
          }
        ?>

        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>支払い方法</th>
                <th>購入回数</th>
                <th>金額</th>
                <th>未払い回数</th>
                <th>未払い金額</th>
                <th>決済済み金額</th>
              </tr>
            </thead>
            <tbody id="tbody_table">
              <?php
                $all_total_payment = $all_total_amount = $all_payment = $all_amount = $all_amount_payed = 0;
                foreach ($list_payment as $key) {
                  $id = $key['lm13_method_id'];
                  $all_total_payment = $all_total_payment + $data['total_payment'.$id];
                  $all_total_amount = $all_total_amount + $data['total_amount'.$id];
                  $all_payment = $all_payment + $data['payment'.$id];
                  $all_amount = $all_amount + $data['amount'.$id];
                  $all_amount_payed = $all_amount_payed + $data['amount_payed'.$id];
                  echo "<tr>
                    <td>".$key['lm13_method_name']."</td>
                    <td>".$data['total_payment'.$id]."</td>
                    <td>".$data['total_amount'.$id]."円</td>
                    <td>".$data['payment'.$id]."</td>
                    <td>".$data['amount'.$id]."円</td>
                    <td>".$data['amount_payed'.$id]."円</td>
                  </tr>";
                }
              ?>
              <tr>
                <td>合計 </td>
                <td><?=$all_total_payment?></td>
                <td><?=$all_total_amount?>円</td>
                <td><?=$all_payment?></td>
                <td><?=$all_amount?>円</td>
                <td><?=$all_amount_payed?>円</td>
              </tr>
              <input type="hidden" id="get_total_payment" name="get_total_payment" value="<?=$all_total_payment?>" />
            </tbody>
          </table>
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
          </ul>
        </div>
        <div class="search_cf" align="center">
          <?php if($all_total_payment != 0){ ?>
            <input type="button" class="btn btn_search" value="詳細" id="btn_detail">
          <?php } else { ?>
            <input type="button" class="btn btn_search" value="詳細" id="btn_detail" disabled>
          <?php } ?>
        </div>

      </section>
       <!-- end sec01 -->
    </div><!-- main -->
  </div>

  <footer>

  </footer>
</div>
<!-- end wrapper -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  $data = [<?php
      foreach ($list_event as $key ) {
        $a = $key['lm10_event_id'];
        $b = $key['lm10_event_name'];
        echo "{id: '$a', name: '$b'},";
      }
    ?>];

  $('#event_key').change(function(){
    var id = $(this).val();
    for (var i = 0; i < $data.length; i++) {
      if($data[i]['id'] == id){
        $('#name_id').html($data[i]['name']);

      }
      var event_key = $('#event_key').val();
      if (event_key=='') {
      $('#name_id').html('');
      }
    }
  });

  $(function(){
      $('#date_star').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
      $('#date_end').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
  });

  function checkTotalPayment(){
    var get_total_payment = $('#get_total_payment').val();
    if(get_total_payment == 0){
      $('#btn_detail').attr('disabled','disabled');
    } else {
      $('#btn_detail').removeAttr('disabled');
    }
  }
  checkTotalPayment();

  $('#btn_search').click(function(){
    var id_event = $('#event_key').val();
    var fromdate = $('#date_star').val();
    var todate = $('#date_end').val();
    // var name_order = $('#name_order').val();
    // var checkboxtype = "";
    // $('.checkboxtype').each(function(){
    //   if($(this).prop("checked") == true){
    //     checkboxtype = $(this).val();
    //   }
    // });
    // console.log(id_event +" - "+formdate+" - "+todate+" - "+name_order+" - "+checkboxtype);
    $.ajax({
        url: '<?=base_url()?>admin/statistics/search_statistics',
        data: {
          id_event:id_event,
          fromdate:fromdate,
          todate:todate,

        },
        type: 'POST',
        success: function (data) {
          // console.log(data);
          $('#tbody_table').html(data);
          checkTotalPayment();
        }
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
    $('#date_star').val(y+'年'+m+'月'+d+'日');
    $('#date_end').val('');
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
    // console.log(days[today.getDay()]);
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
    $('#date_star').val(lastWeek.getFullYear()+'年'+m1+'月'+d1+'日');
    $('#date_end').val(today.getFullYear()+'年'+m+'月'+d+'日');
    $('#btn_search').click();
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
    $('#date_star').val(today.getFullYear()+'年'+m+'月'+'01'+'日');
    $('#date_end').val(today.getFullYear()+'年'+m+'月'+d+'日');
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

    $('#date_star').val(y+'年01月01日');
    $('#date_end').val(y+'年'+m+'月'+d+'日');
    $('#btn_search').click();
  });

  $('#btn_detail').click(function(){
    $('#search_parent').submit();
  });
</script>

<script type="text/javascript">
  $('.m_static').addClass('active');
  $('.m_static').find('ul').addClass('active');
  $('.static_list').addClass('active');
</script>

<script>
   $(".input_30").on('keydown paste', function(e){
        e.preventDefault();
    });
</script>

</body>
</html>
