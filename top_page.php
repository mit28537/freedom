<?php
    require_once('config.php');
    require_once('common.php');

    const DISPLAY_COUNT =6;		//一覧表示件数

    //DBアクセス実行
    $get_data = get_employmentList();
    $get_p_data = get_p_employmentList();

    //関数戻り値取得
    $iTotalCount=$get_data['iTotalCount'];
    $iTotalPage=$get_data['iTotalPage'];
    $arrayData=$get_data['arrayData'];

    $p_TotalCount=$get_p_data['iTotalCount'];
    $p_TotalPage=$get_p_data['iTotalPage'];
    $p_arrayData=$get_p_data['arrayData'];

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

        <!-- トップ画像　-->
		<div class="top">
			<img src="img/top.png" class="top_img">
		</div>
        <!-- トップ画像END　-->
        <!-- 検索　-->
        <div class="box_search">
            <form method="post" action="search_list.php">
                <table border="0">
                    <tr>
                        <td style="width:100px"><b>スキル：</b></td>
                        <td style="width:100px"><input type="text" name="search_skill" style="width:200px"><br /></td>
                        <td style="width:100px;text-align:center;"><b>金額：</b></td>
                        <td style="width:100px"><input type="text" name="search_price" style="width:200px"><br /></td>
                    </tr>
                    <tr>
                        <td style="width:150px"><b>フリーワード：</b></td>
                        <td style="width:200px" colspan="3"><input type="text" name="search_free_word" style="width:400px"><br /></td>
                    </tr>
                    <tr >
                        <td  style="width:100px;height:60px;vertical-align:middle" colspan="4"><input class="pj_search_btn" type="submit" value="案件検索"></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- 検索END　-->
        <!-- 中央位置　-->
        <div class="box_middle">
            <div class="box_main">
                <!-- 新着案件　-->
                <div class="box_new">
                    <p><b>■新着案件■</b></p>
                    <form method="post" action="search_details.php">
                        <?php
                            if($iTotalCount<DISPLAY_COUNT){
                                $count=$p_TotalCount;
                            }else{
                                $count=DISPLAY_COUNT;
                            }
                            for($i=0;$i<$count;$i++){;
                        ?>
                            <div class="box_list">
                            <?php
                                print'<table border=1 class=""style="table-layout:fixed; float:left; padding:5px; margin:10px; width: 45%; background-color: #FFFFFF">';
                                    print'<tr>';
                                        print'<td colspan="5" class="pj_cate_image" >';
                                        print'<img src="'.$arrayData[$i]['mst_img_path'].'" class="cate_img"></td>';
                                        print'<td colspan="5" class="pj_content">';
                                        print'    <b>【'.$arrayData[$i]['mst_name'].'】</b><br>';
                                        print     $arrayData[$i]['project_subject'] ;
                                        print'</td>';
                                    print'</tr>';
                                    print'<tr>';
                                        print'<td colspan="5" class="pj_header">金額</td>';
                                        print'<td colspan="5" class="pj_content">'. $arrayData[$i]['project_price'] .'円</td>';
                                    print'</tr>';
                                    print'<tr>';
                                        print'<td colspan="5" class="pj_header">スキル</td>';
                                        print'<td colspan="5" class="pj_content">'. $arrayData[$i]['project_skill'] .'</td>';
                                    print'</tr>';
                                    print'<tr>';
                                        print '<td colspan="10" class="box_detail_btn"><a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'" class="design_btn">詳細みたい！</a></td>';
                                    print'</tr>';
                            print'</table>';
                            ?>
                            </div>
                        <?php
                            }
                        ?>
                    </form>
                </div>
                <!-- 新着案件END　-->

                <!-- ピックアップ案件　-->
                <div class="box_pickup">
                    <p><b>■ピックアップ案件■</b></p>
                    <form method="post" action="search_details.php">
                        <?php
                            if($p_TotalCount<DISPLAY_COUNT){
                                $count=$p_TotalCount;
                            }else{
                                $count=DISPLAY_COUNT;
                            }
                            for($i=0;$i<$count;$i++){;
                        ?>
                                <div class="box_list">
                                    <?php
                                        print'<table border=1 style="table-layout:fixed; float:left;padding:5px; margin:10px; width: 45%; background-color: #FFFFFF">';
                                            print'<tr>';
                                                print'<td colspan="5" class="pj_cate_image" >';
                                                print'<img src="'.$arrayData[$i]['mst_img_path'].'" class="cate_img"></td>';
                                                print'<td colspan="5" class="pj_content">';
                                                print'    <b>【'.$arrayData[$i]['mst_name'].'】</b><br>';
                                                print     $arrayData[$i]['project_subject'] ;
                                                print'</td>';
                                            print'</tr>';
                                            print'<tr>';
                                                print'<td colspan="5" class="pj_header">金額</td>';
                                                print'<td colspan="5" class="pj_content">'. $p_arrayData[$i]['project_price'] .'円</td>';
                                            print'</tr>';
                                            print'<tr>';
                                                print'<td colspan="5" class="pj_header">スキル</td>';
                                                print'<td colspan="5" class="pj_content">'. $p_arrayData[$i]['project_skill'] .'</td>';
                                            print'</tr>';
                                            print'<tr>';
                                                print '<td colspan="10" class="box_detail_btn"><a href="search_details.php?project_id= '.$p_arrayData[$i]['project_id'].'" class="design_btn">詳細みたい！</a></td>';
                                            print'</tr>';
                                        print'</table>';
                                    ?>
                                </div>
                        <?php
                            }
                        ?>
                    </form>
                </div>
                <!-- ピックアップ案件END　-->
            </div>

            <!--　SNS　-->
            <div class="box_side">
                <table>
                    <tr>
                        <td><img src="img/sna_men.jpg" class="sna_img"/></td>
                    </tr>
                    <tr>
                        <td style="text-align:center"><img src="img/member_regist.png" class="url_side_img"/></td>
                    </tr>
                    <tr>
                        <td style="text-align:center"><img src="img/available_flow.png" class="url_side_img"/></td>
                    </tr>
                    <tr>
                        <td style="text-align:center"><img src="img/user_voice.png" class="url_side_img"/></td>
                    </tr>
                </table>   
            </div>
            <!--　SNS-END　-->
        </div>
        <!-- 中央位置END　-->

        <br />
        <br />
        <br />

        <!-- コピーライト　-->
	    <div class="box_copyright">
            <p> Copyright(C) MIT.inc. Allrights reserved </p>
	    </div>
        <!-- コピーライトEND　-->

    </body>
</html>
