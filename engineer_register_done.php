<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>フリーズエンジニア</title>
</head>
<body>

<?php

require_once('common_temporary.php');

//前画面からの入力データを受け取る
$engineer_name=$_POST['engineer_name'];
$engineer_kana=$_POST['engineer_kana'];
$engineer_mail_address=$_POST['engineer_mail_address'];

//サニタイジング
$engineer_name=htmlspecialchars($engineer_name);
$engineer_kana=htmlspecialchars($engineer_kana);
$engineer_mail_address=htmlspecialchars($engineer_mail_address);


//会員情報登録

$result = '';

$result = put_engineerData();

if($result) {
	print "会員情報を登録しました。<br />";
} else {
	print "会員情報の登録に失敗しました。<br />";
}

//メール送信

$result = '';

$result = register_send_mail($engineer_mail_address);

if($result) {
	print "会員情報登録完了メールを送信しました。<br />";
} else {
	print "会員情報登録完了メールの送信に失敗しました。<br />";
}

?>

<a href="top_page.php">トップページ</a>

</body>
</html>
