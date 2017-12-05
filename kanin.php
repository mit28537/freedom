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

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>会員登録</title>
  <link rel="stylesheet" href="css/tandardize.css">
  <link rel="stylesheet" href="css/dex-grid.css">
  <link rel="stylesheet" href="css/dex.css">
</head>
<body class="body page-index clearfix">
  <img class="image" src="images/nayy.png">
  
  <a href="http://localhost/freedom/sin_top.php">
  <button class="_button _button-1">HOME</button>
  </a>
  
<button class="_button _button-2">新着案件</button>
  <button class="_button _button-3">注力案件</button>
  <button class="_button _button-4">利用流れ</button>
  <button class="_button _button-5">コンテンツ</button>
  <div class="element element-1"></div>
  <div class="container"></div>
  <button class="_button _button-6">sin_anken</button>
  <div class="element element-2"></div>
  <div class="_button _button-7">●無料会員登録画面●
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

</body></div>
  <div class="element element-3"></div>
  <button class="_button _button-8">sin_anken</button>
  <button class="_button _button-9">sin_anken</button>
</body>
</html>