<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deadlock Item Search</title>
    <base target="_blank">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="./icons/viscous_goo_puddle.svg">
    <link href='./style.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/tag_selection.js"></script>
    <script src="./js/dynamic_divs.js"></script>
    <script src="./js/music_player.js"></script>
    <script src="./js/backgrounds.js"></script>
    <script src="./js/tooltip.js"></script>
    <script src="./js/item_dim.js"></script>
</head>

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
                <audio loop>
                    <source src="./audio/music_match_intro_connecting_60bpm.mp3" type="audio/mpeg">
                </audio>
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
                        include './php/tag_grid.php';
                    ?>
                </div>
            </div>

            <div class="tooltip-container">
                <div class="tooltip">
                    <div class="tooltip-header"></div>
                    <div class="tooltip-sections">b</div>
                    <div class="tooltip-footer">
                        <div class="tooltip-component-container"></div>
                    </div>
                </div>
            </div>

            <div class="item-grid-container" tabindex="-1">
                <div class="item-grid">
                    <?php 
                        include './php/item_grid.php';
                    ?>
                </div>
                <div class="graphic-grid"></div>
            </div>
        </div>
    </div>
    
</body>
</html>