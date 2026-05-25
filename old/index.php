<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deadlock Item Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="./icons/viscous_goo_puddle.svg">
    <link href='/items/style.css' rel='stylesheet'>
</head>

<?php

/* phpinfo(); */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deadlock_items";


$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

?>

<body>
    <div class="layout-container">

        <div class="nav-container">
            <div class="home">
                <a href="http://localhost/items/index.php">HOME</a>
            </div>

            <div class="about">
                <a href="http://localhost/items/about.php">ABOUT</a>
            </div>

            <div class="images">
                <a href="http://localhost/items/images.php">IMAGES</a>
            </div>
            
            <div class="icons">
                <a href="http://localhost/items/icons.php">ICONS</a>
            </div>

            <iframe src="audio.php" frameborder="0" scrolling="no"></iframe>
            
        </div>

        <div class="layout">
            <div class="tag-grid-container">

                <div class="tag-grid">
                    <?php

                    $data_tags = $db->query("SELECT * FROM tags") or die($db->error);

                    while($row = $data_tags->fetch_assoc()){
                        $currentFilters = [];
                        if (!empty($_GET['tags']) ) {       //avoids undefined array warnings when tags DNE on a fresh instance ex ./?tags=
                            $currentFilters = explode(',',$_GET['tags']);
                        }
                        $currentFilters = array_filter($currentFilters);  //removes the empty entry when all tags are disabled

                        if(in_array($row['file_name'],$currentFilters)) { //modify the href to remove this tag from the URL if it's already selected
                            $updatedFilter = array_diff($currentFilters, [$row['file_name']]);
                            $updatedFilter = implode(',',$updatedFilter);

                            echo "<div class='tag'><a href=\"?tags=$updatedFilter\" title=\"{$row['display_name']}\"><image class='selected' src=\"{$row['filepath']}\"></image></a></div>";
                        }

                        else { //modify the href to include this tag in the URL if it's not selected
                            array_push($currentFilters, $row['file_name']);
                            $updatedFilters = implode(',',$currentFilters);

                            echo "<div class='tag'><a href=\"?tags=$updatedFilters\" title=\"{$row['display_name']}\"><image src=\"{$row['filepath']}\"></image></a></div>";
                        }

                    }

                    ?>

                    
                </div>
            </div>

            <!-- <div class="button-container">
                <div class="active">
                    <a class="active" href="">ACTIVE</a>
                </div>

                <div class="imbue">
                    <a href="">IMBUE</a>
                </div>
                
                <div class="component">
                    <a href="">COMPONENT</a>
                </div>
            </div> -->



            <div class="item-grid-container">
                <div class="item-grid">
                    <?php

                    $data_items = $db->query("SELECT DISTINCT name, item_slot_type, cost, shop_image_webp FROM item_filters ORDER BY cost ASC, item_slot_type DESC;") or die($db->error);

                    while($row = $data_items->fetch_assoc()){

                        if (!empty($_GET['tags']) ) {
                            echo "<div class='item'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
                        }
                        else {
                            echo "<div class='item'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
                        }

                    }

                    ?>

                    
                    

                </div>
            </div>
        </div>
    </div>

    <?php


        

    

    //EOF
    $db->close();
    
    ?>
    
</body>
</html>