<?php
/*************************************************************************************************

    phpAdManager 1.0
	Configuration Module
	Copyright 2003 Hamilton G Laughland

	Author: Hamilton G Laughland
	Website: http://www.laughland.biz

	This script is protected by New Zealand copyright law.

****************************************************************************************************/

$user = "olimpbiz_user";
$pass = "gSDJgYJd";
$host = "localhost";
$database = "olimpbiz_maindb";

$mysql=mysql_connect($host, $user, $pass, true);
mysql_select_db($database,$mysql);

/***** Do not change anything below this line *****************************************************/
$prefix = "adman_";

$banners = $prefix . "banners";
$stats = $prefix . "stats";


function doquery($query) {
	$result = mysql_query($query);
	return $result;
}

$msg = "<table align='center' class='head' width='80%' border='1' cellspacing='0' cellpadding='2'>";
?>
