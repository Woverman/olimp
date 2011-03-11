<?php
global $config;
require_once('../inc/functions.php');
include ('../inc/config.php');
include ('../inc/pre.php');
?>
<head>
<? if (isset($_GET['editid'])) {
    include($config['SIGHT_ROOT'].'/inc/makexml.php');
    echo "\n<script type='text/javascript' src='/js/fillform.js'/>";
    }
    ?>

<meta http-equiv="Content-Language" content="ru">
<META HTTP-EQUIV="Content-Type" content="text/html; charset=Windows-1251">
<LINK REL="SHORTCUT ICON" href="/favicon.ico">
<script type='text/javascript' src='/js/ajax.js'></script>
<script type='text/javascript' src='/js/main.js'></script>
<style type='text/css'>
  body {font-size: 12px}
  a {text-decoration: none; outline: none}
  //a:hover {text-decoration: underline}
  form {margin:0}
  a.aa, a.sels{
	display:block;
	padding: 4px;
	margin: 1px;
	border: 1px solid black;
	background-color: silver;
	text-align:right;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #003366;
  outline: none
  }
  td a {color:blue}
  .mytab td a:hover {text-decoration: underline;}
  .spacer,.spacer:hover {
	height: 4px;
	background-color: #CCCCFF;
	border: 1px solid black;
	margin:1px;
	font-size: 2px;
  }

  a.sels,a.sels:hover,a.aa:hover {
	background-color: #B163AA;
	color:white;
	font-weight: bold;
  }
  h4 {margin:0;}
  select {width:150px;}
  .mytab {empty-cells: show; font-size: 14px;}
  .pagesdiv {text-align:right;padding:2px;}
  span.selpage, a.pages {display:block-inline; border:1px solid #EAEAEA; padding:1px 4px; margin:0px ;background-color: #D3D3D3}
  span.selpage {color:white;}
  .mytab td {text-align: center;padding:0px;}
  tr.row1 {background-color: #CCF5FD;}
  tr.row0 {background-color: #F7EACA;}
  div.forbtn {text-align:right;position:absolute;bottom:10px;right:10px;margin-top: expression((parentNode.offsetHeight - this.offsetHeight))}
  div.forbtn button {border-style:outset}
  img.aimg, img.bimg {
    border: 0;
    width: 16px;
    height: 16px;
    padding: 2px;
    vertical-align:middle;
  }
  a:hover img.aimg {
    border: 2px outset #ADADAD;
    background-color: #DFDFDF;
    padding: 0;
  }
  a:active img.aimg {
    border: 2px intset #ADADAD;
    padding: 0;
  }
</style>
</head>
<body>
<table align=center CELLPADDING=0 CELLSPACING=2px width='800px'>
<tr><td colspan=2>
<center><img src='../i/top.jpg' lovsrc='top_slow.gif' border=0 align=center></center>
</td></tr><tr><td colspan=2 align=center>
<?php
$mode=3;
include ('../admin/login.php');
?>
</td></tr> 
<tr><td id=lpan valign=top width='200px' style="border:1px solid gray">
		<div class=spacer></div>
		<?
		if (!isset($panel)) $panel='main';
		if ($panel=='main') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=main">Головна</a>
		<div class=spacer></div>
		<? if ($panel=='kva') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=kva">Квартири</a>
		<? if ($panel=='kvaadd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=kvaadd">Добавити квартиру</a>
		<? if ($panel=='dom') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=dom">Будинки</a>
		<? if ($panel=='domadd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=domadd">Добавити будинок</a>
		<? if ($panel=='dil') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=dil">Ділянки</a>
		<? if ($panel=='diladd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=diladd">Добавити ділянку</a>
		<? if ($panel=='kner') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=kner">Комерційні об'єкти</a>
		<? if ($panel=='kneradd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=kneradd">Добавити комерц. об'єкт</a>
		<div class=spacer></div>
		<?if (IsAdmin()):?>
		<? if ($panel=='user') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=user">Користувачі</a>
		<? if ($panel=='mail') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=mail">Заявки</a>
		<?endif?>
		<? if ($panel=='news') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=news">Новини сайту</a>
		<div class=spacer></div>
		<? if ($panel=='obl') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=obl">Області</a>
		<? if ($panel=='rgn') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=rgn">Райони</a>
		<? if ($panel=='gor') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=gor">Міста</a>
		<div class=spacer></div>
	</ul>
</td><td id=rpan valign=top style="border:1px solid gray" width='600'>
<div id='content' style="padding:0; margin:6px;position:relative;height:100%;min-height:100%;display: block;">
<?php
if (!isset($panel)) $panel='main';
$fname='./inc/'.addslashes($panel).'.php';
if (!file_exists($fname)) $fname='./inc/main.php';
include ($fname)
?>
</div>
</td></tr>
</table>
</body></html>