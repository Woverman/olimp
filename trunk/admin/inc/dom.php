<?
	if (!isset($obl)) $obl=0;
	if (!isset($rgn)) $rgn=0;
	if (!isset($mista)) $mista=0;
	if (!isset($agent)) $agent=0;
	if (!isset($nomer)) $nomer='';

	if (!empty($_GET["result"]))
	{
		?>
		<div style="border:1px solid green; height:1em; margin:4px; padding:14px; font-weight:bold;" align="center">Дані успішно збережені</div>
		<?
	}
?>
<div style="border:1px dotted green;height:20px;margin:4px;padding:4px" id='sdiv'><div onclick="ShowHideDiv('findforms');" style="cursor:pointer;float:left" width=50%><button>Відбір &#8595;</button></div><div style="float:right;"><button onclick="window.location='house_edit.php?panel=kvaadd';">Додати</button></div></div>
<?php
require('./inc/findforms.php');
$usl='where type=\'dom\' ';
if ($mista != '0') $usl.=('and adr_gor='.$mista);
elseif ($rgn != '0') $usl.=('and adr_rgn='.$rgn);
elseif ($obl != '0') $usl.=('and adr_obl='.$obl);
if ($agent != '0') $usl.=('and kont='.$agent);
if ($nomer != '') $usl.=('and num='.$nomer);
$sql="Select count(id) from m_bildings $usl";
//echo $sql;
$res=mysql_query($sql);
if (mysql_errno()>0) echo $sql;
$rowcount=mysql_result($res,0);
if ($rowcount>0) {
if (!isset($page)) $page=1;
$perpage=10;
$pagecount=ceil($rowcount/$perpage);
if ($page>$pagecount) $page=1;
if ($pagecount>1) MakePageLinks($page,$pagecount,$rowcount);
?>
<table width=98%  class="mytab">
<tr bgcolor=#BDCACC><th rowspan=2>№</th><th>Місто</th><th>Кімнат</th><th>Поверхів</th><th>Ціна</th><th>Правка</th></tr>
<tr bgcolor=#BDCACC><th>Вулиця</th><th>Стан</th><th>Оголош.</th><th>Агент</th><th>Знищити</th></tr>
<?php
	$a=1;
  if ($page!='all')
	  $sql="Select * from m_bildings $usl order by id limit ".(($page-1)*$perpage).','.$perpage.";";
  else
    $sql="Select * from m_bildings $usl order by id;";
	$res=mysql_query($sql);
	while ($row=mysql_fetch_array($res)){
		echo '<tr class="row'.($a=abs($a-1)).'">';
		echo '<td rowspan=2>'.$row['num'].'</td>';
		echo '<td>'.findadr($row['adr_gor'],'d_mista').'</td>';
		echo '<td>'.$row['kk'].'</td>';
		echo '<td>'.$row['pov'].'/'.$row['povv'].'</td>';
    if ($row['cast']>0)	echo '<td>'.$row['cast'].' '.$sys['lists']['valutes'][$row['valuta']].'</td>';
    else echo '<td> - </td>';
    $params = '&nomer='.$nomer.'&agent='.$agent.'&obl='.$obl.'&rgn='.$rgn.'&mista='.$mista;
		echo '<td><a href="house_edit.php?id='.$row['id'].$params.'"><img class=aimg src="./i/edit.gif" style="cursor:pointer;border:0"></td>';
		echo '</tr><tr class="row'.$a.'">';
    echo '<td>'.$row['adr_vul'].'</td>';
		echo '<td>'.$row['pzag'].'/'.$row['pzit'].'/'.$row['pkuh'].'</td>';
		echo '<td>'.($row['prodazh']==1 ? 'продаж':'оренда').'</td>';
		echo '<td>'.GetFieldByID('d_users','name',$row['kont'],'-').'</td>';
		echo '<td><a href="obj_del.php?id='.$row['id'].'" onclick="return confirm(\'Знищити будинок?\')"><img class=aimg src="./i/del.gif"></a></td>';
		echo '</tr><tr><td colspan="6" style="background-color: #660066; height:2px; border:1px solid #660066"></td></tr>';
	}
?>
</table>
<? } else { ?>
<p>Жоден запис не відповідає умові пошуку.<br><?=$sql?></p>
<? } ?>