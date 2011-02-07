<?
class Menuset
{
    var $title; 
    var $items;
        
    function Menuset($page)
    {
        return $this->__construct($page);
    }

    function __construct($page)
    {
        $this->title = "main";
        $this->items = Array(
            new Menu("main",0,"Головна"),
            new Menu("newslist",0,"Новини"),
            new Menu("articles",0,"Статті"),
            new Menu("article",3,"Послуги"),
            new Menu("catalog",1,"Каталог"),
            new Menu("catalog",2,"Оренда"),
            new Menu("kredit",0,"Кредит"),
            new Menu("article",2,"Про нас"),
			new Menu("article",3,"Контакти")
        );
        $this->title = "Олимп. Агенство недвижимости.";
    }
    
    function listitems(){
        foreach ($this->items as $item){
        $ret .= "<li><a href='".$item->href()."'>".$item->text."</a></li>";
        }
        return $ret; 
    }
}
?>