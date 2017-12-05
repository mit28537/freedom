<?php
	session_start();
	//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。

	require_once('common.php');

	if (isset($_GET["page"]) )
	{
		//pageが設定されている場合は、DBアクセスなし
		$sDbAccess = 'NO';

		//セッションデータ取得
		$iTotalPage = $_SESSION['iTotalPage'];		//全ページ数
		$iTotalCount = $_SESSION['iTotalCount'];	//全データ件数
		$arrayData = $_SESSION['arrayData'];		//案件情報一覧データ

		$value_skill = $_SESSION['value_skill'];	//検索項目(スキル)
		$value_price = $_SESSION['value_price'];	//検索項目(金額)
		$value_free_word = $_SESSION['value_free_word'];	//検索項目(フリーワード)
	} else {
		//pageが設定されていない場合は、DBアクセスあり
		$sDbAccess = 'YES';
		//pageが設定されていない場合は、セッション破棄
		unset($_SESSION['iTotalPage']);
		$iTotalPage = 0;
	}
	if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $iTotalPage) {
	//URLパラメータにpageが存在する場合
	//pageが1以上で全ページを超えていない場合
	//悪意ある値を受け付けないようにキャストする
		$page = (int)$_GET["page"];
	} else {
		//上記条件以外はpageに1を設定
		$page = 1;
		if ( isset($_GET["project_id"]) ){
			//前画面からの入力データを受け取る
			$search_skill = $_POST['search_skill'];
			$search_price = $_POST['search_price'];
			$search_detail = $_POST['search_detail'];
			//サニタイジング
			$search_skill=htmlspecialchars($search_skill);
			$search_price=htmlspecialchars($search_price);
			$search_detail=htmlspecialchars($search_detail);
		}if($search_skill=null){
			$search_skill = "";
			}
		if($search_price=null or ""){
			$search_price = 0;
		}
		if($search_detail=null){
			$search_detail = '';
		}
	}
	const DISPLAY_COUNT = 15;		//一覧表示件数
	const PAGE_RANGE = 3;			//ページング幅

	// 検索項目を取得
	if( isset($_POST['search_skill']) ){
		$search_skill = $_POST['search_skill'];
		$_SESSION['value_skill'] = $_POST['search_skill'];
	} 
	if( isset($_POST['search_price']) ){
		$search_price = $_POST['search_price'];
		$_SESSION['value_price'] = $_POST['search_price'];
	}
	if( isset($_POST['search_free_word']) ){
		$search_detail = $_POST['search_free_word'];
		$_SESSION['value_free_word'] = $_POST['search_free_word'];
	}

	if($sDbAccess=='YES'){
		$get_data = get_searchList($search_skill,$search_price,$search_detail);

		//関数戻り値取得
		$iTotalCount=$get_data['iTotalCount'];
		$iTotalPage=$get_data['iTotalPage'];
		$arrayData=$get_data['arrayData'];

		//セッションに保存
		$_SESSION['iTotalCount']=$iTotalCount;
		$_SESSION['iTotalPage']=$iTotalPage;
		$_SESSION['arrayData']=$arrayData;

		//ページ先頭データ添字 = (現在のページ - 1) * 一覧表示件数
		$iFirstSubscript = ($page - 1) * DISPLAY_COUNT;
		//初画面の場合は１ページに設定
		header('Location:?page=1');
	}
	//ページ先頭データ添字 = (現在のページ - 1) * 一覧表示件数
	$iFirstSubscript = ($page - 1) * DISPLAY_COUNT;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<title>フリーえんじにゃ～</title>
		<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
		<div class=site_name>
			<img class="image" src="images/nayy.png">
		</div>
		<div class="top_menu">
			<?php
 				// menu表示
 				print_menu();
			?>
		</div>
		<!--<button class="_button _button-1">HOME</button>
		<button class="_button _button-2">新着案件</button>
		<button class="_button _button-3">注力案件</button>
		<button class="_button _button-4">ご利用の流れ</button>
		<button class="_button _button-5">会員登録</button>
		<div class="element element-1"></div>-->
		<b>●案件検索・案件情報一覧画面●</b>
		<br />
        <br />
        <div>
            <form method="post" action="search_list.php">
			    スキル<br />
    			<input type="text" name="search_skill" style="width:200px" value="<?php echo $value_skill ?>"><br />
	    		<br />
		    	金額<br />
			    <input type="text" name="search_price" style="width:200px" value="<?php echo $value_price ?>"><br />
    			<br />
	    		フリーワード<br />
		    	<input type="text" name="search_free_word" style="width:200px" value="<?php echo $value_free_word ?>"><br />
			    <br />
                <input type="submit" value="検索">
                <input type="button" onclick="history.back()" value="戻る">
            </form>
	    	</br>
	    	</br>
		    <?php
				print '検索結果は'.$iTotalCount.'件です';
    			print '</br></br>';
	    		//一覧表示件数だけ表示
		    	//初期値カウンター（ページ先頭データ添字）
				//条件（カウンター ＜ ページ先頭データ添字　＋　一覧表示件数）
				print'<div class="box_list">';
				print'<form method="post" action="search_details.php">';
				    for($i=$iFirstSubscript;$i<$iFirstSubscript+DISPLAY_COUNT;$i++){
						if($i==$iTotalCount){
							break;
						}
					    print'<table border=1 style="table-layout:fixed; float:left; margin:5px;width: 27%;">';
							print'<tr>';
								print'<td colspan="5" class="search_pj_header">案件番号</td>';
								print'<td colspan="5" class="pj_content">'. $arrayData[$i]['project_id'] .'</td>';
							print'</tr>';
							print'<tr>';
								print'<td colspan="5" class="search_pj_header">案件名</td>';
    							print'<td colspan="5" class="pj_content">'. $arrayData[$i]['project_subject'] .'</td>';
	    					print'</tr>';
							print'<tr>';
								print'<td colspan="5" class="search_pj_header">金額</td>';
			    				print'<td colspan="5" class="pj_content">'. $arrayData[$i]['project_price'] .'円</td>';
				   			print'</tr>';
							print'<tr>';
								print'<td colspan="5" class="search_pj_header">スキル</td>';
					    		print'<td colspan="5" class="pj_content">'. $arrayData[$i]['project_skill'] .'</td>';
						    print'</tr>';
    						print'<tr>';
	    						print '<td colspan="10" style="height:30px;text-align:center;"><a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">詳細みたい！</a></td>';
		    				print'</tr>';
			    		print'</table>';
				   	}
				print'</form>';
				print'</div>';
            ?>
            <br />
            <br />

		</div>
		<div class="page_counter">
            <?php //ページング ?>
            <?php if ($iTotalPage > 1) : ?>
             <div class="page">
                <?php if ($page > 1) : ?>
                  <a href="?page=<?php echo ($page - 1); ?>">prev</a>
                <?php endif; ?>
                <?php for ($i = PAGE_RANGE; $i > 0; $i--) : ?>
                  <?php if ($page - $i < 1) continue; ?>
                  <a href="?page=<?php echo ($page - $i); ?>"><?php echo ($page - $i); ?></a>
                <?php endfor; ?>

                <span><?php echo $page; ?></span>

                <?php for ($i = 1; $i <= PAGE_RANGE; $i++) : ?>
                  <?php if ($page + $i > $iTotalPage) break; ?>
                  <a href="?page=<?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
                <?php endfor; ?>

                <?php if ($page < $iTotalPage) : ?>
                  <a href="?page=<?php echo ($page + 1); ?>">next</a>
                <?php endif; ?>
             </div>
            <?php endif; ?>
        </div>
		<!-- コピーライト　-->
	    <div class="box_copyright">
            <p> Copyright(C) MIT.inc. Allrights reserved </p>
	    </div>
        <!-- コピーライトEND　-->

    </body>
</html>
