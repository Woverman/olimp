<?
abstract class Object
{
    var $id;
    var $type;
    var $num;
	var $prodazh;
	var $adr_obl;
	var $adr_rgn;
	var $adr_gor;
	var $adr_vul;
	var $cast;
	var $valuta;
	var $casttype;
	var $comment;
	var $add;
	var $kont;
	var $in_main;
	var $in_hot;
	var $novobud;
  var $dateadd;
	protected function loadvars($data){
		$this->id = $data["id"];
		$this->type = $data["type"];
		$this->num = $data["num"];
		$this->prodazh = $data["prodazh"];
		$this->adr_obl = $data["adr_obl"];
		$this->adr_rgn = $data["adr_rgn"];
		$this->adr_gor = $data["adr_gor"];
		$this->adr_vul = $data["adr_vul"];
		$this->cast = $data["cast"];
		$this->valuta = $data["valuta"];
		$this->casttype = $data["casttype"];
		$this->comment = $data["comment"];
		$this->add = $data["add"];
		$this->kont = $data["kont"];
		$this->in_main = $data["in_main"];
		$this->in_hot = $data["in_hot"];
		$this->novobud = $data["novobud"];
    $this->dateadd = $data["add"];
 	}
	function parse($data){
		$o=null;
		switch ($data['type']){
			case "dom":
				$o = new ObjectDom();
				break;
			case "kva":
				$o = new ObjectKva();
				break;
			case "dil":
				$o = new ObjectDil();
				break;
			case "com":
				$o = new ObjectCom();
				break;
			case "bog":
				$o = new ObjectKva();
				break;
		}
		$o->loadLocalVars($data);
		return $o;
	}
	function img($num,$type="1"){
		$file = "/i/obj/img_".$this->id."_".$num.".jpg";
		if (file_exists(DOCUMENT_ROOT.$file))
			return(ROOT_FOLDER."/i/obj/img_".$this->id."_".$num.".jpg");
		else
			return(ROOT_FOLDER."/image.php?objid=".$this->id."&mode=".$type."&num=".$num);
	}
	function address(){
	  $a[] = findadr($this->adr_obl,'d_oblasti').' обл.';
    $a[] = findadr($this->adr_rgn,'d_rgn').' район';
    $a[] = findadr($this->adr_gor,'d_mista');
    $a[] = $row['adr_vul'];

		$ret = implode(" ",$a);
		if ($this->adr_vul)
			$ret .= ", вул. ".$this->adr_vul;
		return $ret;
	}
	function price(){
		if ($this->cast){
			if ($this->valuta==2)
				return "Ціна: $".number_format($this->cast, 0, ',', ' ');
			else
				return "Ціна: ".number_format($this->cast, 0, ',', ' ')." грн.";
		} else {
			return "ціна договірна";
		}
	}
	function ShortInfo(){
    $ret = $this->area();
    return $ret;
	}
  function added(){
    $t = time($this->dateadd);
    return strftime("%d.%m.%Y %H:%M",$t);
  }
  function commentCrop(){
    if (strlen($this->comment)<150)
      return $this->comment;
    else
      return substr($this->comment,0  ,150).'<span title="'.$this->comment.'">...</span>';
  }
}

class ObjectDom extends Object{
	var $povv;
	var $kk;
	var $pzag;
	var $pzit;
	var $pkuh;
	var $dom_domtype;
	var $gotov;
	var $pdil;
	var $plo_od;
	function loadLocalVars($data){
		$this->loadvars($data);
		$this->povv = $data["povv"];
		$this->kk = $data["kk"];
		$this->pzag = $data["pzag"];
		$this->pzit = $data["pzit"];
		$this->pkuh = $data["pkuh"];
		$this->dom_domtype = $data["dom_domtype"];
		$this->gotov = $data["gotov"];
		$this->pdil = $data["pdil"];
		$this->plo_od = $data["plo_od"];
	}
	function shortDetails(){
		if ($this->pzag)
			return "будинок ".$this->pzag." м<sup>2</sup>";
		else
			return "будинок";

	}
  function area(){
      return 'Площа: загальна - '.$this->pzag.' м<sup>2</sup>, житлова - '.$this->pzit.' м<sup>2</sup>, кухня - '.$this->pkuh.' м<sup>2</sup>, ділянка - '.$this->pdil.(($this->plo_od==1)?(($this->pdil>4)?" соток":" сотки"):" га");;
  }
}
class ObjectKva extends Object{
	var $pov;
	var $povv;
	var $kva_type;
	var $kk;
	var $pzag;
	var $pzit;
	var $pkuh;
	function loadLocalVars($data){
		$this->loadvars($data);
		$this->pov = $data["pov"];
		$this->povv = $data["povv"];
		$this->kva_type = $data["kva_type"];
		$this->pzag = $data["pzag"];
		$this->pzit = $data["pzit"];
		$this->pkuh = $data["pkuh"];
		$this->kk = $data["kk"];
	}
	function shortDetails(){
		if ($this->kk>0)
			$ret = $this->kk."-на ";
		$ret .= "квартира ";
		if ($this->pzag)
			$ret .= $this->pzag." м<sup>2</sup>";
		return $ret;
	}
  function area(){
      return 'Площа: загальна - '.$this->pzag.' м<sup>2</sup>, житлова - '.$this->pzit.' м<sup>2</sup>, кухня - '.$this->pkuh.' м<sup>2</sup>';
  }
}
class ObjectCom extends Object{
	var $pov;
	var $povv;
	var $kk;
	var $pzag;
	var $stelya;
	var $office_type;
	var $com_var;
	function loadLocalVars($data){
		$this->loadvars($data);
		$this->pov = $data["pov"];
		$this->povv = $data["povv"];
		$this->kk = $data["kk"];
		$this->pzag = $data["pzag"];
		$this->stelya = $data["stelya"];
		$this->office_type = $data["office_type"];
		$this->com_var = $data["com_var"];
	}
	function shortDetails(){
		return "комерційна нерухомість ".$this->pzag." м<sup>2</sup>";
	}
  function area(){
      return 'Площа: загальна - '.$this->pzag.' м<sup>2</sup>';
  }
}
class ObjectDil extends Object{
	var $rTipC;
	var $dil_add;
	var $pdil;
	var $plo_od;
 	function loadLocalVars($data){
		$this->loadvars($data);
		$this->rTipC = $data["rTipC"];
		$this->dil_add = $data["dil_add"];
		$this->pdil = $data["pdil"];
		$this->plo_od = $data["plo_od"];
	}
	function shortDetails(){
		return "ділянка ".$this->pdil.(($this->plo_od==1)?(($this->pdil>4)?" соток":" сотки"):" га");
	}
  function area(){
      return 'Площа: загальна - '.$this->pdil.(($this->plo_od==1)?(($this->pdil>4)?" соток":" сотки"):" га");
  }
}
?>