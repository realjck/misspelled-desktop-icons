/**
 * Misspelled Desktop Icons collection webpage JS
 */


$(".badge").html(_COLLECTION.length);

_COLLECTION.forEach((icon, index) => {

    $("#main")
        .append(index % 6 === 0 ? '</div><div id="main" class="row collection">':'')
        .append('<div class="col-xs-4 col-sm-2 text-center"><div class="icon">' +
        '<div class="flyout"><div class="btn-group-vertical">' +
        '<a class="btn btn-default btn-xs" href="mdi-collection/ico/'+icon+'.ico" download>.ico</a>' +
        '<a class="btn btn-default btn-xs" href="mdi-collection/png/'+icon+'.png" download>.png</a>' +
        '<a class="btn btn-default btn-xs" href="mdi-collection/svg/'+icon+'.svg" download>.svg</a>' +
        '</div></div><img src="mdi-collection/png/'+icon+'.png" class="img-responsive" alt="icon"></div><h5>'+icon+'</h5></div>');
})

document.addEventListener("dragstart", e => e.preventDefault());

$(".no-link").css("pointer-events", "none");

$(".icon").hover(function() {
    $(this).find('.img-responsive').css("opacity", "0.35");
    $(this).find('.flyout').css({
        'z-index': '1'
    });
    $(this).find('.flyout').show();
    $(this).find('.flyout').css({
        'top': (($(this).find('.img-responsive').height())
            - ($(this).find('.btn-group-vertical').height())) / 2
    });
    $(this).find('.flyout').css({
        'padding-left': (($(this).find('.img-responsive').width())
            - ($(this).find('.btn-group-vertical').width())) / 2
    });
}, function() {
    $(this).find('.flyout').hide();
    $(this).find('.img-responsive').css("opacity", "1");
});
