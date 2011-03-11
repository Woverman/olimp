<?php

global $config;
require_once('../../inc/functions.php');
include ('../../inc/config.php'); 
include ('../../inc/pre.php'); 

if (isset($_POST['type']) && $_POST['type']=='dom') 
{
  if (isset($_POST['dom_gaz'])) $_POST['dom_komm'][$_POST['dom_gaz']] = 1;

  (empty($_POST['editid'])) ? $id=newid() : $id=$_POST['editid'];
  $sql='Update m_bildings set %s = \'%s\' where id='.$id;

  /*print ToString($_POST['dom_komm'],15);

	echo "<pre>";
	print_r ($_POST);
	echo "</pre>";
  */


    	
  mysql_unbuffered_query(sprintf($sql,'type',$_POST['type']));
  if (isset($_POST['prodazh'])) mysql_unbuffered_query(sprintf($sql,'prodazh',$_POST['prodazh']));
  if (isset($_POST['num'])) mysql_unbuffered_query(sprintf($sql,'num',$_POST['num']));
  if (isset($_POST['obl'])) mysql_unbuffered_query(sprintf($sql,'adr_obl',$_POST['obl']));
  if (isset($_POST['rgn'])) mysql_unbuffered_query(sprintf($sql,'adr_rgn',$_POST['rgn']));
  if (isset($_POST['mista'])) mysql_unbuffered_query(sprintf($sql,'adr_gor',$_POST['mista']));
  if (isset($_POST['vul'])) {
    mysql_unbuffered_query(sprintf($sql,'adr_vul',$_POST['vul']));
    check_vul($_POST['vul'],$_POST['mista']);
    }
  if (isset($_POST['dom_domtype'])) mysql_unbuffered_query(sprintf($sql,'dom_domtype',$_POST['dom_domtype']));
  if (isset($_POST['kk'])) mysql_unbuffered_query(sprintf($sql,'kk',$_POST['kk']));
  if (isset($_POST['chastdoma'])) mysql_unbuffered_query(sprintf($sql,'chastdoma',$_POST['chastdoma']));
  if (isset($_POST['TmSdch'])) mysql_unbuffered_query(sprintf($sql,'kva_zdan',$_POST['TmSdch']));
  if (isset($_POST['povv'])) mysql_unbuffered_query(sprintf($sql,'povv',$_POST['povv']));
  if (isset($_POST['dom_sost'])) mysql_unbuffered_query(sprintf($sql,'dom_sost',$_POST['dom_sost']));
  if (isset($_POST['pzag'])) mysql_unbuffered_query(sprintf($sql,'pzag',$_POST['pzag']));
  if (isset($_POST['pzhil'])) mysql_unbuffered_query(sprintf($sql,'pzit',$_POST['pzhil']));
  if (isset($_POST['pkuh'])) mysql_unbuffered_query(sprintf($sql,'pkuh',$_POST['pkuh']));
  if (isset($_POST['Gotov'])) mysql_unbuffered_query(sprintf($sql,'Gotov',$_POST['Gotov']));
  if (isset($_POST['pdil'])) mysql_unbuffered_query(sprintf($sql,'pdil',$_POST['pdil']));
  if (isset($_POST['plo_od'])) mysql_unbuffered_query(sprintf($sql,'plo_od',$_POST['plo_od']));
  if (isset($_POST['cast'])) mysql_unbuffered_query(sprintf($sql,'cast',$_POST['cast']));
  if (isset($_POST['casttype'])) mysql_unbuffered_query(sprintf($sql,'casttype',$_POST['casttype']));
  if (isset($_POST['valuta'])) mysql_unbuffered_query(sprintf($sql,'valuta',$_POST['valuta']));
  
  if (isset($_POST['dom_komm'])) mysql_unbuffered_query(sprintf($sql,'dom_komm',ToString($_POST['dom_komm'],15)));
  if (isset($_POST['dom_stinu'])) mysql_unbuffered_query(sprintf($sql,'dom_stinu',ToString($_POST['dom_stinu'],21)));
  if (isset($_POST['dom_dop'])) mysql_unbuffered_query(sprintf($sql,'dom_dop',ToString($_POST['dom_dop'],22)));
  if (isset($_POST['dom_indil'])) mysql_unbuffered_query(sprintf($sql,'dom_indil',ToString($_POST['dom_indil'],24)));
  if (isset($_POST['dom_dod'])) mysql_unbuffered_query(sprintf($sql,'dom_dod',ToString($_POST['dom_dod'],8)));
  
  if (isset($_POST['comment'])) mysql_unbuffered_query(sprintf($sql,'comment',addslashes($_POST['comment'])));
  if (isset($_POST['agent'])) mysql_unbuffered_query(sprintf($sql,'kont',$_POST['agent']));
  if (isset($_POST['exclusive']))  mysql_unbuffered_query(sprintf($sql,'exclusive',$_POST['exclusive']));
  else mysql_unbuffered_query(sprintf($sql,'exclusive',0));
  if (isset($_POST['novobud']))  mysql_unbuffered_query(sprintf($sql,'novobud',$_POST['novobud']));
  else mysql_unbuffered_query(sprintf($sql,'novobud',0));
  if (isset($_POST['hot'])) mysql_unbuffered_query(sprintf($sql,'in_hot',$_POST['hot']));
  else mysql_unbuffered_query(sprintf($sql,'in_hot',0));
  if (isset($_POST['onmain'])) mysql_unbuffered_query(sprintf($sql,'in_main',$_POST['onmain']));
  else mysql_unbuffered_query(sprintf($sql,'in_main',0));
  $numfoto=1;
  if (isset($_POST['fdel_1'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_2'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_3'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_4'])) delfoto($numfoto,$id); else $numfoto++;
  if (isset($_POST['fdel_5'])) delfoto($numfoto,$id);
  mysql_unbuffered_query(sprintf($sql,'add','NOW()'));

  saveImgToFile($id);
}
	//header("HTTP/1.1 301 Moved Permanently");
	//header("Location: /admin/admin.php?panel=".$type);
	//header("Location:../admin.php?panel=dom&result=1");
  if (isset($_POST['f_nomer'])) $f_params="&nomer=".$_POST['f_nomer'];
if (isset($_POST['f_agent'])) $f_params.="&agent=".$_POST['f_agent'];
if (isset($_POST['f_obl'])) $f_params.="&obl=".$_POST['f_obl'];
if (isset($_POST['f_rgn'])) $f_params.="&rgn=".$_POST['f_rgn'];
if (isset($_POST['f_mista'])) $f_params.="&mista=".$_POST['f_mista'];


	header("Location:../admin.php?panel=dom&result=1".$f_params);
?>
