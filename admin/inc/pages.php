<?
if (!empty($_GET["result"])){
	switch($_GET["result"]){
		case 'edited':
			$msg = "Зміни збережено.";
			$col = "green";
			break;
		case 'editerror':
			$msg = "Сталася помилка! Зміни не збережено!<br>".$_GET['etxt'];
			$col = "red";
			break;
		case 'created':
			$msg = "Створено нову сторінку.";
			$col = "green";
			break;
		case 'createerror':
			$msg = "Сталася помилка! Сторінку не створено!<br>".$_GET['etxt'];
			$col = "red";
			break;
	}
	debug($_GET['sql']);
	?>
	<div id="succesInfo" style="border:1px solid <?= $col ?>; height:1em; margin:4px; padding:14px; font-weight:bold;color:<?= $col ?>;" align="center"><?= $msg ?></div>
	<script language="JavaScript" type="text/javascript">
		$('#succesInfo').delay(2000).slideUp(400);
	</script>
	<?
}
?>
<div style="border:1px solid #BFBFBF;padding:2px;margin:2px">
<a href=/admin/pageedit/?mode=add><button style="height: 40px"><img class=bimg src="/i/add.png">Добавити...</button></a>
</div>
<?
debug($_GET,"GET");
switch (@$_REQUEST['mode']) {
  case 'delete':
    if (isset($_GET['id']) and $_GET['mode']=='delete') {
      $DB->insert('Delete from m_pages where id='.$_GET['id']);
      }
  case 'offon':
    if (isset($_GET['id']) and $_GET['mode']=='offon') {
      $DB->insert('update m_pages set enable=0-(enable-1) where id='.$_GET['id']);
      }
  default:
    $sql='Select id,folder,title,enable from m_pages order by 2,3';
    $res=$DB->request($sql,ARRAY_A);
    echo '<table cellspasing=2 width=100% class="mytab">';
    $a=1;
	debug($res);
	foreach($res as $row){
      echo '<tr class="row'.$a=abs($a-1).'"><td>'.$row['folder'].'</td><td>'.$row['title'].'</a></td><td>';
      echo '<a href=/admin/pageedit/?mode=edit&pid='.$row['id'].'><img class=aimg src="/i/edit.png" title="Правка"></a>';
      echo '<a href=/admin/pages/?mode=delete&id='.$row['id'].'><img class=aimg src="/i/delete.png" title="Знищити"></a>';
      echo '<a href=/admin/pages/?mode=offon&id='.$row['id'].'><img class=aimg src="/i/'.($row['enable']==1?'on':'off').'.png" title="'.($row['enable']!=1?'Увімкнути':'Вимкнути').'"></a>';
      echo '</td></tr>';
    }
    echo '<tr>';
    echo '</table>';
}
?>

