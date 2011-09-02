<?php

$dirname = $_REQUEST['folder'];
$dirname = ($dirname?$dirname:'site');
$dirid = fldID($dirname);

$MAXDIR = "i/".$dirname."/";
$MINDIR = "i/".$dirname."-p/";

function showDir($dir){
	debug($dir,"DIR");
    $sql = "SELECT file,orderid,comment FROM img_info WHERE file LIKE '%".$dir."%' ORDER BY orderid";
	debug($sql,"SQL");
    $res = mysql_query($sql);
    while ($row=mysql_fetch_assoc($res)) {
      $listFile[] = array(basename($row['file']),$row['file'],$row['orderid'],$row['comment']);
    }
	debug($listFile,"LISTFILE");
    if (!empty($listFile)) return $listFile;
}
function fldID($fldName){
	$sql = "select id from img_folders where folder='".$fldName."'";
	debug($sql,"SQL IN fldID");
	$res = mysql_query($sql);
	return(mysql_result($res,0,0));
}
// обработка событий

if (isset($_POST['mode'])){
  $tmpfile=$_FILES['foto']['tmp_name'];
  $imgname=$_FILES['foto']['name'];
  $newname=DOCUMENT_ROOT.'/'.$MAXDIR.$imgname;
  $thumbnail=DOCUMENT_ROOT.'/'.$MINDIR.$imgname;
  // Get image dimensions
  $img1=ResizeImage($tmpfile,800,560,$imgname);
  $img2=ResizeImage($tmpfile,236,182,$imgname);

  // Write to folders
  if ($handle = fopen($newname, 'w')) { fwrite($handle, $img1); } else {debug($newname,"Failed to open file for writing!"); }
  if ($handle = fopen($thumbnail, 'w')) { fwrite($handle, $img2); } else {debug($thumbnail,"Failed to open file for writing!"); }
  // write comment to DB
  $comment = $_POST['info'];
  $id = mysql_result(mysql_query("SELECT max(orderid)+1 FROM img_info WHERE file like '%".$MINDIR."%'"),0,0);
  mysql_unbuffered_query("DELETE FROM `img_info` WHERE `file` = '".$thumbnail."'");
  debug(mysql_error(),"Error 1");
  $sql ="INSERT INTO `img_info` (`file`,`folder`,`comment`,`orderid`) values ('".$thumbnail."','".$dirid."','".$comment."','".$id."')";
  debug($sql,"INSERT FILE");
  mysql_unbuffered_query($sql);
  debug(mysql_error(),"Error 2");
   mysql_unbuffered_query("SET @i=0;");
  $sql = "UPDATE `img_info` SET orderid = @i:=@i+1 WHERE folder=".$dirid." ORDER BY orderid;";
  mysql_unbuffered_query($sql);
  debug(mysql_error(),"Error 3");
}
$sql = "select * from img_folders";
$ff = $DB->request($sql,ARRAY_A);
?>
Виберіть папку:
<select onchange="location=this.value">
<? foreach($ff as $f) {
echo "<option value='/admin/photos/?folder=".$f['folder']."' ".($dirname==$f['folder']?"selected='selected'":"").">".$f['title']."</option>";
} ?>
</select>
<button name='addnew' onclick="$('#dialog1').dialog({width:'500px',title:'Добавити папку.'})">Створити нову папку</button>
<!--<button name='delete'>Видалити папку</button>-->
<button name='addfoto' onclick="$('#dialog').dialog({width:'500px',title:'Добавити зображення.'})">Загрузити нове фото</button>
<? $referer = $_SERVER['HTTP_REFERER'];
   if (strpos($referer,'/photos/')>0) $referer = $_SESSION['HTTP_REFERER'];
   $_SESSION['HTTP_REFERER'] = $referer;
 ?>
