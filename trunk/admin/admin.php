<br />
<table align=center CELLPADDING=0 CELLSPACING=2px width='100%'>
<tr><td id=lpan valign=top width='200'>

<?
	function menuitem($title,$href,$newblock,$tooltip,$extradata,$panel){
		if ($newblock)
			echo("<div class=spacer></div>\n");
	    $cls=($panel==$href?'sels':'aa');
		echo ("<a class='$cls' href='/admin/$href' title=\"$tooltip\">$extradata $title</a>\n");
	}

	$panel = addslashes($_GET['panel']);
	if (!isset($panel)) $panel='main';

	$sql = "select * from s_adminpages where visible_menu=1 order by orderid_menu";
	$res = $DB->request($sql,ARRAY_A);
	foreach ($res as $item){
		if ($user->Permitted($item['id'])) {
			$extradata = '';
			if ($item['href']=='exl') $extradata = findexl();
			if ($item['href']=='mail') $extradata = findmsg();
			menuitem($item['title_menu'],$item['href'],$item['newblock'],$item['comment_menu'],$extradata,$panel);
		}
	}
?>
<div class=spacer></div>
</td><td id=rpan valign=top>
<div id='content' style="padding:0; margin:6px;position:relative;height:100%;min-height:100%;display: block;">
<?php
if (!isset($panel)) $panel='main';
if (!$user->Permitted($panel)) $panel='main';
$fname=DOCUMENT_ROOT.'/admin/inc/'.$panel.'.php';
if (!file_exists($fname)) $fname=DOCUMENT_ROOT.'/admin/inc/main.php';
include ($fname)
?>
</div>
</td></tr>
</table>