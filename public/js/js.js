$(document).ready(function(){
    $(window).scroll(function(){
        var scrollTop = $(window).scrollTop();
        if(scrollTop >=50)
        {
            $('.navigation').removeClass('padding');
        }
        else
        {
            
            $('.navigation').addClass('padding');
        }
    });
})