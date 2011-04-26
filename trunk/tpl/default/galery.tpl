<div id="center_panel">
        <div id="object_wrapper">
        <div id="only_wrapper">
<?
  $sql = "select images1 from m_projects where id=".$id;
  $dir = mysql_result(mysql_query($sql),0,0);
  $sql = "Select * from img_info where file like '%".$dir."%' order by orderid";
  $res = mysql_query($sql);
  $dir_min='/i/stages-p/';
  $dir_max='/i/stages/';
  ?>
  <div style="padding:2px;text-align:center"><b>Етапи будівництва</b></div>
  <?
  while ($row=mysql_fetch_assoc($res)){
    $fname = basename($row['file']);
    $comment = $row['comment'];
     echo ("<div class=crop>");
     echo ("<a href=\"".$dir_max.$fname."\" rel='lightbox-rel'><img src=\"".$dir_min.$fname."\" border=0 title=\"$comment\"><br>");
     echo ("<span>".$comment."</span></a>");
     echo ("</div>");
    }
?>
        </div>
	</div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>