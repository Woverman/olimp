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
include("templates/header.htm");

 mysql_query('SET NAMES utf8;');
 $pages='';
 $query="select id,title from m_pages order by title;";
 $result = doquery($query);
 if(mysql_num_rows($result) != 0){
  	while ($row = mysql_fetch_array($result)){
		$pages .= "<option value='/article/".$row['id']."'>".$row['title']."</option>";
	}
 }

 $news='';
 $query="select id,title from new_news where published=1 order by title;";
 $result = doquery($query);
 if(mysql_num_rows($result) != 0){
  	while ($row = mysql_fetch_array($result)){
		$news .= "<option value='/newsarticle/".$row['id']."'>".$row['title']."</option>";
	}
 }
 mysql_query('SET NAMES cp1251;');

function saveImage(){
	//print_r($imgfile);
	if (count($_FILES)==1){
		$upimage_name = $_FILES['upimage']['name'];
		$upimage_type = $_FILES['upimage']['type'];
		$upimage_tmpname = $_FILES['upimage']['tmp_name'];
		if ($upimage_type=='image/jpeg' || $upimage_type=='image/gif'  || $upimage_type=='image/png'  ){
			$imgfile = $_SERVER['DOCUMENT_ROOT']."/i/banners/".$upimage_name;
			print_r($imgfile);
			if(move_uploaded_file($upimage_tmpname, $imgfile)){
				return "/i/banners/".$upimage_name;
			}
		} else {
			/*echo("Недопустимий тип зображення: ".$upimage_type);
			echo("<pre>");
			print_r($_FILES);
			echo("</pre>");*/
		}
	}
	return "";
};

if(isset($_REQUEST['action'])){
	$adtype = $_REQUEST['adtype'];
	$link = $_REQUEST['link'];
	$image = $_REQUEST['image'];
	$adtext = $_REQUEST['adtext'];
	$alt = $_REQUEST['alt'];
	$title = $_REQUEST['title'];
	$status = $_REQUEST['status'];
	$id = $_REQUEST['id'];
	$adid = $_REQUEST['adid'];
	$newpage = $_REQUEST['newpage'];
	$target = $_REQUEST['target'];
	$hidetitle = $_REQUEST['hidetitle'];
}

$action = $_REQUEST['action'];
if($action == "add"){
 $act = "insert";
 $imgrow = "<tr><td align='center' class='list' colspan='2'>Новий банер / інформер</td></tr>";
 $radio = "&nbsp;<label>Ні<input name='status' type='radio' value='0' onchange='setVisible(this.value);'></label>&nbsp;<label>Так<input name='status' type='radio' value='1' checked onchange='setVisible(this.value);'></label>";
 $adstyle = "&nbsp;<label>Зображення<input name='adtype' type='radio' value='1' checked onchange='setType(this.value);'></label>&nbsp;<label>Текст <input name='adtype' type='radio' value='0' onchange='setType(this.value);'></label>";
 $newpage = "&nbsp;<label>Ні<input name='newpage' type='radio' value='0'></label>&nbsp;<label>Так<input name='newpage' type='radio' value='1' checked></label>";
 $displayText='none';
 $displayImage='table-row';
 $displayText='table-row';

 include("templates/add.htm");
}

if($action == "insert"){ //after submit new item

 $newimage = saveImage();
 if($newimage != ""){
  $image = $newimage;
 }
 if(!isset($link)){$link = "";}
 if(!isset($adtext)){$adtext = "";}

 $query = "INSERT INTO $banners (`adtype`,`link`,`image`,`adtext`,`alt`,`status`,`title`,`isNewPage`,`target`,`hidetitle`) VALUES
 ('$adtype','$link','$image','$adtext','$alt','$status','$title','$newpage','$target','$hidetitle')";

 $result = doquery($query);
}

