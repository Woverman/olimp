$(document).ready(function(){
    // дублируем меню для скрола
    $("#menu_panel_double").append($("#menu_panel .hmenu").clone());
    // двигаем фон шапки
    $("#logo_block").mousemove(function(e){
        var x = e.pageX;
        var w = $(window).width()/2;
        if (x<w){
            n = -10 + 'px 0px';
            m = 20 + 'px 0px';
        } else {
            n = 50 + 'px 0px';
            m = -20 + 'px 0px';
        }
        $("#logo_block").stop().animate({'background-position':n},3000); 
        $("#header_block").stop().animate({'background-position':m},3000); 
    }).mouseleave(function(){$("#logo_block").stop();$("#header_block").stop();})
    //
    //
});