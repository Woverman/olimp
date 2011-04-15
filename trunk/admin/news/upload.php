<?php;
	$dir = $_SERVER['DOCUMENT_ROOT'].'/i/news/';

	$_FILES['file']['type'] = strtolower($_FILES['file']['type']);

	if ($_FILES['file']['type'] == 'image/png'
	|| $_FILES['file']['type'] == 'image/jpg'
	|| $_FILES['file']['type'] == 'image/gif'
	|| $_FILES['file']['type'] == 'image/jpeg'
	|| $_FILES['file']['type'] == 'image/pjpeg')
	{
	  $fname=md5(date('YmdHis')).'.jpg';
		copy($_FILES['file']['tmp_name'], $dir.$fname);
		echo '/i/news/'.$fname;
	}
?>
