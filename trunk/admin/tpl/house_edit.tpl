<form method="post" action='save/dom.php' enctype='multipart/form-data' onsubmit="return validateForm();">
<input type=hidden name='panel' value="dom">
<input type='hidden' name='type' value='dom'>
<input type='hidden' name='editid' value="{$smarty.get.id}">
<input type='hidden' name='f_nomer' value="{$smarty.get.nomer}">
<input type='hidden' name='f_agent' value="{$smarty.get.agent}">
<input type='hidden' name='f_obl' value="{$smarty.get.obl}">
<input type='hidden' name='f_rgn' value="{$smarty.get.rgn}">
<input type='hidden' name='f_mista' value="{$smarty.get.mista}">
<table width="98%">
	<tr bgcolor="#cdf2d3">
		<td valign="top" width=150>
			<br />&#160;<span onClick="show_group('1','8')" class="title"><a href="#" name="details" id="details">ЗАГАЛЬНЕ</a></span>
		</td>
		<td valign="top">
			<div id="group_1" style="visibility:visible;">
				<table cellpadding=2 cellspacing=1>
					<tr>
						<td><input type="radio" {if $dom.prodazh || !$smarty.get.id}checked="checked"{/if} name=prodazh value=1 id=modeprod><label for="modeprod">Продаж</label></td>
						<td><input type="radio" {if $dom.prodazh=="0"}checked="checked"{/if} name=prodazh value=0 id=modeorenda><label for="modeorenda">Оренда</label></td>
					</tr>
					<tr>
						<td>Номер в базі</td>
						<td><input type='text' name='num' value="{$dom.num}"></td>
					</tr>
				<tr>
					<td>Область</td>
					<td>
						<select name='obl' id='obl' onChange="loadRgns('rgn',this.value);">
							{foreach key=reg_id item=reg from=$regions}
								<option value="{$reg_id}" {if (!$smarty.get.id && $reg_id==2) || ($reg_id == $dom.adr_obl)}selected="selected"{/if}>{$reg}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>Район</td>
					<td>
						<select name='rgn' id='rgn' onChange="loadRgns('mista',this.value);">
								<option value=0>Оберіть район</option>
							{foreach key=ray_id item=ray from=$rayons}
								<option value="{$ray_id}" {if $ray_id == $dom.adr_rgn}selected="selected"{/if}>{$ray}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>Насел. пункт</td>
					<td>
						<select name='mista' id='mista'>
									<option value=0>Оберіть нас. пункт</option>
							{if $mista}
								{foreach key=m_id item=misto from=$mista}
									<option value="{$m_id}" {if $m_id == $dom.adr_gor}selected="selected"{/if}>{$misto}</option>
								{/foreach}
							{/if}
						</select>
					</td>
				</tr>
				<tr>
					<td>Вулиця<br><font color="#8F8F8F" size="-1">(виберіть)</font></td>
					<td><input type='text' name='vul' value="{$dom.adr_vul}"><br>
          <select name='vuls' id='vuls' onchange="vul.value=this.value;">
            <option> </option>
            {if $vuls}
							{foreach key=v_id item=vul from=$vuls}
								<option value="{$vul}">{$vul}</option>
							{/foreach}
						{/if}
          </td>
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
					<td><input type='text' name='kk' value="{$dom.kk}"></td>
				</tr>
				<tr>
					<td>Стан будинку</td>
					<td>
					<select name='dom_sost'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						{foreach key=sost_id item=sost from=$gen_info.dom_sos}
								{if $sost_id!=0}<option value="{$sost_id}" {if $sost_id == $dom.dom_sost}selected="selected"{/if}>{$sost}</option>{/if}
						{/foreach}
					</select>
					</td>
				</tr>
				<tr>
					<td>Строк здачі</td>
					<td>
					<select name=TmSdch size=1>
						<option value="-1" {if $dom.kva_zdan=="-1"}selected="selected"{/if}>Зданий</option>
						<option value="0" {if $dom.kva_zdan=="0"}selected="selected"{/if}></option>
						<option value="2008" {if $dom.kva_zdan=="2008"}selected="selected"{/if}> 2008</option>
						<option value="2009" {if $dom.kva_zdan=="2009"}selected="selected"{/if}> 2009</option>
						<option value="2010" {if $dom.kva_zdan=="2010"}selected="selected"{/if}> 2010</option>
						<option value="2011" {if $dom.kva_zdan=="2011"}selected="selected"{/if}> 2011</option>
						<option value="2012" {if $dom.kva_zdan=="2012"}selected="selected"{/if}> 2012</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Готовність</td>
					<td>
					<select name='Gotov'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						{foreach key=got_id item=got from=$gen_info.Gotov}
								{if $got_id!=0}<option value="{$got_id}" {if $got_id == $dom.Gotov}selected="selected"{/if}>{$got}</option>{/if}
						{/foreach}
					</select>
					</td>
				</tr>
				<tr>
					<td>Площа м<sup style='font-size:11px'>2</sup> (заг./житл./кухня)</td>
					<td>
						<input type='text' name='pzag' value="{$dom.pzag}" size=3> /
						<input type='text' name='pzhil' value="{$dom.pzit}" size=3> /
						<input type='text' name='pkuh' value="{$dom.pkuh}" size=3>
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
					<td><input type='text' name='cast' value="{$dom.cast}" style='width:70px'>
					<select name='valuta'  style='width:40px'>
						<option value=1 {if $dom.valuta=="1"}selected="selected"{/if}>грн.</option>
						<option value=2  {if !$smarty.get.id || $dom.valuta=="2"}selected="selected"{/if}> $ </option>
						<option value=3 {if $dom.valuta=="3"}selected="selected"{/if}> &euro; </option>
						</select>
                    <select name='casttype'  style='width:60px'>
							<option value=1 {if !$smarty.get.id || $commerc.casttype=="1"}selected="selected"{/if}>за все</option>
							<option value=2 {if $commerc.casttype=="2"}selected="selected"{/if}> за м<sup>2</sup> </option>
						</select>
					</td>
				</tr>
				</table>
			</div>

		</td>
	</tr>
		{*-----------------------------------------------------------------------------------*}
	<tr bgcolor="#f2fff4">
		<td valign="top">
			<br />&#160;<span onClick="show_group('2','8')" class="title"><a href="#details">МЕРЕЖІ</a></span>
		</td>
		<td valign="top">
			<div id="group_2" style="display:none">
				<table width="100%" cellspacing="10" border="0">
					<tr>
						<td>Газ</td>
						<td>
							{foreach key=gaz_id item=gaz from=$gen_info.komm}
								{if $gaz_id<3}
									<input type="radio" value="{$gaz_id}" name="dom_gaz" {if $dom.dom_komm[$gaz_id]}checked="checked"{/if} id="dom_komm[{$gaz_id}]">
 									<label for="dom_komm[{$gaz_id}]">{$gaz}</label><br>
								{/if}
							{/foreach}
                           <input type="button" onclick="offradio('dom_gaz');return false;" value="Жодного">
						</td>
					</tr>
					<tr>
						<td>Вода</td>
						<td>
							{foreach key=voda_id item=voda from=$gen_info.komm}
								{if $voda_id>2 && $voda_id<6}
									<input type="checkbox" value="1" name=dom_komm[{$voda_id}] {if $dom.dom_komm[$voda_id]}checked="checked"{/if} id="dom_komm[{$voda_id}]">
									<label for="dom_komm[{$voda_id}]">{$voda}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>Каналізація</td>
						<td>
							{foreach key=kanal_id item=kanal from=$gen_info.komm}
								{if $kanal_id>5 && $kanal_id<9}
									<input type="checkbox" value="1" name=dom_komm[{$kanal_id}] {if $dom.dom_komm[$kanal_id]}checked="checked"{/if} id="dom_komm[{$kanal_id}]">
									<label for="dom_komm[{$kanal_id}]">{$kanal}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>Опалення</td>
						<td>
							{foreach key=otop_id item=otop from=$gen_info.komm}
								{if $otop_id>8 && $otop_id<12}
									<input type="checkbox" value="1" name=dom_komm[{$otop_id}] {if $dom.dom_komm[$otop_id]}checked="checked"{/if} id="dom_komm[{$otop_id}]">
									<label for="dom_komm[{$otop_id}]">{$otop}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>Нагрівання води</td>
						<td>
							{foreach key=nagr_id item=nagr from=$gen_info.komm}
								{if $nagr_id>11 && $nagr_id<15}
									<input type="checkbox" value="1" name=dom_komm[{$nagr_id}] {if $dom.dom_komm[$nagr_id]}checked="checked"{/if} id="dom_komm[{$nagr_id}]">
									<label for="dom_komm[{$nagr_id}]">{$nagr}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
			{*--------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#e8f2ff">
		<td valign="top">
			<br />&#160;<span onClick="show_group('3','8')" class="title"><a href="#details">СТІНИ, ДАХ</a></span>
		</td>
		<td valign="top"> 
			<div id="group_3" name='panel' style="display:none">
				<table width="100%" cellspacing="10" border="0">
					<tr>
						<td>Стіни</td>
						<td>
							{foreach key=st_id item=steny from=$gen_info.dom_stinu}
								{if $st_id<12}
									<input type="checkbox" value=1 name=dom_stinu[{$st_id}] {if $dom.dom_stinu[$st_id]}checked="checked"{/if} id="dom_stinu[{$st_id}]">
									<label for="dom_stinu[{$st_id}]">{$steny}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>Дах</td>
						<td>
							{foreach key=dax_id item=dax from=$gen_info.dom_stinu}
								{if $dax_id>11 && $dax_id<21}
									<input type="checkbox" value=1 name=dom_stinu[{$dax_id}] {if $dom.dom_stinu[$dax_id]}checked="checked"{/if} id="dom_stinu[{$dax_id}]">
									<label for="dom_stinu[{$dax_id}]">{$dax}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
			{*--------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#dbdcf3">
		<td valign="top">
			<br />&#160;<span onClick="show_group('4','8')" class="title"><a href="#details">УМОВИ У БУДИНКУ</a></span>
		</td>
		<td valign="top"> 
			<div id="group_4" name='panel' style="display:none" align="center">
				<table width="98%">
					{foreach key=dop_id item=dop from=$gen_info.dom_dop}
					{if ($dop_id%2)==0}<tr>{/if}
						<td width="50%">
							<input type="checkbox" value=1 name=dom_dop[{$dop_id}] id="dom_dop[{$dop_id}]" {if $dom.dom_dop[$dop_id]}checked="checked"{/if}>
							<label for="dom_dop[{$dop_id}]">{$dop}</label><br>
						</td>
					{if ($dop_id%2)==1}</tr>{/if}
					{/foreach}
				</table>
			</div>
		</td>
	</tr>
			{*------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#f9cbf1">
		<td valign="top">
			<br />&#160;<span onClick="show_group('5','8')" class="title"><a href="#details">ДІЛЯНКА</a></span>
		</td>
		<td valign="top">
			<div id="group_5" style="display:none" align="center">
				<table width="98%">
					{foreach key=dil_id item=dil from=$gen_info.dom_indil}
					{if ($dil_id%2)==0}<tr>{/if}
						<td width="50%">
							<input type="checkbox" value=1 name=dom_indil[{$dil_id}] id="dom_indil[{$dil_id}]" {if $dom.dom_indil[$dil_id]}checked="checked"{/if}>
							<label for="dom_indil[{$dil_id}]">{$dil}</label><br>
						</td>
					{if ($dil_id%2)==1}<tr>{/if}
					{/foreach}
				</table>
			</div>
		</td>
	</tr>
		{*-------------------------------------------------------------------------------------------------------------------*}	
	<tr bgcolor="#ffe8e8">
		<td valign="top">
			<br />&#160;<span onClick="show_group('6','8')" class="title"><a href="#details">ДОДАТКОВО</a></span>
		</td>
		<td valign="top">
			<div id="group_6" style="display:none">
				<div style="margin: 7px 7px 7px 7px;">
				{foreach key=dod_id item=dod from=$gen_info.dom_dod}
					<input type="checkbox" value=1 name=dom_dod[{$dod_id}] {if $dom.dom_dod[$dod_id]}checked="checked"{/if} id="dom_dod[{$dod_id}]">
					<label for="dom_dod[{$dod_id}]">{$dod}</label><br>
				{/foreach}
				<BR>
				<h4>Короткий коментар</h4>
				<textarea name=comment cols=40 rows=10>{$dom.comment}</textarea>
				<BR><BR>
				</div>
			</div>
		</td>
	</tr>
		{*-----------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#fff8e8">
		<td valign="top">
			<br />&#160;<span onClick="show_group('7','8')" class="title"><a href="#details">СЛУЖБОВЕ</a></span>
		</td>
		<td valign="top">
			<div id="group_7" style="display:none">
				<table width="90%">
					<tr>
						<td>Контактна особа</td>
						<td>
						<select name='agent' id='agent' style="width:300px">
						  {if !$smarty.get.id}<option value='0' selected="selected">Оберіть</option>{/if}
								{foreach key=ag_id item=ag from=$agents}
									<option value="{$ag_id}" {if $ag_id == $dom.kont}selected="selected"{/if}>{$ag}</option>
								{/foreach}
						</select>
						</td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='hot' id="hot" {if $dom.in_hot}checked="checked"{/if}><label for="hot">Гаряча пропозиція </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='onmain' id="onmain" {if $dom.in_main}checked="checked"{/if}><label for="onmain">На головній </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='exclusive' id="exclusive" {if $dom.exclusive}checked="checked"{/if}><label for="exclusive">Ексклюзив </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='novobud' id="novobud" {if $dom.novobud}checked="checked"{/if}><label for="novobud">Новобудова </label></td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
		{*-----------------------------------------------------------------------------------------------------------------*}
	
	<tr bgcolor="#fdfed3">
		<td valign="top">
			<br />&#160;<span onClick="show_group('8','8')" class="title"><a href="#details">ФОТОГРАФІЇ</a></span>
		</td>
		<td valign="top">
			
			<div id="group_8" style="display:none">
				{if !$smarty.get.id}
					Завантаження фото доступне <br>тільки при редагуванні вже створеного запису.<br><br>
          <i>(Завантаження декількох фото, це доволі довгий процес, протягом якого можуть виникнути збої в роботі мережі.
          Щоб попередити втрату введених даних, можливість загрузки фото при створенні об'єкту відлючена.)</i>
				{else}
          <BR>
          <center>Фото квартири (розмір картинки - 1024х768)</center><BR />
					<input type="hidden" name="MAX_FILE_SIZE" value="2048000" />
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=1" align=right>Фото 1:<br><input type=file name=Img1 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_1"><label for="fdel_1"> Знищити </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=2" align=right>Фото 2:<br><input type=file name=Img2 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_2"><label for="fdel_2"> Знищити </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=3" align=right>Фото 3:<br><input type=file name=Img3 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_3"><label for="fdel_3"> Знищити </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=4" align=right>Фото 4:<br><input type=file name=Img4 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_4"><label for="fdel_4"> Знищити </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=5" align=right>Фото 5:<br><input type=file name=Img5 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_5"><label for="fdel_5"> Знищити </label></p>
					<BR><BR>
				{/if}
			</div>
		</td>
	</tr>
	
</table>
<br /><br />
<div class="forbtn"><input type=submit value='Зберегти все'></div>
</form>