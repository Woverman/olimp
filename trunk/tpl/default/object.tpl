<?  $obj = Object::load($id); //debug($id,"id"); debug($obj,"obj"); ?>
<div id="center_panel" style="padding-top: 1px;">
    <div id="wrapper">
        <div id="only_wrapper" class="ui-corner-all" style="border: 1px solid #99CCFF;padding:5px;margin-top: 4px;">
		<? if ($obj->adr_obl) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>'><?= findadr($obj->adr_obl,'d_oblasti') ?> обл.</a></span> / <?}?>
		<? if ($obj->adr_rgn) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>&rgn=<?= $obj->adr_rgn ?>'><?= findadr($obj->adr_rgn,'d_rgn') ?> р-н</a></span> /<?}?>
		<? if ($obj->adr_gor) { ?>
		<span><a href='/catalog/<?=$obj->prodazh?>/?obl=<?= $obj->adr_obl ?>&rgn=<?= $obj->adr_rgn ?>&gor=<?= $obj->adr_gor ?>'><?= findadr($obj->adr_gor,'d_mista') ?></a></span> /<?}?>
		<? if ($obj->adr_vul) { ?>
		<span><? $obj->adr_vul ?></span><?}?>
		<div style="clear: both"></div>
        <?

            echo "<div class='news_shadow_img' style='float:left;overflow:hidden;max-height:450px;'><a href='".$obj->img(1,1)."' class='ilink'><img width='400' src='".$obj->img(1,1)."'></a></div>";
            //
            $cnt = $obj->imgCount();
            if ($cnt>1){
            	echo("<div style='padding:1px; margin-left:415px;'>");
                for ($i=2;$i<=$cnt;$i++){
                    echo "<a href='".$obj->img($i,1)."' class='ilink'><div style='display: table-cell;width:104px; height:104px;margin:2px;padding:2px;float:left; border:1px solid silver;text-align:center;vertical-align: middle;'><img src='".$obj->img($i,2)."' style='border:0;'></div></a>";
                }
            }

        ?>
	<span class="price"><?=$obj->price(true)?></span><br />
			<div style="padding: 10px;float:left;">
			<ul style="margin:1px;list-style-position: inside;">
	 <?
	 $li="<li>%s: &nbsp;<b>%s</b></li>";
	 switch ($obj->type) {
      case 'com':
      case 'dom':
      case 'dil':
        printf($li,($obj->prodazh==1 ? 'Продається':'Здається'),$sys['lists']['typesner'][$obj->type]);
        break;
      case 'kva':
      default:
        printf($li,($obj->prodazh==1 ? 'Продається':'Здається'),$sys['lists']['kkimn'][$obj->kk].' '.$sys['lists']['typesner'][$obj->type]);
        break;
    }
	if (!empty($obj->comment)) echo(stripslashes($obj->comment));
	?>
			</ul>
			</div>
	<div style="clear: both"></div>
			</div>
        </div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>