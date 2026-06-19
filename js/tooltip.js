$(document).on('mouseenter focus', '.item', function(event) {
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
    /* flip-start flip-block */
});

$(document).on('mouseenter focus', '.item', function(event) {
    $('.item').css('filter','brightness(0.65)');
    $('.item').css('transition','filter 0s');
});

$(document).on('focus', '.item', function(event) {
    $('.item').css('filter','brightness(0.65)');
});

$(document).on('blur', '.item', function(event) {
    $('.tooltip-container').css('visibility','hidden');
    $('.tooltip-container').css('position-try-fallbacks','none');
    $('.item').css('filter','brightness(1)');
});

$(document).on('mouseleave', '.item', function(event) {
    $('.tooltip-container').css('visibility','hidden');
    $('.tooltip-container').css('position-try-fallbacks','none');
    $('.item').css('filter','brightness(1)');
    $('.item').css('transition','filter 0.6s');
});