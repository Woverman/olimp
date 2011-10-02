<?
$id=$_POST['editid'];

debug($id,"ID");
debug($_POST,"POST");
debug($_GET,"GET");


  $sql='Update m_bildings set %s = \'%s\' where id='.$id;

// адреса -->
  if (isset($_POST['prodazh'])) mysql_unbuffered_query(sprintf($sql,'prodazh',$_POST['prodazh']));
  if (isset($_POST['prodano'])) mysql_unbuffered_query(sprintf($sql,'prodano',$_POST['prodano']));
  if (isset($_POST['num'])) mysql_unbuffered_query(sprintf($sql,'num',$_POST['num']));
  if (isset($_POST['adr_obl'])) mysql_unbuffered_query(sprintf($sql,'adr_obl',$_POST['adr_obl']));
  if (isset($_POST['adr_rgn'])) mysql_unbuffered_query(sprintf($sql,'adr_rgn',$_POST['adr_rgn']));
  if (isset($_POST['adr_dist'])) mysql_unbuffered_query(sprintf($sql,'adr_dist',$_POST['adr_dist']));
  if (isset($_POST['adr_mista'])){
  	// misto_id (from d_mista) => dist_id (from d_dist)
  	$dists = array('1064' => '16', '1073' => '20', '1076' => '18', '1084' => '22', '1107' => '19', '1114' => '17', '1068' => '21', '30000' => '7');
	if (array_key_exists($_POST['adr_mista'],$dists)){
		// if misto in dists array write misto=vinnitsa and dist=founded dist id
		$dist = array_search($_POST['adr_mista'],$dists);
		mysql_unbuffered_query(sprintf($sql,'adr_gor','1063'));
		mysql_unbuffered_query(sprintf($sql,'adr_dist',$dist));
	} else {
  		mysql_unbuffered_query(sprintf($sql,'adr_gor',$_POST['adr_mista']));
	}
  }

  if (isset($_POST['adr_vul'])){
    mysql_unbuffered_query(sprintf($sql,'adr_vul',$_POST['adr_vul']));
    check_vul($_POST['adr_vul'],$_POST['adr_mista']);    }

// квартира -->
  if (isset($_POST['typekva'])) mysql_unbuffered_query(sprintf($sql,'kva_type',$_POST['typekva']));
  if (isset($_POST['kk'])) mysql_unbuffered_query(sprintf($sql,'kk',$_POST['kk']));
  if (isset($_POST['pov'])) mysql_unbuffered_query(sprintf($sql,'pov',$_POST['pov']));
  if (isset($_POST['povv'])) mysql_unbuffered_query(sprintf($sql,'povv',$_POST['povv']));
  if (isset($_POST['pzag'])) mysql_unbuffered_query(sprintf($sql,'pzag',$_POST['pzag']));
  if (isset($_POST['pzit'])) mysql_unbuffered_query(sprintf($sql,'pzit',$_POST['pzit']));
  if (isset($_POST['pkuh'])) mysql_unbuffered_query(sprintf($sql,'pkuh',$_POST['pkuh']));
  if (isset($_POST['cast'])) mysql_unbuffered_query(sprintf($sql,'cast',$_POST['cast']));
  if (isset($_POST['casttype'])) mysql_unbuffered_query(sprintf($sql,'casttype',$_POST['casttype']));
  if (isset($_POST['valuta'])) mysql_unbuffered_query(sprintf($sql,'valuta',$_POST['valuta']));

// будинок -->
  if (isset($_POST['dom_domtype'])) mysql_unbuffered_query(sprintf($sql,'dom_domtype',$_POST['dom_domtype']));
  if (isset($_POST['pdil'])) mysql_unbuffered_query(sprintf($sql,'pdil',$_POST['pdil']));
  if (isset($_POST['plo_od'])) mysql_unbuffered_query(sprintf($sql,'plo_od',$_POST['plo_od']));

// ділянка -->
  if (isset($_POST['rTipC'])){ mysql_unbuffered_query(sprintf($sql,'rTipC',ToString($_POST['rTipC'],11)));
debug(ToString($_POST['rTipC'],11),"rTipC");}
// комерційний -->
 if (isset($_POST['com_var'])){ mysql_unbuffered_query(sprintf($sql,'com_var',ToString($_POST['com_var'],9)));
debug(ToString($_POST['com_var'],9),"com_var");}
// загальне -->
  if (isset($_POST['agent'])) mysql_unbuffered_query(sprintf($sql,'kont',$_POST['agent']));
  if (isset($_POST['comment'])) mysql_unbuffered_query(sprintf($sql,'comment',addslashes($_POST['comment'])));
  if (isset($_POST['exclusive']))  mysql_unbuffered_query(sprintf($sql,'exclusive',$_POST['exclusive']));
  	else mysql_unbuffered_query(sprintf($sql,'exclusive',0));
  if (isset($_POST['novobud']))  mysql_unbuffered_query(sprintf($sql,'novobud',$_POST['novobud']));
  	else mysql_unbuffered_query(sprintf($sql,'novobud',0));
  if (isset($_POST['hot'])) mysql_unbuffered_query(sprintf($sql,'in_hot',$_POST['hot']));
  	else mysql_unbuffered_query(sprintf($sql,'in_hot',0));
  if (isset($_POST['onmain'])) mysql_unbuffered_query(sprintf($sql,'in_main',$_POST['onmain']));
  	else mysql_unbuffered_query(sprintf($sql,'in_main',0));

// дата запису -->
  mysql_unbuffered_query(sprintf($sql,'add','NOW()'));

// фотографії -->
  $numfoto=1;
  if (isset($_POST['fdel_1'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_2'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_3'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_4'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_5'])) delfoto($numfoto,$id);
  saveImgToFile($id);


if (isset($_POST['f_nomer'])) $f_params="&nomer=".$_POST['f_nomer'];
if (isset($_POST['f_agent'])) $f_params.="&agent=".$_POST['f_agent'];
if (isset($_POST['f_obl'])) $f_params.="&obl=".$_POST['f_obl'];
if (isset($_POST['f_rgn'])) $f_params.="&rgn=".$_POST['f_rgn'];
if (isset($_POST['f_mista'])) $f_params.="&mista=".$_POST['f_mista'];
if (isset($_POST['f_dist'])) $f_params.="&dist=".$_POST['f_dist'];


	//header("Location:../admin.php?panel=".$_POST['panel']."&result=1".$f_params);
$url = "/admin/".$_POST['type']."/?result=1".$f_params;

?>

<script>
window.location.href="<?=$url?>"
</script>