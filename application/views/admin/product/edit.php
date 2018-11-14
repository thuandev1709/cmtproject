<style type="text/css">
  table.table-quantity tr td {
    padding: 0 35px 0 0;
  }
  table.table-quantity tr td:nth-child(1) p,
  table.table-quantity tr td:nth-child(2) p {
    padding: 0 0 5px 0;
  }
  table.formtable tr th {
    vertical-align: middle;
  }
</style>
<div id="main">

      <section class="sec01">
        <h3 class="tt_main">商品を追加・編集する</h3>
        <div class="research_box">

          <form method="POST" action="<?php echo base_url() ?>admin/product/edit/<?php echo $product['lm04_pro_id'].'_'.$product['lm04_pro_type']; ?>">
            <table class="mb20 formtable"> 
              <tr>
                <th class="notnull">イベントID</th>
                <td>
                  <select name="lm4_event_id" id="lm4_event_id" required>
                    <option></option>
                    <?php foreach ($list_event as $ev) { ?>
                      <option <?php if(isset($value_event_id) && $ev['lm10_event_id'] == $value_event_id) echo "selected = selected"; ?> <?php if(isset($product['lm04_event_id']) && $ev['lm10_event_id'] == $product['lm04_event_id']) echo "selected = selected"; ?> value="<?php echo $ev['lm10_event_id'] ?>">
                          <?php echo $ev['lm10_event_id_input'] ?>
                      </option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th class="">イベント名</th>
                <td>
                  <p id="event_name">
                    <?php if(isset($value_event_name)) echo $value_event_name; ?>
                    <?php if(isset($product['lm10_event_name'])) echo $product['lm10_event_name']; ?>
                  </p>
                </td>
              </tr>
              <tr>
                <th class="notnull">商品種類</th>
                <td>
                  <label><input type="radio" id="lm04_pro_type" name="lm04_pro_type" value="0" <?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '0') echo "checked = checked"; ?> > 写真 </label> 
                  <label><input type="radio" id="lm04_pro_type" name="lm04_pro_type" value="1" <?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '1') echo "checked = checked"; ?> style="margin-left: 20px;"> 動画 </label>
                </td>
              </tr>
              <tr id="quantity_DVD" style="<?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '1') echo "display: contents"; else echo "display: none"; ?>">
                <th></th>
                <td style="display: inline-flex;">
                  <table border="0" class="table-quantity">
                    <tr>
                      <td><p><b>販売した枚数</b> <?php if(isset($totalQuantityDVDsell)) echo $totalQuantityDVDsell; else echo '0'; ?>枚</p></td>
                      <td><p><b>在庫枚数</b> <?php if(isset($product['lm04_pro_quantity'])) echo $product['lm04_pro_quantity'];?>枚</p></td>
                      <td><b>在庫追加</b> <input type="text" name="lm04_pro_quantity" id="lm04_pro_quantity" value="<?php if(isset($product['lm04_pro_quantity'])) echo $product['lm04_pro_quantity']; else echo '0'; ?>" style="width: 150px;" required> 枚</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr id="tr_category" style="<?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '0') echo "display: contents"; else echo "display: none"; ?>">
                <th class="notnull">写真区分</th>
                <td>
                  <select name="lm04_cate_id" id="lm04_cate_id" <?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '0') echo "required"; ?> style="min-width: 90px;">
                    <option></option>
                    <?php foreach ($list_category as $cate) { ?>
                      <?php if(isset($product)) { ?>
                        <?php if($cate['lm03_event_id'] == $product['lm10_event_id']) { ?>
                          <option <?php if(isset($product['lm04_cate_id']) && $cate['lm03_cate_id'] == $product['lm04_cate_id']) echo "selected = selected"; ?> value="<?php echo $cate['lm03_cate_id'] ?>">
                            <?php echo $cate['lm03_cate_name']; ?>
                          </option>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <button class="btn01 btn_edit" id="btnCategory">写真区分を追加する</button>
                </td>
              </tr>
              <tr>
                <th class="">商品名</th>
                <td>
                  <input type="text" class="" id="lm04_pro_name" name="lm04_pro_name" value="<?php if(isset($product['lm04_pro_name'])) echo $product['lm04_pro_name']; ?>"> 
                </td>
              </tr>

              <!-- Image -->
              <tr id="tr_image" style="<?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '0') echo "display: contents"; else echo "display: none"; ?>">
                <th class="">画像</th>
                <td class="max_img">
                  <input type='file' name="image_path" id="image_path" value />
                  <input type="button" class="btn01 btn_edit" id="upload_image" value="画像をアップロードする" style="width: auto;">
                  <div id="div_show_img"></div>
                  <div id="show_del" style="position: relative;">
                    <?php if(isset($product['lm05_image_rename']) && $product['lm05_image_rename'] != '') { ?>
                      <img id="image_show" src="<?php echo base_url() ?>upload/image/<?php echo $product['lm05_image_rename']; ?>" height="200" style="margin-top: 5px;">
                      <input type="hidden" name="image_now" id="image_now" value="<?php echo $product['lm05_image_rename']; ?>">
                      <span id="itemImage"><br>
                        <a id="del_image" class="" data-id="" name="" style="cursor: pointer; text-decoration: none;">
                          <img src="<?php echo  base_url() ?>assets/admin/common/images/icon_del_image.png" style="margin: 2px 5px 0 0;">
                          <span><u><?php echo $product['lm05_image_name']; ?></u></span>
                        </a>
                      </span>
                    <?php } ?>
                  </div>
                  <input type="hidden" id="image_upload" name="image_upload" value="<?php if(isset($product['lm05_image_name']) && $product['lm05_image_name'] != '') echo $product['lm05_image_name']; ?>" />
                </td>
                <input type="hidden" name="image_before" id="image_before" value="<?php if(isset($product['lm05_image_rename'])) echo $product['lm05_image_rename']; ?>">
                <input type="hidden" id="delete_image" name="delete_image" value="0">
              </tr>
              <!-- End Image -->

              <!-- Video -->
              <tr id="tr_video" style="<?php if(isset($product['lm04_pro_type']) && $product['lm04_pro_type'] == '1') echo "display: contents"; else echo "display: none"; ?>">
                <th class="">映画</th>
                <td>
                  <input type='file' name="video_path" id="video_path" value />
                  <input type="button" class="btn01 btn_edit" id="upload_video" value="ビデオをアップロードする" style="width: auto;">
                  <div id="div_show_video"></div>
                  <div id="show_del_video" style="position: relative;">
                    <?php if(isset($product['lm06_movie_rename']) && $product['lm06_movie_rename'] != '') { ?>
                    <video id="video_show" height="200" controls="" style="margin-top: 5px;">
                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product['lm06_movie_rename']; ?>" type="video/avi">
                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product['lm06_movie_rename']; ?>" type="video/flv">
                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product['lm06_movie_rename']; ?>" type="video/mp4">
                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product['lm06_movie_rename']; ?>" type="video/wmv">
                      <source src="<?php echo base_url() ?>upload/movie/<?php echo $product['lm06_movie_rename']; ?>" type="video/mov">
                      お使いのブラウザはHTML5ビデオをサポートしていません。
                    </video>
                    <input type="hidden" name="video_now" id="video_now" value="<?php echo $product['lm06_movie_rename']; ?>">
                    <span id="itemVideo"><br>
                      <a id="del_video" class="" data-id="" name="" style="cursor: pointer; text-decoration: none;">
                        <img src="<?php echo  base_url() ?>assets/admin/common/images/icon_del_image.png" style="margin: 2px 5px 0 0;">
                        <span><u><?php echo $product['lm06_movie_name']; ?></u></span>

                      </a>
                    </span>
                    <?php } ?>
                  </div>
                  <input type="hidden" id="video_upload" name="video_upload" value="<?php if(isset($product['lm06_movie_name']) && $product['lm06_movie_name'] != '') echo $product['lm06_movie_name']; ?>" />
                </td>
                <input type="hidden" name="video_before" id="video_before" value="<?php if(isset($product['lm05_image_rename'])) echo $product['lm05_image_rename']; ?>">
                <input type="hidden" id="delete_video" name="delete_video" value="0">
              </tr>
              <!-- End Video -->

              <tr>
                <th class="notnull">単価</th>
                <td>
                  <input type="text" class="" id="lm04_pro_price" name="lm04_pro_price" value="<?php if(isset($product['lm04_pro_price'])) echo $product['lm04_pro_price']; else echo '0'; ?>" required> 円
                </td>
              </tr>
              <tr>
                <th class="">表示</th>
                <td>
                  <label><input type="radio" name="lm04_display" value="1" <?php if(isset($product['lm04_display']) && $product['lm04_display'] == '1') echo "checked = checked"; ?> > する </label> 
                  <label><input type="radio" name="lm04_display" value="0" <?php if(isset($product['lm04_display']) && $product['lm04_display'] == '0') echo "checked = checked"; ?> style="margin-left: 20px;"> しない </label>
                </td>
              </tr>
            </table>
            <div class="form_button form_button02 clearfix">
              <input type="submit" class="btn btn_update" value="保存する。" name="btnEditProduct" id="btnEditProduct">
              <input type="button" class="btn" value="クリア" name="reset" id="reset">
              <input type="button" class="btn btn_delete" name="btn_delete" onclick="location.href='<?=base_url()?>admin/product/deleteProduct/<?php echo $product['lm04_pro_id']; ?>'" value="削除する">
              <input type="button" class="btn" value="他の商品を追加する" name="btnNoSubmit" onclick="location.href='<?=base_url()?>admin/product/addFollowEvent/<?php echo $product['lm04_event_id']; ?>'">
              <input type="hidden" name="lm04_pro_id" id="lm04_pro_id" value="<?php echo $product['lm04_pro_id']; ?>">
            </div>
          </form>
        </div>
      </section>
       <!-- end sec01 -->
    </div><!-- main -->

<!-- end wrapper -->
</body>
</html>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $('.m_product').addClass('active');
  $('.m_product').find('ul').addClass('active');
  $('.product_add').addClass('active');
</script>
<script>
  window.jQuery || document.write('<script src="<?=base_url()?>assets/manage/common/js/jquery.js"><\/script>');
</script>
<!-- jQuery Fallback -->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<script>

  $('#lm4_event_id').on('change', function() {
    var event_id = this.value;
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url('admin/Product/getNameEvent') ?>",
      data: 'event_id='+event_id,
      success: function(data) {
        console.log(data);
        $('#event_name').empty();
        $('#event_name').html(data);
      }
    });

    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?php echo base_url('admin/Product/getCategoryWithEvent') ?>",
      data: 'event_id='+event_id,
      success: function(data) {
        console.log(data);
        $('#lm04_cate_id').empty();
        $('#lm04_cate_id').append($('<option>').text('').attr('value', ''));
        $.each(data, function(i, obj){
          $('#lm04_cate_id').append($('<option>').text(obj.lm03_cate_name).attr('value', obj.lm03_cate_id));
        });
      }
    });

  });

  $('input[type=radio][name=lm04_pro_type]').change(function() {
    if (this.value == '1') {
      $("#quantity_DVD").css("display", "contents");
      $("#tr_image").css("display", "none");
      $("#tr_video").css("display", "contents");
      $("#tr_category").css("display", "none");
      $("#lm04_cate_id").removeAttr("required");

      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/Product/getPriceAjaxDVD') ?>",
        success: function(data) {
          $('#lm04_pro_price').empty();
          $('#lm04_pro_price').val(data);
        }
      });
    }
    else {
      $("#quantity_DVD").css("display", "none");
      $("#tr_video").css("display", "none");
      $("#tr_image").css("display", "contents");
      $("#tr_category").css("display", "contents");
      $("#lm04_cate_id").attr("required", "required");

      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/Product/getPriceAjaxImage') ?>",
        success: function(data) {
          $('#lm04_pro_price').empty();
          $('#lm04_pro_price').val(data);
        }
      });
    }
  });

  $("#lm04_pro_price").on("keypress keyup blur",function (event) {    
     $(this).val($(this).val().replace(/[^\d].+/, ""));
      if ((event.which < 48 || event.which > 57)) {
          event.preventDefault();
      }
  });

  $(document).ready(function(){
    $("#upload_image").click(function(event){
      var lm04_pro_id = document.getElementById('lm04_pro_id').value;
      var image_path = document.getElementById('image_path').value;
      
      if(image_path !== '') {
        var confirm_upload = confirm("この画像をアップロードしますか？");
        if (confirm_upload) {

          var $form = $('form')
            var $inputs = $('input[name="image_path"]:not([disabled])', $form)
            $inputs.each(function(_, input) {
              if (input.files.length > 0) return
              $(input).prop('disabled', true)
            })
            var formData = new FormData($form[0])
            $inputs.prop('disabled', false)

          var name = document.getElementById('image_path');
          var ext = name.files.item(0).type;
          var filename = name.files.item(0).name;
          var dotIndex = filename.lastIndexOf('.');
          ext = filename.substr(dotIndex, filename.length -1);

          // Check allowed extension
          if($.inArray(ext, [ '.jpg',
                              '.jpeg',
                              '.png',
                              '.gif',
                              '.JPG',
                              '.JPEG',
                              '.PNG',
                              '.GIF']) == -1){
            alert('ファイルはサポートされていません');
            // console.log(ext);
            return false;
          } else {
            $.ajax({
              url: "<?php echo base_url('admin/Product/uploadImage/') ?>"+lm04_pro_id,
              data: formData,
              processData: false,
              contentType: false,
              type: 'POST',

            })
            .done(function(data){
              console.log(data);
              arr_data = data.split("-");
              file_rename = arr_data[0];
              ext = arr_data[1];

              result = '<img id="image_show" src="<?php echo base_url('upload/image/') ?>'+file_rename+'" height="200" style="margin-top: 5px;" />';
              result+= '<span id="itemImage"><br>';
              result+= '<a href="javascript:void(0)" id="del_image" class="" data-id="" name="" style="">';
              result+= '<img src="<?php echo base_url('assets/admin/common/images/icon_del_image.png') ?>" style="margin: 2px 5px 0 0;" >';
              result+= '<span>'+filename+'</span>';
              result+= '</a>';
              result+= '</span>';
              result+= '<input type="hidden" id="image_now" name="image_now" value="'+file_rename+'" />';
              result+= '<input type="hidden" id="img_ol" name="img_ol" value="" />';

              $("#itemImage").remove();
              $('#image_show').remove();
              $("#show_del").append(result);
              $('#delete_image').val(0);
              $('#image_path').val('');
              $("#image_upload").val(filename);

              var unique = $.now();
              $('#image_show').attr('src', '<?php echo base_url('upload/image/') ?>'+file_rename+'?' + unique);
            })
          }
        }
      }
    });

    $(document).on('click','#del_image', function(e){
        var conform_del = confirm("この画像を削除しますか？");
        if (conform_del) {
          var file_rename = $('#image_now').val();
          $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/Product/deleteImage/') ?>"+file_rename,
            data: 'file_rename='+file_rename,
            success: function(data) {
              $('#delete_image').val(1);
              $('#itemImage').remove();
              $('#image_show').remove();
              $("#image_upload").val('');
            }
          });
        }
    });

    // ---------------Upload video---------------
    $("#upload_video").click(function(event){
      var lm04_pro_id = document.getElementById('lm04_pro_id').value;
      var video_path = document.getElementById('video_path').value;      
      if(video_path !== '') {
        var confirm_upload = confirm("この動画をアップロードしますか？");
        if (confirm_upload) {

          var $form = $('form')
            var $inputs = $('input[name="video_path"]:not([disabled])', $form)
            $inputs.each(function(_, input) {
              if (input.files.length > 0) return
              $(input).prop('disabled', true)
            })
            var formData = new FormData($form[0])
            $inputs.prop('disabled', false)

          var name = document.getElementById('video_path');
          var ext = name.files.item(0).type;
          var filename = name.files.item(0).name;
          var dotIndex = filename.lastIndexOf('.');
          ext = filename.substr(dotIndex, filename.length -1);

          // Check allowed extension
          if($.inArray(ext, [ '.AVI',
                              '.FLV',
                              '.WMV',
                              '.MP4',
                              '.MOV',
                              '.avi',
                              '.flv',
                              '.wmv',
                              '.mp4',
                              '.mov']) == -1){
            alert('ファイルはサポートされていません');
            // console.log(ext);
            return false;
          } else {
            $.ajax({
              url: "<?php echo base_url('admin/Product/uploadVideo/') ?>"+lm04_pro_id,
              data: formData,
              processData: false,
              contentType: false,
              type: 'POST',

            })
            .done(function(data){
              console.log(data);
              arr_data = data.split("-");
              file_rename = arr_data[0];
              ext = arr_data[1];

              result = '<video id="video_show" height="200" controls style="margin-top: 5px;">';
              result+= '<source src="<?php echo base_url('upload/movie/') ?>'+file_rename+'" type="video/mp4">';
              result+= 'お使いのブラウザはHTML5ビデオをサポートしていません。';
              result+= '</video>';
              result+= '<span id="itemVideo"><br>';
              result+= '<a href="javascript:void(0)" id="del_video" class="" data-id="" name="" style="">';
              result+= '<img src="<?php echo base_url('assets/admin/common/images/icon_del_image.png') ?>" style="margin: 2px 5px 0 0;" >';
              result+= '<span>'+filename+'</span>';
              result+= '</a>';
              result+= '</span>';
              result+= '<input type="hidden" id="video_now" name="video_now" value="'+file_rename+'" />';
              result+= '<input type="hidden" id="video_ol" name="video_ol" value="" />';

              $("#itemVideo").remove();
              $('#video_show').remove();
              $("#show_del_video").append(result);
              $('#delete_video').val(0);
              $('#video_path').val('');
              $("#video_upload").val(filename);

              var unique = $.now();
              $('#video_show').attr('src', '<?php echo base_url('upload/movie/') ?>'+file_rename+'?' + unique);
            })
          }
        }
      }
      var unique = $.now();
      $('#video_show').attr('src', '<?php echo base_url('upload/movie/') ?>'+file_rename+'?' + unique);
    });

    $(document).on('click','#del_video', function(e){
        var conform_del = confirm("この動画を削除しますか？");
        if (conform_del) {
          var file_rename = $('#video_now').val();
          $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/Product/deleteVideo/') ?>"+file_rename,
            data: 'file_rename='+file_rename,
            success: function(data) {
              $('#delete_video').val(1);
              $('#itemVideo').remove();
              $('#video_show').remove();
              $("#video_upload").val('');
            }
          });
        }
    });
    // ---------------End upload video---------------
  });
  
  $("#reset").click(function() {
    $(this).closest('form').find("input[type=file], select").val("");
    $("input[name=lm04_pro_type]").filter("[value='0']").prop("checked",true);
    $("input[name=lm04_display]").filter("[value='1']").prop("checked",true);
    $("#event_name").html('');
    $("#lm04_pro_name").val('');
    $("#quantity_DVD").css("display", "none");
    $("#tr_video").css("display", "none");
    $("#tr_image").css("display", "contents");
    $("#show_del").empty();
    $("#show_del_video").empty();
    $("#image_upload").val('');
    $("#video_upload").val('');
  });

  $('#btnCategory').click( function() {
    window.location.href = '<?php echo base_url() ?>admin/category';
    return false;
  });

  $("#btnEditProduct").on('click', function() {
    var lm04_pro_type = $("input[id='lm04_pro_type']:checked"). val();
    console.log(lm04_pro_type);
    var image_upload = $("#image_upload").val();
    var video_upload = $("#video_upload").val();

    if (lm04_pro_type == '0') {
      if (image_upload == '') {
        console.log('画像を選んでください！');
        alert("画像を選んでください！");
        return false;
      }
    }else {
      if (video_upload == '') {
        console.log('映画を選んでください！');
        alert("映画を選んでください！");
        return false;
      }
    }
  });
</script>