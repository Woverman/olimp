<div id="center_panel">
        <div id="object_wrapper">
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
				if ($ff->price1!=0) $usl[]='cast>='.$ff->price1;
				if ($ff->price2!=0) $usl[]='cast<='.$ff->price2;
				if ($ff->tn==2) {if ($ff->kk!='0') $usl[]='kk='.$ff->kk;}
				if ($ff->tn==1) {if ($ff->dom_domtype!='0') $usl[]='dom_domtype='.$ff->dom_domtype;}

				if (!empty($usl))
					$sql .= ' where '.implode(" and ", $usl);

//					debug($usl,"usl=");
  //					debug($sql,"sql=");
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

					if ($ff->pg != 'all')
						$sql.=' limit '.(($ff->pg-1)*$perpage).','.$perpage;
					//debug($sql,'$sql =');
					//debug($ff->pg,'$ff->pg =');
					$res=mysql_query($sql);
					while ($row=mysql_fetch_assoc($res)) {
						$obj = Object::parse($row);
						$id=$row['id'];
				    	//$images = glob("./i/obj/tmb_".$id."_*.jpg", GLOB_NOSORT);
					    //$imgsrc=(count($images) > 0) ? '/image.php?objid='.$id.'&mode=2' : $imgsrc='/i/no_smol.jpg';
						?>
<div class='object_outer ui-corner-all'>
<a href=<?='/object/'.$obj->id?>><div class="news_shadow_img"><img src=<?=$obj->img(1)?> class='thumb'></div></a>
<span class="action"><?=$sys['lists']['actions'][$obj->prodazh].$sys['lists']['typesner'][$obj->type]?></span>
<span class="price"><?=$obj->price()?></span>
<span class="address"><?=$obj->address()?></span>
<span class="shortinfo"><?=$obj->ShortInfo()?></span>
<p class="comment"><?=$obj->commentCrop()?></p>
<div class="datemore"><div><?=$obj->added()?></div><div class="more"><a href=<?='/object/'.$obj->id;?>>Детальніше...</a></div></div>

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
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>