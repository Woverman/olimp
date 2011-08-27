<?
header("Content-type: text/html; charset=utf-8");
$id = $_REQUEST['id'];

include ('../classes.php'); // classes, config and functions

$sql = "SELECT orderid FROM s_widjets WHERE id = '".$id."'";
$orderid = mysql_result(mysql_query($sql),0,0);
$maxorderid = mysql_result(mysql_query("SELECT MAX( orderid ) FROM  `s_widjets`"),0,0);
$minorderid = mysql_result(mysql_query("SELECT MIN( orderid ) FROM  `s_widjets`"),0,0);


switch($_REQUEST['action'])
  {
    case 'up':
	  if ($orderid>$minorderid){
	      $sql = "UPDATE s_widjets SET orderid = ".($orderid)." WHERE orderid=".($orderid-1);
	      $DB->insert($sql);
	      $sql = "UPDATE s_widjets SET orderid = ".($orderid-1)." WHERE id = '".$id."'";
	      $DB->insert($sql);
		  echo('ok');
	  }
      break;
    case 'down':
	  if ($orderid<$maxorderid){
		  $sql = "UPDATE s_widjets SET orderid = ".($orderid)." WHERE orderid=".($orderid+1);
	      $DB->insert($sql);
	      $sql = "UPDATE s_widjets SET orderid = ".($orderid+1)." WHERE id = '".$id."'";
	      $DB->insert($sql);
		  echo('ok');
	  }
      break;
    case 'hide':
	  $sql = "UPDATE s_widjets SET enabled = 0 WHERE id = $id";
      $DB->insert($sql);
	  echo('ok');
	  break;
    case 'show':
      $sql = "UPDATE s_widjets SET enabled = 1 WHERE id = '".$id."'";
      $DB->insert($sql);
	  echo('ok');
	  break;
	case 'unshift':
	  $sql = "UPDATE s_widjets SET newline = 0 WHERE id = '".$id."'";
      $DB->insert($sql);
	  echo('ok');
	  break;
  	case 'shift':
	  $sql = "UPDATE s_widjets SET newline = 1 WHERE id = '".$id."'";
      $DB->insert($sql);
	  echo('ok');
	  break;
  }
  ?>