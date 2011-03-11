<?if (IsAdmin()):?>
<script type='text/javascript'>
/* запрос інфи */
function ToEdit(id) {
  clearForm();
  var rt=getHTTPRequestObject();
  var txt;
  rt.open("POST", "/ajax/getById.php?tbl=d_users&id=" + id,false);
  rt.send(null);
  if ( rt.status == 200 ) {
  	txt=rt.responseText.split("{");
  	document.getElementById('uid').value=txt[0];
  	document.getElementById('login').value=txt[1];
  	document.getElementById('title').innerHTML="Редагуємо: " + txt[5];
  	document.getElementById('longname').value=txt[5];
  	document.getElementById('locked').checked=(txt[4]=="1");
  	document.getElementById('posada').value=txt[8];
  	document.getElementById('phone1').value=txt[9];
  	document.getElementById('phone2').value=txt[10];
  	document.getElementById('phone3').value=txt[11];
  	document.getElementById('phone4').value=txt[12];
  	document.getElementById('email').value=txt[13];
    document.getElementById('otdel').value=txt[14];
  	document.getElementById('rights').value=txt[3];
  	document.getElementById('mode').value="edit";
    LoadNewImage('userfoto','-'+txt[0],1,2);
    ShowModal();
  }
}
function ToAdd(){
    clearForm();
    ShowModal();
}
/* запит на знищення */
function ToDel(id) {
	clearForm();
	document.getElementById('uid').value=id;
	document.getElementById('mode').value="del";
	document.forms[0].submit();
}
function clearForm() {
  document.forms[0].reset();
	document.getElementById('title').innerHTML="Новий користувач";
  document.getElementById('StatusLine').innerHTML="";
	document.getElementById('mode').value="add";
  HideModal();
}
function updaterow(id,data){
  var txt=data.split("{");
  var tr=document.getElementById('row' + id);
  tr.cells[0].innerHTML = txt[1];
  tr.cells[1].innerHTML = txt[2];
  tr.cells[2].innerHTML = txt[3];
  document.getElementById('lock' + id).src='/i/lock'+txt[4]+'.gif';
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
      frm.style.top=document.body.scrollTop;
      frm.style.left=document.body.scrollLeft;
      ov.style.zIndex="1";
      ov.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity = 80)"
      setInterval("var a=document.getElementById('formbox');a.style.top=document.body.scrollTop-30;a.style.left=document.body.scrollLeft;",30);
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
  }
