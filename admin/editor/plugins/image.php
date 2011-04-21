<form id="redactorInsertImageForm" method="post" action="" enctype="multipart/form-data">
<table class="redactor_ruler">
	<tr>
		<td colspan="4">
			%RLANG.image_exist%
			<div id="redactor_images" style="width: 355px;height:128px; overflow-y: auto">
				<div style="background-color:#636363;padding: 4px;">
					<?
						$dir =  $_SERVER['DOCUMENT_ROOT']."/i/site/";
						$files = scandir($dir); //.'*.jpg');
						foreach($files as $file){
							if (basename($file)!="." && basename($file)!=".." && !is_dir($file))
								echo("<img src='/i/site/".basename($file)."'>");
						}
					?>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			%RLANG.image_upload%
			<input name="file" size="20" type="file" />
		</td>
	</tr>
	<tr>
		<td colspan="4" class="small">
			%RLANG.image_web_link%
			<p><input name="redactor_file_link" id="redactor_file_link" style="width: 100%;" /></p>
		</td>
	</tr>
	<tr>
		<td nowrap class="small">%RLANG.title%</td>
		<td><input id="redactor_file_alt" size="35" style="width: 100%;"/></td>
	</tr>
	<tr>
		<td nowrap class="small">%RLANG.image_position%</td>
		<td width="100%">
			<select id="redactor_form_image_align" style="width: 100%;">
				<option value="0">%RLANG.none%</option>
				<option value="left">%RLANG.left%</option>
				<option value="right">%RLANG.right%</option>
			</select>
		</td>
	</tr>

</table>

<hr>
<div style="text-align: right">
<input type="button" name="upload" id="redactorUploadBtn" value="%RLANG.insert%" />&nbsp;&nbsp;
<input type="button" name="" onclick="RedactorActive.modalClose();" value="%RLANG.cancel%"  />
</div>
</form>