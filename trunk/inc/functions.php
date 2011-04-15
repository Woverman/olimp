<?php
// розпаковка змінних при register_globals=Off
function my_extract($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $is_magic_quotes = get_magic_quotes_gpc();
    foreach ($array AS $key => $value) {
        if (is_array($value)) {
            unset($$key);
            my_extract($value);
        } else if ($is_magic_quotes) {
            $GLOBALS[$key] = stripslashes($value);
        } else {
            $GLOBALS[$key] = $value;
        }
    }
    return TRUE;
}

function getaslist ($tbl,&$selid,$usl='1=1') {
	global $sys;
	$sql = sprintf('SELECT * from %s where %s order by name',$tbl,$usl);
	$res=mysql_query($sql);
	while ($row=mysql_fetch_array($res)) {
        $T='';
		if (isset($selid)) {
			if ($row['id']==$selid) $T=' selected="selected"';
		} else {
			if ($row['def']=='1') $T=' selected="selected"';
		}
        if ($T==' selected') $selid=$row['id'];
		echo '<option value='.$row['id'].$T.'>'.$row['name']."</option>\n";
	}
}

function GetNews($limit,$pattern,$add=0) {
  $sql="select id,title,short,date_format(date,\"%d.%m.%Y %H:%e\")as dt from news where enable=1 order by date limit ".$limit;
  $res = mysql_query ($sql) or die("Query failed : " . mysql_error());
  $ret='';
  while ($row=mysql_fetch_array($res)) {
	  $id=$row['id'];
    $ret.=sprintf($pattern,
            html_entity_decode($row['title']),
            'javascript:LoadTab(\'newslong\',\'&id='.$id.'\');scroll(0,0); SetTopMenu(3);',
            html_entity_decode($row['short']),
            $row['dt']
        );
  }
  if ($add==1){
  $newlimit=$limit-mysql_num_rows($res);
  if ($newlimit>0){
    $sql='Select *,DATE_FORMAT(pubDate,"%d.%m.%Y %H:%i") as dtt from rss_cashe order by pubDate desc limit '.$newlimit;
    $res = mysql_query ($sql);
    while ($row=mysql_fetch_assoc($res)) {
      $ret.=sprintf($pattern,
      html_entity_decode($row['title']),
      html_entity_decode($row['link']).'" target="_blank',
      html_entity_decode($row['description']),
      $row['dtt'],html_entity_decode($row['source']));
    }
  }}
  return $ret;
}

function IsAdmin() {
	if (isset($_SESSION['user'])) {
	$sql="Select rights from d_users where login='".$_SESSION['user']."'";
	$res = mysql_query($sql);
	$row=mysql_fetch_array($res);
	return($row[0]=='0');
	}
}

function GetFieldByID($tbl,$fld,$id,$notfound='Не знайдено'){
  $res=mysql_query("Select $fld from $tbl where id=$id;");
  if (mysql_num_rows($res)>0) {
    return mysql_result($res,0);
  } else {
    return $notfound;
  }
}

function MakePageLinks($page,$pages,$items,$ff) {
	$p1=1;$p2=$pages;
    if (($p2-$p1)>10){
        if ($page<=5) {
            $p2=10;
        } else {
            $p1=$page-5;
            $p2=$p1+9;
            if ($p2>$pages) {
                $p2=$pages;
                $p1=$p2-9;
            }
        }
    }
	echo '<table class="pagesdiv"><tr><td class="founded">Всього знайдено: '.$items.'</td>';
	echo '<td class="pagenums">';
	if ($pages>1){
	    if ($page>1) {
	      echo '<a href="'.$ff->createURL("pg",$page-1).'">&lt; Назад</a>&nbsp;';
	    } else {
	      echo '<span>&lt; Назад</span>&nbsp;';
	    }
	    if ($p1>1) {
	  	  echo '<a class="pages" href="'.$ff->createURL("pg",1).'">1</a>&nbsp;... ';
	      $p1+=2;
		  }
	    $after='';
	  	if ($p2<$pages) {
	  	  $p2=$p2-2;
	      $after = '... <a href="'.$ff->createURL("pg",$pages).'">'.$pages.'</a>&nbsp;';
	  	}
	    for ($i=$p1;$i<=$p2;$i++) {
	  		if ($i==$page) {
	  			echo "<span class='selpage'>$i</span>&nbsp;";
	  		} else {
	  			echo '<a href="'.$ff->createURL("pg",$i).'">'.$i.'</a>&nbsp;';
	  		}
	  	}
	    echo $after;

	    if ($page<$pages){
	        echo '<a href="'.$ff->createURL("pg",$page+1).'">Вперед &gt;</a>&nbsp;';
	    } else {
	        echo '<span>Вперед &gt;</span>&nbsp;';
	    }
	}
//
//    if ($page=='all')
//      echo "<span class='selpage'>Всі</span>";
//    else
//      echo '<a href="'.$ff->createURL("pg",'all').'">Всі</a>';
//
  	echo '</td></tr></table>';
}

 /* ResizeImage with (height % width) */
