<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p><?=$sender_name?>から新しいメッセージがあります</p>
<p>Message: <br>
<?=$content_mail?></p>
<p>Address: <?=$street.' '.$city.' '.$county_box.' '.$fist_zipcode.'-'.$last_zipcode?></p>
<p>Phone number:<?=$fist_phone?> - <?=$center_phone?> - <?=$last_phone?></p>
<p>Email: <?=$email?></p>
<p>Date sent: <?=date('Y/m/d H:i:s',strtotime($date_sent))?></p>
</body>
</html>