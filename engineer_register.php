<?php
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。

//ワンタイムチケット生成
$ticket = md5(uniqid(mt_rand(),TRUE));

//セッション変数にワンタイムチケット代入
$_SESSION['ticket'][] = $ticket;

//サニタイジング
$ticket=htmlspecialchars($ticket);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>フリーズエンジニア</title>
</head>
<body>

●無料会員登録画面●
<br /><br />

<form method="post" action="engineer_register_check.php">

氏名を入力してください。（10文字以内）★必須<br />
<input type="text" name="engineer_name" style="width:400px"><br />
<br />

氏名（かな）を入力してください。（20文字以内）★必須<br />
<input type="text" name="engineer_kana" style="width:400px"><br />
<br />

メールアドレスを入力してください。★必須<br />
<input type="text" name="engineer_mail_address" style="width:200px"><br />
<br />

<input type="hidden" name="ticket" value="<?php echo $ticket;?>">

<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>
