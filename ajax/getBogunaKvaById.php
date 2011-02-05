<?php
header("Content-type: text/html; charset=windows-1251");
require_once('../inc/functions.php');
include ('../inc/config.php');
include ('../inc/pre.php');
global $sys;
if ($id>0)
{
  $sql = 'SELECT id, cast, pov, pzag, pzit, pkuh, num, kk, kont, comment, valuta, casttype, prodazh from m_bildings where id = '.$id;
  $res=mysql_query($sql);
  $row=mysql_fetch_row($res);
  echo(implode("{",$row));
  $dir=$config['SIGHT_ROOT'].'/i/boguna/'.$row[0].'/min/';
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
  $sql = "SELECT id FROM m_bildings WHERE `adr_vul` = 'insertforboguna'";
  $res = mysql_query($sql);
  while ($row=mysql_fetch_row($res))
    {
      $dir = $config['SIGHT_ROOT'].'/i/boguna/'.$row[0];
      delTree($dir.'/min/',"*.*");
      delTree($dir.'/max/',"*.*");
      rmdir($dir);
    }
  mysql_unbuffered_query("DELETE FROM m_bildings WHERE `adr_vul` = 'insertforboguna'");
  mysql_unbuffered_query("INSERT INTO m_bildings (`adr_vul`) values ('insertforboguna')");
  $newid = mysql_insert_id();
  $dir=$config['SIGHT_ROOT'].'/i/boguna/'.$newid;
  mkdir($dir);
  chmod($dir,0777);
  mkdir($dir.'/min/');
  chmod($dir.'/min/',0777);
  mkdir($dir.'/max/');
  chmod($dir.'/max/',0777);
  echo $newid;
}

?>