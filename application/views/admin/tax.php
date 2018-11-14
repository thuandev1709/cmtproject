
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
        <h3 class="tt_main">税金設定</h3>
        <div class="research_box">
          <?php if(!isset($id) || $id==""){ ?>
            <form action="<?=base_url('admin/event/add_tax')?>" id="search_parent" method="POST">
          <?php }else{ ?>
            <form action="<?=base_url('admin/event/edit_tax')?>" id="search_parent" method="POST"> 
          <?php } ?>
            <input type="hidden" name="" id="id_tax" value="<?php echo $id_max['lm14_tax_id']+1; ?>">
            <input type="hidden" name="id_tax_update" id="id_tax_update" value="<?php echo $Tax['lm14_tax_id']; ?>">
            <table class="formtable">
              <tr>
                <th>現在の税金率</th>
                <td><?php echo $date_max['lm14_percent']; ?>%</td>
              </tr>
              <tr>
                <th>税金ID</th>
                <?php if(!isset($id) || $id==""){ ?>
                  <td><?php echo $id_max['lm14_tax_id']+1; ?></td>
                <?php }else{ ?>
                  <td><?php echo $Tax['lm14_tax_id']; ?></td>
                <?php } ?>
              </tr>
              <tr>
                <th class="notnull">開始日</th>
                <td>
                  <?php 

                    $date_start=$Tax['lm14_date_start'];
                    $date_start_format = date('Y年m月d日', strtotime($date_start));
                    $date_end=$Tax['lm14_date_end'];
                    $date_end_format = date('Y年m月d日', strtotime($date_end));

                   ?>
                  <input type="text" class="input_30 readonly" name="fromdate" id="fromdate" autocomplete="off" value="<?php if(isset($id)){echo $date_start_format;}else{echo "";}?>" required> ~ <input type="text" class="input_30 readonly" name="todate" id="todate" autocomplete="off" value="<?php if(isset($id)){echo $date_end_format;}else{echo "";}?>" >
                </td>
              </tr>
              <tr>
                <th class="notnull">税金率</th>
                <td>
                  
                  <input type="tel" onkeydown="return isNumberKey(event)" pattern="\d*" class="input_30" name="percent" id="percent" value="<?php echo $Tax['lm14_percent']; ?>" required>%
                </td>
              </tr>
            </table>
            <div class="search_cf">
              <input type="submit" class="btn btn_search" value="設定" name="btn_insert_tax" id="btn_insert_tax">
            </div>
          </form>
        </div>
        <div class="count_list"></div>
        <form action="">
          <table class="table02">
            <thead>
              <tr>
                <th>税金ID</th>
                <th>開始日</th>
                <th>完了日</th>
                <th>税金率（％)</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody id="table">
              <!-- 2018年11月20日 -->
              <tr>
                <?php foreach ($list_tax as $value) {
                    
                 ?>

                <td style="vertical-align: middle;text-align: center;"><?php echo $value['id_tax']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['date_start']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['date_end']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $value['percent']; ?></td>
                <td style="vertical-align: middle;text-align: center;"><a href="<?=base_url()?>admin/event/tax/<?php echo $offset; ?>/<?php echo $value['id_tax']; ?>"><button class="btn btn_edit" data-url="export_order.php" type="button">編集する</button></a>
              </tr>
              <?php } ?>
            </tbody>
            
          </table>
        </form>
        <div class="pagination clearfix">
            <ul class="page clearfix">
              <?php
            if (!empty($list_tax)) {
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
  $('.m_tax').addClass('active');

  $(function(){
      $('#fromdate').datepicker({
        dateFormat: 'yy年mm月dd日'
      });
      $('#todate').datepicker({
        dateFormat: 'yy年mm月dd日'
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