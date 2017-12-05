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
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>ふりーえんじにゃー</title>
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/index-grid.css">
  <link rel="stylesheet" href="css/index.css">
 <link rel="stylesheet" href="css/index.css">
 <link rel="stylesheet" href="css/style.css">
</head>
<body class="body page-index clearfix">
  <img class="image image-1" src="images/top.png">
  <div class="element element-1"></div>
  <img class="image image-2" src="images/nayy.png">
  <div class="container"></div>
  <button class="_button _button-1">HOME</button>
  
  <a href="http://localhost/freedom/ichiran.php">
  <button class="_button _button-2">案件一覧</button>
  </a>
  
<button class="_button _button-3">ピックアップ案件</button>
  
   <a href="http://localhost/freedom/nagare.php">
  <button class="_button _button-4">ご利用の流れ</button>
  </a>
  <a href="http://localhost/freedom/kanin.php">
　<button class="_button _button-5">会員登録</button>
  </a>
　
  <div class="element element-2"></div>
  <button class="_button _button-6">新着案件</button>
  <div class="element element-3"></div>
  <div class="element element-4">
<?php for($i=0;$i<DISPLAY_COUNT;$i++)
    {
?>
<table border=1 style="float:left; margin:5px;width: 27%;">
	
<tbody>
		<tr>
			<td colspan="2"><?php     print $arrayData[$i]['project_id'];?></td>
			<td colspan="3"><?php     print $arrayData[$i]['project_subject'];?></td>
		</tr>
		<tr>
			<td colspan="5">金額:<?php     print $arrayData[$i]['project_price'];?>円</td>
		</tr>
		<tr>
			<td colspan="5">スキル:<?php     print $arrayData[$i]['project_skill'];?></td>
		</tr>
		<tr>
			<td colspan="5">勤務地:<?php     print $arrayData[$i]['project_location'];?> </td>
		</tr>
    <tr>
			<td colspan="5">
        <a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">'詳細見たい！</a>
      </td>
		</tr>
</tbody>
</table>
<?php
    }
?>

</br>


</div>
  <img class="image image-3" src="images/新規aaバス.jpg">
  <div class="element element-5"></div>
  <button class="_button _button-7">ピックアップ案件</button>
  <div class="element element-6">
<?php for($i=0;$i<DISPLAY_COUNT;$i++)
    {
?>
<table border=1 style="float:left; margin:5px;width: 27%;">
	
<tbody>
		<tr>
			<td colspan="2"><?php     print $arrayData[$i]['project_id'];?></td>
			<td colspan="3"><?php     print $arrayData[$i]['project_subject'];?></td>
		</tr>
		<tr>
			<td colspan="5">金額:<?php     print $arrayData[$i]['project_price'];?>円</td>
		</tr>
		<tr>
			<td colspan="5">スキル:<?php     print $arrayData[$i]['project_skill'];?></td>
		</tr>
		<tr>
			<td colspan="5">勤務地:<?php     print $arrayData[$i]['project_location'];?> </td>
	    
                </tr>
               	<tr>
			<td colspan="5">'<a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">'詳細見たい！</td></a>
		</tr>
</tbody>
</table>
<?php
    }
?>

</br>


</div>
  <div class="element element-7"></div>
  <button class="_button _button-8">案件検索</button>
  <div class="element element-8">
  <form method="post" action="search_list.php">

  スキル<br />
  <input type="text" name="search_skill" style="width:200px"><br />
  <br />

  金額<br />
  <input type="text" name="search_price" style="width:200px"><br />
  <br />s

  フリーワード<br />
  <input type="text" name="search_free_word" style="width:200px"><br />
  <br />


  <input type="submit" value="検索">
  </br></br>


  </div>
<div class="element element-9"></div>
</body>
</html>