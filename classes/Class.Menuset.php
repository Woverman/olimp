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
            new Menu("article",4,"Послуги"),
            new Menu("catalog",1,"Каталог"),
            new Menu("catalog",0,"Оренда"),
            new Menu("kredit",0,"Кредит"),
            new Menu("alert",0,"Залишити оголошення"),
            new Menu("article",2,"Про нас"),
			new Menu("article",3,"Контакти")
        );
        //if (isset($_SESSION['logged']) and $_SESSION['logged']>0){
          //  $this->items[] = new Menu("admin","exit","Вихід");
        //} else {
        //$this->items[] = new Menu("admin","main","Адмінка");
        //}
		//if (isset($_SESSION['logged']) and $_SESSION['logged']>0)
            //$this->items[] = new Menu("admin","exit","Вихід");
    }
    
    function listitems(){
        foreach ($this->items as $item){
        $ret .= "<li><a href='".$item->href()."'>".$item->text."</a></li>";
        }
        return $ret; 
    }
}
?>