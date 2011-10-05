$(document).ready(function(){
    // дублюємо меню для скрола
	var mm = $("#menu_panel .hmenu").clone();
    $("<div>").attr("id","menu_panel_double").append(mm).appendTo($("body"));

	adr = location.href;
	if (adr.search(new RegExp('admin','g'))>0){
		//------------------------------------------------- admin
		try{
		$('#redactor_content_master').redactor();
	    $('#redactor_content_slave').redactor();}
		catch(e){}
	} else {
		//------------------------------------------------- site
		// рухаємо оголошення
		resizeNotices();
		$(window).resize(resizeNotices);
	   	window.setTimeout(moveNotice,"10000");
		try{
	    // лайтбоксуємо фотки
	    $('#only_wrapper a.ilink').lightBox();
	    $('[rel=lightbox-rel]').lightBox();}
		catch(e){}
		// відновимо форму пошуку
		updateFindForm();
		// виділення регіонів на карті
		$('.map').maphilight({fade: true,fill:true, fillColor: '33CCFF', fillOpacity: 0.2, stroke: false, shadow:false, groupBy:'id' });
		// рухаємо фон шапки
	    $('#header_block').parallax({
	        'object':'#header_block',
	      	'useHTML':false,
	      	'elements': [
	        {
	          'selector': '#logo_grace',
	          'properties': {'x': {'background-position-x': {'initial': 0,'multiplier': 0.05 }}}
	        },
	        {
	          'selector': '#header_block',
	          'properties': {'x': {'background-position-x': {'initial': 0,'multiplier': 0.1,'invert': true}}}
	        }
	      ]
	    });
	}
});

function updateFindForm(){
	var tmp = new Array();		// два вспомагательных
	var tmp2 = new Array();		// массива
	var param = new Array();
	var dists = new Array();

	var get = location.search;	// строка GET запроса
	if(get != '') {
		adr = location.href;
		if (adr.search(new RegExp('admin','g'))>0) return 0;
		tmp = (get.substr(1)).split('&');	// разделяем переменные
		for(var i=0; i < tmp.length; i++) {
			tmp2 = tmp[i].split('=');		// массив param будет содержать
			param[tmp2[0]] = tmp2[1];		// пары ключ(имя переменной)->значение
		}
		if (param['id']==0) $("#modeorenda").attr("checked", "checked");
		if (param['tn']>0){
			$("#typener [value='"+param['tn']+"']").attr("selected", "selected");
			showdiv(param['tn']);
		}
		if (param['dom_domtype']>0) $("#dom_domtype [value='"+param['dom_domtype']+"']").attr("selected", "selected");
		if (param['kk']>0) $("#kk [value='"+param['kk']+"']").attr("selected", "selected");
		if (param['typener']>0) $("#typener [value='"+param['typener']+"']").attr("selected", "selected");
		if (param['obl']!='') {
			$("#obl [value='"+param['obl']+"']").attr("selected", "selected");
			loadRgns('rgn','rgn',param['obl']);
		}
		if (param['rgn']!=''){
			$("#rgn [value='"+param['rgn']+"']").attr("selected", "selected");
			loadRgns('mista','mista',param['rgn']);
		}
		if (param['gor']>0) $("#mista [value='"+param['gor']+"']").attr("selected", "selected");
		if (param['prise1']!='') $("#prise1").val(param['prise1']);
		if (param['prise2']!='') $("#prise2").val(param['prise2']);
		if (param['dist']!='') {
			var dists = param['dist'].split('%2C');
			dists.every(function(dst){
				if (dst!='' && dst!=0){
					var txt = $("#dists [value="+dst+"]").text();
					setDist(dst,txt);
				}
				return true;
			});
		}
	}
}
function resizeNotices(){
	$("#small_notices_wrapper").width($("#notices_inner").width()-$("#big_notices_wrapper").width()+'px');
}
function moveNotice(){
	var h = $("#small_notices_inner .notice_item:first").height() + 18;
	$("#small_notices_inner").animate({top:0-h + "px"},2000,null,function(){
		var b = $("#small_notices_inner .notice_item:first").find("img");
		var bsrc = b.attr("src");
		b.attr("src",b.attr("lowsrc"));
		b.attr("lowsrc",bsrc);
		$("#small_notices_inner .notice_item:first").detach().toggleClass("notice_item notice_item_big").appendTo($("#big_notices_inner"));
		var delimiter = $("#small_notices_inner .notice_delimiter:first").detach();
		$("#small_notices_inner").css("top",0);
		$("#big_notices_inner").animate({left:"-410px"},2000,null,function(){
			b = $("#big_notices_inner .notice_item_big:first").find("img");
			bsrc = b.attr("src");
			b.attr("src",b.attr("lowsrc"));
			b.attr("lowsrc",bsrc);
			$("#big_notices_inner .notice_item_big:first").detach().toggleClass("notice_item notice_item_big").appendTo($("#small_notices_inner"));
			$(delimiter).appendTo($("#small_notices_inner"));
			$("#big_notices_inner").css("left",0);

		});
	});

	window.setTimeout(moveNotice,"10000");
}
	/* формуємо параметри пошуку з форми */
