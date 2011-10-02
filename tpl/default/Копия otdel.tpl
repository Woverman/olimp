<?
function phone($num){
	if (strlen($num)==10){
		$num1 = '('.substr($num,0,3).') '.substr($num,3,3).'-'.substr($num,6);
		$num = $num1;
	}
	return $num;
}
?>
<div id="center_panel">
    <div id="object_wrapper">
        <div id="object_inner">
		<div id="news_title" class="ui-corner-all">Співробітники відділення:</div>
		<table border=0 width=100% id="otdel_tlb">
		<?php
		  $sql="Select * from d_users where otdel=".$id;
		  $res=mysql_query($sql);
		  while ($row=mysql_fetch_array($res)){
		    ?>
		<tr>
		<td width=100><img src="/image.php?objid=-<?=$row['id']?>&mode=1&num=1" width=250 height=170></td>
		<td align="left" style="padding:20px" valign=top>
		<!-- people data -->
		  <h4><?=$row['name']?></h4><br>
		  <ul>
		    <?php
		    if (!empty($row['posada'])) echo "<li><i>Посада:</i><b> ".$row['posada']."</b>";
		    if (!empty($row['phone1'])) echo "<li><i>Тел.:</i> ".phone($row['phone1']);
		    if (!empty($row['phone2'])) echo ", ".phone($row['phone2']);
		    if (!empty($row['phone3'])) echo ", ".phone($row['phone3']);
		    if (!empty($row['phone4'])) echo ", ".phone($row['phone4']);
		    if (!empty($row['email'])) echo "<li><i>E-mail:</i> <b>".$row['email'].'</b>';
		    if (!empty($row['comment'])) echo "<li>".$row['comment'];
		    ?>
		  </ul>
		</td>
		</tr>
		<? } ?>
		</table>
        </div>
	</div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>