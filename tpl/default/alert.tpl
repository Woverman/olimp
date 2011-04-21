<div id="center_panel">
    <div id="wrapper">
		<!--  -->
<?
$msg='';
if (isset($_POST['forcheck'])) { //form submitted
  if (!isset($wantbuy)) $wantbuy=0;
  if (!isset($wantsell)) $wantsell=0;
  if (isset($maininfo)) $maininfo=strip_tags($maininfo); else $maininfo='';
  if (isset($phone)) $phone=strip_tags($phone); else $phone='';
  if (isset($client)) $client=strip_tags($client); else $client='';
  if (isset($email)) $email=strip_tags($email); else $email='';
  $ip=$_SERVER["REMOTE_ADDR"];
  if (empty($client)) $msg='Увага! Впишіть своє ім\'я';
  else {
  if (empty($phone)) $msg='Увага! Впишіть свій телефон';
  else {
    $sql="insert into m_messages (dt,cli,phone,buy,sell,txt,ip,email) values (NOW(),'$client','$phone','$wantbuy','$wantsell','$maininfo','$ip','$email')";
    mysql_unbuffered_query($sql);
    if (mysql_errno()) {
      $msg='Увага! Помилка запису! Перевірте текст і спробуйте ще раз.<br>'.mysql_error();
      } else {
        $msg='Ваше повідомлення записано в базу. Менеджер звяжеться з вами. Дякуємо за ваш вибір.';
        $wantbuy=0;$wantsell=0;$maininfo='';
      }
  }
}}
$div=((strlen($msg)>1)?'block':'none');
?>

<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/
function checkForm()
{
  var name=document.getElementById('client').value;
  if (name=='')
  {
    alert("Впишіть своє ім'я!");
    return false;
  }
  var phones=document.getElementById('phone').value;
  if (phones=='')
  {
    alert("Впишіть номер телефону для звязку з вами!");
    return false;
  }
  /*var email=document.getElementById('email').value;
  if (email=='')
  {
    alert("Впишіть поштову адресу для звязку з вами!");
    return false;
  }*/
  return true;
}
/*]]>*/
</script>
<br />
<div align="left" style="padding: 40px;">
<div style="float:left;font-size:24px;text-align:center;vertical-align:middle;padding:18px;">Зворотній<br />зв'зок</div><p style="font-size:14px;text-align:right;padding:0 10px 5px 10px;margin:5px">
Якщо Вас зацікавило одне з наших оголошень,<br /> чи Ви маєте бажання продати нерухомий об'єкт, <br />залишіть тут повідомлення і ми, якнайшвидше, <br />зв'яжемося з Вами і запропонуємо Вам найкращі <br />умови взаємовигідної співпраці. </p>
<div style="display:<?=@$div?>;padding-left:40px;"><b style="color:red;font-size:14px"> <?=@$msg?></b></div>
<br /><div style="font-size:14px;text-align:left;padding:0px;margin:5px">
<form name="ogolosh" method="POST" onsubmit="return checkForm()">
<input type="hidden" name="forcheck" value="1">
<input type="hidden" name="tab" value="<?=$tab?>">
<label for="client" style="cursor:pointer">Ваше ім'я:<br><input name="client" id="client" type="text" size="90" value="<?=@$client?>"  style="width: 100%"/></label><br />
<label for="phone" style="cursor:pointer">Ваші телефони:<br /><input id="phone" name="phone" type="text" size="90" value="<?=@$phone?>"  style="width: 100%"/></label><br />
<label for="email" style="cursor:pointer">Електронна адреса (email):<br /><input id="email" name="email" type="text" size="90" value="<?=@$email?>"  style="width: 100%"/></label><br />
<label for="wantbuy" style="cursor:pointer"><input type="checkbox" id="wantbuy" name="wantbuy" value="1" <? if(@$wantbuy==1) echo 'checked'; ?> />Я хочу купити</label>&nbsp;&nbsp;
<label for="wantsell" style="cursor:pointer"><input type="checkbox" name="wantsell" id="wantsell" value="1" <? if(@$wantsell==1) echo 'checked'; ?> />Я хочу продати</label><br />
Текст повідомлення:<br />
<textarea name="maininfo" cols="60" rows="5" style="width: 100%"><?=@$maininfo?></textarea>

<p style="font-size:14px;text-align:center;padding:10px;margin:5px"><input type="submit" value="Надіслати запит"></p>
</form>
</div>
</div>

	<!--  -->
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>

