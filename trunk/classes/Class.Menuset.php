<?
class Menuset
{
    var $items;
    var $type; // 0=horizontal 1=vertical
    var $title;

    function Menuset($page)
    {
        return $this->__construct($page);
    }

    function __construct($name)
    {
        global $DB;
        $this->title = $name;
        $sql = "Select id,title,vertical from s_menuset where title='$name'";
        $res = $DB->request($sql,ARRAY_A);
        $gid = $res[0]['id'];
        $this->type = $res[0]['vertical'];

        $sql = "Select `title`,`itemid`,`href` from `s_menu` where `enable`=1 and `group`=$gid order by `orderid`";
        print_r($sql);
        unset($this->items);
        $res = $DB->request($sql,ARRAY_A);
        print_r($res);
        foreach ($res as $item){
            $this->items[] = new Menu($item['href'],$item['itemid'],$item['title']);
        }
        /*if (isset($_SESSION['logged']) and $_SESSION['logged']>0){
            $this->items[] = new Menu("admin","exit","Вихід");
        }*/
    }

    function listitems(){
        foreach ($this->items as $item){
        $ret .= "<li><a href='".$item->href()."'>".$item->text."</a></li>";
        }
        return $ret;
    }
}
?>