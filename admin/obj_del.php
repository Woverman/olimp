<?
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/pre.php';

mysql_unbuffered_query("Delete from m_bildings where id=".$_REQUEST['id']);
mysql_unbuffered_query("Delete from m_fotos where objid=".$_REQUEST['id']);
header("HTTP/1.1 301 Moved Permanently");
header('Location: '.$_SERVER["HTTP_REFERER"]);

?>