<form method="post" action='save/com.php' enctype='multipart/form-data' onsubmit="return validateForm();">
<input type=hidden name='panel' value="com">
<input type='hidden' name='type' value='com'>
<input type='hidden' name='editid' value="{$smarty.get.id}">
<input type='hidden' name='f_nomer' value="{$smarty.get.nomer}">
<input type='hidden' name='f_agent' value="{$smarty.get.agent}">
<input type='hidden' name='f_obl' value="{$smarty.get.obl}">
<input type='hidden' name='f_rgn' value="{$smarty.get.rgn}">
<input type='hidden' name='f_mista' value="{$smarty.get.mista}">
<table width="98%">
	<tr bgcolor="#cdf2d3">
		<td valign="top" width=150>
			<br />&#160;<span onClick="show_group('1','6')" class="title"><a href="#" name="details" id="details">ЗАГАЛЬНЕ</a></span>
		</td>
		<td valign="top">
			<div id="group_1" style="visibility:visible;">
				<table cellpadding=2 cellspacing=1>
					<tr>
						<td><input type="radio" {if $commerc.prodazh || !$smarty.get.id}checked="checked"{/if} name=prodazh value=1 id=modeprod><label for="modeprod">Продаж</label></td>
						<td><input type="radio" {if $commerc.prodazh=="0"}checked="checked"{/if} name=prodazh value=0 id=modeorenda><label for="modeorenda">Оренда</label></td>
					</tr>
					<tr>
						<td>Номер в базі</td>
						<td><input type='text' name='num' value="{$commerc.num}"></td>
					</tr>
				<tr>
					<td>Область</td>
					<td>
						<select name='obl' id='obl' onChange="loadRgns('rgn',this.value);">							
							{foreach key=reg_id item=reg from=$regions}
								<option value="{$reg_id}" {if (!$smarty.get.id && $reg_id==2) || ($reg_id == $commerc.adr_obl)}selected="selected"{/if}>{$reg}</option>
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
								<option value="{$ray_id}" {if $ray_id == $commerc.adr_rgn}selected="selected"{/if}>{$ray}</option>
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
									<option value="{$m_id}" {if $m_id == $commerc.adr_gor}selected="selected"{/if}>{$misto}</option>
								{/foreach}
							{/if}
						</select>
					</td>
				</tr>
				<tr>
					<td>Вулиця<br><font color="#8F8F8F" size="-1">(виберіть)</font></td>
					<td><input type='text' name='vul' value="{$commerc.adr_vul}"><br>
                    <select name='vuls' id='vuls' onchange="vul.value=this.value;">
					  <option> </option>
                        {if $vuls}
							{foreach key=v_id item=vul from=$vuls}
								<option value="{$vul}">{$vul}</option>
							{/foreach}
						{/if}
                    </select></td>
				</tr>
				<tr>
					<td>Площа загальна</td>
					<td>
						<input type='text' name='pzag' value="{$commerc.pzag}" size=3> м<sup style='font-size:11px'>2</sup>
					</td>
				</tr>
				<tr>
					<td>Кількість кімнат</td>
					<td>
					<select name='kk'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						<option value="-1" {if $commerc.kk=="-1"}selected="selected"{/if}>частина квартири</option>
						<option value="1" {if $commerc.kk=="1"}selected="selected"{/if}>1-кімнатна</option>
						<option value="2" {if $commerc.kk=="2"}selected="selected"{/if}>2-кімнатна</option>
						<option value="3" {if $commerc.kk=="3"}selected="selected"{/if}>3-кімнатна</option>
						<option value="4" {if $commerc.kk=="4"}selected="selected"{/if}>4-кімнатна</option>
						<option value="99" {if $commerc.kk=="99"}selected="selected"{/if}>багатокімнатна</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Поверх/поверхів</td>
					<td>
						<input type='text' name='pov' value="{$commerc.pov}" size=3> / 
						<input type='text' name='povv' value="{$commerc.povv}" size=3>
					</td>
				</tr>
				<tr>
					<td>Висота стелі</td>
					<td><input type='text' name='stelya' value="{$commerc.stelya}" style="width:40px;"> см</td>
				</tr>
				<tr>
					<td>Планування</td>
					<td>
						{foreach key=plan_id item=plan from=$gen_info.planing}
								<input type="radio" value="{$plan_id}" name=planing {if $commerc.planing==$plan_id}checked="checked"{/if} id="plan[{$plan_id}]">
								<label for="plan[{$plan_id}]">{$plan}</label><br>
						{/foreach}
            <input type="button" onclick="offradio('planing');return false;" value="Жодного">
					</td>
				</tr>
				<tr>
					<td>Стан приміщення</td>
					<td>
						<select name='com_stan'>
						{foreach key=stan_id item=stan from=$gen_info.com_stan}
							{if $stan_id!=0}<option value={$stan_id} {if $commerc.com_stan==$stan_id}selected="selected"{/if}>{$stan}</option>{/if}
						{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>Кількість тел.ліній</td>
					<td><input type='text' name='tel_count' value="{$commerc.tel_count}" style="width:25px;"></td>
				</tr>
				<tr>
					<td>Ціна</td>
					<td><input type='text' name='cast' value="{$commerc.cast}" style='width:70px'>
						<select name='valuta'  style='width:40px'>
							<option value=1 {if $commerc.valuta=="1"}selected="selected"{/if}>грн.</option>
							<option value=2  {if !$smarty.get.id || $commerc.valuta=="2"}selected="selected"{/if}> $ </option>
							<option value=3 {if $commerc.valuta=="3"}selected="selected"{/if}> &euro; </option>
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
			{*--------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#dbdcf3">
		<td valign="top">
			<br />&#160;<span onClick="show_group('2','6')" class="title"><a href="#details">УМОВИ В ОФІСІ</a></span>
		</td>
		<td valign="top"> 
			<div id="group_2" style="display:none" name='panel' align="center">
				<table width="98%">
					{foreach key=of_id item=of from=$gen_info.in_office}
					{if ($of_id%2)==0}<tr>{/if}
						<td width="50%">
							<input type="checkbox" value=1 name=in_office[{$of_id}] id="of[{$of_id}]" {if $commerc.in_office[$of_id]}checked="checked"{/if}>
							<label for="of[{$of_id}]">{$of}</label><br>
						</td>
					{if ($of_id%2)==1}</tr>{/if}
					{/foreach}
                <tr style="background-color:#cbcce3">
				    <td>Кухня</td>
					<td>
						{foreach key=kuh_id item=kuh from=$gen_info.kuh}
								<input type="radio" value="{$kuh_id}" name=kuh {if $commerc.kuh==$kuh_id}checked="checked"{/if} id="kuh[{$kuh_id}]">
								<label for="kuh[{$kuh_id}]">{$kuh}</label><br>
						{/foreach}
            <input type="button" onclick="offradio('kuh');return false;" value="Жодного">
					</td>
				</tr>
				<tr style="background-color:#cbcce3">
					<td>Санвузол</td>
					<td>
						{foreach key=tual_id item=tual from=$gen_info.com_sanuzel}
				<input type="radio" value="{$tual_id}" name=com_sanuzel {if $commerc.com_sanuzel==$tual_id}checked="checked"{/if} id="tual[{$tual_id}]">
								<label for="tual[{$tual_id}]">{$tual}</label><br>
						{/foreach}
            <input type="button" onclick="offradio('com_sanuzel');return false;" value="Жодного">
					</td>
				</tr>
				</table>
			</div>
		</td>
	</tr>
			{*------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#f9cbf1">
		<td valign="top">
			<br />&#160;<span onClick="show_group('3','6')" class="title"><a href="#details">БУДІВЛЯ</a></span>
		</td>
		<td valign="top">
			<div id="group_3" style="display:none" align="center">
				<table cellpadding=2 cellspacing=1 width="98%">
					<tr>
						<td width="35%">Тип</td>
						<td>
							<select name='office_type' style="width:250px;">
							{foreach key=type_id item=type from=$gen_info.office_type}
								{if $type_id!=0}<option value={$type_id} {if $commerc.office_type==$type_id}selected="selected"{/if}>{$type}</option>{/if}
							{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>Клас</td>
						<td>
							<select name='class' style="width:50px;">
							{foreach key=class_id item=class from=$gen_info.class}
								<option value={$class_id} {if $commerc.class==$class_id}selected="selected"{/if}>{$class}</option>
							{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>Рік здачі</td>
						<td>
							<select name='TmSdch'>
							 	{if !$smarty.get.id}<option value='0' selected="selected">Оберіть</option>{/if}
								<option value="-1" {if $commerc.TmSdch=="-1"}selected="selected"{/if}>Зданий</option>
								<option value="0" {if $commerc.TmSdch=="0"}selected="selected"{/if}></option>
								<option value="2008" {if $commerc.TmSdch=="2008"}selected="selected"{/if}> 2008</option>
								<option value="2009" {if $commerc.TmSdch=="2009"}selected="selected"{/if}> 2009</option>
								<option value="2010" {if $commerc.TmSdch=="2010"}selected="selected"{/if}> 2010</option>
								<option value="2011" {if $commerc.TmSdch=="2011"}selected="selected"{/if}> 2011</option>
								<option value="2012" {if $commerc.TmSdch=="2012"}selected="selected"{/if}> 2012</option>
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
								<input type="checkbox" value=1 name=in_office_dom[{$pom_id}] {if $commerc.in_office_dom[$pom_id]}checked="checked"{/if} id="in_office_dom[{$pom_id}]">
								<label for="in_office_dom[{$pom_id}]">{$pom}</label><br>
							{/foreach}
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
		{*-------------------------------------------------------------------------------------------------------------------*}	
	<tr bgcolor="#ffe8e8">
		<td valign="top">
			<br />&#160;<span onClick="show_group('4','6')" class="title"><a href="#details">ДОДАТКОВО</a></span>
		</td>
		<td valign="top">
			<div id="group_4" style="display:none;" align="right">
				
				<table cellspacing="10" style="width:410px;">
					<tr>
						<td width="30%">Можливi варiанти використання</td>
						<td>
							{foreach key=var_id item=var from=$gen_info.com_var}
								<input type="checkbox" value=1 name=com_var[{$var_id}] {if $commerc.com_var[$var_id]}checked="checked"{/if} id="com_var[{$var_id}]">
								<label for="com_var[{$var_id}]">{$var}</label><br>
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>Також присутні</td>
						<td>
							{foreach key=sklad_id item=sklad from=$gen_info.com_in_sklad}
								<input type="checkbox" value=1 name=com_in_skladd[{$sklad_id}] {if $commerc.com_in_sklad[$sklad_id]}checked="checked"{/if} id="com_in_sklad[{$sklad_id}]">
								<label for="com_in_sklad[{$sklad_id}]">{$sklad}</label><br>
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>Короткий коментар</td>
						<td>
							<textarea name=comment style="width:260px;" rows=7>{$commerc.comment}</textarea>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
		{*-----------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#fff8e8">
		<td valign="top">
			<br />&#160;<span onClick="show_group('5','6')" class="title"><a href="#details">СЛУЖБОВЕ</a></span>
		</td>
		<td valign="top">
			<div id="group_5" style="display:none">
				<table width="90%">
					<tr>
						<td>Контактна особа</td>
						<td>
						<select name='agent' id='agent' style="width:300px">
						  {if !$smarty.get.id}<option value='0' selected="selected">Оберіть</option>{/if}
								{foreach key=ag_id item=ag from=$agents}
									<option value="{$ag_id}" {if $ag_id == $commerc.kont}selected="selected"{/if}>{$ag}</option>
								{/foreach}
						</select>
						</td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='hot' id="hot" {if $commerc.in_hot}checked="checked"{/if}><label for="hot">Гаряча пропозиція </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='onmain' id="onmain" {if $commerc.in_main}checked="checked"{/if}><label for="onmain">На головній </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='exclusive' id="exclusive" {if $commerc.exclusive}checked="checked"{/if}><label for="exclusive">Ексклзив </label></td>
					</tr>

				</table>
			</div>
		</td>
	</tr>
		{*-----------------------------------------------------------------------------------------------------------------*}
	
	<tr bgcolor="#fdfed3">
		<td valign="top">
			<br />&#160;<span onClick="show_group('6','6')" class="title"><a href="#details">ФОТОГРАФІЇ</a></span>
		</td>
		<td valign="top">
			
			<div id="group_6" style="display:none">
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