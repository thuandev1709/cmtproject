
<div id="main">
      <section class="sec01">
        <h3 class="tt_main">受注詳細</h3>
        <div class="research_box">
          <?php
              if(validation_errors() != ''){
                echo validation_errors(); }
              if(isset($message)) {
                echo $message;
              }
            ?>
          <form action="" id="search_parent" method="post">
            <table class="formtable tableinfo">
              <tr>
                <th>購入ID</th>
                <td class="lm07_order_id"><?= !empty($list_order['lm07_order_id']) ? $list_order['lm07_order_id'] : '' ?></td>
                <th>ユーザーID</th>
                <td><?= !empty($list_order['lm01_user_id']) ? $list_order['lm01_user_id'] : '' ?></td>
                <th>ユーザー名</th>
                <td><?= !empty($list_order['lm01_firstname']) ? $list_order['lm01_firstname'] : '' ?> <?= !empty($list_order['lm01_lastname']) ? $list_order['lm01_lastname'] : '' ?></td>
                <input type="hidden" name="lm01_email" value="<?= !empty($list_order['lm01_email']) ? $list_order['lm01_email'] : '' ?>">
              </tr>
              <tr>
                <th>日付</th>
                <td colspan="5" class="lm07_date_order"><?= !empty($list_order['lm07_date_order']) ? date('Y年m月d日',strtotime($list_order['lm07_date_order'])) : '' ?></td>
              </tr>
              <tr>
                <th>金額</th>
                <td><?=number_format($list_order['lm07_total_price']).'円'?></td>
                <td colspan="3">支払い方法: <?= $list_order['lm13_method_name']?></td>
              </tr>
              <tr>
                <th>支払い状況</th>
                <td colspan="5">
                  <label><input type="radio" name="lm07_pay_status" value="0" <?= $list_order['lm07_pay_status']==0 ?'checked' : ''?>> 決済待ち</label>
                  <label><input type="radio" name="lm07_pay_status" value="1" <?= $list_order['lm07_pay_status']==1 ?'checked' : ''?>> 決済済み</label>
                  <label><input type="radio" name="lm07_pay_status" value="2" <?= $list_order['lm07_pay_status']==2 ?'checked' : ''?>> 運送済み</label>
                </td>
              </tr>
            </table>
            <div class="search_cf">
              <input type="submit" class="btn btn_search" value="保存する" id="btn_search">
              <span class="loading" style="padding: 0px"></span>
              <button type="button" class="btn" id="print_pdf">印刷する</button>
            </div>
          </form>
        </div>
        <div class="count_list"><?= $total_order_detail ?>件です。</div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>ID/商品名</th>
                <th>イベントID</th>
                <th>イベント名</th>
                <th>種類</th>
                <th>値段(税込)</th>
                <th>枚数</th>
                <th>金額</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($total_order_detail > 0){
                  $lm08_quantity = 0;
                  $lm08_total_price = 0;
                foreach ($list_order_detail as $order_detail_val) {
                  $lm08_quantity += $order_detail_val['lm08_quantity'];
                  $lm08_total_price += $order_detail_val['lm08_total_price'];
                  $lm07_date_order = date('Y年m月d日',strtotime($order_detail_val['lm07_date_order']));
                  $usb_price = $order_detail_val['lm07_usb_money'];
  								$fee_transport = $order_detail_val['lm07_fee_transport'];
                  $total_price = $order_detail_val['lm08_total_price']
                  ?>

                    <tr>
                      <td><?=  $order_detail_val['lm04_pro_id'] ?>/<?=  $order_detail_val['lm04_pro_name'] ?></td>
                      <td><?=  $order_detail_val['lm10_event_id_input'] ?>   </td>
                      <td><?=  ($order_detail_val['lm10_event_name']) ?></td>
                      <td><?=  $order_detail_val['lm04_pro_type'] == 0 ? '画像' : 'DVD' ?></td>
                      <td><?=  $order_detail_val['lm08_price'].'円' ?></td>
                      <td><?=  $order_detail_val['lm08_quantity'] ?></td>
                      <td><?=  $order_detail_val['lm08_total_price'].'円' ?></td>
                      <td><input type="button" class="btn01 btn_edit" onclick="location.href='<?=base_url()?>admin/product/edit/<?= $order_detail_val['lm04_pro_id'] ?>'" value="編集する"></td>
                    </tr>
                    <input type="hidden" name="" id="lm07_date_order" value="<?= $lm07_date_order ?>">
                    <input type="hidden" name="" id="lm07_order_id" value="<?= $order_detail_val['lm07_order_id'] ?>">
                <?php } ?>
                <tr>
                  <td colspan="5">小計</td>
                  <td><?= $lm08_quantity ?></td>
                  <td id="lm08_total_price"><?= $lm08_total_price ?>円</td>
                </tr>
                <tr>
                  <td colspan="6">運送料金</td>

                  <td id="lm08_total_price"><?= number_format($fee_transport) ?>円</td>
                </tr>
                <tr>
                  <td colspan="6">USB 料金</td>

                  <td id="lm08_total_price"><?= number_format($usb_price) ?>円</td>
                </tr>
                <tr>
                  <td colspan="6">合計</td>

                  <td id="lm08_total_price"><?= number_format(round($lm08_total_price+$usb_price+$fee_transport)) ?>円</td>
                </tr>
                <?php } ?>

            </tbody>

          </table>
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
              <?php
                if($total_rows != 0 && $total_rows > 1){
                  echo "<li class='btn_prev'><span>ページ ".$offset."/".$total_rows."</span></li>";
                  echo $pagination;
                }
              ?>
          </ul>
        </div>
      </section>
       <!-- end sec01 -->
    </div><!-- main -->
  </div>

  <footer>

  </footer>
</div>
<!-- end wrapper -->


<script type="text/javascript">
  var lm08_total_price = $('#lm08_total_price').text();
  $('.lm08_total_price').text(lm08_total_price);

  $('.m_order').addClass('active');
  $('.m_order').find('ul').addClass('active');
  $('.order_list').addClass('active');

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

  $('#print_pdf').on('click', function() {
    var lm07_order_id = $('.lm07_order_id').text();
    console.log(lm07_order_id);
    var uploading_text = '<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i>';
    $.ajax({
            url: '<?=base_url()?>admin/order/printPDF',
            data: {lm07_order_id:lm07_order_id},
            type: 'post',
            dataType: 'JSON',
            beforeSend: function(){
              // $(".loading").addClass("pending_show");
              // $('.loading').html(uploading_text);
              $('#print_pdf').html('<i class="fa fa-refresh fa-spin fa-fw"></i><span class="sr-only">Loading...</span> 読み込み中...');
              $('#print_pdf').attr('disabled','disabled');
            },
            success: function(data){

              var a_pdf    = document.createElement("a");
              a_pdf.href   = data.filename_pdf;
              a_pdf.download = '';

              a_pdf.onclick = function () {
                setTimeout(function(){
                  delete_file(data);
                }, 2000);
              };

              document.body.appendChild(a_pdf);
              a_pdf.click();
              a_pdf.remove();

              // $('.loading').empty();
              // $('.loading').removeClass("pending_show");
              $('#print_pdf').html('印刷する');
              $('#print_pdf').removeAttr('disabled');
            },
    });
  });
</script>
</body>
</html>
