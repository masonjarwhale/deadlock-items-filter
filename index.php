<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deadlock Item Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="./icons/viscous_goo_puddle.svg">
    <link href='/items/style.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.home').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    $('.about-content').empty();
                    $('.search-container').empty();
                    $('.search-title').empty();
                    $('.graphic-grid').empty();
                    $('.tag-grid-container').show();

                    $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/viscous_bg.webp")');
                    $('.item-grid-container').show();
                    $('.layout').css('grid-template-columns','20% 80%');

                    $('.tag-grid').load("tag_grid.php");
                    $('.item-grid').load("item_grid.php");
                    
                }
                
            });

            $('.about').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    $('.item-grid').empty();
                    $('.tag-grid').empty();
                    $('.search-container').empty();
                    $('.search-title').empty();
                    $('.graphic-grid').empty();
                    $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/kelvin_bg.webp")');

                    $('.item-grid-container').hide();

                    $('.about-content').load("about.php");
                    
                }
                
            });

            var current_table = 'whatever';
            
            $('.images').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    current_table = 'images';
                    $('.item-grid').empty();
                    $('.tag-grid').empty();
                    $('.about-content').empty();
                    $('.tag-grid-container').hide();

                    $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/werewolf_bg.webp")');
                    $('.item-grid-container').show();

                    $('.layout').css('grid-template-columns','14% 90%');

                    /*  */
                    $('.search-container').load("search_container.php");
                    $('.search-title').html("<h2>IMAGES</h2>");
                    $('.graphic-grid').load("graphic_grid.php", {
                        table: current_table
                    });
                    
                }
                
            });

            $('.icons').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    current_table = 'icons';
                    $('.item-grid').empty();
                    $('.tag-grid').empty();
                    $('.about-content').empty();
                    $('.tag-grid-container').hide();
                    
                    $('body').css('background-image','url("https://assets-bucket.deadlock-api.com/assets-api-res/images/heroes/backgrounds/billy_bg.webp")');
                    $('.item-grid-container').show();
                

                    $('.layout').css('grid-template-columns','14% 90%');

                    /*  */
                    $('.search-container').load("search_container.php");
                    $('.search-title').html("<h2>ICONS</h2>");
                    $('.graphic-grid').load("graphic_grid.php", {
                        table: current_table
                    });
                    
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
                    /* $('.search-container button').blur(); */
                }
            });

            $('.tag-unselected').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    $(this).toggleClass('tag-unselected tag-selected');
                    
                }
            });
            
            /* $('.tag-selected').on('click keydown', function(event) {
                if (event.type === 'click' || (event.type === 'keydown' && event.key === 'Enter')) {
                    $(this).toggleClass('tag-selected tag-unselected');
                }
            }); */

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

            <div class="player" tabindex="0">
                <audio loop><source src="./audio/hotel_music_close.mp3" type="audio/mpeg"></audio>
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
                        echo "<div class='tag-unselected' tabindex='0'><image src=\"{$row['filepath']}\"></image></div>";
                    }


                    ?>
                </div>
            </div>

            <div class="item-grid-container">
                <div class="item-grid">

                    <?php

                    $data_items = $db->query("SELECT DISTINCT name, item_slot_type, cost, shop_image_webp FROM item_filters ORDER BY cost ASC, item_slot_type DESC;") or die($db->error);

                    while($row = $data_items->fetch_assoc()){

                        if (!empty($_GET['tags']) ) {
                            echo "<div class='item' tabindex='0'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
                        }
                        else {
                            echo "<div class='item' tabindex='0'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
                        }

                    }

                    ?>

                </div>
                <div class="graphic-grid"></div>

            </div>

            
        </div>
    </div>
    
</body>
</html>