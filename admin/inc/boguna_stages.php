<?php

$dirname = $_REQUEST['folder'];

$MAXDIR = "i/".$dirname."/";
$MINDIR = "i/".$dirname."-p/";

function showDir($dir){
    $sql = "SELECT file,orderid,comment FROM img_info WHERE file LIKE '%".$dir."%' ORDER BY orderid";
    $res = mysql_query($sql);
    while ($row=mysql_fetch_assoc($res)) {
      $listFile[] = array(basename($row['file']),$row['file'],$row['orderid'],$row['comment']);
    }
    if (!empty($listFile)) return $listFile;
}

if (isset($_REQUEST['ajax']))
{
  switch($_REQUEST['action'])
  {
    case 'imageleft':
      $sql = "SELECT orderid FROM img_info WHERE file = '".$_REQUEST['file']."'";
      $id = mysql_result(mysql_query($sql),0,0);
      $sql = "UPDATE img_info SET orderid = ".($id)." WHERE orderid=".($id-1)." and file like '%".$MINDIR."%'";
      mysql_unbuffered_query($sql);
      $sql = "UPDATE img_info SET orderid = ".($id-1)." WHERE file = '".$_REQUEST['file']."'";
      mysql_unbuffered_query($sql);
      break;
    case 'imageright':
      $sql = "SELECT orderid FROM img_info WHERE file = '".$_REQUEST['file']."'";
      $id = mysql_result(mysql_query($sql),0,0);
      $sql = "UPDATE img_info SET orderid = ".($id)." WHERE orderid=".($id+1)." and file like '%".$MINDIR."%'";
      mysql_unbuffered_query($sql);
      $sql = "UPDATE img_info SET orderid = ".($id+1)." WHERE file = '".$_REQUEST['file']."'";
      mysql_unbuffered_query($sql);
      break;
    case 'imagedel':
      $f = basename($_REQUEST['file']);
      $fname=$config['SIGHT_ROOT'].$MAXDIR.$f;
      @unlink ($fname);
      $fname=$config['SIGHT_ROOT'].$MINDIR.$f;
      @unlink ($fname);
      $sql = "DELETE FROM `img_info` WHERE `file` = '".$fname."'";
      mysql_unbuffered_query($sql);
      $sql = "UPDATE `img_info` SET orderid = @i:=@i+1 WHERE file like '%".$MINDIR."%' ORDER BY orderid;";
      mysql_unbuffered_query($sql);
      break;
    case 'edittitle':
      $text = urldecode($_REQUEST['text']);
      $f = basename($_REQUEST['file']);
      $fname=$config['SIGHT_ROOT'].$MINDIR.$f;
      $sql = "UPDATE `img_info` SET comment = '".$text."' WHERE `file` = '".$fname."'";
      break;
  }
  exit;
}
// обработка событий

