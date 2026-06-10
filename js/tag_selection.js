const selected_tags = [];

$(document).on('click keydown', '.tag-unselected', function(event) {
    if ((event.type === 'click') || (event.type === 'keydown' && event.key === 'Enter')) {
        var selected_tag = $(this).attr('tag');
        selected_tags.push(selected_tag);

        $(this).attr('class','tag-selected');
        $('.item-grid').load("./php/item_grid.php", {
            tags: selected_tags
        });
    }
});

$(document).on('click keydown', '.tag-selected', function(event) {
    if ((event.type === 'click') || (event.type === 'keydown' && event.key === 'Enter')) {
        var deselected_tag = $(this).attr('tag');
        var index = selected_tags.indexOf(deselected_tag);
        selected_tags.splice(index, 1);

        $(this).attr('class','tag-unselected');
        $('.item-grid').load("./php/item_grid.php", {
            tags: selected_tags
        });
    }
});

$(document).on('click keydown', '.home', function(event) {
    if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
        selected_tags.length = 0;
    }

});