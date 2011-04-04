<form name="find" action="/catalog/1/" method="get" enctype="multipart/form-data">
   	<label><input type="radio" checked="checked" name="id" value="1" id="modeprod"/>Продаж</label>&nbsp;
	<label><input type="radio" name="id" value="0" id="modeorenda"/>Оренда</label>
<br/>
  <script type="text/javascript">
    function showdiv(id){
      $("#finddiv1").hide();
      $("#finddiv2").hide();
      $("#finddiv3").hide();
      $("#finddiv4").hide();
      $("#finddiv"+id).show();
    }

  </script>
  <p>Тип нерухомості:</p>
  <select onchange="showdiv(this.selectedIndex)" id="typener" name="tn">
	<option value="0">--Не важливо--</option>
  <option value="1">Будинки</option>
  <option value="2">Квартири</option>
  <option value="3">Ділянки</option>
  <option value="4">Комерційна нерухомість</option>
  </select>
  <div style="display: none;" id="finddiv1">
    <p>Тип будинку:</p>
    <select name="dom_domtype" id="dom_domtype">
  	  <option value="0">--Не важливо--</option>
      <option value="1">будинок</option>
      <option value="2">частина будинку</option>
      <option value="3">дача</option>
    </select>
  </div>
  <div style="display: none;" id="finddiv2">
    <p>Тип квартири:</p>
    <select name="kk" id="kk">
      <option value="0">--Не важливо--</option>
      <option value="-1">частина квартири</option>
      <option value="1">1-кімнатна</option>
      <option value="2">2-кімнатна</option>
      <option value="3">3-кімнатна</option>
      <option value="4">4-кімнатна</option>
      <option value="99">багатокімнатна</option>
    </select>
  </div>
  <div style="display: none;" id="finddiv3"></div>
  <div style="display: none;" id="finddiv4"></div>
  <div>
	  <p>Область:</p>
	  <select onchange="loadRgns('rgn','rgn',this.value);document.getElementById('mista').options.length=1" id="obl" name="obl">
		<option value="0">--Не важливо--</option>
		 <?php $obl=2;@getaslist('d_oblasti',$obl,'1=1'); ?>
	  </select>
	  <p>Район:</p>
	  <select onchange="loadRgns('mista','mista',this.value);" id="rgn" name="rgn">
		<option value="0">--Не важливо--</option>
		<?php $rgn=19;getaslist('d_rgn',$rgn,"parent='2'");  ?>
	  </select>
	  <p>Населений пункт:</p>
	  <select id="mista" name="gor">
		<option value="0">--Не важливо--</option>
		<option value="1070">Гавришівка</option>
		<option value="1064">Агрономічне</option>
		<option value="1071">Горбанівка</option>
		<option value="1069">Вороновиця</option>
		<option value="1066">Бохоники</option>
		<option value="1072">Гумене</option>
		<option value="1065">Березина</option>
		<option value="1067">Великі Крушлинці</option>
		<option value="1068">Вінницькі Хутори</option>
		<option selected="selected" value="1063">Вінниця</option>
		<option value="1076">Зарванці</option>
		<option value="1100">Рівець</option>
		<option value="1082">Лаврівка</option>
		<option value="1083">Лисогора</option>
		<option value="1080">Кордишівка</option>
		<option value="1079">Комарів</option>
		<option value="1081">Ксаверівка</option>
		<option value="1084">Лука-Мелешківска</option>
		<option value="1095">Парпурівці</option>
		<option value="1085">Майдан</option>
		<option value="1086">Майдан-Чапельський</option>
		<option value="1087">Малі Крушлинці</option>
		<option value="1099">Прибужське</option>
		<option value="1097">Писарівка</option>
		<option value="1090">Михайлівка</option>
		<option value="1093">Олександрівка</option>
		<option value="1094">Оленівка</option>
		<option value="1098">Побережне</option>
		<option value="1096">Переорки</option>
		<option value="1092">Некрасово</option>
		<option value="1088">Медвеже Вушко</option>
		<option value="1089">Медвідка</option>
		<option value="1091">Мізяківські Хутори</option>
		<option value="30000">Сабарів</option>
		<option value="1101">Славне</option>
		<option value="1102">Слобода-Дашківецькая</option>
		<option value="1103">Сокиринці</option>
		<option value="1104">Сосонка</option>
		<option value="1105">Стадниця</option>
		<option value="1107">Стрижавка</option>
		<option value="1106">Степанівка</option>
		<option value="1110">Хижинці</option>
		<option value="1109">Тютьки</option>
		<option value="1108">Тютюники</option>
		<option value="1113">Щітки</option>
		<option value="1075">Жабелівка</option>
		<option value="1074">Дорожне</option>
		<option value="1073">Десна</option>
		<option value="1111">Цвіжин</option>
		<option value="1077">Іванівка</option>
		<option value="1078">Ільківка</option>
		<option value="1112">Широка Гребля</option>
		<option value="29999">Шкуринці</option>
		<option value="1114">Якушинці</option>
	  </select>
  </div><br>
  Ціна від <input type="text" value="" name="prise1" id="prise1" size="5">
  до <input type="text" value="" name="prise2" id="prise2" size="5"><br>
  <br><button onclick="document.form_find.submit();">Знайти</button>
</form>


