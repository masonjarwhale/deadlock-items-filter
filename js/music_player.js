$(document).ready( function () {
    $('.player audio')[0].volume = 0.1;
    var playing_audio = false;

    $('.player').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            if (!playing_audio) {
                playing_audio = true;
                $('.player audio').trigger('play');
                $('.player img').attr('src', './icons/icon_pause.svg');
            } else {
                playing_audio = false;
                $('.player audio').trigger('pause');
                $('.player img').attr('src', './icons/icon_play.svg');
            }
        }
    });
});