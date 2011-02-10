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
					$cnt = 10;
                    $sql = "select * from m_bildings where in_main=1 order by rand() limit $cnt";
                    $res = $DB->request($sql,ARRAY_A);
                    //print_r($res[0]);
                ?>
                <table width="100%">
                    <tr>
                    <td style="width:50%" valign="top">
					<div id="big_notices_wrapper" style="height: 374px;overflow: hidden;position: relative;">
						<div id="big_notices_inner" style="position: relative;width: 200%;height: 374px;">
							<div class="notice_item_big">
								<? $object = Object::parse($res[0]); ?>
		                        <a href="/object/<?=$object->id?>"><img src="<?=$object->img(1)?>"><br />
		                        <?=$object->address()?></a><br />
		                        <?=$object->shortDetails()?><br />
		                        <?=$object->price()?>
							</div>
						</div>
					</div>
                    </td>
                    <td valign="top">
						<div id="small_notices_wrapper" style="height: 374px;overflow: hidden;position: relative;">
							<div id="small_notices_inner" style="position: relative;">
								<?
								for ($i=1;$i<$cnt;$i++){
									$object = Object::parse($res[$i]);
								?>
								<div class="notice_item">
			                        <a href="/object/<?=$object->id?>"><img src="<?=$object->img(1)?>"><br />
			                        <?=$object->address()?></a><br />
			                        <?=$object->shortDetails()?><br />
			                        <?=$object->price()?>
								</div>
								<div class="notice_delimiter"></div>
								<? } ?>
							</div>
						</div>
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
