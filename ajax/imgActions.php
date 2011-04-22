<?
header("Content-type: text/html; charset=utf-8");
$dirname = $_REQUEST['folder'];
$MAXDIR = "i/".$dirname."/";
$MINDIR = "i/".$dirname."-p/";

include ('../classes.php'); // classes, config and functions

$sql = "SELECT orderid FROM img_info WHERE file = '".$_REQUEST['file']."'";
$id = mysql_result(mysql_query($sql),0,0);

switch($_REQUEST['action'])
  {
    case 'imageleft':
      $sql = "UPDATE img_info SET orderid = ".($id)." WHERE orderid=".($id-1)." and file like '%".$MINDIR."%'";
      $DB->insert($sql);
      $sql = "UPDATE img_info SET orderid = ".($id-1)." WHERE file = '".$_REQUEST['file']."'";
      $DB->insert($sql);
      break;
    case 'imageright':
      $sql = "UPDATE img_info SET orderid = ".($id)." WHERE orderid=".($id+1)." and file like '%".$MINDIR."%'";
      $DB->insert($sql);
      $sql = "UPDATE img_info SET orderid = ".($id+1)." WHERE file = '".$_REQUEST['file']."'";
      $DB->insert($sql);
      break;
    case 'imagedel':
      $f = basename($_REQUEST['file']);
      $fname=DOCUMENT_ROOT.$MAXDIR.$f;
      @unlink ($fname);
      $fname=DOCUMENT_ROOT.$MINDIR.$f;
      @unlink ($fname);
      $sql = "DELETE FROM `img_info` WHERE `file` = '".$fname."'";
      $DB->insert($sql);
      $sql = "UPDATE `img_info` SET orderid = @i:=@i+1 WHERE file like '%".$MINDIR."%' ORDER BY orderid;";
      $DB->insert($sql);
      break;
    case 'edittitle':
      $text = urldecode($_REQUEST['text']);
      //$f = basename($_REQUEST['file']);
      //$fname=$MINDIR.$f;
      $sql = "UPDATE `img_info` SET comment = '".$text."' WHERE `file` = '".$_REQUEST['file']."'";
	  //echo ($sql);
      $DB->insert($sql);
      break;
	case 'addfolder':
	  $folder = urldecode($_REQUEST['name']);
	  $title  = urldecode($_REQUEST['title']);
	  $path = $_SERVER['DOCUMENT_ROOT']."/i/".$folder;
	  if (mkdir($path,0777)){
		mkdir($path."-p",0777);
	  	$sql = "INSERT INTO img_folders (folder,title) values('".$folder."','".$title."')";
		$DB->insert($sql);
	  }
	  break;
  }
  ?>