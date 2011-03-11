<?php
// save values to database
if (isset($_POST['mode'])) {
	$mode=$_POST['mode'];
	if ($mode=='edit') {			//'Save exist'
		mysql_unbuffered_query("Update d_mista set name='".$_POST['gor']."' where id=".$_POST['uid']);
	} elseif ($mode=='add') {		//'Create new'
		mysql_unbuffered_query("Insert into d_mista (name,parent,obl) values ('".$_POST['gor']."','".$_POST['rgn']."','".$_POST['obl']."')");
	} elseif ($mode=='del') {		// 'Delete exist'
		mysql_unbuffered_query("Delete from d_mista where id=".$_POST['uid']);
	}
}
?>
<script type='text/javascript'>
function ToEdit(row) {
	var tr=row.parentNode.parentNode;
	document.getElementById('title').innerHTML="Редагуємо: " + tr.cells[0].innerHTML;		document.getElementById('gor').value=tr.cells[1].innerHTML;
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="edit";
	document.forms[0].focus();
}
function ToDel(row) {
	var tr=row.parentNode.parentNode;
	if (confirm("Знищити "+tr.cells[1].innerHTML+"?"))
	{
	clearForm();
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="del";
	document.forms[0].submit();
	}
}
function clearForm() {
	document.getElementById('title').innerHTML='Новий насел. пункт:';
	document.getElementById('uid').value='0';
	document.getElementById('gor').value='';
	document.getElementById('mode').value='add';
}
</script>
<form method=get action='/admin/admin.php'>
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

<!-- &nbsp;<input type=submit value='Оновити'> -->
</form>
<?php
$sql="Select count(id) from d_mista where parent=".$rgn;
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
if (!isset($page)) $page=1;
$perpage=15;
$pagecount=ceil($rowcount/$perpage);
if ($page>$pagecount) $page=1;
if ($pagecount>1) MakePageLinks($page,$pagecount,$rowcount);
$sql="Select id,name from d_mista where parent=".$rgn." order by id asc limit ".(($page-1)*$perpage).','.$perpage.";";
$res=mysql_query($sql);
$a=1;
?>
<table class="mytab" width=98%>
<tr bgcolor=#BDCACC><th>№</th><th>Нас. пункт</th><th>Правка</th><th>Знищити</th></tr>
<?php
while ($row=mysql_fetch_row($res)) {
	echo '<tr class="row'.$a=abs($a-1).'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
	echo '<td><img src="./i/edit.gif" onclick="ToEdit(this)" style="cursor:pointer"></td>';
	echo '<td><img src="./i/del.gif" onclick="ToDel(this)" style="cursor:pointer"></td>';
	echo '</tr>';
}
?>
</table>

<Form method=post> <!-- action='/admin/editgor.php'> -->
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<input type='hidden' value="<?=$obl?>" name='obl'>
<input type='hidden' value="<?=$rgn?>" name='rgn'>
<input type='hidden' value="<?=$page?>" name='page'>
<table border=0>
<tr><th colspan=2><h4 id='title'>Новий насел. пункт:</h4></th></tr>
<tr><td align=right>Назва:</td><td><input type='text' name='gor' id='gor' value=''></td></tr>
<tr><td colspan=2 align=right><input type='submit' value='Save'> <input type='reset' value='Reset' onclick="clearForm()"></td></tr>
</table>
</form>
<script type='text/javascript'>
clearForm();
</script>
