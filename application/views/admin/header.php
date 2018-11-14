<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="LEME SHOP">
<meta name="keywords" content="LEME SHOP">
<title>LEME SHOP</title>
<link rel="stylesheet" href="<?=base_url()?>assets/admin/common/css/styles.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/w3.css"/>
 <link rel="stylesheet" href="<?=base_url()?>assets/admin/common/css/font-awesome.css">
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
 <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/common/js/jquery.js"><\/script>');</script>   <!-- jQuery Fallback -->
<script src="<?=base_url()?>assets/admin/common/js/script.js"></script>
<script src="<?=base_url('assets/js/jquery-validate.js')?>"></script>
<script src="<?=base_url('assets/js/security.js')?>"></script>
<script src="<?=base_url()?>assets/admin/common/js/smooth-scroll.js"></script>
<script src="<?=base_url()?>assets/admin/common/js/sweetalert2.js"></script>
</head>
<style type="text/css">
  .error_upfile{color: red}
  .m_list_10 a:before {
    font: 0px/1 FontAwesome;
    content: unset;
  }
</style>
<body>
<div id="wrapper"><!-- wrapper -->
  <div class="contents">
    <div class="side">
      <div class="btn_gnav"><span></span></div>
      <p class="h_logo"><a href="#"><img src="<?=base_url()?>assets/admin/common/images/h_logo.png" alt="Schoolmail"></a></p>
      <h2>管理画面</h2>
      <h3>Hello, 管理者さん</h3>
      <div class="head-sec_gnav clearfix">
       <ul class="clearfix">
          <li class="m_list_10 gnav_sub m_user">
            <a href="<?=base_url();?>admin/user"><span class="accordion_menu">ユーザー管理</span></a>
            <ul class="m_list_sub">
              <li class="parents_class"><a href="<?=base_url();?>admin/user">リストアカウント</a></li>
              <li class="parents_class_add"><a href="<?=base_url();?>admin/user/add">アカウントを追加する</a></li>
            </ul>
          </li>
          <li class="m_list_03 gnav_sub m_event">
            <a href="<?=base_url();?>admin/event"><span class="accordion_menu">イベントを管理する</span></a>
            <ul class="m_list_sub">
              <li class="event_list"><a href="<?=base_url();?>admin/event">イベント一覧</a></li>
              <li class="event_add"><a href="<?=base_url();?>admin/event/add">イベントを作成・編集する</a></li>
            </ul>
          </li>
          <li class="m_list_03 gnav_sub m_product">
            <a href="<?=base_url();?>admin/product/"><span class="accordion_menu">商品を管理する</span></a>
            <ul class="m_list_sub">
              <li class="product_list"><a href="<?=base_url();?>admin/product">商品一覧</a></li>
              <li class="product_add"><a href="<?=base_url();?>admin/product/add">商品を追加・編集する</a></li>
              <li class="product_defaut"><a href="<?=base_url();?>admin/product/valuedefault">商品のデフォルト値を設定する</a></li>
              <li class="product_category"><a href="<?=base_url();?>admin/category">写真区分を管理する</a></li>
            </ul>
          </li>
          <li class="m_list_03 gnav_sub m_static">
            <a href="<?=base_url();?>admin/statistics/"><span class="accordion_menu">集計</span></a>
            <ul class="m_list_sub">
              <li class="static_list"><a href="<?=base_url();?>admin/statistics">全体</a></li>
              <li class="static_detail"><a href="<?=base_url();?>admin/statistics/detail">詳細</a></li>
              <li class="static_detail_dvd"><a href="<?=base_url();?>admin/statistics/dvd">DVD在庫を集計する</a></li>
              <li class="static_inventory"><a href="<?=base_url();?>admin/statistics/inventory">DVD在庫の警告を集計する</a></li>
            </ul>
          </li>
          <li class="m_list_03 gnav_sub m_order">
            <a href="<?=base_url();?>admin/order/"><span class="accordion_menu">受注管理</span></a>
            <ul class="m_list_sub">
              <li class="order_list"><a href="<?=base_url();?>admin/order">受注一覧</a></li>
              <li class="order_detail"><a href="<?=base_url();?>admin/order">受注詳細</a></li>
            </ul>
          </li>
          <li class="m_list_05 m_info">
            <span><a href="<?=base_url();?>admin/system/info">店の情報</a></span>
          </li>

          <li class="m_list_05 m_tax">
            <span><a href="<?=base_url();?>admin/event/tax">税金設定</a></span>
          </li>

          <li class="m_list_06 m_news">
            <span><a href="<?=base_url();?>admin/news">お知らせ管理</a></span>
          </li>

          <li class="m_list_34"><a href="<?=base_url();?>admin/account/logout">ログアウト</a></li>

        </ul>
      </div>
    </div><!-- end side -->
