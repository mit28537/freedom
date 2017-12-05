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
		<title>フリーズエンジニア</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<img class="image" src="images/nayy.png">
		<button class="_button _button-1">HOME</button>
		<button class="_button _button-2">新着案件</button>
		<button class="_button _button-3">注力案件</button>
		<button class="_button _button-4">ご利用の流れ</button>
		<button class="_button _button-5">会員登録</button>
		<div class="element element-1"></div>
		●案件検索・案件情報一覧画面●
		<br />
		<br />
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
			</br>
			</br>
			<?php
				print '検索結果は'.$iTotalCount.'件です';
				print '</br></br>';
				//一覧表示件数だけ表示
				//初期値カウンター（ページ先頭データ添字）
				//条件（カウンター ＜ ページ先頭データ添字　＋　一覧表示件数）
				print'<form method="post" action="search_details.php">';
					for($i=$iFirstSubscript;$i<$iFirstSubscript+DISPLAY_COUNT;$i++){
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
				print'</form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
			?>
			<div class=pageCount>
				<p>現在 <?php echo $page; ?> ページ目です。</p>
				<p>
					<!--現在のページが２ページ以上の場合は戻るリンクを表示-->
    				<?php if ($page > 1) : ?>
      					<a href="?page=<?php echo ($page - 1); ?>">前のページへ</a>
		    		<?php endif; ?>
					<!--現在のページが２ページ以上の場合は戻るリンクを表示-->
    				<?php for ($i = PAGE_RANGE; $i > 0; $i--) : ?>
						<!--１ページ未満の場合はスキップ-->
						<?php if ($page - $i < 1) continue; ?>
	    				<a href="?page=<?php echo ($page - $i); ?>"><?php echo ($page - $i); ?></a>
		    		<?php endfor; ?>
    				<span><?php echo $page; ?></span>
					<!--現在のページ以上のリンクを表示-->
		    		<?php for ($i = 1; $i <= PAGE_RANGE; $i++) : ?>
						<!--全ページ数を超える場合はループ終了-->
    					<?php if ($page + $i > $iTotalPage) break; ?>
	    				<a href="?page=<?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
			    	<?php endfor; ?>
					<!--現在のページが全ページ未満の場合は進むリンクを表示-->
    				<?php if ($page < $iTotalPage) : ?>
      					<a href="?page=<?php echo ($page + 1); ?>">次のページへ</a>
			    	<?php endif; ?>
  				</p>
			</div>
		</form>
		<br />
	</body>
</html>
