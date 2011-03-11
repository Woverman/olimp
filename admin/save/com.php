<?php

global $config;
require_once('../../inc/functions.php');
include ('../../inc/config.php'); 
include ('../../inc/pre.php'); 

if (isset($_POST['type']) && $_POST['type']=='com') 
{
  (empty($_POST['editid'])) ? $id=newid() : $id=$_POST['editid'];
  $sql='Update m_bildings set %s = \'%s\' where id='.$id;
  
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
  if (isset($_POST['pzag'])) mysql_unbuffered_query(sprintf($sql,'pzag',$_POST['pzag']));
  if (isset($_POST['kk'])) mysql_unbuffered_query(sprintf($sql,'kk',$_POST['kk']));
  if (isset($_POST['pov'])) mysql_unbuffered_query(sprintf($sql,'pov',$_POST['pov']));
  if (isset($_POST['povv'])) mysql_unbuffered_query(sprintf($sql,'povv',$_POST['povv']));
  if (isset($_POST['stelya'])) mysql_unbuffered_query(sprintf($sql,'stelya',$_POST['stelya']));
  if (isset($_POST['cast'])) mysql_unbuffered_query(sprintf($sql,'cast',$_POST['cast']));
  if (isset($_POST['valuta'])) mysql_unbuffered_query(sprintf($sql,'valuta',$_POST['valuta']));
  if (isset($_POST['casttype'])) mysql_unbuffered_query(sprintf($sql,'casttype',$_POST['casttype']));
  if (isset($_POST['office_type'])) mysql_unbuffered_query(sprintf($sql,'office_type',$_POST['office_type']));
  if (isset($_POST['class'])) mysql_unbuffered_query(sprintf($sql,'class',$_POST['class']));
  if (isset($_POST['TmSdch'])) mysql_unbuffered_query(sprintf($sql,'TmSdch',$_POST['TmSdch']));
  if (isset($_POST['class'])) mysql_unbuffered_query(sprintf($sql,'class',$_POST['class']));
  if (isset($_POST['class'])) mysql_unbuffered_query(sprintf($sql,'class',$_POST['class']));
  if (isset($_POST['comment'])) mysql_unbuffered_query(sprintf($sql,'comment',addslashes($_POST['comment'])));
  if (isset($_POST['agent'])) mysql_unbuffered_query(sprintf($sql,'kont',$_POST['agent']));
  
  if (isset($_POST['in_office'])) mysql_unbuffered_query(sprintf($sql,'in_office',ToString($_POST['in_office'],16)));
  if (isset($_POST['in_office_dom'])) mysql_unbuffered_query(sprintf($sql,'in_office_dom',ToString($_POST['in_office_dom'],12)));
  if (isset($_POST['com_var'])) mysql_unbuffered_query(sprintf($sql,'com_var',ToString($_POST['com_var'],9)));
  if (isset($_POST['com_in_skladd'])) mysql_unbuffered_query(sprintf($sql,'com_in_skladd',ToString($_POST['com_in_skladd'],12)));
  
  if (isset($_POST['planing']))  mysql_unbuffered_query(sprintf($sql,'planing',$_POST['planing']));
  if (isset($_POST['com_stan']))  mysql_unbuffered_query(sprintf($sql,'com_stan',$_POST['com_stan']));
  if (isset($_POST['tel_count']))  mysql_unbuffered_query(sprintf($sql,'tel_count',$_POST['tel_count']));
  if (isset($_POST['com_name']))  mysql_unbuffered_query(sprintf($sql,'com_name',$_POST['com_name']));
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

if (isset($_POST['f_nomer'])) $f_params="&nomer=".$_POST['f_nomer'];
if (isset($_POST['f_agent'])) $f_params.="&agent=".$_POST['f_agent'];
if (isset($_POST['f_obl'])) $f_params.="&obl=".$_POST['f_obl'];
if (isset($_POST['f_rgn'])) $f_params.="&rgn=".$_POST['f_rgn'];
if (isset($_POST['f_mista'])) $f_params.="&mista=".$_POST['f_mista'];


	header("Location:../admin.php?panel=kner&result=1".$f_params);
?>
