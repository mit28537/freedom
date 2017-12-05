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
<img src="img/top.png">
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


print '<div class="box8">';
	print '案件名';
	print '<a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">'.$arrayData[$i]['project_subject'].'</a>';

    print '金額';
	print $arrayData[$i]['project_price'];

    print '勤務地';
	print $arrayData[$i]['project_location'];
        
    print 'スキル';
	print $arrayData[$i]['project_skill'];
	print '</br></br>';
print '</div>';
}


?>


</div>

<!--　新着案件　-->
<div class="box4">
<img src="img/sna_men.jpg">

</div>

</div>


<div class="boxB">
<!-- ピックアップ案件　-->
<div class="box5">
■ピックアップ案件■
</br></br>
<?php
for($i=0;$i<DISPLAY_COUNT;$i++)
{
	if($i >= $iTotalCount) break;

print '<div>';
	print '案件名';
	print '<a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">'.$arrayData[$i]['project_subject'].'</a>';

    print '金額';
	print $arrayData[$i]['project_price'];

    print '勤務地';
	print $arrayData[$i]['project_location'];
        
    print 'スキル';
	print $arrayData[$i]['project_skill'];
	print '</br></br>';
print '</div>';

}
?>
</div>

<!-- コンテンツ　-->
<div class="box6">
BOX6
コンテンツ
</div>

</div>

<!-- 検索画面　-->
<div class="box7">
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

お知らせ
</div>


</body>
</html>
