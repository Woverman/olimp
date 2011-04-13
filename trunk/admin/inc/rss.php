<script type='text/javascript'>
function ToEdit(id) {
  var rt=getHTTPRequestObject();
  var txt;
  rt.open("POST", "/ajax/getById.php?tbl=rss_news&id=" + id,false);
  rt.send(null);
  if ( rt.status == 200 ) {
  	txt=rt.responseText.split("{");
  	document.getElementById('formtitle').innerHTML="Редагуємо RSS-стрічку";
	  document.getElementById('mode').value="edit";
    document.getElementById('uid').value=txt[0];
    document.getElementById('sight').value=txt[7];
  	document.getElementById('title').value=txt[2];
  	document.getElementById('link').value=txt[1];
  	document.getElementById('timeout').value=txt[4];
    document.getElementById('active').checked=(txt[5]=="1");;
    ShowModal();
    document.forms[0].focus();
  }
}
function ToCheck(){
  var link=document.getElementById('link').value;
  var rt=getHTTPRequestObject();
  var txt;
  rt.open("POST", "/ajax/checkRss.php?link=" + link,false);
  rt.send(null);
  if ( rt.status == 200 ) {
  	txt=rt.responseText.split("{");
  }
}
function ToAdd(){
    clearForm();
    ShowModal();
}
function ToDel(row) {
	var tr=document.getElementById('row'+row);
	if (confirm("Знищити "+tr.cells[2].innerHTML+"?"))	{
	clearForm();
	document.getElementById('uid').value=row;
	document.getElementById('mode').value="del";
	document.forms['mainform'].submit();
	}
}
function clearForm() {
	document.getElementById('formtitle').innerHTML='Нова RSS-стрічка';
	document.getElementById('uid').value='0';
	document.getElementById('sight').value='';
  document.getElementById('title').value='';
  document.getElementById('link').value='';
  document.getElementById('timeout').value='60';
  document.getElementById('minute').value='1';
  document.getElementById('active').checked=0;
	document.getElementById('mode').value='add';
  HideModal();
}
function updaterow(row,data) {
	var tr=document.getElementById('row' + row)
  txt=data.split("{");
	tr.cells[1].innerHTML = txt[6];
  tr.cells[2].innerHTML = txt[1];
  tr.cells[3].innerHTML = txt[2];
	clearForm();
}
function ShowModal(){
    var ov = document.getElementById("overlay");
    var frm = document.getElementById("formbox")
    ov.style.position="absolute";
    ov.style.top="-1000";
    ov.style.left="-1000";
    ov.style.width="4000";
    ov.style.height="2000";
    if (document.all){
      frm.style.position="absolute";
      frm.style.top=document.body.scrollTop+10;
      frm.style.left=document.body.scrollLeft+10;
      ov.style.zIndex="1";
      ov.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity = 80)"
      setInterval("var a=document.getElementById('formbox');a.style.top=document.body.scrollTop+10;a.style.left=document.body.scrollLeft+10;",30);
    } else {
      ov.style.position="fixed";
      ov.style.top=0;
      ov.style.left=0;
      ov.style.zIndex="1";
      ov.style.opacity=0.8;
      ov.style.MozOpacity = 0.8;
      ov.style.width="100%";
      ov.style.height="100%";
    }
    frm.style.zIndex="2";
    frm.style.display="block";
    }
function HideModal(){
    document.getElementById("formbox").style.display="none";
    var ov = document.getElementById("overlay");
    ov.style.opacity=0;
    ov.style.MozOpacity = 0;
    ov.style.width=0;
    ov.style.height=0;
    }
</script>
<?
$page=1;
if (isset($_GET['page'])) $page=$_GET['page'];
?>
<div id="overlay" style="display:block;background-color:#000;">
<!-- div for hide content -->
</div>
 <!-- div for form -->
<div id="formbox" style="position:fixed;display:none;background-color: #f0f0f0;z-index:6;width:450px">
<Form method=post action='/admin/editrss.php' name='mainform' target="ifrm" style="border:2px outset gray;display:block;padding-bottom:2px">
<div style="display:block;position:relative;width:100%;height:18px;background-color:blue;">
<h4 id='formtitle' style="text-align:left;color:white;margin-left:5px;">Нова стрічка новин:</h4>
<img align='right' src="/i/close.gif" style="position:absolute;top:1px;left:426px" onclick="HideModal()" border=0>
</div>
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<input type='hidden' value="<?=$page?>" name='page'>
<table border=0 width=100% style="padding:10px">
<tr>
<td align=right width=100><label for="link">Посилання:</label></td>
<td><input type='text' name='link' id='link' style="width:300px"><br>
<input type="button" onclick="ToCheck()" style="width:300px" value="Перевірити / Заповнити" disabled="disabled">
</td>
</tr>
<tr>
<td align=right width=100><label for="sight">Сайт:</label></td>
<td><input type='text' name='sight' id='sight' style="width:300px"></td>
</tr>
<tr>
<td align=right width=100><label for="title">Назва:</label></td>
<td><input type='text' name='title' id='title' style="width:300px"></td>
</tr>
<tr>
<td align=right width=100><label for="timeout">Таймаут:</label></td>
<td><input type='text' name='timeout' id='timeout' size="5" style="width:50px">
<select name='minute' id='minute' style="width:100px">
<option value=1>секунд</option>
<option value=60>хвилин</option>
<option value=3600>годин</option>
<option value=86400>днів</option>
</select>
</td>
</tr>
<tr>
<td align=right width=100><label for="active">Показувати:</label></td>
<td><input type='checkbox' name='active' id='active'></td>
</tr>
<tr><td colspan=2 align=right><input id="sbm" type='submit' value='Зберегти' onclick="HideModal()"> <input type='reset' value='Відмінити' onclick="clearForm()"></td></tr>
</table>
</form>
</div>
<button style="height: 40px" onclick="ToAdd();"><img class="bimg" src="/i/rss.png">Добавити нову RSS-стрічку...</button>
<table class="mytab" width=98%>
<tr bgcolor=#BDCACC><th>№</th><th>Сайт</th><th>Назва</th><th>Обновлено</th><th></th></tr>
<?php
$sql="Select count(id) from rss_news";
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
if ($rowcount>0) {
$sql="Select `id`,`sight`,`title`,DATE_FORMAT(last,'%d.%m.%Y %H:%i:%s') from rss_news;";

$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_array($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td>';
	echo '<td>';
	echo '<a href="javascript:ToEdit('.$row[0].')"><img class=aimg src="/i/edit.png"></a>';
	echo '<a href="javascript:ToDel('.$row[0].')"><img class=aimg src="/i/delete.png"></a>';
	echo '</td>';
	echo '</tr>';
}}
?>
</table>


