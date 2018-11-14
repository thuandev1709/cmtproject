<div id="main">
      <section class="sec01">
        <h3 class="tt_main">写真区分を管理する</h3>
        <div class="research_box">
          <?php if(!isset($id) || $id==""){ ?>
            <form action="<?=base_url('admin/category/add_category')?>" id="search_parent" method="POST">
          <?php }else{ ?>
            <form action="<?=base_url('admin/category/edit_category')?>" id="search_parent" method="POST">
          <?php } ?>
            <input type="hidden" name="id_category" id="id_category" value="<?php echo $id_max['lm03_cate_id']+1; ?>">
            <input type="hidden" name="id_category_update" id="id_category_update" value="<?php echo $Category_ById['lm03_cate_id']; ?>">
            <table class="formtable">
              <tr>
                <th class="notnull">イベントID</th>
                <td>
                  <select id="event_key" name="event_key" required>
                    
                    <option value=""></option>
                    <?php
                      foreach ($list_event as $key ) {
                    ?>
                    <option value="<?php echo $key['lm10_event_id'];?>" <?php echo ($key['lm10_event_id']) == $Category_ById['lm03_event_id'] ? 'selected' : ''; ?>><?php echo $key['lm10_event_id_input'];?></option>
                  <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>イベント名</th>
                
                  <td id="name_id"><?php echo $Category_ById['lm10_event_name']; ?></td>
                
              </tr>
              <tr>
                <th>写真区分ID</th>

                <?php if(!isset($id) || $id==""){ ?>
                  <td><?php echo $id_max['lm03_cate_id']+1; ?></td>
                <?php }else{ ?>
                  <td><?php echo $Category_ById['lm03_cate_id']; ?></td>
                <?php } ?>
              </tr>
              <tr>
                <th class="notnull">写真区分名</th>
                <td><input type="text" class="input_30" name="name_category" id="name_category" required value="<?php echo $Category_ById['lm03_cate_name']; ?>"></td>
              </tr>
              
            </table>
            <div class="search_cf">
              <input type="submit" class="btn btn_save" value="保存する" id="btn_search">
            </div>
          </form>
        </div>
        <div class="count_list"></div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>イベントID</th>
                <th>写真区分ID</th>
                <th>写真区分名</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_category as $value) { ?>
              <tr>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['id_event_input']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['id_category']; ?></td>
                <td style="vertical-align: middle;text-align: center;"> <?php echo $value['name_category']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><a href="<?=base_url()?>admin/category/index/<?php echo $offset; ?>/<?php echo $value['id_category']; ?>"><button class="btn btn_edit" data-url="export_order.php" type="button">編集する</button></a>
              </tr>
            <?php } ?>
              
            </tbody>
            
          </table>
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
              <?php
            if (!empty($list_category)) {
              if($total_rows != 0 && $total_rows > 1){
                echo "<li class='btn_prev'><span>ページ ".$offset."/".$total_rows."</span></li>";
                echo $pagination;
              }
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
  $('.m_product').addClass('active');
  $('.m_product').find('ul').addClass('active');
  $('.product_category').addClass('active');

  $data = [<?php
      foreach ($list_event as $key ) {
        $a = $key['lm10_event_id'];
        $b = $key['lm10_event_name'];
        echo "{id: '$a', name: '$b'},";
      }
    ?>];

  $('#event_key').change(function(){
    var id = $(this).val();
    for (var i = 0; i < $data.length; i++) {
      if($data[i]['id'] == id){
        $('#name_id').html($data[i]['name']);
      }
      var event_key = $('#event_key').val();
      if (event_key=='') {
      $('#name_id').html('');
      }
    }

  });
  
  
</script>
</body>
</html>