<a href="<?=$referer?>"><button>Повернутись</button></a>
<hr>
<div style="display:block;margin-bottom:10px;width:100%;float:top;border:1px solid white;">
<?
$dir=ROOT_FOLDER.$MINDIR;
$files=showDir($dir);
if (is_array($files)){
foreach ($files as $file){
	if (file_exists($config['SIGHT_ROOT'].$MAXDIR.$file['0'])){
		list($width, $height, $type, $attr) = getimagesize($config['SIGHT_ROOT'].$MAXDIR.$file['0']);
		if ($width>$height) {
		  $w=120;
		  $h=86;
		  }
		else {
		  $w=86;
		  $h=120;
		}
		$filepath = str_replace($_SERVER['DOCUMENT_ROOT'],'',$file[1]);
  ?>
<div class="fotoframe" style="display:block;border:1px solid #000;margin:2px;float:left;text-align:center; width:140px;height:180px;padding: 2px">
  <input type="hidden" name="file_to_del" value="<?=$file[1]?>">
  <input type="hidden" name="file_path" value="<?=$filepath?>">
  <img class="award_smoll" width="<?=$w?>" height="<?=$h?>" title="<?=$file[3]?>" src="/<?=$MINDIR?><?=$file[0]?>" style="margin-bottom:<?=120-$h?>px">
  <br />
  <div style="border:1px solid #FF00FF;margin-bottom: 2px;font-size: x-small;overflow:hidden;" title="<?=$file[0]?>"><?=$file[0]?></div>
  <button class="bleft" title="Вліво"><img src="/i/left.png" border="0"></button
  ><button class="bdelete" title="Знищити"><img src="/i/deleteimg.png" border="0"></button
  ><button class="bedit"  title="Редагувати підпис"><img src="/i/editimg.png" border="0"></button
  ><button class="bcopy"  title="Копіювати адресу"><img src="/i/copy.png" border="0"></button
  ><button class="bright" title="Вправо"><img src="/i/right.png" border="0"></button>
</div>
<?php } } } ?>
</div>
<br style="clear: both" /><hr />
<div id="dialog"  style="display:none;padding:10px;float: left">
<Form method=post enctype='multipart/form-data'>
<table align="center"><tr><th colspan="2" align="left">
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
<div id="dialog1"  style="display:none;padding:10px;float: left">
<table style="width: 450px;">
<tr><td>Назва (українською)</td><td>
<input type='text' name='title' id='title' style="width: 100%">
</td></tr>
<tr><td>Папка (англійською)</td><td>
<input type='text' name='name' id='name' style="width: 100%">
</td></tr>
<tr><td colspan="2" align="right"><br />
<input type='button' id="createFolder" value='Створити'>
</td></tr></table>
</div>
<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/
jQuery(".fotoframe .bleft:first").attr("disabled","disabled");
jQuery(".fotoframe .bright:last").attr("disabled","disabled");
jQuery(".fotoframe .bleft").click(function(){
  mydiv = jQuery(this).parent();
  file = jQuery(mydiv).find("[type='hidden']").val();
  jQuery(mydiv).prev().before(mydiv);
  jQuery(".fotoframe button").removeAttr("disabled");
  jQuery(".fotoframe .bright:last").attr("disabled","disabled");
  jQuery(".fotoframe .bleft:first").attr("disabled","disabled");
  jQuery.get("/ajax/imgActions.php",{file:file,action:'imageleft',folder:"<?=$dirname?>"});
  });

jQuery(".fotoframe .bright").click(function(){
  mydiv = jQuery(this).parent();
  file = jQuery(mydiv).find("[type='hidden']").val();
  jQuery(mydiv).next().after(mydiv);
  jQuery(".fotoframe button").removeAttr("disabled");
  jQuery(".fotoframe .bright:last").attr("disabled","disabled");
  jQuery(".fotoframe .bleft:first").attr("disabled","disabled");
  jQuery.get("/ajax/imgActions.php",{file:file,action:'imageright',folder:"<?=$dirname?>"});
  });

jQuery(".fotoframe .bdelete").click(function(){
  mydiv = jQuery(this).parent();
  file = jQuery(mydiv).find("[type='hidden']").val();
  jQuery.get("/ajax/imgActions.php",{file:file,action:'imagedel',folder:"<?=$dirname?>"},function(d){if (d!='') alert(d);});
  jQuery(mydiv).remove();
  });

jQuery(".fotoframe .bcopy").click(function(){
    file = jQuery(this).siblings("[name='file_path']").val();
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
  if (text1!=null){
    jQuery(this).siblings("img").attr("title",text1);
    jQuery.get("/ajax/imgActions.php",{file:file,action:'edittitle',text:encodeURIComponent(text1),folder:"<?=$dirname?>"},function(data){if (data!='') alert(data);});
    jQuery("#iframe1").attr("src",location + "&ajax=1&file=" + file + "&action=edittitle&text=" + text1);
  }
  });
jQuery(".fotoframe button").css({
  width:'24px',
  padding: '1px',
  margin: '0'
})

jQuery("#createFolder").click(function(){
  name = jQuery("#dialog1 #name").val();
  title = jQuery("#dialog1 #title").val();
  jQuery.get("/ajax/imgActions.php",{title:title,action:'addfolder',name:name});
  location.href="/admin/photos/?folder="+name;
  });

/*]]>*/
</script>

<iframe id="iframe1" src="" style="display: none">
</iframe>










