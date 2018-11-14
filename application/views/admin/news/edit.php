
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
        <h3 class="tt_main">お知らせを編集する</h3>
        <?php if ($this->session->flashdata('category_success')) { ?>
        <div id="message"><div class="w3-panel w3-green"><i class="fa fa-gratipay" aria-hidden="true"></i> <?= $this->session->flashdata('category_success') ?></div></div>
          <?php } ?>
        <div class="research_box">
          <form action="" method="post" id="search_parent">
            <table class="mb20 formtable">
              <tr>
                <th>お知らせID</th>
                <td><?=$news['lm16_news_id']?></td>
              </tr>
              <tr>
                <th class="notnull">日付</th>
                <td><input type="text" name="lm16_news_date" id="lm16_news_date" value="<?=date('Y年m月d日',strtotime($news['lm16_news_date']))?>" required></td>
              </tr>
              <tr>
                <th class="notnull">タイトル</th>
                <td><input type="text" name="lm16_news_title" id="lm16_news_title" value="<?=$news['lm16_news_title']?>" required></td>
              </tr>
              <tr>
                <th class="notnull">内容</th>
                <td><textarea name="lm16_news_content" id="lm16_news_content" required><?=$news['lm16_news_content']?></textarea></td>
              </tr>
              <tr>
                <th>状態</th>
                <td>
                  <label><input type="radio" name="lm16_news_status" value="1" <?=($news['lm16_news_status'] == 1) ? 'checked' : ''?> > アクティブ </label>
                  <label><input type="radio" name="lm16_news_status" value="0" <?=($news['lm16_news_status'] == 0) ? 'checked' : ''?>> インアクティブ </label>
                </td>
              </tr>
            </table>
            <div class="search_cf">
              <button type="submit" class="btn btn_update" id="btn_submit" name="btn_submit">保存する</button>
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
