<?
global $config;
header("Content-type: text/html; charset=windows-1251");
require_once('../../../inc/functions.php');
include ('../../../inc/config.php');
include ('../../../inc/pre.php');

  $id  = $_GET['id'];
  $sql = "DELETE FROM `m_bildings` WHERE `id`=".$id;
  mysql_unbuffered_query($sql);
  $dir = $config['SIGHT_ROOT'].'/i/boguna/'.$id;
  delTree($dir.'/min/',"*.*");
  delTree($dir.'/max/',"*.*");
  rmdir($dir);
  echo "<script type=\"text/javascript\">";
  echo "alert('sql=$sql');";
  echo "window.parent.location.reload();";
  echo "</script>";

?>