<div class="l-contents">
	<div class="p-contact">
		<section class="tile_page">
			<div class="c-wrap relative">
				<h3>購入履歴</h3>
			</div>
		</section>
		<section class="p-contact_sec01">
			<div class="c-wrap relative">
				<nav id="navi_list_box" class="local_nav favorite">
					<ul id="navi_list">
						<li class=""><a href="<?=base_url('account/mypage')?>"><i class="fa fa-user" aria-hidden="true"></i> マイページ</a></li>
						<li class=""><a href="<?=base_url('account/edit')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> アカウントの編集</a></li>
						<li class=""><a href="<?=base_url('account/email')?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> メールを変更する</a></li>
						<li class=""><a href="<?=base_url('account/secure')?>"><i class="fa fa-lock" aria-hidden="true"></i> パスワードを変更する</a></li>
						<li class="active"><a href="<?=base_url('history')?>"><i class="fa fa-list-alt" aria-hidden="true"></i> 購入履歴</a></li>
					</ul>
				</nav>
				<form>
				<table class="table_form">
					<tr>
						<th>期限</th>
						<td>
							<input type="text" class="input_30" name="date_star" id="date_star" value="<?=date('Y年m月d日');?>" > ~ <input type="text" class="input_30" name="date_end" id="date_end" value="">
						</td>
					</tr>
					<tr>
						<th>支払い状況</th>
						<td>
							<label><input type="radio" name="type" checked="" value="" class="type"> 全て</label>
							<label><input type="radio" name="type" value="2" class="type"> 決済済み</label>
							<label><input type="radio" name="type" value="0" class="type"> 決済待ち</label>
							<label><input type="radio" name="type" value="1" class="type"> 運送済み</label>
						</td>
					</tr>
				</table><br>
				<p align="center"><input type="button" name="" class="btn btn_submit parl " id="btn_search" value="検索"></p><br>
				<p  align="center">
						<input type="button" class="btn parl btn01 today" value="今日" >
						<input type="button" class="btn parl btn01 lastweek" value="今週" >
						<input type="button" class="btn parl btn01 lastmonth" value="今月" >
						<input type="button" class="btn parl btn01 thisyear" value="今年" >
						<input type="button" name="" class="btn parl btn01 lastyear" value="去年">
				</p><br><br>
				</form>
				<table class="table_info">
					<thead>
						<tr>
							<th>日付</th>
							<th>購入ID</th>
							<th>金額</th>
							<th>決済方法</th>
							<th>状況</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<?php
							if (isset($list_data) && $list_data != ''){
								foreach ($list_data as $key) {
									?>
										<tr>
											<td rowspan="<?=$key['rowspan']?>">
												<?=substr($key['date'], 0,4).'年'.substr($key['date'], 4,2).'月'.substr($key['date'], 6,2).'日'?>
											</td>
											<td><a href="<?=base_url('history/detail/'.$key['row_data'][0]['lm07_order_id'])?>"><?=$key['row_data'][0]['lm07_order_id']?></a></td>
											<td><?=$key['row_data'][0]['lm07_total_price']?>円</td>
											<td><?=$key['row_data'][0]['lm13_method_name']?></td>
											<td><?php
											if($key['row_data'][0]['lm07_pay_status'] == 0)
												echo '<span style="color: gray">決済待ち</span>';
											elseif($key['row_data'][0]['lm07_pay_status'] == 1)
												echo '<span style="color: orange">決済済み</span>';
											else
												echo '<span style="color: green">運送済み</span>';
											?>
											</td>
										</tr>
									<?php
									if($key['rowspan'] > 1){
										for ($i=1; $i < $key['rowspan']; $i++) {
											?>
											<tr>
												<td><a href="<?=base_url('history/detail/'.$key['row_data'][$i]['lm07_order_id'])?>"><?=$key['row_data'][$i]['lm07_order_id']?></a></td>
												<td><?=$key['row_data'][$i]['lm07_total_price']?>円</td>
												<td><?=$key['row_data'][$i]['lm13_method_name']?></td>
												<td>
													<?php
														if($key['row_data'][$i]['lm07_pay_status'] == 0)
															echo '<span style="color: gray">決済待ち</span>';
														elseif($key['row_data'][$i]['lm07_pay_status'] == 1)
															echo '<span style="color: orange">決済済み</span>';
														else
															echo '<span style="color: green">運送済み</span>';
													?>
												</td>
											</tr>
											<?php
										}
									}
								}
							}
						?>
					</tbody>
				</table>
				<div class="pagination clearfix">
		            <ul class="page clearfix">
		              <?php
		                if($total_rows != 0 && $total_rows > 1 && !empty($pagination)){
		                  echo "<li class='btn_prev'><span>ページ ".$offset."/".$total_rows."</span></li>";
		                  echo $pagination;
		                }
		              ?>
		          </ul>
		        </div>
				<br><br>
			</div>
		</section><!-- /.p-top__sec02 -->
		<!-- /.p-top__sec03 -->
	</div><!-- /.p-top -->
