<?
// get user groups
$sql = "select * from s_usergroups";
$groups = $DB->request($sql,ARRAY_A);
// get admin pages
$sql = "select * from s_adminpages order by orderid_menu";
$pages = $DB->request($sql,ARRAY_A);
// get permissions
$sql = "select * from s_permissions";
$permres = $DB->request($sql,ARRAY_A);
foreach ($permres as $perm){
	$perms[$perm['pageid']][$perm['usergroupid']] = $perm['permitted'];
	}
?>
<script>
function setPermission(val,page,group) {
	var value = val?1:0;
	$.get("/ajax/setPrm.php",{gid:group,pid:page,value:value},function(a,b){
		if (a!='') alert(a);
	});
	//alert('page='+page+', group='+group+', value='+value);
}
function checkAll(val,page,group){
	var cls;
	if (page==0) cls=".group"+group;
	else cls = ".page"+page;
	$(cls).attr("checked",val);
	setPermission(val,page,group);
}
</script>
<table style="width: 100%" class="mytab">
<thead>
	<tr style="background-color: #C9C9C9; color: #343434">
		<th></th>
		<th>Сторінки</th>
		<? 	foreach ($groups as $group){
				$gname = $group['title'];
				$gid = $group['id'];
				echo("<th>$gname<br><input type='checkbox' onchange=\"checkAll(this.checked,0,$gid)\"></th>");
				}
		 ?>
	</tr>
</thead>
<tbody>
<?
	$a=0;
	foreach ($pages as $page){
		$pid = $page['id'];
		echo('<tr class="row'.$a=abs($a-1).'" id="row'.$i.'">');
		echo('<td><input type="checkbox" onchange="checkAll(this.checked,'.$pid.',0)"></td>');
		echo('<td>'.$page['title_menu'].'</td>');
		foreach ($groups as $group){
				$gid = $group['id'];
				$checked = ($perms[$pid][$gid]==1?"checked":"");
				echo("<td><input type='checkbox' class='page$pid group$gid' onchange=\"setPermission(this.checked,$pid,$gid)\" $checked></td>");
				}
		echo('</tr>');
	}
?>
</tbody>
</table>