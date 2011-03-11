<?php
global $config;
require_once('../../../inc/functions.php');
include ('../../../inc/config.php');
include ('../../../inc/pre.php');

if (isset($_POST['type']) && $_POST['type']=='bog')
{
  $id=$_POST['id'];
  $sql='Update m_bildings set %s = \'%s\' where id='.$id;
  mysql_unbuffered_query(sprintf($sql,'type',$_POST['type']));
  mysql_unbuffered_query(sprintf($sql,'adr_vul',''));
  mysql_unbuffered_query(sprintf($sql,'type','bog'));
  if (isset($_POST['num'])) mysql_unbuffered_query(sprintf($sql,'num',$_POST['num']));
  if (isset($_POST['kk'])) mysql_unbuffered_query(sprintf($sql,'kk',$_POST['kk']));
  if (isset($_POST['pov'])) mysql_unbuffered_query(sprintf($sql,'pov',$_POST['pov']));
  if (isset($_POST['pzag'])) mysql_unbuffered_query(sprintf($sql,'pzag',$_POST['pzag']));
  if (isset($_POST['pzit'])) mysql_unbuffered_query(sprintf($sql,'pzit',$_POST['pzit']));
  if (isset($_POST['pkuh'])) mysql_unbuffered_query(sprintf($sql,'pkuh',$_POST['pkuh']));
  if (isset($_POST['cast'])) mysql_unbuffered_query(sprintf($sql,'cast',$_POST['cast']));
  if (isset($_POST['casttype'])) mysql_unbuffered_query(sprintf($sql,'casttype',$_POST['casttype']));
  if (isset($_POST['valuta'])) mysql_unbuffered_query(sprintf($sql,'valuta',$_POST['valuta']));
  if (isset($_POST['kont'])) mysql_unbuffered_query(sprintf($sql,'kont',$_POST['kont']));
  if (isset($_POST['comment'])) mysql_unbuffered_query(sprintf($sql,'comment',addslashes($_POST['comment'])));
  if (isset($_POST['prodazh'])){ mysql_unbuffered_query(sprintf($sql,'prodazh',1)); }
    else { mysql_unbuffered_query(sprintf($sql,'prodazh',0)); }
  echo "<script type=\"text/javascript\">";
  if ($_POST['mode']=='add')
    {
      echo("window.parent.location.reload();");
    }
  else
	  {
	    echo("window.parent.updaterow('".$_POST['id']."','".$_POST['num']."','".$_POST['kk']."','".$_POST['pov']."','".$_POST['pzag']."','".$_POST['pzit']."','".$_POST['pkuh']."','".$_POST['cast']."','".$_POST['prodazh']."');");
    }
  echo("window.parent.SetStatus('<font color=green> вартиру збережено.</font>');");
  echo "</script>";
}



?>

