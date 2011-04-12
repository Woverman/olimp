<?
	$obl= (isset($_REQUEST['obl']))? $_REQUEST['obl']:0;
	$rgn= (isset($_REQUEST['rgn']))? $_REQUEST['rgn']:0;
	$mista= (isset($_REQUEST['mista']))? $_REQUEST['mista']:0;
	$agent= (isset($_REQUEST['agent']))? $_REQUEST['agent']:0;
	$nomer= (isset($_GET['nomer']))? $_GET['nomer']:0;
	$obj = Object::load($_REQUEST['oid'],'com');
?>
<form method="post" action='/index.php?page=admin&panel=saveobj' enctype='multipart/form-data' onsubmit="return validateForm();">
<div id="form-wrapper">
	<div id="steps">
	<fieldset class="step">
		<input type=hidden name='type' value='com'>
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
					<select name='adr_mista' id='adr_mista' onChange="if (this.value==1063){$('#row_dist').hide()} else {$('#row_dist').show()};HideZeroItem('adr_mista');">
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
				<td>Площа загальна</td>
				<td>
					<input type='text' name='pzag' value="<?=$obj->pzag?>" size=3> м<sup style='font-size:11px'>2</sup>
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
		<table cellpadding=4 cellspacing=5>
			<tr>
				<td>Висота стелі</td>
				<td><input type='text' name='stelya' value="<?=$obj->stelya?>" style="width:40px;"> см</td>
			</tr>
			<tr>
				<td>Планування</td>
				<td>
					<? foreach ($sys['lists']['planing'] as $key){?>
							<label><input type="radio" value="<?=$key?>" name="planing" <?if ($obj->planing==$key) {?>checked="checked"<?}?>>
							<?=$key?></label><br>
					<?}?>
            <input type="button" onclick="offradio('planing');return false;" value="Жодного">
					</td>
				</tr>
				<tr>
					<td>Стан приміщення</td>
					<td>
						<select name='com_stan'>
						<? foreach ($sys['lists']['com_stan'] as $key){?>
							<option value="<?=$key?>" <?if ($obj->com_stan==$key) {?>selected="selected"<?}?>><?=$key?></option>
					   	<?}?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Кількість тел.ліній</td>
					<td><input type='text' name='tel_count' value="<?=$obj->tel_count?>" style="width:40px;"></td>
				</tr>
					<? foreach ($sys['lists']['in_office'] as $key){?>
					{foreach key=of_id item=of from=$gen_info.in_office}
				<tr>
						<td width="50%">УМОВИ В ОФІСІ
							<input type="checkbox" value=1 name=in_office[{$of_id}] id="of[{$of_id}]" {if $commerc.in_office[$of_id]}checked="checked"<??>>
							<label for="of[{$of_id}]">{$of}</label><br>
						</td>
				</tr>
				<?}?>
                <tr style="background-color:#cbcce3">
				    <td>Кухня</td>
					<td>
						{foreach key=kuh_id item=kuh from=$gen_info.kuh}
								<input type="radio" value="{$kuh_id}" name=kuh {if $commerc.kuh==$kuh_id}checked="checked"<??> id="kuh[{$kuh_id}]">
								<label for="kuh[{$kuh_id}]">{$kuh}</label><br>
						{/foreach}
            <input type="button" onclick="offradio('kuh');return false;" value="Жодного">
					</td>
				</tr>
				<tr style="background-color:#cbcce3">
					<td>Санвузол</td>
					<td>
						{foreach key=tual_id item=tual from=$gen_info.com_sanuzel}
				<input type="radio" value="{$tual_id}" name=com_sanuzel {if $commerc.com_sanuzel==$tual_id}checked="checked"<??> id="tual[{$tual_id}]">
								<label for="tual[{$tual_id}]">{$tual}</label><br>
						{/foreach}
            <input type="button" onclick="offradio('com_sanuzel');return false;" value="Жодного">
					</td>
				</tr>
				</table>
					</fieldset>
<!-- ----------------------------------------------------------------------------------------------------------------------- -->

	<fieldset class="step">
			<span class="title"><b>БУДІВЛЯ</b></span>
			<table cellpadding=2 cellspacing=1 width="98%">
				<tr>
					<td width="35%">Тип</td>
					<td>
						<select name='office_type' style="width:250px;">
						{foreach key=type_id item=type from=$gen_info.office_type}
							{if $type_id!=0}<option value={$type_id} {if $commerc.office_type==$type_id}selected="selected"<??>>{$type}</option>
						{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>Клас</td>
					<td>
						<select name='class' style="width:50px;">
						{foreach key=class_id item=class from=$gen_info.class}
							<option value={$class_id} {if $commerc.class==$class_id}selected="selected"<??>>{$class}</option>
						{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>Рік здачі</td>
					<td>
						<select name='TmSdch'>
						 	<?if (!$obj->TmSdch){?><option value='0' selected="selected">Оберіть</option><?}?>
							<option value="-1" <?if ($obj->TmSdch=="-1"){?>selected="selected"<?}?>>Зданий</option>
							<option value="0" <?if ($obj->TmSdch=="0"){?>selected="selected"<?}?>></option>
							<option value="2008" <?if ($obj->TmSdch=="2008"){?>selected="selected"<?}?>> 2008</option>
							<option value="2009" <?if ($obj->TmSdch=="2009"){?>selected="selected"<?}?>> 2009</option>
							<option value="2010" <?if ($obj->TmSdch=="2010"){?>selected="selected"<?}?>> 2010</option>
							<option value="2011" <?if ($obj->TmSdch=="2011"){?>selected="selected"<?}?>> 2011</option>
							<option value="2012" <?if ($obj->TmSdch=="2012"){?>selected="selected"<?}?>> 2012</option>
						 </select>
					</td>
				</tr>
				<tr>
					<td>Назва приміщення</td>
					<td><input type='text' name='com_name' value="{$commerc.com_name}"></td>
				</tr>
				<tr>
					<td>В приміщенні</td>
					<td>
						{foreach key=pom_id item=pom from=$gen_info.in_office_dom}
							<input type="checkbox" value=1 name=in_office_dom[{$pom_id}] {if $commerc.in_office_dom[$pom_id]}checked="checked"<??> id="in_office_dom[{$pom_id}]">
							<label for="in_office_dom[{$pom_id}]">{$pom}</label><br>
						{/foreach}
					</td>
				</tr>
			</table>
			<span class="title"><b>ДОДАТКОВО</b></span>
			<table cellpadding=2 cellspacing=1 width="98%">
				<tr>
					<td width="30%">Можливi варiанти використання</td>
					<td>
						{foreach key=var_id item=var from=$gen_info.com_var}
							<input type="checkbox" value=1 name=com_var[{$var_id}] {if $commerc.com_var[$var_id]}checked="checked"<??> id="com_var[{$var_id}]">
							<label for="com_var[{$var_id}]">{$var}</label><br>
						{/foreach}
					</td>
				</tr>
				<tr>
					<td>Також присутні</td>
					<td>
						{foreach key=sklad_id item=sklad from=$gen_info.com_in_sklad}
							<input type="checkbox" value=1 name=com_in_skladd[{$sklad_id}] {if $commerc.com_in_sklad[$sklad_id]}checked="checked"<??> id="com_in_sklad[{$sklad_id}]">
							<label for="com_in_sklad[{$sklad_id}]">{$sklad}</label><br>
						{/foreach}
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
				<a href="#">Умови</a>
			</li>
			<li>
				<a href="#">Додатково</a>
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
				<a href="#" onclick="forms[0].submit()">Зберегти</a>
			</li>
		</ul>
	</div>
</div>
</form>