<style type="text/css" media="screen">
  .prev:hover, .next:hover {
    background-color: unset; 
  }
  .prev, .next {
      padding: 0;
      border: none;
  }
</style>
<div id="main">
      <section class="sec01">
        <h3 class="tt_main">商品一覧</h3>
        <?php if ($this->session->flashdata('product_success')) { ?>
        <div id="message">
          <div class="w3-panel w3-green">
            <i class="fa fa-gratipay" aria-hidden="true"></i><?= $this->session->flashdata('product_success') ?>
          </div>
        </div>
        <?php } ?>
        <div class="research_box">
          <form action="" id="formSearchProduct">
            <table class="formtable">
              <tr>
                <th>イベントID</th>
                <td>
                  <input type="text" class="input_30" name="lm10_event_id" id="lm10_event_id" value="">
                </td>
              </tr>
              <tr>
                <th>イベント名</th>
                <td><input type="text" class="input_30" name="lm10_event_name" id="lm10_event_name" value=""></td>
              </tr>
              <tr>
                <th>開催日</th>
                <td>
                  <input type="text" class="input_30" name="lm10_date_start" id="lm10_date_start" value="" > ~ <input type="text" class="input_30" name="lm10_date_end" id="lm10_date_end" value="">
                </td>
              </tr>
              <tr>
                <th>商品名</th>
                <td><input type="text" class="input_30" name="lm04_pro_name" id="lm04_pro_name" value=""></td>
              </tr>
              <tr>
                <th>商品種類</th>
                <td>
                  <label><input type="radio" id="lm04_pro_type" name="lm04_pro_type" value="" checked> 全て </label>
                  <label><input type="radio" id="lm04_pro_type" name="lm04_pro_type" value="0" style="margin-left: 20px;"> 写真 </label>
                  <label><input type="radio" id="lm04_pro_type" name="lm04_pro_type" value="1" style="margin-left: 20px;"> 動画 </label>
                </td>
              </tr>
            </table>
            <div class="search_cf">
              <input type="submit" class="btn btn_search" value="検索" id="btnSearchProduct" style="cursor: pointer;">
            </div>
          </form>
        </div>
        <div class="count_list"><?php echo $total_product; ?>件です。</div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th style="width: 25%">イベントID</th>
                <th style="width: 25%">イベント名</th>
                <th style="width: 25%">商品ID/商品名/種類</th>
                <th style="width: 25%" colspan="2">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $rowspan = 0;
                foreach ($list_product_pagi as $ev_pro) {
                $product_of_event = count($ev_pro['list_product_ev']);
                if ($product_of_event > 0) {
                  $rowspan = $product_of_event +1;
                }else {
                  $rowspan = 0;
                }
              ?>
                <tr>
                  <td <?php if($rowspan > 0) echo "rowspan=$rowspan"; ?> ><?php echo $ev_pro['lm10_event_id_input']; ?></td>
                  <td <?php if($rowspan > 0) echo "rowspan=$rowspan"; ?>><?php echo $ev_pro['lm10_event_name']; ?></td>
                  <td style="padding: 0px;"></td>
                  <?php if(!empty($ev_pro['list_product_ev'])) { ?>
                    <td style="padding: 0px;"></td>
                    <td <?php if($rowspan > 0) echo "rowspan=$rowspan"; ?> style="text-align: center;">
                      <input type="button" class="btn01 btn_add" onclick="location.href='<?=base_url()?>admin/product/addFollowEvent/<?php echo $ev_pro['lm10_event_id']; ?>'" value="商品を追加する">
                    </td>
                  <?php } else { ?>
                    <td colspan="3" style="text-align: center;">
                      <input type="button" class="btn01 btn_add" onclick="location.href='<?=base_url()?>admin/product/addFollowEvent/<?php echo $ev_pro['lm10_event_id']; ?>'" value="商品を追加する">
                    </td>
                  <?php } ?>
                </tr>
                <?php if(!empty($ev_pro['list_product_ev'])) { ?>
                  <?php 
                    foreach ($ev_pro['list_product_ev'] as $pro) {
                      if ($pro['lm04_pro_type'] == '0') {
                        $lm04_pro_type_name = '写真';
                      }else {
                        $lm04_pro_type_name = '動画';
                      }
                  ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $pro['lm04_pro_id'].'/'.$pro['lm04_pro_name'].'/'.$lm04_pro_type_name; ?></td>
                      <td style="text-align: center; width: 13%">
                        <input type="button" class="btn01 btn_edit" onclick="location.href='<?=base_url()?>admin/product/edit/<?php echo $pro['lm04_pro_id'].'_'.$pro['lm04_pro_type']; ?>'" value="編集する">
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>
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
        <input type="hidden" name="this_page" id="this_page">
      </section>
      <!-- end sec01 -->
    </div><!-- main -->
  </div>
  <footer></footer>
</div>
<!-- end wrapper -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  $('.m_product').addClass('active');
  $('.m_product').find('ul').addClass('active');
  $('.product_list').addClass('active');
</script>
<script>
  $('#lm10_date_start').datepicker({
    dateFormat: 'yy/mm/dd'
  });
  $('#lm10_date_end').datepicker({
    dateFormat: 'yy/mm/dd'
  });

  $('#formSearchProduct').submit(function (event) {
    event.preventDefault();
    var lm10_event_id   = $('#lm10_event_id').val();
    var lm10_event_name = $('#lm10_event_name').val();
    var lm10_date_start = $('#lm10_date_start').val();
    var lm10_date_end   = $('#lm10_date_end').val();
    var lm04_pro_name   = $('#lm04_pro_name').val();
    var lm04_pro_type   = $('input[id=lm04_pro_type]:checked', '#formSearchProduct').val();
  
    $.ajax({
        url: '<?=base_url()?>admin/product/searchProduct',
        data: {
          lm10_event_id   : lm10_event_id,
          lm10_event_name : lm10_event_name,
          lm10_date_start : lm10_date_start,
          lm10_date_end   : lm10_date_end,
          lm04_pro_name   : lm04_pro_name,
          lm04_pro_type   : lm04_pro_type
        },
        type: 'POST',
        success: function (data) {
          console.log(data);
          var obj = JSON.parse(data);
          console.log(obj);
          $('.table02').html(obj.data_html);
          $('.count_list').html(obj.data_count);
          if(obj.data_total_rows == 1) {
            $('.pagination .page').html("<li class='btn_prev'><span></span></li>");
          } else {
            $('.pagination .page').html("<li class='btn_prev'><span>ページ "+obj.data_page+"/"+obj.data_total_rows+"</span></li>"+obj.data_pagination);
            $('#this_page').val(obj.data_this_page);
            rewrite_onclick();
          }
        }
    });
  });
  function F_pageSearch(pageSearch){
    var lm10_event_id   = $('#lm10_event_id').val();
    var lm10_event_name = $('#lm10_event_name').val();
    var lm10_date_start = $('#lm10_date_start').val();
    var lm10_date_end   = $('#lm10_date_end').val();
    var lm04_pro_name   = $('#lm04_pro_name').val();
    var lm04_pro_type   = $('input[id=lm04_pro_type]:checked', '#formSearchProduct').val();

    $.ajax({
        url: '<?=base_url()?>admin/Product/searchProduct/'+pageSearch,
        data: {
          lm10_event_id   : lm10_event_id,
          lm10_event_name : lm10_event_name,
          lm10_date_start : lm10_date_start,
          lm10_date_end   : lm10_date_end,
          lm04_pro_name   : lm04_pro_name,
          lm04_pro_type   : lm04_pro_type
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
  $("#message").delay(2000).fadeOut("fast");
</script>
</body>
</html>