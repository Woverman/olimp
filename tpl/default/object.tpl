<div id="center_panel">
    <div id="wrapper">
        <div id="only_wrapper" class="ui-corner-all" style="border: 1px solid #99CCFF;padding:5px;">
        <?
            $obj = Object::load($id);
            echo "<div class='news_shadow_img'><a href='".$obj->img(2,1)."'><img width='500' src='".$obj->img(2,1)."'></a></div>";
            echo "<br style='clear:both'>";
            $cnt = $obj->imgCount();
            if ($cnt>1){
                for ($i=2;$i<$cnt;$i++){
                    echo "<a href='".$obj->img($i,1)."'><img src='".$obj->img($i,2)."'></a>";
                }
            }
        ?>


        </div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>