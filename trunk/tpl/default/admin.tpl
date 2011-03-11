<?
if (isset($_SESSION['logged']) and $_SESSION['logged']>0){
    include(DOCUMENT_ROOT.'/admin/admin.php');
 } else {
    include(DOCUMENT_ROOT.'/admin/login.php');
 }
?>