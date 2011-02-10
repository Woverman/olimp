<div id="center_panel">
    <div id="wrapper">
        <div id="notices_block">
            <div id="notices_inner">
                <pre>
                <?
                print_r($_REQUEST);
                //print_r($_SESSION);
                //print_r($_SERVER);
                //print_r($page);
                ?>
                </pre>
            </div>
        </div>
        <div id="banner_block"><? $banner->showCurrentBanner(); ?></div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>