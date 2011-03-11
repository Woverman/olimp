<?
	global $config;
	require_once('../inc/functions.php');
	include ('../inc/config.php');
	include ('../inc/pre.php');

	require ("config.php");


	$oblast = 2;

	$regions = get_table_info("d_oblasti");
	$smarty->assign('regions', $regions);

	if (!empty($_GET["id"]))
	{
		$kvartira = get_bild($_GET["id"]);

		$inkva_length = strlen($kvartira["kva_inkva"]);
		$stinu_length = strlen($kvartira["kva_stinu"]);
		$indom_length = strlen($kvartira["kva_indom"]);

		for ($i=1; $i<=$inkva_length; $i++)
		{
			$inkva_details[$i] = $kvartira["kva_inkva"][$i-1];
		}

		for ($j=1; $j<=$stinu_length; $j++)
		{
			$stinu_details[$j] = $kvartira["kva_stinu"][$j-1];
		}

		for ($k=1; $k<=$indom_length; $k++)
		{
			$indom_details[$k] = $kvartira["kva_indom"][$k-1];
		}

		$kvartira["inkva_details"] = @$inkva_details;
		$kvartira["stinu_details"] = @$stinu_details;
		$kvartira["indom_details"] = @$indom_details;

		$smarty->assign('kv', $kvartira);

		$oblast = $kvartira["adr_obl"];

		$mista = get_table_info("d_mista", "parent=".$kvartira["adr_rgn"]);
		$smarty->assign('mista', $mista);

	}

    $vuls = get_table_info("d_vul");
    $smarty->assign('vuls', $vuls);

	$rayons = get_table_info("d_rgn", "parent=".$oblast);
	$smarty->assign('rayons', $rayons);

  $sql = 'SELECT id,name from d_users order by name';
	$res=mysql_query($sql);
  if (mysql_num_rows($res)>0){
	  while ($row=mysql_fetch_row($res)) $agents[$row[0]] = $row[1];
    }
	$smarty->assign('agents', $agents);

	$smarty->assign('page_name', "apartment_edit");
	$smarty->display('main.tpl');

?>