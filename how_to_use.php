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

    <!-- メイン画像　-->
	<div class="top">
		<img src="img/HowToUse.jpg" class="main_img">
	</div>
    <!-- メイン画像END　-->

    <!-- コピーライト　-->
    <div class="box_copyright">
        <p> Copyright(C) MIT.inc. Allrights reserved </p>
    </div>
    <!-- コピーライトEND　-->

    </body>
</html>
