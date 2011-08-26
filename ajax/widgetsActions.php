<?
header("Content-type: text/html; charset=utf-8");
$id = $_REQUEST['id'];

include ('../classes.php'); // classes, config and functions

$sql = "SELECT orderid FROM img_info WHERE file = '".$_REQUEST['file']."'";
$orderid = mysql_result(mysql_query($sql),0,0);

switch($_REQUEST['action'])
  {
    case 'up':
      $sql = "UPDATE s_widjets SET orderid = ".($orderid)." WHERE orderid=".($orderid-1);
      $DB->insert($sql);
      $sql = "UPDATE s_widjets SET orderid = ".($orderid-1)." WHERE id = '".$id."'";
      $DB->insert($sql);
      break;
    case 'down':
      $sql = "UPDATE s_widjets SET orderid = ".($orderid)." WHERE orderid=".($orderid+1);
      $DB->insert($sql);
      $sql = "UPDATE s_widjets SET orderid = ".($orderid+1)." WHERE id = '".$id."'";
      $DB->insert($sql);
      break;
    case 'hide':
	  $sql = "UPDATE s_widjets SET enabled = 0 WHERE id = '".$id."'";
      $DB->insert($sql);
	  break;
    case 'show':
      $sql = "UPDATE s_widjets SET enabled = 1 WHERE id = '".$id."'";
      $DB->insert($sql);
	  break;
	case 'shift':
	  $sql = "UPDATE s_widjets SET newline = 1 WHERE id = '".$id."'";
      $DB->insert($sql);
	  break;
	case 'unshift':
	  $sql = "UPDATE s_widjets SET newline = 0 WHERE id = '".$id."'";
      $DB->insert($sql);
	  break;
  }
  ?>