<?php
session_start();

global $config;
require_once('../inc/functions.php');
include ('../inc/config.php');
include ('../inc/pre.php');
$res='error';
$resmsg='Помилка. Інформація не збережена!';
// save values to database
if (isset($_POST['mode'])) {
  switch ($_POST['mode']) {
	case 'edit':			//'Save exist'
		mysql_unbuffered_query("Update d_users set login='".$_POST['login']."' where id=".$_POST['uid']);
		mysql_unbuffered_query("Update d_users set rights='".$_POST['rights']."' where id=".$_POST['uid']);
		mysql_unbuffered_query("Update d_users set name='".$_POST['longname']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set posada='".$_POST['posada']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set phone1='".$_POST['phone1']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set phone2='".$_POST['phone2']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set phone3='".$_POST['phone3']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set phone4='".$_POST['phone4']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set email='".$_POST['email']."' where id=".$_POST['uid']);
    mysql_unbuffered_query("Update d_users set otdel='".$_POST['otdel']."' where id=".$_POST['uid']);
    saveImgToBase('-'.$_POST['uid']);
		$lock=0;
		if (isset($_POST['locked'])) $lock=$_POST['locked'];
		mysql_unbuffered_query("Update d_users set block='".$lock."' where id=".$_POST['uid']);
		if ($_POST['pass']!='') mysql_unbuffered_query("Update d_users set pass='".md5($_POST['pass'])."' where id=".$_POST['uid']);
    $res = 'reload';
    break;
	case 'add': 		//'Create new'
		if (!isset($_POST['locked'])) $_POST['locked']=0;
		$sql="Insert into d_users (login,pass,rights,block,name,pos,posada,phone1,phone2,phone3,phone4,email,otdel)
    values ('".$_POST['login']."','".md5($_POST['pass'])."','".$_POST['rights']."','"
    .$_POST['locked']."','".$_POST['longname']."','".$_SESSION['user']."','".$_POST['posada']."','"
    .$_POST['phone1']."','".$_POST['phone2']."','".$_POST['phone3']."','".$_POST['phone4']."','"
    .$_POST['email']."','".$_POST['otdel']."')";
		mysql_unbuffered_query($sql);
    $sql="Select id from d_users where login='".$_POST['login']."' and name='".$_POST['longname']."'";
    $uid=mysql_result(mysql_query($sql),0);
    saveImgToBase('-'.$uid);
    $res = 'reload';
    break;
	case 'del': 		// delete exist user
    if ($_POST['uid']!=CurrentUserID()) {
        $sql="Delete from d_users where id=".$_POST['uid'];
	    mysql_unbuffered_query($sql);
        $sql="Delete from d_foto where objid=-".$_POST['uid'];
        mysql_unbuffered_query($sql);
        $res = 'reload';
    } else {
        $res='error';
        $resmsg = 'Неможливо знищити самого себе!';
    }
    break;
	}
echo "<script type=\"text/javascript\">\n";
switch($res) {
  case 'update':
    $sql="Select id,name,login,rights,locked from d_users where id=".$_POST['uid'];
    $ret = mysql_query($sql);
    $row = mysql_fetch_assoc($ret);
    $data = $row['id'].'{'.$row['login'].'{'.$row['name'].'{'.$row['rights'].'{'.$row['locked'];
    echo("window.parent.clearForm();\n");
    echo("window.parent.SetStatus('<font color=green>Інформація збережена.</font>');\n");
	  echo("window.parent.updaterow('".$_POST['uid']."','".$data."');");
    break;
  case 'reload':
    echo("window.parent.location.reload();");
    break;
  case 'error':
    echo("window.parent.SetStatus('<font color=red>".$resmsg."</font>');");
		echo("alert('$resmsg');");
    break;

}
echo "</script>\n";
}
// end of save values to database or delete
?>