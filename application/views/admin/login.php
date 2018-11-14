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
 <link rel="stylesheet" href="<?=base_url()?>assets/admin/common/css/font-awesome.css">
</head>
<body>
<div id="wrapper"><!-- wrapper -->
  <div class="contents">
    <div class="header">
      <p class="h_logo"><a href="./"><img src="<?=base_url()?>assets/admin/common/images/h_logo.png" alt="Schoolmail"></a></p>
    </div><!-- end header -->
  </div>
  <div class="system-body">
    <div class="wid">
      <div class="login">
        <h3>ログイン</h3>
        <?php
        if(validation_errors() != ''){
          echo '<p class="txt_alert">
          '.validation_errors().'
          </p>';
        }
        if(isset($error_message) && $error_message != ''){
          echo '<p style="color:red" class="txt_alert">
          '.$error_message.'
          </p>';
        }
        ?>
        <div class="table00">
        <form method="POST">
          <table>
            <tbody><tr>
              <th>ユーザーID</th>
              <td><input type="text" name="username" id="username" value="" required ></td>
            </tr>
            <tr>
              <th>パスワード</th>
              <td><input type="password" name="password" id="password" value="" required ></td>
            </tr>
          </tbody></table>
          <p id="mess"></p>
        </div>
        <div>
          <span class="error"></span>
          <input type="submit" name="btn_login" id="btn_login" value="ログイン">
        </div>
        </form>
      </div><!-- / .system-body -->
    </div><!-- / .wid -->
  </div>
  <footer>
    
  </footer>
</div>

<!-- end wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/common/js/jquery.js"><\/script>');
</script>
<!-- jQuery Fallback -->
<script src="<?=base_url()?>assets/admin/common/js/script.js"></script>
<script src="<?=base_url()?>assets/admin/common/js/smooth-scroll.js"></script>

</body>
</html>