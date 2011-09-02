<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Админка - {$content.0.name}</TITLE>
<meta http-equiv="Content-Language" content="ru">
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK REL="SHORTCUT ICON" href="/favicon.ico">
{literal}
<script type='text/javascript' src='../js/ajax.js'></script>
<script type='text/javascript' src='../js/main.js'></script>
<script type="text/javascript">
	function show_group(current_group, all_group)
	{
		if (document.getElementById('group_'+current_group).style.visibility == "visible")
		{
			document.getElementById('group_'+current_group).style.visibility="hidden";
			document.getElementById('group_'+current_group).style.display="none";
		}
		else
		{
			for (var i=1; i<=all_group; i++)
			{
				if (i != current_group)
				{
					document.getElementById('group_'+i).style.visibility="hidden";
					document.getElementById('group_'+i).style.display="none";
				}
			}

			document.getElementById('group_'+current_group).style.visibility="visible";
			document.getElementById('group_'+current_group).style.display="";
		}
	}
</script>
{/literal}
<link href='css/admin.css' type='text/css' rel='stylesheet'>
</HEAD>
<BODY  onload="createIFrame('ifrm')">
<table align=center CELLPADDING=0 CELLSPACING=2px width='800px'>
<tr><td colspan=2>
<center><img src='../i/top.jpg' lovsrc='top_slow.gif' border=0 align=center></center>
</td></tr><tr><td colspan=2 align=center>
{*
<?php include ('../admin/login.php'); ?>
*}

</td></tr>
<tr><td id=lpan valign=top width='200px' style="border:1px solid gray">

		<div class=spacer></div>
		<a class="aa" href="admin.php?panel=main">Головна</a>
		<div class=spacer></div>
		<a class="aa" href="admin.php?panel=kva">Квартири</a>
		<a class="{if $page_name=="apartment_edit"}sels{else}aa{/if}"  href="apartment_edit.php">Додати квартиру</a>
		<a class="aa" href="admin.php?panel=dom">Будинки</a>
		<a class="{if $page_name=="house_edit"}sels{else}aa{/if}" href="house_edit.php">Додати будинок</a>
		<a class="aa" href="admin.php?panel=dil">Ділянки</a>
		<a class="{if $page_name=="area_edit"}sels{else}aa{/if}" href="area_edit.php">Додати ділянку</a>
		<a class="aa" href="admin.php?panel=kner">Комерційні об'єкти</a>
		<a class="{if $page_name=="commerc_edit"}sels{else}aa{/if}" href="commerc_edit.php">Додати комерц. об'єкт</a>
		<div class=spacer></div>
		<a class="aa" href="admin.php?panel=user">Користувачі/Ріелтори</a>
		<a class="aa" href="admin.php?panel=mail">Заявки</a>
		<a class="aa" href="admin.php?panel=news">Новини сайту</a>
    <a class="aa" href="admin.php?panel=rss">Імпорт новин</a>
    <a class="aa" href="admin.php?panel=awards">Дипломи</a>
		<div class=spacer></div>
		<a class="aa" href="admin.php?panel=obl">Області</a>
		<a class="aa" href="admin.php?panel=rgn">Райони</a>
		<a class="aa" href="admin.php?panel=gor">Міста</a>
        <a class="aa" href="admin.php?panel=vul">Вулиці</a>
		<div class=spacer></div>
        <a class="aa" href="admin.php?panel=vul">Ексклюзив</a>
        <div class=spacer></div>
</td><td id=rpan valign=top style="border:1px solid gray" width='600'>
<div id='content' style="padding:0; margin:6px;position:relative;height:100%;min-height:100%;display: block;">

{include file="$page_name.tpl"}

</div>
</td></tr>
</table>

</BODY>
</HTML>