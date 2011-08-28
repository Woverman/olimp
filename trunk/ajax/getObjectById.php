<?php
header("Content-type: text/html; charset=windows-1251");
require_once('../inc/functions.php');
include ('../classes.php');
if ($_GET['id']>0)
{
  $id = $_GET['id'];
  $sql = 'SELECT id, cast, pov, pzag, pzit, pkuh, num, kk, kont, comment, valuta, casttype, prodano from m_bildings where id = '.$id;
  $res = $DB->request($sql,ARRAY_N);
  echo(implode("{",$res[0]));
  $dir=DOCUMENT_ROOT.'/i/obj/'.$res[0][0].'/min/';
  if (is_dir($dir))
  {
	  foreach (glob("$dir/*.*") as $filename) {
	    $fname[] = basename($filename);
	  }
	  if (is_array($fname))
	  {
	    echo '{';
	    echo implode(",",$fname);
	  }
  }
}
else
{
  // select previous inserted and not saved rows
  $sql = "SELECT id FROM m_bildings WHERE `adr_vul` = 'insertforproject'";
  $res = mysql_query($sql);
  while ($row=mysql_fetch_row($res))
    {
      $dir = $config['SIGHT_ROOT'].'/i/obj/'.$row[0];
      @delTree($dir.'/min/',"*.*");
      @delTree($dir.'/max/',"*.*");
      @rmdir($dir);
    }
  mysql_unbuffered_query("DELETE FROM m_bildings WHERE `adr_vul` = 'insertforproject'");
  mysql_unbuffered_query("INSERT INTO m_bildings (`adr_vul`) values ('insertforproject')");
  $newid = mysql_insert_id();
  $dir=DOCUMENT_ROOT.'/i/obj/'.$newid;
  mkdir($dir);
  chmod($dir,0777);
  mkdir($dir.'/min/');
  chmod($dir.'/min/',0777);
  mkdir($dir.'/max/');
  chmod($dir.'/max/',0777);
  echo $newid;
}
?>