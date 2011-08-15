<div id="center_panel">
    <div id="wrapper">
    <?  ?>
        <div id="news_block">
            <div id="news_inner">
            <p>
                Кнопка «Пользователи» нажимаем появляется «блок 3 Пользователи» в котором мы даем права этому супервайзеру на блок «Пользователи» добавить,  редактировать, удалить, выбираем из списка логины с которыми он имеет право работать (если он имеет право создавать то созданный им логин автоматически попадает в список разрешённых для работы логинов только этому супервайзеру,) может назначать ХТЗ или нет? Раздел Пн-ВС с-до? И раздел доступ, только в случае если он имеет право на раздел доступ IP менять он не может.
Кнопка «Работа с Адресами» тоже принципе.
Кнопка «Работа с информацией и подсказками» тоже.
Кнопка «Добавить» добавляет супервайзера создаем логин генерируем пароль, назначаем блоки доступа нажимаем «ОК»(блоки появляются в этом разделе слева и путем нажатия на блоки мы редактируем более конкретно права для каждого выбранного блока).
Кнопка «удалить» удаляет выбранного супервайзера
</p>
            </div>
        </div>
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
         <div id="banner_block"><? $target='Top1';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');?></div>
    </div>
</div>
<? if ($page->hasleft){?>
<div id="left_panel">
    <div class="vidget ui-corner-all"><span>Пошук</span>
            
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
