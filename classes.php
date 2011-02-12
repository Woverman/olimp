<?
include("config.php");

     $dir = DOCUMENT_ROOT."/classes";
     $hdl = opendir($dir);

     while($file = readdir($hdl))
     {
         if(substr($file,0,6) == 'Class.')
         {
             $list_files[]=$file;
         }
     }
     closedir($hdl);

     foreach($list_files as $value)
     {
         include("$dir/$value");
     }

$debug = Array();
function debug($var,$title=''){
    global $debug;
    if (DEBUG){
    $title=$title==''?count($debug)+1:$title;
    $debug[] = "<hr><h3>$title</h3>";
    $debug[] = print_r($var,true);
    }
}
?>