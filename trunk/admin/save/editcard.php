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
  	$id=$_REQUEST['cardid'];
 	$mode=$_POST['mode'];
	$t=split('\.',$_POST['raisedate']);
	$raisedate=$t[2].'-'.$t[1].'-'.$t[0];
// save values to database
	switch ($mode) {
		case 'edit':	//'Update exist'
			@mysql_unbuffered_query("Update m_cards set number='".$_POST['cardnum']."' where id=".$id);
			@mysql_unbuffered_query("Update m_cards set client='".$_POST['client']."' where id=".$id);
			@mysql_unbuffered_query("Update m_cards set contractnum='".$_POST['contractnum']."' where id=".$id);
			@mysql_unbuffered_query("Update m_cards set viddil='".$_POST['viddil']."' where id=".$id);
			@mysql_unbuffered_query("Update m_cards set rieltor='".$_POST['rieltor']."' where id=".$id);
			@mysql_unbuffered_query("Update m_cards set comment='".$_POST['comment']."' where id=".$id);
			@mysql_unbuffered_query("Update m_cards set raisedate='".$raisedate."' where id=".$id);
			if (mysql_errno()==0) $act='update';
			break;
		case 'add':		//'Create new'
			@mysql_unbuffered_query("Insert into m_cards (number,client,contractnum,raisedate,rieltor,viddil,comment,deleted)
			values ('".$_POST['cardnum']."','".$_POST['client']."','".$_POST['contractnum']."','".$raisedate."','".$_POST['rieltor']."','".$_POST['viddil']."','".$_POST['comment']."',0)");
			if (mysql_errno()==0) $act='reload';
			break;
		case 'del':		// 'Delete exist'
			@mysql_unbuffered_query("update m_cards set deleted=IF(deleted=0,1,0) where id=".$id);
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
			$sql="select e.id as id,e.number,e.client,date_format(e.raisedate,'%d.%m.%Y'),e.contractnum,u.name,e.rieltor,e.viddil,e.deleted from m_cards e LEFT JOIN d_users u ON e.rieltor=u.id".$a."where e.id=$id;";
	    	$res=mysql_query($sql);
		    $row=mysql_fetch_row($res);
		    $color="<font color=green>";$col="</font>";
		    $del=$row[8];
		    if ($del) $color="<font color=#A7A7A7>";
		    $data=$color.$row[1].$col.'{'.$color.$row[2].$col.'{'.$color.$b[$row[3]].$col.'{'.$color.$row[4].$col.'{'.$color.$row[5].$col.'{'.$color.$row[6].$col;
			echo("window.parent.updaterow('".$row[0]."','".$data."');");
			break;
		case 'error':
			echo("window.parent.SetStatus('<font color=red>Помилка. Зміни не внесено!</font>');");
			echo("alert('Помилка. Зміни не внесено!');");
			break;
	}
} 
echo("</script>");
?>

