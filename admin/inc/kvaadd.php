<?
	$obl= (isset($_REQUEST['obl']))? $_REQUEST['obl']:0;
	$rgn= (isset($_REQUEST['rgn']))? $_REQUEST['rgn']:0;
	$mista= (isset($_REQUEST['mista']))? $_REQUEST['mista']:0;
	$agent= (isset($_REQUEST['agent']))? $_REQUEST['agent']:0;
	$nomer= (isset($_GET['nomer']))? $_GET['nomer']:0;
	$obj = Object::load($_REQUEST['oid'],'kva');
?>
<form method="post" action='/index.php?page=admin&panel=saveobj' enctype='multipart/form-data' onsubmit="return validateForm();">
<div id="form-wrapper">
	<div id="steps">
	<fieldset class="step">
		<input type='hidden' name='type' value='kva'>
		<input type='hidden' name='editid' value="<?=$obj->id?>">
		<input type='hidden' name='f_nomer' value="<?=$nomer?>">
		<input type='hidden' name='f_agent' value="<?=$agent?>">
		<input type='hidden' name='f_obl' value="<?=$obl?>">
		<input type='hidden' name='f_rgn' value="<?=$rgn?>">
		<input type='hidden' name='f_mista' value="<?=$mista?>">

			<table cellpadding=4 cellspacing=5>
				<tr>
					<td>Пропозиція</td>
					<td>
						<label><input type="radio" <?if ($obj->prodazh==1) {?>checked="checked"<?}?> name=prodazh value=1 id=modeprod>Продаж</label>
						<label><input type="radio" <?if ($obj->prodazh==0) {?>checked="checked"<?}?> name=prodazh value=0 id=modeorenda>Оренда</label>
					</td>
				</tr>
				<tr>
					<td>Номер в базі</td>
					<td><input type='text' name='num' value="<?=$obj->num?>"></td>
				</tr>
				<tr>
					<td>Область</td>
					<td>
						<select name='adr_obl' id='adr_obl' onChange="loadRgns('rgn','adr_rgn',this.value);">
						  <option value=0>Виберіть область</option>
						  <?php @getaslist('d_oblasti',$obj->adr_obl,'1=1'); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Район</td>
					<td>
						<select name='adr_rgn' id='adr_rgn' onChange="loadRgns('mista','adr_mista',this.value);">
						  <option value=0>Виберіть район</option>
						  <?php	if ($obj->adr_obl!=0) getaslist('d_rgn',$obj->adr_rgn,"parent='$obj->adr_obl'");  ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Насел. пункт</td>
					<td>
						<select name='adr_mista' id='adr_mista' onChange="if (this.value!=1063){$('#row_dist').hide()} else {$('#row_dist').show()};HideZeroItem('adr_mista');">
						  <option value=0>Виберіть населений пункт</option>
						  <?php
							if ($obj->adr_rgn>0) {$usl="parent='$obj->adr_rgn'";} else {$usl="obl='$obj->adr_obl'";}
							getaslist('d_mista',$obj->adr_gor,$usl);
						  ?>
						</select>
					</td>
				</tr>
				<tr id="row_dist" style="display: <?=$obj->adr_gor!=1063?"none":"table-row"?>">
					<td>Район міста</td>
					<td>
						<select name='adr_dist' id='adr_dist' onChange="HideZeroItem('adr_dist');">
						  <option value=0>Виберіть район міста</option>
						  <?php getaslist('d_dist',$obj->adr_dist,"1=1");?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Вулиця<br><font color="#8F8F8F" size="-1">(виберіть)</font></td>
					<td><input type='text' name='adr_vul' value="<?=$obj->adr_vul?>"><br>
		          	<select id='adr_vuls' onchange="adr_vul.value=$(this).find(':selected').text();">
							  <option> </option>
		            		<?php getaslist('d_vul',$obj->adr_vul,"1=1"); ?>
		          	</select></td>
				</tr>
				<tr>
					<td>Тип квартири</td>
					<td>
					<select name='typekva'>
						 <?if ($obj->kva_type==0){?><option value=0 selected>Оберіть</option><?}?>
						 <option value=1 <?if ($obj->kva_type==1){?>selected="selected"<?}?>>роздільні кімнати </option>
						 <option value=2 <?if ($obj->kva_type==2){?>selected="selected"<?}?>>суміжні кімнати </option>
						 <option value=3 <?if ($obj->kva_type==3){?>selected="selected"<?}?>>з/р кімнати </option>
						 <option value=4 <?if ($obj->kva_type==4){?>selected="selected"<?}?>>гостинка </option>
						 <option value=5 <?if ($obj->kva_type==5){?>selected="selected"<?}?>>студія </option>
						 <option value=6 <?if ($obj->kva_type==6){?>selected="selected"<?}?>>двохрівнева </option>
						 <option value=7 <?if ($obj->kva_type==7){?>selected="selected"<?}?>>багаторівнева </option>
						 <option value=8 <?if ($obj->kva_type==8){?>selected="selected"<?}?>>пентхауз </option>
					 </select>
					</td>
				</tr>
				<tr>
					<td>Кількість кімнат</td>
					<td>
					<select name='kk'>
						<?if ($obj->kk=="0"){?><option value=0 selected>Оберіть</option><?}?>
						<option value="-1" <?if ($obj->kk=="-1"){?>selected="selected"<?}?>>частина квартири</option>
						<option value="1" <?if ($obj->kk=="1"){?>selected="selected"<?}?>>1-кімнатна</option>
						<option value="2" <?if ($obj->kk=="2"){?>selected="selected"<?}?>>2-кімнатна</option>
						<option value="3" <?if ($obj->kk=="3"){?>selected="selected"<?}?>>3-кімнатна</option>
						<option value="4" <?if ($obj->kk=="4"){?>selected="selected"<?}?>>4-кімнатна</option>
						<option value="99" <?if ($obj->kk=="99"){?>selected="selected"<?}?>>багатокімнатна</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Поверх/поверхів</td>
					<td>
						<input type='text' name='pov' value="<?=$obj->pov?>" size=3> /
						<input type='text' name='povv' value="<?=$obj->povv?>" size=3>
					</td>
				</tr>
				<tr>
					<td>Площа м<sup style='font-size:11px'>2</sup> (заг./житл./кухня)</td>
					<td>
						<input type='text' name='pzag' value="<?=$obj->pzag?>" size=3> /
						<input type='text' name='pzit' value="<?=$obj->pzit?>" size=3> /
						<input type='text' name='pkuh' value="<?=$obj->pkuh?>" size=3>
					</td>
				</tr>
				<tr>
					<td>Ціна</td>
					<td><input type='text' name='cast' value="<?=$obj->cast?>" style='width:70px'>
					<select name='valuta'  style='width:40px'>
						<option value=1 <?if ($obj->valuta=="1"){?>selected="selected"<?}?>>грн.</option>
						<option value=2  <?if ($obj->valuta!="1" && $obj->valuta!="3"){?>selected="selected"<?}?>> $ </option>
						<option value=3 <?if ($obj->valuta=="3"){?>selected="selected"<?}?>> &euro; </option>
						</select>
                    <select name='casttype'  style='width:60px'>
							<option value=1 <?if ($obj->casttype!="2"){?>selected="selected"<?}?>>за все</option>
							<option value=2 <?if ($obj->casttype=="2"){?>selected="selected"<?}?>> за м<sup>2</sup> </option>
						</select>
					</td>
				</tr>
				</table>
		</fieldset>

	<!-- ----------------------------------------------------------------------------------------------------------------------- -->
	<fieldset class="step">
				<h4>Короткий коментар</h4>
				<textarea id='redactor_content_master' name=comment cols=70 rows=20><?=$obj->comment?></textarea>
	</fieldset>

   <!-- ----------------------------------------------------------------------------------------------------------------------- -->
	<fieldset class="step">
				<table width="90%">
					<tr>
						<td>Контактна особа</td>
						<td>
						<select name='agent' id='agent' style="width:300px">
						  	<option value='0'>Оберіть</option>
							<? getaslist('d_users',$obj->kont->id,'id<>110'); ?>
						</select>
						</td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='hot' id="hot" <?if ($obj->in_hot){?>checked="checked"<?}?>><label for="hot">Гаряча пропозиція </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='onmain' id="onmain" <?if ($obj->in_main){?>checked="checked"<?}?>><label for="onmain">На головній </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='exclusive' id="exclusive" <?if ($obj->exclusive){?>checked="checked"<?}?>><label for="exclusive">Ексклюзив </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='novobud' id="novobud" <?if ($obj->novobud){?>checked="checked"<?}?>><label for="novobud">Новобудова </label></td>
					</tr>
				</table>
	</fieldset>

	<!-- ----------------------------------------------------------------------------------------------------------------------- -->
	<fieldset class="step">

          <center>Фото квартири (максимальний розмір картинки - 1024х768/2Mb)</center><BR />
		  <input type="hidden" name="MAX_FILE_SIZE" value="2048000" />
