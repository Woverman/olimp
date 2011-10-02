
<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/
function activatetab(tabnum){
	$(".findtab").removeClass('sel');
	$(".findtab:nth-child(" + tabnum + ")").addClass('sel');
	if (tabnum==2){
		showMapDist();
	} else {
		hideMapDist()
	}
}
/*]]>*/
</script>
<div id="left_panel">
	<div class="findtabs">
		<div class="findtabszone">
			<div class="findtab sel"><a href="#" onclick="activatetab('1');">Пошук</a></div>
			<div class="findtab"><a href="#" onclick="activatetab('2');">Пошук на карті</a></div>
		</div>
	</div>
    <div class="find_vidget ui-corner-bottom" id='find_panel'>
		<?  include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/find.tpl'); ?>
    </div>
	<br style="clear: both">
    <?
	$showframe=true;
	$target='Left1';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');
    $target='Left2';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');
    $target='Left3';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');
    $target='Left4';include(DOCUMENT_ROOT.'/modules/bnr/adman.php');
	?>

	<div class="vidget ui-corner-all">
  &copy; Olimp - 2011р.
	</div>
</div>