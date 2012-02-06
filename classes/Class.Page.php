<?
class Page
{
    var $menuset;
    var $title;
	var $keywords;
	var $isadmin;
    var $m_tpl; 

    function Page($page,$id)
    {
        return $this->__construct($page,$id);
    }

    function __construct($page,$id)
    {
        $this->menuset = new Menuset($page,$id);
		$this->isadmin = ($page=='admin');
        $this->title = "Олімп. Агентство нерухомості. "; // . $page;
        $this->m_tpl = $page;        
    }
    
    function tpl(){
        return ('tpl/'.SKIN.'/'.$this->m_tpl.".tpl");
    }

}
?>