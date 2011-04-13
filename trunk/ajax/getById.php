<?php
header("Content-type: text/html; charset=utf-8");
include ('../classes.php'); // classes, config and functions
$tbl = $_GET['tbl'];
$id = $_GET['id'];
$sql = sprintf('SELECT * from %s where %s',$tbl,' id='.$id);
$res=mysql_query($sql);
while ($row=mysql_fetch_row($res)) {   
	echo(implode("{",$row));
}
?> 