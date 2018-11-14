<div id="main">
      <section class="sec01">
        <h3 class="tt_main">マスター管理</h3>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="research_box">
          <form action="" method="post" id="search_parent">
            <table>
              <tr>
                <th>メールアドレス</th>
                <td><input type="text" name="lm01_email" id="lm01_email" value=""></td>
              </tr>
            </table>
            <div class="search_cf">
              <button type="submit" class="btn btn_search" id="btn_search">検索</button>
            </div>
          </form>
        </div>
        <div class="count_list" id="count_list"><?= $count; ?>件です。</div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>ユーザーID</th>
                <th>フルネーム</th>
                <th>状態</th>
                <th>メールアドレス</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_users as $list_user_item) {
                if($list_user_item['lm01_active_status'] == 1){
                  $status = '<font color="green">アクティブ</font>';
                } else {
                  $status = '<font color="red">インアクティブ</font>';
                }?>
                <tr class="text-center">
                  <td><?= $list_user_item['lm01_user_id'] ?></td>
                  <td><?= $list_user_item['lm01_firstname'].' '.$list_user_item['lm01_lastname']; ?></td>
                  <td><?= $status ?></td>
                  <td><?= $list_user_item['lm01_email'];?></td>
                  <td><input type="button" class="btn01 btn_edit" onclick="location.href='<?=base_url()?>admin/user/edit/<?=$list_user_item['lm01_user_id']?>'" value="編集"></td>
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
  $('.m_user').addClass('active');
  $('.m_user').find('ul').addClass('active');
  $('.parents_class').addClass('active');
</script>
<script>
  $("#message").delay(3000).fadeOut("fast");
  $('#search_parent').submit(function(event){
    event.preventDefault();
    var lm01_email = $('#lm01_email').val();

    $.ajax({
        url: 'user/search',
        data: {
          lm01_email:lm01_email
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
    var lm01_email = $('#lm01_email').val();
    $.ajax({
        url: '<?=base_url()?>admin/user/search/'+pageSearch,
        data: {
          lm01_email:lm01_email
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
</script>
</body>
</html>
