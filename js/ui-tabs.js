$(document).ready(function() {
    $(document).on('click', '.tabs-wrapper > ul a[rel="tab"]', function(event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass("current");
        $(this).parent().addClass("current");

        var tab = $(this).attr("href");

        $(tab).siblings().css('display','none');
        $(tab).fadeIn();
    });
});