<p style="border-bottom: 1px dotted gray;height: 69px;"><img src="/image.php?objid=<?=$obj->id?>&mode=2&num=1" align=left style="margin-right: 10px;">Фото 1:<br />
<input type=file name=Img1 size=30 maxlength=128><br>
<label><input type="checkbox" name="fdel_1"> Знищити </label></p>
<p style="border-bottom: 1px  dotted gray;height: 69px;"><img src="/image.php?objid=<?=$obj->id?>&mode=2&num=2" align=left style="margin-right: 10px;">Фото 2:<br />
<input type=file name=Img2 size=30 maxlength=128><br>
<label><input type="checkbox" name="fdel_2"> Знищити </label></p>
<p style="border-bottom: 1px  dotted gray;height: 69px;"><img src="/image.php?objid=<?=$obj->id?>&mode=2&num=3" align=left style="margin-right: 10px;">Фото 3:<br />
<input type=file name=Img3 size=30 maxlength=128><br>
<label><input type="checkbox" name="fdel_3"> Знищити </label></p>
<p style="border-bottom: 1px  dotted gray;height: 69px;"><img src="/image.php?objid=<?=$obj->id?>&mode=2&num=4" align=left style="margin-right: 10px;">Фото 4:<br />
<input type=file name=Img4 size=30 maxlength=128><br>
<label><input type="checkbox" name="fdel_4"> Знищити </label></p>
<p style="height: 67px;"><img src="/image.php?objid=<?=$obj->id?>&mode=2&num=5" align=left style="margin-right: 10px;">Фото 5:<br />
<input type=file name=Img5 size=30 maxlength=128><br>
<label><input type="checkbox" name="fdel_5"> Знищити </label></p>
					<BR><BR>
	</fieldset>


</div>
<div id="navigation" style="display:none;">
		<ul>
			<li class="selected">
				<a href="#">Загальне</a>
			</li>
			<li>
				<a href="#">Коментар</a>
			</li>
			<li>
				<a href="#">Службове</a>
			</li>
			<li>
				<a href="#">Фотографії</a>
			</li>
			<li>
				<a href="#" onclick="if (validateForm()) forms[0].submit()">Зберегти</a>
			</li>
		</ul>
	</div>
</div>
</form>