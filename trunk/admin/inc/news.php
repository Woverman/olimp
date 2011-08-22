<script type="text/javascript">
  function putNow(){
    var txt=document.getElementById('news_dt');
    var today=new Date();
    var y=today.getFullYear();
    var n=checkTime(today.getMonth());
    var d=checkTime(today.getDate());
    var h=checkTime(today.getHours());
    var m=checkTime(today.getMinutes());
    var s=checkTime(today.getSeconds());
    txt.value=d+'.'+n+'.'+y+' '+h+':'+m+':'+s;
  }
  function checkTime(i)
  {
  if (i<10)
    {
    i="0" + i;
    }
  return i;
  }
  function validform()
  {
    if ($('#news_dt').val()==''){
      alert("Вкажіть дату публікації!");
      return
      }
    if ($('#news_name').val()==''){
      alert("Вкажіть заголовок публікації!");
      return
      }
    if ($('#redactor_content_master').val()==''){
      alert("Вкажіть короткий текст публікації!");
      return
      }
    if ($('#redactor_content_slave').val()==''){
      alert("Вкажіть основний текст публікації!");
      return
      }

    document.forms[0].submit();
  }

  function selectImageDialog(){

  }
</script>
<div style="border:1px solid #BFBFBF;padding:2px;margin:2px">
<?if (@$_REQUEST['mode']=="add" || @$_REQUEST['mode']=="edit"){?>
<a href=/admin/news/><button style="height: 40px"><img class=bimg src="/i/list.png">Список...</button></a>
<button style="height: 40px" onclick="validform(); return(false);"><img class=bimg src="/i/save.png">Записати</button>
<?}else{?>
<a href=/admin/news/?mode=add><button style="height: 40px"><img class=bimg src="/i/add.png">Добавити...</button></a>
<?}?>
</div>
<?
switch (@$_REQUEST['mode']) {
  case 'edit':
    $sql='Select *,date_format(dateadd,"%d.%m.%Y %H:%i:%s")as dt from new_news where id='.$_GET['id'];
    if ($res=mysql_query($sql)) list($id,$title,$short,$long,$date,$enbl,$img,$dt)=mysql_fetch_array($res);
  case 'add':
    ?>
    <form name="newsedit" method="POST" action="/admin/news/" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="page" value="admin">
    <input type="hidden" name="mode" value="save">
    <input type="hidden" name="panel" value="news">
	<div style="padding: 8px;width: 960px;border: 1px solid silver;margin:4px 0;">
		<span class="td_title" style="padding-left: 115px;">Заголовок:</span> <input id="news_name" name="news_name" type="text" size="75" value="<?=@stripslashes($title)?>"><br>
		<span class="td_title" style="padding-left: 115px;">Дата і час публікації:</span> <input id="news_dt" name="news_dt" type="text" size="65" value="<?=@$dt?>"> <input type="button" value="Зараз" onclick="putNow()"><br>
	</div>
    <div style="border: 1px solid silver; padding: 8px;min-height: 100px;width: 960px;">
	<table>
		<tr>
			<td rowspan=4>
				<img class="news_item_image" style="margin-right: 10px;" width="100" height="100" src="<?=@stripslashes($img)?>">
			</td>
			<td class="td_title">Адреса зображення:</td>
			<td><input id="news_image_exist" name="news_image_exist" type="text" size="75" value="<?=@stripslashes($img)?>"></td>
		</tr>
		<tr>
			<td class="td_title">Загрузіть фото:</td>
			<td><input id="news_image_file" name="news_image_file" type="file" size="70" title="Загрузити нове" value="Загрузити нове"></td>
		</tr>
		<tr>
			<td class="td_title">Виберіть з папки на сервері: </td>
			<td><input type=button onclick="selectImageDialog();return false;" value="Вибрати..."></td>
		</tr>
	</table>
    </div>
    Короткий текст:<i>(перший абзац новини впишіть сюди)</i><br>
    <textarea name="news_short" rows="2" cols="120" id="redactor_content_master"> <?=@stripslashes($short)?> </textarea>
    Повний текст:<i>(продовження впишіть сюди)</i><br>
    <textarea wrap=soft name="news_long" rows="10" cols="120" id="redactor_content_slave"> <?=@stripslashes($long)?> </textarea>
    </form>
    <?
    break;
  case 'save':
    $id=@$_POST['id'];
    if (empty($id)){
      mysql_query('insert into new_news (title,published) values ("new element",1)');
      $id=mysql_result(mysql_query('select id from new_news where title="new element"'),0);
    }
    if (!empty($_POST['news_dt'])) {
      $dt=$_POST['news_dt'];
      preg_match('/^(\d{1,2})[-\.,]{1}(\d{1,2})[-\.,]{1}(\d{2,4}) (\d{2})[:]{1}(\d{2})[:]{1}(\d{2})$/',$dt,$arr);
	 // debug($arr);
      $dt=$arr[3].'-'.$arr[2].'-'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
      $sql="Update new_news set `dateadd`='".$dt."' where id=".$id;
	  mysql_query($sql);
	  if (mysql_affected_rows()<0) debug(mysql_error().'<br>'.$sql.'<br>');
	  //debug($sql);
    }
	$imagepath = saveImage('news','news_image_file');
	$image = $_POST['news_image_exist'];
	if ($imagepath!='') $image = $imagepath;
	$sql='Update new_news set `img`=\''.mysql_escape_string($image).'\' where id='.$id; mysql_query($sql);
    if (mysql_affected_rows()<0) debug(mysql_error().'<br>'.$sql.'<br>');
    if (!empty($_POST['news_name'])) $sql='Update new_news set `title`=\''.mysql_escape_string(trim($_POST['news_name'])).'\' where id='.$id; mysql_query($sql);
    if (mysql_affected_rows()<0) debug(mysql_error().'<br>'.$sql.'<br>');
    if (!empty($_POST['news_short'])) $sql='Update new_news set `intro`=\''.mysql_escape_string(trim($_POST['news_short'])).'\' where id='.$id;mysql_query($sql);
    if (mysql_affected_rows()<0) debug(mysql_error().'<br>'.$sql.'<br>');
    if (!empty($_POST['news_long'])) $sql='Update new_news set `text`=\''.mysql_escape_string(trim($_POST['news_long'])).'\' where id='.$id;mysql_query($sql);
    if (mysql_affected_rows()<0) debug(mysql_error().'<br>'.$sql.'<br>');
  case 'delete':
    if (isset($_GET['id']) and $_GET['mode']=='delete') {
      mysql_query('Delete from new_news where id='.$_GET['id']);
      echo 'Знищено '.mysql_affected_rows().' рядів.';
      }
  case 'offon':
    if (isset($_GET['id']) and $_GET['mode']=='offon') {
      mysql_query('update news set enable=0-(enable-1) where id='.$_GET['id']);
      //echo '<font color=red>Дані збережено.</font><br>';
      }
  default:
    $sql='Select *,date_format(dateadd,"%d.%m.%Y %H:%e")as dt from new_news';
    $res=mysql_query($sql);
    echo '<table cellspasing=2 width=100% class="mytab">';
    $a=1;
    while ($row=mysql_fetch_array($res)) {
      echo '<tr class="row'.$a=abs($a-1).'"><td style="padding:2px 10px;text-align:left">'.$row['title'].'</a></td><td style="padding:2px 10px;">'.$row['dt'].'</td><td width="120">';
      echo '<a href=/admin/admin.php?panel=news&mode=edit&id='.$row['id'].'><img class=aimg src="/i/edit.png" title="Правка"></a>';
      echo '<a href=/admin/admin.php?panel=news&mode=delete&id='.$row['id'].'><img class=aimg src="/i/delete.png" title="Знищити"></a>';
      echo '<a href=/admin/admin.php?panel=news&mode=offon&id='.$row['id'].'><img class=aimg src="/i/'.($row['enable']==1?'on':'off').'.png" title="'.($row['enable']!=1?'Увімкнути':'Вимкнути').'"></a>';
      echo '</td></tr>';
    }
    echo '<tr><td colspan="3" align="right"><img src="/i/edit.png"> Правка  <img src="/i/delete.png"> Знищити  <img src="/i/on.png"> Активно  <img src="/i/off.png"> Неактивно </td></tr>';
    echo '</table>';
}
?>

