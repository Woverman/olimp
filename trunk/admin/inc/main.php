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
function widjet($title,$href,$imgsrc){
	?>
<div class="widjet_outer">
	<a href='/admin/<?=$href?>'>
		<div class="widjet_inner">
			<img src='/i/admin/<?=$imgsrc?>.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=/i/admin/<?=$imgsrc?>.png); width:expression(1); height:expression(1);}'>
			<div><?=$title?></div>
		</div>
	</a>
</div>
	<?
}
$sql = "select * from s_widjets order by orderid";
$res = $DB->request($sql,ARRAY_A);
foreach ($res as $item){
	if ($item['enabled']==1)
	widjet($item['title'],$item['href'],$item['img']);
}
//exit;
?>
<div class="ui-corner-all" style="position: fixed;bottom:-10px;right: 10px; background-color:#CCCCFF;color:#9900FF;z-index:10000;cursor: pointer;padding: 4px 10px 10px 10px;border: 1px solid #903;" onclick="showConfigure()">
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
    <!--<div style="position: relative;width: 670px;background-color: white;white-space:pre;margin:5px;text-align: center;">-->
<table style="width: 100%" class="mytab">
	<tr style="background-color: #C9C9C9; color: #343434"><th>Підпис</th><th>Посилання</th><th>Картинка</th><th>Видимість</th><th>Порядок</th></tr>
	<?
	$a=0;
	foreach ($res as $item){
		echo('<tr class="row'.$a=abs($a-1).'">');
		echo("<td>".$item['title']."</td>");
		echo("<td>".$item['href']."</td>");
		echo("<td>".$item['img']."</td>");
		echo("<td><img src='/i/".($item['enabled']?"on":"off").".png'></td>");
		echo("<td><img src='/i/up.png'><img src='/i/down.png'></td>");
		echo("</tr>");
	}?>
</table>

    <!--</div>-->
  </div>
  <div style="text-align: right;margin: 5px;"><button onclick="hideConfigure();">Закрити</button></div>
</div>
<script language="JavaScript" type="text/javascript">
   function showConfigure(){
     $("#config_dialog").css({
   		position:'fixed',
   		left: ($(window).width() - $('#config_dialog').outerWidth())/2,
   		top: ($(window).height() - $('#config_dialog').outerHeight())/2
   	}).show();
   }
   function hideConfigure(){
     $("#config_dialog").hide();
   }
   $('#config_dialog_caption').drag();
</script>