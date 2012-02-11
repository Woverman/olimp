<div id="findform">
<form name="find" action="/catalog/1/" method="get" enctype="multipart/form-data">
   	<label><input type="radio" checked="checked" name="id" value="1" id="modeprod" />Продаж</label>&nbsp;
	<label><input type="radio" <?if($id==0){?>checked="checked"<?}?> name="id" value="0" id="modeorenda"/>Оренда</label>
<br/>
  <script type="text/javascript">
    function showdiv(id){
    	$("#finddiv1").hide();
      	$("#finddiv2").hide();
      	$("#finddiv3").hide();
      	$("#finddiv4").hide();
      	$("#finddiv"+id).show();
    }
	function showMapDist(){
		//$("#find_vidget").css({position:'absolute'});
		$("#findform").hide();
		$("#map_large").show();
		$(".dist_title").show();
		$("#left_panel").css("width","auto");
	}
	function hideMapDist(){
		//$("#find_vidget").css({position:'relative'});
		$("#findform").show();
		$("#map_large").hide();
		$(".dist_title").hide();
		$("#left_panel").css("width","20%");
	}
	function cityChanged(id){
		$('#dist').val('');
		if (id==1063){
			$('#distswrap').show('');
			}
		else {
			$('#distswrap').hide();
			}
	 //	$('#distwrap').hide('slow');

	}
	function removeDist(dID){
		$('#distitem'+dID).remove();
		var what=','+dID;
		$("#dist").val($("#dist").val().replace(new RegExp(what,'g'),','));
		if ($("#dist").val()==','){$("#distwrap").hide();};
		$('#dists [value='+dID+']').show();
	}
	function setDist(dID,dName){
		var newid = 'distitem'+dID;
		if (!$('#'+newid).is('div')) {
			var temp=$('#distitem').clone().attr('id',newid);
			temp.children('.dist_name').text(dName);
			temp.children('.cleardist').click(function(){removeDist(dID)});
			temp.insertAfter($('#distitem')).show();
			$('#dists [value='+dID+']').hide();
			$("#dist").val($("#dist").val()+','+dID);
			$("#distwrap").show();
		}
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
	  <select id="mista" name="gor" onchange="cityChanged(this.value)">
		<option value="0">--Не важливо--</option>
		<?php $misto=1063;getaslist('d_mista',$misto,'parent=19');  ?>
	  </select>
	  <!--&nbsp;<img id="map_e" src="/i/map.gif" width="28" height="21" alt="vinnitsa map small enable" style="cursor: pointer;" title="Райони міста та околиці" onclick="showMapDist()"/>
	  <img id="map_d" src="/i/map_dis.gif" width="28" height="21" alt="vinnitsa map small disable" style="display:none;cursor: not-allowed;"/>-->
	  <div id='distswrap'>
	  <p>Район міста:</p>
	  <select id="dists" name="dists" onchange="setDist(this.value,this[this.selectedIndex].text);this.selectedIndex=0;">
		<option value="0">Добавте в список...</option>
		<?php $dst=0;getaslist('d_dist',$dst,'1=1','orderid');  ?>
	  </select>
	  </div>

<div id="distwrap" class="ui-corner-all">
	<div class="distitem" id="distitem">
		<div class="dist_name"></div>
		<img class="cleardist" src="/i/clear.png" width="16" height="16"/>
	</div>
</div>

<input type="hidden" name="dist" id="dist" />
<input type="hidden" name="proj" id="proj" value="0" />
  </div><br style="clear: both;">
  Ціна від <input type="text" value="" name="prise1" id="prise1" size="5">
  до <input type="text" value="" name="prise2" id="prise2" size="5"><br>
  <br><button onclick="document.form_find.submit();">Знайти</button>
</form>
</div>
<div id="map_large" style="display:none;z-index:1000;">
	<img class=map src="/i/map.jpg" USEMAP="#MAP1" />
</div>
<MAP NAME="MAP1">
<?
$dists = $DB->request("select `id`,`name`,`left`,`top`,`coord` from `d_dist` order by `orderid`",ARRAY_A);
foreach($dists as $dist){
	$d_title = $dist['name'];
	$d_id = $dist['id'];
	$d_href = '/catalog/1/?id=1&tn=0&dom_domtype=0&kk=0&obl=0&rgn=0&gor=1063&dists=0&dist=%2C'.$d_id.'&proj=0&prise1=&prise2=';
	echo("<AREA HREF='$d_href' SHAPE=POLYGON TITLE=\"$d_title\" id='$d_id' COORDS='".$dist['coord']."'>");
	echo("<DIV CLASS='dist_title' STYLE='display:none;position: absolute;left: ".$dist['left']."px;top:".$dist['top']."px;'>$d_title</div>");
	echo("<A CLASS='dist_title' STYLE='display:none;position: absolute;left:".$dist['left']."px;top:".$dist['top']."px;' HREF='$d_href' onmouseover=\"function()($('AREA #$d_id').mouseover());\">$d_title</A>");
}
?>
</MAP>
<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/
$('.dist_title').mouseover(function(){
	var txt = ($(this).text());
	$('[title="'+txt+'"]').mouseover();
	});
$('.dist_title').mouseout(function(){
	var txt = ($(this).text());
	$('[title="'+txt+'"]').mouseout();
	});
/*]]>*/
// onmouseout="setTimeout(hideMapDist,1000);"
</script>