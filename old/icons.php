<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deadlock Item Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="./icons/viscous_goo_puddle.svg">
    <link href='/items/images_icons.css' rel='stylesheet'>
</head>

<?php
//db variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deadlock_items";
$table = "icons";

//connecting to the db 
$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

//handles dynamic backgrounds in the icon/images tab
$background_data = $db->query("SELECT * FROM `images` WHERE image_filepath NOT LIKE '%test%' AND image_filepath IN (SELECT image_filepath FROM `images` WHERE image_filepath LIKE '%grounds%') AND image_filepath IN (SELECT image_filepath FROM `images` WHERE image_filepath LIKE '%webp%') ORDER BY RAND() LIMIT 1") or die($db->error);
$background_data = $background_data->fetch_assoc();



 
?>

<body style="background-image: url(&quot;<?php echo "{$background_data['image_filepath']}"; ?>&quot;);"> <!-- extra styling for dynamic backgrounds -->
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

            
            <!-- <iframe src="audio.php" frameborder="0"></iframe> -->
            
        </div>


        <div class="layout">

            <div class="search-title"><h2>ICONS</h2></div>

            <div class="search-container"></div>

            <!-- <div class="slider-container">
                <input type="range" min="64" max="200" value="120" class="slider">
            </div> -->
            
            <?php
                if(isset($_POST['submit'])) {
                    header("Location: http://localhost/items/icons.php/?search={$_POST['search']}");
                    exit();
                }
            ?>

            
            




            <div class="item-grid-container">
                <div class="item-grid">
                    <?php
                    if (!empty($_GET['search']) ) {
                        $search = $_GET['search'];

                        $icon_data = $db->query("SELECT * FROM $table where icon_filepath like '%$search%'") or die($db->error);
                        while($row = $icon_data->fetch_assoc()){
                            echo "<a href='{$row['icon_filepath']}'><image class='item' src='{$row['icon_filepath']}'></image></a>";
                        }
                    }
                    else {
                        $icon_data = $db->query("SELECT * FROM $table") or die($db->error);
                        while($row = $icon_data->fetch_assoc()){
                            echo "<a href='{$row['icon_filepath']}'><image class='item' src='{$row['icon_filepath']}'></image></a>";
                        }

                    }
                    
                    $db->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


