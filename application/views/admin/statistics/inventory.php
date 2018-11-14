<div id="main">
<!-- /////////////////////////////// -->
  <div class="container">
  <!-- Trigger the modal with a button -->

    <!-- <input type="hidden" id='bt_modal' class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" value="add" /> -->



      <!-- Modal content-->
      <div id="add_stock_popup" class="modal">
         <div id="loading"></div>
         <form action="" id="add_stock_form" method="post">
           <div style="font-size: 16px;margin-bottom: 10px;font-weight: bold">在庫追加<br> <span id='event_name'></span> (<span id='event_id'></span>) - <span id='product_id'></span><span id='product_name'></span></div>
           <input onkeypress="return isNumberKey(event)" id="add_quantity" class="student_name_input_popup" name="add_quantity" value="" placeholder="ここに番号を入力してください" required ><br>
           <p id='total_qua'></p>
           <p id='current_qua'></p>
           <div style="margin-top: 20px; text-align: center">
            <button type="submit" id="add_stock_btn" name ="btn_add" class="btn btn_update">保存する。</button>
          </div>
         </form>
       </div>

</div>
<!-- /////////////////////////////// -->

      <section class="sec01">
        <h3 class="tt_main">DVD在庫の警告を集計する</h3>


          <table class="table02">
            <thead>
              <tr>
                <th>イベントID</th>
                <th>イベント名</th>
                <th>DVD id/商品名</th>
                <th>枚数 </th>
                <th>販売した枚数 </th>
                <th>在庫数 </th>
                <th>操作 </th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($L_product!=""){
              foreach ($L_product as $aListP ) {

               ?>

              <tr>
                <td rowspan="<?=$aListP['total_event']?>"><?=$aListP['id_event_input']?></td>
                <td rowspan="<?=$aListP['total_event']?>"><?=$aListP['name_event']?></td>
                <?php foreach ($aListP['list_pro'] as $bListP ) {
                ?>
<!-- isset type and active -->


                <td><?php if(isset($bListP['lm04_pro_id'])&&$bListP['lm04_pro_name']!=NULL){
                  echo $bListP['lm04_pro_id'].'/'.$bListP['lm04_pro_name'];
                }else if(isset($bListP['lm04_pro_id'])&&$bListP['lm04_pro_name']==NULL){
                  echo $bListP['lm04_pro_id'];
                } ?></td>
                <td>
                  <?php
                  if(isset($bListP['lm04_pro_id'])){
                     echo  $bListP['sumqt']+$bListP['lm04_pro_quantity'];
                  }
                  ?>
                  </td>
            <td><?php if(!isset($bListP['sumqt']) && isset($bListP['lm04_pro_name'])){
                 echo "0";
                }else{
                  echo $bListP['sumqt'];
                } ?></td>
                <td><?php
                  echo $bListP['lm04_pro_quantity'];


                ?></td>
                <td ><button  id_pro = '<?=$bListP['lm04_pro_id']; ?>' cr_qu = '<?=$bListP['lm04_pro_quantity']; ?>' event_id ='<?=$aListP['id_event_input']?>' event_name ='<?=$aListP['name_event']?>' product_name="<?=$bListP['lm04_pro_name']?>" class="btn01">追加する</button></td>
              </tr>
               <?php } } }else{ ?>
                <td colspan="7" style="text-align: center;">結果はありません。</td>

               <?php } ?>

            </tbody>
          </table>

        <div class="pagination clearfix">
            <ul class="page clearfix">
                 <?php
              if(!isset($_POST['btn_search'])){
                if($total_rows != 0 && $total_rows > 1){

                  if($offset==0){
                      $offset = 1;
                  }

                  echo "<li class='btn_prev'><span>ページ ".$offset."/".$total_rows."</span></li>";
                  echo $pagination;
                }

              }elseif (isset($_POST['event'])&&$_POST['event']=='') {

               if($total_rows != 0 && $total_rows > 1){

                  if($offset==0){
                      $offset = 1;
                  }

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<script type="text/javascript">
  $('.m_static').addClass('active');
  $('.m_static').find('ul').addClass('active');
  $('.static_inventory').addClass('active');
</script>

<script>
  $(document).ready(function() {
    $(".btn01").click(function(){
      var id = $(this).attr("id_pro");
      var cr_qu = $(this).attr("cr_qu");
      var event_name = $(this).attr("event_name");
      var event_id = $(this).attr("event_id");
      var product_name = $(this).attr("product_name");
      if(product_name == ''){
        $('#product_name').html(product_name);
      } else {
        $('#product_name').html('/'+product_name);
      }
      $('#total_qua').html("<input type='hidden' name='id_product' value='" + id + "' />");
      $('#current_qua').html("<input type='hidden' name='current_qua' value='" + cr_qu + "' />");
      $('#event_name').html(event_name);
      $('#event_id').html(event_id);
      $('#product_id').html(id);
      $('#add_stock_popup').modal({fadeDuration: 100});
      // console.log(id);
    });
    $('#add_stock_form').submit(function(event){
      event.preventDefault();
      var quanlity_input = $('#add_quantity').val();
      if(quanlity_input > 0){
        $.ajax({
          url:"<?=base_url()?>/admin/statistics/addStockInventory",
          method:"POST",
          data:$('#add_stock_form').serialize(),
          beforeSend: function () {
           $('#add_stock_btn').html('<i class="fa fa-refresh fa-spin fa-fw"></i><span class="sr-only">Loading...</span> 読み込み中...');
           $('#add_stock_btn').attr('disabled','disabled');
          },
          success: function (data) {
            setTimeout("location.reload(true);", 2000);
            $.modal.close();
            // $('#message').modal({fadeDuration: 100});
            const toast = swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 2500
            });

            toast({
              type: 'success',
              title: '「'+quanlity_input+'」の株式を追加しました。',
            });
          }
        });
      } else {
        const toast = swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 3000
        });
        toast({
          type: 'warning',
          title: '「0」より大きい数値を入力してください。',
        });
      }
    });

});
</script>

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

</body>
</html>
