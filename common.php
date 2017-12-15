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

$sql = 'SELECT *
		FROM t_project
		WHERE 1
		ORDER BY t_project_update_date DESC';

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

		$phaseData = get_phaseimage_path($rec['t_project_phase_id']);

		$arrayData[] = array(
					'project_id' => $rec['t_project_id']
					,'project_subject' => $rec['t_project_subject']
					,'project_skill' => $rec['t_project_skill']
					,'project_price' => $rec['t_project_price']
					,'project_location' => $rec['t_project_location']
					,'mst_name' => $phaseData['mst_name']
					,'mst_img_path' => $phaseData['mst_img_path']
				);
	}

	//全データ件数
	$iTotalCount=count($arrayData);
	//全ページ数
	$iTotalPage=ceil($iTotalCount);

	$return_data = array('iTotalCount' => $iTotalCount,'iTotalPage' => $iTotalPage,'arrayData' => $arrayData);

	return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_employmentList）</br></br>';
	return(false);
}

}//END-FUNC

//ピックアップ案件一覧情報取得
function get_p_employmentList()
{
try
{
$dsn = 'mysql:dbname=employment;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT *
		FROM t_project
		WHERE 1
		AND t_project_kind_id NOT IN ("1")
		ORDER BY t_project_update_date DESC';

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

		$phaseData = get_phaseimage_path($rec['t_project_phase_id']);
		
		$arrayData[] = array(
					'project_id' => $rec['t_project_id']
					,'project_subject' => $rec['t_project_subject']
					,'project_skill' => $rec['t_project_skill']
					,'project_price' => $rec['t_project_price']
					,'project_location' => $rec['t_project_location']
					,'mst_name' => $phaseData['mst_name']
					,'mst_img_path' => $phaseData['mst_img_path']
				);
	}

	//全データ件数
	$iTotalCount=count($arrayData);
	//全ページ数
	$iTotalPage=ceil($iTotalCount);

	$return_data = array('iTotalCount' => $iTotalCount,'iTotalPage' => $iTotalPage,'arrayData' => $arrayData);

	return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_p_employmentList）</br></br>';
	return(false);
}

}//END-FUNC

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
				t_project_kind_id,
				t_project_industry_id,
				t_project_phase_id,
				t_project_skill,
				t_project_price,
				t_project_location,
				t_project_detail,
				t_project_business_partner,
				t_project_remarks,
				t_project_update_date,
				delete_flg
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
					'project_kind_id' => $rec['t_project_kind_id'],
					'project_industry_id' => $rec['t_project_industry_id'],
					'project_phase_id' => $rec['t_project_phase_id'],
					'project_skill' => $rec['t_project_skill'],
					'project_price' => $rec['t_project_price'],
					'project_location' => $rec['t_project_location'],
					'project_detail' => $rec['t_project_detail'],
					'project_business_partner' => $rec['t_project_business_partner'],
					'project_remarks' => $rec['t_project_remarks'],
					'project_update_date' => $rec['t_project_update_date'],
					'project_delete_flg' => $rec['delete_flg'],);
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

//業務詳細情報取得
function get_mstProjectPhaseDetails($mst_id)
{
	try
	{
		$dsn = 'mysql:dbname=employment;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT * FROM mst_project_phase WHERE mst_id = ?';

		$stmt = $dbh->prepare($sql);
		$data[] = $mst_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;

		if($rec==false)
		{
			print 'データなし（get_mstProjectPhaseDetails）</br></br>';
			print $sql;
			print '</br></br>';
			return(false);
		}


		$arrayData = array('mst_id' => $rec['mst_id'],
					'mst_name' => $rec['mst_name'],
					'mst_img_path' => $rec['mst_img_path'],
					'mst_print_number' => $rec['mst_print_number'],
					'delete_flg' => $rec['delete_flg']);

		$return_data = $arrayData;

		return($return_data);
	}catch (Exception $e){
		print 'エラー（get_mstProjectPhaseDetails）</br></br>';
		print $sql;
		print '</br></br>';

		return(false);
	}
}//END-FUNCTION