function ResizeImage( $image, $newWidth, $newHeight){
	eregi("\..{3,4}$",$image,$regs);
	switch($regs[0]){
		case ".gif": $srcImage = ImageCreateFromGIF( $image ); break;
		case ".png": $srcImage = ImageCreateFromPNG( $image ); break;
		case ".jpeg":
		case ".jpg":
		default: $srcImage = ImageCreateFromJPEG( $image ); break;
	}
	$srcWidth = ImageSX( $srcImage );
	$srcHeight = ImageSY( $srcImage );
	$ratio = $srcWidth/$srcHeight;
	if( $srcWidth > $srcHeight){
		$destWidth = $newWidth;
		$destHeight = $destWidth/$ratio;
	}else{
	  $destHeight = $newHeight;
		$destWidth = $destHeight*$ratio;
	}
	$destImage = imagecreatetruecolor( $destWidth, $destHeight);
	if(function_exists('imagecopyresampled')) {
	imagecopyresampled( $destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight );
	} else {
	ImageCopyResized( $destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight );
	}
	ob_start();
    imagejpeg( $destImage );
	$resizedImage = ob_get_contents();
	ob_end_clean();
	ImageDestroy($srcImage);
	ImageDestroy($destImage);
 	return $resizedImage;
}

function newid(){
	// отримуємо новий ідентифікатор для запису об'єкта в базу
	mysql_unbuffered_query('insert into m_bildings (comment) values (\'qwertyuiol0123456789qwertyuiop\');');
	$id=mysql_insert_id();
	mysql_unbuffered_query('update m_bildings set comment=\'\' where id='.$id);
	return $id;
}

function ToString($arr,$cnt){
	// об'єднуємо масив в стрічку (передаємо сам масив і довжину стрічки)
  // все це наворочено для того, щоб зберегти порядкові номери елементів
	$a = array_fill(0, $cnt, 0);
	$b = $arr + $a;
	ksort($b);
	$result = implode('',$b);
	return substr($result,0,$cnt);
	// обратное действие см. preg_split
}

function saveImgToBase($id) {
	// записуємо фотки в базу
	$num=0;
	while($a = each($_FILES)) {
		$iname=$a[1]['tmp_name'];
    $fname=$a[1]['name'];
		$num++;
		if ($iname!='') {
			//$img=addslashes(ResizeImage($iname,300,200));
      $img=addslashes(ResizeImage($iname,800,600));
			$thumb=addslashes(ResizeImage($iname,100,70));
      $sql="select count(id) from m_fotos where objid=$id and orderval=$num";
      $res=mysql_query($sql);
      if (mysql_result($res,0)==0) $sql="insert into m_fotos (objid,foto,tumb,orderval,fname) values ('$id','$img','$thumb','$num','$fname')";
      else $sql="update m_fotos set foto='$img',tumb='$thumb',fname='$fname' where objid='$id' and orderval='$num'";
			mysql_query($sql);
		}
	}
}
function saveImgToFile($id) {
	// записуємо фотки в файли
	$num=0;
	while($a = each($_FILES)) {
		$iname=$a[1]['tmp_name'];
    $fname=$a[1]['name'];
		$num++;
		if ($iname!='') {
      $img=ResizeImage($iname,1024,768);
			$thumb=ResizeImage($iname,100,70);
      $resultFileName = DOCUMENT_ROOT."/i/obj/img_".$id."_".$num.".jpg";
      $resultThumbName = DOCUMENT_ROOT."/i/obj/tmb_".$id."_".$num.".jpg";
      //imagejpeg($img,$resultFileName);
      //imagejpeg($thumb,$resultThumbName);
      // Save file
      $fp = fopen ($resultFileName,'w');
      fwrite ($fp, $img);
      fclose ($fp);
      chmod($resultFileName, 0777);
      $fp = fopen ($resultThumbName,'w');
      fwrite ($fp, $thumb);
      fclose ($fp);
      chmod($resultThumbName, 0777);
		}
	}
}

function findadr($id,$tbl) { // пошук областей, районів, міст тощо
    $sql = "Select name from $tbl where id=$id";
    $res = mysql_query($sql);
    return @mysql_result($res,0);
}

