<?
if (!isset($showdeleted)) $showdeleted=0;
$luser = $_SESSION['user'];
if (isset($_POST['id'])) {
  $id=$_POST['id'];
  $us=$_POST['agent'];
  if (isset($_POST['viewbtn'])) {
    $sql="Select * from m_messages where id=$id";
    $row=mysql_fetch_array(mysql_query($sql));
?>
  <div style="border:1px dotted green;">
  <form method=post>
  <input type="hidden" name="id" value="<?=$id?>">
  <table border="0" cellpadding="5" cellspacing="2" width="100%">
  <tr><td align="right"><b>Дата</b></td><td style="border:1px solid #999"><?=$row['dt']?></td></tr>
  <tr><td align="right"><b>Клієнт</b></td><td style="border:1px solid #999"><?=$row['cli']?></td></tr>
  <tr><td align="right"><b>Телефон</b></td><td style="border:1px solid #999"><?=$row['phone']?></td></tr>
  <tr><td align="right"><b>Email</b></td><td style="border:1px solid #999"><?=$row['email']?></td></tr>
  <tr><td align="right"><b>к/п</b></td><td style="border:1px solid #999"><? echo $row['buy']==1?"Купує":"-"; ?>/<?  echo $row['sell']==1?"Продає":"-" ?></td></tr>
  <tr><td align="right"><b>Текст повідомлення</b></td><td style="border:1px solid #999"><?=$row['txt']?></td></tr>
  <tr><td align="right"><b>IP клієнта</b></td><td style="border:1px solid #999"><?=$row['ip']?></td></tr>
  <?
  if (IsAdmin($luser)) {
  echo '<tr><td align="right"><b>Відповідальний</b></td><td style="border:1px solid #999">';
  echo '<select name=agent>';
	echo '<option value=0>&nbsp;</option>';
    getaslist('d_users',$row['user']);
  echo '</select><tr><td colspan=2><input type=submit value=Записати>&nbsp;';
  }
  if ($row['deleted']==1){
  echo '<input type=submit value=Відновити name=delbtn></td></tr>';
  } else {
  echo '<input type=submit value=Знищити name=delbtn></td></tr>';
  }
  ?>
  </td></tr>
  <?
  echo '</table></form></div>';
 } else {
  if (isset($_POST['delbtn'])) {
    $sql="Update m_messages set deleted=ABS(deleted-1) where id=$id";
    echo '<font color=green>';
    if ($_POST['delbtn']=='Х') echo 'Знищено';
    else 'Відновлено';
    echo '</font>';
    }
  else {$sql="update m_messages set user=$us where id=$id";echo '<font color=green>Записано</font>';}
  mysql_unbuffered_query($sql);

  }
}
$uid=mysql_result(mysql_query("Select id from d_users where login='".$luser."'"),0);
if (IsAdmin($luser)){
  $sql="Select *,(user>0) as ch from m_messages where deleted=0";
  if ($showdeleted==1) $sql="Select *,(user>0) as ch from m_messages";
} else {
  $sql="Select *,(user>0) as ch from m_messages where deleted=0 and user=".$uid;
}
$sql.=' order by dt desc';
$res=mysql_query($sql);
?>
<form>
<input type="hidden" value="mail" name="panel">
<?php
if (!isset($_GET['showdeleted'])){
?>
<input type="hidden" value="1" name="showdeleted">
<input type="submit" value="Показати знищені">
<? } else {?>
<input type="submit" value="Заховати знищені">
<? } ?>
</form>
<table width=98% class="mytab"><tr bgcolor=silver><th>...</th><th>Дата</th><th>клієнт</th><th>к/п</th><th>ір</th><th title="Відповідальний ріелтор">Ріелтор</th><th>&nbsp;</th></tr><?
$a=1;
while ($row=mysql_fetch_array($res)){
  echo '<form method=post><input type="hidden" name="id" value="'.$row['id'].'"><tr class="row'.($a=abs($a-1)).'">';
  echo '<td><input type=submit value="..." name=viewbtn title="Подробиці"></td>';
  echo '<td>'.$row['dt'].'</td>';
  echo '<td>'.$row['cli'].'</td>';
  echo '<td>'.($row['buy']==1?"Купує":"-").'/'.($row['sell']==1?"Продає":"-").'</td>';
  echo '<td>'.$row['ip'].'</td>';
  echo '<td>';
  if (IsAdmin($luser)) {
  echo '<select name=\'agent\' id=\'agent'.$row['id'].'\' onchange="form.btn'.$row['id'].'.disabled=false">';
	echo '<option value=\'0\'>&nbsp;</option>';
    getaslist('d_users',$row['user'],'id<>110');
  echo '</select>';
  }
  echo '</td>';
  echo '<td>';
  if (IsAdmin($luser)) echo '<input type=submit value=Ok DISABLED id=\'btn'.$row['id'].'\'>';
  if ($row['deleted']==1){
  echo '<input type=submit value=O name=delbtn title="Знищити"></td>';
  } else {
  echo '<input type=submit value=Х name=delbtn title="Знищити"></td>';
  }
  echo '<tr></form>';
}

?>