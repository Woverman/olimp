<script type='text/javascript'>
function ToEdit(id){
  //var rt=getHTTPRequestObject();
  var txt;
  //rt.open("POST", "/ajax/getById.php?tbl=m_exl&id=" + id,false);
  //rt.send(null);
  $.get("/ajax/getById.php?tbl=m_exl&id=" + id,function(data){
  	txt=data.split("{");
  	document.getElementById('title').innerHTML="Редагуємо ексклюзив";
  	document.getElementById('uid').value=txt[0];
  	document.getElementById('rieltor').value=txt[1];
  	document.getElementById('viddil').value=txt[2];
  	document.getElementById('adresa').value=txt[3];
    t=txt[4].split('-');
  	document.getElementById('dstart').value=t[2]+'.'+t[1]+'.'+t[0];
    t=txt[5].split('-');
  	document.getElementById('dend').value=t[2]+'.'+t[1]+'.'+t[0];
  	document.getElementById('comment').value=txt[6];
  	document.getElementById('mode').value="edit";
    ShowModal();
    document.forms[0].focus();
  });

}
function ToAdd(){
    clearForm();
    ShowModal();
}
function ToDel(msg,id){
  var tr=document.getElementById('row'+id);
	if (confirm(msg+"?"))	{
	clearForm();
	document.getElementById('uid').value=id;
	document.getElementById('mode').value="del";
	document.forms['mainform'].submit();
  }
}
function updaterow(row,data) {
  var txt=data.split("{");
	var tr=document.getElementById('row' + row);
	tr.cells[1].innerHTML = txt[0];
	tr.cells[2].innerHTML = txt[1];
	tr.cells[3].innerHTML = txt[2];
	tr.cells[4].innerHTML = txt[3];
	tr.cells[5].innerHTML = txt[4];
	tr.cells[6].innerHTML = txt[5];
}

function clearForm() {
	document.getElementById('title').innerHTML='Нова вулиця:';
	document.getElementById('uid').value='0';
	document.getElementById('adresa').value='';
  document.getElementById('rieltor').value='';
  document.getElementById('viddil').value='';
  document.getElementById('dstart').value='';
  document.getElementById('dend').value='';
  document.getElementById('comment').value='';
	document.getElementById('mode').value='add';
}
function ShowModal(){
	$('#overlay').show();
	$('#formbox').show();
	$('#dialogTitle').drag();
  }
function HideModal(){
   	$('#overlay').hide();
	$('#formbox').hide();
  }
</script>
<div id="overlay"><!-- div for hide content --></div>
 <!-- div for form -->
<div id="formbox" style="display:none;position:relative; margin:0 auto;top:100px;background-color: #DFDFDF;border:1px solid #FEFEFE;width:450px;">
<div id="dialogTitle"><span id="title">Новий ексклюзив:</span>
	    <img src="/i/window_close.png" width="24" onclick="HideModal();" style="float: right;cursor: pointer;position: relative;top:-4px;right:-2px"/>
	</div>
<Form method='post' action='/admin/editexl.php' name='mainform' target='ifrm' style="border:2px outset gray;display:block">
<div style="padding:10px;overflow:hidden;">
<table border=0 width=400>
<tr>
<td align=right width=100>Адреса:</td>
<td width=120><input type='text' name='adresa' id='adresa'></td>
<td><font color="#909090">Фактична адреса</font></td>
</tr>
<tr>
<td align=right>Ріелтор:</td>
<td><select name='rieltor' id='rieltor'>
<option value=0>-</option>
<?php @getaslist('d_users',$row['user'],'rights>-1'); ?>
</select></td>
<td><font color="#909090">Відповідальний</font></td>
</tr>
<tr>
<td align=right>Відділення:</td>
<td><select name='viddil' id='viddil'>
<option value=1>Фрунзе</option>
<option value=2>Київська</option>
<option value=3>Вишенька</option>
<option value=4>Центральне</option>
</select>
</td>
<td><font color="#909090"></font>
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<input type='hidden' value='1063' name='parent'>
</td>
</tr>
<tr>
<td align=right>Початок:</td>
<td><input type='text' name='dstart' id='dstart' onkeydown="sbm.disabled=false;"></td>
<td><font color="#909090">dd.mm.yyyy</font></td>
</tr>
<tr>
<td align=right>Кінець:</td>
<td><input type='text' name='dend' id='dend' onkeydown="sbm.disabled=false;"></td>
<td><font color="#909090">dd.mm.yyyy</font></td>
</tr>
<tr>
<td align=right>Примітка:</td>
<td><input type='text' name='comment' id='comment' onkeydown="sbm.disabled=false;"></td>
<td><font color="#909090"></font></td>
<td><font color="#909090"></font></td>
</tr>
<tr><td colspan=3 align=right style="text-align:right"><input id="sbm" type='submit' value='Зберегти' onclick="HideModal()">
 <input type='reset' value='Відмінити' onclick="HideModal()"></td><td><font color="#909090"></font></td></tr>
