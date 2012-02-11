<script type='text/javascript'>
function ToEdit(id){
  $.get("/ajax/getById.php?tbl=m_cards&id=" + id,function(data){
  	var txt=data.split("{");
  	$('#title').text("Редагуємо карту");
	$('#cardid').val(txt[0]);
	$('#cardnum').val(txt[1]);
  	$('#client').val(txt[2]);
  	$('#raisedate').val(txt[3]);
  	$('#contractnum').val(txt[4]);
  	$('#viddil').val(txt[5]);
	$('#rieltor').val(txt[6]);
  	$('#comment').val(txt[7]);
  	$('#mode').val("edit");
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
	$('#cardid').val(id);
	$('#mode').val("del");
	document.forms[0].submit();
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
	document.getElementById('title').innerHTML='Нова карта:';
	document.getElementById('cardid').value='0';
  	document.getElementById('rieltor').value='';
	document.getElementById('viddil').value='';
	document.getElementById('client').value='';
	document.getElementById('raisedate').value='';
	document.getElementById('comment').value='';
	document.getElementById('contractnum').value='';
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
<div id="dialogTitle"><span id="title">Добавити карту:</span>
	    <img src="/i/window_close.png" width="24" onclick="HideModal();" style="float: right;cursor: pointer;position: relative;top:-4px;right:-2px"/>
	</div>
<Form method='post' action='/admin/save/editcard.php' name='mainform' target='ifrm' style="border:2px outset gray;display:block">
<div style="padding:10px;overflow:hidden;">
<table border=0 width=400>
<tr>
	<td align=right width=100>Номер:&nbsp;</td>
	<td width=120><input type='text' name='cardnum' id='cardnum'></td>
	<td><font color="#909090">&nbsp;номер картки</font></td>
</tr>
<tr>
	<td align=right width=100>Клієнт:&nbsp;</td>
	<td width=120><input type='text' name='client' id='client'></td>
	<td><font color="#909090">&nbsp;Прізвище Ім'я Побатькові</font></td>
</tr>
<tr>
	<td align=right width=100>Договір:&nbsp;</td>
	<td width=120><input type='text' name='contractnum' id='contractnum'></td>
	<td><font color="#909090">&nbsp;номер договору</font></td>
</tr>
<tr>
	<td align=right>Дата видачі:&nbsp;</td>
	<td><input type='text' name='raisedate' id='raisedate' onkeydown="sbm.disabled=false;"></td>
	<td><font color="#909090"><i>&nbsp;наприклад 01.03.2010</i></font></td>
</tr>
<tr>
	<td align=right>Ріелтор:&nbsp;</td>
	<td><select name='rieltor' id='rieltor'>
	<option value=0>-</option>
	<?php @getaslist('d_users',$row['user'],'rights>0 and id<>110'); ?>
	</select></td>
	<td><font color="#909090">&nbsp;відповідальний</font></td>
</tr>
<tr>
	<td align=right>Відділення:&nbsp;</td>
	<td><select name='viddil' id='viddil'>
		<option value=1>Фрунзе</option>
		<option value=2>Київська</option>
		<option value=3>Вишенька</option>
		<option value=4>Центральне</option>
	</select></td>
	<td><font color="#909090"></font>
	<input type='hidden' value=0 name='cardid' id='cardid'>
	<input type='hidden' value='add' name='mode' id='mode'>
</td>
</tr>
<tr>
<td align=right>Примітка:&nbsp;</td>
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
<input type="button" value="Добавити картку" onclick="ToAdd();">
<?php
if (!isset($_GET['showdeleted'])) $_GET['showdeleted']=1;
if (!isset($_GET['rieltor'])) $_GET['rieltor']=0;
echo '<input type="hidden" value="'.$_GET['showdeleted'].'" name="showdeleted" id="showdeleted">';
if ($_GET['showdeleted']==1){
echo '<input type="submit" value="Показати знищені" onclick="showdeleted.value=2"> ';
} else {
echo '<input type="submit" value="Заховати знищені" onclick="showdeleted.value=1"> ';
} ?>
<select name=rieltor onchange='form.submit()'>
    <option value=0 <? if ($_GET['rieltor']==0) echo 'SELECTED' ?>>[Фільтр]</option>
    <optgroup label="Відділення">
    <option value=-1 <? if ($_GET['rieltor']==-1) echo 'SELECTED' ?>>Фрунзе</option>
    <option value=-2 <? if ($_GET['rieltor']==-2) echo 'SELECTED' ?>>Київська</option>
    <option value=-3 <? if ($_GET['rieltor']==-3) echo 'SELECTED' ?>>Вишенька</option>
    <option value=-4 <? if ($_GET['rieltor']==-4) echo 'SELECTED' ?>>Центральне</option>
    </optgroup>
    <optgroup label="Ріелтори">
    <?php @getaslist('d_users',$_GET['rieltor'],'rights>0 and id<>110'); ?>
    </optgroup>
</select>
</form>
<div align=center valign=center id="StatusLine"></div>
<table class="mytab" width=98%>
<thead>
<tr style="background-color: #BDCACC"><th>№ картки</th><th>Клієнт</th><th>Дата видачі</th><th>Договір</th><th>Ріелтор</th><th>Відділ</th><th>Операції</th></tr>
</thead>
<tbody>
<?php
$orderby = $_GET['orderby']?$_GET['orderby']:'number';
$a=" where e.deleted<".$_GET['showdeleted'];
if (isset($_GET['rieltor'])) {
    if ($_GET['rieltor']<0) $a.=' and e.viddil='.(0-$_GET['rieltor']);
    else if ($_GET['rieltor']>0) $a.=' and e.rieltor='.$_GET['rieltor'];
}
$sql="select e.id as id,e.number,e.client,date_format(e.raisedate,'%d.%m.%Y'),e.contractnum,u.name,e.rieltor,e.viddil,e.deleted
 from m_cards e LEFT JOIN d_users u ON e.rieltor=u.id".$a.";";
 debug($sql,'$sql');
//echo "<hr>$sql<hr>";
$res=mysql_query($sql);
debug($res,'$res');
$a=1;
$b=array(1=>'Фрунзе',2=>'Київська',3=>'Вишенька',4=>'Центральне');
$npp=0;
if (mysql_num_rows($res)>0){
	while ($row=mysql_fetch_array($res)) {
		debug($row,'$row');
	  $color="<font color=green>";$col="</font>";
	  $del=$row[8];
	  if ($del) $color="<font color=#A7A7A7>";
	  echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
	  echo '<td>'.$color.$row[1].$col.'</td>';
	  echo '<td>'.$color.$row[2].$col.'</td><td>'.$color.$row[3].$col.'</td>';
	  echo '<td>'.$color.$row[4].$col.'</td><td>'.$color.$row[5].$col.'</td>';
	  echo '<td>'.$color.$b[$row[7]].$col.'</td>';
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
}
?>
</tbody></table>
<table width=98%>
<tr><td align="right" colspan="7" style="text-align:right;"><i>
<img class=aimg src="/i/edit.gif"> - змінити
<img class=aimg src="/i/del.gif"> - знищити
<? if (isset($_GET['showdeleted'])){ ?>
<img class=aimg src="/i/undo.gif"> - відновити
<? } ?>
</i></td></tr></table>
<script type='text/javascript'>
clearForm();
$('.mytab').columnFilters({alternateRowClassNames:['row0','row1'], excludeColumns:[6]});
</script>

