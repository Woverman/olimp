<form method=get action='/admin/admin.php'>
<input type=hidden name='panel' value='<?=$panel?>'>
<div style="border:0;display:none" id='findforms'>
<table cellpadding=4 cellspacing=4 border=0><tr>
<td style="border:1px solid black;text-align:center;background-color:#FFFFCC" width=33%>
����� � ���:<br><br>
<input type='text' name='nomer' value='<?=$nomer?>'><br><br>
<input type='submit' value='�������'>
</td><td style="border:1px solid black;text-align:center;background-color:#FFFFCC" width=33%>
�����:<br><br>
<select name='agent' id='agent'>
  <option value=0> </option>
  <?php @getaslist('d_users',$agent,'id<>110'); ?>
</select><br><br>
<input type='submit' value='�������'>
</td><td style="border:1px solid black;text-align:center;background-color:#FFFFCC" width=33%>
�������:
<select name='obl' id='obl' onChange="loadRgns('rgn','rgn',this.value);">
  <option value=0>������� �������</option>
  <?php @getaslist('d_oblasti',$obl,'1=1'); ?>
</select><br>
�����:
<select name='rgn' id='rgn' onChange="loadRgns('mista','mista',this.value);">
  <option value=0>������� �����</option>
  <?php	if ($obl>0) getaslist('d_rgn',$rgn,"parent='$obl'");  ?>
</select><br>
��������� �����:
<select name='mista' id='mista' onChange="HideZeroItem('mista');">
  <option value=0>��������� �����</option>
  <?php
	if ($rgn>0) {$usl="parent='$rgn'";} else {$usl="obl='$obl'";}
	@getaslist('d_mista',$mista,$usl); 
  ?>
</select><br>
<input type='submit' value='�������'>
</td></tr></table>
</div>
