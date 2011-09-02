<?
class Page
{
    var $menuset;
    var $title;
    var $m_tpl; 

    function Page($page)
    {
        return $this->__construct($page);
    }

    function __construct($page)
    {
        $this->menuset = new Menuset('main');
        $this->title = "Олімп. Агентство нерухомості. "; // . $page;
        $this->m_tpl = $page;        
    }
    
    function tpl(){
        return ('tpl/'.SKIN.'/'.$this->m_tpl.".tpl");
    }

}
?>