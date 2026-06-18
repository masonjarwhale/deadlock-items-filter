$(document).on('mouseenter focus', '.item', function(event) {
    $('.tooltip-container').css('visibility','visible');
    $('.tooltip-container').css('position-try-fallbacks','flip-inline, flip-start, flip-block, flip-x flip-y');
    var item_name = $(this).attr('item-name')
    $('.tooltip-header').load("./php/tooltip_header.php", {
        class_name: item_name
    });

    /* $('').load("./php/tooltip_sections.php", {
        item: selected_tags
    }); */

    $('.tooltip-component-container').load("./php/tooltip_footer.php", {
        class_name: item_name
    });
    /* flip-start flip-block */
});

$(document).on('mouseleave blur', '.item', function(event) {
    $('.tooltip-container').css('visibility','hidden');
    $('.tooltip-container').css('position-try-fallbacks','none');

});