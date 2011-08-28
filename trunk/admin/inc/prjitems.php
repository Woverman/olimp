<script type='text/javascript'>
/* запрос інфи */
function ToEdit(id) {
  clearForm();
  $.get("/ajax/getObjectById.php?id=" + id,"",function(data){
	txt=$.trim(data).split("{");
  	$('#id').val(txt[0]);
  	document.getElementsByName('num')[0].value=txt[6];
    document.getElementsByName('cast')[0].value=txt[1];
    document.getElementsByName('valuta')[0].value=txt[10];
    document.getElementsByName('casttype')[0].value=txt[11];
  	document.getElementsByName('pov')[0].value=txt[2];
  	document.getElementsByName('kk')[0].value=txt[7];
  	document.getElementsByName('pzag')[0].value=txt[3];
  	document.getElementsByName('pzit')[0].value=txt[4];
  	document.getElementsByName('pkuh')[0].value=txt[5];
  	document.getElementsByName('kont')[0].value=txt[8];
  	document.getElementsByName('comment')[0].value=txt[9];
    document.getElementsByName('prodano')[0].checked=(txt[12]=="1");;
    $('#max_folder').val('/i/obj/'+txt[0]+'/max/');
    $('#min_folder').val('/i/obj/'+txt[0]+'/min/');
    ClearImages();
    if (txt[13])
    {
      files = txt[13].split(",");
      for (file in files)
      {
        AppendImage(txt[0] + "/min/" + files[file]);
      }
    }
    $("#formbox").dialog({
    	title:"Редагуємо: " + txt[0],
		width:'500px',
		buttons: [
			    {text: "Зберегти", click: function() { SaveObject();$(this).dialog("close"); } },
			    {text: "Закрити", click: function() { $(this).dialog("close"); } }
		]})
  })
}

function SaveObject(){
	var data = $('#editform').serialize();
	$.post("/admin/save/boguna/listitem.php",data,function(data){location.reload(true)});
}

function ToDel(id) {
//  var iframe = document.getElementById('ifrm');
//    iframe.src = "/admin/save/boguna/listitem_del.php?id=" + id;
}

function ToAdd(){
	//ToEdit(0);
    clearForm();
    ClearImages();
	$.get("/ajax/getObjectById.php?id=0","",function(data){
		txt=data.split("{");
  		$('#id').val(txt[0]);
    	//$('#mode').val("add");
		$("#formbox").dialog({
			title:"Новий об'єкт",
			width:"500px",
			buttons: [
			    {text: "Зберегти", click: function() {SaveObject(); $(this).dialog("close"); } },
			    {text: "Закрити", click: function() { $(this).dialog("close"); } }
			]});
	});
}

function clearForm() {
  document.forms[0].reset();
  document.forms[1].reset();
}

function HideModal(){
	$("#formbox").dialog('close');
  }

function loaded(fname)
{
  file = document.getElementById('id').value + '/min/' + fname;
  AppendImage(file);
  document.forms[1].reset();
}

function AppendImage(filename)
{
  var row = document.getElementById("imagesrow");
  var new_num = row.cells.length;
  var newcell = row.insertCell(new_num);
  newcell.width="86px";
  newcell.valign="top";
  newcell.id = "td" + new_num;
  newcell.innerHTML = "<img id='imtd" + new_num + "' width='80px' height='80px' src='/i/obj/" + filename + "' style='margin:5px 2px 0 5px; width:80px; height:80px;'><img src='/i/del.gif' style='position:relative;top:-16px;left:69;width:16px;height:16px;cursor:pointer;' onclick='RemoveImage(\"td" + new_num + "\")'>";
}

