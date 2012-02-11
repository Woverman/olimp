<script type="text/javascript">
function validform()
  {
    if ($('#page_name').val()==''){
      alert("Вкажіть заголовок статті!");
      return
      }
    if ($('#redactor_content_master').val()==''){
      alert("Вкажіть текст статті!");
      return
      }

    document.forms[0].submit();
  }

function addFolder(){
	var t = $('#addnew').val();
	if (t!=''){
		$("[name='page_folder']").append($("<option selected>"+t+"</option>"));
	}
	$('#addnew').hide();
	$('#addnewa').show();
}
</script>

<div style="border:1px solid #BFBFBF;padding:2px;margin:2px">
<!--<a href="/admin/pages/"><button style="height: 40px"><img class=bimg src="/i/list.png">Відмінити</button></a>-->
<? $referer = $_SERVER['HTTP_REFERER'];
   if (strpos($referer,'/pageedit/')>0) $referer = $_SESSION['HTTP_REFERER'];
   $_SESSION['HTTP_REFERER'] = $referer;
 ?>
<a href="<?=$referer?>"><button style="height: 40px"><img class=bimg src="/i/back.png">Повернутись</button></a>
<button style="height: 40px" onclick="validform(form); return(false);"><img class=bimg src="/i/save.png">Записати</button>
<!--<span style='width: 50px;'>&nbsp;</span>-->

</div>
<?
debug($_SERVER,'$_SERVER');
$pid = $_GET['pid'];
switch (@$_GET['mode']) {
  case 'edit':
    $sql='Select * from m_pages where id='.$pid;
    if ($res=mysql_query($sql)) {
    	list($id,$title,$text,$folder,$enbl,$template)=mysql_fetch_array($res);
		$sql='Select keywords,description from m_seo where page="article" and pageid='.$id;
		if ($res=mysql_query($sql)) {
			list($keywords,$description)=mysql_fetch_array($res);
		}
	}
  case 'add':
    ?>
    <form name="newsedit" method="post" action="/index.php?page=admin&panel=pagesave">
    <input type="hidden" name="id" value="<?=@$pid?>">
    <input type="hidden" name="mode" value="save">
    <span class="field_title">Назва:</span><input id="page_name" name="page_name" type="text"  value="<?=@stripslashes($title)?>" style="width:600px;"><br>
	<span class="field_title">Ключові слова:</span><input id="page_keywords" name="page_keywords" type="text" value="<?=@stripslashes($keywords)?>" style="width:600px;"><br>
	<span class="field_title">Опис:</span><input id="page_description" name="page_description" type="text" value="<?=@stripslashes($description)?>" style="width:600px;"><br>
    <span class="field_title">Розділ:</span>
	<span id="addnewa">
	<?
		$sql = "select distinct folder from m_pages order by 1";
		$res=$DB->request($sql);
		echo("<select name='page_folder'>");
		foreach($res as $f){
			$sel = ($f[0]==$folder?"selected":"");
			echo("<option $sel>$f[0]</option>");
		}
		echo("</select>");
	?>
	<a href="#" onclick="$('#addnew').show().focus().val('');$('#addnewa').hide();">Добавити</a></span>
	<input type="text" style="display: none" id="addnew" onblur="addFolder()"/>
    <br>
	<span class="field_title">Шаблон:</span>
	<?
		$sql = "select id,title from m_page_types order by id";
		$res=$DB->request($sql);
		echo("<select name='page_template'>");
		foreach($res as $f){
			$sel = ($f[0]==$template?"selected":"");
			echo("<option value='$f[0]' $sel>$f[1]</option>");
		}
		echo("</select>");
	?>
	<br>

    <textarea name="page_text" rows="30" cols="120" id="redactor_content_master"><?=@stripslashes($text)?> </textarea>

    </form>
    <?
}
?>