</table>
</div>
</form>
</div><!-- div for form -->
<form>
<input type="button" value="Добавити новий ексклюзив" onclick="ToAdd();">
<input type="hidden" value="exl" name="panel">
<?php
if (!isset($_GET['showdeleted'])) $_GET['showdeleted']=1;
if (!isset($_GET['filter'])) $_GET['filter']=0;
echo '<input type="hidden" value="'.$_GET['showdeleted'].'" name="showdeleted" id="showdeleted">';
if ($_GET['showdeleted']==1){
echo '<input type="submit" value="Показати знищені" onclick="showdeleted.value=2"> ';
} else {
echo '<input type="submit" value="Заховати знищені" onclick="showdeleted.value=1"> ';
} ?>
<select name=filter onchange='form.submit()'>
    <option value=0 <? if ($_GET['filter']==0) echo 'SELECTED' ?>>Всі</option>
    <optgroup label="Відділення">
    <option value=-1 <? if ($_GET['filter']==-1) echo 'SELECTED' ?>>Фрунзе</option>
    <option value=-2 <? if ($_GET['filter']==-2) echo 'SELECTED' ?>>Київська</option>
    <option value=-3 <? if ($_GET['filter']==-3) echo 'SELECTED' ?>>Вишенька</option>
    <option value=-4 <? if ($_GET['filter']==-4) echo 'SELECTED' ?>>Центральне</option>
    </optgroup>
    <optgroup label="Ріелтори">
    <?php @getaslist('d_users',$_GET['filter'],'rights>-1'); ?>
    </optgroup>
</select>
</form>
<div align=center valign=center id="StatusLine"></div>
<table class="mytab" width=98%>
<tr style="background-color: #BDCACC"><th>№</th><th>Адреса</th><th>Ріелтор</th><th>Відділ</th><th>Початок</th><th>Кінець</th><th>Мітка</th><th>Операції</th></tr>
<?php
$a=" where e.deleted<".$_GET['showdeleted'];
//if (isset($_GET['showdeleted'])) $a=' where e.deleted<>-2';
if (isset($_GET['filter'])) {
    if ($_GET['filter']<0) $a.=' and e.viddil='.(0-$_GET['filter']);
    else if ($_GET['filter']>0) $a.=' and e.rieltor='.$_GET['filter'];
}
$sql="select e.id,e.adresa,u.name,e.viddil,date_format(e.dstart,'%d.%m.%Y'),date_format(e.dend,'%d.%m.%Y'),e.comment,TO_DAYS(e.dend)-TO_DAYS(CURRENT_DATE) as rizn,e.deleted from m_exl e LEFT JOIN d_users u ON e.rieltor=u.id".$a." order by rizn asc;";
//echo "<hr>$sql<hr>";
$res=mysql_query($sql);
$a=1;
$b=array(1=>'Фрунзе',2=>'Київська',3=>'Вишенька',4=>'Центральне');
$npp=0;
while ($row=mysql_fetch_array($res)) {
  $aa=$row[7];
  $color="<font color=green>";$col="</font>";
  if ($aa<7) $color="<font color=#FF9900>";
  if ($aa<1) $color="<font color=red>";
  $del=$row[8];
  if ($del) $color="<font color=#A7A7A7>";
  echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
  echo '<td>'.$color.++$npp.$color.'</td>';
  echo '<td>'.$color.$row[1].$col.'</td><td>'.$color.$row[2].$col.'</td>';
  echo '<td>'.$color.$b[$row[3]].$col.'</td><td>'.$color.$row[4].$col.'</td>';
  echo '<td>'.$color.$row[5].$col.'</td><td>'.$color.$row[6].$col.'</td>';
  echo '<td>';
  echo '<a href="javascript:ToEdit('.$row[0].')"><img class=aimg src="/i/edit.gif"></a>';
  if ($del){
    echo '<a href="javascript:ToDel(\'Відновити\','.$row[0].')"><img class=aimg src="/i/undo.gif"></a>';
  } else {
    echo '<a href="javascript:ToDel(\'Знищити\','.$row[0].')"><img class=aimg src="/i/del.gif"></a>';
  }
  echo '</td>';
  echo '</tr>';
}
?>
<tr><td align="right" colspan="7" style="text-align:right;"><i>
<img class=aimg src="/i/edit.gif"> - змінити
<img class=aimg src="/i/del.gif"> - знищити
<? if (isset($_GET['showdeleted'])){ ?>
<img class=aimg src="/i/undo.gif"> - відновити
<? } ?>
</i></td></tr>
</table>
<script type='text/javascript'>
clearForm();
</script>

