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
		$dilyanka = get_bild($_GET["id"]);
				
		$smarty->assign('dilyanka', $dilyanka);
		/*		
				echo "<pre>";
				print_r ($sys['lists']);
				echo "</pre>";
		*/
		
		$oblast = $dilyanka["adr_obl"];
		
		$mista = get_table_info("d_mista", "parent=".$dilyanka["adr_rgn"]);
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
	
	  
	$smarty->assign('gen_info', $sys['lists']);	   
	$smarty->assign('page_name', "area_edit");
	$smarty->display('main.tpl');
	
?>