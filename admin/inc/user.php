<script type='text/javascript'>
/* запрос інфи */
var selectedID = 0;
function ToEdit(id) {
  selectedID=id;
  clearForm();
  var txt;
  $('#mode').val("edit");
  $.get("/ajax/getById.php?tbl=d_users&id=" + id,function(data){
  	txt=data.split("{");
  	$('#uid').val(txt[0]);
  	$('#login').val(txt[1]);
  	$('#title').text("Редагуємо: " + txt[5]);
  	$('#longname').val(txt[5]);
	$('#locked').attr('checked',txt[4]=="1");
 	$('#posada').val(txt[8]);
  	$('#phone1').val(txt[9]);
  	$('#phone2').val(txt[10]);
  	$('#phone3').val(txt[11]);
  	$('#phone4').val(txt[12]);
  	$('#email').val(txt[13]);
    $('#otdel').val(txt[14]);
  	$('#rights').val(txt[3]);
    LoadNewImage('userfoto','-'+txt[0],1,2);
	//document.images['userfoto'].src='/i/users-p/'+txt[0]+'.jpg';
    ShowModal();
  });
}
function ToAdd(){
	selectedID=0;
    clearForm();
    ShowModal();
}
/* запит на знищення */
function ToDel(id) {
	selectedID=id;
	clearForm();
	$('#uid').val(id);
	$('#mode').val("del");
	saveUserData();
}

function saveUserData(){
	var s = $('form').serialize();
	$.post("/ajax/edituser.php",s,function(data){
		var r=data.split(":");
		id = $.trim(r[1]);
		if (id=='error') alert(r[0],id);
		else{
			switch($.trim(r[0])){
				case "error":
					alert(id);
					break
				case "add":
					var row = $("#tblMain tbody tr:nth-child(2)").clone(true).attr("id","row"+id).prependTo( $("#tblMain tbody"));
					updaterow(row,id);
					//alert("Нового користувача додано.");
					break
				case "edit":
					var row = $("#row"+id);
					updaterow(row,id);
					//alert("Зміни внесено успішно.");
					break
				case "del":
					$("#row"+id).remove();
					//alert("Користувача видалено.");
					break
			}
		}
		HideModal();
	})
}
function clearForm() {
	document.forms[0].reset();
	$('#title').text("Новий користувач");
	$('#StatusLine').text("");
	$('#mode').val("add");
	HideModal();
}
function updaterow(row,id){
	var role=["Адмін","Оператор","Ріелтор"];
	var locked = ( $("#locked").is(':checked'))?1:0;
	$(row).children().get(0).textContent=id;
	$(row).children().get(1).textContent=$("#login").val();
	$(row).children().get(2).textContent=$("#longname").val();
	$(row).children().get(3).textContent=role[$("#rights :selected").val()];
	$($(row).children().find("img").get(0))
		.attr("src","/i/lock"+locked+".png")
		.attr("id","lock"+id)
		.attr("title",locked?'Заблокований':'Активний');
	$($(row).children().find("img").get(1)).click(function(){ToEdit(id)});
	$($(row).children().find("img").get(2)).click(function(){ToDel(id)});
}
function EditFoto(){
	$('[name=userID]').val($('#uid').val());
	$('#overlay2').css('z-index','10002').show();
	$('#form2box').css({
   		position:'fixed',
   		left: ($(window).width() - $('#form2box').outerWidth())/2,
   		top: ($(window).height() - $('#form2box').outerHeight())/2
   	}).show();
}
function fotoloaded(img){
	$('#form2box').hide();
	$('#overlay2').hide();
	$('#userfoto').attr('src','');
	$('#userfoto').attr('src','/i/users-p/'+img);
	//LoadNewImage('userfoto','-'+$('#uid').val(),1,2);
}
function ShowModal(){
	$('#overlay').show();
	$('#formbox').css({
   		position:'fixed',
   		left: ($(window).width() - $('#formbox').outerWidth())/2,
   		top: ($(window).height() - $('#formbox').outerHeight())/2
   	}).show();
	$('#dialogTitle').drag();
  }
function HideModal(){
   	$('#overlay').hide();
	$('#formbox').hide();
  }
</script>

