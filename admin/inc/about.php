<?
if (isset($_POST['title'])){
  // save changes
  $sql = 'update m_pages set title="'.$_POST['title'].'", text="'.$_POST['maintext'].'",title2="'.$_POST['conttitle'].'",text2="'.$_POST['conttext'].'" where id = 2';
  $res = mysql_query($sql);
  echo('<div style="border:1px solid green; height:1em; margin:2px; padding:4px; font-weight:bold;" align="center">Дані успішно збережено</div>');
 }
 $sql='Select * from m_pages where id = 2';
 $res=mysql_query($sql);
 $row=mysql_fetch_array($res);

?>
<h3>Про нас:</h3>
<form method='post' enctype='multipart/form-data'>
Заголовок 1:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="title" type="text" size="50" value='<?= $row['title']?>'><br /><br />
Текст:<br />
<textarea id='redactor_content_master' name='maintext' style="width: 100%;height: 250px">
<?=$row['text']?>
</textarea><br /><br />
Заголовок 2:&nbsp;&nbsp;&nbsp;<input name="conttitle" type="text" size="50" value="<?=$row['title2']?>"><br /><br />
Відділення:<br />
<textarea id='redactor_content_slave' name='conttext' style="width: 100%;height: 250px">
<?=$row['text2']?>
</textarea><br /><i>Позначки '{0}','{1}' i.т.д будуть замінені на посилання на список працівників відповідного відділення.</i><br />
<input type="submit" name="" value="Зберегти" />
</form>