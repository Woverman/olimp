$(document).ready(function(){
    // дублюємо меню для скрола
	var mm = $("#menu_panel .hmenu").clone();
    $("<div>").attr("id","menu_panel_double").append(mm).appendTo($("body"));
    // рухаємо фон шапки
    $("#logo_block").mousemove(function(e){
        var x = e.pageX;
        var w = $(window).width()/2;
        if (x<w){
            n = -10 + 'px 0px';
            m = 20 + 'px 0px';
        } else {
            n = 50 + 'px 0px';
            m = -20 + 'px 0px';
        }
        $("#logo_block").stop().animate({'background-position':n},3000);
        $("#header_block").stop().animate({'background-position':m},3000);
    }).mouseleave(function(){$("#logo_block").stop();$("#header_block").stop();})
    // рухаємо оголошення
   	window.setTimeout(moveNotice,"10000");
    //
});

function moveNotice(){
	var h = $("#small_notices_inner .notice_item:first").height() + 18;
	$("#small_notices_inner").animate({top:0-h + "px"},2000,null,function(){
		$("#small_notices_inner .notice_item:first").detach().toggleClass("notice_item notice_item_big").appendTo($("#big_notices_inner"));
		var delimiter = $("#small_notices_inner .notice_delimiter:first").detach();
		$("#small_notices_inner").css("top",0);
			$("#big_notices_inner").animate({left:"-100%"},2000,null,function(){
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
  var sl = document.getElementById("StatusLine")
  sl.innerHTML=statusString;
  sl.style.display="block";
}

function createIFrame(frameName){
	if (frameName==undefined) {frameName="ifrm";}
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
  var val=document.getElementById('agent').value;
  if (val=='') ok=false;
  if (val=='0') ok=false;
  if (val=='110') ok=false;
  if (!ok) alert("Не вибрана відповідальна особа!");
  return(ok);
}