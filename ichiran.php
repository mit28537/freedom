<?php

require_once('common.php');

const DISPLAY_COUNT = 15;		//???\?|????

//DB?A?N?Z?X?

$get_data = get_employmentList();

//?????e?l?擾
$iTotalCount=$get_data['iTotalCount'];
$iTotalPage=$get_data['iTotalPage'];
$arrayData=$get_data['arrayData'];

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>案件一覧</title>
  <link rel="stylesheet" href="css/a.css">
  <link rel="stylesheet" href="css/b.css">
  <link rel="stylesheet" href="css/c.css">
</head>
<body class="body page-index clearfix">
  <img class="image" src="images/nayy.png">
  <button class="_button _button-1">HOME</button>
  <button class="_button _button-2">新着案件</button>
  <button class="_button _button-3">注力案件</button>
  <button class="_button _button-4">ご利用の流れ</button>
  <button class="_button _button-5">会員登録</button>
  <div class="element element-1"></div>

<form method="post" action="search_details.php">
<?php
    for($i=0;$i<DISPLAY_COUNT;$i++){
        print'<table border=1 style="float:left; margin:5px;width: 27%;">';
            print'<tr>';
                print'<td colspan="2">'. $arrayData[$i]['project_id'] .'</td>';
                print'<td colspan="3">'. $arrayData[$i]['project_subject'] .'</td>';
            print'</tr>';
            print'<tr>';
                print'<td colspan="5">'. $arrayData[$i]['project_price'] .'円</td>';
            print'</tr>';
            print'<tr>';
                print'<td colspan="5">'. $arrayData[$i]['project_skill'] .'</td>';
            print'</tr>';
            print'<tr>';
                print '<td colspan="5"><a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">詳細みたい！</a></td>';
            print'</tr>';
        print'</table>';
    }
?>
</form>

</br>
  <div class="element element-2"></div>
</body>
</html>
