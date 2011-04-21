<?
header("Content-type: text/html; charset=UTF-8");
include($_SERVER['DOCUMENT_ROOT']."/classes.php")
?>
<script language="JavaScript" type="text/javascript">
function toggleControls(txt,type){
	$('#redactor_link_url_name').text(txt);
	if (type==1){
		$('#redactor_link_url').hide();
		$('#redactor_link_article').show();
	} else {
		$('#redactor_link_url').show();
		$('#redactor_link_article').hide();
	}
}
function setArticle(id,txt){
	$('#redactor_link_url').val('/article/'+id);
	$('#redactor_link_title').val(txt);
}
</script>

<form id="redactorInsertLinkForm">
<table class="redactor_ruler" style="margin-bottom: 6px;">
	<tr>
		<td style="white-space: nowrap;"><input value="link" name="redactor_link" id="redactor_link_id_url" type="radio" onclick="toggleControls('URL',2)" checked="checked">&nbsp;<label for="redactor_link_id_url">%RLANG.web%</label></td>
		<td style="white-space: nowrap;"><input value="email" name="redactor_link" id="redactor_link_id_email" onclick="toggleControls('%RLANG.mailto%',2)"  type="radio">&nbsp;<label for="redactor_link_id_email">%RLANG.mailto%</label></td>
		<td style="white-space: nowrap;"><input value="article" name="redactor_link" id="redactor_link_id_article" onclick="toggleControls('%RLANG.article%',1)"  type="radio">&nbsp;<label for="redactor_link_id_article">%RLANG.article%</label></td>
	</tr>
</table>

<table class="redactor_ruler">
	<tr>
		<td nowrap id="redactor_link_url_name">URL</td>
		<td width="100%">
			<input name="redactor_link_url" id="redactor_link_url" style="width: 100%"/>
			<select name="redactor_link_article" id="redactor_link_article" style="width: 100%;display: none" onchange="setArticle(this.value,this.options[this.selectedIndex].text);">
				<option></option>
<?
				$sql = "select id,title,folder from m_pages order by folder,title";
				$items = $DB->request($sql,ARRAY_A);
				$fld="";
				foreach($items as $item){
					if ($fld!=$item['folder']){
						echo("<optgroup label='- ".$item['folder']." -' style='background-color: #CCCCFF'></optgroup>");
						$fld=$item['folder'];
					}
					echo("<option value='".$item['id']."'>".$item['title']."</option>");
				}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>%RLANG.text%</td>
		<td><input name="redactor_link_text" id="redactor_link_text" size="20" /></td>
	</tr>
	<tr>
		<td>%RLANG.title%</td>
		<td><input name="redactor_link_title" id="redactor_link_title" size="20"  /></td>
	</tr>
</table>


</form>


<input type="button" name="" id="" value="%RLANG.insert%" onclick="RedactorActive.insertLink();" />&nbsp;&nbsp;
<input type="button" name="" onclick="RedactorActive.modalClose();" value="%RLANG.cancel%"  />
