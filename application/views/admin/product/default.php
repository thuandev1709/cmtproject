<div id="main">
      <section class="sec01">
        <h3 class="tt_main">商品のデフォルト値を設定する</h3>

        <?php if ($this->session->flashdata('update_value_default_success')) { ?>
        <div id="message">
          <div class="w3-panel w3-green">
            <i class="fa fa-gratipay" aria-hidden="true"></i><?= $this->session->flashdata('update_value_default_success') ?>
          </div>
        </div>
        <?php } ?>

        <div class="research_box">
          <form id="form_default" method="POST" action="<?php echo base_url() ?>admin/product/valuedefault">
            <table class="mb20 formtable">
              <tr>
                <th class="notnull">画像の単価</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_1"  name="lm11_value_1" value="<?php if(isset($value_default[0])) echo $value_default[0]; ?>" required> 円
                </td>
              </tr>
              <tr>
                <th class="notnull">DVDの単価</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_2"  name="lm11_value_2" value="<?php if(isset($value_default[1])) echo $value_default[1]; ?>" required> 円
                </td>
              </tr>
              <tr>
                <th class="notnull">運送料金</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_3"  name="lm11_value_3" value="<?php if(isset($value_default[2])) echo $value_default[2]; ?>" required> 円
                </td>
              </tr>
              <tr>
                <th class="notnull">USB 料金</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_7"  name="lm11_value_7" value="<?php if(isset($value_default[6])) echo $value_default[6]; ?>" required> 円
                </td>
              </tr>
              <tr>
                <th class="notnull">掲載期限</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_4"  name="lm11_value_4" value="<?php if(isset($value_default[3])) echo $value_default[3]; ?>" required> 日
                </td>
              </tr>
              <tr>
                <th class="notnull">最初のDVD枚数</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_5"  name="lm11_value_5" value="<?php if(isset($value_default[4])) echo $value_default[4]; ?>" required> 枚
                </td>
              </tr>
              <tr>
                <th class="notnull">警告DVD枚数</th>
                <td>
                  <input type="tel" pattern="\d*" class=""  id="lm11_value_6"  name="lm11_value_6" value="<?php if(isset($value_default[5])) echo $value_default[5]; ?>" required> 枚
                </td>
              </tr>

            </table>
            <div class="form_button form_button02 clearfix">
              <input type="submit" class="btn btn_update" value="保存する" name="btnSetDefault">
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

</body>
</html>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $('.m_product').addClass('active');
  $('.m_product').find('ul').addClass('active');
  $('.product_defaut').addClass('active');
</script>
<script>
  window.jQuery || document.write('<script src="<?=base_url()?>assets/manage/common/js/jquery.js"><\/script>');
</script>
<!-- jQuery Fallback -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
  $("#form_default").on("keypress keyup blur",function (event) {
     $(this).val($(this).val().replace(/[^\d].+/, ""));
      if ((event.which < 48 || event.which > 57)) {
          event.preventDefault();
      }
  });
  $("#message").delay(2000).fadeOut("fast");
</script>
