<div id="main">
    <?php

      $id_event = $id_name = '';
      $name_event = 'All';
      if($datapost['event_key'] != '' ){
        $id_event = $dataevent[0]['lm10_event_id'];
        $id_name = $dataevent[0]['lm10_event_id_input'];
        $name_event = $dataevent[0]['lm10_event_name'];
      }
    ?>
      <section class="sec01">
        <h3 class="tt_main"> 詳細</h3>
        <div class="research_box">
          <form action="" id="search_parent">
            <table class="formtable">
              <tr>
                <th>イベントID</th>
                <td>
                  <?=$id_name?>
                </td>
              </tr>
              <tr>
                <th>イベント名</th>
                <td><?=$name_event?></td>
              </tr>
              <tr>
                <th>期限</th>
                <td>
                  <?=$datapost['date_star'].' ~ '.$datapost['date_end']?>
                </td>
              </tr>

            </table>
            <!-- <div class="search_cf">
              <p>
                <input type="button" class="btn01" value="今日" id="btn_search" onclick="$('#form_today').submit();">
              </p>
            </div> -->
          </form>
        </div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>日付</th>
                <th>購入ID</th>
                <th>金額</th>
                <th>支払い方法 </th>
                <th>状況 </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total_amount = 0;
                foreach ($listdata as $key) {
                  $total_amount = $total_amount + $key['daydata'][0]['lm07_total_price'];
                  ?>
                    <tr>
                      <td rowspan="<?=$key['rowpan']?>"><?=substr($key['day'], 0 ,4).'年'.substr($key['day'], 4 ,2).'月'.substr($key['day'], 6 ,2).'日'?></td>
                      <td><?=$key['daydata'][0]['lm07_order_id']?></td>
                      <td><?=$key['daydata'][0]['lm07_total_price']?>円</td>
                      <td><?=$key['daydata'][0]['lm13_method_name']?></td>
                      <td>
                        <?php
                          if($key['daydata'][0]['lm07_pay_status'] == 0){
                            echo '<span style="color: red">決済待ち</span>';
                          } elseif($key['daydata'][0]['lm07_pay_status'] == 1){
                            echo '<span style="color: green">決済済み</span>';
                          } elseif($key['daydata'][0]['lm07_pay_status'] == 2){
                            echo '<span style="color: blue">運送済み</span>';
                          }
                        ?>
                      </td>
                    </tr>
                  <?php
                  for ($i=1; $i < $key['rowpan']; $i++) {
                    $total_amount = $total_amount + $key['daydata'][$i]['lm07_total_price'];
                    ?>
                    <tr>
                      <td><?=$key['daydata'][$i]['lm07_order_id']?></td>
                      <td><?=$key['daydata'][$i]['lm07_total_price']?>円</td>
                      <td><?=$key['daydata'][$i]['lm13_method_name']?></td>
                      <td>
                        <?php
                          if($key['daydata'][$i]['lm07_pay_status'] == 0){
                            echo '<span style="color: red">決済待ち</span>';
                          } elseif($key['daydata'][$i]['lm07_pay_status'] == 1){
                            echo '<span style="color: green">決済済み</span>';
                          } elseif($key['daydata'][$i]['lm07_pay_status'] == 2){
                            echo '<span style="color: blue">運送済み</span>';
                          }
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>

              <tr>
                <td>合計</td>
                <td></td>
                <td><?=$total_amount?>円</td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </form>
        <?php
          // print_r($datapost);
          // $today = date('Y年m月d日');
          // echo $today;
        ?>
        <form action="" method="post" id="form_today">
          <input type="hidden" name="event_key" value="<?=$datapost['event_key']?>">
          <input type="hidden" name="date_star" value="<?=date('Y年m月d日')?>">
          <input type="hidden" name="date_end" value="">
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
          </ul>
        </div>

        <!-- <div class="search_cf" align="center">
          <input type="button" class="btn btn_search" value="詳細" id="btn_search">
        </div> -->
      </section>
       <!-- end sec01 -->
    </div><!-- main -->
  </div>

  <footer>

  </footer>
</div>
<!-- end wrapper -->


<script type="text/javascript">
  $('.m_static').addClass('active');
  $('.m_static').find('ul').addClass('active');
  $('.static_detail').addClass('active');
</script>
</body>
</html>
