<?php
header("Content-type: text/html; charset=windows-1251");
require_once('../inc/functions.php');
include ('../inc/config.php'); 
include ('../inc/pre.php'); 
global $sys;
$sql = sprintf('SELECT * from %s where %s',$tbl,' id='.$id);
$res=mysql_query($sql);
while ($row=mysql_fetch_row($res)) {   
	echo(implode("{",$row));
}
?> 