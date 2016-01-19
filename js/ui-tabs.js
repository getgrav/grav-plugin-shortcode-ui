$(document).ready(function() {
    $('.tabs-wrapper > ul a[rel="tab"]').click(function(event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass("current");
        $(this).parent().addClass("current");

        var tab = $(this).attr("href");

        $(tab).siblings().css('display','none');
        $(tab).fadeIn();
    });
});