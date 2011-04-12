<form method=get>
<input type=hidden name='panel' value='<?=$panel?>'>
<div style="border:0;" id='findforms'>
Номер в базі:
<input type='text' name='nomer' size="3" value='<?=$nomer?>'>

Агент:
<select name='agent' id='agent'>
  <option value=0> </option>
  <?php @getaslist('d_users',$agent,'id<>110'); ?>
</select>

Область:
<select name='obl' id='obl' onChange="loadRgns('rgn','rgn',this.value);">
  <option value=0>Виберіть область</option>
  <?php @getaslist('d_oblasti',$obl,'1=1'); ?>
</select>
Район:
<select name='rgn' id='rgn' onChange="loadRgns('mista','mista',this.value);">
  <option value=0>Виберіть район</option>
  <?php	if ($obl>0) getaslist('d_rgn',$rgn,"parent='$obl'");  ?>
</select>
Населений пункт:
<select name='mista' id='mista' onChange="HideZeroItem('mista');">
  <option value=0>Населений пункт</option>
  <?php
	if ($rgn>0) {$usl="parent='$rgn'";} else {$usl="obl='$obl'";}
	@getaslist('d_mista',$mista,$usl);
  ?>
</select>
<input type='submit' value='Вибрати'>
</div>
</form>
