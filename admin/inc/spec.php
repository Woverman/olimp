<?php
// save values to database
if (isset($_POST['mode'])) {
	$mode=$_POST['mode'];
	if ($mode=='edit') {			//'Save exist'
		mysql_unbuffered_query("Update d_oblasti set name='".$_POST['obl']."' where id=".$_POST['uid']);
	} elseif ($mode=='add') {		//'Create new'
		mysql_unbuffered_query("Insert into d_oblasti (name) values ('".$_POST['obl']."')");
	} elseif ($mode=='del') {		// 'Delete exist'
		mysql_unbuffered_query("Delete from d_oblasti where id=".$_POST['uid']);
	}
}
// end of save values to database or delete
?>

<script type='text/javascript'>
function ToEdit(row) {
	var tr=document.getElementById(row);
	document.getElementById('title').innerHTML="Редагуємо: " + tr.cells[0].innerHTML;		document.getElementById('obl').value=tr.cells[1].innerHTML;
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="edit";
	document.forms[0].focus();
}
function ToDel(row) {
	var tr=document.getElementById(row);
	if (confirm("Знищити "+tr.cells[1].innerHTML+"?"))	{
	clearForm();
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="del";
	document.forms[0].submit();
	}
}
function clearForm() {
	document.getElementById('title').innerHTML='Нова область:';
	document.getElementById('uid').value='0';
	document.getElementById('obl').value='';
	document.getElementById('mode').value='add';
}
</script>
<div style="border:1px solid #BFBFBF;padding:2px;margin:2px">
<?if (@$_REQUEST['mode']=="add" || @$_REQUEST['mode']=="edit"){?>
<a href=/admin/spec/><button style="height: 40px"><img class=bimg src="/i/list.png">Повернутись до списку</button></a>
<button style="height: 40px" onclick="validform(); return(false);"><img class=bimg src="/i/save.png">Створити проект</button>
<?}else{?>
<a href=/admin/spec/?mode=add><button style="height: 40px"><img class=bimg src="/i/add.png">Новий проект...</button></a>
<?}?>
</div>
<table width=100% class="mytab">
<tr style="background-color: #BDCACC"><th>№</th><th>Назва</th><th>Титулка</th><th>Об'єкти</th><th>Банери</th><th>Етапи</th><th>Операції</th></tr>
<?php

if (isset($_GET['mode'])){
  if ($_GET['mode']=='setdef') {
    mysql_unbuffered_query('update d_oblasti set def=0;');
    mysql_unbuffered_query('update d_oblasti set def=1 where id='.$_GET['id'].';');
    echo mysql_error();
    }
  } else {
	$a=1;
	$sql="Select * from m_projects order by id";
	$res=mysql_query($sql);
	while ($row=mysql_fetch_array($res)){
		echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
		echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
		echo '<td><a href=/admin/pageedit/?mode=edit&back=1&pid='.$row[2].'>Титулка</a></td>';
		echo '<td><a href=/admin/prjitems/?pid='.$row[0].'>Об\'єкти</a></td>';
		echo '<td><a href=/admin/photos/?folder=proj'.$row[0].'>Банери</a></td>';
		echo '<td>'.$row[3].'</td>';
		echo '<td>';
	    echo '<a href="javascript:ToEdit(\'row'.$row[0].'\')"><img class=aimg src="/i/edit.gif"></a>';
		echo '<a href="javascript:ToDel(\'row'.$row[0].'\')"><img class=aimg src="/i/del.gif"></a>';
	    echo '<a href=/admin/admin.php?panel=obl&mode=setdef&id='.$row['id'].'><img class=aimg src="/i/'.($row['def']==1?'on':'off').'.gif"></a>';
	    echo '</td>';
		echo '</tr>';
	}
  }
?>
</table>
<hr>
<!--
<Form method=post>
<input type='hidden' value=0 name='uid' id='uid'>
<input type='hidden' value='add' name='mode' id='mode'>
<table border=0>
<tr><th colspan=2><h4 id='title'>Нова область:</h4></th></tr>
<tr><td align=right>Область:</td><td><input type='text' name='obl' id='obl'></td></tr>
<tr><td colspan=2 align=right><input type='submit' value='Save'> <input type='reset' value='Reset' onclick="clearForm()"></td></tr>
</table>
</form>
<script type='text/javascript'>
clearForm();
</script>-->
