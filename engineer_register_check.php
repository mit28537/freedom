<?php
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。

require_once('common.php');

//入力チェック
$_POST = checkInput($_POST);

//ワンタイムパスワードチェック
if(isset($_POST['ticket']) && isset($_SESSION['ticket'])) {
	$ticket = $_POST['ticket'];
	//print $ticket;
	if(!in_array($ticket,$_SESSION['ticket'])) {
		die('不正アクセスの疑い');
	}
} else {
		die('不正アクセスの疑い');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>フリーズエンジニア</title>
</head>
<body>

●無料会員登録チェック画面●
<br /><br />

<?php

//前画面からの入力データを受け取る
$engineer_name=$_POST['engineer_name'];
$engineer_kana=$_POST['engineer_kana'];
$engineer_mail_address=$_POST['engineer_mail_address'];

//サニタイジング
$engineer_name=htmlspecialchars($engineer_name);
$engineer_kana=htmlspecialchars($engineer_kana);
$engineer_mail_address=htmlspecialchars($engineer_mail_address);

//チェックフラグ
$check_flg=true;

//未入力チェック（氏名）
if($engineer_name=='')
{
	print '氏名が入力されていません。<br />';
	$check_flg=false;
}

//未入力チェック（氏名（かな））
if($engineer_kana=='')
{
	print '氏名（かな）が入力されていません。<br />';
	$check_flg=false;
}

//未入力チェック（メールアドレス）
if($engineer_mail_address=='')
{
	print 'メールアドレスが選択されていません。<br />';
	$check_flg=false;
}


//文字数チェック（氏名）
if(mb_strlen($engineer_name) > 10)
{
	print '氏名が１０文字を超えています。<br />';
	$check_flg=false;
}

//文字数チェック（氏名（かな））
if(mb_strlen($engineer_kana) > 20)
{
	print '氏名（かな）が２０文字を超えています。<br />';
	$check_flg=false;
}

//文字数チェック（メールアドレス）
if(mb_strlen($engineer_mail_address) > 30)
{
	print 'メールアドレスが３０文字を超えています。<br />';
	$check_flg=false;
}

//メールアドレスチェック
if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$engineer_mail_address) == 0) {
	print 'メールアドレスチェックが正しくありません。<br />';
	$check_flg=false;
}

if($check_flg==true)
{
//全てのチェックがOKの場合

	print '氏名：';
	print $engineer_name;
	print '<br />';

	print '氏名（かな）：';
	print $engineer_kana;
	print '<br />';

	print 'メールアドレス：';
	print $engineer_mail_address;
	print '<br />';

	print '<form method="post" action="engineer_register_done.php">';

	//次画面へ連携するデータ
	print '<input type="hidden" name="engineer_name" value="'.$engineer_name.'">';
	print '<input type="hidden" name="engineer_kana" value="'.$engineer_kana.'">';
	print '<input type="hidden" name="engineer_mail_address" value="'.$engineer_mail_address.'">';

	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';

} else {
	//１つでもチェックNGがあった場合
	print '<form>';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}

?>

<br />
</body>
</html>