function RemoveImage(cellid)
{
  var row = document.getElementById("imagesrow");
  var cell = document.getElementById(cellid);
  var num_td=cell.cellIndex;
  if (confirm("Знищити фото?"))
  {
    var img = document.getElementById('im'+cellid).src.replace(/\//ig,",");
    var iframe = document.getElementById('ifrm');
    iframe.src = "/admin/save/killimage.php?file=" + img;
    row.deleteCell(num_td);
  }
}

function ClearImages()
{
  var row = document.getElementById("imagesrow");
  while (row.cells.length>0)
    {row.deleteCell(0);}
}

function updaterow(row,num,kk,pov,s1,s2,s3,price,prodano) {
	var tr=document.getElementById('row' + row);
	tr.style.textDecorationLineThrough = (prodano=="1");
	tr.cells[0].innerHTML = num;
  	tr.cells[1].innerHTML = kk;
  	tr.cells[2].innerHTML = pov;
  	tr.cells[3].innerHTML = s1 + '/' + s2 + '/' + s3;
  	tr.cells[4].innerHTML = price;
	clearForm();
}

</script>
<div id="formbox" style="display:none;">
<!-- div with form -->
<div>
<Form id="editform">
<input type='hidden' value=0 name='id' id='id'>
<input type='hidden' value='kva' name='type' id='type'>
<input type='hidden' value='<?=$_GET['pid']?>' name='proj' id='proj'>
<table border=0 width=100%>
<tr>
  <td align=right><b>Номер в базі</b></td>
  <td><input type='text' name='num'></td>
</tr>
<tr>
  <td align=right><b>Поверх</b></td>
  <td><input type='text' name='pov' size=3></td>
</tr>
<tr>
	<td align=right><b>Площа м<sup style='font-size:11px'>2</sup> (заг./житл./кухня)</b></td>
	<td>
		<input type='text' name='pzag' size=3> /
		<input type='text' name='pzit' size=3> /
		<input type='text' name='pkuh' size=3>
	</td>
</tr>
<tr>
	<td align=right><b>Кількість кімнат</b></td>
	<td>
	<select name='kk'>
		<option value=0 selected>Оберіть</option>
		<option value="1">1-кімнатна</option>
		<option value="2">2-кімнатна</option>
		<option value="3">3-кімнатна</option>
		<option value="4">4-кімнатна</option>
		<option value="5">парковка</option>
	</select>
	</td>
</tr>
<tr>
	<td align=right><b>Ціна</b></td>
	<td>
    <input type='text' name='cast' style='width:70px'>
  	<select name='valuta'  style='width:40px'>
  		<option value=1>грн.</option>
  		<option value=2 selected="selected"> $ </option>
  		<option value=3> &euro; </option>
  	</select>
    <select name='casttype'  style='width:60px'>
  			<option value=1 selected="selected">за все</option>
  			<option value=2> за м<sup>2</sup> </option>
  	</select>
	</td>
</tr>
<tr>
  <td align=right><b>Контактна особа</b></td>
  <td>
  <select name='kont' id='kont'>
    <option value=0> </option>
    <?php @getaslist('d_users',$kont,'id<>110'); ?>
  </select>
  </td>
</tr>
<tr>
  <td></td><td align=дуае>
    <label><input type="checkbox" name="prodano"><b> Продано</b></label>
  </td>
</tr>
<tr>
  <td valign="top" colspan=2 align="center"><b>Короткий коментар:</b><br>
		<textarea name="comment" cols="57" rows="5"></textarea>
</td>
</tr>
</table>
</form>
</div>
<div id="fotos" style="border:1px ridge silver;margin:3px; width: 98%; align:center" align="center">
&nbsp;&nbsp;&nbsp;<b>Фото:</b>
  <div id=container style="background-color: #BBBBBB; overflow: scroll; width: 88%; height:110px; overflow-y:hidden">
    <div id=slider style="background-color: #BBBBBB; overflow: visible; display:inline;">
      <table border=0><tr id="imagesrow"></tr></table>
    </div>
  </div>
<table border=0 width=100%>
<tr><td align=right><b>Нове фото:</b></td><td>
<form name=fotoupload method=post action='/admin/save/uploadimage.php' target="ifrm" enctype='multipart/form-data'>
  <input type="hidden" name="max_folder" id="max_folder" value="">
  <input type="hidden" name="min_folder" id="min_folder" value="">
  <input type="hidden" name="max_width" value="800">
  <input type="hidden" name="max_height" value="560">
  <input type="hidden" name="min_width" value="236">
  <input type="hidden" name="min_height" value="182">
  <input type="hidden" name="callback" value="loaded">
  <input type='file' name='foto' id='foto' size="35"><input type="Submit" value="Загрузити">
</form>
</td></tr>
</table>
</div>

<!--<div style="border:1px solid silver;margin:3px; align:right; padding: 3px" align="right">
<input type='button' value='Записати' onclick="document.forms['mainform'].submit();clearForm();">&nbsp;
<input type='button' value='Вiдмiнити' onclick="clearForm()">
</div>
-->
</div>
<!-- end of div with forms -->

<table width="100%">
  <tr>
    <td width="50%"><h4>Квартири</h4></td>
    <td align="right"><input type="button" value="Добавити" onclick="ToAdd();"></td>
  </tr>
</table>
<table class="mytab" width=100%>
  <tr style="background-color: #BDCACC">
    <th>№</th>
    <th>Кімнат</th>
    <th>Поверх</th>
    <th>Пл.(заг/жит/кух)</th>
    <th>Ціна</th>
    <th>Операції</th>
  </tr>
<?php

$pid = ($_GET['pid']?$_GET['pid']:"1"); //project id
if (!isset($pov)) $pov=0;
if (!isset($agent)) $agent=0;
if (!isset($num)) $num=0;

$usl='where proj=\''.$pid.'\' ';
if ($pov != '0') $usl.=(' and pov='.$pov);
if ($agent != '0') $usl.=(' and kont='.$agent);
if ($num != '0') $usl.=(' and num='.$num);

$sql="Select count(id) from m_bildings $usl";
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);

$sql="Select id, cast, pov, pzag, pzit, pkuh, num, kk, prodano from m_bildings $usl order by id;";
$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_assoc($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'"';
  if($row['prodano']=="1") echo 'style="text-decoration:line-through"';
  echo '>';
	echo '<td>'.$row['num'].'</td><td>'.$row['kk'].'</td><td>'.$row['pov'].'</td><td>'.$row[pzag].'/'.$row[pzit].'/'.$row[pkuh].'</td><td>'.$row['cast'].'</td>';
	echo '<td><img src="/i/edit.gif" onclick="ToEdit('.$row['id'].')" style="cursor:pointer;margin-right:10px;"><img src="/i/del.gif" onclick="ToDel('.$row['id'].')" style="cursor:pointer"></td>';
	echo '</tr>';
}
?>
</table>
<hr>