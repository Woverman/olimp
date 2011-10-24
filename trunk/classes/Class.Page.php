<?
class Page
{
    var $menuset;
    var $title;
	var $keywords;
	var $isadmin;
    var $m_tpl; 

    function Page($page)
    {
        return $this->__construct($page);
    }

    function __construct($page)
    {
        $this->menuset = new Menuset($page);
		$this->isadmin = ($page=='admin');
        $this->title = "Олімп. Агентство нерухомості. "; // . $page;
        $this->m_tpl = $page;        
    }
    
    function tpl(){
        return ('tpl/'.SKIN.'/'.$this->m_tpl.".tpl");
    }

}
?>