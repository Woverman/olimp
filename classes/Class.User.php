<?
class User {
	var $id;
	var $login;
	var $name;
	var $group;
	var $locked;

	function User($id)
    {
        return $this->__construct($id);
    }

    function __construct($id)
    {
    	if (!$id) return;
    	global $DB;
		$sql = "select * from d_users where id=".$id;
		$res = $DB->request($sql,ARRAY_A);
		$this->id = $id;
		$this->login = $res[0]['login'];
		$this->name = $res[0]['name'];
		$this->group = new Group($res[0]['rights']);
		$this->locked = $res[0]['block'];
	}
	function Permitted($pid){
		if ($this->group->permissions[$pid]==1)
			return true;
		return false;
	}
}

class Group {
	var $id;
	var $name;
	var $permissions;
	function Group($id)
    {
        return $this->__construct($id);
    }

    function __construct($id)
    {
    	global $DB;
		$sql = "select * from s_usergroups where id=".$id;
		$res = $DB->request($sql,ARRAY_A);
		$this->id = $id;
		$this->name = $res[0]['title'];
		$sql = "select p.pageid as pid,p.permitted as prm, a.href as href from s_permissions p,s_adminpages a where p.pageid=a.id and p.usergroupid = ".$id;
		$res = $DB->request($sql,ARRAY_A);
		;
		foreach ($res as $item){
			$this->permissions[$item['pid']] = $item['prm'];
			$this->permissions[$item['href']] = $item['prm'];
		}
		debug($this->permissions,'permissions');
	}

}
?>