</script>
<div id="overlay" style="display:block;background-color:#000;">
<!-- div for hide content -->
</div>
<div id="formbox" style="position:fixed;display:none;background-color: #f0f0f0;z-index:6;width:500px;top:100">
<Form method=post action='/admin/edituser.php' target="ifrm" style="border:2px outset gray;display:block" enctype='multipart/form-data'>
<div style="display:block;position:relative;width:100%;height:18px;background-color:blue;">
<h4 id='title' style="text-align:left;color:white;margin-left:5px;">Новий користувач:</h4>
<img align='right' src="/i/close.gif" style="position:absolute;top:1px;left:476px" onclick="HideModal()" border=0>
</div>
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<table border=0 width=100%>
<tr><td align=right width="120">Логін:</td><td><input type='text' name='login' id='login' class="txt"></td><td rowspan=3 align=center valign=center id="StatusBar">&nbsp;</td></tr>
<tr><td align=right>Пароль:</td><td><input type='text' name='pass' id='pass' class="txt"></td></tr>
<tr><td align=right>ПІП:</td><td><input type='text' name='longname' id='longname' class="txt"></td></tr>
<tr><td align=right>Доступ:</td><td>
<select name='rights' id='rights'>
<option value="0" title="Повний доступ">Адмін (повний доступ)</option>
<option value="1" title="Обмеженеий доступ">Оператор (обмежений)</option>
<option value="2" title="Нема доступу" selected="selected">Ріелтор (нема доступу)</option>
</select>
</td></tr>
<tr><td align=right width="100">Відділення:</td><td>
<select name='otdel' id='otdel'>
<option value="0" title="0">Гоголя,15</option>
<option value="1" title="1">Київська,16</option>
<option value="2" title="2">Юності,44</option>
<option value="3" title="3">Фрунзе,4</option>
</select>
</td></tr>
<tr><td align=right width="100">Посада:</td><td><input type='text' name='posada' id='posada' class="txt"></td><td rowspan=6><img id=userfoto name=userfoto src="/image.php?mode=2"></td></tr>
<tr><td align=right>Телефон 1:</td><td><input type='text' name='phone1' id='phone1' class="txt"></td></tr>
<tr><td align=right>Телефон 2:</td><td><input type='text' name='phone2' id='phone2' class="txt"></td></tr>
<tr><td align=right>Телефон 3:</td><td><input type='text' name='phone3' id='phone3' class="txt"></td></tr>
<tr><td align=right>Телефон 4:</td><td><input type='text' name='phone4' id='phone4' class="txt"></td></tr>
<tr><td align=right>Email:</td><td><input type='text' name='email' id='email' class="txt"></td></tr>
<tr><td align=right>Фото:</td><td><input type='file' name='foto' id='foto' class="txt"></td></tr>
</td></tr></table>
<table border=0 width="100%">
<tr><td>&nbsp;</td><td align=left><input type='checkbox' value=1 name='locked' id='locked'><span onclick="document.getElementById('locked').checked=!(document.getElementById('locked').checked)"> Заблокований</span></td><td>&nbsp;</td></tr>
<tr><td colspan=2 align=right style="text-align:right"><input type='submit' value='Записати'> <input type='reset' value='Вiдмiнити' onclick="clearForm()"></td></tr>
</table>
</form>
</div>

<table width="100%">
<tr><td width="50%"><h4><img border=0 src='./i/users.png' align=absmiddle hspace=10px style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/users.png); width:expression(1); height:expression(1);}'>
Співробітники</h4></td><td align="right"><input type="button" value="Добавити нового спiвробiтника" onclick="ToAdd();"></td></tr></table>
</div>
<hr style="margin-top:-10px">
<table class="mytab" width=100%>
<tr bgcolor=#BDCACC><th>№</th><th>Логін</th><th>Ім'я</th><th>Права</th><th>Блок</th><th>Операції</th></tr>
<?php
$sql="Select count(id) from d_users where login<>'serg'";
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
if (!isset($page)) $page=1;
$perpage=15;
$pagecount=ceil($rowcount/$perpage);
if ($page>$pagecount) $page=1;
if ($pagecount>1) {
	MakePageLinks($page,$pagecount,$rowcount);
}
$sql="Select * from d_users where login<>'serg' order by id desc";
if ($_REQUEST['page']!='all') $sql.=" limit ".(($page-1)*$perpage).','.$perpage.";";
$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_row($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row[0].'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[5].'</td><td>'.$row[3].'</td><td title='.$row[4].'><img src=/i/lock'.$row[4].'.gif id="lock'.$row[0].'"></td>';
	echo '<td><img src="./i/edit.gif" onclick="ToEdit('.$row[0].')" style="cursor:pointer">&nbsp;&nbsp;<img src="./i/del.gif" onclick="ToDel('.$row[0].')" style="cursor:pointer"></td>';
	echo '</tr>';
}
?>
<tr><td colspan=6 align=right style="text-align:right"><i><img class=aimg src="./i/edit.gif"> - змінити <img class=aimg src="./i/del.gif">- знищити</i></td></tr>
</table>
<hr>
<div id="StatusLine"></div>
<?else:?>
<h1><center><font color=red>Заборонена зона!</font><br><a href="#" onclick="history.back()">&lt;&lt; Повернутись</a></center><h1>
<?endif?>
<script type='text/javascript'>
clearForm();
</script>
