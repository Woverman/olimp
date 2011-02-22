<div id="center_panel" style="padding-top: 1px;">
    <div id="wrapper">
        <div id="only_wrapper" class="ui-corner-all" style="border: 1px solid #99CCFF;padding:5px;margin-top: 4px;">
		<span><a href='#'>Вінницька</a></span> / <span><a href='#'>Вінницький</a></span> / <span><a href='#'>Вінниця</a></span>
		<div style="clear: both"></div>
        <?
            $obj = Object::load($id);
            echo "<div class='news_shadow_img' style='float:left;overflow:hidden;max-height:450px;'><a href='".$obj->img(1,1)."'><img width='400' src='".$obj->img(1,1)."'></a></div>";
            //
            $cnt = $obj->imgCount();
            if ($cnt>1){
            	echo("<div style='padding:1px; margin-left:415px;'>");
                for ($i=2;$i<=$cnt;$i++){
                    echo "<a href='".$obj->img($i,1)."'><div style='display: table-cell;width:104px; height:104px;margin:2px;padding:2px;float:left; border:1px solid silver;text-align:center;vertical-align: middle;'><img src='".$obj->img($i,2)."' style='border:0;'></div></a>";
                }
            }

        ?>

			<div style="padding: 10px;float:left;">
    * Об'єкт:  <b>будинок</b><br />
    * Пропозиція:  <b>продаж</b><br />
    * Область:  <b>Вінницька</b><br />
    * Район:  <b>Вінницький</b><br />
    * Місто(село): <b> Вінниця</b><br />
    * Вулиця:  <b>р-н електромереж - Гніваньське шосе</b><br />
    * Строк здачі: <b> -1</b><br />
    * Ціна:  <b>430000 у. о.</b><br />
    * Коментар:  Незавершене будівництво - 75% забудови. Велика квадратна ділянка. Район престижних новобудов. Елітний московський проект. Газ, міська вода та каналізація. Асфальт до участку. Зручний підїзд, поруч зупинки міського транспорту. Дом будувався для себе. ГАРНИЙ ТОРГ!
			</div>
	<div style="clear: both"></div>
			</div>
        </div>
    </div>
</div>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/left.tpl'); ?>
<? include(DOCUMENT_ROOT.'/tpl/'.SKIN.'/right.tpl'); ?>