<div id="center_panel">
    <div id="wrapper">
		<!--  -->
<?php
if (!isset($otdel)){
  $sql='Select * from m_pages where id = '.$id;
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  $text2=$row['text2'];

  $sql="Select otdel, count(id)>0 as 'show_employers' from d_users where otdel<50 group by otdel";
  $res=mysql_query($sql);

  while ($otdel=mysql_fetch_assoc($res))
  {
    if ($otdel['show_employers']>0)
      $text2=str_replace('{'.$otdel['otdel'].'}','<a href="?tab=2&otdel='.$otdel['otdel'].'">Співробітники...</a>',$text2);
    else
      $text2=str_replace('{'.$otdel['otdel'].'}','',$text2);
  }
?>
<div class=maintabs style="padding-top: 1px;">
<div id="news_title" class="ui-corner-all"><?=$row['title']?></div>
<?=$row['text']?>
</div>
<div class=maintabs>
<div id="news_title" class="ui-corner-all"><?=$row['title2']?></div>
<?=$text2?>
</div>

<? } ?>

		<!--  -->
    </div>
</div>
<? if ($page->hasleft){?>
<div id="left_panel">
    <div class="vidget ui-corner-all" id='find_panel'><span>Пошук</span>
		<?
	        include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/find.tpl');
      	?>
    </div>
    <div class="vidget ui-corner-all">
        <A href="http://www.dilovamova.com/"><IMG width=150 height=250 border=0 alt="Календар свят і подій. Листівки, вітання та побажання" title="Календар свят і подій. Листівки, вітання та побажання" src="http://www.dilovamova.com/images/wpi.cache/informer/informer.png"></A>
    </div>
</div>
<? }
if ($page->hasright){?>
<div id="right_panel">
    <div class="vidget ui-corner-all"><img src="/ban/novo5.gif" width="228" height="300" alt="" /></div>
    <div class="vidget ui-corner-all"><span>Курси валют</span>
        <a href="http://www.ukrbanks.info/" target="_blank" alt="Банки України - новини банків, курси валют, рейтинг банків України!"><img src="http://www.ukrbanks.info/informer/nbu/ua-nbu.big.gif" width="240" height="210" border="0" alt="Курси НБУ на сьогодні"></a>
    </div>
    <div class="vidget ui-corner-all"><span>Погода</span>
        <script language='JavaScript' type='text/javascript' src='http://informer.gismeteo.ru/html/js/showtlist_new.js'></script>
        <script language='JavaScript' type='text/javascript' src='http://informer.gismeteo.ru/html/js/ldata_new.js'></script>
        <div id='informer1'></div>
        <div id='infscript' style='visibility:hidden'></div>
        <script language='JavaScript' type='text/javascript' src='http://informer.gismeteo.ru/html/2.php?tnumber=1&city0=4962%D0%92%D0%B8%D0%BD%D0%BD%D0%B8%D1%86%D0%B0&codepg=utf-8&par=4&inflang=rus&domain=ru&vieinf=1&p=1&w=1&tblstl=gmtbl&tdttlstl=gmtdttl&tdtext=gmtdtext&new_scheme=1'></script>
    </div>
</div>
<? } ?>
<div id="menu_panel_double"></div>
