<div id="admin_panel">

<?
if ($_REQUEST['panel']=='exit'){
    unset($_SESSION['logged']);
}
if (isset($_SESSION['logged']) and $_SESSION['logged']=1){
    include(DOCUMENT_ROOT.'/admin/admin.php');
 } else {
    include(DOCUMENT_ROOT.'/admin/login.php');
    if (isset($_SESSION['logged']) and $_SESSION['logged']=1){
        include(DOCUMENT_ROOT.'/admin/admin.php');
     }
 }
?>

</div>