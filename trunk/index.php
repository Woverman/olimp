<?
header("Content-type: text/html; charset=utf-8");
session_start();

if (isset($_REQUEST['lang'])){
    $_SESSION['lang']=$_REQUEST['lang'];
}
$lng = $_SESSION['lang'];
$lng = $lang?$lang:'ua';

include ('classes.php'); // classes, config and functions
include ('./inc/functions.php'); // classes, config and functions
$rpage = $_REQUEST['page'];
$rpage = $rpage?$rpage:"main";
$id =  $_REQUEST['id'];
$page = new Page($rpage);
$banner = new Banner($rpage);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
    <title><?=$page->title;?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/null.css">
    <link rel="stylesheet" type="text/css" href="/css/<?=SKIN?>/struct.css">
    <link rel="stylesheet" type="text/css" href="/css/<?=SKIN?>/main.css">
    <link rel="stylesheet" type="text/css" href="/css/sunny/jquery-ui-1.8.7.custom.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css">
	<?
		$pageCss = DOCUMENT_ROOT.'/css/'.SKIN.'/'.addslashes($rpage).'.css';
		if (file_exists($pageCss))
			echo('<link rel="stylesheet" type="text/css" href="/css/'.SKIN.'/'.$rpage.'.css">');
	?>0
    <script language="JavaScript" src="/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/jquery-ui-1.8.7.custom.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/jquery.lightbox-0.5.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/main.js" type="text/javascript"></script>
	<? if ($rpage=='admin') { ?>
    <script language="JavaScript" src="/js/jquery.drag.js" type="text/javascript"></script>
	<script type='text/javascript' src='/js/sliding.form.js'></script>
	<script type="text/javascript" src="/admin/editor/redactor.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $('#redactor_content_master').redactor({ focus: true });
	    $('#redactor_content_slave').redactor();
	  });
	</script>
	<link href="/admin/editor/css/redactor.css" type="text/css" rel="stylesheet">
	<link href="/css/FancySlidingForm.css" type="text/css" rel="stylesheet">
	<? } ?>
    <LINK REL="SHORTCUT ICON" href="/favicon.ico">
</head>

<body>
<?if ($_REQUEST['var']=='1'){?>
<div id="header_block">
	<div id="logo_block">
		<img src="/i/logo1.png" alt="" id="logo_img" />
	</div>
</div>
<? } ?>
<?if ($_REQUEST['var']=='2'){?>
<div id="header_block">
	<div id="logo_block">
		<img src="/i/logo2.png" alt="" id="logo_img" />
	</div>
</div>
<? } ?>
<?if ($_REQUEST['var']=='3'){?>
<div id="header_block">
	<div style="
		background:url(../../i/logo1.png);
		background-repeat: no-repeat;
		background-position: 163px 2px;
		">
	<div id="logo_block"></div>
	</div>
</div>
<? } ?>
<?if ($_REQUEST['var']=='4'){?>
<div id="header_block">
	<div id="logo_block">
		<img src="/i/logo3.png" alt="" id="logo_img" />
	</div>
</div>
<? } ?>
<?if ($_REQUEST['var']=='5'){?>
<div id="header_block">
	<div id="logo_block">
		<img src="/i/logo4.png" alt="" id="logo_img" />
	</div>
</div>
<? } ?>
<?if ($_REQUEST['var']==''){?>
<div id="header_block">
	<div id="logo_block">
		<img src="/i/logo.png" alt="" id="logo_img" />
	</div>
    <!--<div class="ui-corner-all" id="flags_wrapper">
        <a href="?lang=en"><img src="/i/eng_flag.png" width="32" height="32" alt="English" /></a>
        <a href="?lang=ru"><img src="/i/rus_flag.png" width="32" height="32" alt="Russian" /></a>
        <a href="?lang=ua"><img src="/i/ukr_flag.png" width="32" height="32" alt="Ukrainian" /></a>
    </div>-->
</div>
<? } ?>
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
