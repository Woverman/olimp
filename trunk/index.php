<?
header("Content-type: text/html; charset=utf-8");
session_start();

if (isset($_REQUEST['lang'])){
    $_SESSION['lang']=$_REQUEST['lang'];   
}
$lng = $_SESSION['lang'];
$lng = $lang?$lang:'ua';

include ('classes.php'); // classes, config and functions
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
    <script language="JavaScript" src="/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/jquery-ui-1.8.7.custom.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="/js/main.js" type="text/javascript"></script>
</head>

<body>
<div id="header_block">
    <div id="logo_block"><img src="/i/logo.png" alt="" id="logo_img"/></div>
    <!--<div class="ui-corner-all" id="flags_wrapper">
        <a href="?lang=en"><img src="/i/eng_flag.png" width="32" height="32" alt="English" /></a>
        <a href="?lang=ru"><img src="/i/rus_flag.png" width="32" height="32" alt="Russian" /></a>
        <a href="?lang=ua"><img src="/i/ukr_flag.png" width="32" height="32" alt="Ukrainian" /></a>
    </div>-->
</div>
<div id="menu_panel">
  <ul class="hmenu">
    <? echo $page->menuset->listitems(); ?>
  </ul>
</div>

<? include($page->tpl()); ?>

</body>
</html>
