const selected_tags = [];

$(document).on('click keydown', '.tag-unselected', function(event) {
    if ((event.type === 'click') || (event.type === 'keydown' && event.key === 'Enter')) {
        var selected_tag = $(this).attr('tag');
        selected_tags.push(selected_tag);
        /* alert(selected_tags); */
        if (event.type === 'click') {
            $(this).attr('class','tag-currento');
        }
        if (event.type === 'keydown' && event.key === 'Enter') {
            $(this).attr('class','tag-selected');
        }

        $('.item-grid').load("item_grid.php", {
            tags: selected_tags
        });
    }
});

$(document).on('click keydown', '.tag-selected', function(event) {
    if ((event.type === 'click') || (event.type === 'keydown' && event.key === 'Enter')) {
        var deselected_tag = $(this).attr('tag');
        var index = selected_tags.indexOf(deselected_tag);
        selected_tags.splice(index, 1);
        /* alert(selected_tags); */

        if (event.type === 'click') {
            $(this).attr('class','tag-currentp');
        }
        if (event.type === 'keydown' && event.key === 'Enter') {
            $(this).attr('class','tag-unselected');
        }

        $('.item-grid').load("item_grid.php", {
            tags: selected_tags
        });
    }
});



$(document).on('mouseleave', '.tag-currento', function(event) {
    $(this).attr('class','tag-selected');
});

$(document).on('click', '.tag-currento', function(event) {
    var deselected_tag = $(this).attr('tag');
    var index = selected_tags.indexOf(deselected_tag);
    selected_tags.splice(index, 1);
    /* alert(selected_tags); */

    $(this).attr('class','tag-currentp');
    $('.item-grid').load("item_grid.php", {
        tags: selected_tags
    });
});

$(document).on('mouseleave', '.tag-currentp', function(event) {
    $(this).attr('class','tag-unselected');
});

$(document).on('click', '.tag-currentp', function(event) {
    var selected_tag = $(this).attr('tag');
    selected_tags.push(selected_tag);
    /* alert(selected_tags); */
    $(this).attr('class','tag-currento');
    $('.item-grid').load("item_grid.php", {
        tags: selected_tags
    });
});

$(document).on('click keydown', '.home', function(event) {
    if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
        selected_tags.length = 0;
    }

});