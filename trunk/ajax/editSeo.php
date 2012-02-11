<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include ('../classes.php'); // classes, config and functions
require_once('../inc/functions.php');
$res = "edit";
$resmsg = "";
if (isset($_POST['mode'])) {
	$id=$_POST['pid'];
	switch ($_POST['mode']) {
  	case 'add': 		//'Create new'
		$id = $DB->insert("INSERT INTO `m_seo` (`page`) VALUES ('newpage');");
		$res = 'add';
	case 'edit':			//'Save exist'
		mysql_unbuffered_query("Update m_seo set page='".$_POST['page']."' where id=".$id);
		mysql_unbuffered_query("Update m_seo set pageid='".$_POST['pageid']."' where id=".$id);
		mysql_unbuffered_query("Update m_seo set title='".$_POST['pagetitle']."' where id=".$id);
	    mysql_unbuffered_query("Update m_seo set keywords='".$_POST['keywords']."' where id=".$id);
	    mysql_unbuffered_query("Update m_seo set description='".$_POST['description']."' where id=".$id);
		$resmsg = $id;
    	break;
	case 'del': 		// delete exist user
        $sql="Delete from m_seo where id=".$id;
	    mysql_unbuffered_query($sql);
        $res = "del";
		$resmsg = $id;
	    break;
	}
  echo($res.':'.$resmsg);
}
?>