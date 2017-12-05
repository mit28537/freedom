<?php

require_once('common.php');

const DISPLAY_COUNT =6;		//一覧表示件数

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
		<link rel="stylesheet" href="css/style.css">
		<title>フリーえんじにゃ～</title>
	</head>
	<body>
		<!-- ヘッダー　-->
		<div class="box1">
			<div class="box1-1">
				<img src="img/nayy.png">
			</div>
			<div class="box1-2">
				<ul>
					<li><a href="top_page.php">HOME</a></li>
					<li><a href="search_list.php">案件一覧</a></li>
					<li><a href="nagare.php">ご利用の流れ</a></li>
					<li><a href="vice.php">利用者の声</a></li>
					<li><a href="engineer_register.php">無料会員登録</a></li>
				</ul>
			</div>
		</div>
		<!-- ヘッダーEND　-->

		<!-- トップ画像　-->
		<div class="box2">
			<img src="img/top.png">
		</div>
		<!-- トップ画像END　-->

		<div class="box1a">
			■新着案件■
		</div>

		<!-- 案件グループ　-->
		<div class="boxA">

			<!-- 新着案件　-->
			<div class="box3">
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
							<td colspan="5"><?php     print $arrayData[$i]['project_price'];?>円</td>
						</tr>
						<tr>
							<td colspan="5"><?php     print $arrayData[$i]['project_skill'];?></td>
						</tr>
						<tr>
							<td colspan="5"><?php     print $arrayData[$i]['project_skill'];?> </td>
						</tr>
						<tr>
							<td colspan="5">詳細見たい！</td>
						</tr>
					</tbody>
				</table>
				<?php
    				}
				?>
				<br/>
			</div>
			<!-- 新着案件-END　-->

			<!--　SNS　-->
			<div class="box4">
				<img class="img-2" src="img/sna_men.jpg">
			</div>
			<!--　SNS-END　-->

			<div class="box9">
				■ピックアップ案件■
			</div>
			<!-- ピックアップ案件　-->
			<div class="box5">
				<?php for($i=0;$i<DISPLAY_COUNT;$i++)
    				{
				?>
				<table border=1 style="float:left; margin:5px;width: 27%;">
					<tbody>
						<form method="post" action="search_details.php">
							<tr>
								<td colspan="2"><input type="text" size="5px" value="<?php print $arrayData[$i]['project_id'];?>" readonly></td>
								<td colspan="3"><?php print $arrayData[$i]['project_subject'];?></td>
							</tr>
							<tr>
								<td colspan="5"><?php print $arrayData[$i]['project_price'];?>円</td>
							</tr>
							<tr>
								<td colspan="5"><?php print $arrayData[$i]['project_skill'];?></td>
							</tr>
							<tr>
								<td colspan="5"><?php print $arrayData[$i]['project_skill'];?> </td>
							</tr>
							<tr>
								<td colspan="5"><input type=submit value="詳細見たい！"></td>
							</tr>
						</form>
					</tbody>
				</table>
				<?php
    				}
				?>
			</div>
			<!-- ピックアップ案件-END　-->
		</div>
		<!-- 案件グループEND　-->

		<!-- 検索画面　-->
		<div class="box7">
			■案件検索■
			<br /></br />
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
				<br/><br/>
		</div>
	</body>
</html>
