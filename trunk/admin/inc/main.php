<style type='text/css'>
.mainrow { border: 1px solid #DDDDDD;}
.mainrow h4 {margin:1px;text-align: center; color:#339900; display: block;cursor:pointer;}
.mainrow th {border:1px solid gray; width:25%;vertical-align:bottom}
.mainrow img {border:0; margin:15px}
.mainrow th div {border:1px solid gray; line-height:50px;}
.mainrow th div.l2 {line-height:25px;}
.mainrow a:hover div {background-color: #99CCFF; color:blue;}
</style>

<?
function widjet($title,$href,$imgsrc,$id,$visible,$newline){
	?>
<div class="widjet_outer ui-corner-all" id='w<?=$id?>' style='display:<?=($visible?'block':'none')?>;clear:<?=($newline?'both':'none')?>'>
	<a href='/admin/<?=$href?>'>
		<div class="widjet_inner ui-corner-all">
			<img src='/i/admin/<?=$imgsrc?>.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=/i/admin/<?=$imgsrc?>.png); width:expression(1); height:expression(1);}'>
			<div><?=$title?></div>
		</div>
	</a>
</div>
	<?
}
$sql = "select * from s_widjets order by orderid";
$res = $DB->request($sql,ARRAY_A);
$i=0;
foreach ($res as $item){
		widjet($item['title'],$item['href'],$item['img'],$item['id'],$item['enabled']==1,$item['newline']==1);
}//if ($item['newline']==1) echo('<br style="float:none;clear:both">');
//exit;
?>
<div id="overlay"></div>
<div class="ui-corner-all" style="position: fixed;bottom:-10px;right: 10px;
 background-color:#CCCCFF;color:#9900FF;z-index:10000;cursor: pointer;
 padding: 4px 10px 10px 10px;border: 1px solid #903;" onclick="showConfigure()">
	Налаштування
</div>
<div id="config_dialog" class="moveable" style="display:none;border: 2px outset #FC8;background-color:#FFCC66">
  <div id="config_dialog_caption" style="background-color: #CC9966; color:#993333;padding: 2px 0 2px 10px;margin:5px;">Управління віджетами
    <img src="/i/window_close.png" width="24" onclick="hideConfigure();" style="float: right;cursor: pointer;position: relative;top:-4px;right:-2px"/>
  </div>
    <div style="position: relative;width: 700px;
      background-color: white;height: 300px;overflow: auto;margin: 5px;
      border: 3px groove #FFCC66;
      ">
<table style="width: 100%" class="mytab">
	<tr style="background-color: #C9C9C9; color: #343434">
		<th>Підпис</th>
		<!--<th>Посилання</th>
		<th>Картинка</th>-->
		<th>Показувати</th>
		<th>Порядок</th>
		<th>Новий рядок</th>
	</tr>
	<?
	$a=0;
	foreach ($res as $item){
		$i = $item['id'];
		echo('<tr class="row'.$a=abs($a-1).'" id="row'.$i.'">');
		echo("<td><img src='/i/admin/".$item['img'].".png' width=20 height=20 style='float:left;padding-left: 10px;'>".$item['title']."</td>");
		//echo("<td>".$item['href']."</td>");
		//echo("<td>".$item['img']."</td>");
		echo("<td><img id='iOn".$i."' class=Hand src='/i/on.png' style='display:".($item['enabled']==1?'inline-block':'none')."' onclick='Hide(".$i.")'>");
		echo("<img id='iOff".$i."' class=Hand src='/i/off.png' style='display:".($item['enabled']==0?'inline-block':'none')."' onclick='Show(".$item['id'].")'></td>");
		echo("<td><img class=Hand src='/i/up.png' onclick='Up(".$item['id'].")'><img class=Hand src='/i/down.png' onclick='Down(".$item['id'].")'></td>");
		echo("<td><img id='iSh".$i."' class=Hand src='/i/admin/return_yes.png' style='display:".($item['newline']==1?'inline-block':'none')."' onclick='Unshift(".$item['id'].")'>");
		echo("<img id='iUsh".$i."'class=Hand src='/i/admin/return_no.png' style='display:".($item['newline']==0?'inline-block':'none')."' onclick='Shift(".$item['id'].")'></td>");
		echo("</tr>");
	}?>
</table>
  </div>
  <div style="text-align: right;margin: 5px;"><button onclick="hideConfigure();">Закрити</button></div>
</div>
<script language="JavaScript" type="text/javascript">
   function showConfigure(){
   	$('#overlay').toggle();
    $("#config_dialog").css({
   		position:'fixed',
   		left: ($(window).width() - $('#config_dialog').outerWidth())/2,
   		top: ($(window).height() - $('#config_dialog').outerHeight())/2
   	}).toggle();
	$('#config_dialog_caption').drag();
   }
   function hideConfigure(){
     $("#config_dialog").hide();
	 $('#overlay').hide();
   }
   function Up(id){
		$.get("/ajax/widgetsActions.php",{id:id,action:'up'},function(z){if (z=="ok"){
			var pdiv = $('#w'+id);
			pdiv.insertBefore(pdiv.prev());
			var prow = $('#row'+id);
			prow.toggleClass('row0 row1');
			prow.insertBefore(prow.prev().toggleClass('row0 row1'));
   			}else{if(z!='')alert(z);}})
   }
   function Down(id){
		$.get("/ajax/widgetsActions.php",{id:id,action:'down'},function(z){if (z=="ok"){
			var pdiv = $('#w'+id);
			pdiv.insertAfter(pdiv.next());
			var prow = $('#row'+id);
			prow.insertAfter(prow.next().toggleClass('row0 row1')).toggleClass('row0 row1');
   			}else{if(z!='')alert(z);}})
   }
   function Shift(id){
		$.get("/ajax/widgetsActions.php",{id:id,action:'shift'},function(z){if (z=="ok"){
		$('#w'+id).css('clear','both');
		$('#iSh'+id).show();
		$('#iUsh'+id).hide();
		}else{if(z!='')alert(z);}})
   }
   function Unshift(id){
		$.get("/ajax/widgetsActions.php",{id:id,action:'unshift'},function(z){if (z=="ok"){
		$('#w'+id).css('clear','none');
		$('#iUsh'+id).show();
		$('#iSh'+id).hide();
		}else{if(z!='')alert(z);}})
   }
   function Show(id){
		$.get("/ajax/widgetsActions.php",{id:id,action:'show'},function(z){if (z=="ok"){
			$('#w'+id).show();
			$('#iOn'+id).show();
			$('#iOff'+id).hide();
		}else{if(z!='')alert(z);}})
   }
   function Hide(id){
		$.get("/ajax/widgetsActions.php",{id:id,action:'hide'},function(z){if (z=="ok"){
			$('#w'+id).hide();
			$('#iOff'+id).show();
			$('#iOn'+id).hide();

		}else{if(z!='')alert(z);}})
   }

</script>