<?  $obj = Object::load($id);?>
<div id="center_panel" style="padding-top: 1px;">
    <div id="wrapper">
		<div class="vidget ui-corner-all"><a href="<?=$_SERVER["HTTP_REFERER"]?>">Повернутись до списку</a></div>
        <div class="only_wrapper ui-corner-all" style="min-height: 344px;">
		<? if ($obj->adr_obl) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>'><?= findadr($obj->adr_obl,'d_oblasti') ?> обл.</a></span> / <?}?>
		<? if ($obj->adr_rgn) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>&rgn=<?= $obj->adr_rgn ?>'><?= findadr($obj->adr_rgn,'d_rgn') ?> р-н</a></span> /<?}?>
		<? if ($obj->adr_gor) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>&rgn=<?= $obj->adr_rgn ?>&gor=<?= $obj->adr_gor ?>'><?= findadr($obj->adr_gor,'d_mista') ?></a></span> /<?}?>
		<? if ($obj->adr_dist) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>&rgn=<?= $obj->adr_rgn ?>&gor=<?= $obj->adr_gor ?>&dist=<?= $obj->adr_dist ?>'><?= findadr($obj->adr_dist,'d_dist') ?></a></span> /<?}?>
		<? if ($obj->adr_vul) { ?>
		<span><? $obj->adr_vul ?></span><?}?>
		<div style="clear: both"></div>
        <?

            echo "<div class='news_shadow_img' style='float:left;overflow:hidden;max-height:450px;padding-right:10px;'><a href='".$obj->img(1,1)."' class='ilink'><img width='400' style='max-height:448px;' src='".$obj->img(1,1)."'></a></div>";
            //
            $cnt = $obj->imgCount();
            if ($cnt>1){
            	echo("<div style='padding:1px; margin-left:415px;'>");
                for ($i=2;$i<=$cnt;$i++){
                    echo "<a href='".$obj->img($i,1)."' class='ilink'><div style='display: table-cell;width:104px; height:104px;margin:2px;padding:2px;float:left; border:1px solid silver;text-align:center;vertical-align: middle;'><img src='".$obj->img($i,2)."' style='border:0;max-width:102px;max-height:102px'></div></a>";
                }
            }

        ?>
			<div style="padding: 10px;margin:5px;">
			<span class="price"><?=$obj->price(true)?></span><br />

			<ul style="margin:1px;list-style-position: inside;">
	 <?
	 $li="<li>%s: &nbsp;<b>%s</b></li>";
	 debug($obj,"Object");
	 switch ($obj->type) {
      case 'com':
	  	printf($li,($obj->prodazh==1 ? 'Продається':'Здається'),$sys['lists']['typesner'][$obj->type]);
        break;
      case 'dom':
	  	printf($li,($obj->prodazh==1 ? 'Продається':'Здається'),$sys['lists']['dom_domtype'][$obj->dom_domtype]);
		if ($obj->povv>0) printf($li,'Поверхів',$obj->povv);
		if ($obj->kk>0) printf($li,'Кімнат',$obj->kk);
		printf($li,'Площа ','загальна - '.$obj->pzag.', житлова  - '.$obj->pzit.', кухня - '.$obj->pkuh);
		printf($li,'Ділянка',$obj->pdil.' '.formatod($sys['lists']['plo_od'][$obj->plo_od],$obj->pdil));
		//printf($li,'',$obj->);
        break;
      case 'dil':
        printf($li,($obj->prodazh==1 ? 'Продається':'Здається'),$sys['lists']['typesner'][$obj->type]);
		printf($li,'Ділянка',$obj->pdil.' '.formatod($sys['lists']['plo_od'][$obj->plo_od],$obj->pdil));
        break;
      case 'kva':
      default:
        printf($li,($obj->prodazh==1 ? 'Продається':'Здається'),$sys['lists']['kkimn'][$obj->kk].' '.$sys['lists']['typesner'][$obj->type]);
        printf($li,'Площа ','загальна - '.$obj->pzag.', житлова  - '.$obj->pzit.', кухня - '.$obj->pkuh);
        printf($li,'Поверх ',$obj->pov);
		if ($obj->povv != 0) printf($li,'Поверхів в будинку',$obj->povv);
        break;
    }
	if (!empty($obj->comment)) echo('<br><p>'.stripslashes($obj->comment).'</p>');
	if ($obj->kont->name_long!='') $kontactInfo = ($obj->formatKontakt());
	?>
			</ul>
			</div>
		</div>

	<div class="only_wrapper ui-corner-all">
		<?=$kontactInfo?>
	</div>
	<div class="only_wrapper ui-corner-all">
		<div id="vk_comments"></div>
		<script type="text/javascript">
			VK.Widgets.Comments("vk_comments");
			if (window.addEventListener) {
		        window.addEventListener("load",VKInit,false);
		     } else if (window.attachEvent) {
		         window.attachEvent("onload",VKInit);
		     } else {
		     	window.onload = function() {VKInit();}
    			 }
		</script>
	</div>
</div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>