<div id="center_panel">
    <div id="wrapper">
<div style="padding: 0 50px;">
<?php
function mosGetParam($a,$b,$c){
  if (isset($a[$b])) {return $a[$b];}
  else return $c;
}
$task= mosGetParam( $_REQUEST, 'task', 0 );
switch ($task)
{

case 3 :
$obs_stoimost = mosGetParam( $_REQUEST, 'forma1', 0 );
$perv_vznos = mosGetParam( $_REQUEST, 'forma2', 0 );
$sum_kredita = $obs_stoimost - $perv_vznos;
$proz_stavka = mosGetParam( $_REQUEST, 'forma4', 0 );
$srok = mosGetParam( $_REQUEST, 'forma5', 0 );
$shema_pogashenija = mosGetParam( $_REQUEST, 'forma6', 0 );
?>
<br />
<img src='/i/printer-icon.gif' align="right" alt="Друкувати" border="0" style="cursor: pointer;" onclick="OpenToPrint()">
<p align="left">
<h4>Графік повернення кредиту</h4>
<? if ($shema_pogashenija == 1) echo('(стандартний спосіб повернення)');
else echo('(аннуітет)');?>
<br />
<table align="center" width="80%" cellpadding="4" cellspacing="0" border="0" style="border:1px solid #D0D0D0">
  <tr bgcolor="#FAFAFA">
    <td align="left" colspan=5>Ринкова вартість:	</td>
    <td align="right"><?=$obs_stoimost?></td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td align="left" colspan=5>Сума першого внеску:	</td>
    <td align="right"><?=$perv_vznos?></td>
  </tr>
  <tr bgcolor="#FAFAFA">
    <td align="left" colspan=5>Відсоткова ставка:</td>
    <td align="right"><?=$proz_stavka?>%</td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td align="left" colspan=5>Строк погашения, міс.:</td>
    <td align="right"><?=$srok?></td>
  </tr>
  <tr bgcolor="#FAFAFA">
    <td align="left" colspan=5>Сума кредиту:</td>
    <td align="right"><?=$sum_kredita?></td>
  </tr>
<tr style='background-color: #B1DF92'><th>Місяць</th><th>Рік</th><th>Залишок кредиту</th><th>Тіло кредиту</th><th>Платіж</th><th>Разом за місяць</th></tr>
<?
if ($shema_pogashenija == 1) {
$ost_credita = $sum_kredita;
$osn_platez = $sum_kredita/$srok;
$prozenti = $ost_credita*$proz_stavka/100/12;
$vsego_za_platez = $osn_platez+$prozenti;

		$totalsum = 0; $totalprozent = 0;
		$k=0; // для цвета ряда
		for ($i=1; $i<($srok+1); $i++) {
		$prozenti = $ost_credita*$proz_stavka/100/12;
		$vsego_za_platez = $osn_platez+$prozenti;
		if ($k == 0) $style = " style='background-color: #F8F8F8;' ";
		if ($k == 1) $style = " style='background-color: #D1E9F3;' ";
		echo "<tr ".$style."><td>&nbsp; ".$i."</td><td>&nbsp; ".floor(($i+11)/12)."-й</td><td>&nbsp; ".round($ost_credita,2)."</td><td>&nbsp; ".round($osn_platez,2)."</td><td>&nbsp; ".round($prozenti,2)."</td><td>&nbsp; ".round($vsego_za_platez,2)."</td></tr>";
		$ost_credita = $ost_credita - $osn_platez;
		$totalsum = $totalsum + $osn_platez;
		$totalprozent = $totalprozent + $prozenti;
		$k = 1 - $k;
		};
echo "<tr style='background-color: #B1DF92'><th colspan='3' align='left'>Всього: </th><th>".round($totalsum,2)."</th><th>".round($totalprozent,2)."</th><th>".round(($totalsum + $totalprozent),2)."</th></tr>";
echo "</table></p>";
}
if ($shema_pogashenija == 2) {
$ost_credita = $sum_kredita;

$vsego_za_platez = $ost_credita*$proz_stavka/1200/(1-pow(1+$proz_stavka/1200,-1*$srok));
$prozenti = $ost_credita*$proz_stavka/1200;
$osn_platez = $vsego_za_platez - $prozenti;
//$vsego_za_platez = ($sum_kredita*$proz_stavka/12*pow((1+$proz_stavka/12),$srok)/(pow((1+$proz_stavka/12),$srok) - 1));
		$totalsum = 0; $totalprozent = 0;
		$k=0; // для цвета ряда
		for ($i=1; $i<($srok+1); $i++) {
		$prozenti = $ost_credita*$proz_stavka/1200;
		$osn_platez = $vsego_za_platez - $prozenti;
		$ost_credita = $ost_credita - $osn_platez;
		if ($k == 0) $style = " style='background-color: #F8F8F8;' ";
		if ($k == 1) $style = " style='background-color: #D1E9F3;' ";
		echo "<tr ".$style."><td>&nbsp; ".$i."</td><td>&nbsp; ".floor(($i+11)/12)."-й</td><td>&nbsp; ".round($ost_credita,2)."</td><td>&nbsp; ".round($osn_platez,2)."</td><td>&nbsp; ".round($prozenti,2)."</td><td>&nbsp; ".round($vsego_za_platez,2)."</td></tr>";
		$totalsum = $totalsum + $osn_platez;
		$totalprozent = $totalprozent + $prozenti;
		$k = 1 - $k;
		};
echo "<tr style='background-color: #B1DF92'><th colspan='3' align='left'>Вього: </th><th>".round($totalsum,2)."</th><th>".round($totalprozent,2)."</th><th>".round(($totalsum + $totalprozent),2)."</th></tr>";
echo "</table>";
}
break;
default :
$itemid= mosGetParam( $_REQUEST, 'Itemid', 0 );
?>
<!--  /([+-]?)[0-9]+(.?[0-9]+)/g; - регулярное выражение для дробных чисел;
   /([+-]?)[0-9]+/g; - регулярное выражение для целых чисел (со знаком). -->
<SCRIPT LANGUAGE="JavaScript">
function checkmailform(){
if (! (/^[0-9]*$/.test(document.forms.calc.forma5.value)) ){
alert("Помилка в кількості місяців!");
document.forms.calc.forma5.focus();
return false;
}
if (! (/^-?\d+[\.]?\d+$/.test(document.forms.calc.forma4.value)) ){
alert("Не вказана відсоткова ставка!");
document.forms.calc.forma4.focus();
return false;
}
if (! (/^[0-9]*$/.test(document.forms.calc.forma3.value)) ){
alert("Помилка в сумі!");
document.forms.calc.forma3.focus();
return false;
}
if (! (/^[0-9]*$/.test(document.forms.calc.forma2.value)) ){
alert("Невірний перший внесок!");
document.forms.calc.forma2.focus();
return false;
}
if (document.forms.calc.forma5.value == ""){
alert("Не вказаний строк погашення!");
document.forms.calc.forma5.focus();
return false;
}
return true;
}

function raschet()
{
if ((document.forms.calc.forma2.value != "") && (document.forms.calc.forma1.value != ""))
{
document.forms.calc.forma3.value = document.forms.calc.forma1.value - document.forms.calc.forma2.value;
}

}
</SCRIPT>
<br />
<b>Мрієте про власне житло але Вам не вистачає коштів?</b><br /><br />
<u><font size="+1" color="#FF0000">Ми допоможемо Вам здійснити Вашу мрію!</font></u><br><br />
<img src="/i/0b.jpg" align="left" style="margin-right:5px;border:3px double gray">
<p align="justify">
Ми допоможемо Вам отримати найкращий кредит на житло, з існуючих на банківському ринку України.
Сьогодні ми працюємо з усіма провідними банками України, філії яких відкриті в нашому місті.<br /><br />
  <b>Отже, що для цього необхідно зробити?<br /></b>
1. Зверніться до нас і розкажіть про ваші побажання щодо майбутнього житла.<br />
2. Ми підберемо оптимальний варіант Вашої майбутньої оселі.<br />
2. Ми, разом з Вами, підбиремо зручніші для Вас іпотечні кредити.<br />
3. Ми зробимо калькуляцію всіх витрат, які можуть виникнути при отриманні кредиту.<br />
4. Ми допоможемо Вам підготувати необхідні документи.<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;Вже через 12 годин Ви матимете попередню відповідь від банку щодо можливості отримати кредит на нерухомість.
<img src="/i/1b.jpg" align="right" style="margin:5px;border:3px double gray">
Ви переконаєтеся, що з нашими фахівцями купувати нерухомість в кредит можна швидко і просто.
У нашій компанії працюють найкращі фахівці, які допоможуть Вам оформити кредит на квартиру.<br /><br />
Лише у нас квартира в кредит з найменшими витратами з Вашого боку.<br />
</p>

<div style="padding:5px;">
<p>
Перш за все ми пропонуємо Вам власноручно розрахувати прогнозованні графіки погашення кредиту.<br />
Цифри, що розрахує калькулятор, є орієнтовними і дозволять приблизно оцінити Ваші витрати.
</p>
</div><br />
<div style="margin:0 auto;width: 400px ;border:1px solid #787878;padding:5px;background-image: url(/i/calc.gif);background-repeat: no-repeat;background-position: bottom left;">
<div style="background-color: #06F;color:#FFF;text-align: center;padding:1px">Кредитний калькулятор</div><br />
<form method="POST" name="calc" id="calc" onsubmit="return checkmailform();">
<input type="hidden" name="option" value="com_calc">
<input type="hidden" name="task" value="3">
<input type="hidden" name="Itemid" value="<?=$itemid; ?>">
<table cellspacing="2" border="0" width="100%">
<tr><td width="210" align="right">Ринкова вартість</td><td><input type="text" name="forma1" id="forma1" value="0" style="width:160px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0" onblur="return raschet();" onchange="return raschet();" /></td></tr>
<tr><td align="right">Перший внесок</td><td><input type="text" name="forma2" id="forma2" value="0" style="width:160px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0" onblur="return raschet();" onchange="return raschet();" /></td></tr>
<tr><td align="right">Сума кредиту</td><td><input disabled type="text" name="forma3" id="forma3" value="0" style="width:160px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0"/></td></tr>
<tr><td align="right">Відсоткова ставка</td><td><input type="text" name="forma4" id="forma4" style="width:160px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0"/></td></tr>
<tr><td align="right">Строк погашення (місяців)</td><td><input type="text" name="forma5" id="forma5" style="width:160px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0"/></td></tr>
<tr><td align="right">Спосіб погашення</td><td><select name="forma6" id="forma6" style="width:160px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0">
<option value="1"> стандарт </option><option value="2"> аннуітет </option></select></td></tr>
<tr><td></td><td align="right"><input type="submit" value="Підрахувати"></td></tr>
</table><br />
</form>
</div>
<p align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000">ВАЖЛИВО</font>: При розрахунку не враховуються додаткові платежі банку,
 такі як відсоток за зарахування грошей на рахунок, страховка і т.д., так як розмір і наявність цих платежів різні
 у різних кредитних організацій. Для отримання більш точної інформації Вам слід звернутись до наших співробітників.
</p>
  <?
break;
};
?>
	</div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>