<?php
session_start();

global $config;
require_once('../inc/functions.php');
include ('../inc/config.php'); 
include ('../inc/pre.php'); 
echo "<script type=\"text/javascript\">";
if (isset($_POST['mode'])) {
	$act='error';
	$mode=$_POST['mode'];
// save values to database
	switch ($mode) {
		case 'edit':	//'Update exist'
			@mysql_unbuffered_query("Update d_vul set name='".$_POST['vul']."' where id=".$_POST['uid']);
			if (mysql_errno()==0) $act='update';
			break;
		case 'add':		//'Create new'
			@mysql_unbuffered_query("Insert into d_vul (name,parent) values ('".$_POST['vul']."','".$_POST['parent']."')");
			if (mysql_errno()==0) $act='reload';
			break;
		case 'del':		// 'Delete exist'
			@mysql_unbuffered_query("Delete from d_vul where id=".$_POST['uid']);
			if (mysql_errno()==0) $act='reload';
			break;
	}
// end of save values to database or delete
	switch ($act) {
		case 'reload':
			echo("window.parent.location.reload();");
			break;
		case 'update':
			echo("window.parent.SetStatus('<font color=green>¬улиц€ збережена.</font>');");
			echo("window.parent.updaterow('".$_POST['uid']."','".$_POST['vul']."');");
			break;
		case 'error':
			echo("window.parent.SetStatus('<font color=red>ѕомилка. ¬улиц€ не збережена!</font>');");
			echo("alert('ѕомилка. ¬улиц€ не збережена!');");
			break;
	}
} 
echo("</script>");
?>

