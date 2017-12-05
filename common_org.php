<?php

//案件一覧情報取得
function get_employmentList()
{

try
{
$dsn = 'mysql:dbname=employment;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//$sql = 'SELECT t_project_id,t_project_subject FROM t_project WHERE 1';
$sql = 'SELECT * FROM t_project WHERE 1';

$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;

	while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			break;
		}

		$arrayData[] = array(
					'project_id' => $rec['t_project_id']
					,'project_subject' => $rec['t_project_subject']
					,'project_skill' => $rec['t_project_skill']
					,'project_price' => $rec['t_project_price']
					,'project_location' => $rec['t_project_location']);
		//$arrayData[] = array('project_id' => $rec['t_project_id'],'project_subject' => $rec['t_project_subject']);
	}

	//全データ件数
	$iTotalCount=count($arrayData);
	//全ページ数
	$iTotalPage=ceil($iTotalCount/DISPLAY_COUNT);

	$return_data = array('iTotalCount' => $iTotalCount,'iTotalPage' => $iTotalPage,'arrayData' => $arrayData);

	return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_employmentList）</br></br>';
	return(false);
}

}//END-FUNCTION

//案件詳細情報取得
function get_employmentDetails($project_id)
{

try
{
$dsn = 'mysql:dbname=employment;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT  t_project_id,
				t_project_subject,
				t_project_detail,
				t_project_industry,
				t_project_skill,
				t_project_price_high,
				t_project_price_low,
				t_project_period,
				t_project_location,
				t_project_phase,
				t_project_number_of_people,
				t_project_working_hours,
				t_project_number_of_meetings,
				t_project_remarks
		 FROM t_project WHERE t_project_id = ?';

$stmt = $dbh->prepare($sql);
$data[] = $project_id;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$dbh = null;

if($rec==false)
{
	print 'データなし（get_employmentDetails）</br></br>';
	print $sql;
	print '</br></br>';
	return(false);
}


$arrayData = array('project_id' => $rec['t_project_id'],
					'project_subject' => $rec['t_project_subject'],
					'project_detail' => $rec['t_project_detail'],
					'project_industry' => $rec['t_project_industry'],
					'project_skill' => $rec['t_project_skill'],
					'project_price_high' => $rec['t_project_price_high'],
					'project_price_low' => $rec['t_project_price_low'],
					'project_period' => $rec['t_project_period'],
					'project_location' => $rec['t_project_location'],
					'project_phase' => $rec['t_project_phase'],
					'project_number_of_people' => $rec['t_project_number_of_people'],
					'project_working_hours' => $rec['t_project_working_hours'],
					'project_number_of_meetings' => $rec['t_project_number_of_meetings'],
					'project_remarks' => $rec['t_project_remarks']);

$return_data = $arrayData;

return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_employmentDetails）</br></br>';
	print $sql;
	print '</br></br>';

	return(false);
}

}//END-FUNCTION

//案件検索情報取得
function get_searchList($search_skill,$search_price,$search_free_word)
{

try
{
$dsn = 'mysql:dbname=employment;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT t_project_id,t_project_subject FROM t_project WHERE 
		t_project_skill LIKE "%'.$search_skill.'%" AND 
		t_project_detail LIKE "%'.$search_free_word.'%" AND 
		t_project_price_low >= '.$search_price;

$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;
//配列クリア（検索結果０件対応）
$arrayData = array();

	while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			break;
		}

		$arrayData[] = array('project_id' => $rec['t_project_id'],'project_subject' => $rec['t_project_subject']);
	}

	//全データ件数
	$iTotalCount=count($arrayData);
	//全ページ数
	if($iTotalCount == 0) {
		//検索結果０件の場合は１を設定
		$iTotalPage = 1;
	} else {
		$iTotalPage = ceil($iTotalCount/DISPLAY_COUNT);
	}

	$return_data = array('iTotalCount' => $iTotalCount,'iTotalPage' => $iTotalPage,'arrayData' => $arrayData);

	return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_searchList）</br></br>';
	print $sql;
	print '</br></br>';
	return(false);
}

}//END-FUNCTION

//プルダウンメニュー（年）
function pulldown_year()
{
	print '<select name="year">';
		for($i=1960;$i<2000;$i++) {
			print '<option value="'.$i.'">'.$i.'</option>';
		}
	print '</select>';
	print '年';
}//END-FUNCTION

//プルダウンメニュー（月）
function pulldown_month()
{
	print '<select name="month">';
		for($i=1;$i<10;$i++) {
			print '<option value="0'.$i.'">0'.$i.'</option>';
		}
		print '<option value="10">10</option>';
		print '<option value="11">11</option>';
		print '<option value="12">12</option>';
	print '</select>';
	print '月';
}//END-FUNCTION

//プルダウンメニュー（日）
function pulldown_day()
{
	print '<select name="day">';
		for($i=1;$i<10;$i++) {
			print '<option value="0'.$i.'">0'.$i.'</option>';
		}
		for($i=10;$i<32;$i++) {
			print '<option value="'.$i.'">'.$i.'</option>';
		}
	print '</select>';
	print '日';
}//END-FUNCTION

//会員情報登録
function put_engineerData()
{

try
{
	//前画面からの入力データを受け取る
	$engineer_name=$_POST['engineer_name'];
	$engineer_kana=$_POST['engineer_kana'];
	$engineer_gender=$_POST['engineer_gender'];
	$engineer_birthday=$_POST['engineer_birthday'];
	$engineer_mail_address=$_POST['engineer_mail_address'];
	$engineer_phone_number=$_POST['engineer_phone_number'];
	$engineer_other=$_POST['engineer_other'];

	//サニタイジング
	$engineer_name=htmlspecialchars($engineer_name);
	$engineer_kana=htmlspecialchars($engineer_kana);
	$engineer_gender=htmlspecialchars($engineer_gender);
	$engineer_birthday=htmlspecialchars($engineer_birthday);
	$engineer_mail_address=htmlspecialchars($engineer_mail_address);
	$engineer_phone_number=htmlspecialchars($engineer_phone_number);
	$engineer_other=htmlspecialchars($engineer_other);

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
					t_engineer_gender,
					t_engineer_birthday,
					t_engineer_mail_address,
					t_engineer_phone_number,
					t_engineer_other) VALUES (?,?,?,?,?,?,?)';

	$stmt = $dbh->prepare($sql);

	$data[] = $engineer_name;
	$data[] = $engineer_kana;
	$data[] = $engineer_gender;
	$data[] = $engineer_birthday;
	$data[] = $engineer_mail_address;
	$data[] = $engineer_phone_number;
	$data[] = $engineer_other;

	$stmt->execute($data);
	$dbh = null;

	return(true);
}
catch (Exception $e)
{
	return(false);
}

}//END-FUNCTION

//メール送信処理
function sendMail($mailTo,$subject,$comment,$header)
{
	mb_language('ja');
	mb_internal_encoding('UTF-8');

	$result = mb_send_mail($mailTo,$subject,$comment,$header);

	if($result) {
		return(true);
	} else {
		return(false);
	}

}//END-FUNCTION

//入力チェック
function checkInput($var) {

	if(is_array($var)) {
		return array_map('checkInput',$var);
	} else {
		//get_magic_quotes_gpc対策
		if(get_magic_quotes_gpc()) {
			$var = stripslashes($var);
		}

		//NULLバイト攻撃対策
		if(preg_match('/\0/',$var)) {
			die('不正入力です。');
		}

		//文字エンコードチェック
		if(!mb_check_encoding($var,'UTF-8')) {
			die('不正入力です。');
		}
		return $var;
	}
}//END-FUNCTION

?>
