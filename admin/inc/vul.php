<script type='text/javascript'>
function ToEdit(row) {
	var tr=document.getElementById(row);
	document.getElementById('title').innerHTML="��������: " + tr.cells[0].innerHTML;		
	with (document.getElementById('vul')) {
		value=tr.cells[1].innerHTML;
		focus();
	}
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="edit";
}
function ToDel(row) {
	var tr=document.getElementById(row);
	if (confirm("������� "+tr.cells[1].innerHTML+"?"))	{
	clearForm();
	document.getElementById('uid').value=tr.cells[0].innerHTML;
	document.getElementById('mode').value="del";
	document.forms['mainform'].submit();
	}
}
function clearForm() {
	document.getElementById('title').innerHTML='���� ������:';
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
<form method=get action='/admin/admin.php'>
<input type=hidden name=panel value=vul>
<input type=hidden id='noinfo' name='noinfo' value="<?=@$_GET['noinfo']?>">
<?
if (@$_GET['noinfo']!=1) infodiv("�� ������� ���������� ���� ��� ����������� � �������� ������. ��� ������ ������������ ����������� ��� ������� ����� ��'���� ����������.<br>&nbsp;&nbsp;&nbsp;&nbsp;������ ��� ����� ������������ ��������.");
?>
<select name='parent' onchange='form.submit()'>
  <?php
    $sql="Select distinct(parent) from d_vul";
    $res=mysql_query($sql);
    while ($res1=mysql_fetch_row($res)){
       $res2[]=$res1[0];
       }
    $parents=implode(",",$res2);
    @getaslist('d_mista',$parent,'id in ('.$parents.')');
  ?>
</select>
</form>
<table class="mytab" width=98%>
<tr bgcolor=#BDCACC><th>�</th><th>������</th><th>��������</th></tr>
<?php
$sql="Select count(id) from d_vul where parent=".$parent;
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
if ($rowcount>0) {
$perpage=15;
$pagecount=ceil($rowcount/$perpage);
if ($page>$pagecount) $page=1;
MakePageLinks($page,$pagecount,$rowcount);
$sql="Select id,name from d_vul where parent=".$parent." order by id asc limit ".(($page-1)*$perpage).','.$perpage.";";
$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_array($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
	echo '<td>';
	echo '<a href="javascript:ToEdit(\'row'.$row[0].'\')"><img class=aimg src="./i/edit.gif"></a>';
	echo '<a href="javascript:ToDel(\'row'.$row[0].'\')"><img class=aimg src="./i/del.gif"></a>';
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
<tr><th colspan=2><h4 id='title' style="text-align:left">���� ������:</h4></th><td align=right><i><img class=aimg src="./i/edit.gif"> - ������ <img class=aimg src="./i/del.gif"> - �������</i></td></tr>
<tr>
<td align=right width=100>������:</td>
<td width=120><input type='text' name='vul' id='vul' onkeydown="sbm.disabled=false;"></td>
<td rowspan=2 align=center valign=center id="StatusLine"></td>
</tr>
<tr><td colspan=2 align=right><input id="sbm" type='submit' value='��������'> <input type='reset' value='³������' onclick="clearForm()"></td></tr>
</table>
</form>
<script type='text/javascript'>
clearForm();
</script>
