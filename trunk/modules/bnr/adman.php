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
 }else{
  include("../adman/config.php");
 }
 login();
 
 if(!isset($action)){
 $query = "select * from $banners where status = 1";
 $result = doquery($query);
 $num = mysql_num_rows($result);
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
 if($adtype == 1){ 
  echo "<a href='adman/adman.php?id=".$id."&action=show' target='_blank'><img border='0' src='$image' alt='$alt'></a>";
 }else{
  echo $adtext;
 }
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
