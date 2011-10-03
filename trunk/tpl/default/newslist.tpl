<?
$page = $_REQUEST['p'];
$sql = "SELECT COUNT(*) FROM new_news WHERE published=1";
$res = $DB->request($sql,ARRAY_N);
debug($res,'$res');
$icnt = $res[0][0];
$perpage=10;

if ($icnt>$perpage){
	$pagecount=ceil($icnt/$perpage);
	if ($pagecount>1) {
		$pagesdiv = createNewsPages($pagecount,$page);
	}
}
debug($icnt,'$icnt');
debug($pagecount,'$pagescount');
debug($pagesdiv,'$pagesdiv');
?>

<div id="center_panel">
    <div id="wrapper">
        <div id="news_block">
            <div id="news_inner" class="ui-corner-all">
			<?
			  if ($page<2) {
			 ?>
            <div id="news_title" class="ui-corner-all">Останні новини</div>
			<? if ($pagecount>1) echo($pagesdiv); ?>
            <?
                $sql = "Select *,date_format(dateadd,'%d.%m.%Y')as dt from new_news where published=1 order by dateadd desc limit 1,10";
                $res = $DB->request($sql,ARRAY_A);
                foreach($res as $item){
                    include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/elem_news.tpl');
                }
            ?>
            </div>
			<?} else {?>
            <div id="news_title" class="ui-corner-all">Архів новин</div>
			<? if ($pagecount>1) echo($pagesdiv); ?>
            <?
				$from=($page-1)*10+1;
				$to = $from+9;
                $sql = "Select *,date_format(dateadd,'%d.%m.%Y')as dt from new_news where published=1 order by dateadd desc limit $from,$to";
                $res = $DB->request($sql,ARRAY_A);
                foreach($res as $item){
                    include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/elem_news.tpl');
                }
            ?>
            </div>
			<?}?>
<? if ($pagecount>1) echo($pagesdiv); ?>

        </div>
        <div id="banner_block"><? $target='Top1';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');?></div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>