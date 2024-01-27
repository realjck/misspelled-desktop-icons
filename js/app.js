/**
 * Misspelled Desktop Icons collection webpage JS
 * ----------------------------------------------
 */

/**
 * Icon count
 */
$(".badge").html(_COLLECTION.length);

/**
 * Append icon from List.js to index.html
 */
_COLLECTION.forEach((icon, index) => {
    $("#main")
        .append(index % 6 === 0 ? '</div><div id="main" class="row collection">':'')
        .append('<div class="col-xs-4 col-sm-2 text-center"><div class="icon">' +
        '<div class="icon-block"><div class="btn-group-vertical">' +
        '<a class="btn btn-default btn-xs" href="mdi-collection/ico/'+icon+'.ico" download>.ico</a>' +
        '<a class="btn btn-default btn-xs" href="mdi-collection/png/'+icon+'.png" download>.png</a>' +
        '<a class="btn btn-default btn-xs" href="mdi-collection/svg/'+icon+'.svg" download>.svg</a>' +
        '</div></div><img src="mdi-collection/png/'+icon+'.png" class="img-responsive" alt="icon"></div><h5>'+icon+'</h5></div>');
})

/**
 * Display of icon blocks on hovers
 * there is a chance that this part of the code can be redone entirely in css.
 */
$(".icon").hover(() => {
    $(this).find('.img-responsive').css("opacity", "0.2")
        .css("filter", "grayscale(1)");
    $(this).find('.icon-block').css({
        'z-index': '1'
    });
    $(this).find('.icon-block').show();
    $(this).find('.icon-block').css({
        'top': (($(this).find('.img-responsive').height())
            - ($(this).find('.btn-group-vertical').height())) / 2
    });
    $(this).find('.icon-block').css({
        'padding-left': (($(this).find('.img-responsive').width())
            - ($(this).find('.btn-group-vertical').width())) / 2
    });
}, function() {
    $(this).find('.icon-block').hide();
    $(this).find('.img-responsive').css("opacity", "1")
        .css("filter", "grayscale(0)");
});
