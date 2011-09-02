<?php



global $config;

require_once('../../inc/functions.php');

include ('../../inc/config.php');

include ('../../inc/pre.php');



if (isset($_POST['type']) && $_POST['type']=='kva')

{

  (empty($_POST['editid'])) ? $id=newid() : $id=$_POST['editid'];

  $sql='Update m_bildings set %s = \'%s\' where id='.$id;

  mysql_unbuffered_query(sprintf($sql,'type',$_POST['type']));

  if (isset($_POST['prodazh'])) mysql_unbuffered_query(sprintf($sql,'prodazh',$_POST['prodazh']));

  if (isset($_POST['num'])) mysql_unbuffered_query(sprintf($sql,'num',$_POST['num']));

  if (isset($_POST['adr_obl'])) mysql_unbuffered_query(sprintf($sql,'adr_obl',$_POST['adr_obl']));

  if (isset($_POST['adr_rgn'])) mysql_unbuffered_query(sprintf($sql,'adr_rgn',$_POST['adr_rgn']));

  if (isset($_POST['adr_mista'])) mysql_unbuffered_query(sprintf($sql,'adr_gor',$_POST['adr_mista']));

  if (isset($_POST['adr_vul'])) {

    mysql_unbuffered_query(sprintf($sql,'adr_vul',$_POST['adr_vul']));

    check_vul($_POST['adr_vul'],$_POST['adr_mista']);

    }

  if (isset($_POST['typekva'])) mysql_unbuffered_query(sprintf($sql,'kva_type',$_POST['typekva']));

  if (isset($_POST['kk'])) mysql_unbuffered_query(sprintf($sql,'kk',$_POST['kk']));

  if (isset($_POST['stan'])) mysql_unbuffered_query(sprintf($sql,'kva_stan',$_POST['stan']));

  if (isset($_POST['TmSdch'])) mysql_unbuffered_query(sprintf($sql,'kva_zdan',$_POST['TmSdch']));

  if (isset($_POST['pov'])) mysql_unbuffered_query(sprintf($sql,'pov',$_POST['pov']));

  if (isset($_POST['povv'])) mysql_unbuffered_query(sprintf($sql,'povv',$_POST['povv']));

  if (isset($_POST['pzag'])) mysql_unbuffered_query(sprintf($sql,'pzag',$_POST['pzag']));

  if (isset($_POST['pzit'])) mysql_unbuffered_query(sprintf($sql,'pzit',$_POST['pzit']));

  if (isset($_POST['pkuh'])) mysql_unbuffered_query(sprintf($sql,'pkuh',$_POST['pkuh']));

  if (isset($_POST['stelya'])) mysql_unbuffered_query(sprintf($sql,'stelya',$_POST['stelya']));

  if (isset($_POST['SanUzli'])) mysql_unbuffered_query(sprintf($sql,'sanuzel',$_POST['SanUzli']));

  if (isset($_POST['Lodzh'])) mysql_unbuffered_query(sprintf($sql,'lodg',$_POST['Lodzh']));

  if (isset($_POST['lZstk'])) mysql_unbuffered_query(sprintf($sql,'lodg_z',$_POST['lZstk']));

  if (isset($_POST['Balk'])) mysql_unbuffered_query(sprintf($sql,'balkon',$_POST['Balk']));

  if (isset($_POST['bZstk'])) mysql_unbuffered_query(sprintf($sql,'balkon_z',$_POST['bZstk']));

  if (isset($_POST['cast'])) mysql_unbuffered_query(sprintf($sql,'cast',$_POST['cast']));

  if (isset($_POST['casttype'])) mysql_unbuffered_query(sprintf($sql,'casttype',$_POST['casttype']));

  if (isset($_POST['valuta'])) mysql_unbuffered_query(sprintf($sql,'valuta',$_POST['valuta']));

  if (isset($_POST['agent'])) mysql_unbuffered_query(sprintf($sql,'kont',$_POST['agent']));

  if (isset($_POST['DopVC'])) mysql_unbuffered_query(sprintf($sql,'kva_inkva',ToString($_POST['DopVC'],31)));

  if (isset($_POST['domtype'])) mysql_unbuffered_query(sprintf($sql,'kva_domtype',$_POST['domtype']));

  if (isset($_POST['Stinu'])) mysql_unbuffered_query(sprintf($sql,'kva_stinu',ToString($_POST['Stinu'],6)));

  if (isset($_POST['IsOptC'])) mysql_unbuffered_query(sprintf($sql,'kva_indom',ToString($_POST['IsOptC'],13)));

  if (isset($_POST['comment'])) mysql_unbuffered_query(sprintf($sql,'comment',addslashes($_POST['comment'])));

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
if (isset($_POST['f_dist'])) $f_params.="&dist=".$_POST['f_dist'];


	header("Location:../admin.php?panel=kva&result=1".$f_params);

?>

