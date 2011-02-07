<?php
header('Content-type: image/gif',true);

require_once('./inc/functions.php');
require_once('classes.php');
$objid = $_REQUEST['objid'];
$mode = $_REQUEST['mode'];
$num = $_REQUEST['num'];
if (!isset($mode)) $mode=2;
if (!isset($objid)) $objid=0;
if (!isset($num)) $num=1;

$realFileName = "./i/obj/".($mode==2?"tmb":"img")."_".$objid."_".$num.".jpg";
if (is_file($realFileName)) // if image saved to file
{
  readfile($realFileName);
}
else // image saved to DB
{
	$sql='Select '.($mode==2?"tumb":"foto").' from m_fotos where objid='.$objid.' and orderval='.$num;
	$res = $DB->request($sql,ARRAY_N);
	if ($res[0][0]!='') {
  		echo $res[0][0];
	} else {
		$img= ($mode==2 ? 'smol' : 'big');
		$href = './i/no_'.$img.'.jpg';
		readfile($href);
    }
}
?>