function createParams(){
	oblid=document.getElementById('obl').value;
	rgnid=document.getElementById('rgn').value;
	gorid=document.getElementById('mista').value;
	prod=document.getElementById('modeprod').checked ? 1 : 0;
	cina1=document.getElementById('prise1').value;
	cina2=document.getElementById('prise2').value;
	tn=document.getElementById('typener').value;
	return '&obl=' + oblid + '&rgn=' + rgnid + '&gor=' + gorid + '&pr=' + prod + '&prise1=' + cina1 + '&prise2=' + cina2 + '&tn=' + tn;
}

	/* выделение вкладки меню */
function SetTopMenu(elem){
	document.getElementById('menu_1').className="tab";
	document.getElementById('menu_2').className="tab";
	document.getElementById('menu_3').className="tab";
	document.getElementById('menu_4').className="tab";
	document.getElementById('menu_5').className="tab";
	document.getElementById('menu_6').className="tab";
	document.getElementById('menu_7').className="tab";
	document.getElementById('menu_8').className="tab";
	document.getElementById('menu_' + elem).className='tab selected';
}

	/* перемещение объявлений на главной странице */
function ShiftImage(){
	var tmpT;
	tmpT=Tx01;
	Tx01=Tx02;
	Tx02=Tx03;
	Tx03=Tx04;
	Tx04=Tx05;
	Tx05=Tx06;
	Tx06=tmpT;
	document.getElementById("maintd1").innerHTML=stripslashes(Tx01);
  tmpT=Tx02.replace("mode=2","mode=1");
	document.getElementById("maintd2").innerHTML=stripslashes(tmpT.replace("110","310"));
	document.getElementById("maintd3").innerHTML=stripslashes(Tx03);
	document.getElementById("maintd4").innerHTML=stripslashes(Tx04);
	document.getElementById("maintd5").innerHTML=stripslashes(Tx05);
	document.getElementById("maintd6").innerHTML=stripslashes(Tx06);
	setTimeout ( "ShiftImage()", 15000 );
	}

function ShowHideDiv(divname) {
	var a;
	a=document.getElementById(divname).style;
	if (a.display=='block') {
		a.display='none'; }
	else { a.display='block'; }
}

function stripslashes( str ) {    // Un-quote string quoted with addslashes()
    return str.replace('/\0/g', '0').replace('/\(.)/g', '$1');
}

function LoadNewImage(tag,oid,num,mode){ // load new src in img
  document.images[tag].src='/image.php?objid='+oid+'&num='+num+'&mode='+mode;
}

function SetStatus(statusString){
  var sl = $("#StatusLine")
  sl.html(statusString);
  sl.show().delay(5000).hide(1500);
}

function createIFrame(frameName){
	if (frameName==undefined) {frameName="ifrm";}
	if (document.getElementById(frameName)==undefined) {
		var isIE = document.all && document.all.item && !window.opera;
		var ifrstr = isIE ? '<iframe name="'+frameName+'">' : 'iframe';
		var cframe = document.createElement(ifrstr);
		with(cframe){
			name = frameName; // это не для IE
			setAttribute("name", frameName); // и это тоже, но вреда не будет
			id = frameName; // а это везде ок
			src = 'about:blank'
			style.position = "absolute";
			style.left = style.top = "1px";
			style.height = "200px"
			style.width = "200px";
			style.display="none";
		}
		document.body.appendChild(cframe);
	}
}

function offradio(radioname){
  var allr = document.getElementsByName(radioname);
  var cntr = allr.length;
  for (var i=0; i<cntr; i++){
    allr[i].checked = false;
  }
}

function scrollbarWidth() {
    var div = $('<div style="width:50px; height:50px; overflow:hidden; position:absolute; top:-200px; left:-200px;"><div style="height:100px;"></div></div>').appendTo('body');
    var w1 = $('div', div).innerWidth();
    div.css('overflow-y', 'scroll');
    var w2 = $('div', div).innerWidth();
    $(div).remove();
    return (w1 - w2);
}

function OpenToPrint(){
  var content=document.getElementById('content').outerHTML;
  var options='dependent=yes,directories=no,menubar=yes,location=no,status=no,titlebar=no,toolbar=yes';
  var win = window.open('about:blank','printwindow','');
  win.document.write('<html><head><style type="text/css">@media print {html, html::before, * {color: black !important;background: white !important;}} img {display:none}</style></head><body onLoad=window.print()><center>');
  win.document.write(content);
  win.document.write('</center><sc');
  win.document.write('ript type="text/javascript">window.print();</sc');
  win.document.write('ript></body></html>');
  win.stop();
  win.print();
  }

function ShowText(txt){
  var em = document.getElementById('msgBox_txt');
  em.value = txt;
  }

function validateForm(){
  var ok=true;
  var val=$('#agent').val();
  if (val=='') ok=false;
  if (val=='0') ok=false;
  if (val=='110') ok=false;
  if (!ok) alert("Не вибрана відповідальна особа!");
  else $(window).unload($.noop);
  return(ok);
}
/* запрос районов и городов */
function loadRgns(tbl,cmb,par) {
	var data={tbl:tbl,obl:par};
	$.ajaxSetup({async:false});
	$.get("/ajax/getrgn.php",data,function(values){
		  a = new Array();
		  a = values.split("|");
		  var arr = eval("(" + a[1] + ")");
		  var listBox = $("#"+cmb).empty().append("<option value=0>--Не важливо--</option>");
		  for (var key in arr) {
      		  	id = arr[key][0];
      		  	text = arr[key][1];
		  	listBox.append(new Option(text,id));
		  }
	});
	$.ajaxSetup({async:true});
}