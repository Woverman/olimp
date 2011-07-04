<div id="center_panel">
    <div id="object_wrapper">
    <div class=object_inner>
<?
  $sql = "select images1 from m_projects where main_page=".$id;
  $dir = mysql_result(mysql_query($sql),0,0);
  $sql = "select title from m_pages where id=".$id;
  $title = mysql_result(mysql_query($sql),0,0);
  $sql = "Select * from img_info where file like '%".$dir."%' order by orderid";
  $res = mysql_query($sql);
  $dir_min='/i/stages-p/';
  $dir_max='/i/stages/';
  ?>
  <div id="news_title" class="ui-corner-all"><?=$title?></div>
  <?
  $pn = "<div class='vidget ui-corner-all'>"." | "
      ."<a href='/article/".$id."/'> Головна </a>"." | "
      ."<a href='/catalog/1/?proj=".$id."'> Список квартир </a>"." | "
      ."Етапи будівництва"." | "
      ."</div>";
  echo($pn);
  while ($row=mysql_fetch_assoc($res)){
    $fname = basename($row['file']);
    $comment = $row['comment'];
     echo ("<div class=crop>");
     echo ("<a href=\"".$dir_max.$fname."\" rel='lightbox-rel'><img src=\"".$dir_min.$fname."\" border=0 title=\"$comment\">");
     echo ("<span>".$comment."</span></a>");
     echo ("</div>");
    }
?>
        </div>
	</div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>