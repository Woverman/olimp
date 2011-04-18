<?php
// save values to database
if (isset($_GET['mode'])) {
	$mode=$_GET['mode'];
	if ($mode=='edit') {			// 'Save exist'
		mysql_unbuffered_query("Update d_rgn set name='".$_GET['rgn']."' where id=".$_GET['uid']);
	} elseif ($mode=='add') {		// 'Create new'
		mysql_unbuffered_query("Insert into d_rgn (name,parent) values ('".$_GET['rgn']."','".$_GET['obl']."')");
	} elseif ($mode=='del') {		// 'Delete exist'
		mysql_unbuffered_query("Delete from d_rgn where id=".$_GET['uid']);
	} elseif ($mode=='setdef') {
	    mysql_unbuffered_query('update d_rgn set def=0 where parent='.$_GET['obl']);
	    mysql_unbuffered_query('update d_rgn set def=1 where id='.$_GET['id'].';');
	    //echo mysql_error();
    }

}
?>
<script type='text/javascript'>
function ToEdit(row) {
	var tr=document.getElementById(row);
	document.getElementById('title').innerHTML="Редагуємо: " + tr.cells[0].innerHTML;
	document.getElementById('rgn').value=tr.cells[1].innerHTML;
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="edit";
	document.getElementById('rgn').focus();
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
	document.getElementById('title').innerHTML='Новий район:';
	document.getElementById('uid').value='0';
	document.getElementById('rgn').value='';
	document.getElementById('mode').value='add';
	document.getElementById('rgn').focus();
}
</script>
<? 
$obl=1;
if (isset($_GET['obl'])) $obl=$_GET['obl']; ?>
<form method=get>
<select name='obl' onchange='form.submit()'>
  <?php @getaslist('d_oblasti',$obl,'1=1'); ?>
</select>
</form>
<table class="mytab" width=100%>
<tr style="background-color: #BDCACC"><th>№</th><th>Район</th><th>Міста</th><th>Операції</th></tr>
<?php

$sql="Select count(id) from d_rgn where parent=".$obl;
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
$sql="Select * from d_rgn where parent=".$obl." order by id asc;";
$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_array($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
	echo '<td><a href="/admin/gor/?obl='.$obl.'&rgn='.$row[0].'">Міста</td>';
  echo '<td>';
  echo '<a href="javascript:ToEdit(\'row'.$row[0].'\')"><img class=aimg src="/i/edit.gif"></a>';
  echo '<a href="javascript:ToDel(\'row'.$row[0].'\')"><img class=aimg src="/i/del.gif"></a>';
  echo '<a href=?panel=rgn&mode=setdef&id='.$row['id'].'&obl='.$row['parent'].'><img class=aimg src="/i/'.($row['def']==1?'on':'off').'.gif"></a>';
  echo '</td>';
	echo '</tr>';
}
?>
</table>

<Form method=get name='mainform'>
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<input type='hidden' value='<?=$obl?>' name='obl'>
<table border=0>
<tr><th colspan=2><h4 id='title'>Новий район:</h4></th></tr>
<tr><td align=right>Район:</td><td><input type='text' name='rgn' id='rgn'></td></tr>
<tr><td colspan=2 align=right><input type='submit' value='Save'> <input type='reset' value='Reset' onclick="clearForm()"></td></tr>
</table>
</form>
<script type='text/javascript'>
clearForm();
</script>
