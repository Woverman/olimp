<?php

global $config;
require_once('../../inc/functions.php');
include ('../../inc/config.php'); 
include ('../../inc/pre.php'); 

if (isset($_POST['type']) && $_POST['type']=='dil') 
{
  $_POST['dil_komm'][$_POST['dil_gaz']] = 1;
  $_POST['dil_pos'][$_POST['dil_polozh']] = 1; 
    
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
  if (isset($_POST['vlasnist'])) mysql_unbuffered_query(sprintf($sql,'vlasnist',$_POST['vlasnist']));
  if (isset($_POST['cast'])) mysql_unbuffered_query(sprintf($sql,'cast',$_POST['cast']));
  if (isset($_POST['casttype'])) mysql_unbuffered_query(sprintf($sql,'casttype',$_POST['casttype']));
  if (isset($_POST['valuta'])) mysql_unbuffered_query(sprintf($sql,'valuta',$_POST['valuta']));  
  if (isset($_POST['pdil'])) mysql_unbuffered_query(sprintf($sql,'pdil',$_POST['pdil']));
  if (isset($_POST['plo_od'])) mysql_unbuffered_query(sprintf($sql,'plo_od',$_POST['plo_od']));
  
  if (isset($_POST['rTipC'])) mysql_unbuffered_query(sprintf($sql,'rTipC',ToString($_POST['rTipC'],9)));
  if (isset($_POST['dil_komm'])) mysql_unbuffered_query(sprintf($sql,'dil_komm',ToString($_POST['dil_komm'],12)));
  if (isset($_POST['dil_indil'])) mysql_unbuffered_query(sprintf($sql,'dil_indil',ToString($_POST['dil_indil'],15)));
  if (isset($_POST['dil_pos'])) mysql_unbuffered_query(sprintf($sql,'dil_pos',ToString($_POST['dil_pos'],4)));
  if (isset($_POST['dil_add'])) mysql_unbuffered_query(sprintf($sql,'dil_add',ToString($_POST['dil_add'],8)));
//
  
  if (isset($_POST['dist1']))  mysql_unbuffered_query(sprintf($sql,'dist1',$_POST['dist1']));
  if (isset($_POST['dist2']))  mysql_unbuffered_query(sprintf($sql,'dist2',$_POST['dist2']));
  if (isset($_POST['dist3']))  mysql_unbuffered_query(sprintf($sql,'dist3',$_POST['dist3']));
  if (isset($_POST['dist4']))  mysql_unbuffered_query(sprintf($sql,'dist4',$_POST['dist4']));

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
	//header("Location:../admin.php?panel=dil&result=1");
if (isset($_POST['f_nomer'])) $f_params="&nomer=".$_POST['f_nomer'];
if (isset($_POST['f_agent'])) $f_params.="&agent=".$_POST['f_agent'];
if (isset($_POST['f_obl'])) $f_params.="&obl=".$_POST['f_obl'];
if (isset($_POST['f_rgn'])) $f_params.="&rgn=".$_POST['f_rgn'];
if (isset($_POST['f_mista'])) $f_params.="&mista=".$_POST['f_mista'];


	header("Location:../admin.php?panel=dil&result=1".$f_params);
?>
