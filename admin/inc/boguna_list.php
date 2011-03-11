<?if (IsAdmin()):?>
<script language="JavaScript" src="/js/fader.js" type="text/javascript"></script>
<script type='text/javascript'>
/* запрос інфи */
function ToEdit(id) {
  clearForm();
  var rt=getHTTPRequestObject();
  var txt;
  rt.open("POST", "/ajax/getBogunaKvaById.php?id=" + id,false);
  rt.send(null);
  if ( rt.status == 200 ) {
  	txt=rt.responseText.split("{");

  	document.getElementById('id').value=txt[0];
  	document.getElementById('title').innerHTML="Редагуємо: " + txt[0];
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
    document.getElementsByName('prodazh')[0].checked=(txt[12]=="1");;
    document.getElementById('max_folder').value='/i/boguna/'+txt[0]+'/max/';
    document.getElementById('min_folder').value='/i/boguna/'+txt[0]+'/min/';
    document.getElementById('mode').value="edit";
    ClearImages();
    if (txt[13])
    {
      files = txt[13].split(",");
      for (file in files)
      {
        AppendImage(txt[0] + "/min/" + files[file]);
      }
    }
    ShowModal();
  }
}
function ToDel(id)
{
  var iframe = document.getElementById('ifrm');
    iframe.src = "/admin/save/boguna/listitem_del.php?id=" + id;
}

function ToAdd(){
    clearForm();
    ClearImages();
    var rt=getHTTPRequestObject();
    var txt;
    rt.open("POST", "/ajax/getBogunaKvaById.php?id=0",false);
    rt.send(null);
    if ( rt.status == 200 ) {
    	txt=rt.responseText.split("{");
    	document.getElementById('id').value=txt[0];
      }
    document.getElementById('mode').value="add";
    ShowModal();
}

function clearForm() {
  document.forms[0].reset();
  document.forms[1].reset();
	document.getElementById('title').innerHTML="Новий користувач";
  document.getElementById('StatusLine').innerHTML="";
  HideModal();
}

function ShowModal(){
    var ov = document.getElementById("overlay");
    var frm = document.getElementById("formbox")
    ov.style.position="absolute";
    ov.style.top="-1000";
    ov.style.left="-1000";
    ov.style.width="4000";
    ov.style.height="2000";
    if (document.all){
      frm.style.position="absolute";
      frm.style.top=document.body.scrollTop;
      frm.style.left=document.body.scrollLeft;
      ov.style.zIndex="1";
      ov.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity = 80)"
      setInterval("var a=document.getElementById('formbox');a.style.top=document.body.scrollTop-30;a.style.left=document.body.scrollLeft;",30);
    } else {
      ov.style.position="fixed";
      ov.style.top=0;
      ov.style.left=0;
      ov.style.zIndex="1";
      ov.style.opacity=0.8;
      ov.style.MozOpacity = 0.8;
      ov.style.width="100%";
      ov.style.height="100%";
    }
    frm.style.zIndex="2";
    frm.style.display="block";
  }
