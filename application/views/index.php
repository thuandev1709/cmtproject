<!-- <div class="l-kv__slider">
		<div class="c-wrap relative">
			<h2><img src="img/top/mv_top.png" alt=""></h2>
		</div>
	</div> -->
	<div class="l-contents">
		<div class="p-top">
			<section class="p-top__sec01">
				<div class="c-wrap relative">
					<h3>イベントIDを入力</h3>
					<div class="p-top__sec01__in">
						<h4>イベントIDを入力</h4>
						<form action="" method="get">
							<div class="search_box">
								<input type="search" id="event_key" class="search-field" placeholder="入力例:0123456789" value="" name="event_key" required>
								<input class="icon_search" name="bnt_search" type="submit" value="検索">
							</div>
						</form>

					</div>
				</div>
			</section><!-- /.p-top__sec01 -->
			<section class="p-top__sec02">
				<div class="c-wrap relative">
					<div class="p-top__sec02__in">
						<h3><span><img src="<?=base_url('assets/img/top/tt01_top.png')?>" alt="LEMON SHOP とは"></span></h3>
						<ul class="list_sec02 clearfix">
							<li>
								<div class="box01_top02">
									<p class="cir_top02"><img src="<?=base_url('assets/img/top/cir01_top.png')?>" alt="カメラマンが学校のイベントを撮影"></p>
									カメラマンが<br><span>学校のイベントを撮影</span>
								</div>
							</li>
							<li>
								<div class="box01_top02">
									<p class="cir_top02"><img src="<?=base_url('assets/img/top/cir02_top.png')?>" alt="自分のお子さんのDVD・写真を選ぶ"></p>
									自分のお子さんの<br><span>DVD・写真を選ぶ</span>
								</div>
							</li>
							<li class="mr00">
								<div class="box01_top02">
									<p class="cir_top02"><img src="<?=base_url('assets/img/top/cir03_top.png')?>" alt="ネットでそのままカンタン注文"></p>
									ネットでそのまま<br><span>カンタン注文</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</section><!-- /.p-top__sec02 -->
			<section class="p-top__sec03">
				<div class="c-wrap relative">
					<div class="p-top__sec03__in">
						<h3>お知らせ</h3>
						<div class="box01_top03">
							<?php foreach($news as $news_item): ?>
							<dl class="clearfix">
								<dt><?=date('Y/m/d',strtotime($news_item['lm16_news_date']))?></dt>
								<dd><a href="./news/view/<?=protect_url('encrypted',$news_item['lm16_news_id'],'lemeshop@2018')?>" class="hvr-icon-buzz-out"><i class="fa fa-volume-up hvr-icon"></i> <?=$news_item['lm16_news_title']?></a></dd>
							</dl>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section><!-- /.p-top__sec03 -->
		</div><!-- /.p-top -->
	</div><!-- /.l-contents -->