<button style="height: 40px;" onclick="ToAdd();"><img class="bimg" src="/i/add.png"> Додати нового спiвробiтника...</button>
<table class="mytab" id="tblMain" width=100%>
<thead><tr style="background-color: #BDCACC"><th>№</th><th>Логін</th><th>Ім'я</th><th>Права</th><th>Блок</th><th>Операції</th></tr></thead>
<tbody>
<?php
$sql="Select count(id) from d_users where login<>'serg'";
$res=mysql_query($sql);
$rowcount=mysql_result($res,0);
$sql="Select * from d_users where login<>'serg' order by id asc";
$res=mysql_query($sql);
$a=1;
$role[0]="Адмін";
$role[1]="Оператор";
$role[2]="Ріелтор";
while ($row=mysql_fetch_row($res)) {
	echo '<tr class="row'.$a=abs($a-1).'" id="row'.$row[0].'">';
	echo '<td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[5].'</td><td>'.$role[$row[3]].'</td><td title='.$row[4].'><img src=/i/lock'.$row[4].'.png id="lock'.$row[0].'" title="'.($row[4]==1?'Заблокований':'Активний').'"></td>';
	echo '<td><img src="/i/edit.png" onclick="ToEdit('.$row[0].')" style="cursor:pointer" title="Редагувати">&nbsp;&nbsp;<img src="/i/delete.png" onclick="ToDel('.$row[0].')" style="cursor:pointer" title="Видалити"></td>';
	echo '</tr>';
}
?>
</tbody></table>
<hr>
<div id="StatusLine"></div>
<div id="overlay"></div>
<div id="formbox" class="moveable" style="display:none;background-color: #DFDFDF;border:1px solid #FEFEFE; ">
	<div id="dialogTitle"><span id="title">Новий користувач:</span>
	    <img src="/i/window_close.png" width="24" onclick="HideModal();" style="float: right;cursor: pointer;position: relative;top:-4px;right:-2px"/>
	</div>
	<Form method=post onsubmit="return false;">
		<input type='hidden' value=0 name='uid' id='uid'>
		<input type='hidden' value='add' name='mode' id='mode'>
		<table class="fields_tbl" style="border-width: 1px;border-collapse: separate;">
		<tr><td width="120">Логін:</td><td><input type='text' name='login' id='login' class="txt"></td>
		<td rowspan=13 style="vertical-align: top; text-align: center"><img id=userfoto name=userfoto src="/image.php?mode=2&objid=0&num=0"><input type="button" value="Змінити" onclick="EditFoto()"></td></tr>
		<tr><td>Пароль:</td><td><input type='text' name='pass' id='pass' class="txt"></td></tr>
		<tr><td>ПІП:</td><td><input type='text' name='longname' id='longname' class="txt"></td></tr>
		<tr><td>Доступ:</td><td>
			<select name='rights' id='rights'>
				<option value="0" title="Повний доступ">Адмін (повний доступ)</option>
				<option value="1" title="Обмеженеий доступ">Оператор (обмежений)</option>
				<option value="2" title="Нема доступу" selected="selected">Ріелтор (нема доступу)</option>
			</select>
		</td></tr>
		<tr><td width="100">Відділення:</td><td>
			<select name='otdel' id='otdel'>
				<option value="0" title="0">Гоголя,15</option>
				<option value="1" title="1">Київська,16</option>
				<option value="2" title="2">Юності,44</option>
				<option value="3" title="3">Фрунзе,4</option>
			</select>
		</td></tr>
		<tr><td width="100">Посада:</td><td><input type='text' name='posada' id='posada' class="txt"></td></tr>
		<tr><td>Телефон 1:</td><td><input type='text' name='phone1' id='phone1' class="txt"></td></tr>
		<tr><td>Телефон 2:</td><td><input type='text' name='phone2' id='phone2' class="txt"></td></tr>
		<tr><td>Телефон 3:</td><td><input type='text' name='phone3' id='phone3' class="txt"></td></tr>
		<tr><td>Телефон 4:</td><td><input type='text' name='phone4' id='phone4' class="txt"></td></tr>
		<tr><td>Email:</td><td><input type='text' name='email' id='email' class="txt"></td></tr>
		<!--<tr><td>Фото:</td><td><input type='file' name='foto' id='foto' class="txt"></td></tr>-->
		<tr><td>&nbsp;</td><td style="text-align:left"><label><input type='checkbox' value=1 name='locked' id='locked'>Заблокований</label></td></tr>
		</table>
		<div style="text-align: right">
			<input type='button' value='Записати' onclick="saveUserData();return false;"> <input type='reset' value='Вiдмiнити' onclick="clearForm()">
		</div>
	</form>
	<div id="overlay2"></div>
	<div id="form2box" style="display:none;background-color: #DFDFDF;border:3px double #FEFEFE; z-index: 10003;padding: 10px;">
		<form name=fotoupload method=post action='/admin/save/uploadimage.php' target="ifrm" enctype='multipart/form-data'>
		  <input type="hidden" name="max_folder" id="max_folder" value="/i/users/">
		  <input type="hidden" name="min_folder" id="min_folder" value="/i/users-p/">
		  <input type="hidden" name="max_width" value="250">
		  <input type="hidden" name="max_height" value="170">
		  <input type="hidden" name="min_width" value="100">
		  <input type="hidden" name="min_height" value="70">
		  <input type="hidden" name="userID" value="">
		  <input type="hidden" name="callback" value="fotoloaded">
		  <input type='file' name='foto' id='foto' size="35"><input type="Submit" value="Загрузити">
		  <input type="button" value="Відмінити" onclick="$('#form2box').hide();$('#overlay2').hide();">
		</form>
	</div>
</div>