//業種詳細情報取得
function get_mstProjectIndustryDetails($mst_id)
{
	try
	{
		$dsn = 'mysql:dbname=employment;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT * FROM mst_project_industry WHERE mst_id = ?';

		$stmt = $dbh->prepare($sql);
		$data[] = $mst_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;

		if($rec==false)
		{
			print 'データなし（get_mstProjectIndustryDetails）</br></br>';
			print $sql;
			print '</br></br>';
			return(false);
		}


		$arrayData = array('mst_id' => $rec['mst_id'],
					'mst_name' => $rec['mst_name'],
					'mst_print_number' => $rec['mst_print_number'],
					'delete_flg' => $rec['delete_flg']);

		$return_data = $arrayData;

		return($return_data);
	}catch (Exception $e){
		print 'エラー（get_mstProjectIndustryDetails）</br></br>';
		print $sql;
		print '</br></br>';

		return(false);
	}
}//END-FUNCTION

//案件種別詳細情報取得
function get_mstProjectKindDetails($mst_id)
{
	try
	{
		$dsn = 'mysql:dbname=employment;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT * FROM mst_project_kind WHERE mst_id = ?';

		$stmt = $dbh->prepare($sql);
		$data[] = $mst_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;

		if($rec==false)
		{
			print 'データなし（get_mstProjectKindDetails）</br></br>';
			print $sql;
			print '</br></br>';
			return(false);
		}


		$arrayData = array('mst_id' => $rec['mst_id'],
					'mst_name' => $rec['mst_name'],
					'mst_print_number' => $rec['mst_print_number'],
					'delete_flg' => $rec['delete_flg']);

		$return_data = $arrayData;

		return($return_data);
	}catch (Exception $e){
		print 'エラー（get_mstProjectKindDetails）</br></br>';
		print $sql;
		print '</br></br>';

		return(false);
	}
}//END-FUNCTION


//案件検索情報取得
function get_searchList($search_skill,$search_price,$search_detail)
{

try
{
$dsn = 'mysql:dbname=employment;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT t_project_id,t_project_subject,t_project_skill,t_project_price FROM t_project WHERE
		t_project_skill LIKE "%'.$search_skill.'%" AND
		t_project_detail LIKE "%'.$search_detail.'%" AND
		t_project_price LIKE "%'.$search_price.'%"';

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

		$arrayData[] = array('project_id' => $rec['t_project_id'],
							 'project_subject' => $rec['t_project_subject'],
							 'project_skill' => $rec['t_project_skill'],
							 'project_price' => $rec['t_project_price']);
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

function print_menu() {
	print '<div>';
		print'<ul>';
		print'<li><a href="top_page.php">HOME</a></li>';
		print'<li><a href="search_list.php">案件一覧</a></li>';
		print'<li><a href="nagare.php">ご利用の流れ</a></li>';
		print'<li><a href="vice.php">利用者の声</a></li>';
		print'<li><a href="engineer_register.php">無料会員登録</a></li>';
		print'</ul>';
	print '</div>';
   }//END-FUNCTION

// 業務画像パス取得処理
function get_phaseimage_path($mst_id) {
	try
	{
		$dsn = 'mysql:dbname=employment;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT * FROM mst_project_phase WHERE mst_id = ?';

		$stmt = $dbh->prepare($sql);
		$data[] = $mst_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;

		$arrayData = null;

		if($rec==false)
		{
			$arrayData = array('mst_name' => "",
							'mst_img_path' => "img/category/no_image.png");
			return($arrayData);
		}

		$arrayData = array('mst_name' => $rec['mst_name'],
					'mst_img_path' => $rec['mst_img_path']);

		return($arrayData);
	}catch (Exception $e){
		print 'エラー（get_mstProjectPhaseDetails）</br></br>';
		print $sql;
		print '</br></br>';

		return(false);
	}
}
?>
