<script type='text/javascript'>
function ToEdit(row) {
	var tr=document.getElementById(row);
	document.getElementById('title').innerHTML="Редагуємо: " + tr.cells[0].innerHTML;		
	with (document.getElementById('vul')) {
		value=tr.cells[1].innerHTML;
		focus();
	}
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="edit";
}
function ToDel(row) {
	var tr=document.getElementById(row);
	if (confirm("Знищити "+tr.cells[1].innerHTML+"?"))	{
	clearForm();
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="del";
	document.forms['mainform'].submit();
	}
}
function clearForm() {
	document.getElementById('title').innerHTML='Нова вулиця:';
	document.getElementById('uid').value='0';
	document.getElementById('vul').value='';
	document.getElementById('mode').value='add';
	document.getElementById('sbm').disabled=true;
}
function updaterow(row,vulname) {
	var tr=document.getElementById('row' + row);
	tr.cells[1].innerHTML = vulname;
	clearForm();
}
</script>
<? 
$parent=1063;
$page=1;
if (isset($_GET['parent'])) $parent=$_GET['parent'];
if (isset($_GET['page'])) $page=$_GET['page']; 
?>
<form method=get>
<input type=hidden name=panel value=vul>
<input type=hidden id='noinfo' name='noinfo' value="<?=@$_GET['noinfo']?>">
<?
if (@$_GET['noinfo']!=1) infodiv("Ця сторінка призначена лише для редагування і знищення вулиць. Нові вулиці добавляються автоматично при внесенні нових об'єктів нерухомості.<br>&nbsp;&nbsp;&nbsp;&nbsp;Список міст також поповнюється динамічно.");
?>
<select name='parent' onchange='form.submit()'>
  <?php
    $sql="Select distinct(parent) from d_vul";
    @getaslist('d_mista',$parent,'id in ('.$sql.')');
  ?>
</select>
</form>
<table class="mytab" width=100%>
<tr style="background-color: #BDCACC"><th>№</th><th>Вулиця</th><th>Операції</th></tr>
<?php
$sql="Select count(id) from d_vul where parent=".$parent;
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
if ($rowcount>0) {
$sql="Select id,name from d_vul where parent=".$parent." order by id asc;";
$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_array($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
	echo '<td>';
	echo '<a href="javascript:ToEdit(\'row'.$row[0].'\')"><img class=aimg src="/i/edit.png"></a>';
	echo '<a href="javascript:ToDel(\'row'.$row[0].'\')"><img class=aimg src="/i/delete.png"></a>';
	echo '</td>';
	echo '</tr>';
}}
?>
</table>
<hr>
<Form method=post action='/admin/editvul.php' name='mainform' target="ifrm" style="border:1px dotted gray">
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<input type='hidden' value='<?=$page?>' name='page'>
<input type='hidden' value='1063' name='parent'>
<table border=0 width=100%>
<tr><th colspan=2><h4 id='title' style="text-align:left">Нова вулиця:</h4></th><td align=right><i><img class=aimg src="./i/edit.gif"> - змінити <img class=aimg src="./i/del.gif"> - знищити</i></td></tr>
<tr>
<td align=right width=100>Вулиця:</td>
<td width=120><input type='text' name='vul' id='vul' onkeydown="sbm.disabled=false;"></td>
<td rowspan=2 align=center valign=center id="StatusLine"></td>
</tr>
<tr><td colspan=2 align=right><input id="sbm" type='submit' value='Зберегти'> <input type='reset' value='Відмінити' onclick="clearForm()"></td></tr>
</table>
</form>
<script type='text/javascript'>
clearForm();
</script>
