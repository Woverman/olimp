<?php
header("Content-type: text/html; charset=UTF-8");
require_once('../inc/functions.php');
include ('../classes.php');
//include ('../inc/pre.php');
//global $sys;
$tbl = $_REQUEST['tbl'];
$obl = $_REQUEST['obl'];
echo $tbl.'|';
$sql = sprintf('SELECT * from d_%s where parent=%s order by name',$tbl,$obl);
//echo $sql.'|';
$res = $DB->request($sql,ARRAY_N);
echo json_encode($res);
?> 