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
	var $proj;
    var $projTitle;
	var $showSubmenu;

	function FindParameters(){
		$this->parse();
	}
	private function parse(){
		//debug($_REQUEST,'ReQUEST = ');
		$this->pr = $_REQUEST['pr']?$_REQUEST['pr']:($_REQUEST['id']==0?0:1);
		$this->obl = $_REQUEST['obl']?$_REQUEST['obl']:0;
		$this->rgn = $_REQUEST['rgn']?$_REQUEST['rgn']:0;
		$this->gor = $_REQUEST['gor']?$_REQUEST['gor']:0;
		$this->tn = $_REQUEST['tn']?$_REQUEST['tn']:0;
		$this->kk = $_REQUEST['kk']?$_REQUEST['kk']:0;
		$this->price1 = ($_REQUEST['prise1']!='')?$_REQUEST['prise1']:0;
		$this->price2 = ($_REQUEST['prise2']!='')?$_REQUEST['prise2']:0;
		$this->dom_domtype = $_REQUEST['dom_domtype']?$_REQUEST['dom_domtype']:0;
		$this->pg = $_REQUEST['pg']?$_REQUEST['pg']:1;
		$this->dist = $_REQUEST['dist']?$_REQUEST['dist']:0;
		$this->proj = $_REQUEST['proj']?$_REQUEST['proj']:0;
		$this->projTitle = $this->getPageTitle($this->proj);
        $this->showSubmenu = $this->getSubmenuFlag($this->proj);
		debug($this,"FindParameters");
	}
	function createURL($field,$new_value) {
	   $ret = "?";
       foreach($this as $key => $value) {
       		if ($key==$field) $value=$new_value;
			$ret .= "$key=$value&";
       }
	   return $ret;
    }
	private function getPageTitle($prjid){
		global $DB;
		if ($prjid==0) return 1;
		$sql = "Select title from m_pages where id = ".$prjid;
		$res = $DB->request($sql);
		return $res[0][0];
	}
    private function getSubmenuFlag($prjid){
		global $DB;
		if ($prjid==0) return 1;
		$sql = "Select isShowObjectTypes from m_projects where id = ".$prjid;
		$res = $DB->request($sql);
		return $res[0][0];
	}

}
?>