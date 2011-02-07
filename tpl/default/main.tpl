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
                    $sql = "select * from m_bildings where in_main=1 order by rand() limit 4";
                    $res = $DB->request($sql,ARRAY_A);
                    //print_r($res[0]);
                ?>
                <table width="100%">
                    <tr>
                    <td style="width:50%" valign="top">
                        <a href="/object/<?=$res[0]['id']?>"><img width="400" src="<?=$res[0]['img']?>" class="notice_img_big"><br />
                        <?=$res[0]['adr_gor'].' '.$res[0]['adr_vul']?></a><br />
                        <?=$res[0]['kk'].'-на квартира '.$res[0]['plo_zag'].' кв. м.'?><br />
                        <?=$res[0]['cast'].' '.$res[0]['valuta']?>
                    </td>
                    <td valign="top">
                        <a href="/object/<?=$res[1]['id']?>"><img src="<?=$res[1]['img']?>" class="notice_img"><br />
                        <?=$res[1]['adr_gor'].' '.$res[1]['adr_vul']?></a><br />
                        <?=$res[1]['kk'].'-на квартира '.$res[1]['plo_zag'].' кв. м.'?><br />
                        <?=$res[1]['cast'].' '.$res[1]['valuta']?>
                        <div class="notice_delimiter"></div>
                        <a href="/object/<?=$res[2]['id']?>"><img src="<?=$res[2]['img']?>" class="notice_img"><br />
                        <?=$res[2]['adr_gor'].' '.$res[2]['adr_vul']?></a><br />
                        <?=$res[2]['kk'].'-на квартира '.$res[2]['plo_zag'].' кв. м.'?><br />
                        <?=$res[2]['cast'].' '.$res[2]['valuta']?>
                        <div class="notice_delimiter"></div>
                        <a href="/object/<?=$res[3]['id']?>"><img src="<?=$res[3]['img']?>" class="notice_img"><br />
                        <?=$res[3]['adr_gor'].' '.$res[3]['adr_vul']?></a><br />
                        <?=$res[3]['kk'].'-на квартира '.$res[3]['plo_zag'].' кв. м.'?><br />
                        <?=$res[3]['cast'].' '.$res[3]['valuta']?>
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
