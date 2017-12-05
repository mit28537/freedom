<?php

require_once('common.php');

//前画面から案件番号を取得
if ( isset($_GET["project_id"]) ){
  $project_id = (int)$_GET["project_id"];

  //案件詳細情報取得
  $arrayData = get_employmentDetails($project_id);

  //案件種別取得
$projectKindArray = get_mstProjectKind();

//業種取得
$projectIndustryArray = get_mstProjectIndustry();

//業務取得
$projectPhaseArray = get_mstProjectPhase();
 }

?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>ふりーえんじにゃー</title>
    <link rel="stylesheet" href="css/c.css">
    <link rel="stylesheet" href="css/b.css">
    <link rel="stylesheet" href="css/a.css">
  </head>
  <body class="body page-index clearfix">
    <img class="image" src="images/nayy.png">
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
    <div class="element element-1"></div>

    <form method="post" action="engineer_register.php">
      案件番号<br />
      <?php print $arrayData['project_id']; ?><br />
      <input type="hidden" name="project_id" value="<?php print $arrayData['project_id']; ?>"><br />
      案件名<br />
      <input type="text" name="project_subject" style="width:400px" value="<?php print $arrayData['project_subject']; ?>" readonly="readonly"><br />
      <br />
      案件内容<br />
      <textarea name="project_detail" cols="70" rows="3" readonly="readonly"><?php print $arrayData['project_detail']; ?></textarea><br />
      <br />
      業種<br />
      <input type="text" name="project_industry" style="width:200px" value="<?php print $arrayData['project_industry']; ?>" readonly="readonly"><br />
      <br />
      スキル<br />
      <input type="text" name="project_skill" style="width:200px" value="<?php print $arrayData['project_skill']; ?> " readonly="readonly"><br />
      <br />
      金額<br />
      <input type="text" name="project_price_low" style="width:80px" value="<?php print $arrayData['project_price_low']; ?>" readonly="readonly">
      ～
      <input type="text" name="project_price_high" style="width:80px" value="<?php print $arrayData['project_price_high']; ?>" readonly="readonly"><br />
      <br />
      期間<br />
      <input type="text" name="project_period" style="width:200px" value="<?php print $arrayData['project_period']; ?>" readonly="readonly"><br />
      <br />
      勤務場所<br />
      <input type="text" name="project_location" style="width:200px" value="<?php print $arrayData['project_location']; ?>" readonly="readonly"><br />
      <br />
      担当フェーズ<br />
      <input type="text" name="project_phase" style="width:200px" value="<?php print $arrayData['project_phase']; ?>" readonly="readonly"><br />
      <br />
      募集人数<br />
      <input type="text" name="project_number_of_people" style="width:200px" value="<?php print $arrayData['project_number_of_people']; ?>" readonly="readonly"><br />
      <br />
      就業時間<br />
      <input type="text" name="project_working_hours" style="width:200px" value="<?php print $arrayData['project_working_hours']; ?>" readonly="readonly"><br />
      <br />
      面談回数<br />
      <input type="text" name="project_number_of_meetings" style="width:200px" value="<?php print $arrayData['project_number_of_meetings']; ?>" readonly="readonly"><br />
      <br />
      備考<br />
      <textarea name="project_remarks" cols="50" rows="3" readonly="readonly"><?php print $arrayData['project_remarks']; ?></textarea>
      <br />
      <br />
      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="この案件にエントリーする">
    </form>
  <div class="element element-2"></div>
</body>
</html>
