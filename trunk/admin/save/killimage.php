<?
header("Content-type: text/html; charset=windows-1251");
require_once('../../inc/functions.php');
include ('../../inc/config.php');
//  http:,,olimp.vin.ua,i,boguna,78,min,2.jpg

$sitename = "http://".$_SERVER[HTTP_HOST]."/";
$file=str_replace($sitename,$config['SIGHT_ROOT'],(str_replace(",","/",$_GET['file'])));
$bigfile = str_replace("/min/","/max/",$file);
unlink($file);
unlink($bigfile);
?>