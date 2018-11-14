
<style type="text/css" media="screen">
  .prev:hover, .next:hover {
    background-color: unset;
  }

  .prev, .next {
      padding: 0;
      border: none;

  }
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
      <section class="sec01">
        <h3 class="tt_main">お知らせ一覧</h3>
        <?php if ($this->session->flashdata('category_success')) { ?>
        <div id="message"><div class="w3-panel w3-green"><i class="fa fa-gratipay" aria-hidden="true"></i> <?= $this->session->flashdata('category_success') ?></div></div>
          <?php } ?>
        <div class="research_box">
          <form action="" method="post" id="search_parent">
            <table class="mb20 formtable">
              <tr>
                <th>お知らせID</th>
                <td><?=$latest_id->lm16_news_id+1?></td>
              </tr>
              <tr>
                <th class="notnull">日付</th>
                <td><input type="text" name="lm16_news_date" id="lm16_news_date" value="" required></td>
              </tr>
              <tr>
                <th class="notnull">タイトル</th>
                <td><input type="text" name="lm16_news_title" id="lm16_news_title" value="" required></td>
              </tr>
              <tr>
                <th class="notnull">内容</th>
                <td><textarea name="lm16_news_content" id="lm16_news_content" required></textarea></td>
              </tr>
              <tr>
                <th>状態</th>
                <td>
                  <label><input type="radio" name="lm16_news_status" value="1" checked > アクティブ </label>
                  <label><input type="radio" name="lm16_news_status" value="0" > インアクティブ </label>
                </td>
              </tr>
            </table>
            <div class="search_cf">
              <button type="submit" class="btn btn_update" id="btn_submit" name="btn_submit">保存する</button>
            </div>
          </form>
        </div>
        <div class="count_list" id="count_list"><?= $count; ?>件です。</div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>お知らせID</th>
                <th>日付</th>
                <th>タイトル</th>
                <th>内容</th>
                <th>状態</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_news as $list_news_item) {
                if($list_news_item['lm16_news_status'] == 1){
                  $status = '<font color="green">アクティブ</font>';
                } else {
                  $status = '<font color="red">インアクティブ</font>';
                }?>
                <tr class="text-center">
                  <td><?= $list_news_item['lm16_news_id'] ?></td>
                  <td><?= date('Y年m月d日',strtotime($list_news_item['lm16_news_date']))?></td>
                  <td><?= $list_news_item['lm16_news_title']?></td>
                  <td><?= limitTextChars($list_news_item['lm16_news_content'], 25, true, true)?></td>
                  <td><?= $status ?></td>
                  <td><input type="button" class="btn01 btn_edit" onclick="location.href='<?=base_url()?>admin/news/edit/<?=$list_news_item['lm16_news_id']?>'" value="編集する"></td>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
<script src="<?=base_url()?>assets/js/japandatapicker.js"></script>
<style>
.note-popover .note-popover-content, .note-toolbar {
    display: none;
}
</style>
<script type="text/javascript">
  $('.m_news').addClass('active');
  $("#message").delay(3000).fadeOut("fast");
  $(function(){
      $('#lm16_news_date').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
  });
  $(document).ready(function() {
    $('#lm16_news_content').summernote({
      height: 150,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      width: 400,
      toolbar: [
    // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
      ]
    });
  });
</script>

<script>
  function isNumberKey(evt)
    {
       var e = event || evt;
        var charCode = (e.which) ? e.which : product.keyCode;
       if(charCode == 59 || charCode == 46  )
        return true;
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
     }
</script>
<script>
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
</script>
</body>
</html>
