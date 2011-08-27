<?
class Project
{
    var $title='';
    var $id = 0;
    var $mainpage = 0;
    var $stages = '';
    var $old = '';
    var $showObjectTypes = 1;
    var $showOld = 0;

    function Project($id)
    {
        return $this->__construct($id);
    }

    function __construct($id)
    {
    	global $DB;
		if ($id!=0){
		$sql = "SELECT * from m_projects where id = ".$id;
		$res = $DB->request($sql);
        $this->id = $res[0][0];
        $this->title = $res[0][1];
        $this->mainpage = $res[0][2];
        $this->stages = $res[0][3];
        $this->old = $res[0][4];
        $this->showObjectTypes = $res[0][5];
        $this->showOld = $res[0][6];
		}
    }

//    function tpl(){
//        return ('tpl/'.SKIN.'/'.$this->m_tpl.".tpl");
//    }

}
?>