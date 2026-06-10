$(document).on('mouseenter', '.item', function(event) {
    $('.tooltip').css('visibility','visible');
    $('.tooltip').css('position-try-fallbacks','flip-inline, flip-start, flip-block, flip-x flip-y');
    /* flip-start flip-block */
});

$(document).on('mouseleave', '.item', function(event) {
    $('.tooltip').css('visibility','hidden');
    $('.tooltip').css('position-try-fallbacks','none');

});