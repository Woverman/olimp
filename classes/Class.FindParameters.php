<?
class FindParameters{
	var $pr;
	var $obl;
	var $rgn;
	var $gor;
	var $tn;
	var $kk;
	var $price1;
	var $price2;
	var $dom_domtype;
	var $pg;
	var $dist;
	function FindParameters(){
		$this->parse();
	}
	private function parse(){
		$this->pr = $_REQUEST['pr']?$_REQUEST['pr']:($_REQUEST['id']==0?0:1);
		$this->obl = $_REQUEST['obl']?$_REQUEST['obl']:0;
		$this->rgn = $_REQUEST['rgn']?$_REQUEST['rgn']:0;
		$this->gor = $_REQUEST['gor']?$_REQUEST['gor']:0;
		$this->tn = $_REQUEST['tn']?$_REQUEST['tn']:0;
		$this->kk = $_REQUEST['kk']?$_REQUEST['kk']:0;
		$this->price1 = ($_REQUEST['price1']!='')?$_REQUEST['price1']:0;
		$this->price2 = ($_REQUEST['price2']!='')?$_REQUEST['price2']:0;
		$this->dom_domtype = $_REQUEST['dom_domtype']?$_REQUEST['dom_domtype']:0;
		$this->pg = $_REQUEST['pg']?$_REQUEST['pg']:1;
		$this->dist = $_REQUEST['dist']?$_REQUEST['dist']:0;
	}
	function createURL($newpage) {
	   $ret = "?";
       foreach($this as $key => $value) {
       		if ($key!="pg") $ret .= "$key=$value&";
			else  $ret .= "pg=".$newpage;
       }
	   return $ret;
    }
}
?>