</div><!-- /.l-contents -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
		$('#date_star').datepicker({
			dateFormat: 'yy年mm月dd日'
		});
		$('#date_end').datepicker({
			dateFormat: 'yy年mm月dd日'
		});
});
$('.today').click(function(){
	var today = new Date();
	var y = today.getFullYear();
	var m = today.getMonth() + 1;
	var d = today.getDate();
	if(m < 10)
		m = '0'+m;
	if(d < 10)
		d = '0'+d;
	$('#date_star').val(y+'年'+m+'月'+d+'日');
	$('#date_end').val('');
	$('#btn_search').click();
});

$('.lastweek').click(function(){
	var today = new Date();
	var lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);
	var m = today.getMonth() + 1;
	var d = today.getDate();
	if(m < 10)
		m = '0'+m;
	if(d < 10)
		d = '0'+d;

	var m1 = lastWeek.getMonth() + 1;
	var d1 = lastWeek.getDate();
	if(m1 < 10)
		m1 = '0'+m1;
	if(d1 < 10)
		d1 = '0'+d1;
	$('#date_star').val(lastWeek.getFullYear()+'年'+m1+'月'+d1+'日');
	$('#date_end').val(today.getFullYear()+'年'+m+'月'+d+'日');
	// $('#btn_search').click();
});

$('.lastmonth').click(function(){
	var today = new Date();
	var m = today.getMonth() + 1;
	var d = today.getDate();
	var lastWeek = new Date(today.getFullYear(), m - 1, d);

	if(m < 10)
		m = '0'+m;
	if(d < 10)
		d = '0'+d;

	var m1 = today.getMonth();
	var d1 = today.getDate();
	if(m1 < 10)
		m1 = '0'+m1;
	if(d1 < 10)
		d1 = '0'+d1;
	$('#date_star').val(lastWeek.getFullYear()+'年'+m1+'月'+d1+'日');
	$('#date_end').val(today.getFullYear()+'年'+m+'月'+d+'日');
	$('#btn_search').click();
});

$('.thisyear').click(function(){
	var today = new Date();
	var y = today.getFullYear();
	var m = today.getMonth() + 1;
	var d = today.getDate();
	if(m < 10)
		m = '0'+m;
	if(d < 10)
		d = '0'+d;

	$('#date_star').val(y+'年01月01日');
	$('#date_end').val(y+'年'+m+'月'+d+'日');
	$('#btn_search').click();
});

$('.lastyear').click(function(){
	var lastYear = new Date();
    var d = lastYear.getDate();
    var m = lastYear.getMonth() + 1; //January is not 0!
    var y = lastYear.getFullYear(lastYear) - 1;
		var current_y = lastYear.getFullYear();
    if (d < 10) { d = '0' + d }
    if (m < 10) { m = '0' + m }

	$('#date_star').val(y+'年'+m+'月'+d+'日');
	$('#date_end').val(current_y+'年'+m+'月'+d+'日');
	$('#btn_search').click();
});

$('#btn_search').click(function(){
	searchdata();
});

function searchdata(urlinka = ''){
	var fromdate = $('#date_star').val();
    var todate = $('#date_end').val();
    var type_search = "";
    var urlink = '';
    $('.type').each(function(){
    	if($(this).prop('checked') == true)
    		type_search = $(this).val();
    });
    if(urlinka == '')
    	urlink ='<?=base_url()?>history/search';
    else
    	urlink ='<?=base_url()?>history/search/'+urlinka;
    $.ajax({
        url: urlink,
        data: {
          fromdate:fromdate,
          todate:todate,
          type_search:type_search,
        },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
        	$('#tbody').html(data.html_data);
        	$('.pagination .page').html(data.pagination);
        	$('.pagination .page li').each(function(){
        		var $thea = $(this).children('a');
        		var urlinka = $thea.attr('href');
        		$thea.attr('href', 'javascript:void(0)');
        		var num = urlinka.substring(urlinka.lastIndexOf("/")+1);
        		if(num == 'search')
        			num = '';
        		$thea.attr('onclick', "searchdata('"+num+"')");
        	});
          // console.log(data.html_data);
        }
    });
}

</script>
