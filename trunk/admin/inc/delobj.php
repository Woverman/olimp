<?
mysql_unbuffered_query("Delete from m_bildings where id=".$_REQUEST['oid']);
mysql_unbuffered_query("Delete from m_fotos where objid=".$_REQUEST['oid']);
$url = $_SERVER["HTTP_REFERER"];
if (stripos($url,"?")==0)
	$url.='?';
else
	$url.='&';
$url.='result=2';
?>

<script>
window.location.href="<?=$url?>"
</script>