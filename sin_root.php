<?php

require_once('common.php');

const DISPLAY_COUNT = 6;		//�ꗗ�\������

//DB�A�N�Z�X���s
$get_data = get_employmentList();

//�֐��߂�l�擾
$iTotalCount=$get_data['iTotalCount'];
$iTotalPage=$get_data['iTotalPage'];
$arrayData=$get_data['arrayData'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>�t���[�Y�E�G���W�j�A</title>
</head>
<body>



�g�b�v���<br /><br />

���Č�������
</br></br>

<form method="post" action="search_list.php">

�X�L��<br />
<input type="text" name="search_skill" style="width:200px"><br />
<br />

���z<br />
<input type="text" name="search_price" style="width:200px"><br />
<br />

�t���[���[�h<br />
<input type="text" name="search_free_word" style="width:200px"><br />
<br />


<input type="submit" value="����">
</br></br>

���V���Č���
</br></br>

<?php

//�ꗗ�\�����������\��
//�����l�J�E���^�[�i�y�[�W�擪�f�[�^�Y���j
//�����i�J�E���^�[ �� �y�[�W�擪�f�[�^�Y���@�{�@�ꗗ�\�������j
//for($i=$iFirstSubscript;$i<$iFirstSubscript+DISPLAY_COUNT;$i++)
for($i=0;$i<DISPLAY_COUNT;$i++)
{
	if($i >= $iTotalCount) break;

	print '�Č��ԍ�';
	print '</br>';
	print $arrayData[$i]['project_id'];
	print '</br>';

	print '�Č���';
	print '</br>';
	print '<a href="search_details.php?project_id= '.$arrayData[$i]['project_id'].'">'.$arrayData[$i]['project_subject'].'</a>';
	//print $arrayData[$i]['project_subject'];
	print '</br></br>';
}

?>