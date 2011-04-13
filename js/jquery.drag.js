// ----------------------------------------------------------------------------
// Drag, jQuery plugin
// v 1.0
// ----------------------------------------------------------------------------
// Copyright (C) 2010 recens
// http://recens.ru/jquery/plugin_drag.html
// ----------------------------------------------------------------------------
(function($){
	$.fn.drag = function(o){
		var o = $.extend({
			start:function(){},   // при начале перетаскивания
			stop:function(){} // при завершении перетаскивания
		}, o);
		return $(this).each(function(){
			var d = $(this); // получаем текущий элемент
      d.css('cursor','pointer');
      d.parent().css('position','fixed').css('z-index',10001);
			d.mousedown(function(e){ // при удерживании мыши
				$(document).unbind('mouseup'); // очищаем событие при отпускании мыши
				o.start(d); // выполнение пользовательской функции
				var f = d.offset(), // находим позицию курсора относительно элемента
				x = $(document).scrollLeft() + e.pageX - f.left,  // слева
        y = $(document).scrollTop() + e.pageY - f.top;  // и сверху
        $(document).mousemove(function(a){ // при перемещении мыши
          yy = a.pageY - y;
          xx = a.pageX - x;
          // не допускаем ухода окна за пределы экрана
          yy=(yy<0)?0:yy;
          //xx=(xx<0)?0:xx;
          //yy=(yy>($(window).height()-d.parent().height()))?$(window).height()-d.parent().height():yy;
          //xx=(xx+2>($(window).width()-d.parent().width()))?$(window).width()-d.parent().width():xx;
          
					d.parent().css({'top' : yy + 'px','left' : xx + 'px'}); // двигаем блок
				});
				$(document).mouseup(function(){  // когда мышь отпущена
					$(document).unbind('mousemove'); // убираем событие при перемещении мыши
					o.stop(d); // выполнение пользовательской функции
				});
				return false;
			});
		});
	}
})(jQuery);