<?
class Page
{
    var $menuset;
    var $title;
	var $keywords;
	var $isadmin;
    var $m_tpl;
    var $description;

    function Page($page,$id)
    {
        return $this->__construct($page,$id);
    }

    function __construct($page,$id)
    {
    	global $DB;
        $this->menuset = new Menuset($page,$id);
		$this->isadmin = ($page=='admin');
		$sql = "select title,keywords,description from m_seo where page='$page' and pageid = '$id'";
		$res = $DB->request($sql,ARRAY_A);
		$this->title = $res[0]['title'];
		if ($this->title=='')
			$this->title = "Олімп. Агентство нерухомості. ";
		$this->keywords = $res[0]['keywords'];
		$this->description = $res[0]['description'];
        $this->m_tpl = $page;
    }
    
    function tpl(){
        return ('tpl/'.SKIN.'/'.$this->m_tpl.".tpl");
    }

}
?>