function MakeList($arr,$str) { //будуємо список параметрів по стрічці одиниць і нулів
  if (intval($str)==0) {return 'нема даних';}
  else {
  $ret='';
  $tmp=preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
  for ($i=0; $i<=strlen($str)-1; $i++)  {
    if ($tmp[$i]==1) $ret[]=$arr[$i];
  }
  return implode(', ',$ret);
}}

function get_table_info($tbl, $where="1=1"){
	$sql = sprintf('SELECT * from %s where %s order by name',$tbl,$where);
	$res=mysql_query($sql);
  if (mysql_num_rows($res)>0){
	  while ($row=mysql_fetch_row($res)) $info[$row[0]] = $row[1];
    return $info; }
  else return '';
}

function get_bild($id){
	global $sys;
	$sql="Select * from m_bildings where id=$id;";
	$res=mysql_query($sql);
	if (mysql_errno()==0 and mysql_num_rows($res)>0) {
    $row=mysql_fetch_assoc($res);
    $row['comment']=stripslashes($row['comment']);
  	return $row;
  } else {
    return array('');
  }
}

function delfoto($num,$id){
  //delete image from datebase
  //$id - `objid`;$num - `orderval`
  mysql_unbuffered_query("delete from m_fotos where `objid`='".$id."' and `orderval`='".$num."'");
  mysql_unbuffered_query("update m_fotos set `orderval`=`orderval`-1 where `objid`='".$id."' and `orderval`>'".$num."'");

  //delete image from folder
  $fname = '/home/hosting/windb/olimp/i/obj/tmb_'.$id.'_'.$num.'.jpg';
  if(is_file($fname)) unlink($fname);
  $fname = '/home/hosting/windb/olimp/i/obj/img_'.$id.'_'.$num.'.jpg';
  if(is_file($fname)) unlink($fname);

}

function maketabs($arrName,$arrLink,$sel){
  // create a tabled links from arrays of names and links //

  $cntt=count($arrName);
  for ($i=0;$i<$cntt;$i++){
    if ($i==$sel) $class=' class="sel"'; else $class='';
    $backarr[$i]="<a href=".$arrLink[$i].$class."> ".$arrName[$i]." </a>";
  }
  $ret = '<div class="tabs2">'.implode("\n",$backarr).'</div>';
  return $ret;
}

function findexl(){
  $sql="Select count(id) from m_exl where deleted=0 and (TO_DAYS(dend)-TO_DAYS(CURRENT_DATE))<1;";
  $res=mysql_query($sql);
  if (mysql_errno()==0 and mysql_num_rows($res)>0) {
  $cnt=mysql_result($res,0);
  if ($cnt>0) {
      return '<img src="/i/ahtung.gif" border=0 alt="'.$cnt.'" align=left title="Увага! Прострочені ексклюзиви! ('.$cnt.')">';
    } else {
      return '';
    }
  } else {
    return '';
  }
}

function findmsg(){
  $sql="Select count(id) from m_messages where deleted=0;";
  $res=mysql_query($sql);
  if (mysql_errno()==0 and mysql_num_rows($res)>0) {
  $cnt=mysql_result($res,0);
  if ($cnt>0) {
      return '<img src="/i/ahtung.gif" alt="'.$cnt.'" align=left title="Увага! Є замовлення! ('.$cnt.')" border=0>';
    } else {
      return '';
    }
  } else {
    return '';
  }
}

function check_vul($vulname,$parrent){
  $sql="Select count(*) from d_vul where name='".$vulname."';";
  $res=mysql_query($sql);
  if (mysql_errno()==0 and mysql_num_rows($res)>0) {
    $cnt=mysql_result($res,0);
    if ($cnt==0) {
      mysql_unbuffered_query("insert into d_vul(name,parent) values ('".$vulname."','".$parrent."')");
    }
  }
}

function infodiv($text){
  echo "<div id='infodiv' style='color:#707070;border:1px solid silver;padding:2px 2px 2px 10px;margin-bottom:4px'>";
  echo "<img align=right border=0 onClick=\"document.getElementById('infodiv').style.display='none';document.getElementById('noinfo').value=1;\" src='i/_del.gif'>";
  echo "&nbsp;&nbsp;&nbsp;&nbsp;".$text;
  echo "</div>";
  }

function CurrentUserID(){
   $ret=-1;
   $sql="Select id from d_users where login='".$_SESSION['user'];
   $res=mysql_query($sql);
   if (mysql_errno()==0 and mysql_num_rows($res)>0) {
     $ret=mysql_result($res,0);
   }
   return $ret;
}

// ensure $dir ends with a slash
function delTree($dir,$pattern) {
  if (is_dir($dir))
  {
    $files = glob( $dir . $pattern, GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
            delTree( $file );
        else
            unlink( $file );
    }
    rmdir( $dir );
  }
}
?>
