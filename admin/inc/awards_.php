<?php
function showDir($dir){
   if($checkDir = opendir($dir)){
     // check all files in $dir, add to array listFile
     while($file = readdir($checkDir)){
         if($file != "." && $file != ".."){
             if(!is_dir($dir . "/" . $file)){
                 $listFile[] = $file;
             }
         }
     }
     closedir($checkDir);
     if (!empty($listFile)) return $listFile;
   }
}

// обработка событий
if (isset($_POST['file_to_del'])){ //удаление фоток
  $fname=$config['SIGHT_ROOT'].'/i/awards/'.$_POST['file_to_del'];
  @unlink ($fname);
  $fname=$config['SIGHT_ROOT'].'/i/awards-p/'.$_POST['file_to_del'];
  @unlink ($fname);
}

if (isset($_POST['mode'])){
  $tmpfile=$_FILES['foto']['tmp_name'];
  $newname=$config['SIGHT_ROOT'].'/i/awards/'.$_FILES['foto']['name'];
  $thumbnail=$config['SIGHT_ROOT'].'/i/awards-p/'.$_FILES['foto']['name'];
  copy($tmpfile,$newname);

  // Get image dimensions
  $img=ResizeImage($tmpfile,86,120);
  if ($handle = fopen($thumbnail, 'w')) {
    if (fwrite($handle, $img) === FALSE) {
       echo "Не можу записати в файл ($thumbnail)";
       }
  } else {
    echo "Не можу відкрити файл ($thumbnail)";
  }
}

echo '<div style="display:block;float:left;margin-bottom:20px;width:100%">';

$dir=$config['SIGHT_ROOT'].'/i/awards-p';
$files=showDir($dir);
if (is_array($files)){
foreach ($files as $file){
  list($width, $height, $type, $attr) = getimagesize($config['SIGHT_ROOT'].'/i/awards/'.$file);
  if ($width>$height) {
    $w=120;
    $h=86;
    }
  else {
    $w=86;
    $h=120;
  }
  ?>
  <div style="display:block;border:1px solid #000;padding:4px;margin:2px;float:left;text-align:center">
  <form method=post>
  <input type="hidden" name="file_to_del" value="<?=$file?>">
  <img class=award_smoll width=<?=$w?> height=<?=$h?> src="/i/awards-p/<?=$file?>" style="margin-bottom:<?=122-$h?>">
  <br>
  <div style="border:1px solid silver;margin: 2px;font-size: x-small;padding-bottom:2px;overflow:hidden;" ><?=$file?></div>
  <input type=submit value="знищити"></form>
  </div>
  <?php
}}
?>
</div>
<div>
<Form method=post enctype='multipart/form-data'>
Добавити зображення.
<input type='hidden' value='add' name='mode' id='mode'>
<input type='file' name='foto' id='foto' class="txt" text="Обзор">
<input type='submit' value='Загрузити'>
</form>
</div>