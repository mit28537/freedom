<?php

require_once('common.php');

const DISPLAY_COUNT = 6;		//一覧表示件数

//DBアクセス実行
$get_data = get_employmentList();

//関数戻り値取得
$iTotalCount=$get_data['iTotalCount'];
$iTotalPage=$get_data['iTotalPage'];
$arrayData=$get_data['arrayData'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>フリーズ・エンジニア</title>
</head>
<body>



トップ画面<br /><br />

■案件検索■
</br></br>

<form method="post" action="search_list.php">

スキル<br />
<input type="text" name="search_skill" style="width:200px"><br />
<br />

金額<br />
<input type="text" name="search_price" style="width:200px"><br />
<br />

フリーワード<br />
<input type="text" name="search_free_word" style="width:200px"><br />
<br />


<input type="submit" value="検索">
</br></br>

■新着案件■
</br></br>

<?php

//一覧表示件数だけ表示
//初期値カウンター（ページ先頭データ添字）
//条件（カウンター ＜ ページ先頭データ添字　＋　一覧表示件数）
//for($i=$iFirstSubscript;$i<$iFirstSubscript+DISPLAY_COUNT;$i++)
for($i=0;$i<DISPLAY_COUNT;$i++)
{
	if($i >= $iTotalCount) break;

	print '案件番号';
	print '</br>';
	print $arrayData[$i]['project_id'];
	print '</br>';

	print '案件名';
	print '</br>';
	print '<a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">'.$arrayData[$i]['project_subject'].'</a>';
	//print $arrayData[$i]['project_subject'];
	print '</br></br>';
}

?>