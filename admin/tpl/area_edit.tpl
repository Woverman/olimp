<form method="post" action='save/dil.php' enctype='multipart/form-data' onsubmit="return validateForm();">
<input type=hidden name='panel' value="dil">
<input type='hidden' name='type' value='dil'>
<input type='hidden' name='editid' value="{$smarty.get.id}">
<input type='hidden' name='f_nomer' value="{$smarty.get.nomer}">
<input type='hidden' name='f_agent' value="{$smarty.get.agent}">
<input type='hidden' name='f_obl' value="{$smarty.get.obl}">
<input type='hidden' name='f_rgn' value="{$smarty.get.rgn}">
<input type='hidden' name='f_mista' value="{$smarty.get.mista}">
<table width="98%">
	<tr bgcolor="#cdf2d3">
		<td valign="top" width=150>
			<br />&#160;<span onClick="show_group('1','8')" class="title"><a href="#" name="details" id="details">��������</a></span>
		</td>
		<td valign="top">
			<div id="group_1" style="visibility:visible;">
				<table cellpadding=2 cellspacing=1>
					<tr>
						<td><input type="radio" {if $dilyanka.prodazh || !$smarty.get.id}checked="checked"{/if} name=prodazh value=1 id=modeprod><label for="modeprod">������</label></td>
						<td><input type="radio" {if $dilyanka.prodazh=="0"}checked="checked"{/if} name=prodazh value=0 id=modeorenda><label for="modeorenda">������</label></td>
					</tr>
					<tr>
						<td>����� � ���</td>
						<td><input type='text' name='num' value="{$dilyanka.num}"></td>
					</tr>
				<tr>
					<td>�������</td>
					<td>
						<select name='obl' id='obl' onChange="loadRgns('rgn',this.value);">							
							{foreach key=reg_id item=reg from=$regions}
								<option value="{$reg_id}" {if (!$smarty.get.id && $reg_id==2) || ($reg_id == $dilyanka.adr_obl)}selected="selected"{/if}>{$reg}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>�����</td>
					<td>
						<select name='rgn' id='rgn' onChange="loadRgns('mista',this.value);"> 
								<option value=0>������ �����</option>
							{foreach key=ray_id item=ray from=$rayons}
								<option value="{$ray_id}" {if $ray_id == $dilyanka.adr_rgn}selected="selected"{/if}>{$ray}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>�����. �����</td>
					<td>
						<select name='mista' id='mista'>
									<option value=0>������ ���. �����</option>
							{if $mista}
								{foreach key=m_id item=misto from=$mista}
									<option value="{$m_id}" {if $m_id == $dilyanka.adr_gor}selected="selected"{/if}>{$misto}</option>
								{/foreach}
							{/if}
						</select>
					</td>
				</tr>
				<tr>
					<td>������<br><font color="#8F8F8F" size="-1">(�������)</font></td>
					<td><input type='text' name='vul' value="{$dilyanka.adr_vul}"><br>
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
					<td>��������</td>
					<td>
					<select name='vlasnist'>
						{if !$smarty.get.id}<option value=0 selected>������</option>{/if}
						{foreach key=vl_id item=vl from=$gen_info.vlasn}
								{if $vl_id!=0}<option value="{$vl_id}" {if $vl_id == $dilyanka.vlasnist}selected="selected"{/if}>{$vl}</option>{/if}
						{/foreach}
					</select>
					</td>
				</tr>
				<tr>
					<td>�����</td>
					<td><input type='text' name='pdil' value="{$dilyanka.pdil}" style='width:73px'>
						<select name='plo_od'  style='width:73px'>
							<option value=1 {if $dilyanka.plo_od=="1"}selected="selected"{/if}>�����</option>
							<option value=2 {if $dilyanka.plo_od=="2"}selected="selected"{/if}>��</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>ֳ��</td>
					<td><input type='text' name='cast' value="{$dilyanka.cast}" style='width:70px'>
					<select name='valuta'  style='width:40px'>
						<option value=1 {if $dilyanka.valuta=="1"}selected="selected"{/if}>���.</option>
						<option value=2  {if !$smarty.get.id || $dilyanka.valuta=="2"}selected="selected"{/if}> $ </option>
						<option value=3 {if $dilyanka.valuta=="3"}selected="selected"{/if}> &euro; </option>
					</select>
                    <select name='casttype'  style='width:60px'>
    					<option value=1 {if !$smarty.get.id || $commerc.casttype=="1"}selected="selected"{/if}>�� ���</option>
    					<option value=2 {if $commerc.casttype=="2"}selected="selected"{/if}> �� �<sup>2</sup> </option>
                        <option value=3 {if $commerc.casttype=="3"}selected="selected"{/if}> �� �����. </option>
    					<option value=4 {if $commerc.casttype=="4"}selected="selected"{/if}> �� 1 ��. </option>
        			</select>
					</td>
				</tr>
				</table>
			</div>

		</td>
	</tr>
			{*--------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#f2fff4">
		<td valign="top">
			<br />&#160;<span onClick="show_group('3','8')" class="title"><a href="#details">�����������</a></span>
		</td>
		<td valign="top"> 
			<div id="group_3" name='panel' style="display:none">
				<div style="margin: 7px 7px 7px 7px;">
					{foreach key=nazn_id item=nazn from=$gen_info.rTipC}
							<input type="checkbox" value=1 name=rTipC[{$nazn_id}] {if $dilyanka.rTipC[$nazn_id]}checked="checked"{/if} id="rTipC[{$nazn_id}]">
							<label for="rTipC[{$nazn_id}]">{$nazn}</label><br>
					{/foreach}
				</div>
			</div>
		</td>
	</tr>
		{*{if $dilyanka.dil_komm[$elektr_id]}{$dilyanka.dil_komm[$elektr_id]}{/if}-------------------------------------------------------------------------------------------------------------------*}	
	<tr bgcolor="#e8f2ff">
		<td valign="top">
			<br />&#160;<span onClick="show_group('2','8')" class="title"><a href="#details">����Ʋ</a></span>
		</td>
		<td valign="top">
			<div id="group_2" style="display:none">
				<table width="100%" cellspacing="10" border="0">
					<tr>
						<td>���������</td>
						<td>
							{foreach key=elektr_id item=elektr from=$gen_info.dil_komm}
								{if $elektr_id<3}
									<input type="checkbox" value="1" name="dil_komm[{$elektr_id}]" id="dil_komm[{$elektr_id}]" {if $dilyanka.dil_komm[$elektr_id]}checked="checked"{/if}>
									<label for="dil_komm[{$elektr_id}]">{$elektr}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>���</td>
						<td>
							{foreach key=gaz_id item=gaz from=$gen_info.dil_komm}
								{if $gaz_id>2 && $gaz_id<6}
									<input type="radio" value="{$gaz_id}" name=dil_gaz {if $dilyanka.dil_komm[$gaz_id]}checked="checked"{/if} id="dil_komm[{$gaz_id}]">
									<label for="dil_komm[{$gaz_id}]">{$gaz}</label><br>
								{/if}
							{/foreach}
                            <input type="button" onclick="offradio('dil_gaz');return false;" value="�������">
						</td>
					</tr>
					<tr>
						<td>����</td>
						<td>
							{foreach key=voda_id item=voda from=$gen_info.dil_komm}
								{if $voda_id>5 && $voda_id<9}
									<input type="checkbox" value="1" name=dil_komm[{$voda_id}] {if $dilyanka.dil_komm[$voda_id]}checked="checked"{/if} id="dil_komm[{$voda_id}]">
									<label for="dil_komm[{$voda_id}]">{$voda}</label><br>
								{/if}
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>����������</td>
						<td>
							{foreach key=kanal_id item=kanal from=$gen_info.dil_komm}
								{if $kanal_id>8 && $kanal_id<12}
									<input type="checkbox" value="1" name=dil_komm[{$kanal_id}] {if $dilyanka.dil_komm[$kanal_id]}checked="checked"{/if} id="dil_komm[{$kanal_id}]">
									<label for="dil_komm[{$kanal_id}]">{$kanal}</label><br>
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
			<br />&#160;<span onClick="show_group('4','8')" class="title"><a href="#details">Ĳ�����</a></span>
		</td>
		<td valign="top"> 
			<div id="group_4" name='panel' style="display:none" align="center">
				<table width="98%">
					{foreach key=dop_id item=dop from=$gen_info.dil_indil}
					{if ($dop_id%2)==0}<tr>{/if}
						<td width="50%">
							<input type="checkbox" value=1 name=dil_indil[{$dop_id}] id="dil_indil[{$dop_id}]" {if $dilyanka.dil_indil[$dop_id]}checked="checked"{/if}>
							<label for="dil_indil[{$dop_id}]">{$dop}</label><br>
						</td>
					{if ($dop_id%2)==1}<tr>{/if}
					{/foreach}
					</tr>
				</table>
			</div>
		</td>
	</tr>
			{*------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#f9cbf1">
		<td valign="top">
			<br />&#160;<span onClick="show_group('5','8')" class="title"><a href="#details">���������</a></span>
		</td>
		<td valign="top">
			<div id="group_5" style="display:none" align="center">
				<table width="100%" cellspacing="10" border="0">
					<tr>
						<td>������������</td>
						<td>
							{foreach key=polozh_id item=polozh from=$gen_info.dil_pos}
								<input type="radio" value="{$polozh_id}" name=dil_polozh {if $dilyanka.dil_pos[$polozh_id]}checked="checked"{/if} id="dil_polozh[{$polozh_id}]">
								<label for="dil_polozh[{$polozh_id}]">{$polozh}</label><br>
							{/foreach}
                            <input type="button" onclick="offradio('dil_polozh');return false;" value="�������">
						</td>
					</tr>
					<tr>
						<td>³������ ��:</td>
						<td>
							<table>
								<tr>
									<td>- ��� (�����)</td>
									<td><input type='text' name='dist1' value="{$dilyanka.dist1}" style="width:50px;"> �</td>
								</tr>
								<tr>
									<td>- ����</td>
									<td><input type='text' name='dist2' value="{$dilyanka.dist2}" style="width:50px;"> �</td>
								</tr>
								<tr>
									<td>- �����</td>
									<td><input type='text' name='dist3' value="{$dilyanka.dist3}" style="width:50px;"> �</td>
								</tr>
								<tr>
									<td>- ����</td>
									<td><input type='text' name='dist4' value="{$dilyanka.dist4}" style="width:50px;"> �</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
		{*-------------------------------------------------------------------------------------------------------------------*}	
	<tr bgcolor="#ffe8e8">
		<td valign="top">
			<br />&#160;<span onClick="show_group('6','8')" class="title"><a href="#details">���������</a></span>
		</td>
		<td valign="top">
			<div id="group_6" style="display:none">
				<div style="margin: 7px 7px 7px 7px;">
				{foreach key=dod_id item=dod from=$gen_info.dil_add}
					<input type="checkbox" value=1 name=dil_add[{$dod_id}] {if $dilyanka.dil_add[$dod_id]}checked="checked"{/if} id="dil_add[{$dod_id}]">
					<label for="dil_add[{$dod_id}]">{$dod}</label><br>
				{/foreach}
				<BR>
				<h4>�������� ��������</h4>
				<textarea name=comment cols=40 rows=10>{$dilyanka.comment}</textarea>
				<BR><BR>
				</div>
			</div>
		</td>
	</tr>
		{*-----------------------------------------------------------------------------------------------------------------*}
	<tr bgcolor="#fff8e8">
		<td valign="top">
			<br />&#160;<span onClick="show_group('7','8')" class="title"><a href="#details">��������</a></span>
		</td>
		<td valign="top">
			<div id="group_7" style="display:none">
				<table width="90%">
					<tr>
						<td>��������� �����</td>
						<td>
						<select name='agent' id='agent' style="width:300px">
						  {if !$smarty.get.id}<option value='0' selected="selected">������</option>{/if}
								{foreach key=ag_id item=ag from=$agents}
									<option value="{$ag_id}" {if $ag_id == $dilyanka.kont}selected="selected"{/if}>{$ag}</option>
								{/foreach}
						</select>
						</td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='hot' id="hot" {if $dilyanka.in_hot}checked="checked"{/if}><label for="hot">������ ���������� </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='onmain' id="onmain" {if $dilyanka.in_main}checked="checked"{/if}><label for="onmain">�� ������� </label></td>
					</tr>
					<tr>
						<td colspan=2><input type=checkbox value=1 name='exclusive' id="exclusive" {if $dilyanka.exclusive}checked="checked"{/if}><label for="exclusive">��������� </label></td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
		{*-----------------------------------------------------------------------------------------------------------------*}
	
	<tr bgcolor="#fdfed3">
		<td valign="top">
			<br />&#160;<span onClick="show_group('8','8')" class="title"><a href="#details">�������Բ�</a></span>
		</td>
		<td valign="top">
			
			<div id="group_8" style="display:none">
				{if !$smarty.get.id}
					������������ ���� �������� <br>����� ��� ���������� ��� ���������� ������.<br><br>
          <i>(������������ �������� ����, �� ����� ������ ������, �������� ����� ������ ��������� ��� � ����� �����.
          ��� ���������� ������ �������� �����, ��������� �������� ���� ��� �������� ��'���� ��������.)</i>
				{else}
          <BR>
          <center>���� �������� (����� �������� - 1024�768)</center><BR />
					<input type="hidden" name="MAX_FILE_SIZE" value="2048000" />
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=1" align=right>���� 1:<br><input type=file name=Img1 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_1"><label for="fdel_1"> ������� </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=2" align=right>���� 2:<br><input type=file name=Img2 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_2"><label for="fdel_2"> ������� </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=3" align=right>���� 3:<br><input type=file name=Img3 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_3"><label for="fdel_3"> ������� </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=4" align=right>���� 4:<br><input type=file name=Img4 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_4"><label for="fdel_4"> ������� </label></p>
<p><img src="/image.php?objid={$smarty.get.id}&mode=2&num=5" align=right>���� 5:<br><input type=file name=Img5 size=30 maxlength=128><br>
<input type="checkbox" name="fdel_5"><label for="fdel_5"> ������� </label></p>
					<BR><BR>
				{/if}
			</div>
		</td>
	</tr>
	
</table>
<br /><br />
<div class="forbtn"><input type=submit value='�������� ���'></div>
</form>