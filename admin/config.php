<?

require('../smarty/libs/Smarty.class.php');
$smarty = new Smarty;

$smarty->template_dir = '../admin/tpl/';
$smarty->compile_dir = '../smarty/temp_data/templates_c/';
$smarty->config_dir = '../smarty/temp_data/configs/';
$smarty->cache_dir = '../smarty/temp_data/cache/';

?>