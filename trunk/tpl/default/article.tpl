<div id="center_panel">
    <div id="wrapper">
		<!--  -->
<?php
if (!isset($otdel)){
  $sql='Select * from m_pages where id = '.$id;
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  $text=$row['text'];

  $sql="Select otdel, count(id)>0 as 'show_employers' from d_users where otdel<50 group by otdel";
  $res=mysql_query($sql);

  while ($otdel=mysql_fetch_assoc($res))
  {
    if ($otdel['show_employers']>0)
      $text=str_replace('{otdel'.$otdel['otdel'].'}','<a href="/otdel/'.$otdel['otdel'].'">Співробітники...</a>',$text);
    else
      $text=str_replace('{otdel'.$otdel['otdel'].'}','',$text);
  }
?>
<div class=maintabs style="padding-top: 1px;">
<div id="news_title" class="ui-corner-all"><?=$row['title']?></div>
<?=$text?>
</div>

<? } ?>

		<!--  -->
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>