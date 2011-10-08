<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include ('../classes.php'); // classes, config and functions
require_once('../inc/functions.php');
$sql = "DELETE FROM m_bildings WHERE id=".$_REQUEST['id'];
mysql_unbuffered_query($sql);
echo $sql;
$sql = "Delete from m_fotos where objid=".$_REQUEST['id'];
mysql_unbuffered_query($sql);
echo $sql;
?>