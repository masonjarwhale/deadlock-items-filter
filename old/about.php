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
$table = 'images';

//connecting to the db 
$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}
 
$background_data = $db->query("SELECT * FROM `images` WHERE image_filepath NOT LIKE '%test%' AND image_filepath IN (SELECT image_filepath FROM `images` WHERE image_filepath LIKE '%grounds%') AND image_filepath IN (SELECT image_filepath FROM `images` WHERE image_filepath LIKE '%webp%') ORDER BY RAND() LIMIT 1") or die($db->error);
$background_data = $background_data->fetch_assoc()



 
?>

<body style="background-image: url(&quot;<?php echo "{$background_data['image_filepath']}"; ?>&quot;)">
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
            
        </div>
        
        <div class="about-content">
            <p>
                I wanted an easier way to organize items in Deadlock.<br>
                I made a few tools along the way and decided to polish them.<br> 
                Huge thanks to the devs of the deadlock.api for making this possible.<br>
            </p>
            <p>
                All visuals created by Valve devs excluding a handful of SVGs made by:<br>
                ○ using preexisting SVGs (<a href="./icons/shred.svg">shred</a> and <a href="./icons/armor_debuff_color.svg">debuff resist</a> icon)<br>
                ○ tracing bitmaps of preexisting PNGs (<a href="./icons/scaling.svg">scaling</a>, <a href="./icons/fire_rate_jammer.svg">enemy fire rate reduction</a>, and <a href="./icons/fire_rate_plus.svg">fire rate</a> icon)<br>
            </p>
            <p>
                This site runs entirely on PHP, HTML, CSS, and MySQL.<br> 
                Check out the <a href="">source code</a>! You can reach me at __@__<br> 
            </p>
            <p>
                - Wizards (aka Deluxe) 🫰
            </p>
            
            
        </div>
            
    </div>
</body>
</html>