function HideModal(){
    document.getElementById("formbox").style.display="none";
    var ov = document.getElementById("overlay");
    ov.style.opacity=0;
    ov.style.MozOpacity = 0;
    ov.style.width=0;
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
  newcell.innerHTML = "<img id='imtd" + new_num + "' width='80px' height='80px' src='/i/boguna/" + filename + "' style='margin:5px 2px 0 5px; width:80px; height:80px;'><img src='/i/del.gif' style='position:relative;top:-16px;left:69;width:16px;height:16px;cursor:pointer;' onclick='RemoveImage(\"td" + new_num + "\")'>";
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

function updaterow(row,num,kk,pov,s1,s2,s3,price,prodazh) {
	var tr=document.getElementById('row' + row);
  tr.style.textDecorationLineThrough = (prodazh!="");
	tr.cells[0].innerHTML = num;
  tr.cells[1].innerHTML = kk;
  tr.cells[2].innerHTML = pov;
  tr.cells[3].innerHTML = s1 + '/' + s2 + '/' + s3;
  tr.cells[4].innerHTML = price;
	clearForm();
}

</script>
<div id="overlay" style="display:block;background-color:#000;" onclick="HideModal()" align="center">
<!-- div for hide content -->
</div>
<div id="formbox" style="position:fixed;display:none;background-color: #f0f0f0;z-index:6;width:500px;top:80;border:2px outset gray;">
<!-- div with form -->

<div style="display:block;position:relative;width:100%;height:18px;background-color:blue;">
<h4 id='title' style="text-align:left;color:white;margin-left:5px;">Нова квартира</h4>
<img align='right' src="/i/close.gif" style="position:absolute;top:1px;left:476px" onclick="HideModal()" border=0>
</div>
<div style="border:1px ridge silver;margin:3px; width: 98%; align:center" align="center">
<Form name=mainform method=post action='/admin/save/boguna/listitem.php' target="ifrm" enctype='multipart/form-data'>
<input type='hidden' value=0 name='id' id='id'>
<input type='hidden' value='add' name='mode' id='mode'>
<input type='hidden' value='bog' name='type' id='type'>

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
    <label><input type="checkbox" name="prodazh"><b> Продано</b></label>
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
      <table border=0><tr id="imagesrow"><tr></table>
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

<div style="border:1px solid silver;margin:3px; align:right; padding: 3px" align="right">
<input type='button' value='Записати' onclick="document.forms['mainform'].submit();clearForm();">&nbsp;
<input type='button' value='Вiдмiнити' onclick="clearForm()">
</div>

</div>
<!-- end of div with forms -->

<table width="100%">
  <tr>
    <td width="50%"><h4>Квартири</h4></td>
    <td align="right"><input type="button" value="Добавити" onclick="ToAdd();"></td>
  </tr>
</table>
<table class="mytab" width=100%>
  <tr bgcolor=#BDCACC>
    <th>№</th>
    <th>Кімнат</th>
    <th>Поверх</th>
    <th>Пл.(заг/жит/кух)</th>
    <th>Ціна</th>
    <th>Операції</th>
  </tr>
<?php

if (!isset($pov)) $pov=0;
if (!isset($agent)) $agent=0;
if (!isset($num)) $num=0;
if (!isset($page)) $page=1;

$usl='where type=\'bog\' ';
if ($pov != '0') $usl.=(' and pov='.$pov);
if ($agent != '0') $usl.=(' and kont='.$agent);
if ($num != '0') $usl.=(' and num='.$num);

$sql="Select count(id) from m_bildings $usl";
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);

$perpage=15;
$pagecount=ceil($rowcount/$perpage);
if ($page>$pagecount) $page=1;
if ($pagecount>1) {
	MakePageLinks($page,$pagecount,$rowcount);
}
if ($page!='all')
$sql="Select id, cast, pov, pzag, pzit, pkuh, num, kk, prodazh from m_bildings $usl order by id limit ".(($page-1)*$perpage).','.$perpage.";";
else
$sql="Select id, cast, pov, pzag, pzit, pkuh, num, kk, prodazh from m_bildings $usl order by id;";
//$sql="Select id, cast, pov, pzag, pzit, pkuh, num, kk from m_bildings where id in (389,378,377,290,446,514,78,83,515) order by id";
$res=mysql_query($sql);
$a=1;
while ($row=mysql_fetch_assoc($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row['id'].'"';
  if($row['prodazh']=="1") echo 'style="text-decoration:line-through"';
  echo '>';
	echo '<td>'.$row['num'].'</td><td>'.$row['kk'].'</td><td>'.$row['pov'].'</td><td>'.$row[pzag].'/'.$row[pzit].'/'.$row[pkuh].'</td><td>'.$row['cast'].'</td>';
	echo '<td><img src="./i/edit.gif" onclick="ToEdit('.$row['id'].')" style="cursor:pointer">&nbsp;&nbsp;<img src="./i/del.gif" onclick="ToDel('.$row['id'].')" style="cursor:pointer"></td>';
	echo '</tr>';
}
?>
  <tr>
    <td colspan=6 align=right style="text-align:right"><i><img class=aimg src="./i/edit.gif"> - змінити <img class=aimg src="./i/del.gif">- знищити</i></td>
  </tr>
</table>
<hr>
<div id="StatusLine" style="display:none; position:relative; "></div>
<?else:?>
<h1><center><font color=red>Заборонена зона!</font><br><a href="#" onclick="history.back()">&lt;&lt; Повернутись</a></center><h1>
<?endif?>
<script type='text/javascript'>
clearForm();
</script>