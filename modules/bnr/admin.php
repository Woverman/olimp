<pre>

</pre>
<?php
/*************************************************************************************************

    phpAdManager 1.0
	Administration Module
	Copyright 2003 Hamilton G Laughland

	Author: Hamilton G Laughland
	Website: http://www.laughland.biz

	This script is protected by New Zealand copyright law.

****************************************************************************************************/
include("config.php");

if(!isset($_GET['action'])){
 $message = "<tr><td align='center' class='message' colspan='2'>Welcome to Ad Manager 1.0<br>Use the menus above to navigate.</td></tr>";
 $msg .= $message . "</table>";
 echo $msg;
}
$action = $_REQUEST['action'];
if($action == "add"){
 $act = "insert";
 $imgrow = "<tr><td align='center' class='list' colspan='2'>add new banner</td></tr>";
 $radio = "&nbsp;off<input name='status' type='radio' value='0'>&nbsp;on<input name='status' type='radio' value='1' checked>";
 $adstyle = "&nbsp;image<input name='adtype' type='radio' value='1' checked>&nbsp;rich text / html <input name='adtype' type='radio' value='0'";
 include("templates/add.htm");
}

if($action == "insert"){

$adtype = $_REQUEST['adtype'];
$link = $_REQUEST['link'];
$image = $_REQUEST['image'];
$upimage = $_REQUEST['upimage'];
$adtext = $_REQUEST['adtext'];
$alt = $_REQUEST['alt'];
$status = $_REQUEST['status'];

 if($upimage != ""){
  $imgfile = "images/".$upimage_name;
  if(!move_uploaded_file($upimage, $imgfile)){echo "Upload failed.";}
  $fp = fopen($imgfile, 'r');
  $temp = fread($fp, filesize($imgfile));
  fclose($fp);
  //$temp = strip_tags($temp);
  $fp = fopen($imgfile, 'w');
  fwrite($fp, $temp);
  fclose($fp);
 }
 
 if(isset($imgfile)){$image = $imgfile;}
 if(!isset($imgfile)){$image = " ";}
 if(!isset($link)){$link = " ";}
 if(!isset($adtext)){$adtext = " ";}
 
 $query = "INSERT INTO $banners (id,adtype,link,image,adtext,alt,status) VALUES ('','$adtype','$link','$image','$adtext','$alt',$status)";
 $result = doquery($query);
}

if($action == "edit"){
 $query = "select * from $banners";
 $result = doquery($query);
 if(mysql_num_rows($result) != 0){
  while ($row = mysql_fetch_array($result)){
   $id = $row['id'];
   $image = $row['image'];
   $alt = $row['alt'];
   $adtype = $row['adtype'];
   $adtext = $row['adtext'];
   if($adtype == 1){
    $adimg = "<img src='$image' alt='$image'>";
   }else{
    $adimg = $adtext;
   }
   include("templates/list.htm");
  }
  echo "<br>";
 }else{
  $message = "<tr><td align='center' class='message' colspan='2'>No banners found.</td></tr>";
  $msg .= $message . "</table>";
  echo $msg;
 }
} 

if($action == "delete"){
 $query = "DELETE FROM $banners WHERE id = $id";
 $result = doquery($query);
} 

if($action == "item"){
 $query = "select * from $banners WHERE id = $id";
 $result = doquery($query);
 $row = mysql_fetch_array($result);
 $id = $row['id'];
 $adtype = $row['adtype'];
 $image = $row['image'];
 $alt = $row['alt'];
 $link = $row['link'];
 $adtext = $row['adtext'];
 $status = $row['status'];
 if(!isset($adtype) || $adtype == 1){
  $adstyle = "&nbsp;image<input name='adtype' type='radio' value='1' checked>&nbsp;text / html<input name='adtype' type='radio' value='0'>";
 }else{
  $adstyle = "&nbsp;image<input name='adtype' type='radio' value='1'>&nbsp;text / html<input name='adtype' type='radio' value='0' checked>";
 }
 if(!isset($status) || $status == 1){
  $radio = "&nbsp;off<input name='status' type='radio' value='0'>&nbsp;on<input name='status' type='radio' value='1' checked>";
 }else{
  $radio = "&nbsp;off<input name='status' type='radio' value='0' checked>&nbsp;on<input name='status' type='radio' value='1'>";
 }
 $act = "update";
 if($adtype == 1){
  $imgrow = "<tr><td align='center' class='list' colspan='2' height='84'><img border='0' src='$image'></td></tr>";
 }else{
  $imgrow = "<tr><td align='center' class='list' colspan='2' height='84'>$adtext</td></tr>";
 }
 include("templates/add.htm");
}

if($action == "update"){

$adtype = $_REQUEST['adtype'];
$link = $_REQUEST['link'];
$image = $_REQUEST['image'];
$upimage = $_REQUEST['upimage'];
$adtext = $_REQUEST['adtext'];
$alt = $_REQUEST['alt'];
$status = $_REQUEST['status'];

 if($upimage != ""){
  $imgfile = "images/".$upimage_name;
  $image = $imgfile;
  if(!move_uploaded_file($upimage, $imgfile)){echo "Upload failed.";}
  $fp = fopen($imgfile, 'r');
  $temp = fread($fp, filesize($imgfile));
  fclose($fp);
  //$temp = strip_tags($temp);
  $fp = fopen($imgfile, 'w');
  fwrite($fp, $temp);
  fclose($fp);
 }
 if(!isset($image)){$image = " ";}
 if(!isset($link)){$link = " ";}
 if(!isset($adtext)){$adtext = " ";}
 $query = "UPDATE $banners SET adtype = '$adtype' , link ='$link' , image ='$image' , adtext = '$adtext' , alt ='$alt' , status ='$status'  WHERE id = '$id'";
 $result = doquery($query);
}

if($action == "stats"){
 if(isset($adid)){
  $query = "select * from $banners where id = $adid";
  $result = doquery($query);
  $row = mysql_fetch_array($result);
  $image = $row['image'];
  $adtype = $row['adtype'];
  $adtext = $row['adtext'];
  $imgrow ="<table align='center' class='head' width='80%' border='1' cellspacing='0' cellpadding='2'>";
  if($adtype == 1){
   $imgrow .= "<tr><td align='center' class='list' colspan='7' height='84'><img border='0' src='$image'></td></tr></table>";
  }else{
   $imgrow .= "<tr><td align='center' class='list' colspan='7' height='84'>$adtext</td></tr></table>";
  }
 }
 include('stats.php');
}

?>
