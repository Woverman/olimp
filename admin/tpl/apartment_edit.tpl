<form method="post" action='save/kva.php' enctype='multipart/form-data' onsubmit="return validateForm();">
<input type=hidden name='panel' value="kva">
<input type='hidden' name='type' value='kva'>
<input type='hidden' name='editid' value="{$smarty.get.id}">
<input type='hidden' name='f_nomer' value="{$smarty.get.nomer}">
<input type='hidden' name='f_agent' value="{$smarty.get.agent}">
<input type='hidden' name='f_obl' value="{$smarty.get.obl}">
<input type='hidden' name='f_rgn' value="{$smarty.get.rgn}">
<input type='hidden' name='f_mista' value="{$smarty.get.mista}">

<table width="98%">
	<tr bgcolor="#f2fff4">
		<td valign="top" width=150>
			<br />&#160;<span onClick="show_group('1','6')" class="title"><a href="#" name="details" id="details">ЗАГАЛЬНЕ</a></span>
		</td>
		<td valign="top">
			<div id="group_1" style="visibility:visible;">
				<table cellpadding=2 cellspacing=1>
					<tr>
						<td><input type="radio" {if $kv.prodazh || !$smarty.get.id}checked="checked"{/if} name=prodazh value=1 id=modeprod><label for="modeprod">Продаж</label></td>
						<td><input type="radio" {if $kv.prodazh=="0"}checked="checked"{/if} name=prodazh value=0 id=modeorenda><label for="modeorenda">Оренда</label></td>
					</tr>
					<tr>
						<td>Номер в базі</td>
						<td><input type='text' name='num' value="{$kv.num}"></td>
					</tr>
				<tr>
					<td>Область</td>
					<td>
						<select name='obl' id='obl' onChange="loadRgns('rgn',this.value);"> {*	HideZeroItem('obl');	*}							
							{foreach key=reg_id item=reg from=$regions}
								<option value="{$reg_id}" {if (!$smarty.get.id && $reg_id==2) || ($reg_id == $kv.adr_obl)}selected="selected"{/if}>{$reg}</option>
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
								<option value="{$ray_id}" {if $ray_id == $kv.adr_rgn}selected="selected"{/if}>{$ray}</option>
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
									<option value="{$m_id}" {if $m_id == $kv.adr_gor}selected="selected"{/if}>{$misto}</option>
								{/foreach}
							{/if}
						</select>
					</td>
				</tr>
				<tr>
					<td>Вулиця<br><font color="#8F8F8F" size="-1">(виберіть)</font></td>
					<td><input type='text' name='vul' value="{$kv.adr_vul}"><br>
          <select name='vuls' id='vuls' onchange="vul.value=this.value;">
					  <option> </option>
            {if $vuls}
							{foreach key=v_id item=vul from=$vuls}
								<option value="{$vul}">{$vul}</option>
							{/foreach}
						{/if}
          </td></select>
				</tr>
				<tr>
					<td>Тип квартири</td>
					<td>
					<select name='typekva'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						 <option value=1 {if $kv.kva_type==1}selected="selected"{/if}>роздільні кімнати </option>
						 <option value=2 {if $kv.kva_type==2}selected="selected"{/if}>суміжні кімнати </option>
						 <option value=3 {if $kv.kva_type==3}selected="selected"{/if}>з/р кімнати </option>
						 <option value=4 {if $kv.kva_type==4}selected="selected"{/if}>гостинка </option>
						 <option value=5 {if $kv.kva_type==5}selected="selected"{/if}>студія </option>
						 <option value=6 {if $kv.kva_type==6}selected="selected"{/if}>двохрівнева </option>
						 <option value=7 {if $kv.kva_type==7}selected="selected"{/if}>багаторівнева </option>
						 <option value=8 {if $kv.kva_type==8}selected="selected"{/if}>пентхауз </option>
					 </select>
					</td>
				</tr>
				<tr>
					<td>Кількість кімнат</td>
					<td>
					<select name='kk'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						<option value="-1" {if $kv.kk=="-1"}selected="selected"{/if}>частина квартири</option>
						<option value="1" {if $kv.kk=="1"}selected="selected"{/if}>1-кімнатна</option>
						<option value="2" {if $kv.kk=="2"}selected="selected"{/if}>2-кімнатна</option>
						<option value="3" {if $kv.kk=="3"}selected="selected"{/if}>3-кімнатна</option>
						<option value="4" {if $kv.kk=="4"}selected="selected"{/if}>4-кімнатна</option>
						<option value="99" {if $kv.kk=="99"}selected="selected"{/if}>багатокімнатна</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Стан квартири</td>
					<td>
					<select name='stan'>
						{if !$smarty.get.id}<option value=0 selected>Оберіть</option>{/if}
						<option value="-2" {if $kv.kva_stan=="-2"}selected="selected"{/if}>без внутр. робіт</option>
						<option value="-1" {if $kv.kva_stan=="-1"}selected="selected"{/if}>йде ремонт</option>
						<option value="1" {if $kv.kva_stan=="1"}selected="selected"{/if}>штукатурка</option>
						<option value="2" {if $kv.kva_stan=="2"}selected="selected"{/if}>поганий</option>
						<option value="3" {if $kv.kva_stan=="3"}selected="selected"{/if}>нормальний</option>
						<option value="4" {if $kv.kva_stan=="4"}selected="selected"{/if}>гарний</option>
						<option value="5" {if $kv.kva_stan=="5"}selected="selected"{/if}>відмінний</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Строк здачі</td>
					<td>
					<select name=TmSdch size=1>
						<option value="-1" {if $kv.kva_zdan=="-1"}selected="selected"{/if}>Зданий</option>
						<option value="0" {if !$smarty.get.id || $kv.kva_zdan=="0"}selected="selected"{/if}></option>
						<option value="2008" {if $kv.kva_zdan=="2008"}selected="selected"{/if}> 2008</option>
						<option value="2009" {if $kv.kva_zdan=="2009"}selected="selected"{/if}> 2009</option>
						<option value="2010" {if $kv.kva_zdan=="2010"}selected="selected"{/if}> 2010</option>
						<option value="2011" {if $kv.kva_zdan=="2011"}selected="selected"{/if}> 2011</option>
						<option value="2012" {if $kv.kva_zdan=="2012"}selected="selected"{/if}> 2012</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Поверх/поверхів</td>
					<td>
						<input type='text' name='pov' value="{$kv.pov}" size=3> /
						<input type='text' name='povv' value="{$kv.povv}" size=3>
					</td>
				</tr>
				<tr>
					<td>Площа м<sup style='font-size:11px'>2</sup> (заг./житл./кухня)</td>
					<td>
						<input type='text' name='pzag' value="{$kv.pzag}" size=3> /
						<input type='text' name='pzhil' value="{$kv.pzit}" size=3> /
						<input type='text' name='pkuh' value="{$kv.pkuh}" size=3>
					</td>
				</tr>
				<tr>
					<td>Висота стелі (см)</td>
					<td><input type='text' name='stelya' value="{$kv.stelya}"></td>
				</tr>
				<tr>
				<td>Санвузли</td>
					<td>
						<select name='SanUzli'>
						{if !$smarty.get.id}<option value='' selected>Оберіть</option>{/if}
						<option value='0' {if $kv.sanuzel=="0"}selected="selected"{/if}>окремо</option>
						<option value='-1' {if $kv.sanuzel=="-1"}selected="selected"{/if}>суміжний</option>
						<option value='2' {if $kv.sanuzel=="2"}selected="selected"{/if}>2</option>
						<option value='3' {if $kv.sanuzel=="3"}selected="selected"{/if}>3</option>
						<option value='4' {if $kv.sanuzel=="4"}selected="selected"{/if}>4</option>
						<option value='5' {if $kv.sanuzel=="5"}selected="selected"{/if}>5</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Лоджії (всього/заскл.)</td>
					<td>
						<input type='text' name='Lodzh' value="{if !$smarty.get.id || $kv.lodg==""}0{else}{$kv.lodg}{/if}" size=1> /
						<input type='text' name='lZstk' value="{if !$smarty.get.id || $kv.lodg_z==""}0{else}{$kv.lodg_z}{/if}" size=1>
					</td>
				</tr>
				<tr>
					<td>Балкони (всього/заскл.)</td>
					<td>
						<input type='text' name='Balk' value="{if !$smarty.get.id || $kv.balkon==""}0{else}{$kv.balkon}{/if}" size=1> /
						<input type='text' name='bZstk' value="{if !$smarty.get.id || $kv.balkon_z==""}0{else}{$kv.balkon_z}{/if}" size=1>
					</td>
				</tr>
				<tr>
					<td>Ціна</td>
					<td><input type='text' name='cast' value="{$kv.cast}" style='width:70px'>
					<select name='valuta'  style='width:40px'>
						<option value=1 {if $kv.valuta=="1"}selected="selected"{/if}>грн.</option>
						<option value=2  {if !$smarty.get.id || $kv.valuta=="2"}selected="selected"{/if}> $ </option>
						<option value=3 {if $kv.valuta=="3"}selected="selected"{/if}> &euro; </option>
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
	<tr bgcolor="#e8f2ff">
		<td valign="top">
			<br />&#160;<span onClick="show_group('2','6')" class="title"><a href="#details">УМОВИ У КВАРТИРІ</a></span>
		</td>
		<td valign="top"> 
			<div id="group_2" name='panel' style="display:none">
				<table boredr=0 width=100% CELLPADDING=0 CELLSPACING=0>
				<tr><td>
				<input type=checkbox value=1 name=DopVC[0] {if $kv.inkva_details[1]}checked="checked"{/if} id="tel"><label for="tel">телефон</label><br>
				<input type=checkbox value=1 name=DopVC[1] {if $kv.inkva_details[2]}checked="checked"{/if} id="sp"><label for="sp">склопакети</label><br>
				<input type=checkbox value=1 name=DopVC[2] {if $kv.inkva_details[3]}checked="checked"{/if} id="vp"><label for="vp">вільне планування</label><br>
				<input type=checkbox value=1 name=DopVC[3] {if $kv.inkva_details[4]}checked="checked"{/if} id="ks"><label for="ks">кухня-студія</label><br>
				<input type=checkbox value=1 name=DopVC[4] {if $kv.inkva_details[5]}checked="checked"{/if} id="brd"><label for="brd">броньовані двері</label><br>
				<input type=checkbox value=1 name=DopVC[5] {if $kv.inkva_details[6]}checked="checked"{/if} id="vid"><label for="vid">видова</label><br>
				<input type=checkbox value=1 name=DopVC[6] {if $kv.inkva_details[7]}checked="checked"{/if} id="con"><label for="con">кондеціонер(и)</label><br>
				<input type=checkbox value=1 name=DopVC[7] {if $kv.inkva_details[8]}checked="checked"{/if} id="sign"><label for="sign">сигналізація</label><br>
				<input type=checkbox value=1 name=DopVC[8] {if $kv.inkva_details[9]}checked="checked"{/if} id="video"><label for="video">відеоспостереження</label><br>
				<input type=checkbox value=1 name=DopVC[9] {if $kv.inkva_details[10]}checked="checked"{/if} id="domf"><label for="domf">домофон</label><br>
				<input type=checkbox value=1 name=DopVC[10] {if $kv.inkva_details[11]}checked="checked"{/if} id="tpol"><label for="tpol">&laquo;теплі поли&raquo;</label><br>
				<input type=checkbox value=1 name=DopVC[11] {if $kv.inkva_details[12]}checked="checked"{/if} id="kam"><label for="kam">камін</label><br>
				<input type=checkbox value=1 name=DopVC[12] {if $kv.inkva_details[13]}checked="checked"{/if} id="lvo"><label for="lvo">лічильник води</label><br>
				<input type=checkbox value=1 name=DopVC[13] {if $kv.inkva_details[14]}checked="checked"{/if} id="gkol"><label for="gkol">газова колонка</label><br>
				<input type=checkbox value=1 name=DopVC[14] {if $kv.inkva_details[15]}checked="checked"{/if} id="boy"><label for="boy">бойлер</label><br>
				</td><td>
				<input type=checkbox value=1 name=DopVC[15] {if $kv.inkva_details[16]}checked="checked"{/if} id="prm"><label for="prm">пральна машина</label><br>
				<input type=checkbox value=1 name=DopVC[16] {if $kv.inkva_details[17]}checked="checked"{/if} id="dj"><label for="dj">джакузі</label><br>
				<input type=checkbox value=1 name=DopVC[17] {if $kv.inkva_details[18]}checked="checked"{/if} id="sa"><label for="sa">сауна</label><br>
				<input type=checkbox value=1 name=DopVC[18] {if $kv.inkva_details[19]}checked="checked"{/if} id="kab"><label for="kab">кабельне ТБ</label><br>
				<input type=checkbox value=1 name=DopVC[19] {if $kv.inkva_details[20]}checked="checked"{/if} id="sput"><label for="sput">супутникове ТБ</label><br>
				<input type=checkbox value=1 name=DopVC[20] {if $kv.inkva_details[21]}checked="checked"{/if} id="inet"><label for="inet">інтернет</label><br>
				<input type=checkbox value=1 name=DopVC[21] {if $kv.inkva_details[22]}checked="checked"{/if} id="vkuh"><label for="vkuh">вбуд. кухня</label><br>
				<input type=checkbox value=1 name=DopVC[22] {if $kv.inkva_details[23]}checked="checked"{/if} id="meb"><label for="meb">меблі</label><br>
				<input type=checkbox value=1 name=DopVC[23] {if $kv.inkva_details[24]}checked="checked"{/if} id="imp"><label for="imp">імп. сантехніка</label><br>
				<input type=checkbox value=1 name=DopVC[24] {if $kv.inkva_details[25]}checked="checked"{/if} id="comp"><label for="comp">комп'ютер</label><br>
				<input type=checkbox value=1 name=DopVC[25] {if $kv.inkva_details[26]}checked="checked"{/if} id="dkin"><label for="dkin">дом.кінотеатр</label><br>
				<input type=checkbox value=1 name=DopVC[26] {if $kv.inkva_details[27]}checked="checked"{/if} id="tv"><label for="tv">телевізор</label><br>
				<input type=checkbox value=1 name=DopVC[27] {if $kv.inkva_details[28]}checked="checked"{/if} id="xol"><label for="xol">холодильник</label><br>
				<input type=checkbox value=1 name=DopVC[28] {if $kv.inkva_details[29]}checked="checked"{/if} id="pos"><label for="pos">посудомийка</label><br>
				<input type=checkbox value=1 name=DopVC[29] {if $kv.inkva_details[30]}checked="checked"{/if} id="parc"><label for="parc">паркет</label><br>
				<input type=checkbox value=1 name=DopVC[30] {if $kv.inkva_details[31]}checked="checked"{/if} id="opal"><label for="opal">індив. опалення </label><br

				</td></tr></table>
			</div>
		</td>
	</tr>
			{*------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#f9cbf1">
		<td valign="top">
			<br />&#160;<span onClick="show_group('3','6')" class="title"><a href="#details">БУДИНОК ЗАГАЛОМ</a></span>
		</td>
		<td valign="top">
			<div id="group_3" style="display:none"><BR><BR>
				<table boredr=0 width=100% CELLPADDING=0 CELLSPACING=0>
					<tr><td width=50%>
						Тип<br>
						<select name='domtype'>
						 {if !$smarty.get.id}<option value='0' selected="selected">Оберіть</option>{/if}
							<option value=1 {if $kv.kva_domtype=="1"}selected="selected"{/if}>Новобудова </option>
							<option value=2 {if $kv.kva_domtype=="2"}selected="selected"{/if}>"чешка" </option>
							<option value=3 {if $kv.kva_domtype=="3"}selected="selected"{/if}>"сталінка" </option>
							<option value=4 {if $kv.kva_domtype=="4"}selected="selected"{/if}>"хрущовка" </option>
							<option value=5 {if $kv.kva_domtype=="5"}selected="selected"{/if}>покращений</option>
							<option value=6 {if $kv.kva_domtype=="6"}selected="selected"{/if}>малосімейка </option>
							<option value=7 {if $kv.kva_domtype=="7"}selected="selected"{/if}>комунальний </option>
							<option value=8 {if $kv.kva_domtype=="8"}selected="selected"{/if}>гуртожиток </option>
							<option value=9 {if $kv.kva_domtype=="9"}selected="selected"{/if}>"дореволюційний" </option>
							<option value=10 {if $kv.kva_domtype=="10"}selected="selected"{/if}>індивідуальний </option>
						</select>
						<br><br>Зовнішні стіни<br>
						<input type=checkbox value=1 name=Stinu[0] {if $kv.stinu_details[1]}checked="checked"{/if} id="mnk"><label for="mnk">монолітно-каркасні</label><br>
						<input type=checkbox value=1 name=Stinu[1] {if $kv.stinu_details[2]}checked="checked"{/if} id="pan"><label for="pan">панельні</label><br>
						<input type=checkbox value=1 name=Stinu[2] {if $kv.stinu_details[3]}checked="checked"{/if} id="mon"><label for="mon">монолітні</label><br>
						<input type=checkbox value=1 name=Stinu[3] {if $kv.stinu_details[4]}checked="checked"{/if} id="cr"><label for="cr">цегла(червона)</label><br>
						<input type=checkbox value=1 name=Stinu[4] {if $kv.stinu_details[5]}checked="checked"{/if} id="cs"><label for="cs">цегла(силикатна)</label><br>
						<input type=checkbox value=1 name=Stinu[5] {if $kv.stinu_details[6]}checked="checked"{/if} id="ut"><label for="ut">з утеплювачем</label><br>
						</td><td>
						Додатково в будинку<br>
						<input type=checkbox value=1 name=IsOptC[0] {if $kv.indom_details[1]}checked="checked"{/if} id="teh"><label for="teh">техповерх</label><br>
						<input type=checkbox value=1 name=IsOptC[1] {if $kv.indom_details[2]}checked="checked"{/if} id="pid"><label for="pid">підвал</label><br>
						<input type=checkbox value=1 name=IsOptC[2] {if $kv.indom_details[3]}checked="checked"{/if} id="kap"><label for="kap">кап.ремонт</label><br>
						<input type=checkbox value=1 name=IsOptC[3] {if $kv.indom_details[4]}checked="checked"{/if} id="lift"><label for="lift">ліфт</label><br>
						<input type=checkbox value=1 name=IsOptC[4] {if $kv.indom_details[5]}checked="checked"{/if} id="gas"><label for="gas">газ</label><br>
						<input type=checkbox value=1 name=IsOptC[5] {if $kv.indom_details[6]}checked="checked"{/if} id="sm"><label for="sm">сміттєпровід</label><br>
						<input type=checkbox value=1 name=IsOptC[6] {if $kv.indom_details[7]}checked="checked"{/if} id="ohr"><label for="ohr">охорона</label><br>
						<input type=checkbox value=1 name=IsOptC[7] {if $kv.indom_details[8]}checked="checked"{/if} id="cod"><label for="cod">кодовий замок</label><br>
						<input type=checkbox value=1 name=IsOptC[8] {if $kv.indom_details[9]}checked="checked"{/if} id="kot"><label for="kot">автоном.котельня</label><br>
						<br>
						<input type=checkbox value=1 name=IsOptC[9] {if $kv.indom_details[10]}checked="checked"{/if} id="par"><label for="par">парковка</label><br>
						<input type=checkbox value=1 name=IsOptC[10] {if $kv.indom_details[11]}checked="checked"{/if} id="tr"><label for="tr">поруч транспорт</label><br>
						<input type=checkbox value=1 name=IsOptC[11] {if $kv.indom_details[12]}checked="checked"{/if} id="tiho"><label for="tiho">тихе місце</label><br>
						<input type=checkbox value=1 name=IsOptC[12] {if $kv.indom_details[13]}checked="checked"{/if} id="auto"><label for="auto">авто.стоянка</label><br>

					</td></tr>
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
			<div id="group_4" style="display:none"><BR>
				<h4>Короткий коментар</h4>
				<textarea name=comment cols=45 rows=15>{$kv.comment}</textarea>
				<BR><BR>
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
									<option value="{$ag_id}" {if $ag_id == $kv.kont}selected="selected"{/if}>{$ag}</option>
								{/foreach}
						</select>
						</td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='hot' id="hot" {if $kv.in_hot}checked="checked"{/if}><label for="hot">Гаряча пропозиція </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='onmain' id="onmain" {if $kv.in_main}checked="checked"{/if}><label for="onmain">На головній </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='exclusive' id="exclusive" {if $kv.exclusive}checked="checked"{/if}><label for="exclusive">Ексклюзив </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='novobud' id="novobud" {if $kv.novobud}checked="checked"{/if}><label for="novobud">Новобудова </label></td>
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