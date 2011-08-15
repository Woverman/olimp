<?php
/*************************************************************************************************

    phpAdManager 1.0
	Statistics Module
	Copyright 2003 Hamilton G Laughland
	
	Author: Hamilton G Laughland
	Website: http://www.laughland.biz
	
	This script is protected by New Zealand copyright law.
	
****************************************************************************************************/
$today = date("Y-m-d");
 list($year,$month,$day) = split('-',$today);
 
 $stamp = mktime(0, 0, 0, $month, $day, $year);
 $arDays = array();
 $max = 6;
 $gap = 24 * 60 * 60;
 for($x=0;$x<=$max;$x++){
  $temp = $gap * $x;
  $temp = $stamp - $temp;
  $day = date("Y-m-d", $temp);
  $arDays[$day] = array('wdisplays'=>0, 'wclicks'=>0);
 }
 
 $gap = 6 * 24 * 60 * 60;
 $stamp -= $gap;
 if(isset($adid)){
  $query = "select $stats.amdate, sum($stats.displays) as wdisplays, sum($stats.clicks) as wclicks from $stats where UNIX_TIMESTAMP($stats.amdate) >= $stamp and $stats.id = $adid group by $stats.amdate";
 }else{
  $query = "select $stats.amdate, sum($stats.displays) as wdisplays, sum($stats.clicks) as wclicks from $stats where UNIX_TIMESTAMP($stats.amdate) >= $stamp group by $stats.amdate";
 }
 $result = doquery($query);
 $num = mysql_num_rows($result);
  while ($row = mysql_fetch_array($result)){
  $curr = $row['amdate'];
  $display = $row['wdisplays'];
  $click = $row['wclicks'];
  $arDays[$curr]['wdisplays'] = $display;
  $arDays[$curr]['wclicks'] = $click;
 }
 $weekstats = "";
 foreach($arDays as $key => $value){
  $weekstats .= "<tr><td align='center' class='list'>$key</td><td align='right' class='list'>".$value['wdisplays']."&nbsp;</td><td align='right' class='list'>".$value['wclicks']."&nbsp;</td><td class='list'>&nbsp;</td></tr>";
 }
 
 $today = date("Y-m-d");
 list($Year,$Month,$Day) = split('-',$today);
 
 // Initialise array
 $arstats = array();
 $query = "select id from $banners";
 $result = doquery($query);
 $num = mysql_num_rows($result);
 while ($row = mysql_fetch_array($result)){
  $id = $row['id'];
  $temp = array('ddisplays' => 0, 'dclicks' => 0, 'mdisplays' => 0, 'mclicks' => 0, 'ydisplays' => 0, 'yclicks' => 0);
  $arstats[$id] = $temp; 
 }
 
 // get day totals from stats table
 if(isset($adid)){
  $query = "select id, sum(displays) as ddisplays, sum(clicks) as dclicks from $stats where id = $adid and amdate = '$today' group by id";
 }else{
  $query = "select $stats.id, sum($stats.displays) as ddisplays, sum($stats.clicks) as dclicks from $banners, $stats where $banners.id = $stats.id and $banners.id is not null and $banners.status = '1' and $stats.amdate = '$today' group by $stats.id";
 }
 $result = doquery($query);
 $num = mysql_num_rows($result);
 $tddisplays = 0;
 $tdclicks = 0;
 while ($row = mysql_fetch_array($result)){
  $id = $row['id'];
  $displays = $row['ddisplays'];
  $tddisplays = $tddisplays + $displays;
  $clicks = $row['dclicks'];
  $tdclicks = $tdclicks + $clicks;
  $temp = array('ddisplays' => $displays, 'dclicks' => $clicks);
  $temp2 = $arstats[$id];
  $arstats[$id] = array_merge($temp2, $temp);
 }
 
 // get month totals from stats table
 if(isset($adid)){
  $query = "select $stats.id, sum($stats.displays) as mdisplays, sum($stats.clicks) as mclicks from $stats where $stats.id = $adid and DATE_FORMAT(amdate, '%Y') = '$Year' and DATE_FORMAT(amdate, '%m') = '$Month' group by $stats.id";
 }else{
  $query = "select $stats.id, sum($stats.displays) as mdisplays, sum($stats.clicks) as mclicks from $banners, $stats where $banners.id = $stats.id and $banners.id is not null and $banners.status = '1' and DATE_FORMAT(amdate, '%Y') = '$Year' and DATE_FORMAT(amdate, '%m') = '$Month' group by $stats.id";
 }
 $result = doquery($query);
 $num = mysql_num_rows($result);
 $tmdisplays = 0;
 $tmclicks = 0;
 while ($row = mysql_fetch_array($result)){
  $id = $row['id'];
  $displays = $row['mdisplays'];
  $tmdisplays = $tmdisplays + $displays;
  $clicks = $row['mclicks'];
  $tmclicks = $tmclicks + $clicks;
  $temp = array('mdisplays' => $displays, 'mclicks' => $clicks);
  $temp2 = $arstats[$id];
  $arstats[$id] = array_merge($temp2, $temp);
 }
 
 // get year totals from stats table
  if(isset($adid)){
  $query = "select $stats.id, sum($stats.displays) as ydisplays, sum($stats.clicks) as yclicks from $stats where $stats.id = $adid and DATE_FORMAT(amdate, '%Y') = '$Year' group by $stats.id";
 }else{
  $query = "select $stats.id, sum($stats.displays) as ydisplays, sum($stats.clicks) as yclicks from $banners, $stats where $banners.id = $stats.id and $banners.id is not null and $banners.status = '1' and DATE_FORMAT(amdate, '%Y') = '$Year' group by $stats.id";
 }
 $result = doquery($query);
 $num = mysql_num_rows($result);
 $tydisplays = 0;
 $tyclicks = 0;
 while ($row = mysql_fetch_array($result)){
  $id = $row['id'];
  $displays = $row['ydisplays'];
  $tydisplays = $tydisplays + $displays;
  $clicks = $row['yclicks'];
  $tyclicks = $tyclicks + $clicks;
  $temp = array('ydisplays' => $displays, 'yclicks' => $clicks);
  $temp2 = $arstats[$id];
  $arstats[$id] = array_merge($temp2, $temp);
 }
 
 // Build and show the statistics table
 $tabstats = "";
 foreach($arstats as $key => $value){
  if(!isset($adid) || $adid == $key){
  	$title=$titles[$key];
   $tabstats .= "<tr><td align='right' class='list'><a href= admin.php?action=stats&adid=$key>$title</a>&nbsp;</td><td align='right' class='list'>".$value['ydisplays']."&nbsp;</td><td align='right' class='list'>".$value['mdisplays']."&nbsp;</td><td align='right' class='list'>".$value['ddisplays']."&nbsp;</td>";
   $tabstats .= "<td align='right' class='list'>".$value['yclicks']."&nbsp;</td><td align='right' class='list'>".$value['mclicks']."&nbsp;</td><td align='right' class='list'>".$value['dclicks']."&nbsp;</td></tr>";
  }
 }
 if(!isset($adid)){
  $tabstats .= "<tr><td align='center' class='list'>Всього</td><td align='right' class='list'>$tydisplays&nbsp;</td><td align='right' class='list'>$tmdisplays&nbsp;</td><td align='right' class='list'>$tddisplays&nbsp;</td>";
  $tabstats .= "<td align='right' class='list'>$tyclicks&nbsp;</td><td align='right' class='list'>$tmclicks&nbsp;</td><td align='right' class='list'>$tdclicks&nbsp;</td></tr>";
 }
 
 $txtrow = "<tr><th align='center' colspan='7' class='list'>Всього по банерах</th></tr>";
 include("templates/stats.htm");
?>