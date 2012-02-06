<?
class Menuset
{
    var $title;
	var $id;
    var $items;
        
    function Menuset($page,$id)
    {
        return $this->__construct($page,$id);
    }

    function __construct($page,$id)
    {
        $this->title = $page;
		$this->id = $id;
        $this->items = Array(
            new Menu("main",0,"Головна")
            ,new Menu("newslist",0,"Новини")
            ,new Menu("articles",0,"Статті")
            ,new Menu("article",4,"Послуги")
            ,new Menu("catalog",1,"Каталог")
            ,new Menu("catalog",0,"Оренда")
            ,new Menu("kredit",0,"Кредит")
            ,new Menu("article",2,"Про нас")
			,new Menu("article",3,"Контакти")
        );
        if (isset($_SESSION['logged']) and $_SESSION['logged']>0){

		  	$this->items[] = new Menu("admin","main","Адмінка");
        } else {
			$ogol = new Menu("alert",0,"Залишити оголошення");
			$ogol->special = true;
			$this->items[] = $ogol;
        }
    }
    
    function listitems(){
        foreach ($this->items as $item){
        	$cls = $item->special?'menuitem_special':'menuitem';
			$nohref = (($item->type == $this->title) && ($item->id == $this->id));
			if ($nohref)
        		$ret .= "<li class='$cls'><span>".$item->text."</span></li>";
			else
				$ret .= "<li class='$cls'><a href='".$item->href()."'>".$item->text."</a></li>";
        }
        return $ret; 
    }
}
?>