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

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="grid-guide.css">
<title>ふりーえんじにゃ</title>
</head>
<body>

<!-- ヘッダー　-->
<div class="box1">
<div class="box1-1">
フリーえんじにゃ
</div>
<div class="box1-2">
Home とか
</div>
</div>

<!-- トップ画像　-->
<div class="box2">
Top
</div>

<div class="boxA">
<!-- 新着案件　-->
<div class="box3">
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

	print '案件名';
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

</div>

<!--　新着案件　-->
<div class="box4">
ＳＮＳ面談
</div>

</div>


<div class="boxB">
<!-- ピックアップ案件　-->
<div class="box5">
ピックアップ案件
</div>

<!-- コンテンツ　-->
<div class="box6">
コンテンツ
</div>

</div>

<!-- オシラセ　-->
<div class="box7">
お知らせ
</div>


</body>
</html>
