<div id="center_panel">
    <div id="wrapper">
        <? print_r($_REQUEST) ?>
        <div id="only_wrapper" class="ui-corner-all" style="border: 1px solid #99CCFF;padding:5px;">
        <?
            $obj = Object::load($id);
            debug($obj);
            echo "<div class='news_shadow_img'><img width='500' src='".$obj->img(2,1)."'></div>";
            echo "<br style='clear:both'>";
            $cnt = $obj->imgCount();
            if ($cnt>1){
                for ($i=2;$i<$cnt;$i++){
                    echo "<img src='".$obj->img($i,2)."'>";
                }
            }
        ?>


        </div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>