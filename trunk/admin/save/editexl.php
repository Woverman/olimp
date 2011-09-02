<?php
header("Content-type: text/html; charset=utf-8");
session_start();

  require_once('../../inc/functions.php');
  include ('../../classes.php');
?>
<meta http-equiv="Content-Language" content="ru">
<META HTTP-EQUIV="Content-Type" content="text/html; charset=utf-8">
<?php
echo "<script type=\"text/javascript\">";
if (isset($_POST['mode'])) {
	$act='error';
  $id=$_POST['uid'];
 	$mode=$_POST['mode'];
// save values to database
	switch ($mode) {
		case 'edit':	//'Update exist'
			@mysql_unbuffered_query("Update m_exl set comment='".$_POST['comment']."' where id=".$id);
      @mysql_unbuffered_query("Update m_exl set adresa='".$_POST['adresa']."' where id=".$id);
      @mysql_unbuffered_query("Update m_exl set viddil='".$_POST['viddil']."' where id=".$id);
      @mysql_unbuffered_query("Update m_exl set rieltor='".$_POST['rieltor']."' where id=".$id);
      $t=split('\.',$_POST['dstart']);
      $t1=$t[2].'-'.$t[1].'-'.$t[0];
      mysql_unbuffered_query("Update m_exl set dstart='".$t1."' where id=".$id);
      $t=split('\.',$_POST['dend']);
      $t1=$t[2].'-'.$t[1].'-'.$t[0];
      mysql_unbuffered_query("Update m_exl set dend='".$t1."' where id=".$id);
			if (mysql_errno()==0) $act='update';
			break;
		case 'add':		//'Create new'
      $t=split('\.',$_POST['dstart']);
      $t1=$t[2].'-'.$t[1].'-'.$t[0];
      $t=split('\.',$_POST['dend']);
      $t2=$t[2].'-'.$t[1].'-'.$t[0];
			@mysql_unbuffered_query("Insert into m_exl (rieltor,viddil,adresa,dstart,dend,comment) values ('".$_POST['rieltor']."','".$_POST['viddil']."','".$_POST['adresa']."','".$t1."','".$t2."','".$_POST['comment']."')");
			if (mysql_errno()==0) $act='reload';
			break;
		case 'del':		// 'Delete exist'
			@mysql_unbuffered_query("update m_exl set deleted=IF(deleted=0,1,0) where id=".$_REQUEST['uid']);
			if (mysql_errno()==0) $act='reload';
			break;
	}
// end of save values to database or delete
	switch ($act) {
		case 'reload':
			echo("window.parent.location.reload();");
			break;
		case 'update':
			echo("window.parent.SetStatus('<font color=green>Зміни внесено.</font>');");
      $b=array(1=>'Фрунзе',2=>'Київська',3=>'Вишенька',4=>'Центральне');
      $res=mysql_query("select e.id,e.adresa,u.name,e.viddil,date_format(e.dstart,'%d.%m.%Y'),date_format(e.dend,'%d.%m.%Y'),e.comment,TO_DAYS(e.dend)-TO_DAYS(CURRENT_DATE) as rizn,e.deleted from m_exl e LEFT JOIN d_users u ON e.rieltor=u.id where e.id=".$_POST['uid']);
      $row=mysql_fetch_row($res);
      $aa=$row[7];
      $color="<font color=green>";$col="</font>";
      if ($aa<7) $color="<font color=#FF9900>";
      if ($aa<1) $color="<font color=red>";
      $del=$row[8];
      if ($del) $color="<font color=#A7A7A7>";
      $data=$color.$row[1].$col.'{'.$color.$row[2].$col.'{'.$color.$b[$row[3]].$col.'{'.$color.$row[4].$col.'{'.$color.$row[5].$col.'{'.$color.$row[6].$col;
			echo("window.parent.updaterow('".$row[0]."','".$data."');");
			break;
		case 'error':
      //echo("alert('id=".mysql_error()."');");
			echo("window.parent.SetStatus('<font color=red>Помилка. Зміни не внесено!</font>');");
			echo("alert('Помилка. Зміни не внесено!');");
			break;
	}
} 
echo("</script>");
?>

