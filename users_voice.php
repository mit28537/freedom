<?php
    require_once('config.php');
    require_once('common.php');
?>


<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
		<title><?php print $config['app']['app_title']; ?></title>
    </head>
    <body>

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

  <div class="element element-1"></div>
  <p class="text text-1">利用者の声</p>
  <div class="element element-2"></div>
  <div class="element element-3"></div>
  <div class="text text-2">
    <p>同様のサイトに約半年登録していましたが</p>
    <p>年齢のこともあり、なかなか契約にいたりませんでした。</p>
    <p>&nbsp;こちらのサイトでは、私にマッチする</p>
    <p>案件を根気強く探して下さり
契約にいたることができました。</p>
    <p>■開発系エンジニア（５０代・男性）<br></p>
</div>
  <div class="element element-4"></div>
  <div class="text text-3">
    <p>別業種に転職するため夜間スクールに通いながら</p>
    <p>時短で勤務しています。</p>
    <p>現場の責任者も何かと考慮して頂き</p>
    <p>気兼ねすることなく仕事ができています！！</p>
    <p>■ヘルプデスク系エンジニア（３０代・女性）<br></p>
</div>
  <div class="element element-5"></div>
  <div class="text text-4">
    <p>フリーの仕事は初めてで不安もありました。</p>
    <p>
 しかし、こちらのプロパーが参画している</p>
    <p>案件に入れていただき
</p>
    <p>安心してフリーエンジニアデビューをすることができました。<br></p>
    <p>■開発系エンジニア（２０代）<br></p>
</div>
  <div class="element element-6"></div>

    <!-- コピーライト　-->
    <div class="box_copyright">
        <p> Copyright(C) MIT.inc. Allrights reserved </p>
    </div>
    <!-- コピーライトEND　-->

    </body>
</html>