if($action == "edit"){ // list all items
 $query = "select * from $banners";
 $result = doquery($query);
 if(mysql_num_rows($result) != 0){
  while ($row = mysql_fetch_array($result)){
   $id = $row['id'];
   $image = $row['image'];
   $alt = $row['alt'];
   $title = $row['title'];
   $adtype = $row['adtype'];
   $adtext = $row['adtext'];
   $status = $row['status'];
   $hideshowaction = $status==1?'hide':'show';
   $hideshowtitle = $status==1?'Приховати':'Опублікувати';
   if($adtype == 1){
    $adimg = "<img src='$image' alt='$alt'>";
   }else{
    $adimg = $adtext;
   }
   include("templates/list.htm");
  }
  echo "<br>";
 }else{
  $message = "<tr><td align='center' class='message' colspan='2'>Банерів не знайдено</td></tr>";
  $msg .= $message . "</table>";
  echo $msg;
 }
}

if($action == "delete"){ // delete a item
 $query = "DELETE FROM $banners WHERE id = $id";
 $result = doquery($query);
 $message = "Банер видалено!";
}

if($action == "hide"){ // set status to 'hide'
 $query = "UPDATE $banners SET status=0 WHERE id = $id";
 $result = doquery($query);
 $message = "Банер приховано!";
}

if($action == "show"){ // set status to 'show'
 $query = "UPDATE $banners SET status=1 WHERE id = $id";
 $result = doquery($query);
 $message = "Банер показано на сайті!";
}

if($action == "item"){ // display a item for modify
 $query = "select * from $banners WHERE id = $id";
 $result = doquery($query);
 $row = mysql_fetch_array($result);

 $id = $row['id'];
 $title = $row['title'];
 $adtype = $row['adtype'];
 $image = $row['image'];
 $alt = $row['alt'];
 $link = $row['link'];
 $adtext = $row['adtext'];
 $status = $row['status'];
 $newpage = $row['isNewPage'];
 $target = $row['target'];
 $hidetitle = $row['hidetitle'];

 if(!isset($adtype) || $adtype == 1){
	$imgchecked=' checked';
	$txtchecked='';
	$displayText='none';
 	$displayImage='table-row';
 }else{
 	$adtype = 0;
	$imgchecked='';
	$txtchecked=' checked';
	$displayText='table-row';
 	$displayImage='none';
 }
$adstyle = "&nbsp;<label>Зображення <input name='adtype' type='radio' value='1'".$imgchecked." onchange='setType(this.value);'></label>";
$adstyle .= "&nbsp;<label>Текст <input name='adtype' type='radio' value='0'".$txtchecked." onchange='setType(this.value);'></label>";

 if(!isset($status) || $status == 1){
  $enable = ' checked';
  $disable = '';
  $displayTarget='table-row';
 }else{
  $enable = '';
  $disable = ' checked';
  $displayTarget='none';
 }
 $radio = "&nbsp;<label>Ні<input name='status' type='radio' value='0'".$disable." onchange='setVisible(this.value);'></label>&nbsp;<label>Так<input name='status' type='radio' value='1'".$enable." onchange='setVisible(this.value);'></label>";

 if(!isset($newpage) || $newpage == 1){
  $enable = ' checked';
  $disable = '';
 }else{
  $enable = '';
  $disable = ' checked';
 }
 $newpage = "&nbsp;<label>Ні<input name='newpage' type='radio' value='0'".$disable."></label>&nbsp;<label>Так<input name='newpage' type='radio' value='1'".$enable."></label>";

 if($adtype == 1){
  $imgrow = "<tr><td align='center' class='list' colspan='2' height='84'><img border='0' src='$image'></td></tr>";
 }else{
  $imgrow = "<tr><td align='center' class='list' colspan='2' height='84'>$adtext</td></tr>";
 }

 $act = "update";

 include("templates/add.htm");
}

if($action == "update"){ // after submit a item

 $newimage = saveImage();
 if($newimage != ""){
  $image = $newimage;
 }
 if(!isset($link)){$link = " ";}
 if(!isset($adtext)){$adtext = " ";}
 $query = "UPDATE $banners SET adtype = '$adtype' , link ='$link' , image ='$image' , adtext = '$adtext'
 , alt ='$alt' , status ='$status', title='$title' , isNewPage='$newpage' , target = '$target', hidetitle='$hidetitle' WHERE id = '$id'";
 $result = doquery($query);
}

if($action == "stats"){
 $query = "select id,title from $banners";
 $result = doquery($query);
 while ($row = mysql_fetch_array($result)){
   $titles[$row['id']] = $row['title'];
 }
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

echo($message.'<br>');
include("templates/footer.htm");
?>
