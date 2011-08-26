<?php
  session_start();

  global $config;
  require_once('../../inc/functions.php');
  include ('../../inc/config.php');

  $tmpfile=$_FILES['foto']['tmp_name'];
  $tmpfilename = $_FILES['foto']['name'];
  // Build names for large and small images
  $newname=$config['SIGHT_ROOT'].$_POST['max_folder'].$tmpfilename;
  $thumbnail=$config['SIGHT_ROOT'].$_POST['min_folder'].$tmpfilename;
  // Get image dimensions
  $img1=ResizeImage($tmpfile,$_POST['max_width'],$_POST['max_height'],$tmpfilename);
  $img2=ResizeImage($tmpfile,$_POST['min_width'],$_POST['min_height'],$tmpfilename);
  // Write to folders
  if ($handle = fopen($newname, 'w')) { fwrite($handle, $img1); }
  if ($handle = fopen($thumbnail, 'w')) { fwrite($handle, $img2); }
  // Output callback
  echo "<script type=\"text/javascript\">\n";
  $callback = $_POST['callback'].'("'.$tmpfilename.'")';
  echo("window.parent.".$callback.";\n");
  echo "</script>";
?>