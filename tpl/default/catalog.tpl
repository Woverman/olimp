<div id="center_panel">
        <div id="object_wrapper">
        <div id="object_inner">
<?
$ff = new FindParameters();
if ($ff->proj->id!=0){
	echo ("<div id='news_title' class='ui-corner-all'>".$ff->proj->title."</div><div id=sub_menu style='text-align: center;'>");
	echo maketabs(array('Головна','Список квартир','Етапи будівництва',"Завершені об'єкти")
		,array("/article/".$ff->proj->mainpage."/","#","/galery/".$ff->proj->mainpage."/","/galery/".$ff->proj->mainpage."/?type=old")
		,1
		,0);
}
	echo("</div>");
?>
			<div id="sub_menu" style="text-align: center;">
			<?
			$ff->kk=0;
			$ff->dom_domtype=0;
			$ff->pg=0;
			$ff = new FindParameters();
			if ($ff->showSubmenu==1)
				echo maketabs(array('Все','Будинки','Квартири','Ділянки','Комерційна нерухомість'),array($ff->createURL("tn",0),$ff->createURL("tn",1),$ff->createURL("tn",2),$ff->createURL("tn",3),$ff->createURL("tn",4)),$ff->tn, 0);
			else
				$ff->tn=2;
			if ($ff->tn==1) {
		  		echo maketabs(array('Всі','будинок','частина будинку','дача'),array($ff->createURL("dom_domtype",0),$ff->createURL("dom_domtype",1),$ff->createURL("dom_domtype",2),$ff->createURL("dom_domtype",3)),$ff->dom_domtype, 1);
			}
			if ($ff->tn==2){
			  if ($ff->proj->id==0){
				if ($ff->kk==0) $pos = 0;
				if ($ff->kk==-1) $pos = 1;
				if ($ff->kk==1) $pos = 2;
				if ($ff->kk==2) $pos = 3;
				if ($ff->kk==3) $pos = 4;
				if ($ff->kk==4) $pos = 5;
				if ($ff->kk==99) $pos = 6;
			  	echo maketabs(array('Всі','Частина квартири','1-кімн.','2-кімн.','3-кімн.','4-кімн.','>4 кімнат'),array($ff->createURL("kk",0),$ff->createURL("kk",-1),$ff->createURL("kk",1),$ff->createURL("kk",2),$ff->createURL("kk",3),$ff->createURL("kk",4),$ff->createURL("kk",99)),$pos, 1);
				}
			  else{
			  	$pos = $ff->kk;
				if ($ff->kk==99) $pos = 5;
				echo maketabs(array('Всі','1-кімн.','2-кімн.','3-кімн.','4-кімн.','>4 кімнат'),array($ff->createURL("kk",0),$ff->createURL("kk",1),$ff->createURL("kk",2),$ff->createURL("kk",3),$ff->createURL("kk",4),$ff->createURL("kk",99)),$pos, 1);
			  	}
			}
			?>
			</div>
                <?
				$ff = new FindParameters();
				debug($ff,"ff=");
				$ntypes=array('','dom','kva','dil','com');
				$sql='Select count(id) from m_bildings';
				if ($ff->tn!='0')  $usl[]="type='".$ntypes[$ff->tn]."'";
				$usl[]='prodazh='.$ff->pr;
				if ($ff->gor!='0') $usl[]='adr_gor='.$ff->gor;
				if ($ff->rgn!='0') $usl[]='adr_rgn='.$ff->rgn;
				if ($ff->dist!='0') $usl[]='adr_dist in ('.$ff->dist.')';
				if ($ff->obl!='0') $usl[]='adr_obl='.$ff->obl;
				if ($ff->price1!=0) $usl[]='cast>='.$ff->price1;
				if ($ff->price2!=0) $usl[]='cast<='.$ff->price2;
				if ($ff->proj->id!=0) $usl[]='proj='.$ff->proj->id;
				if ($ff->proj->id==0) $usl[]='prodano=0';
				if ($ff->tn==2) {if ($ff->kk!='0') $usl[]='kk='.$ff->kk;}
				if ($ff->tn==1) {if ($ff->dom_domtype!='0') $usl[]='dom_domtype='.$ff->dom_domtype;}

				if (!empty($usl))
					$sql .= ' where '.implode(" and ", $usl);
					$sql .= ' order by cast asc';
					debug($usl,"usl=");
  					debug($sql,"sql=");
				$res=mysql_query($sql);

				$icnt=@mysql_result($res,0);
				@mysql_free_result($res);

				if ($icnt>0) {
					$perpage=10;
					$pagecount=ceil($icnt/$perpage);
					if ($ff->pg > $pagecount)
						$ff->pg=1;
					if (($ff->proj->id==0) && ($pagecount>1)) MakePageLinks($ff->pg,$pagecount,$icnt,$ff);
					$sql='Select * from m_bildings';
					if (!empty($usl))
						$sql .= ' where '.implode(" and ", $usl);
					$sql .= ' order by cast asc';
					if (($ff->pg != 'all') && ($ff->proj->id==0))
						$sql.=' limit '.(($ff->pg-1)*$perpage).','.$perpage;
					$res=mysql_query($sql);
					while ($row=mysql_fetch_assoc($res)) {
						$obj = Object::parse($row);
						$id=$row['id'];
				    	//$images = glob("./i/obj/tmb_".$id."_*.jpg", GLOB_NOSORT);
					    //$imgsrc=(count($images) > 0) ? '/image.php?objid='.$id.'&mode=2' : $imgsrc='/i/no_smol.jpg';
						?>
<div class='object_outer ui-corner-all <?=($obj->prodano==1)?"prodano":"neprodano"?>'><div class="content">
<a href=<?='/object/'.$obj->id?>><div class="news_shadow_img"><img src=<?=$obj->img(1)?> class='thumb'></div></a>
<span class="action"><?=$sys['lists']['actions'][$obj->prodazh].$sys['lists']['typesner'][$obj->type]?></span>
<span class="price"><?=$obj->price()?></span>
<span class="address"><?=$obj->address()?></span>
<span class="shortinfo"><?=$obj->ShortInfo()?></span>
<p class="comment"><?=$obj->commentCrop()?></p></div>
<div class="datemore ui-corner-all"><div><?=$obj->added()?></div><div class="more">
<a href=<?='/object/'.$obj->id;?>>Детальніше...</a></div></div>

</div>
<?
}
	if (($ff->proj->id==0) && ($pagecount>1)) MakePageLinks($ff->pg,$pagecount,$icnt,$ff);
} else {
	echo $notfoundmsg;
}
?>

        </div>
	</div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>