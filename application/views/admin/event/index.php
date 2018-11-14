
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
        <h3 class="tt_main">イベント一覧</h3>
        <?php if ($this->session->flashdata('category_success')) { ?>
        <div  id="message"><div class="w3-panel w3-green"><i class="fa fa-gratipay" aria-hidden="true"></i> <?= $this->session->flashdata('category_success') ?></div></div>
          <?php } ?>
        <div class="research_box">
          
          <form action="" id="search_event">
            <table class="formtable">
              <tr>
                <th>イベントID</th>
                <td><input type="text" class="input_30" name="id_event" id="id_event" value="">
                  <a style="margin-left: 20px" href="<?=base_url('admin/event/add')?>"><button class="btn btn_edit" data-url="export_order.php" type="button">イベントを追加する</button></a></td> 
              </tr>
              <tr>
                <th>イベント名</th>
                <td><input type="text" class="input_30" name="name_event" id="name_event" value=""></td>
              </tr>
              <tr>
                <th>開催日</th>
                <td>
                  <input type="text" class="input_30 readonly" name="fromdate" id="fromdate" value="" autocomplete="off"> ~ <input type="text" class="input_30 readonly" name="todate" id="todate" value="" autocomplete="off">
                </td>
              </tr>
              <tr>
                <th>表示</th>
                <td><label><input value="" type="radio" name="type" checked > 全て </label> <label><input value="1" type="radio" name="type" > する </label> <label><input value="0" type="radio" name="type" > しない </label></td>
              </tr>
            </table>
            <div class="search_cf">
              <input type="submit" class="btn btn_search" value="検索" name="btn_search" id="btn_search">
            </div>
          </form>
        </div>
        <div class="count_list"><?php echo $count; ?>件です。</div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>イベントID</th>
                <th>イベント名</th>
                <th>開催日</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody id="table">
              <!-- 2018年11月20日 -->
              <?php foreach ($list_all_event as $value) { ?>
              <tr>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['id_event_input']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['name_event']; ?></td>
                <td style="vertical-align: middle;text-align: center;"> <?php echo $value['date_start']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><a href="<?=base_url()?>admin/event/edit/<?php echo $value['id_event']; ?>"><button class="btn btn_edit" data-url="export_order.php" type="button">編集する</button></a>
              </tr>
            <?php } ?>
            </tbody>
            
          </table>
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
              <?php
            if (!empty($list_all_event)) {
              if($total_rows != 0 && $total_rows > 1){
                echo "<li class='btn_prev'><span>ページ ".$offset."/".$total_rows."</span></li>";
                echo $pagination;
              }
            }
      
              ?>
          </ul>
        </div>
        <input type="hidden"  name="this_page" id="this_page">
      </section>
       <!-- end sec01 -->
    </div><!-- main -->
  </div>
    
  <footer>
    
  </footer>
</div>
<!-- end wrapper -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=base_url()?>assets/js/japandatapicker.js"></script>
<script type="text/javascript">
  $('.m_event').addClass('active');
  $('.m_event').find('ul').addClass('active');
  $('.event_list').addClass('active');

  $(function(){
      $('#fromdate').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
      $('#todate').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
  });
</script>
</script>

  <script type="text/javascript">
    $('#search_event').submit(function (event) {
    event.preventDefault();
    var id_event = $('#id_event').val();
    var name_event = $('#name_event').val();
    var type = $('input[name="type"]:checked').val();
    var fromdate = $('#fromdate').val();
    var todate = $('#todate').val();
    $.ajax({
        url: '<?=base_url()?>admin/event/search',
        data: {
          id_event:id_event,
          name_event:name_event,
          type:type,
          fromdate:fromdate,
          todate:todate,
        },
        type: 'POST',
        success: function (data) {
          var obj = JSON.parse(data);
          console.log(obj);
          $('.table02').html(obj.data_html);
          $('.count_list').html(obj.data_count);
          if(obj.data_total_rows == 1 ||  obj.data_total_rows == 0) {
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
    var id_event = $('#id_event').val();
    var name_event = $('#name_event').val();
    var type = $('input[name="type"]:checked').val();
    var fromdate = $('#fromdate').val();
    var todate = $('#todate').val();
    $.ajax({
        url: '<?=base_url()?>admin/event/search/'+pageSearch,
        data: {
          id_event:id_event,
          name_event:name_event,
          type:type,
          fromdate:fromdate,
          todate:todate,
        },
        type: 'POST',
        success: function (data) {
          var obj = JSON.parse(data);
          $('.table02').html(obj.data_html);
         
          $('.pagination .page').html("<li class='btn_prev'><span>ページ "+obj.data_page+"/"+obj.data_total_rows+"</span></li>"+obj.data_pagination);
          $('#this_page').val(obj.data_this_page);
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

  $("#message").delay(3000).fadeOut("fast");
  </script>

  <script>
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
</script>

</body>
</html>