<?php

    require_once('common.php');

    //前画面から案件番号を取得
    if ( isset($_GET["project_id"]) ){
        $project_id = (int)$_GET["project_id"];

        //案件詳細情報取得
        $arrayData = get_employmentDetails($project_id);

        $projectKindArray = get_mstProjectKindDetails($arrayData['project_kind_id']);

        $projectIndustryArray = get_mstProjectIndustryDetails($arrayData['project_industry_id']);
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>ふりーえんじにゃー</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/a.css">
    </head>
    <body>
        <!--<img class="image" src="images/nayy.png">
        <a href="http://localhost/freedom/top_page.php">
            <button class="_button _button-1">HOME</button>
        </a>
        <button class="_button _button-2">ご利用の流れ</button>
        <button class="_button _button-3">SNS面談</button>
        <button class="_button _button-4">案件一覧</button>
        <button class="_button _button-5">
            <a href="http://localhost/freedom/kanin.php">
                <button class="_button _button-5">会員登録</button>
            </a>
        </button>
        <div class="element element-1"></div>-->

        <!-- ヘッダー -->
        <div class="site_name">
                <img src="img/nayy.png" class="site_name_img">
        </div>

        <div class="top_menu">
            <?php
                print_menu();
            ?>
		</div>
        <!-- ヘッダーEND -->

        <form method="post" action="engineer_register.php">
            <?php
                print'<table border=1 style="float:left; margin:5px;width:40%;">';
                    print'<tr>';
                        print'<td>案件番号</td>';
                        print'<td style="width:70%;">'. $arrayData['project_id'] .'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>案件名</td>';
                        print'<td style="width:70%;">'. $arrayData['project_subject'] .'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>案件種別</td>';
                        print'<td style="width:70%;">'. $projectKindArray['mst_name'].'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>業種</td>';
                        print'<td style="width:70%;">'. $projectIndustryArray['mst_name'] .'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>スキル</td>';
                        print'<td style="width:70%;">'. $arrayData['project_skill'] .'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>金額</td>';
                        print'<td style="width:70%;">'. $arrayData['project_price'] .'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>勤務地</td>';
                        print'<td style="width:70%;">'. $arrayData['project_location'] .'</td>';
                    print'</tr>';
                    print'<tr>';
                        print'<td>案件内容</td>';
                        print'<td style="width:70%;">'. $arrayData['project_detail'] .'</td>';
                    print'</tr>';
                    print'<br />';
                    print'<br />';
                    print'<td><input type="button" onclick="history.back()" value="戻る"></td>';
                    print'<td style="width:70%;"><a href="engineer_register.php?project_id= '.$arrayData['project_id'].'">この案件にエントリーする</a></td>';
                print'</table>';
                print'<br />';
            ?>
        </form>
        <div class="element element-2"></div>
    </body>
</html>
