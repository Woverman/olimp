<div id="center_panel">
        <div id="object_wrapper">
		<!--  -->
<?php

//if (!isset($otdel)){
  //if(strstr($text,"{project navigation}"))
    //$sql='Select a.*,p.isShowOLD from m_pages a,m_projects p where a.id=p.main_page and a.id='.$id;
  //else
  $sql='Select * from m_pages where id='.$id;
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  $title = $row['title'];
  $text=$row['text'];
  if(strstr($text,"{project navigation}")){
  	$sql = "Select isShowOLD from m_projects where main_page=".$id;
	$isShowOLD = mysql_result(mysql_query($sql),0,0);
  }
  // Templates replacing
    // {otdel0}, {otdel1}, {otdel2}, {otdel3}
  if(strstr($text,"{otdel")){
      $sql="Select otdel, count(id)>0 as 'show_employers' from d_users where otdel<50 group by otdel";
      $res=mysql_query($sql);
      while ($otdel=mysql_fetch_assoc($res))
      {
        if ($otdel['show_employers']>0)
          $text=str_replace('{otdel'.$otdel['otdel'].'}','<a href="/otdel/'.$otdel['otdel'].'">Співробітники...</a>',$text);
        else
          $text=str_replace('{otdel'.$otdel['otdel'].'}','',$text);
      }
  }
    // {project navigation}
  if(strstr($text,"{project navigation}")){
      $pn = "<div class='vidget ui-corner-all'>"." | "
      ."Головна"." | "
      ."<a href='/catalog/1/?proj=".$row['id']."'> Список квартир </a>"." | "
      ."<a href='/galery/".$row['id']."/'> Етапи будівництва </a>"." | ";
	  if ($isShowOLD=="1")
      	$pn .= "<a href='/galery/".$row['id']."/?type=old'> Завершені об'єкти </a>"." | ";
      $pn .= "</div>";
	  $text=str_replace('{project navigation}',$pn,$text);
  }

?>
<div class=object_inner style="padding-top: 1px;">
<div id="news_title" class="ui-corner-all"><?=$title?></div>

<?=stripslashes($text)?>
</div>

<?// } ?>

		<!--  -->
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>