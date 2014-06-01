var count_collapse = 0;

$(function() {
    $('#side-menu').metisMenu();
    
    $(window).bind("load", function() {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
        }
    });
    
    $(window).bind("resize", function() {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
            $('.navbar-static-side.col-sm-3.col-lg-2').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
            $('.navbar-static-side.col-sm-3.col-lg-2').removeClass('collapse');
        }
    });
    
    $('.slimscroll').slimScroll({
        height: '100%'
    });
    
    $('.tooltip-inner').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });
});

function getToggle() {
    var data = $('#navigation').attr("class");
    count_collapse++;
    
    if(count_collapse%2===0) 
        $(".navbar-static-side.col-sm-3.col-lg-2").attr({'style' : 'display:none;'});
    else 
        $(".navbar-static-side.col-sm-3.col-lg-2").attr({'style' : 'display:block;'});
    
};


