<?
if (isset($_POST['title'])){
  // save changes
  $sql = 'update m_pages set title="'.$_POST['title'].'", text="'.$_POST['maintext'].'",title2="'.$_POST['conttitle'].'",text2="'.$_POST['conttext'].'" where id = 1';
  $res = mysql_query($sql);
  echo('<div style="border:1px solid green; height:1em; margin:2px; padding:4px; font-weight:bold;" align="center">Дані успішно збережено</div>');
 }
 $sql='Select * from m_pages where id = 1';
 $res=mysql_query($sql);
 $row=mysql_fetch_array($res);
?>
<h3>Головна сторінка розділу "Богуна"</h3>
<form method='post' enctype='multipart/form-data' action='/admin/admin.php?panel=boguna_main'>
Заголовок:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="title" type="text" size="50" value="<?=$row['title']?>"><br /><br />
Текст:<br />
<textarea id='redactor_content_master' name='maintext' style="width: 100%;height: 300px">
<?=$row['text']?>
</textarea><br /><br />
Заголовок 2:&nbsp;&nbsp;&nbsp;<input name="conttitle" type="text" size="50" value="<?=$row['title2']?>"><br /><br />
Контакти:<br />
<textarea id='redactor_content_slave' name='conttext' style="width: 100%;height: 300px">
<?=$row['text2']?>
</textarea><br /><br />
<input type="submit" name="" value="Зберегти" />
</form>
<!-- script type="text/javascript">
	WYSIWYG.attach('maintext');
  WYSIWYG.attach('conttext');
</script -->