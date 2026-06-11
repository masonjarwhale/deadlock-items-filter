var current_table = '';

$(document).ready( function () {
    $('.home').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            $('.about-content, .search-container, .search-title, .graphic-grid').empty();
            $('.search-title, .graphic-grid, .search-container, .tag-grid-container, .item-grid-container').hide();
            $('.layout').css('grid-template-columns','20% 80%');

            $('.tag-grid').load("./php/tag_grid.php");
            $('.item-grid').load("./php/item_grid.php");   

            $('.tag-grid-container, .item-grid-container').show();
        }
    });

    $('.about').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            $('.item-grid, .tag-grid, .search-container, .search-title, .graphic-grid').empty();
            $('.item-grid-container').hide();

            $('.about-content').load("./php/about.php");
        }
    });
    
    $('.images').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            current_table = 'images';
            $('.item-grid, .tag-grid, .about-content').empty();
            $('.tag-grid-container').hide();
            $('.layout').css('grid-template-columns','14% 90%');

            $('.search-container').load("./php/search_container.php", {
                tab: current_table
            });
            $('.graphic-grid').load("./php/graphic_grid.php", {
                table: current_table
            });
            $('.search-title').html("<h2>IMAGES</h2><image class='info' title='PNG WEBP SVG ONLY&#013;&#013;ABRAMS ⟺ bull&#013;APOLLO ⟺ fencer&#013;BEBOP ⟺ bebop&#013;BILLY ⟺ punkgoat&#013;CALICO ⟺ nano&#013;CELESTE ⟺ unicorn&#013;DOORMAN ⟺ doorman&#013;DRIFTER ⟺ drifter&#013;DYNAMO ⟺sumo&#013;GRAVES ⟺ necro&#013;GREY TALON ⟺ archer&#013;HAZE ⟺ haze&#013;HOLLIDAY ⟺ Astro&#013;INFERNUS ⟺ inferno&#013;IVY ⟺ tengu&#013;KELVIN ⟺ kelvin&#013;LADY GEIST ⟺ spectre&#013;LASH ⟺ lash&#013;McGINNIS ⟺ engineer&#013;MINA ⟺ vampirebat&#013;MIRAGE ⟺ mirage&#013;MO & KRILL ⟺ digger&#013;PAIGE ⟺ bookworm&#013;PARADOX ⟺ chrono&#013;POCKET ⟺ synth&#013;REM ⟺ familiar&#013;SEVEN ⟺ gigawatt&#013;SHIV ⟺ shiv&#013;SILVER ⟺ werewolf&#013;SINCLAIR ⟺ magician&#013;VENATOR ⟺ priest&#013;VICTOR ⟺ frank&#013;VINDICTA ⟺ hornet&#013;VISCOUS ⟺ viscous&#013;VYPER ⟺ kali/viper&#013;WARDEN ⟺ warden&#013;WRAITH ⟺ wraith&#013;YAMATO ⟺ yamato' src='./icons/info.svg' tabindex='0'><image>");

            $('.item-grid-container, .search-title, .search-container, .graphic-grid').show();
            $('.item-grid-container').scrollTop(0);
        }
    });

    $('.icons').on('click keydown', function(event) {
        if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
            current_table = 'icons';
            $('.item-grid, .tag-grid, .about-content').empty();
            $('.tag-grid-container').hide();
            $('.layout').css('grid-template-columns','14% 90%');

            $('.search-container').load("./php/search_container.php", {
                tab: current_table
            });
            $('.graphic-grid').load("./php/graphic_grid.php", {
                table: current_table
            });
            $('.search-title').html("<h2>ICONS</h2><image class='info' title='PNG WEBP SVG ONLY&#013;&#013;ABRAMS ⟺ bull&#013;APOLLO ⟺ fencer&#013;BEBOP ⟺ bebop&#013;BILLY ⟺ punkgoat&#013;CALICO ⟺ nano&#013;CELESTE ⟺ unicorn&#013;DOORMAN ⟺ doorman&#013;DRIFTER ⟺ drifter&#013;DYNAMO ⟺sumo&#013;GRAVES ⟺ necro&#013;GREY TALON ⟺ archer&#013;HAZE ⟺ haze&#013;HOLLIDAY ⟺ Astro&#013;INFERNUS ⟺ inferno&#013;IVY ⟺ tengu&#013;KELVIN ⟺ kelvin&#013;LADY GEIST ⟺ spectre&#013;LASH ⟺ lash&#013;McGINNIS ⟺ engineer&#013;MINA ⟺ vampirebat&#013;MIRAGE ⟺ mirage&#013;MO & KRILL ⟺ digger&#013;PAIGE ⟺ bookworm&#013;PARADOX ⟺ chrono&#013;POCKET ⟺ synth&#013;REM ⟺ familiar&#013;SEVEN ⟺ gigawatt&#013;SHIV ⟺ shiv&#013;SILVER ⟺ werewolf&#013;SINCLAIR ⟺ magician&#013;VENATOR ⟺ priest&#013;VICTOR ⟺ frank&#013;VINDICTA ⟺ hornet&#013;VISCOUS ⟺ viscous&#013;VYPER ⟺ kali/viper&#013;WARDEN ⟺ warden&#013;WRAITH ⟺ wraith&#013;YAMATO ⟺ yamato' src='./icons/info.svg' tabindex='0'><image>");

            $('.item-grid-container, .search-title, .search-container, .graphic-grid').show();
            $('.item-grid-container').scrollTop(0);   
        }     
    });
});

$(document).on('click keydown', '.search-container button', function(event) {
    if ((event.type === 'click') || (event.type === 'keydown' && event.key === 'Enter')) {
        var user_input = $('.search-container input').val();
        $('.graphic-grid').load("./php/graphic_grid.php", {
            search: user_input,
            table: current_table
        });
    }
});

$(document).on('keydown', '.search-container input', function(event) {
    if ((event.type === 'keydown' && event.key === 'Enter')) {
        var user_input = $('.search-container input').val();
        $('.graphic-grid').load("./php/graphic_grid.php", {
            search: user_input,
            table: current_table
        });
    }
});