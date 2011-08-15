<!--<iframe src="http://olimp.test1.ru/modules/banners/" style="width: 100%; min-height:100%; height: 500px " frameborder=0 name='iBanners' >
<iframe src="http://olimp.test1.ru/modules/bnr/" style="width: 100%; min-height:100%; height: 500px " frameborder=0 name='iBanners' >
-->
<table align="center" border="1" cellspacing="0" cellpadding="2" class="head" width="80%">
  <tr>
<td align="center" class="head" width="20%"><a class="head" href="/modules/bnr/admin.php?action=add" target='iBanners'>Добавити</a></td>
<td align="center" class="head" width="20%"><a class="head" href="/modules/bnr/admin.php?action=edit" target='iBanners'>Список</a></td>
<td align="center" class="head" width="20%"><a class="head" href="/modules/bnr/admin.php?action=stats" target='iBanners'>Статистика</a></td>
	<td align="center" class="head" width="40%">&nbsp;</td>
  </tr>
</table>
<iframe src='/modules/bnr/admin.php?action=edit' style="width: 100%; min-height:100%; height: 600px " frameborder=0 name='iBanners' >
<?
include(DOCUMENT_ROOT.'/modules/bnr/admin.php?action=edit')
?>