if (isset($_POST['mode'])){
  $tmpfile=$_FILES['foto']['tmp_name'];
  $imgname=$_FILES['foto']['name'];
  $newname=$config['SIGHT_ROOT'].$MAXDIR.$imgname;
  $thumbnail=$config['SIGHT_ROOT'].$MINDIR.$imgname;
  // Get image dimensions
  $img1=ResizeImage($tmpfile,800,560,$imgname);
  $img2=ResizeImage($tmpfile,236,182,$imgname);

  // Write to folders
  if ($handle = fopen($newname, 'w')) { fwrite($handle, $img1); }
  if ($handle = fopen($thumbnail, 'w')) { fwrite($handle, $img2); }
  // write comment to DB
  $comment = $_POST['info'];
  $id = mysql_result(mysql_query("SELECT max(orderid)+1 FROM img_info WHERE file like '%".$MINDIR."%'"),0,0);
  mysql_unbuffered_query("DELETE FROM `img_info` WHERE `file` = '".$thumbnail."'");
  $sql ="INSERT INTO `img_info` (`file`,`comment`,`orderid`) values ('".$thumbnail."','".$comment."','".$id."')";
  mysql_unbuffered_query($sql);
  $sql = "UPDATE `img_info` SET orderid = @i:=@i+1 WHERE file like '%".$MINDIR."%' ORDER BY orderid;";
  mysql_unbuffered_query($sql);
}
?>
<div style="display:block;margin-bottom:10px;width:100%;float:top;border:1px solid white;">
<?
$dir=$config['SIGHT_ROOT'].$MINDIR;
$files=showDir($dir);
if (is_array($files)){
foreach ($files as $file){
  list($width, $height, $type, $attr) = getimagesize($config['SIGHT_ROOT'].$MAXDIR.$file['0']);
  if ($width>$height) {
    $w=120;
    $h=86;
    }
  else {
    $w=86;
    $h=120;
  }
  ?>
<div class="fotoframe" style="display:block;border:1px solid #000;margin:2px;float:left;text-align:center; width:140px;height:180px;padding: 2px">
  <input type="hidden" name="file_to_del" value="<?=$file[1]?>">
  <img class="award_smoll" width="<?=$w?>" height="<?=$h?>" title="<?=$file[3]?>" src="/<?=$MINDIR?>/<?=$file[0]?>" style="margin-bottom:<?=120-$h?>px">
  <br />
  <div style="border:1px solid #FF00FF;margin-bottom: 2px;font-size: x-small;overflow:hidden;" title="<?=$file[0]?>"><?=$file[0]?></div>
  <button class="bleft" title="Вліво"><img src="/i/left.png" border="0"></button
  ><button class="bdelete" title="Знищити"><img src="/i/delete.png" border="0"></button
  ><button class="bedit"  title="Редагувати підпис"><img src="/i/edit.png" border="0"></button
  ><button class="bcopy"  title="Копіювати адресу"><img src="/i/copy.png" border="0"></button
  ><button class="bright" title="Вправо"><img src="/i/right.png" border="0"></button>
</div>
<?php } } ?>
</div>
<br />
<div  style="display:block;padding:10px;">
<Form method=post enctype='multipart/form-data'>
<table align="center"><tr><th colspan="2" align="left">
Добавити зображення.
<input type='hidden' value='add' name='mode' id='mode'>
</th></tr>
<tr><td>Виберіть фото</td><td>
<input type='file' name='foto' id='foto' class="txt" text="Обзор" size=60 >
</td></tr>
<tr><td>Коментар</td><td>
<textarea name="info" rows="3" cols="50"></textarea>
</td></tr>
<tr><th colspan="2" align="right">
<input type='submit' value='Загрузити'>
</th></tr></table>
</form>
</div>

<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/
jQuery(".fotoframe .bleft:first").attr("disabled","disabled");
jQuery(".fotoframe .bright:last").attr("disabled","disabled");
jQuery(".fotoframe .bleft").click(function(){
  mydiv = jQuery(this).parents("div").get(0);
  file = jQuery(mydiv).find("[type='hidden']").val();
  jQuery(mydiv).prev().before(mydiv);
  jQuery(".fotoframe button").removeAttr("disabled");
  jQuery(".fotoframe .bright:last").attr("disabled","disabled");
  jQuery(".fotoframe .bleft:first").attr("disabled","disabled");
  jQuery.get(location,{ajax:1,file:file,action:'imageleft'});
  });

jQuery(".fotoframe .bright").click(function(){
  mydiv = jQuery(this).parents("div").get(0);
  file = jQuery(mydiv).find("[type='hidden']").val();
  jQuery(mydiv).next().after(mydiv);
  jQuery(".fotoframe button").removeAttr("disabled");
  jQuery(".fotoframe .bright:last").attr("disabled","disabled");
  jQuery(".fotoframe .bleft:first").attr("disabled","disabled");
  jQuery.get(location,{ajax:1,file:file,action:'imageright'});
  });

jQuery(".fotoframe .bdelete").click(function(){
  mydiv = jQuery(this).parents("div").get(0);
  file = jQuery(mydiv).find("[type='hidden']").val();
  jQuery.get(location,{ajax:1,file:file,action:'imagedel'});
  jQuery(mydiv).remove();
  });

jQuery(".fotoframe .bcopy").click(function(){
    file = jQuery(this).siblings("[type='hidden']").val();
    if (window.clipboardData){ // IE
        window.clipboardData.setData("Text", file);
    } else {
        window.prompt("Виділіть текст і нажміть Ctrl-C",file);
    }
  });

jQuery(".fotoframe .bedit").click(function(){
  file = jQuery(this).siblings("[type='hidden']").val();
  text = jQuery(this).siblings("img").attr("title");
  text1 = window.prompt("Підпис до картинки:",text);
  if (text1!=''){
    jQuery(this).siblings("img").attr("title",text1);
    jQuery.get(location,{ajax:1,file:file,action:'edittitle',text:encodeURIComponent(text1)});
  }
  });
jQuery(".fotoframe button").css({
  width:'24px',
  padding: '1px',
  margin: '0'
})
/*]]>*/
</script>