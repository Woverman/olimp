<?php
include_once(DOCUMENT_ROOT."/config.php");
include_once(DOCUMENT_ROOT."/inc/functions.php");
if (isset($_SESSION['logged']) and $_SESSION['logged']>0){
  $res=mysql_query('Select date_format(`dt`,"%d.%m.%Y %H:%i") from s_sessions where login="'.$_SESSION['user'].'" order by dt limit 1');
  if ($row=mysql_fetch_array($res)) $last='Попередній вхід:<br /> '.$row[0]; else $last='це ваш перший вхід.';
?>
  <div id="loginat" style="position: fixed !important">
    Адміністратор: <b><?=$_SESSION['user']?></b><br />
    <?=$last?><br />
<?
if (!strpos($_SERVER['PHP_SELF'],'admin'))
  echo '<input type=button value=Адмінка onclick="document.location=\'/admin/admin.php\'">';
else
  echo '<input type=button value="Головна сторінка" onclick="document.location=\'/\'">';
?>
<input type=button value=Вихід onclick="document.location='?exit=1'"><br /><br />
  <?
} else {
	if (isset($username,$userpass)) {
	    debug(3,"brackets");
		$sql="select count(id) from d_users where login='$username' and pass=MD5('$userpass') and block=0";
		$res=mysql_query($sql);
		$row=mysql_fetch_row($res);
		if ($row[0]==1) {
			$_SESSION['logged']=1;
			$_SESSION['user']=$username;
      /***************save*session************/
      $ip=$_SERVER["REMOTE_ADDR"];
      $sid=session_id();
      $cli=$_SERVER["HTTP_USER_AGENT"];
      mysql_unbuffered_query('Update s_sessions set closed=1 where login=\''.$username.'\'');
      mysql_unbuffered_query("Insert into s_sessions (dt,sid,login,ip,cli) values (NOW(),'$sid','$username','$ip','$cli')");
      /***************save*session************/
			$href='/admin/admin.php';
		} else {
			$href=$config('SIGHT_HREF');
		}
	  require './index.php';
  } else {
		//if (@$loginmode==2) {
		?>
        <div id="loginat" style="position: fixed; top:200px; left:400px;">
        <form action='/admin/main/' method='post' class='login_form'>
        <b>Адміністратор</b><br />
        Логін: <input type='text' name='username'><br />
        Пароль:<input type='password' name='userpass'><br />
        <input type=submit value="Увійти">
		</form>
    </div>
		<?
		//  }
	}
 }
?>
</div>