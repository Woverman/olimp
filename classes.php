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


function debug($var){ 
    echo('<div style="border:2px solid #BFBFBF;overflow:auto;position:relative;bottom:0;height:100px;width:100%;background-color:#E9E9E9;color:#222;white-space:pre;">');
    print_r($var);
    echo('</div>');
} //фыв
?>