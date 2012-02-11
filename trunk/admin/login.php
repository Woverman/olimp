<?php
include_once(DOCUMENT_ROOT."/config.php");
include_once(DOCUMENT_ROOT."/inc/functions.php");

function loginForm(){
?>
<div id="loginat">
    <form action='/admin/main/' method='post' class='login_form'>
		<input type="hidden" name="nextpage" value="<?=$_REQUEST['panel']=='exit'?'main':$_REQUEST['panel']?>">
        <table>
            <tr><td colspan="2" align="center"><h3>Адміністратор</h3></td></tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr><td width="50%">Логін:</td><td><input type='text' name='username'></td></tr>
            <tr><td>Пароль:</td><td><input type='password' name='userpass'></td></tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr><td colspan="2" align="center"><input type=submit value="Увійти"></td></tr>
        </table>
    </form>
</div>
<?
}

if (isset($_REQUEST['username'] ,$_REQUEST['userpass'])) {
    $username = $_REQUEST['username'];
    $userpass = $_REQUEST['userpass'];
    $sql="select count(id) from d_users where login='$username' and pass=MD5('$userpass') and block=0";
    $res=mysql_query($sql);
    $res=mysql_result($res,0,0);
    if ($res==1) {
		$_SESSION['logged']=1;
		$_SESSION['user']=$username;
		$sql = "select id from d_users where login='$username' and pass=MD5('$userpass') and block=0";
		$res=mysql_query($sql);
		$_SESSION['userid']=mysql_result($res,0,0);
		/***************save*session************/
		$ip=$_SERVER["REMOTE_ADDR"];
		$sid=session_id();
		$cli=$_SERVER["HTTP_USER_AGENT"];
		mysql_unbuffered_query('Update s_sessions set closed=1 where login=\''.$username.'\'');
		mysql_unbuffered_query("Insert into s_sessions (dt,sid,login,ip,cli) values (NOW(),'$sid','$username','$ip','$cli')");
		/***************save*session************/
		$panel = $_REQUEST['nextpage'];

?>
<script>
window.location.href="/admin/<?=$panel?>/";
</script>
<?    } else {
        loginForm();
    }
} else {
    loginForm();
} ?>