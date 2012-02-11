<script>
function editSeo(id){
clearForm();
  var txt;
  $('#mode').val("edit");
  $.get("/ajax/getById.php?tbl=m_seo&id=" + id,function(data){
  	//alert(data);
  	txt=data.split("{");
  	$('#pid').val(txt[0]);
  	$('#page').val(txt[1]);
  	$('#pageid').val(txt[2]);
  	$('#pagetitle').val(txt[3]);
	$('#keywords').val(txt[4]);
 	$('#description').val(txt[5]);
  	ShowModal();
	});
}
function addSeo(id){
    clearForm();
    ShowModal();
}
function delSeo(id){
	if (confirm("Ви дійсно хочете видалити налаштування сторінки?")){
	clearForm();
	$('#pid').val(id);
	$('#mode').val("del");
	saveUserData();
	}
}
function saveUserData(){
	var s = $('form').serialize();
	$.post("/ajax/editSeo.php",s,function(data){
		var r=data.split(":");
		id = $.trim(r[1]);
		if (id=='error') alert(r[0],id);
		else{
			switch($.trim(r[0])){
				case "error":
					alert(id);
					break
				case "add":
					var row = $("#tblMain tbody tr:nth-child(2)").clone(true).attr("id","row"+id).prependTo($("#tblMain tbody"));
					updaterow(row,id);
					//alert("Нову сторінку додано.");
					break
				case "edit":
					var row = $("#row"+id);
					updaterow(row,id);
					//alert("Зміни внесено успішно.");
					break
				case "del":
					$("#row"+id).remove();
					//alert("Сторінку видалено.");
					break
			}
		}
		HideModal();
	})
}
function updaterow(row,id){
	$(row).children().get(0).textContent=$("#page").val();
	$(row).children().get(1).textContent=$("#pageid").val();
	$(row).children().get(2).textContent=$("#pagetitle").val();
	$($(row).children().find("img").get(0)).removeAttr('onclick').click(function(){editSeo(id)});
	$($(row).children().find("img").get(1)).removeAttr('onclick').click(function(){delSeo(id)});
}
function clearForm() {
	document.forms[0].reset();
	$('#title').text("Нова сторінка:");
	$('#StatusLine').text("");
	$('#mode').val("add");
	HideModal();
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
<?
$sql = "Select * from m_seo";
$res=$DB->request($sql,ARRAY_A);
echo '<button style="height: 40px;" onclick="addSeo();"><img class="bimg" src="/i/add.png"> Додати сторінку...</button>';
echo '<table width=100% class="mytab" id="tblMain">';
echo '<thead><tr><th>Сторінка</th><th>Номер</th><th>Назва</th><th>Операції</th></tr></thead><tbody>';
debug($res);
foreach($res as $row){
	echo '<tr id="row'.$row['id'].'" class="row'.$a=abs($a-1).'"><td>'.$row['page'].'</td><td>'.$row['pageid'].'</td><td>'.$row['title'].'</a></td><td>';
	echo '<a href=#><img class=aimg src="/i/edit.png" title="Правка" onclick="editSeo('.$row['id'].')"></a>';
    echo '<a href=#><img class=aimg src="/i/delete.png" title="Знищити" onclick="delSeo('.$row['id'].')"></a>';
    echo '</td></tr>';

	}
echo '</tbody></table>';
?>

<div id="StatusLine"></div>
<div id="overlay"></div>
<div id="formbox" class="moveable" style="display:none;background-color: #DFDFDF;border:1px solid #FEFEFE; ">
	<div id="dialogTitle"><span id="title">Нова сторінка:</span>
	    <img src="/i/window_close.png" width="24" onclick="HideModal();" style="float: right;cursor: pointer;position: relative;top:-4px;right:-2px"/>
	</div>
	<Form method=post onsubmit="return false;">
		<input type='hidden' value=0 name='pid' id='pid'>
		<input type='hidden' value='add' name='mode' id='mode'>
		<table class="fields_tbl" style="border-width: 1px;border-collapse: separate;">
		<tr><td width="120">Сторінка:</td><td><input type='text' name='page' id='page' class="txt430"></td></tr>
		<tr><td>Індекс:</td><td><input type='text' name='pageid' id='pageid' class="txt430"></td></tr>
		<tr><td>Заголовок:</td><td><input type='text' name='pagetitle' id='pagetitle' class="txt430"></td></tr>
		<tr><td>Ключові слова:</td><td><textarea name='keywords' id='keywords' class="txt"></textarea></td></tr>
		<tr><td>Опис сторінки:</td><td><textarea type='text' name='description' id='description' class="txt"></textarea></td></tr>
		</table>
		<div style="text-align: right">
			<input type='button' value='Записати' onclick="saveUserData();return false;"> <input type='reset' value='Вiдмiнити' onclick="clearForm()">
		</div>
	</form>
</div>
