<style type='text/css'>
.mainrow { border: 1px solid #DDDDDD;}
.mainrow h4 {margin:1px;text-align: center; color:#339900; display: block;cursor:pointer;}
.mainrow th {border:1px solid gray; width:25%;vertical-align:bottom}
.mainrow img {border:0; margin:15px}
.mainrow th div {border:1px solid gray; line-height:50px;}
.mainrow th div.l2 {line-height:25px;}
.mainrow a:hover div {background-color: #99CCFF; color:blue;}
</style>

<div class=mainrow>
  <div onclick="ShowHideDiv('neruh')"><h4><button style="position:relative; top:0;float:right">...</button>Нерухомість</h4></div>
  <div id=neruh style="display:block;">
    <table border=0 width=99%>
      <tr>
        <th><a href='/admin/admin.php?panel=kva'><img src='./i/kva.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/kva.png); width:expression(1); height:expression(1);}'><div>Квартири</div></a></th>
        <th><a href='/admin/admin.php?panel=dom'><img src='./i/home.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/home.png); width:expression(1); height:expression(1);}'><div>Будинки</div></a></th>
        <th><a href='/admin/admin.php?panel=dil'><img src='./i/zdil.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/zdil.png); width:expression(1); height:expression(1);}'><div>Ділянки</div></a></th>
        <th><a href='/admin/admin.php?panel=kner'><img src='./i/com.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/com.png); width:expression(1); height:expression(1);}'><div class='l2'>Комерційна нерухомість</div></a></th>
      </tr>
    </table>
  </div>
</div>
<br />
<div class=mainrow>
  <div onclick="ShowHideDiv('boguna')"><h4><button style="position:relative; top:0;float:right">...</button>Богуна</h4></div>
  <div id=boguna style="display:block;">
    <table border=0 width=99%>
      <tr>
        <th><a href='/admin/admin.php?panel=boguna_main'><img src='./i/nb_main.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/nb_main.png); width:expression(1); height:expression(1);}'><div>Головна</div></a></th>
        <th><a href='/admin/admin.php?panel=boguna_list'><img src='./i/nb_list.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/nb_list.png); width:expression(1); height:expression(1);}'><div>Список</div></a></th>
        <th><a href='/admin/admin.php?panel=boguna_stages'><img src='./i/nb_stages.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/nb_stages.png); width:expression(1); height:expression(1);}'><div>Етапи</div></a></th>
        <th><a href='/admin/admin.php?panel=boguna_old'><img src='./i/nb_old.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/nb_old.png); width:expression(1); height:expression(1);}'><div>Готові</div></a></th>
      </tr>
    </table>
  </div>
</div>
<br />
<div class=mainrow>
  <div onclick="ShowHideDiv('dovidn')"><h4><button style="position:relative; top:0;float:right">...</button>Довідники</h4></div>
  <div id=dovidn style="display:block;">
    <table border=0 width=99%>
      <tr>
        <th><a href='/admin/admin.php?panel=obl'><img src='./i/star_blue.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/star_blue.png); width:expression(1); height:expression(1);}'><div>Області</div></a></th>
        <th><a href='/admin/admin.php?panel=rgn'><img src='./i/star_green.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/star_green.png); width:expression(1); height:expression(1);}'><div>Райони</div></a></th>
        <th><a href='/admin/admin.php?panel=gor'><img src='./i/star_red.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/star_red.png); width:expression(1); height:expression(1);}'><div>Міста</div></a></th>
        <th><a href='/admin/admin.php?panel=vul'><img src='./i/star_grey.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/star_grey.png); width:expression(1); height:expression(1);}'><div>Вулиці</div></a></th>
      </tr>
    </table>
  </div>
</div>
<br />
<?if (IsAdmin()):?>
<div class=mainrow>
  <div onclick="ShowHideDiv('additional')"><h4><button style="position:relative; top:0;float:right">...</button>Додатково</h4></div>
  <div id=additional style="display:block;">
    <table border=0 width=99%>
      <tr>
        <th><a href='/admin/admin.php?panel=user'><img src='./i/users.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/users.png); width:expression(1); height:expression(1);}'><div>Користувачі</div></a></th>
        <th><a href='/admin/admin.php?panel=exl'><img src='./i/exl.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/exl.png); width:expression(1); height:expression(1);}'><div>Ексклюзив</div></a></th>
        <th><a href='/admin/admin.php?panel=mail'><img src='./i/mail.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/mail.png); width:expression(1); height:expression(1);}'><div>Заявки</div></a></th>
        <th><a href='/admin/admin.php?panel=news'><img src='./i/news.png' style='{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=./i/news.png); width:expression(1); height:expression(1);}'><div>Новини</div></a></th>
      </tr>
    </table>
  </div>
</div>
<?endif?>
