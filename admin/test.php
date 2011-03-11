<html>
<head>
<title>Выбор каталога</title>
</head>
<body>
<?php
echo '<table border=1>';
echo develop(".",0);
echo("</table>");

function develop($directory,$i){
  $dir=opendir($directory);
  while ($d=readdir($dir))
  {
    $next=realpath($directory."/".$d);
    if (is_dir($next) && ($d!="..") && ($d!=".") && ($d!="")) {
        $i++;
        $ret .= "<tr><td>";
        $down = develop($next,$i);
        if ($down)
          {
            $ret .= '<img src="plus.gif" width="9" height="9" alt="" style="padding-right:-16px;"/>';
            for ($q=0; $q<=$i-1; $q++) $ret .= "&nbsp;&nbsp;";
          }
          else
          {
            for ($q=0; $q<=$i; $q++) $ret .= "&nbsp;&nbsp;";
          }
        $ret .= $d;
        $ret .= "</td></tr>";
        $ret .= $down;
        $i--;
    }
  }
  closedir($dir);
  return $ret;
}

?>
</body>
</html>