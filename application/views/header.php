<!DOCTYPE html>
<html lang="ja">

<head>

<meta charset="utf-8">
<!-- <meta name="viewport" content="width=device-width" /> -->
<meta name="keywords" content="レメショップ,LEMESHOP,イベント写真,イベントDVD,PC SUPPORT" />
<meta name="description" content="学校で行われたイベントなどのDVDや写真を販売を行っています。" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<title>LEME SHOP</title>

<link rel="icon" type="image/x-icon" href="favicon.ico" />
<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/style.css')?>" media="screen and (min-width: 641px), print" />
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/hover.css')?>" media="screen and (min-width: 641px), print" />
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/style-sp.css')?>" media="only screen and (max-width: 640px), only and (max-device-width: 735px) and (orientation : landscape)" />
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/w3.css')?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/xzoom.css')?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/font-awesome.css')?>">
<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<!--[if lt IE 9]>
<link rel="stylesheet" href="/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/selectivizr-min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url('assets/js/jquery-validate.js')?>"></script>
<script src="<?=base_url('assets/js/security.js')?>"></script>
<script src="<?=base_url('assets/js/sweetalert2.js')?>"></script>
<script src="<?=base_url('assets/js/function.js')?>"></script>
<script src="<?=base_url('assets/js/script.js')?>"></script>
<script>
	var japan = {
        errorTitle: 'フォームの提出に失敗しました！',
        requiredFields: 'あなたはすべての必須フィールドに回答していません',
        badTime: 'あなたは正しい時間を与えていない',
        badEmail: 'あなたは正しい電子メールアドレスを与えていない',
        badTelephone: 'あなたは正しい電話番号を与えていません',
        badSecurityAnswer: 'セキュリティに関する質問に正解をしていない',
        lengthBadEnd: ' 文字',
        lengthTooLongStart: 'The input value is longer than ',
        lengthTooShortStart: 'The input value is shorter than ',
        notConfirmed: '「パワード」は一致しません。',
        badDomain: 'Incorrect domain value',
        badUrl: 'The input value is not a correct URL',
        badCustomVal: 'The input value is incorrect',
        andSpaces: ' and spaces ',
        badInt: 'The input value was not a correct number',
        badSecurityNumber: 'Your social security number was incorrect',
        badUKVatAnswer: 'Incorrect UK VAT Number',
        badStrength: 'The password isn\'t strong enough',
        badNumberOfSelectedOptionsStart: 'You have to choose at least ',
        badNumberOfSelectedOptionsEnd: ' answers',
        badAlphaNumeric: 'The input value can only contain alphanumeric characters ',
        badAlphaNumericExtra: ' and ',
    };
</script>
</head>

<body>
<div id="container" class="relative">
	<div class="l-header">
		<div class="c-wrap relative">
			<div class="head_box clearfix">
				<div class="left_head">
					<p class="h_logo"><a href="<?=base_url()?>"><img src="<?=base_url('assets/img/common/h_logo.png')?>" alt="LEMON SHOP"></a></p>
					<h1>学校で行われたイベントなどのDVDや写真を販売</h1>
					<div class="btn_gnav"><span></span></div>
				</div>
				<div class="right_head">
					<p class="h_img"><img src="<?=base_url('assets/img/common/logo01.png')?>" alt="PC SUPPORT"></p>
					<ul class="h_list clearfix">
						<li><a href="<?=base_url('page/law')?>">特定商取引法表示</a></li>
						<li><a href="<?=base_url('page/privacy')?>">個人情報保護方針</a></li>
						<li><a href="<?=base_url('page/terms')?>">利用規約</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="l-nav">
		<div class="c-wrap">
			<div class="l-nav_tbl">
				<ul class="h_menu01 clearfix">
					<li><a href="<?=base_url()?>">トップページ</a></li>
					<li><a href="<?=base_url('page/flow')?>">購入の流れ</a></li>
					<li><a href="<?=base_url('page/faq')?>">よくある質問</a></li>
					<li><a href="<?=base_url('contact')?>">お問い合わせ</a></li>
				</ul>
				<ul class="h_menu02 clearfix">
					<?php
						if($this->session->userdata('user_id') != NULL){
							?>
							<li><a href="<?=base_url('account/logout')?>">ログアウト</a></li>
							<li><a href="<?=base_url('account/mypage')?>">マイページ</a></li>
							<?php
						}else{
							?>
							<li><a href="<?=base_url('account/login')?>">ログイン</a></li>
							<li><a href="<?=base_url('account/entry')?>">新規会員登録</a></li>
							<?php
						}
					?>
					<?php

						if ($this->session->userdata('user_id') == NULL) { ?> 
							<li><a href="<?=base_url('cart/cart_notlogin')?>">カート <?= !empty($_SESSION['cart']) ?'('.count($_SESSION['cart']) .')' : '' ?> </a></li>
					<?php }else { ?>
							<li><a href="<?=base_url('cart/cart_login')?>">カート <?= !empty($_SESSION['cart']) ? '('.count($_SESSION['cart']) .')' : ''?></a></li>
					<?php } ?>
					
					<!-- <li><a href="#"><span class="c_num">0</span>カート</a></li> -->
				</ul>
			</div>
		</div>
	</div><!-- /.l-nav -->
