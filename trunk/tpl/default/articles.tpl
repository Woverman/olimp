<div id="center_panel">
    <div id="wrapper">
    <?  ?>
        <div id="news_block">
            <div id="news_inner">
            </div>
        </div>
        <div id="notices_block">
            <div id="articles_inner" style="padding: 10px;">
                <?
				$sql = "select id,title,folder from m_pages where enable=1 order by folder,title";
				$items = $DB->request($sql,ARRAY_A);
				$fld="";
				foreach($items as $item){
					if ($fld!=$item['folder']){
						echo("<img src='/i/chapter.png' width='64' height='64' style='float:left'/><h1 class='art_del'>".$item['folder']."</h1>");
						$fld=$item['folder'];
					}
					echo("<li><a href='/article/".$item['id']."/'>".$item['title']."</a></li>");
				}
                ?>
            </div>
        </div>
        <div id="banner_block"><? $target='Top1';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');?></div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>