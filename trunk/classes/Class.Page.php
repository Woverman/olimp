<?
class Page
{
    var $menuset;
    var $title; 
    var $hasleft = true;
    var $hasright = true;   
    var $m_tpl; 
    private $skin = "default";
    function Page($page)
    {
        return $this->__construct($page);
    }

    function __construct($page)
    {
        $this->menuset = new Menuset($page);
        $this->title = "Олимп. Агенство недвижимости. " . $page;
        $this->m_tpl = $page;        
    }
    
    function tpl(){
        return ('tpl/'.$this->skin.'/'.$this->m_tpl.".tpl");
    }

}
?>