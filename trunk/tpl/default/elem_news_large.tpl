<div class="news_item_wrapper">
<div class="news_item_inner ui-corner-all">
    <? if ($item['img']) {?>
    <div class="news_shadow_img">
    <img src="<?=$item['img']?>" width="120" height="90"  class="news_item_image">
    </div>
    <? } ?>
    <div class="news_item">
        <h3><span class="news_date"><?=$item['dt']?></span><?=$item['title']?></h3>
        <p class="news_intro"><?=$item['intro']?></p>
        <p class="news_text"><?=$item['text']?></p>
    </div>
</div>
</div>