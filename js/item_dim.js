$(document).on('mouseenter focus', '.item, .item-dim', function(event) {
    $('.item').css('transition','filter 0.6s');
    $('.item').attr('class','item-dim');
    $(this).attr('class','item');
    $('.item').css('transition','none');
});

$(document).on('mouseleave blur', '.item, .item-dim', function(event) {
    $('.item-dim').attr('class','item');
});