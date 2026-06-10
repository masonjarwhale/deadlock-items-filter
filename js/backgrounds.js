$(document).ready( function () {
    var background_on = true;
    var current_background = 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/viscous_bg.webp")';

    $('body').css('background-image', current_background);

    function swap_background($background_on, $background) {
        current_background = $background;
        if ($background_on) {
            $('body').css('background-image', $background);
        }
    }
    
    $('.home').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            swap_background(background_on,'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/viscous_bg.webp")') 
        }
    });

    $('.about').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            swap_background(background_on,'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/kelvin_bg.webp")') 
        }
    });
    
    $('.images').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            swap_background(background_on,'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/werewolf_bg.webp")') 
        }
    });

    $('.icons').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            swap_background(background_on,'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/ivy_bg.webp")') 
        }
    });

    $('.toggle-background').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            if (background_on) {
                $('body').css('background-image', 'none');
                background_on = false;
            }
            else {
                $('body').css('background-image', current_background);
                background_on = true;
            }
        }
    });

});