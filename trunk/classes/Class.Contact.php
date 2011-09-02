<?
class Contact
{
    var $name_long;
    var $role;
    var $phone1;
    var $phone2;
    var $phone3;
    var $phone4;
    var $email;
    var $id;

    function Contact($id)
    {
        return $this->__construct($id);
    }

    function __construct($id)
    {
    	if ($id>0) {
	    	global $DB;
			$sql = "Select * from d_users where id=$id";
			debug($sql,'in the construct!');
			$res = $DB->request($sql,ARRAY_A);
			debug($res,'in the construct!');
			$this->name_long = $res[0]['name'];
	        $this->role = $res[0]['posada'];
	        $this->phone1 = $res[0]['phone1'];
	        $this->phone2 = $res[0]['phone2'];
	        $this->phone3 = $res[0]['phone3'];
	        $this->phone4 = $res[0]['phone4'];
	        $this->email = $res[0]['email'];
	        $this->id = $res[0]['id'];
		   	debug($this,'this in construct');
		}		//return $this;
    }

    function tpl(){
        return ('tpl/'.SKIN.'/'.$this->m_tpl.".tpl");
    }

}
?>