<?php
session_start();

global $config;
require_once('../inc/functions.php');
include ('../inc/config.php');
include ('../inc/pre.php');
?>
<meta http-equiv="Content-Language" content="ru">
<META HTTP-EQUIV="Content-Type" content="text/html; charset=Windows-1251">
<?php
echo "<script type=\"text/javascript\">";
if (isset($_POST['mode'])) {
	$act='error';
  $id=$_POST['uid'];
 	$mode=$_POST['mode'];
// save values to database
	switch ($mode) {
		case 'edit':	//'Update exist'
			@mysql_unbuffered_query("Update rss_news set sight='".$_POST['sight']."' where id=".$id);
      @mysql_unbuffered_query("Update rss_news set title='".$_POST['title']."' where id=".$id);
      @mysql_unbuffered_query("Update rss_news set link='".$_POST['link']."' where id=".$id);
      @mysql_unbuffered_query("Update rss_news set timeout='".($_POST['timeout']*$_POST['minute'])."' where id=".$id);
      $flg=0;
      if (isset($_POST['active'])) $flg=1;
      @mysql_unbuffered_query("Update rss_news set active='".$flg."' where id=".$id);
			if (mysql_errno()==0) $act='update';
			break;
		case 'add':		//'Create new'
			@mysql_unbuffered_query("Insert into rss_news (sight,link,timeout,active,title) values ('".$_POST['sight']."','".$_POST['link']."','".($_POST['timeout']*$_POST['minute'])."','".$_POST['active']."','".$_POST['title']."')");
			if (mysql_errno()==0) $act='reload';
			break;
		case 'del':		// 'Delete exist'
			@mysql_unbuffered_query("delete from rss_news where id=".$id);
			if (mysql_errno()==0) $act='reload';
			break;
	}
// end of save values to database or delete
	switch ($act) {
		case 'reload':
			echo("window.parent.location.reload();");
			break;
		case 'update':
      $res=mysql_query("select *,DATE_FORMAT(last,'%d.%m.%Y %H:%i:%s') from rss_news where id=".$_POST['uid']);
      $row=mysql_fetch_row($res);
      $data=$row[1].'{'.$row[2].'{'.$row[8].'{'.$row[4].'{'.$row[5].'{'.$row[6].'{'.$row[7];
			echo("window.parent.updaterow('".$row[0]."','".$data."');");
			break;
		case 'error':
			echo("alert('Помилка. Зміни не внесено!');");
			break;
	}
} 
echo("</script>");
?>

