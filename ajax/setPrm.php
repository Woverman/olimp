<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include ('../classes.php'); // classes, config and functions

function getGroups(){
	global $DB;
	$sql = "SELECT id FROM s_usergroups";
	$res = $DB->request($sql,ARRAY_N);
	return $res;
}
function getPages(){
	global $DB;
	$sql = "SELECT id FROM s_adminpages";
	$res = $DB->request($sql,ARRAY_N);
	return $res;
}

if ($_GET['gid']==0)
	$gids = getGroups();
else
	$gids[0][0] = $_GET['gid'];

if ($_GET['pid']==0)
	$pids = getPages();
else
	$pids[0][0] = $_GET['pid'];

$val = $_GET['value'];
foreach ($pids as $pid){
	foreach ($gids as $gid){
		$DB->insert('delete from s_permissions where pageid='.$pid[0].' and usergroupid='.$gid[0]);
		$DB->insert('insert into s_permissions (pageid,usergroupid,permitted) values ('.$pid[0].','.$gid[0].','.$val.')');
	}
}
?>