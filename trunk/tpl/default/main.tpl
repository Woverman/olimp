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
            <div id="notices_inner" class="ui-corner-all" style="white-space: pre">
                <?
                    $sql = "select * from m_bildings where in_main=1 order by rand() limit 4";
                    $res = $DB->request($sql,ARRAY_A);
                    //print_r($res[0]);
                ?>
                <table>
                    <tr>
                    <td>
                        <a href="/object/<?=$res[0]['id']?>"><img src="<?=$res[0]['img']?>" class="notice_img_big"><br />
                        <?=$res[0]['adr_gor'].' '.$res[0]['adr_vul']?></a><br />
                        <?=$res[0]['kk'].'-на квартира '.$res[0]['plo_zag'].' кв. м.'?><br />
                        <?=$res[0]['cast'].' '.$res[0]['valuta']?>
                    </td>
                    <td>
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
<? if ($page->hasleft){?>
<div id="left_panel">
    <div class="vidget ui-corner-all" id='find_panel'><span>Пошук</span>
		<?
	        include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/find.tpl');
      	?>
    </div>
    <div class="vidget ui-corner-all">
        <A href="http://www.dilovamova.com/"><IMG width=150 height=250 border=0 alt="Календар свят і подій. Листівки, вітання та побажання" title="Календар свят і подій. Листівки, вітання та побажання" src="http://www.dilovamova.com/images/wpi.cache/informer/informer.png"></A>    
    </div>
</div>
<? }
if ($page->hasright){?>
<div id="right_panel">
    <div class="vidget ui-corner-all"><img src="/ban/novo5.gif" width="228" height="300" alt="" /></div>
    <div class="vidget ui-corner-all"><span>Курси валют</span>
        <a href="http://www.ukrbanks.info/" target="_blank" alt="Банки України - новини банків, курси валют, рейтинг банків України!"><img src="http://www.ukrbanks.info/informer/nbu/ua-nbu.big.gif" width="240" height="210" border="0" alt="Курси НБУ на сьогодні"></a>
    </div>
    <div class="vidget ui-corner-all"><span>Погода</span>
        <script language='JavaScript' type='text/javascript' src='http://informer.gismeteo.ru/html/js/showtlist_new.js'></script>
        <script language='JavaScript' type='text/javascript' src='http://informer.gismeteo.ru/html/js/ldata_new.js'></script>
        <div id='informer1'></div>
        <div id='infscript' style='visibility:hidden'></div>
        <script language='JavaScript' type='text/javascript' src='http://informer.gismeteo.ru/html/2.php?tnumber=1&city0=4962%D0%92%D0%B8%D0%BD%D0%BD%D0%B8%D1%86%D0%B0&codepg=utf-8&par=4&inflang=rus&domain=ru&vieinf=1&p=1&w=1&tblstl=gmtbl&tdttlstl=gmtdttl&tdtext=gmtdtext&new_scheme=1'></script>
    </div>
</div>
<? } ?>
<div id="menu_panel_double"></div>
