<?
//header("Content-type: text/html; charset=utf-8");
session_start();
include($_SERVER['DOCUMENT_ROOT']."/modules/bnr/config.php");
if (isset($_REQUEST['lang'])){
    $_SESSION['lang']=$_REQUEST['lang'];
}
$lng = $_SESSION['lang'];
$lng = $lang?$lang:'ua';
include ($_SERVER['DOCUMENT_ROOT'].'/classes.php'); // classes, config and functions
include ($_SERVER['DOCUMENT_ROOT'].'/inc/functions.php'); // classes, config and functions
$rpage = $_REQUEST['page'];
$rpage = $rpage?$rpage:"main";
$id =  $_REQUEST['id'];
$page = new Page($rpage,$id);
$user = New User($_SESSION['userid']);
function Meta($name,$content){
	echo "<meta name='$name' content='$content'/>\n";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
    <title><?=$page->title;?></title>
<?
	if (isset($page->keywords))	Meta("keywords",$page->keywords);
	if (isset($page->description))	Meta("description",$page->description);
	Meta("author","Sergii Obodynskyi");
?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <link rel="stylesheet" type="text/css" href="/css/null.css">
    <link rel="stylesheet" type="text/css" href="/css/<?=SKIN?>/struct.css">
    <link rel="stylesheet" type="text/css" href="/css/<?=SKIN?>/main.css">
    <link rel="stylesheet" type="text/css" href="/css/sunny/jquery-ui-1.8.7.custom.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css">
	<?
		$pageCss = DOCUMENT_ROOT.'/css/'.SKIN.'/'.addslashes($rpage).'.css';
		if (file_exists($pageCss))
			echo('<link rel="stylesheet" type="text/css" href="/css/'.SKIN.'/'.$rpage.'.css">');
	?>
    <script language="JavaScript" src="/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/jquery-ui-1.8.7.custom.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/jquery.lightbox-0.5.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/main.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/jquery.boxshadow.js"></script>
	<script language="JavaScript" src="/js/jquery.drag.js" type="text/javascript"></script>
	<? if ($page->isadmin) { ?>
	<script type="text/javascript" src="/js/sliding.form.js"></script>
	<script type="text/javascript" src="/js/jquery.columnfilters.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="/admin/editor/redactor.js"></script>
	<link href="/admin/editor/css/redactor.css" type="text/css" rel="stylesheet">
	<link href="/css/FancySlidingForm.css" type="text/css" rel="stylesheet">
	<link href="/css/jquery.timepicker.css" type="text/css" rel="stylesheet">
	<? } else { ?>
<script language="JavaScript" src="/js/jquery.parallax-0.2-min.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery.metadata.js"></script>
<script type="text/javascript" src="/js/jquery.maphilight.js"></script>
		<? if ($page->m_tpl=='object' | $page->m_tpl=='newsarticle') {?>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?47"></script>
<script type="text/javascript">
  VK.init({apiId: 2796213, onlyWidgets: true});
</script>
		<? } ?>
	<? } ?>



    <LINK REL="SHORTCUT ICON" href="/favicon.ico">
</head>

<body onload="createIFrame('ifrm')">
<div id="header_block">
  <div id="logo_wrap">
	<div id="logo_block">
	</div>
    <div id="logo_grace">
    </div>
  </div>
    <!--<div class="ui-corner-all" id="flags_wrapper">
        <a href="?lang=en"><img src="/i/eng_flag.png" width="32" height="32" alt="English" /></a>
        <a href="?lang=ru"><img src="/i/rus_flag.png" width="32" height="32" alt="Russian" /></a>
        <a href="?lang=ua"><img src="/i/ukr_flag.png" width="32" height="32" alt="Ukrainian" /></a>
    </div>-->
</div>
<div id="menu_panel">
  <ul class="hmenu">
    <? echo $page->menuset->listitems();?>
  </ul>
</div>

<? include($page->tpl()); ?>

<? if (!empty($debug)){?>
    <div id="debug_button" class="ui-corner-all" style="position:fixed;top:-20;right:10px;background-color:red;color:#FC6;z-index:10000;cursor: pointer;padding: 22px 10px 4px 10px;border: 1px solid #903;" onclick="showDebug()">Debug</div>
    <div id="debug_dialog" class="moveable" style="display:none;border: 2px outset #FC8;background-color:#FFCC66">
      <div id="debug_dialog_caption" style="background-color: #CC9966; color:#993333;padding: 2px 0 2px 10px;margin:5px;">Налагоджувальна інформація...
        <img src="/i/window_close.png" width="24" onclick="hideDebug();" style="float: right;cursor: pointer;position: relative;top:-4px;right:-2px"/>
      </div>
        <div style="position: relative;width: 700px;
          background-color: white;height: 300px;overflow: auto;margin: 5px;
          border: 3px groove #FFCC66;
          ">
        <div style="position: relative;width: 670px;background-color: white;white-space:pre;margin:5px;">
          <?=implode(' ',$debug)?>
        </div>
      </div>
      <div style="text-align: right;margin: 5px;"><button onclick="hideDebug();">Закрити</button></div>
    </div>
    <script language="JavaScript" type="text/javascript">
    function showDebug(){
      $("#debug_dialog").css({
    		position:'fixed',
    		left: ($(window).width() - $('#debug_dialog').outerWidth())/2,
    		top: ($(window).height() - $('#debug_dialog').outerHeight())/2
    	}).show();
    }
    function hideDebug(){
      $("#debug_dialog").hide();
    }
    $('#debug_dialog_caption').drag();
    </script>
<?}?>

</body>
</html>
