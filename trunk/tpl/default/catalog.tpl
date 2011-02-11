<div id="center_panel">
    <div id="wrapper">
        <div id="notices_block">
            <div id="notices_inner">
                <?
				$ff = new FindParameters();

				$ntypes=array('','dom','kva','dil','com','bog');
				$sql='Select count(id) from m_bildings';
				if ($ff->tn!='0')
				  $usl[]="type='".$ntypes[$ff->tn]."'";
				else
				  $usl[]="type<>'bog'";

				$usl[]='prodazh='.$ff->pr;
				if ($ff->gor!='0') $usl[]='adr_gor='.$ff->gor;
				if ($ff->rgn!='0') $usl[]='adr_rgn='.$ff->rgn;
				if ($ff->dist!='0') $usl[]='adr_dist='.$ff->dist;
				if ($ff->obl!='0') $usl[]='adr_obl='.$ff->obl;
				if ($ff->prise1!=0) $usl[]='cast>='.$ff->prise1;
				if ($ff->prise2!=0) $usl[]='cast<='.$ff->prise2;
				if ($ff->tn==2) {if ($ff->kk!='0') $usl[]='kk='.$ff->kk;}
				if ($ff->tn==1) {if ($ff->dom_domtype!='0') $usl[]='dom_domtype='.$ff->dom_domtype;}

				if (!empty($usl))
					$sql .= ' where '.implode(" and ", $usl);
				$res=mysql_query($sql);

				$icnt=mysql_result($res,0);
				mysql_free_result($res);

				if ($icnt>0) {
					$perpage=10;
					$pagecount=ceil($icnt/$perpage);
					if ($ff->pg > $pagecount)
						$ff->pg=1;
					MakePageLinks($ff->pg,$pagecount,$icnt,$ff);
					$sql='Select * from m_bildings';
					if (!empty($usl))
						$sql .= ' where '.implode(" and ", $usl);

					if ($_REQUEST['page']!='all') $sql.=' limit '.(($ff->pg-1)*$perpage).','.$perpage;
					$res=mysql_query($sql);
					while ($row=mysql_fetch_assoc($res)) {
						$obj = Object::parse($row);
						$id=$row['id'];
				    	$images = glob("./i/obj/tmb_".$id."_*.jpg", GLOB_NOSORT);
					    $imgsrc=(count($images) > 0) ? '/image.php?objid='.$id.'&mode=2' : $imgsrc='/i/no_smol.jpg';
						?>
<div class='object_outer ui-corner-all'>

<div><?=$sys['lists']['actions'][$row['prodazh']].$sys['lists']['typesner'][$row['type']]?></div>
Ціна: <?=(empty($row['cast'])?'дог.':($row['cast'].' '.$sys['lists']['valutes'][$row['valuta']]))?>
<a href=<?=ROOT_FOLDER.'?tab=4&mode=details&oid='.$row['id']?>><img src=<?=$imgsrc?> class='thumb'></a>

<?=findadr($row['adr_obl'],'d_oblasti').' обл. / '.findadr($row['adr_rgn'],'d_rgn').' район / '.findadr($row['adr_gor'],'d_mista').' / вул. '.$row['adr_vul']?>
<? echo ($obj->ShortInfo()); ?>
<p><?=$row['comment']?></p>
<a href=<?=ROOT_FOLDER.'/object/'.$obj->id;?>>Детальніше...</a>

</div>
<?
}
	if ($pagecount>1) MakePageLinks($ff->pg,$pagecount,$icnt,$ff);
} else {
	echo $notfoundmsg;
}
?>

            </div>
        </div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>