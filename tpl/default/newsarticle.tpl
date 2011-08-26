<div id="center_panel">
    <div id="wrapper">
        <div id="news_block">
            <div id="news_inner" class="ui-corner-all">
            <div id="news_title" class="ui-corner-all">Останні новини</div>
            <?
                $sql = "Select *,date_format(dateadd,'%d.%m.%Y')as dt from new_news where id=".$id;
                $res = $DB->request($sql,ARRAY_A);
                foreach($res as $item){
                    include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/elem_news_large.tpl');
                }
            ?>
            </div>
        </div>
        <div id="banner_block"><? $target='Top1';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');?></div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>