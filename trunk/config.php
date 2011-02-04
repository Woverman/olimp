<?
// Debug
$debug = True;

// MySQL connect
$sqlserver = 0; // current db connection

// Sergey's PC
$dbuser[0] = "olimp";
$dbpass[0] = "asdzxc21";
$dbhost[0] = "178.74.197.11";
$dbname[0] = "olimpdb";

// Server
$dbname[1] = "olimpbiz_maindb";
$dbuser[1] = "olimpbiz_user";
$dbpass[1] = "gSDJgYJd";
$dbhost[1] = "localhost";

// configuration
define('SKIN', "default");
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']); //.'/tool');
define('ROOT_FOLDER', '');
// Email and Name for Problem List Mailer
define('TO_MAIL', $_SERVER['SERVER_ADMIN']);
define('TO_NAME', $_SERVER['SERVER_NAME']);

?>