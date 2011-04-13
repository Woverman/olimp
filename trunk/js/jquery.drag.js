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
			start:function(){},   // ��� ������ ��������������
			stop:function(){} // ��� ���������� ��������������
		}, o);
		return $(this).each(function(){
			var d = $(this); // �������� ������� �������
      d.css('cursor','pointer');
      d.parent().css('position','fixed').css('z-index',10001);
			d.mousedown(function(e){ // ��� ����������� ����
				$(document).unbind('mouseup'); // ������� ������� ��� ���������� ����
				o.start(d); // ���������� ���������������� �������
				var f = d.offset(), // ������� ������� ������� ������������ ��������
				x = $(document).scrollLeft() + e.pageX - f.left,  // �����
        y = $(document).scrollTop() + e.pageY - f.top;  // � ������
        $(document).mousemove(function(a){ // ��� ����������� ����
          yy = a.pageY - y;
          xx = a.pageX - x;
          // �� ��������� ����� ���� �� ������� ������
          yy=(yy<0)?0:yy;
          //xx=(xx<0)?0:xx;
          //yy=(yy>($(window).height()-d.parent().height()))?$(window).height()-d.parent().height():yy;
          //xx=(xx+2>($(window).width()-d.parent().width()))?$(window).width()-d.parent().width():xx;
          
					d.parent().css({'top' : yy + 'px','left' : xx + 'px'}); // ������� ����
				});
				$(document).mouseup(function(){  // ����� ���� ��������
					$(document).unbind('mousemove'); // ������� ������� ��� ����������� ����
					o.stop(d); // ���������� ���������������� �������
				});
				return false;
			});
		});
	}
})(jQuery);