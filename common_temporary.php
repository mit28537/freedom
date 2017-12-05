<?php

//会員情報登録
function put_engineerData()
{

try
{
	//前画面からの入力データを受け取る
	$engineer_name=$_POST['engineer_name'];
	$engineer_kana=$_POST['engineer_kana'];
	$engineer_mail_address=$_POST['engineer_mail_address'];

	//サニタイジング
	$engineer_name=htmlspecialchars($engineer_name);
	$engineer_kana=htmlspecialchars($engineer_kana);
	$engineer_mail_address=htmlspecialchars($engineer_mail_address);

	$engineer_status="仮登録";

	//データベース設定
	$dsn = 'mysql:dbname=employment;host=localhost';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	//SQL文作成
	$sql = 'INSERT INTO t_engineer(
					t_engineer_name,
					t_engineer_kana,
					t_engineer_mail_address,
					t_engineer_status
					) VALUES (?,?,?,?)';

	$stmt = $dbh->prepare($sql);

	$data[] = $engineer_name;
	$data[] = $engineer_kana;
	$data[] = $engineer_mail_address;
	$data[] = $engineer_status;

	$stmt->execute($data);
	$dbh = null;

	return(true);
}
catch (Exception $e)
{
	print $sql;
	print '<br />';
	return(false);
}

}//END-FUNCTION


//メール送信
function register_send_mail($mailTo)
{

try
{
	//$mailTo = "k-tamaki@k-mit.jp";				//送信先アドレス
	$subject = "会員情報登録完了メール";			//メールタイトル
	$comment = "テストメールです";				//メール内容

	$mailFrom = "k-tamaki@par.odn.ne.jp";
	$mailCc = "k-tamaki@par.odn.ne.jp";
	$mailBcc = "k-tamaki@par.odn.ne.jp";

	$header = "From:".$mailFrom."\r\n"."Cc:".$mailCc."\r\n"."Bcc:".$mailBcc."\r\n";		//送信元アドレス
	//Fromを設定しないと、送信先アドレスがサーバで設定した値になる。

	$result = '';

	$result = mb_send_mail($mailTo,$subject,$comment,$header);

	if($result) {
		return(true);
	} else {
		return(false);
	}
}
catch (Exception $e)
{
	return(false);
}


}//END-FUNCTION


?>
