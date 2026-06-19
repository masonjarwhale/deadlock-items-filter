$(document).on('mouseenter focus', '.item, .item-dim', function(event) {
    $('.tooltip-container').css('visibility','visible');
    $('.tooltip-container').css('position-try-fallbacks','flip-inline, flip-start, flip-block, flip-x flip-y');
    var item_name = $(this).attr('item-name')
    $('.tooltip-header').load("./php/tooltip_header.php", {
        class_name: item_name
    });

    $('.tooltip-sections').load("./php/tooltip_sections.php", {
        class_name: item_name
    });

    $('.tooltip-component-container').load("./php/tooltip_footer.php", {
        class_name: item_name
    });
});

$(document).on('mouseleave blur', '.item, .item-dim', function(event) {
    $('.tooltip-container').css('visibility','hidden');
    $('.tooltip-container').css('position-try-fallbacks','none');
});