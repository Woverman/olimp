<div id="center_panel">
    <div id="wrapper">
        <div id="news_block">
            <div id="news_inner" class="ui-corner-all">
            <div id="news_title" class="ui-corner-all">Останні новини</div>
            <?
                $sql = "Select * from new_news where published=1 order by dateadd desc limit 3";
                $res = $DB->request($sql,ARRAY_A);
                foreach($res as $item){
                    include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/elem_news.tpl');
                }
            ?>
            </div>
        </div>
        <div id="notices_block">
			<div id="news_title" class="ui-corner-all">Нерухомість</div>
			<div id="notices_inner" class="ui-corner-all">
                <?
                    $sql = "select * from m_bildings where in_main=1 order by rand() limit 5";
                    $res = $DB->request($sql,ARRAY_A);
                    //print_r($res[0]);
                ?>
                <table width="100%">
                    <tr>
                    <td style="width:50%" valign="top">
						<div class="notice_item_big">
						<? $object = Object::parse($res[0]); ?>
                        <a href="/object/<?=$object->id?>"><img width="400" src="<?=$object->img(1)?>" class="notice_img_big"><br />
                        <?=$object->address()?></a><br />
                        <?=$object->shortDetails()?><br />
                        <?=$object->price()?>
						</div>
                    </td>
                    <td valign="top">
						<div class="notice_item">
                        <? $object = Object::parse($res[1]); ?>
                        <a href="/object/<?=$object->id?>"><img width="100" src="<?=$object->img(1)?>" class="notice_img">
                        <?=$object->address()?></a><br />
                        <?=$object->shortDetails()?><br />
                        <?=$object->price()?>
						</div>
                        <div class="notice_delimiter"></div>
						<div class="notice_item">
						<? $object = Object::parse($res[2]); ?>
                        <a href="/object/<?=$object->id?>"><img width="100" src="<?=$object->img(1)?>" class="notice_img">
                        <?=$object->address()?></a><br />
                        <?=$object->shortDetails()?><br />
                        <?=$object->price()?>
						</div>
                        <div class="notice_delimiter"></div>
						<div class="notice_item">
                        <? $object = Object::parse($res[3]); ?>
                        <a href="/object/<?=$object->id?>"><img width="100" src="<?=$object->img(1)?>" class="notice_img">
                        <?=$object->address()?></a><br />
                        <?=$object->shortDetails()?><br />
                        <?=$object->price()?>
						</div>
                        <div class="notice_delimiter"></div>
						<div class="notice_item">
                        <? $object = Object::parse($res[4]); ?>
                        <a href="/object/<?=$object->id?>"><img width="100" src="<?=$object->img(1)?>" class="notice_img">
                        <?=$object->address()?></a><br />
                        <?=$object->shortDetails()?><br />
                        <?=$object->price()?>
						</div>
                        <div class="notice_delimiter"></div>
                    </td>
                    </tr>
                </table>

            </div>
        </div>
        <div id="banner_block"><? $banner->showCurrentBanner(); ?></div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>
