<div id="main">

  
      <section class="sec01">
        <h3 class="tt_main">店の情報</h3>
        <?php if ($this->session->flashdata('category_success')) { ?>
            <div  id="message"><div class="w3-panel w3-green"><i class="fa fa-gratipay" aria-hidden="true"></i> <?= $this->session->flashdata('category_success') ?></div></div>
        <?php } ?>

        <?php if ($this->session->flashdata('category_error')) { ?>
            <div  id="message"><div class="w3-panel w3-red"><i class="fa fa-gratipay" aria-hidden="true"></i> <?= $this->session->flashdata('category_error') ?></div></div>
        <?php } ?>

        <div class="research_box">

          <form method="POST" >
            <table class="mb20 formtable"> 
              <tr>
                <th class="">店の名前</th>
                <td>
                  <input type="text" class=""   name="name" value="<?=$info['lm12_name']?>" required >
                </td>
              </tr>
              <tr>
                <th class="">住所</th>
                <td>
                  <textarea name="address" required><?=$info['lm12_address']?></textarea>
                </td>
              </tr>
              <tr>
                <th class="">電話番号</th>
                <td>
                  <input type="text" class=""  onkeypress="return isNumberKey(event)" maxlength="20" name="phone" value="<?=$info['lm12_phone']?>" required>
                </td>
              </tr>
              <tr>
                <th class="">口座</th>
                <td>
                  <textarea name="info" required><?=$info['lm12_info_customer']?></textarea>
                </td>
              </tr>
            </table>
            <div class="form_button form_button02 clearfix">
              <input type="submit" class="btn btn_update" value="保存する" name="btnSubmit">
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
       var charCode = (evt.which) ? evt.which : product.keyCode;
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

</body>
</html>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $('#message').show().delay(4000).fadeOut("fast");   
  $('.m_info').addClass('active');
  // $('.m_product').find('ul').addClass('active');
  // $('.product_defaut').addClass('active');
</script>
<!-- <script type='text/javascript'src='http://senthilraj.github.io/TimePicki/js/timepicki.js'></script> -->
<script>
  window.jQuery || document.write('<script src="<?=base_url()?>assets/manage/common/js/jquery.js"><\/script>');
</script>
<!-- jQuery Fallback -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

