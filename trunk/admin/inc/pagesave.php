<?
$id = @ $_POST['id'];
$n = mysql_escape_string($_POST['page_name']);
$t = mysql_escape_string($_POST['page_text']);
$f = mysql_escape_string($_POST['page_folder']);
$rightresult = 'edited';
$wrongresult = 'editerror';
if (empty ($id)){
  $id = $DB->insert('insert into m_pages (title) values ("new element")');
  $rightresult = 'created';
  $wrongresult = 'createerror';
  }
if (empty ($f))
  $f = "без папки";
$sql = "Update m_pages set `title`='" . $n . "',`text`='" . $t . "',`folder`='" . $f . "' where id=" . $id;
mysql_query($sql);
if (mysql_affected_rows()<1)
	$url = "/admin/pages/?result=".$wrongresult.'&etxt='.mysql_error()."&sql=".$sql;
else
	$url = "/admin/pages/?result=".$rightresult;
?>

<script>
window.location.href="<?=$url?>"
</script>