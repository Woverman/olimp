<?
$obl= (isset($_REQUEST['obl']))? $_REQUEST['obl']:0;
$rgn= (isset($_REQUEST['rgn']))? $_REQUEST['rgn']:0;
$mista= (isset($_REQUEST['mista']))? $_REQUEST['mista']:0;
$agent= (isset($_REQUEST['agent']))? $_REQUEST['agent']:0;
$nomer= (isset($_GET['nomer']))? $_GET['nomer']:0;

if (!empty($_GET["result"])){
	?>
	<div style="border:1px solid green; height:1em; margin:4px; padding:14px; font-weight:bold;" align="center">Дані успішно збережені</div>
	<?
}
require('./inc/findforms.php');
$usl='where type=\'kva\' ';
if ($mista != '0') $usl.=(' and adr_gor='.$mista);
elseif ($rgn != '0') $usl.=(' and adr_rgn='.$rgn);
elseif ($obl != '0') $usl.=(' and adr_obl='.$obl);
if ($agent != '0') $usl.=(' and kont='.$agent);
if ($nomer != '') $usl.=(' and num='.$nomer);
$sql="Select count(id) from m_bildings $usl";
debug($sql);
$res=mysql_query($sql);
if (mysql_errno()==0) $rowcount=mysql_result($res,0);
if ($rowcount>0) {
?>
<table width=98%  class="mytab">
<tr style="background-color: #BDCACC"><th rowspan=2>№</th><th>Місто</th><th>Кімнат</th><th>Поверх/Поверхів</th><th>Ціна</th><th rowspan=2>Правка/Знищити</th></tr>
<tr style="background-color: #BDCACC"><th>Вулиця</th><th>Площі</th><th>Огол.</th><th>Агент</th></tr>
<?php
	$a=1;
  	$sql="Select * from m_bildings $usl order by id;";
	$res=mysql_query($sql);
	while ($row=mysql_fetch_array($res)){
		echo '<tr class="row'.($a=abs($a-1)).'">';
		echo '<td rowspan=2>'.$row['num'].'</td>';
		echo '<td>'.findadr($row['adr_gor'],'d_mista').'</td>';
		echo '<td>'.$sys['lists']['kkimn'][$row['kk']].'</td>';
		echo '<td>'.$row['pov'].'/'.$row['povv'].'</td>';
    if ($row['cast']>0)	echo '<td>'.$row['cast'].' '.$sys['lists']['valutes'][$row['valuta']].'</td>';
    else echo '<td> - </td>';
    $params = '&nomer='.$nomer.'&agent='.$agent.'&obl='.$obl.'&rgn='.$rgn.'&mista='.$mista;
		echo '<td rowspan=2><a href="/admin/kvaadd/?oid='.$row['id'].$params.'">';
		echo '<img class=aimg src="/i/edit.png" style="cursor:pointer;border:0">';
		echo '<a href="obj_del.php?id='.$row['id'].'" onclick="return confirm(\'Знищити квартиру?\')">';
		echo '<img class=aimg src="/i/delete.png"></a></td>';
		echo '</tr><tr class="row'.$a.'">';
    echo '<td>'.$row['adr_vul'].'</td>';
		echo '<td>'.$row['pzag'].'/'.$row['pzit'].'/'.$row['pkuh'].'</td>';
		echo '<td>'.($row['prodazh']==1 ? 'продаж':'оренда').'</td>';
		echo '<td>'.GetFieldByID('d_users','name',$row['kont'],'-').'</td>';
		echo '</tr><tr><td colspan="6" style="background-color: #660066; height:1px; border:1px solid #660066"></td></tr>';
	}
?>
</table>
<? } else { ?>
<p>Жоден запис не відповідає умові пошуку.<br></p>
<? } ?>