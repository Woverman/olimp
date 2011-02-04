<?
class Menu
{
    var $id;
    var $type; 
    var $text;
            
    function Menu($type,$id,$text)
    {
        return $this->__construct($type,$id,$text);
    }

    function __construct($type,$id,$text)
    {
        $this->id = $id;
        $this->type = $type;
        $this->text = $text;
    }
    function href(){
        return('/'.$this->type.'/'.$this->id.'/');
    }
}
?>