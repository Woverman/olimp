<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include ('../classes.php'); // classes, config and functions
require_once('../inc/functions.php');
$res = "edit";
$resmsg = "";
// save values to database
if (isset($_POST['mode'])) {
  $id=$_POST['uid'];
  switch ($_POST['mode']) {
  	case 'add': 		//'Create new'
		$id = $DB->insert("Insert into d_users (login) values ('')");
		$res = 'add';
	case 'edit':			//'Save exist'
		mysql_unbuffered_query("Update d_users set login='".$_POST['login']."' where id=".$id);
		mysql_unbuffered_query("Update d_users set rights='".$_POST['rights']."' where id=".$id);
		mysql_unbuffered_query("Update d_users set name='".$_POST['longname']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set posada='".$_POST['posada']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set phone1='".$_POST['phone1']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set phone2='".$_POST['phone2']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set phone3='".$_POST['phone3']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set phone4='".$_POST['phone4']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set email='".$_POST['email']."' where id=".$id);
	    mysql_unbuffered_query("Update d_users set otdel='".$_POST['otdel']."' where id=".$id);
    	saveImgToBase('-'.$id);
		$lock=0;
		if (isset($_POST['locked'])) $lock=$_POST['locked'];
		mysql_unbuffered_query("Update d_users set block='".$lock."' where id=".$_POST['uid']);
		if ($_POST['pass']!='') mysql_unbuffered_query("Update d_users set pass='".md5($_POST['pass'])."' where id=".$_POST['uid']);
		$resmsg = $id;
    	break;
	case 'del': 		// delete exist user
	    if ($_POST['uid']!=$user->id) {
	        $sql="Delete from d_users where id=".$_POST['uid'];
		    mysql_unbuffered_query($sql);
	        $sql="Delete from d_foto where objid=-".$_POST['uid'];
	        mysql_unbuffered_query($sql);
	        $res = "del";
			$resmsg = $id;
	    } else {
	        $res='error';
	        $resmsg = 'Неможливо знищити самого себе!';
	    }
	    break;
	}
  echo($res.':'.$resmsg);
  }
?>