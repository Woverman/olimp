<?
	$obj = Object::load($_REQUEST['oid'],'dom');
?>
<form method="post" action='/admin/saveobj' enctype='multipart/form-data' onsubmit="return validateForm();">
<div id="form-wrapper">
	<div id="steps">
	<fieldset class="step">
		<input type=hidden name='panel' value='kva'>
		<input type='hidden' name='type' value='kva'>
		<input type='hidden' name='editid' value="<?=$obj->id?>">
		<input type='hidden' name='f_nomer' value="<?=$obj->num?>">
		<input type='hidden' name='f_agent' value="<?=$obj->kont?>">
		<input type='hidden' name='f_obl' value="<?=$obj->adr_obl?>">
		<input type='hidden' name='f_rgn' value="<?=$obj->adr_rgn?>">
		<input type='hidden' name='f_mista' value="<?=$obj->adr_gor?>">

			<table cellpadding=2 cellspacing=1>
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
						<select name='adr_mista' id='adr_mista' onChange="HideZeroItem('adr_mista');">
						  <option value=0>Виберіть населений пункт</option>
						  <?php
							if ($obj->adr_rgn>0) {$usl="parent='$obj->adr_rgn'";} else {$usl="obl='$obj->adr_obl'";}
							getaslist('d_mista',$obj->adr_gor,$usl);
						  ?>
						</select>
					</td>
				</tr>
				<tr>
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
					<td>Тип будинку</td>
					<td>
					<select name='dom_domtype'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						 <option value=1 {if $dom.dom_domtype==1}selected="selected"{/if}>будинок</option>
						 <option value=2 {if $dom.dom_domtype==2}selected="selected"{/if}>частина будинку</option>
						 <option value=3 {if $dom.dom_domtype==3}selected="selected"{/if}>дача</option>
					 </select>
					</td>
				</tr>
				<tr>
					<td>Кількість поверхів</td>
					<td>
						<select name='povv'>
							{if !$smarty.get.id}<option value=0 selected>Виберіть</option>{/if}
							<option value=1 {if $dom.povv=="1"}selected="selected"{/if}>1</option>
							<option value=2 {if $dom.povv=="2"}selected="selected"{/if}>2</option>
							<option value=3 {if $dom.povv=="3"}selected="selected"{/if}>3</option>
							<option value=4 {if $dom.povv=="4"}selected="selected"{/if}>4</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Кількість кімнат</td>
					<td><input type='text' name='kk' value="<?=$obj->kk?>"></td>
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
					<td>Площа ділянки</td>
					<td><input type='text' name='pdil' value="{$dom.pdil}" style='width:73px'>
						<select name='plo_od'  style='width:73px'>
							<option value=1 {if $dom.plo_od=="1"}selected="selected"{/if}>сотки</option>
							<option value=2 {if $dom.plo_od=="2"}selected="selected"{/if}>га</option>
						</select>
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
				<textarea name=comment cols=70 rows=20><?=$obj->comment?></textarea>
	</fieldset>
   <!-- ----------------------------------------------------------------------------------------------------------------------- -->
	<fieldset class="step">
				<table width="90%">
					<tr>
						<td>Контактна особа</td>
						<td>
						<select name='agent' id='agent' style="width:300px">
						  	<option value='0'>Оберіть</option>
							<? getaslist('d_users',$obj->kont,'id<>110'); ?>
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
				<a href="#">Додатково</a>
			</li>
			<li>
				<a href="#">Службове</a>
			</li>
			<li>
				<a href="#">Фотографії</a>
			</li>
			<li>
				<a href="#" style="color:#CECECE">Зберегти все</a>
			</li>
		</ul>
	</div>
</div>
</form>