<?php
 /*************************************************************************************************

    phpAdManager 1.0
	Main Module
	Copyright 2003 Hamilton G Laughland
	
	Author: Hamilton G Laughland
	Website: http://www.laughland.biz
	
	This script is protected by New Zealand copyright law.
	
****************************************************************************************************/
 if($action == show){
  include("../config.php");
 }

 if(!isset($action)){
  mysql_query('set names "cp1251"');
  $query = "select * from $banners where target='$target' and status = 1";
  $result = doquery($query);
  $num = mysql_num_rows($result);
  if($num > 0){
 	if($num > 1){
 		$num = $num - 1;
  		$val = rand(0, $num);
  		mysql_data_seek($result, $val);
 	}
	$row = mysql_fetch_array($result);
	$id = $row['id'];
	$adtype = $row['adtype'];
	$image = $row['image'];
	$alt = $row['alt'];
	$link = $row['link'];
	$adtext = $row['adtext'];
	$title = $row['title'];
	$hidetitle = $row['hidetitle'];
	$newpage = $row['isNewPage'];

	$today = date("d m Y");
	$query = "select * from $stats where DATE_FORMAT(amdate, '%d %m %Y') = '$today' and id = $id";
	$result = doquery($query);
	$num_results = mysql_num_rows($result);
	$today = date("Y-m-d");
	if($num_results == 0){
		$query = "INSERT INTO $stats (id, amdate, displays, clicks) VALUES ($id, '$today', 1, 0)";
	}else{
		$query = "UPDATE $stats SET displays = displays + 1 WHERE id = $id AND amdate = '$today'";
	}
	$result = doquery($query);

	// show the banner
	if ($showframe) echo('<div class="vidget ui-corner-all">');
	if ($hidetitle=='0') echo('<span>'.$title.'</span>');
	if($adtype == 1){
		echo "<a href='/modules/bnr/adman.php?id=".$id."&action=show' target='_blank'><img border='0' src='$image' alt='$alt'></a>";
	}else{
	 	echo $adtext;
	}
	if ($showframe) echo('</div>');
	}
	mysql_query('set names "utf8"');
}

if($action == "show"){
 $query = "select * from $banners where id = $id";
 $result = doquery($query);
 $row = mysql_fetch_array($result);
 $link = $row['link'];
 $today = date("d m Y");
 $query = "select * from $stats where DATE_FORMAT(amdate, '%d %m %Y') = '$today' and id = $id";
 $result = doquery($query);
 $num_results = mysql_num_rows($result);
 $today = date("Y-m-d"); 
 $query = "UPDATE $stats SET clicks = clicks + 1 WHERE id = $id AND amdate = '$today'";
 $result = doquery($query);
 header("Location: ".$link);
 exit;
} 
?>
