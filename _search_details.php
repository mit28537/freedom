<?php
require_once('common.php');

//前画面から案件番号を取得
$project_id = (int)$_GET["project_id"];

//案件詳細情報取得
$arrayData = get_employmentList($project_id);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>フリーズ・エンジニア</title>
</head>
<body>

<h1>案件情報詳細画面</h1>

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

</body>
</html>
