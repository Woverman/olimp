<?php
// save values to database
debug($_GET,"GET");
debug($_POST,"POST");
if (isset($_GET['mode'])) {
	$mode=$_GET['mode'];
	if ($mode=='edit') {			//'Save exist'
		mysql_unbuffered_query("Update d_dist set name='".$_GET['dist']."' where id=".$_GET['uid']);
	} elseif ($mode=='add') {		//'Create new'
		mysql_unbuffered_query("Insert into d_dist (name) values ('".$_GET['dist']."')");
	} elseif ($mode=='del') {		// 'Delete exist'
		mysql_unbuffered_query("Delete from d_dist where id=".$_GET['uid']);
	}
}
?>
<script type='text/javascript'>
function ToEdit(row) {
	var tr=row.parentNode.parentNode;
	document.getElementById('title').innerHTML="Редагуємо: " + tr.cells[0].innerHTML;
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('dist').value=tr.cells[1].innerHTML;
	document.getElementById('mode').value="edit";
	document.forms[0].focus();
}
function ToDel(row) {
	var tr=row.parentNode.parentNode;
	if (confirm("Знищити "+tr.cells[1].innerHTML+"?"))
	{
	clearForm();
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('dist').value=tr.cells[1].innerHTML;
	document.getElementById('mode').value="del";
	document.forms[0].submit();
	}
}
function clearForm() {
	document.getElementById('title').innerHTML='Новий район:';
	document.getElementById('uid').value='0';
	document.getElementById('mode').value='add';
}
</script>
<!--<form method=get>
<?
$obl=1;
if (isset($_GET['obl'])) $obl=$_GET['obl']; ?>
<input type=hidden name=panel value=gor>
<select name='obl' onchange='form.submit()'>
  <?php @getaslist('d_oblasti',$obl,'1=1'); ?>
</select>
<?
$rgn=1;
if (isset($_GET['rgn'])) $rgn=$_GET['rgn']; ?>
<select name='rgn' onchange='form.submit()'>
  <?php @getaslist('d_rgn',$rgn,"parent='$obl'"); ?>
</select>
</form>-->
<?php
$sql="Select id,name from d_dist order by `name` asc;";
$res=mysql_query($sql);
$a=1;
?>
<table class="mytab" width=100%>
<tr style="background-color: #BDCACC"><th>№</th><th>Район</th><th>Правка</th><th>Знищити</th></tr>
<?php
while ($row=mysql_fetch_row($res)) {
	echo '<tr class="row'.$a=abs($a-1).'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
	echo '<td><img src="/i/edit.gif" onclick="ToEdit(this)" style="cursor:pointer"></td>';
	echo '<td><img src="/i/del.gif" onclick="ToDel(this)" style="cursor:pointer"></td>';
	echo '</tr>';
}
?>
</table>

<Form method=GET>

<table border=0>
<tr><th colspan=2><h4 id='title'>Новий район:</h4></th></tr>
<tr><td align=right>Назва:</td><td><input type='text' name='dist' id='dist' value=''></td></tr>
<tr><td colspan=2 align=right><input type='submit' value='Save'> <input type='reset' value='Reset' onclick="clearForm()"></td></tr>
</table>
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
</form>

