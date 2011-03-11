<?
global $config;
require_once(DOCUMENT_ROOT.'/inc/functions.php');
include (DOCUMENT_ROOT.'/inc/config.php');
include (DOCUMENT_ROOT.'/inc/pre.php');
?>
<? if ($_REQUEST['ajax']!=1) {?>
<head>
<script type='text/javascript' src='/js/ajax.js'></script>
<script type='text/javascript' src='/js/main.js'></script>
<script type="text/javascript" src="editor/redactor.js"></script>
<link href="css/admin.css" type="text/css" rel="stylesheet">
<link href="editor/css/redactor.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
  $(document).ready(function(){
    $('#redactor_content_master').redactor({ focus: true });
    $('#redactor_content_slave').redactor();
  });
</script>
</head>

<body onload="createIFrame()">
<table align=center CELLPADDING=0 CELLSPACING=2px width='100%'>
<tr><td id=lpan valign=top width='150px' style="border:1px solid gray">

		<div class=spacer></div>
		<?
		if (!isset($panel)) $panel='main';
		if ($panel=='main') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=main">Головна</a>
		  <div class=spacer></div>
		<? if ($panel=='kva') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=kva">Квартири</a>
		<? if ($panel=='kvaadd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="apartment_edit.php">Додати квартиру</a>
		<? if ($panel=='dom') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=dom">Будинки</a>
		<? if ($panel=='domadd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="house_edit.php">Додати будинок</a>
		<? if ($panel=='dil') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=dil">Ділянки</a>
		<? if ($panel=='diladd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="area_edit.php">Додати ділянку</a>
		<? if ($panel=='kner') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=kner">Комерційні об'єкти</a>
		<? if ($panel=='kneradd') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="commerc_edit.php">Додати комерц. об'єкт</a>
        <div class=spacer></div>
    <? if ($panel=='boguna_main') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=boguna_main">Богуна / Головна</a>
		<? if ($panel=='boguna_list') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=boguna_list">Богуна / Список</a>
		<? if ($panel=='photos' && $folder=='stages') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=photos&folder=stages">Богуна / Етапи</a>
    <? if ($panel=='photos' && $folder=='old') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=photos&folder=old">Богуна / Готові</a>
		  <div class=spacer></div>
    <? if ($panel=='news') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=news">Новини сайту</a>
    <? if ($panel=='rss') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=rss">Імпорт новин</a>
    <div class=spacer></div>
		<?if (IsAdmin()):?>
		<? if ($panel=='user') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=user">Користувачі/Ріелтори</a>
		<?endif?>
    <? if ($panel=='mail') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=mail"><? echo(findmsg())?>Заявки</a>
    <? if ($panel=='photos' && $folder=='awards') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=photos&folder=awards">Дипломи</a>
    <? if ($panel=='about') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=about">Про нас</a>
    <? if ($panel=='photos' && $folder=='site') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=photos&folder=site">Зображення</a>
		  <div class=spacer></div>
		<? if ($panel=='obl') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=obl">Області</a>
		<? if ($panel=='rgn') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=rgn">Райони</a>
		<? if ($panel=='gor') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=gor">Міста</a>
		<? if ($panel=='vul') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=vul">Вулиці</a>
		<div class=spacer></div>
		<? if ($panel=='exl') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=exl"><? echo(findexl())?>Ексклюзив</a>
        <div class=spacer></div>
    <? if ($panel=='stat') $cls='sels'; else $cls='aa'; ?>
		<a class=<?=$cls?> href="?panel=stat">Статистика</a>
</td><td id=rpan valign=top style="border:1px solid gray" width='600'>
<div id='content' style="padding:0; margin:6px;position:relative;height:100%;min-height:100%;display: block;">
<? } ?>
<?php
if (!isset($panel)) $panel='main';
$fname=$config['SIGHT_ROOT'].'admin/inc/'.addslashes($panel).'.php';
if (!file_exists($fname)) $fname='./inc/main.php';
include ($fname)
?>
</div>
</td></tr>
</table>
</body></html>