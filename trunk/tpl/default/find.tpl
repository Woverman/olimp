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
	/* запрос районов и городов */
	function loadRgns(tbl,par) {
		var data={tbl:tbl,obl:par};
		$.ajaxSetup({async:false});
		$.get("/ajax/getrgn.php",data,function(values){
			  a = new Array();
			  a = values.split("|");
			  var arr = eval("(" + a[1] + ")");
			  var listBox = $("#"+a[0]).empty().append("<option value=0>--Не важливо--</option>");
			  for (var key in arr) {
       		  	id = arr[key][0];
       		  	text = arr[key][1];
			  	listBox.append(new Option(text,id));
			  }
		});
		$.ajaxSetup({async:true});
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
	  <select onchange="loadRgns('rgn',this.value);document.getElementById('mista').options.length=1" id="obl" name="obl">
		<option value="0">--Не важливо--</option>
		<option value="1">АР Крим</option>
<option value="3">Волинська</option>
<option selected="" value="2">Вінницька</option>
<option value="7">Закарпатська</option>
<option value="8">Запоріжська</option>
<option value="18">Рівненська</option>
<option value="10">Київ</option>
<option value="11">Київська</option>
<option value="13">Луганська</option>
<option value="14">Львівська</option>
<option value="12">Кіровоградська</option>
<option value="15">Миколаївська</option>
<option value="17">Полтавська</option>
<option value="16">Одеська</option>
<option value="20">Сумська</option>
<option value="19">Севастополь</option>
<option value="22">Харьківська</option>
<option value="24">Хмельницька</option>
<option value="21">Тернопільська</option>
<option value="23">Херсонська</option>
<option value="6">Житомирська</option>
<option value="5">Донецька</option>
<option value="4">Дніпропетровська</option>
<option value="9">Івано-Франківська</option>
<option value="25">Черкаська</option>
<option value="26">Чернівецька</option>
<option value="27">Чернігівська</option>
	  </select>
	  <p>Район:</p>
	  <select onchange="loadRgns('mista',this.value);" id="rgn" name="rgn">
		<option value="0">--Не важливо--</option>
		<option value="20">Барський</option>
<option value="22">Гайсинський</option>
<option value="21">Бершадський</option>
<option selected="" value="19">Вінницький</option>
<option value="25">Калинівський</option>
<option value="27">Крижопільский</option>
<option value="28">Липовецький</option>
<option value="26">Козятинський</option>
<option value="29">Літинський</option>
<option value="33">Оратівський</option>
<option value="35">Погребищенський</option>
<option value="30">Могилів-Подільський</option>
<option value="31">Мурованокуриловецький</option>
<option value="32">Немирівский</option>
<option value="34">Піщанський</option>
<option value="39">Тростянецький</option>
<option value="37">Тиврівский</option>
<option value="38">Томашпільський</option>
<option value="41">Хмільницький</option>
<option value="40">Тульчинський</option>
<option value="36">Теплицький</option>
<option value="23">Жмеринський</option>
<option value="24">Ілінецький</option>
<option value="42">Чернівецький</option>
<option value="43">Чечільницький</option>
<option value="44">Шаргородський</option>
<option value="45">Ямпільський</option>
	  </select>
	  <p>Населений пункт:</p>
	  <select id="mista" name="gor">
		<option value="0">--Не важливо--</option>
		<option value="1070">Гавришівка</option>
<option value="30001">Гавришівка</option>
<option value="1064">Агрономічне</option>
<option value="1071">Горбанівка</option>
<option value="1069">Вороновиця</option>
<option value="1066">Бохоники</option>
<option value="1072">Гумене</option>
<option value="1065">Березина</option>
<option value="1067">Великі Крушлинці</option>
<option value="1068">Вінницькі Хутори</option>
<option selected="" value="1063">Вінниця</option>
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
<option value="29998">Якушинці</option>
	  </select>
  </div><br>
  Ціна від <input type="text" value="" name="prise1" id="prise1" size="5">
  до <input type="text" value="" name="prise2" id="prise2" size="5"><br>
  <br><button onclick="document.form_find.submit();">Знайти</button>
</form>


