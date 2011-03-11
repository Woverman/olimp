<script type="text/javascript">
  function putNow(){
    var txt=document.getElementById('news_dt');
    var today=new Date();
    var y=today.getFullYear();
    var n=checkTime(today.getMonth());
    var d=checkTime(today.getDate());
    var h=checkTime(today.getHours());
    var m=checkTime(today.getMinutes());
    var s=checkTime(today.getSeconds());
    txt.value=d+'.'+n+'.'+y+' '+h+':'+m+':'+s;
  }
  function checkTime(i)
  {
  if (i<10)
    {
    i="0" + i;
    }
  return i;
  }
  function validform(frm)
  {
    if ($('#news_dt').val()==''){
      alert("Вкажіть дату публікації!");
      return
      }
    if ($('#news_name').val()==''){
      alert("Вкажіть заголовок публікації!");
      return
      }
    if ($('#redactor_content_master').val()==''){
      alert("Вкажіть короткий текст публікації!");
      return
      }
    if ($('#redactor_content_slave').val()==''){
      alert("Вкажіть основний текст публікації!");
      return
      }

    frm.submit();
  }
</script>
<div style="border:1px solid #BFBFBF;padding:2px;margin:2px"><a href=/admin/admin.php?panel=news&mode=add><img class=bimg src="./i/add.gif">Добавити...</a>&nbsp;&nbsp;<a href=/admin/admin.php?panel=news><img class=bimg src="./i/list.gif">Список...</a></div>
<?
switch (@$_REQUEST['mode']) {
  case 'edit':
    $sql='Select *,date_format(date,"%d.%m.%Y %H:%i:%s")as dt from news where id='.$_GET['id'];
    if ($res=mysql_query($sql)) list($id,$title,$short,$long,$date,$enbl,$dt)=mysql_fetch_array($res);
  case 'add':
    ?>
    <form name="newsedit" method="post" action="/admin/admin.php">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="mode" value="save">
    <input type="hidden" name="panel" value="<?=@$panel?>">
    Дата, час <input id="news_dt" name="news_dt" type="text" size="55" value="<?=@$dt?>"> <input type="button" value="Зараз" onclick="putNow()"><br>
    Назва <input id="news_name" name="news_name" type="text" size="75" value="<?=@stripslashes($title)?>"><br>
    Короткий текст.<i>(перший абзац новини впишіть сюди)</i><br>
    <textarea name="news_short" rows="5" cols="70" id="redactor_content_master"><?=@stripslashes($short)?></textarea>
    Повний текст.<i>(продовження впишіть сюди)</i><br>
    <textarea wrap=soft name="news_long" rows="10" cols="70" id="redactor_content_slave"><?=@stripslashes($long)?></textarea>
    <button onclick="validform(form); return(false);"><img class=bimg src="./i/save.gif">Записати</button>
    </form>
    <?
    break;
  case 'save':
    $id=@$_POST['id'];
    if (empty($id)){
      mysql_query('insert into news (title,enable) values ("new element",1)');
      $id=mysql_result(mysql_query('select id from news where title="new element"'),0);
    }
    if (!empty($_POST['news_dt'])) {
      $dt=$_POST['news_dt'];
      preg_match('/^(\d{1,2})[-\.,]{1}(\d{1,2})[-\.,]{1}(\d{2,4}) (\d{2})[:]{1}(\d{2})[:]{1}(\d{2})$/',$dt,$arr);
      $dt=$arr[3].'-'.$arr[2].'-'.$arr[1].' '.$arr[2].':'.$arr[3].':'.$arr[1];
      $sql='Update news set `date`=\''.$dt.'\' where id='.$id;mysql_query($sql);
    }
    if (mysql_affected_rows()<0) echo mysql_error().'<br>'.$sql.'<br>';
    if (!empty($_POST['news_name'])) $sql='Update news set `title`=\''.mysql_escape_string($_POST['news_name']).'\' where id='.$id; mysql_query($sql);
    if (mysql_affected_rows()<0) echo mysql_error().'<br>'.$sql.'<br>';
    if (!empty($_POST['news_short'])) $sql='Update news set `short`=\''.mysql_escape_string($_POST['news_short']).'\' where id='.$id;mysql_query($sql);
    if (mysql_affected_rows()<0) echo mysql_error().'<br>'.$sql.'<br>';
    if (!empty($_POST['news_long'])) $sql='Update news set `long`=\''.mysql_escape_string($_POST['news_long']).'\' where id='.$id;mysql_query($sql);
    if (mysql_affected_rows()<0) echo mysql_error().'<br>'.$sql.'<br>';
  case 'delete':
    if (isset($_GET['id']) and $_GET['mode']=='delete') {
      mysql_query('Delete from news where id='.$_GET['id']);
      echo 'Знищено '.mysql_affected_rows().' рядів.';
      }
  case 'offon':
    if (isset($_GET['id']) and $_GET['mode']=='offon') {
      mysql_query('update news set enable=0-(enable-1) where id='.$_GET['id']);
      echo '<font color=red>Дані збережено.</font><br>';
      }
  default:
    $sql='Select *,date_format(date,"%d.%m.%Y %H:%e")as dt from news';
    $res=mysql_query($sql);
    echo '<table cellspasing=2 width=100%>';
    $a=1;
    while ($row=mysql_fetch_array($res)) {
      echo '<tr class="row'.$a=abs($a-1).'"><td>'.$row['title'].'</a></td><td style="border:1px solid black" width="66">';
      echo '<a href=/admin/admin.php?panel=news&mode=edit&id='.$row['id'].'><img class=aimg src="./i/edit.gif" title="Правка"></a>';
      echo '<a href=/admin/admin.php?panel=news&mode=delete&id='.$row['id'].'><img class=aimg src="./i/del.gif" title="Знищити"></a>';
      echo '<a href=/admin/admin.php?panel=news&mode=offon&id='.$row['id'].'><img class=aimg src="./i/'.($row['enable']==1?'on':'off').'.gif" title="'.($row['enable']==1?'Увімкнути':'Вимкнути').'"></a>';
      echo '</td></tr>';
    }
    echo '<tr><td colspan=2><font color=#6F6F6F><img src="./i/edit.gif"> Правка | <img src="./i/del.gif"> Знищити | <img src="./i/on.gif"> Активно | <img src="./i/off.gif"> Неактивно </font></td></tr>';
    echo '</table>';
}
?>

