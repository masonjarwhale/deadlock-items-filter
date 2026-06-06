<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deadlock Item Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="./icons/viscous_goo_puddle.svg">
    <link href='./style.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const selected_tags = [];
        

        $(document).ready( function () {
            
            var background_on = true;
            var current_background = 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/viscous_bg.webp")';

            $('body').css('background-image', current_background);
            $('.player audio')[0].volume = 0.1;

            $('.home').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    current_background = 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/viscous_bg.webp")';
                    /* alert(current_background); */
                    if (background_on) {
                        $('body').css('background-image', 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/viscous_bg.webp")');
                    }
                    
                    
                    selected_tags.length = 0;
                    $('.about-content').empty();
                    $('.search-container').empty();
                    $('.search-title').empty();
                    $('.graphic-grid').empty();
                    $('.tag-grid-container').show();

                    
                    $('.layout').css('grid-template-columns','20% 80%');

                    $('.tag-grid').load("tag_grid.php");
                    $('.item-grid').load("item_grid.php");
                    $('.item-grid-container').show();
                    
                }
                
            });

            $('.about').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    current_background = 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/kelvin_bg.webp")';
                    if (background_on) {
                        $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/kelvin_bg.webp")');
                    }

                    $('.item-grid').empty();
                    $('.tag-grid').empty();
                    $('.search-container').empty();
                    $('.search-title').empty();
                    $('.graphic-grid').empty();

                    $('.item-grid-container').hide();

                    $('.about-content').load("about.php");
                    
                }
                
            });

            var current_table = 'whatever';
            
            $('.images').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    current_background = 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/werewolf_bg.webp")';
                    if (background_on) {
                        $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/werewolf_bg.webp")');
                    }
                    current_table = 'images';
                    $('.item-grid').empty();
                    $('.tag-grid').empty();
                    $('.about-content').empty();
                    $('.tag-grid-container').hide();

                    

                    $('.layout').css('grid-template-columns','14% 90%');

                    $('.search-container').load("search_container.php");
                    $('.search-title').html("<h2>IMAGES</h2>");
                    $('.graphic-grid').load("graphic_grid.php", {
                        table: current_table
                    });
                    $('.item-grid-container').show();
                    
                }
                
            });

            $('.icons').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    current_background = 'url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/ivy_bg.webp")';
                    if (background_on) {
                        $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/ivy_bg.webp")');
                    }

                    current_table = 'icons';
                    $('.item-grid').empty();
                    $('.tag-grid').empty();
                    $('.about-content').empty();
                    $('.tag-grid-container').hide();
                    
                    
                

                    $('.layout').css('grid-template-columns','14% 90%');

                    $('.search-container').load("search_container.php");
                    $('.search-title').html("<h2>ICONS</h2>");
                    $('.graphic-grid').load("graphic_grid.php", {
                        table: current_table
                    });
                    $('.item-grid-container').show();
                    
                }
                
            });

            var playing = false;

            $('.player').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    if (!playing) {
                        playing = true;
                        $('.player audio').trigger('play');
                        $('.player img').attr('src', './icons/icon_pause.svg');
                    } else {
                        playing = false;
                        $('.player audio').trigger('pause');
                        $('.player img').attr('src', './icons/icon_play.svg');
                        
                    }
                    
                }
            });

            $('.search-container').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    var user_input = $('.search-container input').val();
                    $('.graphic-grid').load("graphic_grid.php", {
                        search: user_input,
                        table: current_table
                    });
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
        

        /* STYLING - STYLING - STYLING - STYLING - STYLING - STYLING - STYLING - STYLING - STYLING - STYLING - STYLING - STYLING */
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



        
        
    </script>
</head>

<?php 
include 'db.php';
?>

<body>
    <div class="layout-container">

        <div class="nav-container">
            <div class="home" tabindex="0">
                HOME
            </div>

            <div class="about" tabindex="0">
                ABOUT
            </div>

            <div class="images" tabindex="0">
                IMAGES
            </div>
            
            <div class="icons" tabindex="0">
                ICONS
            </div>

            <div class="toggle-background" tabindex="0">
                TOGGLE
            </div>

            <div class="player" tabindex="0">
                <audio loop><source src="./audio/music_match_intro_connecting_60bpm.mp3" type="audio/mpeg"></audio>
                <image class="play-button" src="./icons/icon_play.svg"></image>
            </div>

            
            
            
        </div>

        <div class="layout">
    
            <div class="about-content"></div>

            <div class="search-title"></div>

            <div class="search-container"></div>

            <div class="tag-grid-container">
                <div class="tag-grid">
                    <?php

                    $data_tags = $db->query("SELECT * FROM tags") or die($db->error);

                    while($row = $data_tags->fetch_assoc()){
                        echo "<div class='tag-unselected' tabindex='0' title=\"{$row['display_name']}\" tag=\"{$row['file_name']}\"><image src=\"{$row['filepath']}\"></image></div>";
                    }


                    ?>
                </div>
            </div>

            <div class="item-grid-container" tabindex="-1">
                <div class="item-grid">
                    <?php

                    $data_items = $db->query("SELECT DISTINCT name, item_slot_type, cost, shop_image_webp FROM item_filters ORDER BY cost ASC, item_slot_type DESC") or die($db->error);
                    while($row = $data_items->fetch_assoc()){
                        echo "<div class='item' tabindex='0'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
                    }

                    
                    ?>
                </div>
                <div class="graphic-grid"></div>

            </div>

            
        </div>
    </div>
    
</body>
</html>